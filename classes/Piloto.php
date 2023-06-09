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
}
static public function getFilename() {
    return get_called_class();
  }
public function set_nome($nome_p){
    $objectBefore = $this->nome;
    $this->nome = $nome_p;
    $objectAfter = $this->nome;
    new LogEscrita(get_called_class(), $objectBefore, $objectAfter);

}
public function set_sobrenome($sobrenome_p){
    $objectBefore = $this->sobrenome;
    $this->sobrenome = $sobrenome_p;
    $objectAfter = $this->sobrenome;
    new LogEscrita(get_called_class(), $objectBefore, $objectAfter);
}
public function set_documento($documento_p){
    $objectBefore = $this->documento;
    $this->documento = $documento_p;
    $objectAfter = $this->documento;
    new LogEscrita(get_called_class(), $objectBefore, $objectAfter);
}
public function set_cpf($cpf_p){
    $objectBefore = $this->cpf;
    $this->cpf = $cpf_p;
    $objectAfter = $this->cpf;
    new LogEscrita(get_called_class(), $objectBefore, $objectAfter);
}
public function set_nacionalidade($nacionalidade_p){
    $objectBefore = $this->nacionalidade;
    $this->nacionalidade = $nacionalidade_p;
    $objectAfter = $this->nacionalidade;
    new LogEscrita(get_called_class(), $objectBefore, $objectAfter);
}
public function set_data_nascimento(DateTime $data_nascimento_p){
    $objectBefore = $this->data_nascimento;
    $this->data_nascimento = $data_nascimento_p;
    $objectAfter = $this->data_nascimento;
    new LogEscrita(get_called_class(), $objectBefore, $objectAfter);
}
public function set_email($email_p){
    $objectBefore = $this->email;
    $this->email = $email_p;
    $objectAfter = $this->email;
    new LogEscrita(get_called_class(), $objectBefore, $objectAfter);
}
public function set_cht($cht_p){
    $objectBefore = $this->cht;
    $this->cht = $cht_p;
    $objectAfter = $this->cht;
    new LogEscrita(get_called_class(), $objectBefore, $objectAfter);
}
public function set_logradouro($logradouro_p){
    $objectBefore = $this->logradouro;
    $this->logradouro = $logradouro_p;
    $objectAfter = $this->logradouro;
    new LogEscrita(get_called_class(), $objectBefore, $objectAfter);
}
public function set_numero($numero_p){
    $objectBefore = $this->numero;
    $this->numero = $numero_p;
    $objectAfter = $this->numero;
    new LogEscrita(get_called_class(), $objectBefore, $objectAfter);
}
public function set_bairro($bairro_p){
    $objectBefore = $this->bairro;
    $this->bairro = $bairro_p;
    $objectAfter = $this->bairro;
    new LogEscrita(get_called_class(), $objectBefore, $objectAfter);
}
public function set_cidade($cidade_p){
    $objectBefore = $this->cidade;
    $this->cidade = $cidade_p;
    $objectAfter = $this->cidade;
    new LogEscrita(get_called_class(), $objectBefore, $objectAfter);
}
public function set_estado($estado_p){
    $objectBefore = $this->estado;
    $this->estado = $estado_p;
    $objectAfter = $this->estado;
    new LogEscrita(get_called_class(), $objectBefore, $objectAfter);
}
public function set_origem($Aerop_base_p): void {
    try {
        $objectBefore = $this->Aeroporto_base;
        if ($Aerop_base_p instanceof Aeroporto){
            $objectAfter = $this->Aeroporto_base;
            new LogEscrita(get_called_class(), $objectBefore, $objectAfter);
            $this->Aeroporto_base = $Aerop_base_p;
        } else{
            throw new Exception("\nAeroporto base invalido");
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }
}
public function set_companhia(CompanhiaAerea $companhia_aerea_p){
    try {
        $objectBefore = $this->companhiaAerea;
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
