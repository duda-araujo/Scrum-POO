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
    protected CartaoDeEmbarque $cartao_de_embarque1;
    protected ?CartaoDeEmbarque $cartao_de_embarque2 = null;

    protected int $Numero_bagagens;
    protected Usuario $usuario_;

public static $dict_estados = [
    0 => "Passagem Adquirida",
    1 => "Passagem Cancelada",
    2 => "Check-in Realizado",
    3 => "Embarque Realizado",
    4 => "NO SHOW",
    5 => "Check-in Não Realizado"
];
public function __construct(Aeroporto $origem_f, Aeroporto $destino_f, Passageiro $passageiro_f, int $franquia_f,Usuario $usuario_f,int $quantidade_bagagens_f,DateTime $date){
    try{
        if(Sistema::checkSessionState()==FALSE){
            throw new Exception("Usuario não foi inicializado! Não é possível acessar o sistema\n");
        }
    else{
    $this->set_usuario($usuario_f);
    $this->set_voo($origem_f, $destino_f,$date);
    $this->set_cliente($passageiro_f);
    $this->set_quantidade_bagagens($quantidade_bagagens_f);

    $this->set_preco($franquia_f,$quantidade_bagagens_f);
    $this->set_estado_da_passagem(0);
    $this->voo->comprar_assento($passageiro_f->get_assento(), $passageiro_f);
    $this->voo->set_passageiros_compraram($this);
    $this->passageiro->ultimos_doze_meses(new DateTime("now"));
    $this->Pontos_do_voo( $this->voo->get_hora_agenda_chegada(), $this->voo->get_pontos_voo());
    self::$passagens[] = $this;
    $this->usuario_->passagem_comprada($this->get_preco(),$origem_f,$destino_f);
    // $this->set_ordem_cronologica();
    echo "passagem comprada com sucesso\n";
}
}catch(Exception $e){
    echo $e->getMessage();
}
}

public function Pontos_do_voo(DateTime $t,int $p){
    $objectBefore = $this->passageiro->get_programa_de_milhagem();

    if ($this->passageiro->get_programa_de_milhagem() == null) {
        echo("\nPrograma de milhagem não definido");
    }
    else{
    $this->passageiro->adicionar_pontos($p,$t);}
    $objectAfter = $this->passageiro->get_programa_de_milhagem();
    new logEscrita(get_called_class(), $objectBefore, $objectAfter);
}
static public function getFilename() {
    return get_called_class();
}

