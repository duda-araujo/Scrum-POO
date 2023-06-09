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
      
    public function set_nome($nome_u){
        $objectBefore = $this->nome;
        $this->nome = $nome_u;
        $objectAfter = $this->nome;
        new LogEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
    public function set_sobrenome($sobrenome_u){
        $objectBefore = $this->sobrenome;
        $this->sobrenome = $sobrenome_u;
        $objectAfter = $this->sobrenome;
        new LogEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
    public function set_email($email_u){
        $objectBefore = $this->email;
        $this->email = $email_u;
        $objectAfter = $this->email;
        new LogEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
    public function set_login($login_u){
        $objectBefore = $this->login;
        $this->login = $login_u;
        $objectAfter = $this->login;
        new LogEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
    public function set_senha($senha_u){
        $objectBefore = $this->senha;
        $this->senha = $senha_u;
        $objectAfter = $this->senha;
        new LogEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
    public function set_passagens($passagem_f){
        $objectBefore = $this->passagens;
        $this->passagens[] = $passagem_f;
        $objectAfter = $this->passagens;
        new LogEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
    public function get_nome(){
        $method = __METHOD__;
        new logLeitura(get_called_class(), $method); 
        return $this->nome;
    }
    public function get_sobrenome(){
        $method = __METHOD__;
        new logLeitura(get_called_class(), $method);
        return $this->sobrenome;
    }
    public function get_email(){
        $method = __METHOD__;
        new logLeitura(get_called_class(), $method);
        return $this->email;
    }
    public function get_login(){
        $method = __METHOD__;
        new logLeitura(get_called_class(), $method);
        return $this->login;
    }
    public function get_senha(){
        $method = __METHOD__;
        new logLeitura(get_called_class(), $method);
        return $this->senha;
    }
    public function get_passagens(){
        $method = __METHOD__;
        new logLeitura(get_called_class(), $method);
        return $this->passagens;
    }
    // public static function getUsuariosCadastrados(){
    //     $usuarios_cadastrados = [];
    //     //$usuarios_cadastrados = parent::get_all();  
    //     return $usuarios_cadastrados;
    // }
    public function realizar_login($login_u, $senha_u){
        $objectBefore = $this->UsuariosCadastrados;
     
        foreach($this->UsuariosCadastrados as $usuario){
            if($usuario->get_login() == $login_u && $usuario->get_senha() == $senha_u){
                echo "Login realizado com sucesso!\n";

                $objectAfter = $this->UsuariosCadastrados;
                new logEscrita(get_called_class(), $objectBefore, $objectAfter);
                return $usuario;
            }
        }
        echo "Login ou senha incorretos!\n";
    }
    public function cadastrar_usuario(Usuario $usuario_cadastrado) {
        $objectBefore = $this->UsuariosCadastrados;
        foreach ($this->UsuariosCadastrados as $usuario) {
            if ($usuario->get_login() == $usuario_cadastrado->get_login()) {
                echo "Login já cadastrado!\n";

                $objectAfter = $this->UsuariosCadastrados;
                new logEscrita(get_called_class(), $objectBefore, $objectAfter);
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






