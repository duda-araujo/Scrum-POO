<?php

include_once("Tripulacao.php");
include_once("CompanhiaAerea.php");

class ComissarioDeBordo extends Tripulacao{

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

public function __construct($nome_c,$sobrenome_c,$documento_c,$cpf_c,$nacionalidade_c,DateTime $data_nascimento_c,$email_c,$cht_c,$logradouro_c,$numero_c,$bairro_c,$cidade_c,$estado_c,$Aerop_base_c,$companhiaAerea_c ){
    $this->set_nome($nome_c);
    $this->set_sobrenome($sobrenome_c);
    $this->set_documento($documento_c);
    $this->set_cpf($cpf_c);
    $this->set_nacionalidade($nacionalidade_c);
    $this->set_data_nascimento($data_nascimento_c);
    $this->set_email($email_c);
    $this->set_cht($cht_c);
    $this->set_logradouro($logradouro_c);
    $this->set_numero($numero_c);
    $this->set_bairro($bairro_c);
    $this->set_cidade($cidade_c);
    $this->set_estado($estado_c);
    $this->set_origem($Aerop_base_c);
    $companhiaAerea_c->set_tripulacao($this);
    $companhiaAerea_c->set_comissarios_de_bordo($this);
}
static public function getFilename() {
  return get_called_class();
}

public function set_nome($nome_c){
    $this->nome = $nome_c;

}
public function set_sobrenome($sobrenome_c){
    $this->sobrenome = $sobrenome_c;
}
public function set_documento($documento_c){
    $this->documento = $documento_c;
}
public function set_cpf($cpf_c){
    $this->cpf = $cpf_c;
}
public function set_nacionalidade($nacionalidade_c){
    $this->nacionalidade = $nacionalidade_c;
}
public function set_data_nascimento(DateTime $data_nascimento_c){
    $this->data_nascimento = $data_nascimento_c;
}
public function set_email($email_c){
    $this->email = $email_c;
}
public function set_cht($cht_c){
    $this->cht = $cht_c;
}
public function set_logradouro($logradouro_c){
    $this->logradouro = $logradouro_c;
}
public function set_numero($numero_c){
    $this->numero = $numero_c;
}
public function set_bairro($bairro_c){
    $this->bairro = $bairro_c;
}
public function set_cidade($cidade_c){
    $this->cidade = $cidade_c;
}
public function set_estado($estado_c){
    $this->estado = $estado_c;
}
public function set_origem($Aerop_base_c): void {
    try {
        if ($Aerop_base_c instanceof Aeroporto){
            $this->Aeroporto_base = $Aerop_base_c;
        } else{
            throw new Exception("\nAeroporto base invalido");
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }
}
public function set_companhia(CompanhiaAerea $companhia_aerea_c){
    try {
        if ($companhia_aerea_c instanceof CompanhiaAerea==false){
            throw new Exception("Companhia Aérea inválida");
        }
        else{
            $this->companhiaAerea = $companhia_aerea_c;
        }
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
}
public function get_nome(){
    return $this->nome;
}
public function get_sobrenome(){
    return $this->sobrenome;
}
public function get_documento(){
    return $this->documento;
}
public function get_cpf(){
    return $this->cpf;
}
public function get_nacionalidade(){
    return $this->nacionalidade;
}
public function get_data_nascimento(){
    return $this->data_nascimento;
}
public function get_email(){
    return $this->email;
}
public function get_cht(){
    return $this->cht;
}
public function get_logradouro(){
    return $this->logradouro;
}
public function get_numero(){
    return $this->numero;
}
public function get_bairro(){
    return $this->bairro;
}
public function get_cidade(){
    return $this->cidade;
}
public function get_estado(){
    return $this->estado;
}
public function get_aeroporto_origem(): Aeroporto {
    return $this->Aeroporto_base;
}
public function get_companhia_aerea(): CompanhiaAerea {
    return $this->companhiaAerea;
}

}