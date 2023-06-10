<?php

class PassageiroVip extends Passageiro{
protected bool $vip = true;
protected ProgramaDeMilhagem $programa_milhagem;
protected string $numero_registro;



public function __construct($nome_p, $sobrenome_p, $documento_p, $nbagagens_p, $vip_p, $nacionalidade_p, $cpf_p, $data_de_nascimento_p, $data_atual_p, $email_p, $assento_p,$programa,$registro){
    try{
        if(Sistema::checkSessionState()==FALSE){
            throw new Exception("usuario nao foi inicializado");
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
    return $this->programa_milhagem;
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
}
