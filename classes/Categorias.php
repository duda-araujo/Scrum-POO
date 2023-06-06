<?php

include_once("ProgramaDeMilhagem.php");

class Categorias extends persist{
    protected ProgramaDeMilhagem $programa_de_milhagem;
    protected string $nome;
    protected float $pontos_exigidos;
    public function __construct($programa_de_milhagem_f, $nome_f, $pontos_exigidos_f){
        $this->set_milhagem($programa_de_milhagem_f);
        $this->set_nome($nome_f);
        $this->set_pontos($pontos_exigidos_f);
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
    public function set_milhagem($programa_de_milhagem_f){
        $this->programa_de_milhagem = $programa_de_milhagem_f;
    }
    public function set_nome($nome_f){
        $this->nome = $nome_f;
    }
    public function set_pontos($pontos_exigidos_f){
        $this->pontos_exigidos = $pontos_exigidos_f;
    }
    public function get_milhagem(){
        return $this->programa_de_milhagem;
    }
    public function get_nome(){
        return $this->nome;
    }
    public function get_pontos(){
        return $this->pontos_exigidos;
    }
}