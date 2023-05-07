<?php

class PassageiroVip extends Passageiro{
protected bool $vip = true;
protected ProgramaDeMilhagem $programa_milhagem;
protected string $numero_registro;



public function __construct($nome_p, $sobrenome_p, $documento_p, $nbagagens_p, $vip_p, $nacionalidade_p, $cpf_p, $data_de_nascimento_p, $data_atual_p, $email_p, $assento_p,$programa,$registro){
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
}
public function get_vip(){
    return true;

}

public function get_milhagem(){
    return $this->programa_milhagem;
}

public function set_milhagem(ProgramaDeMilhagem $p){
    $this->programa_de_milhagem= $p;
}
public function set_registro($r){
    $this->numero_registro=$r;
}

public function get_registro(){
    return $this->numero_registro;
}
}
