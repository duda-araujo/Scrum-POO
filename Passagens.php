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
    protected int $franquia;

public function __construct(Aeroporto $origem_f, Aeroporto $destino_f, Passageiro $passageiro_f, int $franquia_f){
    $this->set_voo($origem_f, $destino_f);
    $this->set_cliente($passageiro_f);
    $this->set_franquia($franquia_f);
    $this->set_preco($franquia_f);
    self::$passagens[] = $this;
    $this->set_ordem_cronologica();
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
    return $this->franquia;
}
public function get_nbagagens(){
    return $this->passageiro->get_nbagagens();
}
public static function get_passagens($cpf_passageiro_f): array{
    $passagens_p = [];
    foreach(self::$passagens as $passagens1){
        if($passagens1->get_cliente()->get_cpf() == $cpf_passageiro_f){
            $passagens_p[] = $passagens1;
        }
    } return $passagens_p;
}
public static function set_ordem_cronologica(): array{
    $new_passagens = [];
    foreach(self::$passagens as $passagens1){
        $hora_base = $passagens1->voo->get_hora_agenda_chegada();
        foreach(self::$passagens as $passagens2){
            if($passagens2->voo->get_hora_agenda_chegada() < $hora_base){
                $hora_base=$passagens2->voo->get_hora_agenda_chegada();
                $new_passagens=$passagens2;
            }
        }
    } return $new_passagens;
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

public function set_franquia($franquia_f): void {//entre 0 e 3
    try {
        if ($franquia_f < 0){
            throw new Exception("\nFranquia não pode ser negativa");
        }
        else if($franquia_f > 3){
            throw new Exception("\nFranquia maxima eh 3");
        }
        else{
            $this->franquia = $franquia_f;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

public function set_preco($franquia_f){
   
    if($this->passageiro->get_vip() == false){ //Nao vip
    if($this->conexao == null){//nao vip sem conexao
      $a= $this->voo->get_aviao();
      $b=$a->get_companhia_aerea();
      $c=$b->get_preco_bagagem();
      $this->preco=$this->voo->get_preco_trajeto() + $franquia_f * $c;
}
    else {//nao vip com conexao
      $a= $this->voo->get_aviao();
      $b=$a->get_companhia_aerea();
      $c=$b->get_preco_bagagem();
      $d= $this->conexao->get_aviao();
      $e=$d->get_companhia_aerea();
      $f=$e->get_preco_bagagem();
      $this->preco= $this->voo->get_preco_trajeto() + $this->conexao->get_preco_trajeto() + $franquia_f *($c + $f);
    }
}
    else{//vip
            if($this->conexao == null){//vip sem conexao
              $a= $this->voo->get_aviao();
              $b=$a->get_companhia_aerea();
              $c=$b->get_preco_bagagem();
              if($franquia_f!=0){//vip sem conexao e com bagagem
              $this->preco=$this->voo->get_preco_trajeto() + ($franquia_f - 1) * ($c/2);
              }
              else{//vip sem conexao sem bagagem
              $this->preco=$this->voo->get_preco_trajeto();
              }
        }
            else {//vip com conexao
              $a= $this->voo->get_aviao();
              $b=$a->get_companhia_aerea();
              $c=$b->get_preco_bagagem();
              $d= $this->conexao->get_aviao();
              $e=$d->get_companhia_aerea();
              $f=$e->get_preco_bagagem();
              if($franquia_f !=0){//vip com conexao e bagagem
              $this->preco= $this->voo->get_preco_trajeto() + $this->conexao->get_preco_trajeto() + ($franquia_f - 1) *(($c + $f)/2);
              }
              else{//vip com conexao sem bagagem
              $this->preco= $this->voo->get_preco_trajeto() + $this->conexao->get_preco_trajeto();
              }
    }
}
}
}
