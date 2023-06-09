<?php

include_once("ProgramaDeMilhagem.php");

class Categorias extends persist{
    protected ProgramaDeMilhagem $programa_de_milhagem;
    protected string $nome;
    protected float $pontos_exigidos;
    public function __construct($programa_de_milhagem_f, $nome_f, $pontos_exigidos_f){
        try{
            if(Sistema::checkSessionState()==FALSE){
                throw new Exception("usuario nao foi inicializado");
            }
            else{
        $this->set_milhagem($programa_de_milhagem_f);
        $this->set_nome($nome_f);
        $this->set_pontos($pontos_exigidos_f);
    }
}catch(Exception $e){
    echo $e->getMessage();
}
    }
    static public function getFilename() {
        return get_called_class();
      }
    public function set_milhagem($programa_de_milhagem_f){
        if (isset($this->programa_de_milhagem)){
            $objectBefore = $this->programa_de_milhagem;
            $this->programa_de_milhagem = $programa_de_milhagem_f;
            $objectAfter = $this->programa_de_milhagem;
            new logEscrita(get_called_class(), $objectBefore, $objectAfter);
        }else{
            $objectBefore = null;
            $this->programa_de_milhagem = $programa_de_milhagem_f;
            $objectAfter = $this->programa_de_milhagem;
            new logEscrita(get_called_class(), $objectBefore, $objectAfter);
        }
    }
    public function set_nome($nome_f){
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
    }
    public function set_pontos($pontos_exigidos_f){
        if (isset($this->pontos_exigidos)){
            $objectBefore = $this->pontos_exigidos;
            $this->pontos_exigidos = $pontos_exigidos_f;
            $objectAfter = $this->pontos_exigidos;
            new logEscrita(get_called_class(), $objectBefore, $objectAfter);
        }else{
            $objectBefore = null;
            $this->pontos_exigidos = $pontos_exigidos_f;
            $objectAfter = $this->pontos_exigidos;
            new logEscrita(get_called_class(), $objectBefore, $objectAfter);
        }
    }
    public function get_milhagem(){
        $method = __METHOD__;
        new logLeitura(get_called_class() ,$method);
        return $this->programa_de_milhagem;
    }
    public function get_nome(){
        $method = __METHOD__;
        new logLeitura(get_called_class() ,$method);
        return $this->nome;
    }
    public function get_pontos(){
        $method = __METHOD__;
        new logLeitura(get_called_class() ,$method);
        return $this->pontos_exigidos;
    }
}