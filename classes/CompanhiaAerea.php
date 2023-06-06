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
    $this->set_nome_comp($nome_f);
    $this->set_razao($razao_f);
    $this->set_codigo($codigo_f);
    $this->set_cnpj($cnpj_f);
    $this->set_sigla($sigla_f);
    $this->set_preco_bagagem($preco_bagagem_f);
    $this->set_tarifa($tarifa_f);
}

static public function getFilename() {
    return get_called_class();
}
public function gerarLogLeitura($entity, $attribute)
{
    // Implementação do log de leitura específico para Aeroporto
    $log = "User: " . "Usuário" . "\n";
    $dateTime = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
    $log .= "Date/Time: " . $dateTime . "\n";
    $log .= "   Entity: " . $entity . "\n";
    $log .= "   Attribute: " . $attribute . "\n";

    // Salvar o log em um arquivo ou em algum outro meio de armazenamento
    file_put_contents('logLeitura.txt', $log, FILE_APPEND);
}
public function gerarLogEscrita($entity, $objectBefore, $objectAfter){
    // Implementação do log de escrita específico para Aeroporto
    $log = "User: " . "Usuário" . "\n";
    $dateTime = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
    $log .= "Date/Time: " . $dateTime . "\n";
    $log .= "   Entity: " . $entity . "\n";
    $log .= "   Object before: " . $objectBefore . "\n";
    $log .= "   Object after: " . $objectAfter . "\n";

    // Salvar o log em um arquivo ou em algum outro meio de armazenamento
    file_put_contents('logEscrita.txt', $log, FILE_APPEND);
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
public function get_tripulacao(){
    return $this->tripulacao;
}
public function get_comissarios_de_bordo(){
    return $this->comissarios_de_bordo;
}
public function get_pilotos(){
    return $this->pilotos;
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
    // Deve ser formado apenas por letras e espaços
    try{
        if (ctype_alpha(str_replace(' ', '', $nome_f))){
            $this->nome = $nome_f;
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
public function set_tripulacao($tripulacao_f){
    $this->tripulacao[] = $tripulacao_f;
}
public function set_comissario_de_bordo($comissario_de_bordo_f){
    $this->comissarios_de_bordo[] = $comissario_de_bordo_f;
}
public function set_piloto($piloto_f){
    $this->pilotos[] = $piloto_f;
}

}
