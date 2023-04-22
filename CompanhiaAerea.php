<?php

include_once("Aeronave.php");


class CompanhiaAerea{

protected string $nome;
protected string $razao_social;
protected string $codigo;
protected string $cnpj;
protected string $sigla;
protected array $avioes;
protected float $preco_bagagem;

protected float $tarifa;

public function __construct($nome_f,$razao_f,$codigo_f,$cnpj_f,$sigla_f,$preco_bagagem_f,$tarifa_f){
    $this->set_nome_comp($nome_f);
    $this->set_razao($razao_f);
    $this->set_codigo($codigo_f);
    $this->set_cnpj($cnpj_f);
    $this->set_sigla($sigla_f);
    $this->set_preco_bagagem($preco_bagagem_f);
    $this->set_tarifa($tarifa_f);
}

public function valida_sigla_companhia($sigla_f){
// Deve ser formado por 2 letras
    if (ctype_alpha($sigla_f) && strlen($sigla_f) == 2){
        return true;
    }else{
        return false;
    }
}
public function valida_cnpj($cnpj_f){
// Deve ser formado por 14 digitos
    if (ctype_digit($cnpj_f) && strlen($cnpj_f) == 14){
        return true;
    }else{
        return false;
    }
}
public function valida_codigo(){
}

public function get_tarifa(){
    return $this->tarifa;
}

public function get_nome(){
    return $this->nome;
}

public function get_razao(){
    return $this->razao_social;
}

public function get_codigo(){
    return $this->codigo;
}
public function get_cnpj(){
    return $this->cnpj;
}

public function get_sigla(){
    return $this->sigla;
}

public function get_avioes(){
    return $this->avioes;
}

public function get_preco_bagagem(){
    return $this->preco_bagagem;
}

public function set_tarifa($tarifa_f){
    try{
    if($tarifa_f<0){
        throw new Exception("Tarifa tem que ser positiva\n");
    }
    else{
        $this->tarifa=round($tarifa_f,2);
    }
}catch(Exception $e){
    echo $e->getMessage();

}
}

public function set_nome_comp($nome_f){
    try{
        if (ctype_alpha($nome_f)){
            $this->nome = $nome_f;
        }else{
            throw new Exception("Nome inválido");
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }
}

public function set_razao($razao_f){
    try{
        if (is_string($razao_f)){
            $this->razao_social = $razao_f;
        }else{
            throw new Exception("Razão social inválida");
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }
}

public function set_codigo($codigo){
    try{
        if (ctype_digit($codigo)){
            $this->codigo = $codigo;
        }else{
            throw new Exception("Código inválido");
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }
}
public function set_cnpj($cnpj_f){
    try{
        if ($this->valida_cnpj($cnpj_f)){
            $this->cnpj = $cnpj_f;
        }else{
            throw new Exception("CNPJ inválido");
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }
}
public function set_sigla($sigla_f){
    try{
        if ($this->valida_sigla_companhia($sigla_f)){
            $this->sigla = $sigla_f;
        }else{
            throw new Exception("Sigla inválida");
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }
}
public function set_avioes($avioes_f){
    $this->avioes[] = $avioes_f;
}
public function set_preco_bagagem($preco_bagagem_f){
    $this->preco_bagagem = $preco_bagagem_f;
}

}