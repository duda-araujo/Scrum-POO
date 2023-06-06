<?php

include_once("CompanhiaAerea.php");

class Aeronave extends persist{
    
protected string $fabricante;
protected string $modelo;
protected float $carga;
protected int $passageiros;
protected string $registro;
protected CompanhiaAerea $CompanhiaAerea_;


public function __construct($fabricante_f,$modelo_f,$carga_f,$passageiros_f,$registro_f,$companhiaAerea_f){
    $this->set_fabricante($fabricante_f);
    $this->set_modelo($modelo_f);
    $this->set_carga($carga_f);
    $this->set_passageiros($passageiros_f);
    $this->set_registro($registro_f);
    $this->set_companhia($companhiaAerea_f);
    $companhiaAerea_f->set_avioes($this);
}

public function validar_registro($registro_f){
// Composto pelo prefixo, que contém duas letras:
// Um hífen
// Seguido de três letras
// Ex.: PR-GUO)
// No Brasil, somente são permitidos para voos comerciais os
// prefixos PT, PR, PP, PS, que devem ser validados.

    $prefixo = substr($registro_f,0,2);
    $hifen = substr($registro_f,2,1);
    $sufixo = substr($registro_f,3,3);
    if (ctype_alpha($prefixo)==true && $hifen=='-' && ctype_alpha($sufixo)==true && $prefixo=='PT' || $prefixo=='PR' || $prefixo=='PP' || $prefixo=='PS'){
        return true;
    }
    else{
        return false;
    }
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
    $dateTime = (new DateTime('now', new DateTimeZone('America/Sao_Paulo')))->format('Y-m-d H:i:s');;
    $log .= "Date/Time: " . $dateTime . "\n";
    $log .= "   Entity: " . $entity . "\n";
    $log .= "   Object before: " . $objectBefore . "\n";
    $log .= "   Object after: " . $objectAfter . "\n";

    // Salvar o log em um arquivo ou em algum outro meio de armazenamento
    file_put_contents('logEscrita.txt', $log, FILE_APPEND);
}
public function get_fabricante(){
    $attribute = __METHOD__;
    $value = $this->fabricante;
    $this->gerarLogLeitura(get_called_class(), $attribute);
    return $this->fabricante;
}

public function get_modelo(){
    return $this->modelo;
}

public function get_carga(){
    return $this->carga;
}

public function get_passageiro(){
    return $this->passageiros;
}

public function get_registro(){
    return $this->registro;
}

public function get_companhia_aerea(){
    return $this->CompanhiaAerea_;
}

public function set_fabricante($fabricante_f){
    try{
        if (ctype_alpha($fabricante_f)==false){
            throw new Exception("Fabricante inválido");
        }
        else{
            if (isset($this->fabricante)){
                $objectBefore = $this->fabricante;
                $this->fabricante = $fabricante_f;
                $objectAfter = $this->fabricante;
                $this->gerarLogEscrita(get_called_class(), $objectBefore, $objectAfter);
            }
            else{
                $objectBefore = null;
                $this->fabricante = $fabricante_f;
                $objectAfter = $this->fabricante;
                $this->gerarLogEscrita(get_called_class(), $objectBefore, $objectAfter);
            }
        }
    }
    catch(Exception $e){
        echo $e->getMessage();
}}

public function set_modelo($modelo_f){
    //Composto por um prefixo de uma letra
    //Um hifen
    //Seguido de um número de 3 dígitos
    //Modelo (Ex.: A-320
    try{
        $prefixo = substr($modelo_f,0,1);
        $hifen = substr($modelo_f,1,1);
        $sufixo = substr($modelo_f,2,3);
        if (ctype_alpha($prefixo)==false || $hifen!='-' || ctype_digit($sufixo)==false){
            throw new Exception("Modelo inválido");
        }
        else{
            $this->modelo = $modelo_f;
        }
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
}

public function set_carga($carga_f){
    try{
        if (is_numeric($carga_f)==false){
            throw new Exception("Carga inválida");
        }
        else{
            $this->carga = $carga_f;
        }
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
}

public function set_passageiros($passageiro_f){
    try{
        if (is_numeric($passageiro_f)==false){
            throw new Exception("Passageiro inválido");
        }
        else{
            $this->passageiros = $passageiro_f;
        }
    }
    catch(Exception $e){
        echo $e->getMessage();
}}

public function set_registro($registro_f){
    try {
        if ($this->validar_registro($registro_f)==false){
            throw new Exception("Registro inválido");
        }
        else{
            $this->registro = $registro_f;
        }
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
}

public function set_companhia(CompanhiaAerea $companhia_aerea_f){
    try {
        if ($companhia_aerea_f instanceof CompanhiaAerea==false){
            throw new Exception("Companhia Aérea inválida");
        }
        else{
            $this->CompanhiaAerea_ = $companhia_aerea_f;
        }
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
}
};
?>