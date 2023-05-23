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
    protected VooPlanejado $voo;
    protected DateTime $hora_transporte;

    public function __construct($aeroporto_f, $veiculo_f,$tripulacao_f,$voo_f)
    {
        $this->set_aeroporto($aeroporto_f);
        $this->set_veiculo($veiculo_f);
        $this->set_tripulacao($tripulacao_f);
        $this->set_voo($voo_f);
        $this->hora_transporte();
    }

    static public function getFilename() {
        return get_called_class();
    }

    public function set_aeroporto($aeroporto_f) {
        $this->aeroporto = $aeroporto_f;
    }
    public function set_veiculo($veiculo_f) {
        $this->veiculo = $veiculo_f;
    }
    public function set_tripulacao($tripulacao_f) {
        $this->tripulacao = $tripulacao_f;
    }
    public function get_aeroporto(){
        return $this->aeroporto;
    }
    public function get_veiculo(){
        return $this->veiculo;
    }
    public function get_tripulacao(){
        return $this->tripulacao;
    }
    public function converter_endereco($endereco){
        $endereco = str_replace(",", "", $endereco);
        return $endereco;
    }
    public function endereço_to_string(){
        $array = [];
        foreach ($this->tripulacao as $tripulante) {
            $endereço .= $tripulante->get_logradouro() . ", " . $tripulante->get_numero() . ", " . $tripulante->get_bairro() . ", " . $tripulante->get_cidade() . ", " . $tripulante->get_estado() . ", " . $tripulante->get_pais();
            $endereço = $this->converter_endereco($endereço);
            $array[] = ['location' => $endereço];
        }
        return $array;
    }
    public function definir_rota() {
        $googleMaps = new GoogleMapsAPI();
        $waypoints = $this->endereço_to_string();
        $origin = $this -> aeroporto -> get_nome_aero() .= ", " . $this -> aeroporto -> get_cidade() .= ", " . $this -> aeroporto -> get_estado();
        $destination = $this -> aeroporto -> get_nome_aero() .= ", " . $this -> aeroporto -> get_cidade() .= ", " . $this -> aeroporto -> get_estado();
        // Fazer a requisição de direções com os waypoints
        $response = $googleMaps->directions($origin, $destination, $waypoints, $optimize = true);

        // Converter a resposta JSON em array
        $data = json_decode($response, true);

        // Verificar se a requisição foi bem-sucedida
        if ($data['status'] === 'OK') {
            $routes = $data['routes'];
            $totalDistance = 0;

            // Calcular a distância total percorrida em todas as rotas
            foreach ($routes as $route) {
                $legs = $route['legs'];
                foreach ($legs as $leg) {
                    $distance = $leg['distance']['value'];
                    $totalDistance += $distance;
                }
            }

            // Converter a distância total para a unidade desejada (por exemplo, km)
            $totalDistanceKm = $totalDistance / 1000;
            $googleMaps->close();
            return $totalDistanceKm;
        } else {
            $googleMaps->close();
            echo "Erro na requisição: " . $data['status'];
            return;
        }
    }
}
public function hora_transporte(){
    $tempo_transporte_horas=$this->definir_rota()/18;
    $tempo_transporte=ceil($tempo_transporte_horas,1);
    $horas=string($tempo_transporte);
    $k=date_create_from_format("H:i:s",$horas":0:0");
    $s=date_create_from_format("H:i:s","1:30:0");
    $a=$this->get_voo();
    $this->hora_transporte=$a->get_hora_agenda_saida()-$k-$s;
}


public function get_voo(){
    return $this->voo;
}

public function set_voo($voo_f){
    $this->voo=$voo_f;
}
?>