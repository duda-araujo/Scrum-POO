<?php

include_once("CompanhiaAerea.php");

class ProgramaDeMilhagem extends CompanhiaAerea{
    protected CompanhiaAerea $companhia_aerea;
    protected string $nome;
    protected float $pontos_acumulados;
    protected DateTime $data_inicio;
    protected DateTime $data_expiracao;

    public function __construct($companhia_aerea_f, $nome_f, $categoria_f, $pontos_acumulados_f, $data_inicio_f, $data_expiracao_f){
        $this->set_companhia_aerea($companhia_aerea_f);
        $this->set_nome($nome_f);
        $this->set_categoria($categoria_f);
        $this->set_pontos_acumulados($pontos_acumulados_f);
        $this->set_data_inicio($data_inicio_f);
        $this->set_data_expiracao($data_expiracao_f);
    }

    public 
}

