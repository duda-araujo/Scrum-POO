<?php
include_once("Aeronave.php");
include_once("VooPlanejado.php");
include_once("Passagens.php");
include_once("Embarque.php");

class Viagem extends VooPlanejado{
    protected Aeronave $aviao_voo;
    protected DateTime $chegada;
    protected DateTime $saida;
    protected VooPlanejado $voo_anunciado;
    protected Embarque $embarque;
    public static array $historico_executado = []; 
    public static array $comissarios_de_bordo = [];
    protected Piloto $piloto;
    protected Piloto $copiloto;

    public function __construct($voo_anunciado_f,$saida_f,$chegada_f,$Aviao_voo_f, $embarque_f,$piloto_f, $copiloto_f){
        $this-> set_voo_anunciado($voo_anunciado_f);
        $this->set_saida($saida_f);
        $this->set_chegada($chegada_f);
        $this->set_aviao_voo($Aviao_voo_f);
        $this->comparar_passageiros($embarque_f);
        self::$historico_executado[] = $this;
        $this->set_piloto($piloto_f);
        $this->set_copiloto($copiloto_f);
    }
    static public function getFilename() {
        return get_called_class();
      }
      public function gerarLogLeitura($entity, $attribute)
      {
          // Implementação do log de leitura específico para Aeroporto
          $log = "User: " . "Usuário" . "\n";
          $dateTime = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
          $log .= "Date/Time: " . $dateTime . "\n";
          $log .= "   Entity: " . $entity . "\n";
          $log .= "   Attribute: " . $attribute . "\n";
      
          // Salvar o log em um arquivo ou em algum outro meio de armazenamento
          file_put_contents('logLeitura.txt', $log, FILE_APPEND);
      }
      public function gerarLogEscrita($entity, $objectBefore, $objectAfter){
          // Implementação do log de escrita específico para Aeroporto
          $log = "User: " . "Usuário" . "\n";
          $dateTime = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
          $log .= "Date/Time: " . $dateTime . "\n";
          $log .= "   Entity: " . $entity . "\n";
          $log .= "   Object before: " . $objectBefore . "\n";
          $log .= "   Object after: " . $objectAfter . "\n";
      
          // Salvar o log em um arquivo ou em algum outro meio de armazenamento
          file_put_contents('logEscrita.txt', $log, FILE_APPEND);
      }
    public function get_chegada(): DateTime {
        return $this->chegada;
    }
    public function set_chegada($chegada_f): void {
        try {
            if ($chegada_f instanceof DateTime){
                $this->chegada = $chegada_f;
            } else {
                throw new InvalidArgumentException("\nErro: chegada não é uma data");
            }
        } catch (InvalidArgumentException $e) {
            echo $e->getMessage();
        }
    }
    public function get_saida(): DateTime {
        return $this->saida;
    }
    public function set_saida($saida_f): void {
        try {
            if ($saida_f instanceof DateTime){
                $this->saida = $saida_f;
            } else {
                throw new InvalidArgumentException("\nErro: saida não é uma data");
            }
        } catch (InvalidArgumentException $e) {
            echo $e->getMessage();
        }
    }
    public function get_voo_anunciado(): VooPlanejado {
        return $this->voo_anunciado;
    }
    public function set_voo_anunciado($voo_anunciado_f): void {
        try {
            if ($voo_anunciado_f instanceof VooPlanejado){
                $this->voo_anunciado = $voo_anunciado_f;
            } else {
                throw new InvalidArgumentException("\nErro: o voo não existe");
            }
        } catch (InvalidArgumentException $e) {
            echo $e->getMessage();
        }
    }
    public function get_aviao_voo(): Aeronave {
        return $this->aviao_voo;
    }   
    public function set_aviao_voo($aviao_voo_f): void {
        try {
            if ($aviao_voo_f instanceof Aeronave){
                $this->aviao_voo = $aviao_voo_f;
            } else {
                throw new InvalidArgumentException("Erro: a aeronave não existe");
            }
        } catch (InvalidArgumentException $e) {
            echo $e->getMessage();
        }
    }

    public function get_passageiros_embarcados(Embarque $embarque) {
        try{
            if ($embarque->get_voo() == $this->get_voo_anunciado()){
                if ($embarque->get_status_embarque()=="Embarque finalizado"){
                    return $embarque->get_passageiros_embarcados();
                } else {
                    throw new Exception("Erro: o embarque não foi finalizado");
                }
            } else {
                throw new Exception("Erro: o embarque não é deste voo");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function comparar_passageiros($embarque){
        $passagens_embarcadas = $this->get_passageiros_embarcados($embarque);
        $passagens_compradas = $this->get_voo_anunciado()->get_passageiros_compraram();
        $no_show = array_udiff($passagens_compradas, $passagens_embarcadas, function($a, $b){
            return $a->get_cliente()->get_nome_passageiro() <=> $b->get_cliente()->get_nome_passageiro();
        });
        
        if (count($no_show) > 0){
            foreach ($no_show as $passageiro){
                $passageiro->set_no_show();
                echo "\nPassageiro " . $passageiro->get_cliente()->get_nome_passageiro() . " não embarcou no voo " . $this->get_voo_anunciado()->get_codigo() . " da " . $this->get_aviao_voo()->get_companhia_aerea()->get_nome() . " de " . $this->get_voo_anunciado()->get_origem()->get_sigla_aero() . " para " . $this->get_voo_anunciado()->get_destino()->get_sigla_aero() . " saiu às " . $this->get_saida()->format('d/m/Y H:i') . " e chegou às " . $this->get_chegada()->format('d/m/Y H:i') . "\n";
            }
        }
    }
    public function cadastrar_comissario_de_bordo(ComissarioDeBordo $comissario_de_bordo_f){
        foreach (self::$voo_anunciado->get_aviao()->get_companhia_aerea()->get_comissarios_de_bordo() as $comissario_de_bordo){
            if ($comissario_de_bordo->get_cpf() == $comissario_de_bordo_f->get_cpf()){
                array_push($this->comissarios_de_bordo, $comissario_de_bordo_f);
                return;
            }
        }
    }
    public function set_piloto(Piloto $piloto_f){
       $this->piloto = $piloto_f;
    }
    public function set_copiloto(Piloto $copiloto_f){
        $this->copiloto = $copiloto_f;
     }
     


    
    public function get_hist_executado(): string
    {
        //deve retornar uma string com todos os voos executados
        $string = "";
        foreach (self::$historico_executado as $voo){
            $string .=  "Voo " . $voo->get_voo_anunciado()->get_codigo() . 
                        " da " . $voo->get_aviao_voo()->get_companhia_aerea()->get_nome() . 
                        " de " . $voo->get_voo_anunciado()->get_origem()->get_sigla_aero() . 
                        " para " . $voo->get_voo_anunciado()->get_destino()->get_sigla_aero() . 
                        " saiu às " . $voo->get_saida()->format('d/m/Y H:i') . 
                        " e chegou às " . $voo->get_chegada()->format('d/m/Y H:i') . "\n";
        }
        return $string;
}

}

