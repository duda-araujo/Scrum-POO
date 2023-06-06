<?php

class Sistema{
    protected $loggedUser;
    protected $loginTime;


    public function __construct($user){
        $this->login($user);
    }

    public function login($user){
        if (isset($this->loggedUser)){
            throw new Exception("Já existe um usuário logado");
        }
        else{
            $this->loggedUser = $user;
            $this->loginTime = new DateTime("now");
        }
    }
    public function logout(){
        if (isset($this->loggedUser)){
            $this->loggedUser = null;
            $this->loginTime = null;
        }
        else{
            throw new Exception("Não existe um usuário logado");
        }
    }


}