public function get_estado_da_passagem(): string{
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->estado_da_passagem;
}
public function set_estado_da_passagem($estado_f): void {
    try{
        if (!array_key_exists($estado_f, self::$dict_estados)){
            throw new Exception("\nErro: estado da passagem inválido");
        }
        else{
            if(isset($this->estado_da_passagem)){
                $objectBefore = $this->estado_da_passagem;
                $this->estado_da_passagem = $estado_f;
                $objectAfter = $this->estado_da_passagem;
                new logEscrita(get_called_class(), $objectBefore, $objectAfter);
            }
            else{
                $objectBefore = null;
                $this->estado_da_passagem = $estado_f;
                $objectAfter = $this->estado_da_passagem;
                new logEscrita(get_called_class(), $objectBefore, $objectAfter);
            }
        }
    }catch (Exception $e){
        echo $e->getMessage();
    }
    $this->estado_da_passagem = self::$dict_estados[$estado_f];
}
public function get_preco(): float{
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->preco;
}
public function get_voo(){
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->voo;
}
public function get_tarifa(): float{
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->voo->get_aviao()->get_companhia_aerea()->get_tarifa();    
}
public function get_cliente(): Passageiro{
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->passageiro;
}
public function get_origem(): Aeroporto{
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->voo->get_origem();
}
public function get_destino(): Aeroporto{
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->voo->get_destino();
}
public function get_franquia(){
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->franquia;
}
public function get_nbagagens(): int{
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
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
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    
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
public function set_voo($origem_f, $destino_f,$date): void{
    try {
    echo "\nVerificando conexão";

    if(isset($this->voo)){
        $objectBefore = $this->voo;
      }
      else{
        $objectBefore = null;
      }
    $voos = self::verificar_conexão($origem_f, $destino_f,$date);
    $objectAfter = $voos[0];
    new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    //array to string conversion
    $objectBefore = $this->conexao;
    $this->voo = $voos[0];
    $this->conexao = $voos[1];
    $objectAfter = $this->conexao;
    new logEscrita(get_called_class(),$objectBefore, $objectAfter);
    }catch (Exception $e){
        echo $e->getMessage();
    }
}


public function set_cliente($cliente_f): void{
    try {
        if ($cliente_f instanceof Passageiro){
            if(isset($this->passageiro)){
                $objectBefore = $this->preco;
              }
              else{
                $objectBefore = null;
              }
            $this->passageiro = $cliente_f;
            $objectAfter = $this->passageiro;
            new logEscrita(get_called_class(), $objectBefore, $objectAfter);
        } else {
            throw new InvalidArgumentException("\nErro: o cliente não existe");
        }
    } catch (InvalidArgumentException $e) {
        echo $e->getMessage();
    }
}
public function verificar_conexão(Aeroporto $origem, Aeroporto $destino, $date) {
    try{
        $objectBefore = VooPlanejado::buscar_proximos_voos();
        $voos_proximos = $objectBefore;
        $voos = [];
        $formattedDate = $date->format('d/m/Y');
        // Verifica se existe algum voo direto
        foreach ($voos_proximos as $voo) {
            if ($voo->get_origem() == $origem && $voo->get_destino() == $destino && $voo->get_hora_agenda_saida()->format('d/m/Y') == $formattedDate) {
                array_push($voos, $voo, null);
                echo "\nVoo direto";

                $objectAfter = $voos;
                new logEscrita(get_called_class(), $objectBefore, $objectAfter);
                return $voos;
            }
        }
        
        // Verifica se existe algum voo com conexão
        foreach ($voos_proximos as $voo) {
            if ($voo->get_origem() === $origem && $voo->get_hora_agenda_saida()->format('d/m/Y') === $formattedDate) {
                $origem_conexão = $voo->get_destino();
                foreach ($voos_proximos as $voo_conexao) {
                    if ($origem_conexão == $voo_conexao->get_origem() && $voo_conexao->get_destino() === $destino && $voo->get_hora_agenda_chegada() <= $voo_conexao->get_hora_agenda_saida()) {
                        // echo "\nHorario de saida: ".$voo->get_hora_agenda_saida()->format('d/m/Y').
                        //     "\nHorario de chegada: ".$voo->get_hora_agenda_chegada()->format('d/m/Y').
                        //     "\nOrigem: ". $voo_conexao->get_origem()->get_cidade().
                        //     "\nDestino: ". $voo_conexao->get_destino()->get_cidade();

                        array_push($voos, $voo, $voo_conexao);
                        echo "\nCONEXÃO - Origem: ".$voo->get_origem()->get_cidade(). " " . $voo->get_destino()->get_cidade()."\n".
                                "Destino: ".$voo_conexao->get_origem()->get_cidade(). " " . $voo_conexao->get_destino()->get_cidade();
                        echo "\nVoo com conexão";

                        $objectAfter = $voos;
                        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
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
    $objectBefore = $this->estado_da_passagem;
    $this->set_estado_da_passagem(1);
    $objectAfter = $this->estado_da_passagem;
    new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    //liberar assento
    $this->voo->liberar_assento($this->passageiro->get_assento());
    echo "\nPassagem cancelada";
    if($this->preco>$this->voo->get_multa()){
    $a=$this->preco-$this->voo->get_multa();

    $objectBefore = $this->get_origem();
    $objectAfter = $this->get_destino();

    $objectBefore = $a;
    $this->usuario_->passagem_cancelada($a,$this->get_origem(),$this->get_destino());
    $objectAfter = null;
    new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }else{
    $a=0.00;

    $objectBefore = $this->get_origem();
    $objectAfter = $this->get_destino();
    $objectBefore = $a;
    $this->usuario_->passagem_cancelada($a,$this->get_origem(),$this->get_destino());
    $objectAfter = null;
    new logEscrita(get_called_class(), $objectBefore, $objectAfter);

    }
}

public function get_cartao_de_embarque1(){
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->cartao_de_embarque1;
}
public function get_cartao_de_embarque2(){
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->cartao_de_embarque2;
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

        $objectBefore = $this->get_estado_da_passagem();

        if ($diferenca_horas <= 48 || ($diferenca_horas == 0 && $diferenca_minutos >= 30)) {
            if ($this->get_estado_da_passagem() == "Passagem Adquirida"){

                $objectBefore = $this->get_estado_da_passagem();
                $this->set_estado_da_passagem(2);
                $objectAfter = $this->get_estado_da_passagem();
                new logEscrita(get_called_class(), $objectBefore, $objectAfter);
                echo "\nCheck-in realizado";

                $this->cartao_de_embarque1 = new CartaoDeEmbarque($this->voo,$this->passageiro);
                //se tiver conexao, cartao de embarque 2 é construido
                if(!($this->conexao == null)){
                    $this->cartao_de_embarque2 = new CartaoDeEmbarque($this->conexao,$this->passageiro);
               } 
               
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
    $objectBefore = $this->get_estado_da_passagem();
    $this->set_estado_da_passagem(3);
    $objectAfter = $this->get_estado_da_passagem();
    new logEscrita(get_called_class(), $objectBefore, $objectAfter);
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

public function set_quantidade_bagagens($quantidade_bagagens_f): void {//entre 0 e 3
    try {
        if ($quantidade_bagagens_f < 0){
            throw new Exception("\nFranquia não pode ser negativa");
        }
        else if($quantidade_bagagens_f > 3){
            throw new Exception("\nFranquia maxima eh 3");
        }
        else{
            if(isset($this->franquia)){
                $objectBefore = $this->franquia;
              }
              else{
                $objectBefore = null;
              }
            $this->franquia = $quantidade_bagagens_f;
            $objectAfter = $this->franquia;
            new logEscrita(get_called_class(), $objectBefore, $objectAfter);
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

public function set_preco($franquia_f,$quantidade_bagagens_f){
    if(isset($this->preco)){
        $objectBefore = $this->preco;
      }
      else{
        $objectBefore = null;
      }
    if($this->passageiro->get_vip() == false){ //Nao vip
    if($this->conexao == null){//nao vip sem conexao
      $a= $this->voo->get_aviao();
      $b=$a->get_companhia_aerea();
      $c=$b->get_preco_bagagem();
      $this->preco=$this->voo->get_preco_trajeto() + $franquia_f * $quantidade_bagagens_f;
      $objectAfter = $this->preco;
      new logEscrita(get_called_class(), $objectBefore, $objectAfter);
}
    else {//nao vip com conexao
      $a= $this->voo->get_aviao();
      $b=$a->get_companhia_aerea();
      $c=$b->get_preco_bagagem();
      $d= $this->conexao->get_aviao();
      $e=$d->get_companhia_aerea();
      $f=$e->get_preco_bagagem();
      if(isset($this->preco)){
        $objectBefore = $this->preco;
      }
      else{
        $objectBefore = null;
      }
      $this->preco= $this->voo->get_preco_trajeto() + $this->conexao->get_preco_trajeto() + $franquia_f *$quantidade_bagagens_f;
      $objectAfter = $this->preco;
      new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
}
    else{//vip
        if($this->conexao == null){//vip sem conexao
            $a= $this->voo->get_aviao();
            $b=$a->get_companhia_aerea();
            $c=$b->get_preco_bagagem();
            if($franquia_f!=0){//vip sem conexao e com bagagem
            $this->preco=$this->voo->get_preco_trajeto() + ($quantidade_bagagens_f - 1) * ($franquia_f/2);
            }
            else{//vip sem conexao sem bagagem
            $this->preco=$this->voo->get_preco_trajeto();
            }
            $objectAfter = $this->preco;
            new logEscrita(get_called_class(), $objectBefore, $objectAfter);
        }
        else {//vip com conexao
            $a= $this->voo->get_aviao();
            $b=$a->get_companhia_aerea();
            $c=$b->get_preco_bagagem();
            $d= $this->conexao->get_aviao();
            $e=$d->get_companhia_aerea();
            $f=$e->get_preco_bagagem();
            if($franquia_f !=0){//vip com conexao e bagagem
            $this->preco= $this->voo->get_preco_trajeto() + $this->conexao->get_preco_trajeto() + ($quantidade_bagagens_f - 1) *($franquia_f/2);
            }
            else{//vip com conexao sem bagagem
            $this->preco= $this->voo->get_preco_trajeto() + $this->conexao->get_preco_trajeto();
            }
    }
}
$objectAfter = $this->preco;
new logEscrita(get_called_class(), $objectBefore, $objectAfter);
}
    public function set_usuario($usuario_f){
        if(isset($this->usuario_)){
            $objectBefore = $this->usuario_;
        }
        else{
            $objectBefore = null;
        }
        $this->usuario_=$usuario_f;
        $objectAfter = $this->usuario_;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }

    public function get_usuario(){
        $method = __METHOD__;
        new logLeitura(get_called_class(), $method);
        return $this->usuario_;
    }
    public function get_conexao(){
        $method = __METHOD__;
        new logLeitura(get_called_class(), $method);
        return $this->conexao;
    }
}