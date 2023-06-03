<?php

include_once ("Passagens.php");

class CartaoDeEmbarque  {

protected Passagens $passagem;
protected string $nome_passageiro;
protected string $sobrenome_passageiro;
protected Aeroporto $origem_do_voo;
protected Aeroporto $destino_do_voo;
protected DateTime $horario_embarque;
protected DateTime $horario_viagem;
protected string $assento;


public function __construct($voo_planejado_f,$passageiro_f){
$this->set_nome($passageiro_f->get_nome_passageiro());
$this->set_sobrenome($passageiro_f->get_sobrenome_passageiro());
$this->set_origem($voo_planejado_f->get_origem());
$this->set_destino($voo_planejado_f->get_destino());
$this->set_horario_viagem($voo_planejado_f->get_hora_agenda_saida());
$this->set_assento($passageiro_f->get_assento());
$this->set_horario_embarque();
}

public function set_nome($passagem_f){
    $this->nome_passageiro = $passagem_f;
}
public function set_sobrenome($passagem_f){
    $this->sobrenome_passageiro = $passagem_f;
}
public function set_origem($passagem_f){
    $this->origem_do_voo = $passagem_f;
}
public function set_destino($passagem_f){
    $this->destino_do_voo = $passagem_f;
}
public function set_horario_embarque(){
    $segundos=3000;
    $a=$this->get_horario_voo();
    $this->horario_embarque=$a->sub(new DateInterval("PT{$segundos}S"));
}
public function set_horario_viagem($passagem_f){
    $this->horario_viagem = $passagem_f;
}
public function set_assento($passagem_f){
    $this->assento = $passagem_f;
}

public function get_horario_voo(){
    return $this->horario_viagem;
}
}

