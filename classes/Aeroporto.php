<?php

include_once("persist.php");
class Aeroporto extends persist{
protected string $sigla;
protected string $cidade;
protected string $estado;
protected string $nome;


public function __construct(string $sigla_f,string $cidade_f,string $estado_f,string $nome_f){
  try{
    if(Sistema::checkSessionState()==FALSE){
        throw new Exception("Usuario não foi inicializado! Não é possível acessar o sistema\n");
    }
    else{
    $this->set_sigla_aero($sigla_f);
    $this->set_cidade($cidade_f);
    $this->set_estado($estado_f);
    $this->set_nome($nome_f);
    echo "\n" .  $this->get_nome_aero() . " cadastrado com sucesso!\n";
  }
}catch(Exception $e){
    echo $e->getMessage();
}
}

static public function getFilename() {
  return get_called_class();
}
public function validar_sigla_aero(string $sigla_s){
//A sigla deve ser formada por três letras
    if (ctype_alpha($sigla_s) && strlen($sigla_s) == 3){
        return true;
    }else{
        return false;
    }
}
public function get_sigla_aero(){
  $method = __METHOD__;
  new logLeitura(get_called_class() ,$method);
  return $this->sigla;
}

public function get_cidade(){
  $method = __METHOD__;
  new logLeitura(get_called_class() ,$method);
  return $this->cidade;
}

public function get_estado(){
  $method = __METHOD__;
  new logLeitura(get_called_class() ,$method);
  return $this->estado;
}

public function get_nome_aero(){
  $method = __METHOD__;
  new logLeitura(get_called_class() ,$method);
  return $this->nome;
}

public function set_sigla_aero(string $sigla_f){
  try{
    if ($this->validar_sigla_aero($sigla_f)){
      if(isset($this->sigla)){
        $objectBefore = $this->sigla;
        $this->sigla = $sigla_f;
        $objectAfter = $this->sigla;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
      }
      else{
        $objectBefore = null;
        $this->sigla = $sigla_f;
        $objectAfter = $this->sigla;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
      }
    }else{
      throw new Exception("Sigla inválida");
    }
  }catch(Exception $e){
    echo $e->getMessage();
  }
}

public function set_cidade(string $cidade_f) {
  if(isset($this->cidade)){
    $objectBefore = $this->cidade;
    $this->cidade = $cidade_f;
    $objectAfter = $this->cidade;
    new logEscrita(get_called_class(), $objectBefore, $objectAfter);
  }
  else{
    $objectBefore = null;
    $this->cidade = $cidade_f;
    $objectAfter = $this->cidade;
    new logEscrita(get_called_class(), $objectBefore, $objectAfter);
  }
}

public function set_estado(string $estado_f){
  try{
    if (ctype_alpha($estado_f)){
      if(isset($this->estado)){
        $objectBefore = $this->estado;
        $this->estado = $estado_f;
        $objectAfter = $this->estado;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
      }
      else{
        $objectBefore = null;
        $this->estado = $estado_f;
        $objectAfter = $this->estado;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
      }
    }else{
      throw new Exception("Estado inválido");
    }
  }catch(Exception $e){
    echo $e->getMessage();
  }
}

public function set_nome(string $nome_f){
  try{
    if (is_string($nome_f)){
      if(isset($this->nome)){
        $objectBefore = $this->nome;
        $this->nome = $nome_f;
        $objectAfter = $this->nome;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
      }
      else{
        $objectBefore = null;
        $this->nome = $nome_f;
        $objectAfter = $this->nome;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
      }
    }else{
      throw new Exception("Nome inválido");
    }
}
  catch(Exception $e){
    echo $e->getMessage();
  }
}
}