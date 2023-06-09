<?php

include_once("CompanhiaAerea.php");

class Veiculo extends persist{
    protected CompanhiaAerea $companhia;
    protected Aeroporto $aeroporto;
    protected string $modelo;
    protected int $capacidade;
    protected int $velocidade_media = 18;
    public function __construct(CompanhiaAerea $companhia_f, Aeroporto $aeroporto_f, string $modelo_f, int $capacidade_f){
        try{
            if(Sistema::checkSessionState()==FALSE){
                throw new Exception("usuario nao foi inicializado");
            }
            else{
        $this->companhia = $companhia_f;
        $this->aeroporto = $aeroporto_f;
        $this->modelo = $modelo_f;
        $this->capacidade = $capacidade_f;
    }
}catch(Exception $e){
    echo $e->getMessage();
}
    }
    static public function getFilename() {
        return get_called_class();
      }
    public function get_companhia(): CompanhiaAerea{
        $method = __METHOD__;
        new logLeitura(get_called_class(), $method);
        return $this->companhia;
    }
    public function get_aeroporto(): Aeroporto{
        $method = __METHOD__;
        new logLeitura(get_called_class(), $method);
        return $this->aeroporto;
    }
    public function get_modelo(): string{
        $method = __METHOD__;
        new logLeitura(get_called_class(), $method);
        return $this->modelo;
    }
    public function get_capacidade(): int{
        $method = __METHOD__;
        new logLeitura(get_called_class(), $method);
        return $this->capacidade;
    }
    public function get_velocidademedia(): int{
        $method = __METHOD__;
        new logLeitura(get_called_class(), $method);
        return $this->velocidade_media;
    }
    public function set_companhia(CompanhiaAerea $companhia_f): void{
        $objectBefore = $this->companhia;
        $this->companhia = $companhia_f;
        $objectAfter = $this->companhia;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
    public function set_aeroporto(Aeroporto $aeroporto_f): void{
        $objectBefore = $this->aeroporto;
        $this->aeroporto = $aeroporto_f;
        $objectAfter = $this->aeroporto;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
    public function set_modelo(string $modelo_f): void{
        $objectBefore = $this->modelo;
        $this->modelo = $modelo_f;
        $objectAfter = $this->modelo;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
    public function set_capacidade(int $capacidade_f): void{
        $objectBefore = $this->capacidade;
        $this->capacidade = $capacidade_f;
        $objectAfter = $this->capacidade;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
}