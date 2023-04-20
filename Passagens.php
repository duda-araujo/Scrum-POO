<?php

include_once "VooPlanejado.php";
include_once "Aeroporto.php";
include_once "Passageiro.php";
include_once "Aeronave.php";
class Passagens{
    protected VooPlanejado $voo;
    protected ?VooPlanejado $conexao = null;
    protected Passageiro $passageiro;
    public static array $passagens = []; 
    protected float $preco;

public function __construct(Aeroporto $origem_f, Aeroporto $destino_f, Passageiro $passageiro_f){
    $this->set_voo($origem_f, $destino_f);
    $this->set_cliente($passageiro_f);
    $this->set_preco();
    self::$passagens[] = $this;
}
public function get_preco(){
    return $this->preco;
}
public function get_voo(){
    return $this->voo;
}
public function get_cliente(){
    return $this->passageiro;
}
public function get_origem(){
    return $this->voo->get_origem();
}
public function get_destino(){
    return $this->voo->get_destino();
}
public function get_franquia(){
    return $this->voo->get_franquia();
}
public function get_tarifa(){
    return $this->voo->get_aviao()->get_tarifa();
}
public function get_nbagagens(){
    return $this->passageiro->get_nbagagens();
}
public function set_preco(){
    if ($this->conexao == null){
        $this->preco = $this->voo->get_preco();
    }
    else{
        $this->preco = $this->voo->get_preco() + $this->conexao->get_preco();
    }
}

public function comprar_bagagem(){
    $nbagagens = $this->get_nbagagens();
    $tarifa = $this->get_tarifa();
    return $nbagagens*$tarifa;
}
public function set_voo($origem_f, $destino_f){
    echo "\nVerificando conexão";
    $voos = self::verificar_conexão($origem_f, $destino_f);
    //array to string conversion
    $this->voo = $voos[0];
    $this->conexao = $voos[1];
}


public function set_cliente($cliente_f){
    try {
        if ($cliente_f instanceof Passageiro){
            $this->passageiro = $cliente_f;
        } else {
            throw new InvalidArgumentException("\nErro: o cliente não existe");
        }
    } catch (InvalidArgumentException $e) {
        echo $e->getMessage();
    }
}
public function verificar_conexão(Aeroporto $origem, Aeroporto $destino) {
    $voos_proximos = VooPlanejado::buscar_proximos_voos();
    $voos = [];
    try{
        // Verifica se existe algum voo direto
        foreach ($voos_proximos as $voo) {
            if ($voo->get_origem() === $origem && $voo->get_destino() === $destino) {
                array_push($voos, $voo, null);
                echo "\nVoo direto";
                return $voos;
            }
        }
        
        // Verifica se existe algum voo com conexão
        foreach ($voos_proximos as $voo) {
            if ($voo->get_origem() === $origem) {
                foreach ($voos_proximos as $voo_conexao) {
                    if ($voo_conexao->get_destino() === $destino && $voo->get_hora_agenda_chegada() <= $voo_conexao->get_hora_agenda_saida()) {
                        array_push($voos, $voo, $voo_conexao);
                        echo "\nVoo com conexão";
                        return $voos;
                    }
                }
            }
        }
        throw new Exception("\nNão existe voo direto ou com conexão");
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
public function string_passagem(){
    $nome = $this->get_cliente()->get_nome_passageiro();
    $sobrenome = $this->get_cliente()->get_sobrenome_passageiro();
    $origem = $this->get_origem()->get_nome_aero();
    $destino = $this->get_destino()->get_nome_aero();
    $preco = $this->get_preco();
    $franquia = $this->get_franquia();

    return "\nPassagem comprada para $nome $sobrenome, de $origem para $destino, com franquia de $franquia kg e preço de R$$preco";
}       
}