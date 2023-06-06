<?php
include_once ("Passageiro.php");
include_once ("Passagens.php");
include_once ("VooPlanejado.php");

class Embarque extends VooPlanejado{
    protected VooPlanejado $voo;
    protected string $status_embarque;
    protected array $passageiros_embarcados = [];

    public function __construct(VooPlanejado $voo){
        $this->set_voo($voo);
        $this->set_status_embarque(2);
    }
    public static $dict_status = [
        1 => "Embarque fechado",
        2 => "Embarque aberto",
        3 => "Embarque finalizado"
    ];
    static public function getFilename() {
        return get_called_class();
    }
    public function get_voo(): VooPlanejado {
        $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
        return $this->voo;
    }
    public function set_voo(VooPlanejado $voo_f): void {
        $method = __METHOD__;
        new logLeitura(get_called_class(), $method);
        $this->voo = $voo_f;
    }
    public function get_status_embarque(): string {
        $method = __METHOD__;
        new logLeitura(get_called_class(), $method);
        return $this->status_embarque;
    }
    public function set_status_embarque($status_embarque_f): void {
        try {
            if (array_key_exists($status_embarque_f, self::$dict_status)){
                if(isset($this->status_embarque)){
                    $objectBefore = $this->status_embarque;
                    $this->status_embarque = self::$dict_status[$status_embarque_f];
                    $objectAfter = $this->status_embarque;
                    new logEscrita(get_called_class(), $objectBefore, $objectAfter);
                }else{
                    $objectBefore = null;
                    $this->status_embarque = self::$dict_status[$status_embarque_f];
                    $objectAfter = $this->status_embarque;
                    new logEscrita(get_called_class(), $objectBefore, $objectAfter);
                }
            } else {
                throw new InvalidArgumentException("\nErro: status de embarque não existe");
            }
        } catch (InvalidArgumentException $e) {
            echo $e->getMessage();
        }
    }
    public function get_passageiros_embarcados(): array {
        $method = __METHOD__;
        new logLeitura(get_called_class(), $method);
        return $this->passageiros_embarcados;
    }

    public function embarcar_passageiro(Passagens $passagem_f): void {
        try{
            if ($this->get_status_embarque() == "Embarque fechado"){
                throw new Exception("Erro: o embarque está fechado");
            }
            foreach (Passagens::$passagens as $passagem){
                if ($passagem == $passagem_f){
                    if ($passagem->get_estado_da_passagem() == "Check-in Realizado"){
                        if(isset($this->passageiros_embarcados)){
                            $objectBefore = $this->passageiros_embarcados;
                            array_push($this->passageiros_embarcados, $passagem_f);
                            $passagem->set_estado_da_passagem(3);
                            echo "\nPassageiro " . $passagem_f->get_cliente()->get_nome_passageiro() . " embarcado no voo " . $this->voo->get_codigo()."\n";
                            $objectAfter = $this->passageiros_embarcados;
                            new logEscrita(get_called_class(), $objectBefore, $objectAfter);
                            return;
                        }else{
                            $objectBefore = null;
                            $this->passageiros_embarcados = [];
                            array_push($this->passageiros_embarcados, $passagem_f);
                            $passagem->set_estado_da_passagem(3);
                            echo "\nPassageiro " . $passagem_f->get_cliente()->get_nome_passageiro() . " embarcado no voo " . $this->voo->get_codigo()."\n";
                            $objectAfter = $this->passageiros_embarcados;
                            new logEscrita(get_called_class(), $objectBefore, $objectAfter);
                            return;
                        }
                    }else{
                        if(isset($this->passageiros_embarcados)){
                            $objectBefore = $this->passageiros_embarcados;
                            $passagem->set_estado_da_passagem(5);
                            $objectAfter = $this->passageiros_embarcados;
                            new logEscrita(get_called_class(), $objectBefore, $objectAfter);
                        }else{
                            $objectBefore = null;
                            $this->passageiros_embarcados = [];
                            $passagem->set_estado_da_passagem(5);
                            $objectAfter = $this->passageiros_embarcados;
                            new logEscrita(get_called_class(), $objectBefore, $objectAfter);
                            throw new Exception("Erro: o passageiro não realizou o check-in");
                            }
                        throw new Exception("Erro: o passageiro não realizou o check-in");
                    }
                }
            }
            throw new Exception("Erro: o passageiro não comprou a passagem");  
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

}