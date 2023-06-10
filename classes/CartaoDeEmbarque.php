<?php

include_once ("Passagens.php");

class CartaoDeEmbarque extends persist{

protected Passagens $passagem;
protected string $nome_passageiro;
protected string $sobrenome_passageiro;
protected Aeroporto $origem_do_voo;
protected Aeroporto $destino_do_voo;
protected DateTime $horario_embarque;
protected DateTime $horario_viagem;
protected string $assento;


public function __construct($voo_planejado_f,$passageiro_f){
  try{
    if(Sistema::checkSessionState()==FALSE){
        throw new Exception("usuario nao foi inicializado");
    }
    else{
$this->set_nome($passageiro_f->get_nome_passageiro());
$this->set_sobrenome($passageiro_f->get_sobrenome_passageiro());
$this->set_origem($voo_planejado_f->get_origem());
$this->set_destino($voo_planejado_f->get_destino());
$this->set_horario_viagem($voo_planejado_f->get_hora_agenda_saida());
$this->set_assento($passageiro_f->get_assento());
$this->set_horario_embarque();
echo "\nCartao de embarque do passageiro" . $this->get_nome_passagerio() . "/n". $this->get_sobrenome_passageiro() . "cadastrado com sucesso";
}
}catch(Exception $e){
    echo $e->getMessage();
}
}
static public function getFilename() {
    return get_called_class();
  }

public function set_nome($nome_f){
    if(isset($this->nome_passageiro)){
        $objectBefore = $this->nome_passageiro;
        $this->nome_passageiro = $nome_f;
        $objectAfter = $this->nome_passageiro;
        new LogEscrita(get_called_class(), $objectBefore, $objectAfter);
      }
      else{
        $objectBefore = null;
        $this->nome_passageiro = $nome_f;
        $objectAfter = $this->nome_passageiro;
        new LogEscrita(get_called_class(), $objectBefore, $objectAfter);
      }
    $this->nome_passageiro = $nome_f;
}
public function set_sobrenome($sobrenome_f){
    if(isset($this->sobrenome_passageiro)){
        $objectBefore = $this->sobrenome_passageiro;
        $this->sobrenome_passageiro = $sobrenome_f;
        $objectAfter = $this->sobrenome_passageiro;
        new LogEscrita(get_called_class(), $objectBefore, $objectAfter);
      }
      else{
        $objectBefore = null;
        $this->sobrenome_passageiro = $sobrenome_f;
        $objectAfter = $this->sobrenome_passageiro;
       new LogEscrita(get_called_class(), $objectBefore, $objectAfter);
      }
    $this->sobrenome_passageiro = $sobrenome_f;
}
public function set_origem($origem_f){
    if(isset($this->origem_do_voo)){
        $objectBefore = $this->origem_do_voo;
        $this->origem_do_voo = $origem_f;
        $objectAfter = $this->origem_do_voo;
        new LogEscrita(get_called_class(), $objectBefore, $objectAfter);
      }
      else{
        $objectBefore = null;
        $this->origem_do_voo = $origem_f;
        $objectAfter = $this->origem_do_voo;
       new LogEscrita(get_called_class(), $objectBefore, $objectAfter);
      }
   
    $this->origem_do_voo = $origem_f;
}
public function set_destino($destino_f){
    if(isset($this->destino_do_voo)){
        $objectBefore = $this->destino_do_voo;
        $this->destino_do_voo = $destino_f;
        $objectAfter = $this->destino_do_voo;
        new LogEscrita(get_called_class(), $objectBefore, $objectAfter);
      }
      else{
        $objectBefore = null;
        $this->destino_do_voo = $destino_f;
        $objectAfter = $this->destino_do_voo;
       new LogEscrita(get_called_class(), $objectBefore, $objectAfter);
      }
   
    $this->destino_do_voo = $destino_f;
}
public function set_horario_embarque(){
    $segundos=3000;
    $a=$this->get_horario_voo();
    $this->horario_embarque=$a->sub(new DateInterval("PT{$segundos}S"));
}
public function set_horario_viagem($horario_f){
    if(isset($this->horario_viagem)){
        $objectBefore = $this->horario_viagem;
        $this->horario_viagem = $horario_f;
        $objectAfter = $this->horario_viagem;
        new LogEscrita(get_called_class(), $objectBefore, $objectAfter);
      }
      else{
        $objectBefore = null;
        $this->horario_viagem = $horario_f;
        $objectAfter = $this->horario_viagem;
       new LogEscrita(get_called_class(), $objectBefore, $objectAfter);
      }
}
public function set_assento($assento_f){
    if(isset($this->assento)){
        $objectBefore = $this->assento;
        $this->assento = $assento_f;
        $objectAfter = $this->assento;
        new LogEscrita(get_called_class(), $objectBefore, $objectAfter);
      }
      else{
        $objectBefore = null;
        $this->assento = $assento_f;
        $objectAfter = $this->assento;
       new LogEscrita(get_called_class(), $objectBefore, $objectAfter);
      }
   
    $this->assento = $assento_f;
}

public function get_horario_voo(){
    $method = __METHOD__;
    new LogLeitura(get_called_class(), $method);
    return $this->horario_viagem;
}
public function get_passagem(){
    $method = __METHOD__;
    new LogLeitura(get_called_class(), $method);
    return $this->passagem;
}
public function get_nome_passagerio(){
    $method = __METHOD__;
   new LogLeitura(get_called_class(), $method);
    return $this->nome_passageiro;
}
public function get_sobrenome_passageiro(){
    $method = __METHOD__;
   new LogLeitura(get_called_class(), $method);
    return $this->sobrenome_passageiro;
}
public function get_origem(){
    $method = __METHOD__;
   new LogLeitura(get_called_class(), $method);
    return $this->origem_do_voo;
}
public function get_destino(){
    $method = __METHOD__;
   new LogLeitura(get_called_class(), $method);
    return $this->destino_do_voo;
}

public function get_horario_embarque(){
    $method = __METHOD__;
    new LogLeitura(get_called_class(), $method);
    return $this->horario_embarque;
}
public function get_assento(){
    $method = __METHOD__;
    new LogLeitura(get_called_class(), $method);
    return $this->assento;
}
public function string_cartao() : string{
  $a="cartão de embarque impresso para o voo".$this->passagem->get_voo()->get_codigo()."de ".$this->origem_do_voo->get_cidade()."para".$this->destino_do_voo->get_cidade()." em nome do passageiro".$this->nome_passageiro." ".$this->sobrenome_passageiro."\n";
  return $a;
}








}