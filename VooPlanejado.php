<?php

#include_once("DadosVoos.php");
include_once("Aeroporto.php");
include_once("CompanhiaAerea.php");


class VooPlanejado{
protected string $codigo;
protected Aeroporto $Aeroporto_origem;
protected Aeroporto $Aeroporto_destino;
protected DateTime $hora_agendada_chegada;
protected DateTime $hora_agendada_saida;
protected Aeronave $Aviao;
protected array $Frequencia_voo = ['dia', 'frequencia'];
protected float $preco_trajeto;
protected array $assentos;
public static array $historico_planejado = [];    

public static $dict_frequencias = [
    '1' => 'Diário',
    '2' => 'Semanal',
    '3' => 'Quinzenal',
    '4' => 'Mensal',
];
public static $dict_dias = [
    '1' => 'Domingo',
    '2' =>'Segunda',
    '3' => 'Terça',
    '4' => 'Quarta',
    '5' =>'Quinta',
    '6' => 'Sexta',  
    '7' => 'Sábado',
];
public static $dict_assentos = [
    'A' => 1,
    'B' => 2,
    'C' => 3,   
    'D' => 4,
    'E' => 5,
    'F' => 6,
    1 => 'A',
    2 => 'B',
    3 => 'C',
    4 => 'D',
    5 => 'E',
    6 => 'F',
];

public function __construct($codigo_f, $Aerop_origem_f, $Aerop_destino_f,
                            $Hora_agen_chegada_f,$Hora_agen_saida_f,$Aviao_f, 
                            $dia_f,$frequencia_voo_f, $preco_f) {
    $this->set_aviao($Aviao_f);
    $this->set_codigo($codigo_f);
    $this->set_origem($Aerop_origem_f);
    $this->set_destino($Aerop_destino_f);
    $this->set_hora_agenda_chegada($Hora_agen_chegada_f);
    $this->set_hora_agenda_saida($Hora_agen_saida_f);
    $this->set_frequencia($frequencia_voo_f, $dia_f); 
    $this->set_preco_trajeto($preco_f);
    self::inicializar_assento();
    self::$historico_planejado[] = $this;
}



public function get_frequencia(): string {
    //retornar uma string com o dia e a frequencia
    $str = '';
    $str .= $this->Frequencia_voo[0];
    $str .= ' ';
    $str .= $this->Frequencia_voo[1];
    return $str;
}
public function set_frequencia($frequencia_voo_f, $dia_f): void {
    $dia = '';
    $frequencia = '';
    try{
        if (isset(self::$dict_frequencias[$frequencia_voo_f])) {
            $frequencia = self::$dict_frequencias[$frequencia_voo_f];
        } else {
            throw new Exception("\nCódigo de frequência inválido.");
        }
        if (isset(self::$dict_dias[$dia_f])) {
            $dia = self::$dict_dias[$dia_f];
        } else {
            throw new Exception("\nCódigo de dia inválido.");
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }
    $this->Frequencia_voo = [$dia, $frequencia];
}
public function get_origem(): Aeroporto {
    return $this->Aeroporto_origem;
}
public function set_origem($Aerop_origem_f): void {
    try {
        if ($Aerop_origem_f instanceof Aeroporto){
            $this->Aeroporto_origem = $Aerop_origem_f;
        } else{
            throw new Exception("\nAeroporto de origem invalido");
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }
}
public function get_destino(): Aeroporto {
    return $this->Aeroporto_destino;
}
public function set_destino($Aerop_destino_f): void {
    try {
        if ($Aerop_destino_f instanceof Aeroporto){
            $this->Aeroporto_destino = $Aerop_destino_f;
        } else{
            throw new Exception("\nAeroporto de destino invalido");
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }
}
public function get_preco_trajeto(): float {
    return $this->preco_trajeto;
}
public function set_preco_trajeto($preco_f): void {//positivo com duas casas decimais
    try {
        if ($preco_f < 0){
            throw new Exception("\nPreço não pode ser negativo");
        }
        else{
            $this->preco_trajeto = round($preco_f,2);
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
public function get_hora_agenda_chegada(): DateTime {
    return $this->hora_agendada_chegada;
}
public function set_hora_agenda_chegada($hora_agendada_chegada_f): void {
    try {
        if ($hora_agendada_chegada_f instanceof DateTime){
            $this->hora_agendada_chegada = $hora_agendada_chegada_f;
        } else{
            throw new Exception("\nHora invalida");
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }
}
public function get_hora_agenda_saida(): DateTime {
    return $this->hora_agendada_saida;
}
public function set_hora_agenda_saida($hora_agendada_saida_f): void {
    try {
        if ($hora_agendada_saida_f instanceof DateTime){
            $this->hora_agendada_saida = $hora_agendada_saida_f;
        } else{
            throw new Exception("\nHora invalida");
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }
}
public function get_codigo(): string {
    return $this->codigo;
}
public function set_codigo($codigo_f): void {
    try {
        if ($this->validar_codigo($codigo_f, $this->get_aviao())){
            $this->codigo = $codigo_f;
        } else{
            throw new Exception("\nCodigo invalido");
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }
}
public function get_aviao(): Aeronave {
    return $this->Aviao;
}
public function set_aviao($Aviao_f): void {
    try {
        if ($Aviao_f instanceof Aeronave){
            $this->Aviao = $Aviao_f;
        } else{
            throw new Exception("Aeronave invalida");
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }
}
public function inicializar_assento(){    
    //numero de assentos é definido pelo aviao
    $numero_de_assentos = $this->Aviao->get_passageiro();
    $fileiras = floor($numero_de_assentos/6);
    $resto = $numero_de_assentos%6;
    //criar array bidimensional onde o numero de assentos é a primeira dimensão e a segunda dimensão é o dict de assentos
    for ($i=1; $i < $fileiras+1; $i++) { 
        for ($j=1; $j < 7; $j++) { 
            $coluna = self::$dict_assentos[$j];
            $identificação_fileira = "{$i}{$coluna}";
            $this->assentos[$i][$j] = [$identificação_fileira,null, true];
        }
    }
    if ($resto != 0){
        for ($i=0; $i < $resto; $i++) { 
            $this->assentos[$fileiras+1][$i] = [null, true];
        }
    }
}
public function comprar_assento(string $assento, Passageiro $passageiro){
    //verificar se o assento existe
    try {
        preg_match_all('/\d+|\D+/', $assento, $matches);
        $digitos = "{$matches[0][0]}";
        $letras = "{$matches[0][1]}";
        if (ctype_alpha($letras)){
            if (ctype_digit($digitos) && $digitos < 101){
                if ($digitos > $this->assentos){
                    throw new Exception("A fileira deve ser um numero inteiro.");
                }
            }else{
                throw new Exception("A coluna deve ser escrita como A, B, C, D, E, ou F \n.");
            }
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    $coluna = self::$dict_assentos[$letras];
    $fileira = $digitos;
    //verificar se o assento está disponivel
    try{
        if ($this->assentos[$fileira][$coluna][1] == null && $this->assentos[$fileira][$coluna][2] = true){
            $this->assentos[$fileira][$coluna][1] = $passageiro;
            $this->assentos[$fileira][$coluna][2] = false;
        }else{
            throw new Exception("Assento indisponivel.");
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }
}
public function get_assentos_ocupados(): string {
    $ocupados = "";
    foreach ($this->assentos as $fileira) {
        foreach ($fileira as $assento) {
            if (!$assento[2]) { // verifica se o assento está ocupado
                $ocupados .= $assento[1]->get_nome_passageiro()." ".$assento[1]->get_sobrenome_passageiro()." está sentado/a no assento {$assento[0]}";
            }
        }
    }
    return $ocupados;
}
public static function get_hist_planejado(): string {
    //deve retornar uma string com todos os voos planejados
    $string = "";
    foreach (self::$historico_planejado as $voo){
        $string .= "Voo " . $voo->get_codigo() . " da " . $voo->get_aviao()->get_companhia_aerea()->get_nome() . " de " . $voo->get_origem()->get_sigla_aero() . " para " . $voo->get_destino()->get_sigla_aero() . " marcado para " . $voo->get_hora_agenda_saida()->format('d/m/Y H:i') . " com chegada " . $voo->get_hora_agenda_chegada()->format('d/m/Y H:i') . "\n";
    }
    return $string;
}
public static function buscar_proximos_voos(): array {
        $agora = new DateTime();
        $data_limite = $agora->modify('+30 days');

        $voos_proximos = [];
        foreach (self::$historico_planejado as $voo) {
            if ($voo->hora_agendada_saida <= $data_limite) {
                $voos_proximos[] = $voo;
            }
        }

        return $voos_proximos;
}
public static function proximos_voos_string(): string {
        $voos_proximos = self::buscar_proximos_voos();
        $string = "";
        foreach ($voos_proximos as $voo) {
            $string .= "Voo " . $voo->get_codigo() . " da " . $voo->get_aviao_marcado()->get_companhia_aerea()->get_nome() . " de " . $voo->get_origem()->get_sigla_aero() . " para " . $voo->get_destino()->get_sigla_aero() . " marcado para " . $voo->get_hora_agenda_saida()->format('d/m/Y H:i') . " com chegada " . $voo->get_hora_agenda_chegada()->format('d/m/Y H:i') . "\n";
        }
        return $string;
}
public function validar_codigo($codigo, $Aviao_esperado_f): bool {
//Codigo composto por 2 letras e 4 numeros
    $letras = substr($codigo,0,2);
    $sigla_comp_aerea = $Aviao_esperado_f-> get_companhia_aerea() -> get_sigla();
    if ($letras != $sigla_comp_aerea){
        echo "\nErro: Codigo do voo não corresponde a companhia aerea";
        return false;
    }
    $numeros = substr($codigo,2,4);
    if (ctype_alpha($letras) && ctype_digit($numeros)){
        return true;
    }else{
        return false;
    }
}
}