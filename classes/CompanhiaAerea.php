<?php

include_once("Aeronave.php");
include_once("container.php");

class CompanhiaAerea extends persist{

protected string $nome;
protected string $razao_social;
protected string $codigo;
protected string $cnpj;
protected string $sigla;
protected array $avioes;
protected float $preco_bagagem;
protected float $tarifa;
protected array $tripulacao = [];
protected array $comissarios_de_bordo = [];
protected array $pilotos = [];


public function __construct($nome_f,$razao_f,$codigo_f,$cnpj_f,$sigla_f,$preco_bagagem_f,$tarifa_f){
    try{
        if(Sistema::checkSessionState()==FALSE){
            throw new Exception("usuario nao foi inicializado");
        }
        else{
    $this->set_nome_comp($nome_f);
    $this->set_razao($razao_f);
    $this->set_codigo($codigo_f);
    $this->set_cnpj($cnpj_f);
    $this->set_sigla($sigla_f);
    $this->set_preco_bagagem($preco_bagagem_f);
    $this->set_tarifa($tarifa_f);
}
}catch(Exception $e){
    echo $e->getMessage();
}
}

static public function getFilename() {
    return get_called_class();
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
// Deve ser formado por 14 digitos, o codigo ignora pontos, traços e barras
// Retira todos os . / e - do cnpj
    $cnpj_f = str_replace(".", "", $cnpj_f);
    $cnpj_f = str_replace("/", "", $cnpj_f);
    $cnpj_f = str_replace("-", "", $cnpj_f);
    if (ctype_digit($cnpj_f) && strlen($cnpj_f) == 14){
        return true;
    }else{
        return false;
    }
}
public function valida_codigo(){
}

public function get_tarifa(){
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->tarifa;
}

public function get_nome(){
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->nome;
}

public function get_razao(){
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->razao_social;
}

public function get_codigo(){
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->codigo;
}
public function get_cnpj(){
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->cnpj;
}

public function get_sigla(){
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->sigla;
}

public function get_avioes(){
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->avioes;
}

public function get_preco_bagagem(){
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->preco_bagagem;
}
public function get_tripulacao(){
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->tripulacao;
}
public function get_comissarios_de_bordo(){
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->comissarios_de_bordo;
}
public function get_pilotos(){
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->pilotos;
}

public function set_tarifa($tarifa_f){
    try{
    if($tarifa_f<0){
        throw new Exception("Tarifa tem que ser positiva\n");
    }
    else{
        if(isset($this->tarifa)){
            $objectBefore = $this->tarifa;
        }else{
            $objectBefore = null;
        }
        $this->tarifa = $tarifa_f;
        $objectAfter = $this->tarifa;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
        
    }
}catch(Exception $e){
    echo $e->getMessage();
}
}

public function set_nome_comp($nome_f){
    // Deve ser formado apenas por letras e espaços
    try{
        if (ctype_alpha(str_replace(' ', '', $nome_f))){
            if (isset($this->nome)){
                $objectBefore = $this->nome;
                $this->nome = $nome_f;
                $objectAfter = $this->nome;
                new logEscrita(get_called_class(), $objectBefore, $objectAfter);
            }else{
                $objectBefore = null;
                $this->nome = $nome_f;
                $objectAfter = $this->nome;
                new logEscrita(get_called_class(), $objectBefore, $objectAfter);
            }
        }else{
            throw new Exception("Nome inválido");
        }
    } catch(Exception $e){
        echo $e->getMessage();
    }
}

public function set_razao($razao_f){
    try{
        if (is_string($razao_f)){
            if(isset($this->razao_social)){
                $objectBefore = $this->razao_social;
                $this->razao_social = $razao_f;
                $objectAfter = $this->razao_social;
                new logEscrita(get_called_class(), $objectBefore, $objectAfter);
            }else{
                $objectBefore = null;
                $this->razao_social = $razao_f;
                $objectAfter = $this->razao_social;
                new logEscrita(get_called_class(), $objectBefore, $objectAfter);
            }
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
            if(isset($this->codigo)){
                $objectBefore = $this->codigo;
                $this->codigo = $codigo;
                $objectAfter = $this->codigo;
                new logEscrita(get_called_class(), $objectBefore, $objectAfter);
            }else{
                $objectBefore = null;
                $this->codigo = $codigo;
                $objectAfter = $this->codigo;
                new logEscrita(get_called_class(), $objectBefore, $objectAfter);
            }
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
            if(isset($this->cnpj)){
                $objectBefore = $this->cnpj;
                $this->cnpj = $cnpj_f;
                $objectAfter = $this->cnpj;
                new logEscrita(get_called_class(), $objectBefore, $objectAfter);
            }else{
                $objectBefore = null;
                $this->cnpj = $cnpj_f;
                $objectAfter = $this->cnpj;
                new logEscrita(get_called_class(), $objectBefore, $objectAfter);
            }
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
            if(isset($this->sigla)){
                $objectBefore = $this->sigla;
                $this->sigla = $sigla_f;
                $objectAfter = $this->sigla;
                new logEscrita(get_called_class(), $objectBefore, $objectAfter);
            }else{
                $objectBefore = null;
                $this->sigla = $sigla_f;
                $objectAfter = $this->sigla;
                new logEscrita(get_called_class(), $objectBefore, $objectAfter);
            }
        }else{
            throw new Exception("Sigla inválida");
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }
}
public function set_avioes($avioes_f){
    if(isset($this->avioes)){
        $objectBefore = $this->avioes;
        $this->avioes[] = $avioes_f;
        $objectAfter = $this->avioes;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }else{
        $objectBefore = null;
        $this->avioes[] = $avioes_f;
        $objectAfter = $this->avioes;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
}
public function set_preco_bagagem($preco_bagagem_f){
    if(isset($this->preco_bagagem)){
        $objectBefore = $this->preco_bagagem;
    }else{
        $objectBefore = null;
    }
    $this->preco_bagagem = $preco_bagagem_f;
    $objectAfter = $this->preco_bagagem;
    new logEscrita(get_called_class(), $objectBefore, $objectAfter);
}
public function set_tripulacao($tripulacao_f){
    if(isset($tripulacao_f)){
        $objectBefore = $this->tripulacao;
        $this->tripulacao[] = $tripulacao_f;
        $objectAfter = $this->tripulacao;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }else{
        $objectBefore = null;
        $this->tripulacao[] = $tripulacao_f;
        $objectAfter = $this->tripulacao;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
}
public function set_comissario_de_bordo($comissario_de_bordo_f){
    if(isset($comissario_de_bordo_f)){
        $objectBefore = $this->comissarios_de_bordo;
        $this->comissarios_de_bordo[] = $comissario_de_bordo_f;
        $objectAfter = $this->comissarios_de_bordo;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }else{
        $objectBefore = null;
        $this->comissarios_de_bordo[] = $comissario_de_bordo_f;
        $objectAfter = $this->comissarios_de_bordo;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
}
public function set_piloto($piloto_f){
    if(isset($piloto_f)){
        $objectBefore = $this->pilotos;
        $this->pilotos[] = $piloto_f;
        $objectAfter = $this->pilotos;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }else{
        $objectBefore = null;
        $this->pilotos[] = $piloto_f;
        $objectAfter = $this->pilotos;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
}

}
