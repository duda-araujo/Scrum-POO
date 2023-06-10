<?php

include_once("Tripulacao.php");
class Piloto extends Tripulacao{

protected string $nome;
protected string $sobrenome;
protected string $documento;
protected string $cpf;
protected string $nacionalidade;
protected DateTime $data_nascimento;
protected string $email;
protected string $cht;
protected string $logradouro;
protected string $numero;
protected string $bairro;
protected string $cidade;
protected string $estado;
protected CompanhiaAerea $companhiaAerea;
protected Aeroporto $Aeroporto_base;

public function __construct($nome_p,$sobrenome_p,$documento_p,$cpf_p,$nacionalidade_p,DateTime $data_nascimento_p,$email_p,$cht_p,$logradouro_p,$numero_p,$bairro_p,$cidade_p,$estado_p,$Aerop_base_p,$companhiaAerea_p ){
  try{
    if(Sistema::checkSessionState()==FALSE){
        throw new Exception("Usuario não foi inicializado! Não é possível acessar o sistema\n");
    }
    else{
    $this->set_nome($nome_p);
    $this->set_sobrenome($sobrenome_p);
    $this->set_documento($documento_p);
    $this->set_cpf($cpf_p);
    $this->set_nacionalidade($nacionalidade_p);
    $this->set_data_nascimento($data_nascimento_p);
    $this->set_email($email_p);
    $this->set_cht($cht_p);
    $this->set_logradouro($logradouro_p);
    $this->set_numero($numero_p);
    $this->set_bairro($bairro_p);
    $this->set_cidade($cidade_p);
    $this->set_estado($estado_p);
    $this->set_origem($Aerop_base_p);
    $companhiaAerea_p->set_tripulacao($this);
    $companhiaAerea_p->set_piloto($this);
    echo "piloto ".$this->get_nome()." ".$this->get_sobrenome()." cadastrado com sucesso \n";
  }
}catch(Exception $e){
    echo $e->getMessage();
}
}
static public function getFilename() {
    return get_called_class();
  }
public function set_nome($nome_p){
    if(isset($this->nome)){
        $objectBefore = $this->nome;
      }
      else{
        $objectBefore = null;
      }

    $this->nome = $nome_p;
    $objectAfter = $this->nome;
    new LogEscrita(get_called_class(), $objectBefore, $objectAfter);

}
public function set_sobrenome($sobrenome_p){
    if(isset($this->sobrenome)){
        $objectBefore = $this->sobrenome;
      }
      else{
        $objectBefore = null;
      }
    $this->sobrenome = $sobrenome_p;
    $objectAfter = $this->sobrenome;
    new LogEscrita(get_called_class(), $objectBefore, $objectAfter);
}
public function set_documento($documento_p){
    if(isset($this->documento)){
        $objectBefore = $this->documento;
      }
      else{
        $objectBefore = null;
      }

    $this->documento = $documento_p;
    $objectAfter = $this->documento;
    new LogEscrita(get_called_class(), $objectBefore, $objectAfter);
}
public function set_cpf($cpf_p){
    if(isset($this->cpf)){
        $objectBefore = $this->cpf;
      }
      else{
        $objectBefore = null;
      }

    $this->cpf = $cpf_p;
    $objectAfter = $this->cpf;
    new LogEscrita(get_called_class(), $objectBefore, $objectAfter);
}
public function set_nacionalidade($nacionalidade_p){
    if(isset($this->nacionalidade)){
        $objectBefore = $this->nacionalidade;
      }
      else{
        $objectBefore = null;
      }

    $this->nacionalidade = $nacionalidade_p;
    $objectAfter = $this->nacionalidade;
    new LogEscrita(get_called_class(), $objectBefore, $objectAfter);
}
public function set_data_nascimento(DateTime $data_nascimento_p){
    if(isset($this->data_nascimento)){
        $objectBefore = $this->data_nascimento;
      }
      else{
        $objectBefore = null;
      }

    $this->data_nascimento = $data_nascimento_p;
    $objectAfter = $this->data_nascimento;
    new LogEscrita(get_called_class(), $objectBefore, $objectAfter);
}
public function set_email($email_p){
    if(isset($this->email)){
        $objectBefore = $this->email;
      }
      else{
        $objectBefore = null;
      }

    $this->email = $email_p;
    $objectAfter = $this->email;
    new LogEscrita(get_called_class(), $objectBefore, $objectAfter);
}
public function set_cht($cht_p){
    if(isset($this->cht)){
        $objectBefore = $this->cht;
      }
      else{
        $objectBefore = null;
      }

    $this->cht = $cht_p;
    $objectAfter = $this->cht;
    new LogEscrita(get_called_class(), $objectBefore, $objectAfter);
}
public function set_logradouro($logradouro_p){
    if(isset($this->logradouro)){
        $objectBefore = $this->logradouro;
      }
      else{
        $objectBefore = null;
      }

    $this->logradouro = $logradouro_p;
    $objectAfter = $this->logradouro;
    new LogEscrita(get_called_class(), $objectBefore, $objectAfter);
}
public function set_numero($numero_p){
    if(isset($this->numero)){
        $objectBefore = $this->numero;
      }
      else{
        $objectBefore = null;
      }

    $this->numero = $numero_p;
    $objectAfter = $this->numero;
    new LogEscrita(get_called_class(), $objectBefore, $objectAfter);
}
public function set_bairro($bairro_p){
    if(isset($this->bairro)){
        $objectBefore = $this->bairro;
      }
      else{
        $objectBefore = null;
      }

    $this->bairro = $bairro_p;
    $objectAfter = $this->bairro;
    new LogEscrita(get_called_class(), $objectBefore, $objectAfter);
}
public function set_cidade($cidade_p){
    if(isset($this->cidade)){
        $objectBefore = $this->cidade;
      }
      else{
        $objectBefore = null;
      }

    $this->cidade = $cidade_p;
    $objectAfter = $this->cidade;
    new LogEscrita(get_called_class(), $objectBefore, $objectAfter);
}
public function set_estado($estado_p){
    if(isset($this->estado)){
        $objectBefore = $this->estado;
      }
      else{
        $objectBefore = null;
      }

    $this->estado = $estado_p;
    $objectAfter = $this->estado;
    new LogEscrita(get_called_class(), $objectBefore, $objectAfter);
}
public function set_origem($Aerop_base_p): void {
    try {
        if(isset($this->Aeroporto_base)){
            $objectBefore = $this->Aeroporto_base;
          }
          else{
            $objectBefore = null;
          }
        if ($Aerop_base_p instanceof Aeroporto){
            $this->Aeroporto_base = $Aerop_base_p;
            $objectAfter = $this->Aeroporto_base;
            new LogEscrita(get_called_class(), $objectBefore, $objectAfter);
        } else{
            throw new Exception("\nAeroporto base invalido");
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }
}
public function set_companhia(CompanhiaAerea $companhia_aerea_p){
    try {
        if(isset($this->companhiaAerea)){
            $objectBefore = $this->companhiaAerea;
          }
          else{
            $objectBefore = null;
          }

        if ($companhia_aerea_p instanceof CompanhiaAerea==false){
            throw new Exception("Companhia Aérea inválida");
        }
        else{
            $objectAfter = $this->companhiaAerea;
            new LogEscrita(get_called_class(), $objectBefore, $objectAfter);
            $this->companhiaAerea = $companhia_aerea_p;
        }
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
}
public function get_nome(){
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->nome;
}
public function get_sobrenome(){
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->sobrenome;
}
public function get_documento(){
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->documento;
}
public function get_cpf(){
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->cpf;
}
public function get_nacionalidade(){
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->nacionalidade;
}
public function get_data_nascimento(){
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->data_nascimento;
}
public function get_email(){
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->email;
}
public function get_cht(){
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->cht;
}
public function get_logradouro(){
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->logradouro;
}
public function get_numero(){
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->numero;
}
public function get_bairro(){
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->bairro;
}
public function get_cidade(){
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->cidade;
}
public function get_estado(){
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->estado;
}
public function get_aeroporto_origem(): Aeroporto {
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->Aeroporto_base;
}
public function get_companhia_aerea(): CompanhiaAerea {
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->companhiaAerea;
}
















    
}
