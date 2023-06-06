<?php

include_once("CompanhiaAerea.php");

class ProgramaDeMilhagem extends persist{
    protected CompanhiaAerea $companhia;
    protected string $nome;
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
    public function __construct(string $nome, CompanhiaAerea $companhia){
        $this->set_nome($nome);
        $this->set_companhia($companhia);
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

    static public function getFilename(){
        return get_called_class();
    }
}