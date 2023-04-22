<?php

include_once("Passageiro.php");
include_once("VooPlanejado.php");

class Assento { 
    protected VooPlanejado $voo;
    protected Passageiro $passageiro;
    protected string $numero_assento;

public function __construct(VooPlanejado $voo, Passageiro $passageiro, string $numero_assento){
    $this->set_voo($voo);
    $this->set_passageiro($passageiro);
    $this->set_numero_assento($numero_assento);
    $this->voo->comprar_assento($numero_assento, $passageiro);
}

public function get_voo(): VooPlanejado{
    return $this->voo;
}
public function get_passageiro(): Passageiro{
    return $this->passageiro;
}
public function get_numero_assento(): string{
    return $this->numero_assento;
}

public function set_voo(VooPlanejado $voo_f){
    $this->voo = $voo_f;
}
public function set_passageiro(Passageiro $passageiro_f){
    $this->passageiro = $passageiro_f;
}
public function set_numero_assento(string $numero_assento_f){
    $this->numero_assento = $numero_assento_f;
}
}
?>