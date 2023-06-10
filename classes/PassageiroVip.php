<?php

class PassageiroVip extends Passageiro{
protected bool $vip = true;
protected ProgramaDeMilhagem $programa_de_milhagem;
protected string $categoria;
protected int $pontos;
protected string $numero_registro;



public function __construct($nome_p, $sobrenome_p, $documento_p, $nbagagens_p, $vip_p, $nacionalidade_p, $cpf_p, $data_de_nascimento_p, $data_atual_p, $email_p, $assento_p,$programa,$registro){
    try{
        if(Sistema::checkSessionState()==FALSE){
            throw new Exception("Usuario não foi inicializado! Não é possível acessar o sistema\n");
        }
        else{
    $this->set_nome_passageiro($nome_p);
    $this->set_sobrenome_passageiro($sobrenome_p);
    $this->set_documento_passageiro($documento_p);
    $this->set_numero_bagagens($nbagagens_p);
    $this->set_nacionalidade($nacionalidade_p);
    $this->set_cpf($cpf_p);
    $this->set_data_de_nascimento($data_de_nascimento_p, $data_atual_p);
    $this->set_email($email_p);
    $this->set_assento($assento_p);
    $this->set_milhagem($programa);
    $this->set_registro($registro);
    echo "passageiro vip".$this->get_nome_passageiro()." ".$this->get_sobrenome_passageiro()." cadastrado com sucesso"."\n";
}
}catch(Exception $e){
    echo $e->getMessage();
}
}
static public function getFilename() {
    return get_called_class();
  }

public function get_vip(){
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return true;
}

public function get_milhagem(){
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->programa_de_milhagem;
}

public function set_milhagem(ProgramaDeMilhagem $p){
    if(isset($this->programa_de_milhagem)){
        $objectBefore = $this->programa_de_milhagem;
    }else{
        $objectBefore = null;
    }
    $this->programa_de_milhagem = $p;
    $objectAfter = $this->programa_de_milhagem;
    new logEscrita(get_called_class(), $objectBefore, $objectAfter);
}
public function set_registro($r){
    if(isset($this->numero_registro)){
        $objectBefore = $this->numero_registro;
    }else{
        $objectBefore = null;
    }
    $this->numero_registro = $r;
    $objectAfter = $this->numero_registro;
    new logEscrita(get_called_class(), $objectBefore, $objectAfter);
}

public function get_registro(){
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->numero_registro;
}
// public function get_categoria() {
//     $method = __METHOD__;
//     new logLeitura(get_called_class(), $method);
//     return $this->categoria;
// }
// public function set_categoria($pontos) {
//     if(isset($this->programa_de_milhagem)){
//         $objectBefore = $this->categoria;
//         $this->categoria = $this->programa_de_milhagem->get_categoria($pontos);
//         $objectAfter = $this->categoria;
//         new logEscrita(get_called_class(), $objectBefore, $objectAfter);
//     }else{
//         $objectBefore = null;
//         $this->categoria = $this->programa_de_milhagem->get_categoria($pontos);
//         $objectAfter = $this->categoria;
//         new logEscrita(get_called_class(), $objectBefore, $objectAfter);
//     }
// }
// public function get_pontos() {
//     $method = __METHOD__;
//     new logLeitura(get_called_class(), $method);
//     return $this->pontos;
// }
// public function set_pontos($pontos_f) {
//     if(isset($this->programa_de_milhagem)){
//         $objectBefore = $this->pontos;
//         $this->pontos = $pontos_f;
//         $objectAfter = $this->pontos;
//         new logEscrita(get_called_class(), $objectBefore, $objectAfter);
//     }else{
//         $objectBefore = null;
//         $this->pontos = $pontos_f;
//         $objectAfter = $this->pontos;
//         new logEscrita(get_called_class(), $objectBefore, $objectAfter);
//     }
// }
// public function adicionar_pontos($pontos, DateTime $data){
//     $this->pontos += $pontos;
//     $this->historico_de_pontos[$data->format('d-m-Y')] = $pontos;
// }
// // Caso a quantidade mínima de pontos acumulados nos últimos 12 meses 
// // de uma categoria não seja mantida, o passageiro vip tem um downgrade e retorna à categoria anterior.
// // Checa o array historico_de_pontos e retorna a quantidade de pontos acumulados nos ultimos 12 meses
// public function ultimos_doze_meses(DateTime $data_atual) {
//     if ($this->programa_de_milhagem == null) {
//         echo("\nPrograma de milhagem não definido");
//     }
//     else{
//     $pontos_ultimos_doze_meses = 0;
//     foreach($this->historico_de_pontos as $data => $pontos) {
//         $data_formatada = DateTime::createFromFormat('d-m-Y', $data);
//         $diferenca = $data_atual->diff($data_formatada);
//         if($diferenca->y == 0 && $diferenca->m <= 12) {
//             $pontos_ultimos_doze_meses += $pontos;
//         }
//     }
//     $categoria = $this->programa_de_milhagem->get_categoria($pontos_ultimos_doze_meses);
//     if(isset($this->categoria)){
//         $objectBefore = $this->categoria;
//         $this -> categoria = $categoria;
//         $objectAfter = $this -> categoria;
//         new logEscrita(get_called_class(), $objectBefore, $objectAfter);
//     }else{
//         $objectBefore = null;
//         $this -> categoria = $categoria;
//         $objectAfter = $this -> categoria;
//         new logEscrita(get_called_class(), $objectBefore, $objectAfter);
//     }}
// }
}
