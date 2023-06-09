<?php

class Sistema extends persist{
    protected static $loggedUser;
    protected static $loginTime;

    public function __construct(Usuario $user){
        $this->login($user);
    }
    static public function getFilename() {
        return get_called_class();
    }
    public static function checkSessionState(){
        if (!isset(self::$loggedUser)){
            return false;
            #throw new Exception("Não existe um usuário logado");
        }else {
            self::checkLoginTime();
        }
    }
    public static function checkLoginTime(){
        $now = new DateTime("now");
        $diff = $now->diff(self::$loginTime);
        if ($diff->h >= 1){
            self::logout();
            return false;
            #throw new Exception("Sessão expirada");
        }
        return true;
    }

    public static function login($user){
        if (isset(self::$loggedUser)){
            return false;
            #throw new Exception("Já existe um usuário logado");
        }
        else{
            self::$loggedUser = $user;
            self::$loginTime = new DateTime("now");
            Log::setUser($user);
            return true;
        }
    }
    public static function logout(){
        if (isset(self::$loggedUser)){
            self::$loggedUser = null;
            self::$loginTime = null;
        }
        else{
            return false;
            #throw new Exception("Não existe um usuário logado");
        }
    }


}