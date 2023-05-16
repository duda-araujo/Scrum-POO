<?php

include_once("Tripulacao.php");
include_once("Aeroporto.php");
include_once("Veiculo.php");

class Rota extends persist{

    protected Aeroporto $aeroporto;
    protected Veiculo $veiculo;
    protected array $tripulacao;

    public function __construct($aeroporto_f, $veiculo_f, $tripulacao_f)
    {
        $this->set_aeroporto($aeroporto_f);
        $this->set_veiculo($veiculo_f);
        $this->set_tripulacao($tripulacao_f);
    }

    static public function getFilename() {
        return get_called_class();
    }

    public function set_aeroporto($aeroporto_f) {
        $this->aeroporto = $aeroporto_f;
    }
    public function set_veiculo($veiculo_f) {
        $this->veiculo = $veiculo_f;
    }
    public function set_tripulacao($tripulacao_f) {
        $this->tripulacao = $tripulacao_f;
    }

    public function get_aeroporto(){
        return $this->aeroporto;
    }
    public function get_veiculo(){
        return $this->veiculo;
    }
    public function get_tripulacao(){
        return $this->tripulacao;
    }

    public function definir_rota() {

    }

    public function obter_lang_long() {
        
    }

    public function checar_duracao () {

    }
    

}

?>