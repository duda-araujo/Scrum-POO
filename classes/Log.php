<?php

abstract class Log extends persist{
    #protected $user;
    protected $entity;
    protected $dateTime;
    public function __construct($entity) {
        #$this->user = $user;
        $this->entity = $entity;
        $this->dateTime = new DateTime("now", new DateTimeZone("America/Sao_Paulo"));
    }
    abstract protected function gerarLog();
}
