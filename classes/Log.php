<?php

abstract class Log extends persist{
    protected static $user;
    protected static $entity;
    protected static $dateTime;
    public function __construct($entity) {
        self::$entity = $entity;
        self::$dateTime = new DateTime("now", new DateTimeZone("America/Sao_Paulo"));
    }
    abstract protected function gerarLog();

    public static function setUser($user){
        self::$user = $user;
    }
}
