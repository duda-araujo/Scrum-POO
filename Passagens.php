<?php

include_once "VooPlanejado.php";
include_once "Aeroporto.php";
include_once "Passageiro.php";
include_once "Aeronave.php";
class Passagens{
    protected VooPlanejado $voo;
    protected ?VooPlanejado $conexao = null;
    protected Passageiro $passageiro;
    public static array $passagens = []; 
    protected float $preco;
    protected string $estado_da_passagem;

public static $dict_estados = [
    0 => "Passagem Adquirida",
    1 => "Passagem Cancelada",
    2 => "Check-in Realizado",
    3 => "Embarque Realizado",
    4 => "NO SHOW",
    5 => "Check-in Não Realizado"
];
public function __construct(Aeroporto $origem_f, Aeroporto $destino_f, Passageiro $passageiro_f){
    $this->set_voo($origem_f, $destino_f);
    $this->set_cliente($passageiro_f);
    $this->set_preco();
    $this->set_estado_da_passagem(0);
    $this->voo->comprar_assento($passageiro_f->get_assento(), $passageiro_f);
    $this->voo->set_passageiros_compraram($this);
    self::$passagens[] = $this;
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
public function get_cliente(): Passageiro{
    return $this->passageiro;
}
public function get_origem(): Aeroporto{
    return $this->voo->get_origem();
}
public function get_destino(): Aeroporto{
    return $this->voo->get_destino();
}
public function get_franquia(): int{
    return $this->voo->get_franquia();
}
public function get_tarifa(): float{
    return $this->voo->get_aviao()->get_tarifa();
}
public function get_nbagagens(): int{
    return $this->passageiro->get_nbagagens();
}
public function set_preco(): void{
    if ($this->conexao == null){
        $this->preco = $this->voo->get_preco();
    }
    else{
        $this->preco = $this->voo->get_preco() + $this->conexao->get_preco();
    }
}

public function comprar_bagagem(): float{
    $nbagagens = $this->get_nbagagens();
    $tarifa = $this->get_tarifa();
    return $nbagagens*$tarifa;
}
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
}