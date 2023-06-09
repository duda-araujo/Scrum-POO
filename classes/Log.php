<?php

abstract class Log extends persist{
    #protected $user;
    protected static $entity;
    protected static $dateTime;
    public function __construct($entity) {
        #$this->user = $user;
        self::$entity = $entity;
        self::$dateTime = new DateTime("now", new DateTimeZone("America/Sao_Paulo"));
    }
    abstract protected function gerarLog();
}
