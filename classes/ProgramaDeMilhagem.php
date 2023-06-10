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
        try{
            if(Sistema::checkSessionState()==FALSE){
                throw new Exception("\nUsuario não foi inicializado! Não é possível acessar o sistema\n");
            }
            else{
        $this->set_nome($nome);
        $this->set_companhia($companhia);
        echo "\nPrograma de milhagem ". $this->get_nome()." cadastrado com sucesso!\n";
    }
}catch(Exception $e){
    echo $e->getMessage();
}
    }
    
    public function get_nome(): string{
        $method = __METHOD__;
        new logLeitura(get_called_class(), $method);
        return $this->nome;
    }
    public function set_nome(string $nome): void{
        if(isset($this->nome)){
            $objectBefore = $this->nome;
        }else{
            $objectBefore = null;
        }
        $this->nome = $nome;
        $objectAfter = $this->nome;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
    public function get_companhia(): CompanhiaAerea{
        $method = __METHOD__;
        new logLeitura(get_called_class(), $method);
        return $this->companhia;
    }
    public function set_companhia(CompanhiaAerea $companhia): void{
        if(isset($this->companhia)){
            $objectBefore = $this->companhia;
        }else{
            $objectBefore = null;
        }
        $this->companhia = $companhia;
        $objectAfter = $this->companhia;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
    public function get_categoria($pontos){
        #função para retornar a categoria do cliente baseada nos pontos
        foreach(self::$pontos as $categoria => $pontosLimite){
            if($pontos >= $pontosLimite){
                $categoria = self::$categoria[$categoria];
            }
        }
        $method = __METHOD__;
        new logLeitura(get_called_class(), $method);
        return $categoria;
    }
    public function get_pontos_categoria($categoria){
        foreach(self::$pontos as $key => $value){
            if($categoria == $key){
                $pontos = $value;
            }
        }
        $method = __METHOD__;
        new logLeitura(get_called_class(), $method);
        return $pontos;
    }
    public function get_desconto($categoria, $valor): float{
        foreach(self::$desconto as $key => $value){
            if($categoria == $key){
                $porcentagem = $value;
            }
        }
        $desconto = $valor * $porcentagem;
        $method = __METHOD__;
        new logLeitura(get_called_class(), $method);
        return $desconto;
    }

    static public function getFilename(){
        return get_called_class();
    }
}