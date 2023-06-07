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
    if (isset($this->companhiaAerea)){
        $objectBefore = $this->nome;
        $this->companhiaAerea = $companhiaAerea_f;
        $objectAfter = $this->companhiaAerea;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
    else{
        $objectBefore = null;
        $this->companhiaAerea = $companhiaAerea_f;
        $objectAfter = $this->companhiaAerea;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
    $this->companhiaAerea = $companhiaAerea_f;
}
public function get_companhiaAerea(): CompanhiaAerea{
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->companhiaAerea;
}
public function set_Aeroporto_base(Aeroporto $Aeroporto_base_f){
    if (isset($this->Aeroporto_base)){
        $objectBefore = $this->nome;
        $this->Aeroporto_base = $Aeroporto_base_f;
        $objectAfter = $this->Aeroporto_base;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
    else{
        $objectBefore = null;
        $this->Aeroporto_base = $Aeroporto_base_f;
        $objectAfter = $this->Aeroporto_base;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
    $this->Aeroporto_base = $Aeroporto_base_f;
}
public function get_Aeroporto_base(): Aeroporto{
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->Aeroporto_base;
}
public function set_nome($nome_t){
    if (isset($this->nome)){
        $objectBefore = $this->nome;
        $this->nome = $nome_t;
        $objectAfter = $this->nome;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
    else{
        $objectBefore = null;
        $this->nome = $nome_t;
        $objectAfter = $this->nome;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
    $this->nome = $nome_t;
}
public function set_sobrenome($sobrenome_t){
    if (isset($this->sobrenome)){
        $objectBefore = $this->sobrenome;
        $this->sobrenome = $sobrenome_t;
        $objectAfter = $this->sobrenome;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
    else{
        $objectBefore = null;
        $this->sobrenome = $sobrenome_t;
        $objectAfter = $this->sobrenome;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
    $this->sobrenome = $sobrenome_t;
}
public function set_documento($documento_t){
    if (isset($this->documento)){
        $objectBefore = $this->documento;
        $this->documento = $documento_t;
        $objectAfter = $this->documento;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
    else{
        $objectBefore = null;
        $this->documento = $documento_t;
        $objectAfter = $this->documento;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
    $this->documento = $documento_t;
}
public function set_cpf($cpf_t){
    if (isset($this->cpf)){
        $objectBefore = $this->cpf;
        $this->cpf = $cpf_t;
        $objectAfter = $this->cpf;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
    else{
        $objectBefore = null;
        $this->cpf = $cpf_t;
        $objectAfter = $this->cpf;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
    $this->cpf = $cpf_t;
}
public function set_nacionalidade($nacionalidade_t){
    if (isset($this->nacionalidade)){
        $objectBefore = $this->nacionalidade;
        $this->nacionalidade = $nacionalidade_t;
        $objectAfter = $this->nacionalidade;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
    else{
        $objectBefore = null;
        $this->nacionalidade = $nacionalidade_t;
        $objectAfter = $this->nacionalidade;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
    $this->nacionalidade = $nacionalidade_t;
}
public function set_data_nascimento(DateTime $data_nascimento_t){
    if (isset($this->data_nascimento)){
        $objectBefore = $this->data_nascimento;
        $this->data_nascimento = $data_nascimento_t;
        $objectAfter = $this->data_nascimento;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
    else{
        $objectBefore = null;
        $this->data_nascimento = $data_nascimento_t;
        $objectAfter = $this->data_nascimento;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
    $this->data_nascimento = $data_nascimento_t;
}
public function set_email($email_t){
    if (isset($this->email)){
        $objectBefore = $this->email;
        $this->email = $email_t;
        $objectAfter = $this->email;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
    else{
        $objectBefore = null;
        $this->email = $email_t;
        $objectAfter = $this->email;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
    $this->email = $email_t;
}

public function set_cht($cht_t){
    if (isset($this->cht)){
        $objectBefore = $this->cht;
        $this->cht = $cht_t;
        $objectAfter = $this->cht;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
    else{
        $objectBefore = null;
        $this->cht = $cht_t;
        $objectAfter = $this->cht;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
    $this->cht = $cht_t;
}

public function set_logradouro($logradouro_t){
    if (isset($this->logradouro)){
        $objectBefore = $this->logradouro;
        $this->logradouro = $logradouro_t;
        $objectAfter = $this->logradouro;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
    else{
        $objectBefore = null;
        $this->logradouro = $logradouro_t;
        $objectAfter = $this->logradouro;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
    $this->logradouro = $logradouro_t;
}

public function set_numero($numero_t){
    if (isset($this->numero)){
        $objectBefore = $this->numero;
        $this->numero = $numero_t;
        $objectAfter = $this->numero;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
    else{
        $objectBefore = null;
        $this->numero = $numero_t;
        $objectAfter = $this->numero;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
    $this->numero = $numero_t;
}

public function set_bairro($bairro_t){
    if (isset($this->bairro)){
        $objectBefore = $this->bairro;
        $this->bairro = $bairro_t;
        $objectAfter = $this->bairro;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
    else{
        $objectBefore = null;
        $this->bairro = $bairro_t;
        $objectAfter = $this->bairro;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
    $this->bairro = $bairro_t;
}

public function set_cidade($cidade_t){
    if (isset($this->cidade)){
        $objectBefore = $this->cidade;
        $this->cidade = $cidade_t;
        $objectAfter = $this->cidade;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
    else{
        $objectBefore = null;
        $this->cidade = $cidade_t;
        $objectAfter = $this->cidade;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
    $this->cidade = $cidade_t;
}

public function set_estado($estado_f){
    if (isset($this->estado)){
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
    $this->estado = $estado_f;
}
public function set_origem($Aerop_base_f): void {
    try {
        if ($Aerop_base_f instanceof Aeroporto){
            if (isset($this->Aeroporto_base)){
                $objectBefore = $this->Aeroporto_base;
                $this->Aeroporto_base = $Aerop_base_f;
                $objectAfter = $this->Aeroporto_base;
                new logEscrita(get_called_class(), $objectBefore, $objectAfter);
            }
            else{
                $objectBefore = null;
                $this->Aeroporto_base = $Aerop_base_f;
                $objectAfter = $this->Aeroporto_base;
                new logEscrita(get_called_class(), $objectBefore, $objectAfter);
            }
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
            if (isset($this->companhiaAerea)){
                $objectBefore = $this->companhiaAerea;
                $this->companhiaAerea = $companhia_aerea_f;
                $objectAfter = $this->companhiaAerea;
                new logEscrita(get_called_class(), $objectBefore, $objectAfter);
            }
            else{
                $objectBefore = null;
                $this->companhiaAerea = $companhia_aerea_f;
                $objectAfter = $this->companhiaAerea;
                new logEscrita(get_called_class(), $objectBefore, $objectAfter);
            }
            $this->companhiaAerea = $companhia_aerea_f;
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