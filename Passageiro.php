<?php

class Passageiro{
   protected string $nome_passageiro;
    protected string $sobrenome_passageiro;
    protected string $documento_passageiro;
    protected string $nacionalidade;
    protected string $cpf;
    protected DateTime $data_de_nascimento;
    protected string $email;
    protected int $numero_bagagens;
    
    
public function __construct($nome_p, $sobrenome_p, $documento_p, $nbagagens_p, $nacionalidade_p, $cpf_p, $data_de_nascimento_p, $data_atual_p, $email_p){
    $this->set_nome_passeiro($nome_p);
    $this->set_sobrenome_passageiro($sobrenome_p);
    $this->set_documento_passageiro($documento_p);
    $this->set_numero_bagagens($nbagagens_p);
    $this->set_nacionalidade($nacionalidade_p);
    $this->set_cpf($cpf_p);
    $this->set_data_de_nascimento($data_de_nascimento_p, $data_atual_p);
    $this->set_email($email_p);

}
public function set_nome_passeiro($nome_p){
    $this->nome_passageiro = $nome_p;
}
public function set_sobrenome_passageiro($sobrenome_f){
    $this->sobrenome_passageiro = $sobrenome_f;
}
public function set_documento_passageiro($documento_f){
    $this->documento_passageiro = $documento_f;
}
public function set_numero_bagagens($numero_bagagens_f){
    $this->numero_bagagens = $numero_bagagens_f;
}
public function set_nacionalidade($nacionalidade_f) {
    $this->nacionalidade = $nacionalidade_f;
}
public function set_data_de_nascimento($data_de_nascimento_f, $data_atual_f) {
    $dia = $data_de_nascimento_f->format("d");
    $mes = $data_de_nascimento_f->format("m");
    $ano = $data_de_nascimento_f->format("Y");

    try {
        if($data_de_nascimento_f instanceof DateTime) { //valida formatação
            if (checkdate($mes, $dia, $ano)) { //valida numeros
                if( $data_de_nascimento_f < $data_atual_f) { //valida se é uma data anterior ao dia atual
                    $this->data_de_nascimento = $data_de_nascimento_f;
                }
                else {
                    throw new InvalidArgumentException("\nErro: Data de nascimento inválida ");
                }
            } 
        }      
    } catch (InvalidArgumentException $e) {
        echo $e->getMessage();
    }
    
}
public function set_cpf($cpf_f) {
    if($this->nacionalidade == "brasileiro" || $this->nacionalidade == "brasileira"){
        try {
            if($this->valida_cpf($cpf_f)) {
                $this->cpf = $cpf_f;
            }
            else {
                throw new InvalidArgumentException("\nErro: CPF inválido ");
            }
        } catch (InvalidArgumentException $e) {
            echo $e->getMessage();
        }
    }
    else {
        $this->cpf = "";
    }
}
public function valida_cpf($cpf_f) {
    //valida formataçao
    if(preg_match("/^[0-9]{3}\.[0-9]{3}\.[0-9]{3}\-[0-9]{2}$/", $cpf_f) == false) {
        return false;
    }
    //extrai somente os números
    $cpf_numeros = str_replace(['.','-'],"",$cpf_f);

     // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
     if (preg_match('/(\d)\1{10}/', $cpf_numeros)) {
        return false;
    }

    // Faz o calculo para validar o CPF
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf_numeros[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf_numeros[$c] != $d) {
            return false;
        }
    }

    return true;
}
public function set_email($email_f) {
    try {
        if(filter_var($email_f, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email_f;
        }
        else {
            throw new InvalidArgumentException("\nErro: email inválido ");
        }
    } catch (InvalidArgumentException $e) {
        echo $e->getMessage();
    }
    
}
public function get_nome_passageiro(){
    return $this->nome_passageiro;
}
public function get_sobrenome_passageiro(){
    return $this->sobrenome_passageiro;
}
public function get_documento_passageiro(){
    return $this->documento_passageiro;
}
public function get_nbagagens(){
    return $this->numero_bagagens;
}
public function get_nacionalidade() {
    return $this->nacionalidade;
}
public function get_cpf() {
    return $this->cpf;
}
public function get_data_de_nascimento() {
    return $this->data_de_nascimento;
}
public function get_email() {
    return $this->email;
}
}
    