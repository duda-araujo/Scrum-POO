<?php

include_once("Tripulacao.php");
include_once("Aeroporto.php");
include_once("Veiculo.php");
include_once("GoogleMapsAPI.php");
include_once("persist.php");

class Rota extends persist{
    protected Aeroporto $aeroporto;
    protected Veiculo $veiculo;
    protected array $tripulacao;

    protected array $enderecos;

    protected VooPlanejado $voo;

    protected DateTime $hora_transporte;

    
    public function __construct($aeroporto_f, $veiculo_f,$tripulacao_f,$voo_f) {
        try{
            if(Sistema::checkSessionState()==FALSE){
                throw new Exception("Usuario não foi inicializado! Não é possível acessar o sistema\n");
            }
            else{
        $this->set_aeroporto($aeroporto_f);
        $this->set_veiculo($veiculo_f);
        $this->set_tripulacao($tripulacao_f);
        $this->set_voo($voo_f);
        #$this->set_hora_transporte();
        echo "sistema de transporte do voo ".$this->get_voo()->get_codigo(). " criado com sucesso\n";
    }
}catch(Exception $e){
    echo $e->getMessage();
}
    }

    static public function getFilename() {
        return get_called_class();
    }

    public function set_aeroporto($aeroporto_f) {
        if(isset($this->aeroporto)){
            $objectBefore = $this->aeroporto;
        }else{
            $objectBefore = null;
        }
        $this->aeroporto = $aeroporto_f;
        $objectAfter = $this->aeroporto;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
    public function set_veiculo($veiculo_f) {
        if(isset($this->veiculo)){
            $objectBefore = $this->veiculo;
        }else{
            $objectBefore = null;
        }
        $this->veiculo = $veiculo_f;
        $objectAfter = $this->veiculo;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
    public function set_tripulacao($tripulacao_f) {
        if(isset($this->tripulacao)){
            $objectBefore = $this->tripulacao;
        }else{
            $objectBefore = null;
        }
        $this->tripulacao = $tripulacao_f;
        $objectAfter = $this->tripulacao;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
    public function get_aeroporto(){
        $method = __METHOD__;
        new logLeitura(get_called_class(), $method);
        return $this->aeroporto;
    }
    public function get_veiculo(){
        $method = __METHOD__;
        new logLeitura(get_called_class(), $method);
        return $this->veiculo;
    }
    public function get_tripulacao(){
        $method = __METHOD__;
        new logLeitura(get_called_class(), $method);
        return $this->tripulacao;
    }
    public function converter_endereco($endereco){
        $endereco = str_replace(",", "", $endereco);
        return $endereco;
    }
    public function endereço_to_string(){
        $array = [];
        foreach ($this->tripulacao as $tripulante) {
            $endereço = $tripulante->get_logradouro() . ", " . $tripulante->get_numero() . ", " . $tripulante->get_bairro() . ", " . $tripulante->get_cidade() . ", " . $tripulante->get_estado();
            $endereço = $this->converter_endereco($endereço);
            $array[] = ['location' => $endereço];
        }
        return $array;
    }
    public function definir_rota() {
        $arrayDistancias = [];
        $googleMaps = new GoogleMapsAPI();
        $waypoints = $this->endereço_to_string();
        $nome_aero = $this -> aeroporto -> get_nome_aero();
        $cidade_aero = $this -> aeroporto -> get_cidade();
        $estado_aero = $this -> aeroporto -> get_estado();
        $origin = $nome_aero .= ", " . $cidade_aero .= ", " . $estado_aero;
        $destination = $nome_aero .= ", " . $cidade_aero .= ", " . $estado_aero;
        // Fazer a requisição de direções com os waypoints
        print_r($waypoints);
        $response = $googleMaps->directions($origin, $destination, $waypoints, $optimize = true);

        // Converter a resposta JSON em array
        $data = json_decode($response, true);

        // Verificar se a requisição foi bem-sucedida
        if ($data['status'] === 'OK') {
            $routes = $data['routes'];

            // Calcular a distância total percorrida em todas as rotas
            $i = 0;
            foreach ($routes as $route) {
                $legs = $route['legs'];
                foreach ($legs as $leg) {
                    $distance = ($leg['distance']['value'])/1000;
                    #adiciona a distancia de cada rota no array
                    if($i>=sizeof($this->tripulacao)){
                        break;
                    }
                    $nome = $this->tripulacao[$i]->get_nome();
                    $arrayDistancias["$nome"] = $distance;
                    $i++;
                }
            }
            echo "\n Rota calculada!";
            return $arrayDistancias;
        } else {
            echo "Erro na requisição: " . $data['status'];
        }

        $googleMaps->close();

    }

    public function set_hora_transporte () {
        if(isset($this->hora_transporte)){
            $objectBefore = $this->hora_transporte;
        }else{
            $objectBefore = null;
        }
        $segundos = $this->definir_rota() / 18+5400;
        $a = clone $this->voo->get_hora_agenda_saida();
        $this->hora_transporte=$a->sub(new DateInterval("PT{$segundos}S"));
        $objectAfter = $this->hora_transporte;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
    
    public function get_voo(){
        $method = __METHOD__;
        new logLeitura(get_called_class(), $method);
        return $this->voo;

    }

    public function set_voo($voo_f){
        if(isset($this->voo)){
            $objectBefore = $this->voo;
        }else{
            $objectBefore = null;
        }
        $this->voo = $voo_f;
        $objectAfter = $this->voo;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);

    }
    public function get_hora_transporte(){
        $method = __METHOD__;
        new logLeitura(get_called_class(), $method);
        return $this->hora_transporte;
    }
}

?>