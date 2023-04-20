<?php

class Passageiro{
   protected string $nome_passageiro;
    protected string $sobrenome_passageiro;
    protected string $documento_passageiro;
    protected int $numero_bagagens;
    
    


public function __construct($nome_p, $sobrenome_p,$documento_p, $nbagagens_p){
    $this->set_nome_passeiro($nome_p);
    $this->set_sobrenome_passageiro($sobrenome_p);
    $this->set_documento_passageiro($documento_p);
    $this->set_numero_bagagens($nbagagens_p);

}
public function set_nome_passeiro($nome_p){
    $this->nome_passageiro = $nome_p;
}
public function set_sobrenome_passageiro($sobrenome_p){
    $this->sobrenome_passageiro = $sobrenome_p;
}
public function set_documento_passageiro($documento_p){
    $this->documento_passageiro = $documento_p;
}
public function set_numero_bagagens($numero_bagagens_f){
    $this->numero_bagagens = $numero_bagagens_f;
}
public function get_nome_passageiro(){
    return $this->nome_passageiro;
}
public function get_sobrenome_passageiro(){
    return $this->sobrenome_passageiro;
}
public function get_documento_passageiro(){
    return $this->documento_passageiro;
}
public function get_nbagagens(){
    return $this->numero_bagagens;
}
}
    