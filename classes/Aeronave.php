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
    try{
    if(Sistema::checkSessionState()==FALSE){
        throw new Exception("usuario nao foi inicializado");
    }
    else{
    
    $this->set_fabricante($fabricante_f);
    $this->set_modelo($modelo_f);
    $this->set_carga($carga_f);
    $this->set_passageiros($passageiros_f);
    $this->set_registro($registro_f);
    $this->set_companhia($companhiaAerea_f);
    $companhiaAerea_f->set_avioes($this);
    echo "\nAeronave " . $this->get_registro() . " da Companhia Aérea " . $this->get_companhia_aerea()->get_nome() . " cadastrada com sucesso!\n";
    }
    }catch(Exception $e){
        echo $e->getMessage();
    }
}
public function validar_registro($registro_f) {
    $prefixo = substr($registro_f, 0, 2);
    $hifen = substr($registro_f, 2, 1);
    $sufixo = substr($registro_f, 3, 3);
  
    if (ctype_alpha($prefixo) && $hifen == '-' && ctype_alpha(str_replace(' ', '', $sufixo)) &&
        ($prefixo == 'PT' || $prefixo == 'PR' || $prefixo == 'PP' || $prefixo == 'PS')) {
        return $registro_f;
    } else {
        $prefixo_corrigido = "PP";
        $registro_corrigido = strtoupper($prefixo_corrigido) . '-' . strtoupper($sufixo);
        echo "\nRegistro inválido, corrigido para: " . $registro_corrigido . "\n";
        return $registro_corrigido;
    }
}

static public function getFilename() {
    return get_called_class();
}

public function get_fabricante(){
    $attribute = __METHOD__;
    new logLeitura(get_called_class() ,$attribute);
    return $this->fabricante;
}

public function get_modelo(){
    $attribute = __METHOD__;
    new logLeitura(get_called_class() ,$attribute);
    return $this->modelo;
}

public function get_carga(){
    $attribute = __METHOD__;
    new logLeitura(get_called_class() ,$attribute);
    return $this->carga;
}

public function get_passageiro(){
    $attribute = __METHOD__;
    new logLeitura(get_called_class() ,$attribute);
    return $this->passageiros;
}

public function get_registro(){
    $attribute = __METHOD__;
    new logLeitura(get_called_class() ,$attribute);
    return $this->registro;
}

public function get_companhia_aerea(){
    $attribute = __METHOD__;
    new logLeitura(get_called_class() ,$attribute);
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
                new logEscrita(get_called_class(), $objectBefore, $objectAfter);
            }
            else{
                $objectBefore = null;
                $this->fabricante = $fabricante_f;
                $objectAfter = $this->fabricante;
                new logEscrita(get_called_class(), $objectBefore, $objectAfter);
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
            if(isset($this->modelo)){
                $objectBefore = $this->modelo;
                $this->modelo = $modelo_f;
                $objectAfter = $this->modelo;
                new logEscrita(get_called_class(), $objectBefore, $objectAfter);
            }
            else{
                $objectBefore = null;
                $this->modelo = $modelo_f;
                $objectAfter = $this->modelo;
                new logEscrita(get_called_class(), $objectBefore, $objectAfter);
            }
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
            if (isset($this->carga)){
                $objectBefore = $this->carga;
                $this->carga = $carga_f;
                $objectAfter = $this->carga;
                new logEscrita(get_called_class(), $objectBefore, $objectAfter);
            }
            else{
                $objectBefore = null;
                $this->carga = $carga_f;
                $objectAfter = $this->carga;
                new logEscrita(get_called_class(), $objectBefore, $objectAfter);
            }
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
            if (isset($this->passageiros)){
                $objectBefore = $this->passageiros;
                $this->passageiros = $passageiro_f;
                $objectAfter = $this->passageiros;
                new logEscrita(get_called_class(), $objectBefore, $objectAfter);
            }
            else{
                $objectBefore = null;
                $this->passageiros = $passageiro_f;
                $objectAfter = $this->passageiros;
                new logEscrita(get_called_class(), $objectBefore, $objectAfter);
            }
        }
    }
    catch(Exception $e){
        echo $e->getMessage();
}}
public function set_registro($registro_f) {
    if (isset($this->registro)){
        $objectBefore = $this->registro;
        $this->registro = $this->validar_registro($registro_f);
        $objectAfter = $this->registro;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
    else{
        $objectBefore = null;
        $this->registro = $this->validar_registro($registro_f);
        $objectAfter = $this->registro;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }   
}

public function set_companhia(CompanhiaAerea $companhia_aerea_f){
    try {
        if ($companhia_aerea_f instanceof CompanhiaAerea==false){
            throw new Exception("Companhia Aérea inválida");
        }
        else{
            if (isset($this->CompanhiaAerea_)){
                $objectBefore = $this->CompanhiaAerea_;
                $this->CompanhiaAerea_ = $companhia_aerea_f;
                $objectAfter = $this->CompanhiaAerea_;
                new logEscrita(get_called_class(), $objectBefore, $objectAfter);
            }
            else{
                $objectBefore = null;
                $this->CompanhiaAerea_ = $companhia_aerea_f;
                $objectAfter = $this->CompanhiaAerea_;
                new logEscrita(get_called_class(), $objectBefore, $objectAfter);
            }
        }
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
}
};
?>