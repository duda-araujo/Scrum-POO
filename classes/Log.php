<?php

abstract class Log {
    #protected $user;
    protected $dateTime;

    public function __construct() {
        #$this->user = $user;
        $this->dateTime = new DateTime();
    }

    abstract protected function gerarLogLeitura($entity, $attribute);

    abstract protected function gerarLogEscrita($entity, $objectBefore, $objectAfter);

}
