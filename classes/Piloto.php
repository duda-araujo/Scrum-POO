<?php


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
    $companhiaAerea_p->set_pilotos($this);
}

public function set_nome($nome_p){
    $this->nome = $nome_p;

}
public function set_sobrenome($sobrenome_p){
    $this->sobrenome = $sobrenome_p;
}
public function set_documento($documento_p){
    $this->documento = $documento_p;
}
public function set_cpf($cpf_p){
    $this->cpf = $cpf_p;
}
public function set_nacionalidade($nacionalidade_p){
    $this->nacionalidade = $nacionalidade_p;
}
public function set_data_nascimento(DateTime $data_nascimento_p){
    $this->data_nascimento = $data_nascimento_p;
}
public function set_email($email_p){
    $this->email = $email_p;
}
public function set_cht($cht_p){
    $this->cht = $cht_p;
}
public function set_logradouro($logradouro_p){
    $this->logradouro = $logradouro_p;
}
public function set_numero($numero_p){
    $this->numero = $numero_p;
}
public function set_bairro($bairro_p){
    $this->bairro = $bairro_p;
}
public function set_cidade($cidade_p){
    $this->cidade = $cidade_p;
}
public function set_estado($estado_p){
    $this->estado = $estado_p;
}
public function set_origem($Aerop_base_p): void {
    try {
        if ($Aerop_base_p instanceof Aeroporto){
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
        if ($companhia_aerea_p instanceof CompanhiaAerea==false){
            throw new Exception("Companhia Aérea inválida");
        }
        else{
            $this->companhiaAerea = $companhia_aerea_p;
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
