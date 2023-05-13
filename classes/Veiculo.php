<?php

include_once("CompanhiaAerea.php");

class Veiculo{
    protected CompanhiaAerea $companhia;
    protected Aeroporto $aeroporto;
    protected string $modelo;
    protected int $capacidade;
    protected int $velocidade_media = 18;
    public function __contruct(CompanhiaAerea $companhia_f, Aeroporto $aeroporto_f, string $modelo_f, int $capacidade_f){
        $this->companhia = $companhia_f;
        $this->aeroporto = $aeroporto_f;
        $this->modelo = $modelo_f;
        $this->capacidade = $capacidade_f;
    }
    public function get_companhia(): CompanhiaAerea{
        return $this->companhia;
    }
    public function get_aeroporto(): Aeroporto{
        return $this->aeroporto;
    }
    public function get_modelo(): string{
        return $this->modelo;
    }
    public function get_capacidade(): int{
        return $this->capacidade;
    }
    public function get_velocidademedia(): int{
        return $this->velocidade_media;
    }
    public function set_companhia(CompanhiaAerea $companhia_f): void{
        $this->companhia = $companhia_f;
    }
    public function set_aeroporto(Aeroporto $aeroporto_f): void{
        $this->aeroporto = $aeroporto_f;
    }
    public function set_modelo(string $modelo_f): void{
        $this->modelo = $modelo_f;
    }
    public function set_capacidade(int $capacidade_f): void{
        $this->capacidade = $capacidade_f;
    }
}