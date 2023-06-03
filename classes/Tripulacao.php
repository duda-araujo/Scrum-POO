<?php

include_once("CompanhiaAerea.php");
class Tripulacao extends persist{

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

public function __construct($nome_t,$sobrenome_t,$documento_t,$cpf_t,$nacionalidade_t,DateTime $data_nascimento_t,$email_t,$cht_t,$logradouro_t,$numero_t,$bairro_t,$cidade_t,$estado_t,$companhiaAerea_f,$Aerop_base_f){
    $this->set_nome($nome_t);
    $this->set_sobrenome($sobrenome_t);
    $this->set_documento($documento_t);
    $this->set_cpf($cpf_t);
    $this->set_nacionalidade($nacionalidade_t);
    $this->set_data_nascimento($data_nascimento_t);
    $this->set_email($email_t);
    $this->set_cht($cht_t);
    $this->set_logradouro($logradouro_t);
    $this->set_numero($numero_t);
    $this->set_bairro($bairro_t);
    $this->set_cidade($cidade_t);
    $this->set_estado($estado_t);
    $this->set_origem($Aerop_base_f);
    $this->set_companhiaAerea($companhiaAerea_f);
    $this->set_Aeroporto_base($Aerop_base_f);
    $this-> companhiaAerea->set_tripulacao($this);
    
}
static public function getFilename() {
    return get_called_class();
  }
public function set_companhiaAerea(CompanhiaAerea $companhiaAerea_f){
    $this->companhiaAerea = $companhiaAerea_f;
}
public function get_companhiaAerea(): CompanhiaAerea{
    return $this->companhiaAerea;
}
public function set_Aeroporto_base(Aeroporto $Aeroporto_base_f){
    $this->Aeroporto_base = $Aeroporto_base_f;
}
public function get_Aeroporto_base(): Aeroporto{
    return $this->Aeroporto_base;
}
public function set_nome($nome_t){
    $this->nome = $nome_t;
}
public function set_sobrenome($sobrenome_t){
    $this->sobrenome = $sobrenome_t;
}
public function set_documento($documento_t){
    $this->documento = $documento_t;
}
public function set_cpf($cpf_t){
    $this->cpf = $cpf_t;
}
public function set_nacionalidade($nacionalidade_t){
    $this->nacionalidade = $nacionalidade_t;
}
public function set_data_nascimento(DateTime $data_nascimento_t){
    $this->data_nascimento = $data_nascimento_t;
}
public function set_email($email_t){
    $this->email = $email_t;
}

public function set_cht($cht_t){
    $this->cht = $cht_t;
}

public function set_logradouro($logradouro_t){
    $this->logradouro = $logradouro_t;
}

public function set_numero($numero_t){
    $this->numero = $numero_t;
}

public function set_bairro($bairro_t){
    $this->bairro = $bairro_t;
}

public function set_cidade($cidade_t){
    $this->cidade = $cidade_t;
}

public function set_estado($estado_t){
    $this->estado = $estado_t;
}
public function set_origem($Aerop_base_f): void {
    try {
        if ($Aerop_base_f instanceof Aeroporto){
            $this->Aeroporto_base = $Aerop_base_f;
        } else{
            throw new Exception("\nAeroporto base invalido");
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }
}
public function set_companhia(CompanhiaAerea $companhia_aerea_f){
    try {
        if ($companhia_aerea_f instanceof CompanhiaAerea==false){
            throw new Exception("Companhia Aérea inválida");
        }
        else{
            $this->companhiaAerea = $companhia_aerea_f;
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