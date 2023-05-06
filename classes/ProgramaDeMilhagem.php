<?php

include_once("CompanhiaAerea.php");

class ProgramaDeMilhagem extends CompanhiaAerea{
    protected CompanhiaAerea $companhia_aerea;
    protected string $nome;
    protected float $pontos_acumulados;
    protected DateTime $data_inicio;
    protected DateTime $data_expiracao;
    protected array $categorias = [];

    public function __construct($companhia_aerea_f, $nome_f){
        $this->set_companhia_aerea($companhia_aerea_f);
        $this->set_nome($nome_f);
    }

    public function definir_categoria($pontos_acumulados_f){

    }
    public function pontos_acumulados($pontos_acumulados_f){

    }
    public function set_companhia_aerea($companhia_aerea_f){
        $this->companhia_aerea = $companhia_aerea_f;
    }
    public function set_nome($nome_f){
        $this->nome = $nome_f;
    }
    public function set_categoria(Categorias $categoria_f): void{
        array_push($this->categorias, $categoria_f);
    }
    public function set_pontos_acumulados($pontos_acumulados_f){
        $this->pontos_acumulados = $pontos_acumulados_f;
    } 
    public function set_data_inicio($data_inicio_f){
        $this->data_inicio = $data_inicio_f;
    }
    public function set_data_expiracao($data_expiracao_f){
        $this->data_expiracao = $data_expiracao_f;
    }

    public function get_companhia_aerea(): CompanhiaAerea{
        return $this->companhia_aerea;
    }
    public function get_nome(){
        return $this->nome;
    }
    public function get_categoria(){
        return $this->categorias;
    }
    public function get_pontos_acumulados(){
        return $this->pontos_acumulados;
    } 
    public function get_data_inicio(): DateTime{
        return $this->data_inicio;
    }
    public function get_data_expiracao(): DateTime{
        return $this->data_expiracao;
    }
}
