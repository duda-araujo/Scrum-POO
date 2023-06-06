<?php

include_once("persist.php");
class Aeroporto extends persist{
protected string $sigla;
protected string $cidade;
protected string $estado;
protected string $nome;


public function __construct(string $sigla_f,string $cidade_f,string $estado_f,string $nome_f){
    $this->set_sigla_aero($sigla_f);
    $this->set_cidade($cidade_f);
    $this->set_estado($estado_f);
    $this->set_nome($nome_f);
}

static public function getFilename() {
  return get_called_class();
}
public function gerarLogLeitura($entity, $attribute)
{
    // Implementação do log de leitura específico para Aeroporto
    $log = "User: " . "Usuário" . "\n";
    $dateTime = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
    $log .= "Date/Time: " . $dateTime . "\n";
    $log .= "   Entity: " . $entity . "\n";
    $log .= "   Attribute: " . $attribute . "\n";

    // Salvar o log em um arquivo ou em algum outro meio de armazenamento
    file_put_contents('logLeitura.txt', $log, FILE_APPEND);
}
public function gerarLogEscrita($entity, $objectBefore, $objectAfter){
    // Implementação do log de escrita específico para Aeroporto
    $log = "User: " . "Usuário" . "\n";
    $dateTime = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
    $log .= "Date/Time: " . $dateTime . "\n";
    $log .= "   Entity: " . $entity . "\n";
    $log .= "   Object before: " . $objectBefore . "\n";
    $log .= "   Object after: " . $objectAfter . "\n";

    // Salvar o log em um arquivo ou em algum outro meio de armazenamento
    file_put_contents('logEscrita.txt', $log, FILE_APPEND);
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
  return $this->sigla;
}

public function get_cidade(){
  return $this->cidade;
}

public function get_estado(){
  return $this->estado;
}

public function get_nome_aero(){
  return $this->nome;
}

public function set_sigla_aero(string $sigla_f){
  try{
    if ($this->validar_sigla_aero($sigla_f)){
      $this->sigla = $sigla_f;
    }else{
      throw new Exception("Sigla inválida");
    }
  }catch(Exception $e){
    echo $e->getMessage();
  }
}

public function set_cidade(string $cidade_f) {
  // //try {
  //   if (preg_match('/^[a-zA-Z\s]+$/', $cidade_f)) {
       $this->cidade = $cidade_f;
  //   } else {
  //     throw new Exception("Cidade inválida");
  //   }
  // } catch(Exception $e) {
  //   echo $e->getMessage();
  // }
}

public function set_estado(string $estado_f){
  try{
    if (ctype_alpha($estado_f)){
      $this->estado = $estado_f;
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
      $this->nome = $nome_f;
    }else{
      throw new Exception("Nome inválido");
    }
}
  catch(Exception $e){
    echo $e->getMessage();
  }
}
}