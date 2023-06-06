<?

class logEscrita extends Log{
    protected $objectBefore;
    protected $objectAfter;
    public function __construct($entity, $objectBefore, $objectAfter){
        parent::__construct($entity);
        $this->objectBefore = $objectBefore;
        $this->objectAfter = $objectAfter;
        $this->gerarLog();

    }
    static public function getFilename() {
        return get_called_class();
    }
    protected function gerarLog(){
        $this->gerarLogEscrita(parent::$entity, $this->objectBefore, $this->objectAfter);
    }
    protected function gerarLogEscrita($entity, $objectBefore, $objectAfter){
        // Implementação do log de escrita específico para Aeroporto
        if(is_object($objectBefore) == True){
        $log = "\nUser: " . "Usuário - ";
        $dateTime = parent::$dateTime->format('Y-m-d H:i:s');
        $log .= "Date/Time: " . $dateTime . "\n";
        $log .= "   Entity: " . $entity . "\n";
        $log .= "       Object before: " . serialize($objectBefore) . "\n";
        $log .= "       Object after: " . serialize($objectAfter) . "\n";
        // Salvar o log em um arquivo ou em algum outro meio de armazenamento
        file_put_contents('logEscrita.txt', $log, FILE_APPEND);}
        else{
            $log = "\nUser: " . "Usuário - ";
        $dateTime = parent::$dateTime->format('Y-m-d H:i:s');
        $log .= "Date/Time: " . $dateTime . "\n";
        $log .= "   Entity: " . $entity . "\n";
        $log .= "       Object before: " . strval($objectBefore) . "\n";
        $log .= "       Object after: " . strval($objectAfter) . "\n";
        // Salvar o log em um arquivo ou em algum outro meio de armazenamento
        file_put_contents('logEscrita.txt', $log, FILE_APPEND);}

        }
}