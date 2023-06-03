<?php

include_once("CompanhiaAerea.php");

class ProgramaDeMilhagem{
    private CompanhiaAerea $companhia;
    private string $nome;
    public static $categoria = [
        0 => "Basico",
        1 => "Prata",
        2 => "Ouro",
        3 => "Diamante"
    ];
    public static $pontos = [
        0 => 0,
        1 => 1000,
        2 => 5000,
        3 => 10000
    ];
    public static $desconto = [
        0 => 0.05,
        1 => 0.1,
        2 => 0.2,
        3 => 0.3
    ];
    public function __contruct(string $nome, CompanhiaAerea $companhia){
        $this->nome = $nome;
        $this->companhia = $companhia;
    }
    public function get_nome(): string{
        return $this->nome;
    }
    public function set_nome(string $nome): void{
        $this->nome = $nome;
    }
    public function get_companhia(): CompanhiaAerea{
        return $this->companhia;
    }
    public function set_companhia(CompanhiaAerea $companhia): void{
        $this->companhia = $companhia;
    }
    public function get_categoria($pontos): int{
        foreach(self::$categoria as $key => $value){
            if($pontos >= $value){
                $categoria = $key;
            }
        }
        return $categoria;
    }
    public function get_pontos_categoria($categoria): int{
        foreach(self::$pontos as $key => $value){
            if($categoria == $key){
                $pontos = $value;
            }
        }
        return $pontos;
    }
    public function get_desconto($categoria, $valor): float{
        foreach(self::$desconto as $key => $value){
            if($categoria == $key){
                $porcentagem = $value;
            }
        }
        $desconto = $valor * $porcentagem;
        return $desconto;
    }
}