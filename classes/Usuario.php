<?php

include_once("Passagens.php");

class Usuario extends persist{

    protected string $nome;
    protected string $sobrenome;
    protected string $email;
    protected string $login;
    protected string $senha;
    protected array $passagens;
    protected array $registro_financeiro=[];
    protected array $UsuariosCadastrados = [];


    public function __construct($nome_u,$sobrenome_u,$email_u,$login_u,$senha_u){
        $this->set_nome($nome_u);
        $this->set_sobrenome($sobrenome_u);
        $this->set_email($email_u);
        $this->set_login($login_u);
        $this->set_senha($senha_u);
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
    public function set_nome($nome_u){
        $this->nome = $nome_u;
    }
    public function set_sobrenome($sobrenome_u){
        $this->sobrenome = $sobrenome_u;
    }
    public function set_email($email_u){
        $this->email = $email_u;
    }
    public function set_login($login_u){
        $this->login = $login_u;
    }
    public function set_senha($senha_u){
        $this->senha = $senha_u;
    }
    public function set_passagens($passagem_f){
        $this->passagens[] = $passagem_f;
    }
    public function get_nome(){
        return $this->nome;
    }
    public function get_sobrenome(){
        return $this->sobrenome;
    }
    public function get_email(){
        return $this->email;
    }
    public function get_login(){
        return $this->login;
    }
    public function get_senha(){
        return $this->senha;
    }
    public function get_passagens(){
        return $this->passagens;
    }
    // public static function getUsuariosCadastrados(){
    //     $usuarios_cadastrados = [];
    //     //$usuarios_cadastrados = parent::get_all();  
    //     return $usuarios_cadastrados;
    // }
    public function realizar_login($login_u, $senha_u){
     
        foreach($this->UsuariosCadastrados as $usuario){
            if($usuario->get_login() == $login_u && $usuario->get_senha() == $senha_u){
                echo "Login realizado com sucesso!\n";
                return $usuario;
            }
        }
        echo "Login ou senha incorretos!\n";
    }
    public function cadastrar_usuario(Usuario $usuario_cadastrado) {
        foreach ($this->UsuariosCadastrados as $usuario) {
            if ($usuario->get_login() == $usuario_cadastrado->get_login()) {
                echo "Login já cadastrado!\n";
                return;
            }
        }
        
        $this->UsuariosCadastrados[] = $usuario_cadastrado;
        echo "Cadastro realizado com sucesso!\n";
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






