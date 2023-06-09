<?php
class logLeitura extends Log{
    protected $attribute;
    public function __construct($entity, $attribute){
        parent::__construct($entity);
        $this->attribute = $attribute;
        $this->gerarLog();
    }
    protected function gerarLog(){
        $this->gerarLogLeitura(self::$user, self::$entity, $this->attribute);
    }
    static public function getFilename() {
        return get_called_class();
    }
    protected function gerarLogLeitura($user, $entity, $attribute){
    // Implementação do log de leitura específico para Aeroporto
    if ($user != null){
        $log = "\nUser: " . $user->get_nome() . "\n";
    }else{
        $log = "\nUser: " . "Usuário não logado" . "\n";
    }
    $dateTime = self::$dateTime->format('Y-m-d H:i:s');
    $log .= "Date/Time: " . $dateTime . "\n";
    $log .= "   Entity: " . $entity . "\n";
    $log .= "       Attribute: " . $attribute . "\n";

    // Salvar o log em um arquivo ou em algum outro meio de armazenamento
    file_put_contents('logLeitura.txt', $log, FILE_APPEND);
}
}