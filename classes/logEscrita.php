<?php
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
        $this->gerarLogEscrita(self::$entity, $this->objectBefore, $this->objectAfter);
    }
    protected function gerarLogEscrita($entity, $objectBefore, $objectAfter){
        // Implementação do log de escrita específico para Aeroporto
        $log = "\nUser: " . "Usuário - ";
        $dateTime = self::$dateTime->format('Y-m-d H:i:s');
        $log .= "Date/Time: " . $dateTime . "\n";
        $log .= "   Entity: " . $entity . "\n";
        if(is_object($objectBefore)){
        $log .= "       Object before: " . serialize($objectBefore) . "\n";
        }else if(is_array($objectBefore)){
            $log .= "       Object before: " . ", " . self::convertArrayToString($objectBefore) . "\n";
        }else{
            $log .= "       Object before: " . strval($objectBefore) . "\n";
        }
        if(is_object($objectAfter)){
        $log .= "       Object after: " . serialize($objectAfter) . "\n";
        }
        else if(is_array($objectAfter)){
            $log .= "       Object after: " . ", " . self::convertArrayToString($objectAfter) . "\n";
        }else{
            $log .= "       Object after: " . strval($objectAfter) . "\n";
        }
        // Salvar o log em um arquivo ou em algum outro meio de armazenamento
        file_put_contents('logEscrita.txt', $log, FILE_APPEND);
    }
    // ... código anterior ...

// Função convertArrayToString() (incluída no mesmo arquivo)

public function convertArrayToString($array) {
    $hasObjects = false;
    $convertedArray = [];

    // Verifica se há objetos ou arrays no array
    foreach ($array as $element) {
        if (is_object($element)) {
            $hasObjects = true;
            $convertedArray[] = serialize($element);
        } elseif (is_array($element)) {
            $convertedArray[] = self::convertArrayToString($element);
        } elseif (is_string($element)) {
            $convertedArray[] = $element;
        } else {
            $convertedArray[] = strval($element);
        }
    }

    // Converte o array em uma string
    $string = implode(", ", $convertedArray);

    return $string;
}   
    
}