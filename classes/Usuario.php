<?php

include_once("Passagens.php");

class Usuario extends persist{

    protected string $nome_usuario;
    protected string $sobrenome_usuario;
    protected string $documento_usuario;
    protected array $passagens;

    protected array $registro_financeiro=[];


    public function __construct($nome_u,$sobrenome_u,$documento_u){
        $this->set_nome_usuario($nome_u);
        $this->set_sobrenome_usuario($sobrenome_u);
        $this->set_documento_usuario($documento_u);
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
    public function set_nome_usuario($nome_u){
        $this->nome_usuario = $nome_u;
    }
    public function set_sobrenome_usuario($sobrenome_u){
        $this->sobrenome_usuario = $sobrenome_u;
    }
    public function set_documento_usuario($documento_u){
        $this->documento_usuario = $documento_u;
    }
    public function set_passagens($passagem_f){
        $this->passagens[] = $passagem_f;
    }
    public function get_nome_usuario(){
        return $this->nome_usuario;
    }
    public function get_sobrenome_usuario(){
        return $this->sobrenome_usuario;
    }
    public function get_documento_usuario(){
        return $this->documento_usuario;
    }
    public function get_passagens(){
        return $this->passagens;
    }
    public function passagem_comprada($preco_f,$Aerop_origem_f,$Aerop_destino_f){
        $a="Passagem comprada de".$Aerop_origem_f->get_cidade()."para".$Aerop_destino_f->get_cidade()."por R$".strval($preco_f);
        array_push($this->registro_financeiro,$a);
    }
    public function passagem_cancelada($ressarcimento_f,$Aerop_origem_f,$Aerop_destino_f){
        $a="Passagem cancelada de".$Aerop_origem_f->get_cidade()."para".$Aerop_destino_f->get_cidade()."com ressarcimento de R$".strval($ressarcimento_f);
        array_push($this->registro_financeiro,$a);
    }
}






