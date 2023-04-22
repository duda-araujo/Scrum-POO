<?php
include_once("VooDecolado");
class DadosVoos{
    protected array $voos_agenda;
    protected array $voos_historico;
    public function DadosVoos(){
    $this->voos_agenda = VooPlanejado::$historico_planejado;
    $this->voos_historico = Viagem::$historico_executado;
    }
    public function ver_historico_dia(DateTime $dia_f){
        $historico_dia = [];
        foreach($this->voos_historico as $voo){
            if($voo->get_chegada() == $dia_f){
                $historico_dia[] = $voo;
            }
        }
        return $historico_dia;
    }
    public function ver_agenda(){
        return $this->voos_agenda;
    }

    public function ver_historico(){
        return $this->voos_historico;
    }    
}
