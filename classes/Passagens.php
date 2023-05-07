<?php

include_once "VooPlanejado.php";
include_once "Aeroporto.php";
include_once "Passageiro.php";
include_once "Aeronave.php";
class Passagens extends persist{
    protected VooPlanejado $voo;
    protected ?VooPlanejado $conexao = null;
    protected Passageiro $passageiro;
    public static array $passagens = []; 
    protected float $preco;
    protected string $estado_da_passagem;
    protected int $franquia;

public static $dict_estados = [
    0 => "Passagem Adquirida",
    1 => "Passagem Cancelada",
    2 => "Check-in Realizado",
    3 => "Embarque Realizado",
    4 => "NO SHOW",
    5 => "Check-in Não Realizado"
];
public function __construct(Aeroporto $origem_f, Aeroporto $destino_f, Passageiro $passageiro_f, int $franquia_f){
    $this->set_voo($origem_f, $destino_f);
    $this->set_cliente($passageiro_f);
    $this->set_franquia($franquia_f);
    $this->set_preco($franquia_f);
    $this->set_estado_da_passagem(0);
    $this->voo->comprar_assento($passageiro_f->get_assento(), $passageiro_f);
    $this->voo->set_passageiros_compraram($this);
    $this->passageiro->ultimos_doze_meses(new DateTime("now"));
    $this->Pontos_do_voo( $this->voo->get_hora_agenda_chegada(), $this->voo->get_pontos_voo());
    self::$passagens[] = $this;
    // $this->set_ordem_cronologica();
}

public function Pontos_do_voo(DateTime $t,int $p){
    $this->passageiro->adicionar_pontos($p,$t);
}
static public function getFilename() {
    return get_called_class()::$local_filename;
}
public function get_estado_da_passagem(): string{
    return $this->estado_da_passagem;
}
public function set_estado_da_passagem($estado_f): void {
    try{
        if (!array_key_exists($estado_f, self::$dict_estados)){
            throw new Exception("\nErro: estado da passagem inválido");
        }
    }catch (Exception $e){
        echo $e->getMessage();
    }
    $this->estado_da_passagem = self::$dict_estados[$estado_f];
}
public function get_preco(): float{
    return $this->preco;
}
public function get_voo(){
    return $this->voo;
}
public function get_tarifa(): float{
    return $this->voo->get_aviao()->get_companhia_aerea()->get_tarifa();    
}
public function get_cliente(): Passageiro{
    return $this->passageiro;
}
public function get_origem(): Aeroporto{
    return $this->voo->get_origem();
}
public function get_destino(): Aeroporto{
    return $this->voo->get_destino();
}
public function get_franquia(){
    return $this->franquia;
}
public function get_nbagagens(): int{
    return $this->passageiro->get_nbagagens();
}
public static function get_passagens(string $cpf_passageiro_f): array{
    $passagens_p = [];
    foreach(self::$passagens as $passagens1){
        $cpf = $passagens1->get_cliente()->get_cpf();
        if($cpf == $cpf_passageiro_f){
            $passagens_p[] = $passagens1;
        }
    } 
    usort($passagens_p, function($a, $b){
        $hora_saida_a = $a->voo->get_hora_agenda_saida();
        $hora_saida_b = $b->voo->get_hora_agenda_saida();

        if($hora_saida_a < $hora_saida_b){
            return -1;
        } else if($hora_saida_a > $hora_saida_b){
            return 1;
        } else {
            return 0;
        }
    });
    
    return $passagens_p;
}

public function comprar_bagagem(): float{
    $nbagagens = $this->get_nbagagens();
    $tarifa = $this->get_tarifa();
    return $nbagagens*$tarifa;
}
// public static function set_ordem_cronologica(): array{
//     $new_passagens = [];
//     foreach(self::$passagens as $passagens1){
//         $hora_base = $passagens1->voo->get_hora_agenda_saida();
//         foreach(self::$passagens as $passagens2){
//             if($passagens2->voo->get_hora_agenda_saida() < $hora_base){
//                 $hora_base=$passagens2->voo->get_hora_agenda_saida();
//                 $new_passagens[]=$passagens2;
//             }
//         }
//     } return $new_passagens;
// }
public function set_voo($origem_f, $destino_f): void{
    echo "\nVerificando conexão";
    $voos = self::verificar_conexão($origem_f, $destino_f);
    //array to string conversion
    $this->voo = $voos[0];
    $this->conexao = $voos[1];
}


public function set_cliente($cliente_f): void{
    try {
        if ($cliente_f instanceof Passageiro){
            $this->passageiro = $cliente_f;
        } else {
            throw new InvalidArgumentException("\nErro: o cliente não existe");
        }
    } catch (InvalidArgumentException $e) {
        echo $e->getMessage();
    }
}
public function verificar_conexão(Aeroporto $origem, Aeroporto $destino) {
    try{
        $voos_proximos = VooPlanejado::buscar_proximos_voos();
        $voos = [];
        // Verifica se existe algum voo direto
        foreach ($voos_proximos as $voo) {
            if ($voo->get_origem() === $origem && $voo->get_destino() === $destino) {
                array_push($voos, $voo, null);
                echo "\nVoo direto";
                return $voos;
            }
        }
        
        // Verifica se existe algum voo com conexão
        foreach ($voos_proximos as $voo) {
            if ($voo->get_origem() === $origem) {
                foreach ($voos_proximos as $voo_conexao) {
                    if ($voo_conexao->get_destino() === $destino && $voo->get_hora_agenda_chegada() <= $voo_conexao->get_hora_agenda_saida()) {
                        array_push($voos, $voo, $voo_conexao);
                        echo "\nVoo com conexão";
                        return $voos;
                    }
                }
            }
        }
        throw new Exception("\nErro: não existe voo direto ou com conexão");
    }catch (Exception $e){
        echo $e->getMessage();
    }
}
public function cancelar_passagem(): void{
    $this->set_estado_da_passagem(1);
    //liberar assento
    $this->voo->liberar_assento($this->passageiro->get_assento());
    echo "\nPassagem cancelada";
}

public function realizar_check_in(): void{
    ###O sistema deve permitir o check-in de passagens já adquiridas em um período compreendido
    //entre 48h e 30 minutos do horário de partida do primeiro vôo. Em caso de não realização do 
    //check-in o sistema deve registrar o NO SHOW, que indica o não comparecimento do passageiro. ###
    try{
        $now = new DateTime();
        $horario_partida = $this->voo->get_hora_agenda_saida();
        $diferenca_horas = $horario_partida->diff($now)->h;
        $diferenca_minutos = $horario_partida->diff($now)->i;
        if ($diferenca_horas <= 48 || ($diferenca_horas == 0 && $diferenca_minutos >= 30)) {
            if ($this->get_estado_da_passagem() == "Passagem Adquirida"){
                $this->set_estado_da_passagem(2);
                echo "\nCheck-in realizado";
            }else{
                throw new Exception("\nErro: O estado não permite check-in");
            }

        } else {
            throw new Exception("\nErro: O check-in deve ser realizado entre 48h e 30 minutos antes do horário de partida");
        }
    }catch (Exception $e){
        echo $e->getMessage();
    }
}
public function set_no_show(): void{
    $this->set_estado_da_passagem(3);
    echo "\nNo show registrado";
}

public function string_passagem(): string{
    $nome = $this->get_cliente()->get_nome_passageiro();
    $sobrenome = $this->get_cliente()->get_sobrenome_passageiro();
    $origem = $this->get_origem()->get_nome_aero();
    $destino = $this->get_destino()->get_nome_aero();
    $preco = $this->get_preco();
    $franquia = $this->get_franquia();

    return "\nPassagem comprada para $nome $sobrenome, de $origem para $destino, com franquia de $franquia kg e preço de R$$preco";
}       

public function set_franquia($franquia_f): void {//entre 0 e 3
    try {
        if ($franquia_f < 0){
            throw new Exception("\nFranquia não pode ser negativa");
        }
        else if($franquia_f > 3){
            throw new Exception("\nFranquia maxima eh 3");
        }
        else{
            $this->franquia = $franquia_f;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

public function set_preco($franquia_f){
    if($this->passageiro->get_vip() == false){ //Nao vip
    if($this->conexao == null){//nao vip sem conexao
      $a= $this->voo->get_aviao();
      $b=$a->get_companhia_aerea();
      $c=$b->get_preco_bagagem();
      $this->preco=$this->voo->get_preco_trajeto() + $franquia_f * $c;
}
    else {//nao vip com conexao
      $a= $this->voo->get_aviao();
      $b=$a->get_companhia_aerea();
      $c=$b->get_preco_bagagem();
      $d= $this->conexao->get_aviao();
      $e=$d->get_companhia_aerea();
      $f=$e->get_preco_bagagem();
      $this->preco= $this->voo->get_preco_trajeto() + $this->conexao->get_preco_trajeto() + $franquia_f *($c + $f);
    }
}
    else{//vip
            if($this->conexao == null){//vip sem conexao
              $a= $this->voo->get_aviao();
              $b=$a->get_companhia_aerea();
              $c=$b->get_preco_bagagem();
              if($franquia_f!=0){//vip sem conexao e com bagagem
              $this->preco=$this->voo->get_preco_trajeto() + ($franquia_f - 1) * ($c/2);
              }
              else{//vip sem conexao sem bagagem
              $this->preco=$this->voo->get_preco_trajeto();
              }
        }
            else {//vip com conexao
              $a= $this->voo->get_aviao();
              $b=$a->get_companhia_aerea();
              $c=$b->get_preco_bagagem();
              $d= $this->conexao->get_aviao();
              $e=$d->get_companhia_aerea();
              $f=$e->get_preco_bagagem();
              if($franquia_f !=0){//vip com conexao e bagagem
              $this->preco= $this->voo->get_preco_trajeto() + $this->conexao->get_preco_trajeto() + ($franquia_f - 1) *(($c + $f)/2);
              }
              else{//vip com conexao sem bagagem
              $this->preco= $this->voo->get_preco_trajeto() + $this->conexao->get_preco_trajeto();
              }
    }
}
}
}