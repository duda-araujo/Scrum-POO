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
    if(isset($this->nome)){
        $objectBefore = $this->nome;
        $this->nome = $nome_c;
        $objectAfter = $nome_c;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }else{
        $objectBefore = null;
        $this->nome = $nome_c;
        $objectAfter = $nome_c;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }

}
public function set_sobrenome($sobrenome_c){
    if(isset($this->sobrenome)){
        $objectBefore = $this->sobrenome;
        $this->sobrenome = $sobrenome_c;
        $objectAfter = $sobrenome_c;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }else{
        $objectBefore = null;
        $this->sobrenome = $sobrenome_c;
        $objectAfter = $sobrenome_c;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }

}
public function set_documento($documento_c){
    if(isset($this->documento)){
        $objectBefore = $this->documento;
        $this->documento = $documento_c;
        $objectAfter = $documento_c;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }else{
        $objectBefore = null;
        $this->documento = $documento_c;
        $objectAfter = $documento_c;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }

}
public function set_cpf($cpf_c){
    if(isset($this->cpf)){
        $objectBefore = $this->cpf;
        $this->cpf = $cpf_c;
        $objectAfter = $cpf_c;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }else{
        $objectBefore = null;
        $this->cpf = $cpf_c;
        $objectAfter = $cpf_c;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }

}
public function set_nacionalidade($nacionalidade_c){
    if(isset($this->nacionalidade)){
        $objectBefore = $this->nacionalidade;
        $this->nacionalidade = $nacionalidade_c;
        $objectAfter = $nacionalidade_c;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }else{
        $objectBefore = null;
        $this->nacionalidade = $nacionalidade_c;
        $objectAfter = $nacionalidade_c;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }

}
public function set_data_nascimento(DateTime $data_nascimento_c){
    if(isset($this->data_nascimento)){
        $objectBefore = $this->data_nascimento;
        $this->data_nascimento = $data_nascimento_c;
        $objectAfter = $data_nascimento_c;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }else{
        $objectBefore = null;
        $this->data_nascimento = $data_nascimento_c;
        $objectAfter = $data_nascimento_c;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
}
public function set_email($email_c){
    if(isset($this->email)){
        $objectBefore = $this->email;
        $this->email = $email_c;
        $objectAfter = $email_c;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }else{
        $objectBefore = null;
        $this->email = $email_c;
        $objectAfter = $email_c;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
}
public function set_cht($cht_c){
    if(isset($this->cht)){
        $objectBefore = $this->cht;
        $this->cht = $cht_c;
        $objectAfter = $cht_c;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }else{
        $objectBefore = null;
        $this->cht = $cht_c;
        $objectAfter = $cht_c;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
}
public function set_logradouro($logradouro_c){
    if(isset($this->logradouro)){
        $objectBefore = $this->logradouro;
        $this->logradouro = $logradouro_c;
        $objectAfter = $logradouro_c;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }else{
        $objectBefore = null;
        $this->logradouro = $logradouro_c;
        $objectAfter = $logradouro_c;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
}
public function set_numero($numero_c){
    if(isset($this->numero)){
        $objectBefore = $this->numero;
        $this->numero = $numero_c;
        $objectAfter = $numero_c;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }else{
        $objectBefore = null;
        $this->numero = $numero_c;
        $objectAfter = $numero_c;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
}
public function set_bairro($bairro_c){
    if(isset($this->bairro)){
        $objectBefore = $this->bairro;
        $this->bairro = $bairro_c;
        $objectAfter = $bairro_c;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }else{
        $objectBefore = null;
        $this->bairro = $bairro_c;
        $objectAfter = $bairro_c;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
}
public function set_cidade($cidade_c){
    if(isset($this->cidade)){
        $objectBefore = $this->cidade;
        $this->cidade = $cidade_c;
        $objectAfter = $cidade_c;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }else{
        $objectBefore = null;
        $this->cidade = $cidade_c;
        $objectAfter = $cidade_c;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
}
public function set_estado($estado_c){
    if(isset($this->estado)){
        $objectBefore = $this->estado;
        $this->estado = $estado_c;
        $objectAfter = $estado_c;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }else{
        $objectBefore = null;
        $this->estado = $estado_c;
        $objectAfter = $estado_c;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
}
public function set_origem($Aerop_base_c): void {
    try {
        if ($Aerop_base_c instanceof Aeroporto){
            if(isset($this->Aeroporto_base)){
                $objectBefore = $this->Aeroporto_base;
                $this->Aeroporto_base = $Aerop_base_c;
                $objectAfter = $Aerop_base_c;
                new logEscrita(get_called_class(), $objectBefore, $objectAfter);
            }else{
                $objectBefore = null;
                $this->Aeroporto_base = $Aerop_base_c;
                $objectAfter = $Aerop_base_c;
                new logEscrita(get_called_class(), $objectBefore, $objectAfter);
            }
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
            if(isset($this->companhiaAerea)){
                $objectBefore = $this->companhiaAerea;
                $this->companhiaAerea = $companhia_aerea_c;
                $objectAfter = $companhia_aerea_c;
                new logEscrita(get_called_class(), $objectBefore, $objectAfter);
            }else{
                $objectBefore = null;
                $this->companhiaAerea = $companhia_aerea_c;
                $objectAfter = $companhia_aerea_c;
                new logEscrita(get_called_class(), $objectBefore, $objectAfter);
            }
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