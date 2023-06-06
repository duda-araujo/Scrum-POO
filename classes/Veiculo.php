<?php

include_once("CompanhiaAerea.php");

class Veiculo extends persist{
    protected CompanhiaAerea $companhia;
    protected Aeroporto $aeroporto;
    protected string $modelo;
    protected int $capacidade;
    protected int $velocidade_media = 18;
    public function __construct(CompanhiaAerea $companhia_f, Aeroporto $aeroporto_f, string $modelo_f, int $capacidade_f){
        $this->companhia = $companhia_f;
        $this->aeroporto = $aeroporto_f;
        $this->modelo = $modelo_f;
        $this->capacidade = $capacidade_f;
    }
    static public function getFilename() {
        return get_called_class();
      }public function gerarLogLeitura($entity, $attribute)
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