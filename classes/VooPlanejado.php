<?php

#include_once("DadosVoos.php");
include_once("Aeroporto.php");
include_once("CompanhiaAerea.php");


class VooPlanejado extends persist{
protected string $codigo;
protected Aeroporto $Aeroporto_origem;
protected Aeroporto $Aeroporto_destino;
protected DateTime $hora_agendada_chegada;
protected DateTime $hora_agendada_saida;
protected Aeronave $Aviao;
// protected array $Frequencia_voo = ['dia', 'frequencia'];
protected float $preco_trajeto;
protected float $multa;
protected array $assentos;
protected array $passageiros_compraram = [];

protected int $pontos_viagem;
public static array $historico_planejado = [];    

// public static $dict_frequencias = [
//     '1' => 'Diário',
//     '2' => 'Semanal',
//     '3' => 'Quinzenal',
//     '4' => 'Mensal',
// ];
// public static $dict_dias = [
//     '1' => 'Domingo',
//     '2' =>'Segunda',
//     '3' => 'Terça',
//     '4' => 'Quarta',
//     '5' =>'Quinta',
//     '6' => 'Sexta',  
//     '7' => 'Sábado',
// ];
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

public function voo_com_frequencia($frequencia){//frequencia eh um valor de zero a 4
    if($frequencia==0){
        return 0;
    }
    else if($frequencia==1){
        for ($i=1; $i<365; $i++){
        $dias=$i;
        $a=$this->hora_agendada_saida;
        $b=$a->modify("+{$dias} days");
        $c=$this->hora_agendada_chegada;
        $d=$c->modify("+{$dias} days");
        $voo= new VooPlanejado($this->codigo,$this->Aeroporto_origem,$this->Aeroporto_destino,$d,$b,$this->Aviao,$this->preco_trajeto,$this->pontos_viagem,$this->multa);
        }
        echo "\nVoo diário planejado com sucesso!\n";
    }
    else if($frequencia==2){
        for ($i=1; $i<52; $i++){
        $dias=7*$i;
        $a=$this->hora_agendada_saida;
        $b=$a->modify("+{$dias} days");
        $c=$this->hora_agendada_chegada;
        $d=$c->modify("+{$dias} days");
        $voo= new VooPlanejado($this->codigo,$this->Aeroporto_origem,$this->Aeroporto_destino,$d,$b,$this->Aviao,$this->preco_trajeto,$this->pontos_viagem,$this->multa);
      
        }
        echo "\nVoo semanal planejado com sucesso!\n";
    }
    else if($frequencia==3){
       for ($i=1; $i<26; $i++){
        $dias=15*$i;
        $a=$this->hora_agendada_saida;
        $b=$a->modify("+{$dias} days");
        $c=$this->hora_agendada_chegada;
        $d=$c->modify("+{$dias} days");
        $voo= new VooPlanejado($this->codigo,$this->Aeroporto_origem,$this->Aeroporto_destino,$d,$b,$this->Aviao,$this->preco_trajeto,$this->pontos_viagem,$this->multa);
        }
        echo "\nVoo quinzenal planejado com sucesso!\n";
    }
    else if($frequencia==4){
        for ($i=1; $i<12; $i++){
        $mes=1*$i;
        $a=$this->hora_agendada_saida;
        $b=$a->modify("+{$mes} month");
        $c=$this->hora_agendada_chegada;
        $d=$c->modify("+{$mes} month");
        $voo= new VooPlanejado($this->codigo,$this->Aeroporto_origem,$this->Aeroporto_destino,$d,$b,$this->Aviao,$this->preco_trajeto,$this->pontos_viagem,$this->multa);
        }
        echo "\nVoo mensal planejado com sucesso!\n";
    }
    else{
        return 0;
    }
}

public function __construct($codigo_f, $Aerop_origem_f, $Aerop_destino_f,
                            $Hora_agen_chegada_f,$Hora_agen_saida_f,$Aviao_f, $preco_f,$pontos_f, $multa_f) {
    $this->set_aviao($Aviao_f);
    $this->set_codigo($codigo_f);
    $this->set_origem($Aerop_origem_f);
    $this->set_destino($Aerop_destino_f);
    $this->set_hora_agenda_chegada($Hora_agen_chegada_f);
    $this->set_hora_agenda_saida($Hora_agen_saida_f);
    // $this->set_frequencia($frequencia_voo_f, $dia_f); 
    $this->set_preco_trajeto($preco_f);
    $this->set_multa($multa_f);
    $this->set_pontos_voo($pontos_f);
    self::inicializar_assento();
    self::$historico_planejado[] = $this;
}


static public function getFilename() {
    return get_called_class();
}
public function set_passageiros_compraram(Passagens $passagem_f): void {
    if(isset($this->passageiros_compraram)){
        $objectBefore = $this->passageiros_compraram;
    } else {
        $objectBefore = null;
    }
    array_push($this->passageiros_compraram, $passagem_f);
    $objectAfter = $this->passageiros_compraram;
    new logEscrita(get_called_class(), $objectBefore, $objectAfter);
}
public function get_passageiros_compraram(): array {
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->passageiros_compraram;
}
public function set_multa($multa_f): void{
    if(isset($this->multa)){
        $objectBefore = $this->multa;
    } else {
        $objectBefore = null;
    }
    $this->multa = $multa_f;
    $objectAfter = $this->multa;
    new logEscrita(get_called_class(), $objectBefore, $objectAfter);
}
public function get_multa(): float {
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->multa;
}
public function get_ressarcimento(): float {
    $multa_f = $this->get_multa();
    $preco_trajeto_f = $this->get_preco_trajeto();
    if ($multa_f>=$preco_trajeto_f){
        $ressarcimento_f = 0;
    } else {
        $ressarcimento_f = $preco_trajeto_f-$multa_f;
    }
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $ressarcimento_f;
}
// public function get_frequencia(): string {
//     //retornar uma string com o dia e a frequencia
//     $str = '';
//     $str .= $this->Frequencia_voo[0];
//     $str .= ' ';
//     $str .= $this->Frequencia_voo[1];
//     $method = __METHOD__;
//     new logLeitura(get_called_class(), $method);
//     return $str;
// }
// public function set_frequencia($frequencia_voo_f, $dia_f): void {
//     $dia = '';
//     $frequencia = '';
//     try{
//         if (isset(self::$dict_frequencias[$frequencia_voo_f])) {
//             $frequencia = self::$dict_frequencias[$frequencia_voo_f];
//         } else {
//             throw new Exception("\nCódigo de frequência inválido.");
//         }
//         if (isset(self::$dict_dias[$dia_f])) {
//             $dia = self::$dict_dias[$dia_f];
//         } else {
//             throw new Exception("\nCódigo de dia inválido.\n");
//         }
//     }catch(Exception $e){
//         echo $e->getMessage();
//     }
//     if (isset($this->Frequencia_voo)){
//         $objectBefore = $this->Frequencia_voo;
//     } else {
//         $objectBefore = null;
//     }
//     $this->Frequencia_voo = [$dia, $frequencia];
//     $objectAfter = $this->Frequencia_voo;
//     new logEscrita(get_called_class(), $objectBefore, $objectAfter);
// }
public function get_origem(): Aeroporto {
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->Aeroporto_origem;
}
public function set_origem($Aerop_origem_f): void {
    try {
        if ($Aerop_origem_f instanceof Aeroporto){
            if(isset($this->Aeroporto_origem)){
                $objectBefore = $this->Aeroporto_origem;
            } else {
                $objectBefore = null;
            }
            $this->Aeroporto_origem = $Aerop_origem_f;
            $objectAfter = $this->Aeroporto_origem;
            new logEscrita(get_called_class(), $objectBefore, $objectAfter);
        } else{
            throw new Exception("\nAeroporto de origem invalido");
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }
}
public function get_destino(): Aeroporto {
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->Aeroporto_destino;
}
public function set_destino($Aerop_destino_f): void {
    try {
        if ($Aerop_destino_f instanceof Aeroporto){
            if(isset($this->Aeroporto_destino)){
                $objectBefore = $this->Aeroporto_destino;
            } else {
                $objectBefore = null;
            }
            $this->Aeroporto_destino = $Aerop_destino_f;
            $objectAfter = $this->Aeroporto_destino;
            new logEscrita(get_called_class(), $objectBefore, $objectAfter);
        } else{
            throw new Exception("\nAeroporto de destino invalido");
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }
}
public function get_preco_trajeto(): float {
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->preco_trajeto;
}
public function set_preco_trajeto($preco_f): void {//positivo com duas casas decimais
    try {
        if ($preco_f < 0){
            throw new Exception("\nPreço não pode ser negativo");
        }
        else{
            if(isset($this->preco_trajeto)){
                $objectBefore = $this->preco_trajeto;
            } else {
                $objectBefore = null;
            }
            $this->preco_trajeto = round($preco_f,2);
            $objectAfter = $this->preco_trajeto;
            new logEscrita(get_called_class(), $objectBefore, $objectAfter);
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
public function get_hora_agenda_chegada(): DateTime {
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->hora_agendada_chegada;
}
public function set_hora_agenda_chegada($hora_agendada_chegada_f): void {
    try {
        if ($hora_agendada_chegada_f instanceof DateTime){
            if(isset($this->hora_agendada_chegada)){
                $objectBefore = $this->hora_agendada_chegada;
            } else {
                $objectBefore = null;
            }
            $this->hora_agendada_chegada = $hora_agendada_chegada_f;
            $objectAfter = $this->hora_agendada_chegada;
            new logEscrita(get_called_class(), $objectBefore, $objectAfter);
        } else{
            throw new Exception("\nHora invalida");
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }
}
public function get_hora_agenda_saida(): DateTime {
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->hora_agendada_saida;
}
public function set_hora_agenda_saida($hora_agendada_saida_f): void {
    try {
        if ($hora_agendada_saida_f instanceof DateTime){
            if(isset($this->hora_agendada_saida)){
                $objectBefore = $this->hora_agendada_saida;
            } else {
                $objectBefore = null;
            }
            $this->hora_agendada_saida = $hora_agendada_saida_f;
            $objectAfter = $this->hora_agendada_saida;
            new logEscrita(get_called_class(), $objectBefore, $objectAfter);
        } else{
            throw new Exception("\nHora invalida");
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }
}
public function get_codigo(): string {
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->codigo;
}
public function set_codigo($codigo_f): void {
    try {
      $codigo_valido = $this->validar_codigo($codigo_f, $this->get_aviao());
        if ($codigo_valido === true) {
            if(isset($this->codigo)){
                $objectBefore = $this->codigo;
            } else {
                $objectBefore = null;
            }
            $this->codigo = $codigo_f;
            $objectAfter = $this->codigo;
            new logEscrita(get_called_class(), $objectBefore, $objectAfter);
      } else {
        throw new Exception("\nCodigo invalido");
      }
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }
  
// public function set_codigo($codigo_f): void {
//     try {
//         if ($this->validar_codigo($codigo_f, $this->get_aviao())){
//             $this->codigo = $codigo_f;
//         } else{
//             throw new Exception("\nCodigo invalido");
            
//         }
//     }catch(Exception $e){
//         echo $e->getMessage();
//     }
// }
public function get_aviao(): Aeronave {
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->Aviao;
}
public function set_aviao($Aviao_f): void {
    try {
        if ($Aviao_f instanceof Aeronave){
            if(isset($this->Aviao)){
                $objectBefore = $this->Aviao;
            } else {
                $objectBefore = null;
            }
            $this->Aviao = $Aviao_f;
            $objectAfter = $this->Aviao;
            new logEscrita(get_called_class(), $objectBefore, $objectAfter);
        } else{
            throw new Exception("Aeronave invalida");
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }
}
public function inicializar_assento(){    
    //numero de assentos é definido pelo aviao
    $objectBefore = null;
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
    $objectAfter = $this->assentos;
    new logEscrita(get_called_class(), $objectBefore, $objectAfter);
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
                    throw new Exception("\nComprar assento: A fileira deve ser um numero inteiro.");
                }
            }else{
                throw new Exception("\nComprar assento: A coluna deve ser escrita como A, B, C, D, E, ou F \n.");
            }
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    $coluna = self::$dict_assentos[$letras];
    $fileira = $digitos;
    //verificar se o assento está disponivel
    try{
        if ($this->assentos[$fileira][$coluna][1] == null && $this->assentos[$fileira][$coluna][2] == true){
            $objectBefore = $this->assentos;
            $this->assentos[$fileira][$coluna][1] = $passageiro;
            $this->assentos[$fileira][$coluna][2] = false;
            $objectAfter = $this->assentos;
            new logEscrita(get_called_class(), $objectBefore, $objectAfter);
        }else{
            throw new Exception("\nComprar assento: Assento indisponivel.");
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }
}
public function liberar_assento(string $assento){
    //verificar se o assento existe
    try {
        preg_match_all('/\d+|\D+/', $assento, $matches);
        $digitos = "{$matches[0][0]}";
        $letras = "{$matches[0][1]}";
        if (ctype_alpha($letras)){
            if (ctype_digit($digitos) && $digitos < 101){
                if ($digitos > $this->assentos){
                    throw new Exception("\nLiberar assento: A fileira deve ser um numero inteiro.");
                }
            }else{
                throw new Exception("\nLiberar assento: A coluna deve ser escrita como A, B, C, D, E, ou F \n.");
            }
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    $coluna = self::$dict_assentos[$letras];
    $fileira = $digitos;
    //verificar se o assento está ocupado
    try{
        if ($this->assentos[$fileira][$coluna][1] != null && $this->assentos[$fileira][$coluna][2] == false){
            $objectBefore = $this->assentos;
            $this->assentos[$fileira][$coluna][1] = null;
            $this->assentos[$fileira][$coluna][2] = true;
            $objectAfter = $this->assentos;
            new logEscrita(get_called_class(), $objectBefore, $objectAfter);
        }else{
            throw new Exception("\nLiberar assento: Assento indisponivel.");
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
                $ocupados .= ("\n").$assento[1]->get_nome_passageiro()." ".$assento[1]->get_sobrenome_passageiro()." está sentado/a no assento {$assento[0]}";
            }
        }
    }
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $ocupados;
}
public static function get_hist_planejado(): string {
    //deve retornar uma string com todos os voos planejados
    $string = "";
    foreach (self::$historico_planejado as $voo){
        $string .= "Voo " . $voo->get_codigo() . " da " . $voo->get_aviao()->get_companhia_aerea()->get_nome() . " de " . $voo->get_origem()->get_sigla_aero() . " para " . $voo->get_destino()->get_sigla_aero() . " marcado para " . $voo->get_hora_agenda_saida()->format('d/m/Y H:i') . " com chegada " . $voo->get_hora_agenda_chegada()->format('d/m/Y H:i') . "\n";
    }
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
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
        $method = __METHOD__;
        new logLeitura(get_called_class(), $method);
        return $voos_proximos;
}
public static function proximos_voos_string(): string {
        $voos_proximos = self::buscar_proximos_voos();
        $string = "";
        foreach ($voos_proximos as $voo) {
            $string .= "Voo " . $voo->get_codigo() . " da " . $voo->get_aviao()->get_companhia_aerea()->get_nome() . " de " . $voo->get_origem()->get_sigla_aero() . " para " . $voo->get_destino()->get_sigla_aero() . " marcado para " . $voo->get_hora_agenda_saida()->format('d/m/Y H:i') . " com chegada " . $voo->get_hora_agenda_chegada()->format('d/m/Y H:i') . "\n";
        }
        $method = __METHOD__;
        new logLeitura(get_called_class(), $method);
        return $string;
}
public function validar_codigo($codigo, $Aviao_esperado_f) {
    // Codigo composto por 2 letras e 4 numeros
    $letras = substr($codigo, 0, 2);
    $sigla_comp_aerea = $Aviao_esperado_f->get_companhia_aerea()->get_sigla();
    
    if ($letras != $sigla_comp_aerea) {
    //   echo "\nErro: Codigo do voo nao corresponde a companhia aerea";
    //   echo "\nO codigo esperado deveria ser: " . $Aviao_esperado_f->get_companhia_aerea()->get_sigla();
      
      // Alterar o registro com a sigla correta
      $codigo_corrigido = $sigla_comp_aerea . substr($codigo, 2);
      //echo "\nCodigo corrigido: " . $codigo_corrigido;
      $method = __METHOD__;
      new logLeitura(get_called_class(), $method);
      return $codigo_corrigido;
    }
    
    $numeros = substr($codigo, 2, 4);
    if (ctype_alpha($letras) && ctype_digit($numeros)) {
      return true;
    } else {
      return false;
    }
  }

public function get_pontos_voo(){
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->pontos_viagem;
}

public function set_pontos_voo($p){
    if(isset($this->pontos_viagem)){
        $objectBefore = $this->pontos_viagem;
    }else{
        $objectBefore = null;
    }
    $this->pontos_viagem = $p;
    $objectAfter = $this->pontos_viagem;
    new logEscrita(get_called_class(), $objectBefore, $objectAfter);
}

public function ordenar_voos($voos) : array
{
    $voos_ordenados = [];
    $voos_ordenados[] = $voos[0];
    for ($i = 1; $i < count($voos); $i++){
        $j = 0;
        while ($j < count($voos_ordenados) && $voos[$i]->get_hora_agenda_saida() > $voos_ordenados[$j]->get_hora_agenda_saida()){
            $j++;
        }
        array_splice($voos_ordenados, $j, 0, $voos[$i]);
    }
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $voos_ordenados;
}
public function get_assentos_livres():int{
    $livres = 0;
    foreach ($this->assentos as $fileira) {
        foreach ($fileira as $assento) {
            if ($assento[2]) { // verifica se o assento está ocupado
                $livres++;
            }
        }
    }
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $livres;
}
public function buscar_voos(array $voos, int $numero_de_passagens) : array
{
    $voos_disponiveis = [];
    foreach ($voos as $voo){
        if ($voo->get_assentos_livres() - $numero_de_passagens >= 0){
            $voos_disponiveis[] = $voo;
        }
    }
    $voos_disponiveis = self::ordenar_voos($voos_disponiveis);
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $voos_disponiveis;

}
public function pesquisar_voos($origem, $destino, $data, $numero_de_passagens){
    $voos_disponiveis = [];
    foreach (self::$historico_planejado as $voo){
        if ($voo->get_origem()->get_sigla_aero() == $origem && $voo->get_destino()->get_sigla_aero() == $destino && $voo->get_hora_agenda_saida()->format('d/m/Y') == $data){
            $voos_disponiveis[] = $voo;
        }
    }
    if (count($voos_disponiveis) == 0){
        echo "\nNão há voos disponiveis para a data e origem/destino selecionados.";
        return false;
    }else{
        $voos_disponiveis = self::ordenar_voos($voos_disponiveis);
        $voos_disponiveis = self::buscar_voos($voos_disponiveis, $numero_de_passagens);
        if (count($voos_disponiveis) == 0){
            echo "\nNão há voos disponiveis para a quantidade de passagens selecionada.";
            return false;
        }else{
            $method = __METHOD__;
            new logLeitura(get_called_class(), $method);
            return $voos_disponiveis;
        }
    }
}
}