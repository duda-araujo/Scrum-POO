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


public function __construct(Passagens $passagem_f){
$this->set_nome($passagem_f);
$this->set_sobrenome($passagem_f);
$this->set_origem($passagem_f);
$this->set_destino($passagem_f);
$this->set_horario_embarque($passagem_f);
$this->set_horario_viagem($passagem_f);
$this->set_assento($passagem_f);
}

public function set_nome($passagem_f){
    $this->nome_passageiro = $passagem_f->get_cliente()->get_nome_passageiro(); 
}
public function set_sobrenome($passagem_f){
    $this->sobrenome_passageiro = $passagem_f->get_cliente()->get_sobrenome_passageiro();
}
public function set_origem($passagem_f){
    $this->origem_do_voo = $passagem_f->get_origem();
}
public function set_destino($passagem_f){
    $this->destino_do_voo = $passagem_f->get_destino();
}
public function set_horario_embarque($passagem_f){
    $this->horario_embarque = $passagem_f->get_voo();
}
public function set_horario_viagem($passagem_f){
    $this->horario_viagem = $passagem_f->get_voo()->get_hora_agenda_saida();
}
public function set_assento($passagem_f){
    $this->assento = $passagem_f->get_cliente()->get_assento();
}


}

