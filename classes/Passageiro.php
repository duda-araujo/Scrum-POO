<?php
include_once "ProgramaDeMilhagem.php";
class Passageiro extends persist{
   protected string $nome_passageiro;
    protected string $sobrenome_passageiro;
    protected string $documento_passageiro;
    protected string $nacionalidade;
    protected string $cpf;
    protected DateTime $data_de_nascimento;
    protected ?ProgramaDeMilhagem $programa_de_milhagem = null;
    protected string $categoria;
    protected int $pontos;
    protected array $historico_de_pontos=[];
    protected string $email;
    protected int $numero_bagagens;
    protected string $assento;
    protected bool $vip=false;    
public function __construct($nome_p, $sobrenome_p, $documento_p, $nbagagens_p, $vip_p, $nacionalidade_p, $cpf_p, $data_de_nascimento_p, $data_atual_p, $email_p, $assento_p, $programa = null){
    try{
        if(Sistema::checkSessionState()==FALSE){
            throw new Exception("usuario nao foi inicializado");
        }
        else{
    $this->set_nome_passageiro($nome_p);
    $this->set_sobrenome_passageiro($sobrenome_p);
    $this->set_documento_passageiro($documento_p);
    $this->set_numero_bagagens($nbagagens_p);
    $this->set_nacionalidade($nacionalidade_p);
    $this->set_cpf($cpf_p);
    $this->set_data_de_nascimento($data_de_nascimento_p, $data_atual_p);
    $this->set_email($email_p);
    $this->set_assento($assento_p);
    $this->set_programa_de_milhagem($programa);
}
}catch(Exception $e){
    echo $e->getMessage();
}

}
static public function getFilename() {
   return get_called_class();
}
public function set_programa_de_milhagem(?ProgramaDeMilhagem $p){
    if(isset($this->programa_de_milhagem)){
        $objectBefore = $this->programa_de_milhagem;
        $this->programa_de_milhagem = $p;
        $objectAfter = $this->programa_de_milhagem;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }else{
        $objectBefore = null;
        $this->programa_de_milhagem = $p;
        $objectAfter = $this->programa_de_milhagem;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
}
public function get_programa_de_milhagem(){
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->programa_de_milhagem;
}
public function set_assento($assento_p){
    if(isset($this->assento)){
        $objectBefore = $this->assento;
        $this->assento = $assento_p;
        $objectAfter = $this->assento;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }else{
        $objectBefore = null;
        $this->assento = $assento_p;
        $objectAfter = $this->assento;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
}
public function get_assento(){
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->assento;
}
public function set_nome_passageiro($nome_p){
    if(isset($this->nome_passageiro)){
        $objectBefore = $this->nome_passageiro;
        $this->nome_passageiro = $nome_p;
        $objectAfter = $this->nome_passageiro;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }else{
        $objectBefore = null;
        $this->nome_passageiro = $nome_p;
        $objectAfter = $this->nome_passageiro;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
}
public function set_sobrenome_passageiro($sobrenome_f){
    if(isset($this->sobrenome_passageiro)){
        $objectBefore = $this->sobrenome_passageiro;
        $this->sobrenome_passageiro = $sobrenome_f;
        $objectAfter = $this->sobrenome_passageiro;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }else{
        $objectBefore = null;
        $this->sobrenome_passageiro = $sobrenome_f;
        $objectAfter = $this->sobrenome_passageiro;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
}
public function set_documento_passageiro($documento_f){
    if(isset($this->documento_passageiro)){
        $objectBefore = $this->documento_passageiro;
        $this->documento_passageiro = $documento_f;
        $objectAfter = $this->documento_passageiro;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }else{
        $objectBefore = null;
        $this->documento_passageiro = $documento_f;
        $objectAfter = $this->documento_passageiro;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
}
public function set_numero_bagagens($numero_bagagens_f){
    if(isset($this->numero_bagagens)){
        $objectBefore = $this->numero_bagagens;
        $this->numero_bagagens = $numero_bagagens_f;
        $objectAfter = $this->numero_bagagens;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }else{
        $objectBefore = null;
        $this->numero_bagagens = $numero_bagagens_f;
        $objectAfter = $this->numero_bagagens;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
}
public function set_nacionalidade($nacionalidade_f) {
    if(isset($this->nacionalidade)){
        $objectBefore = $this->nacionalidade;
        $this->nacionalidade = $nacionalidade_f;
        $objectAfter = $this->nacionalidade;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }else{
        $objectBefore = null;
        $this->nacionalidade = $nacionalidade_f;
        $objectAfter = $this->nacionalidade;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
}
public function set_data_de_nascimento($data_de_nascimento_f, $data_atual_f) {
    $dia = $data_de_nascimento_f->format("d");
    $mes = $data_de_nascimento_f->format("m");
    $ano = $data_de_nascimento_f->format("Y");

    try {
        if($data_de_nascimento_f instanceof DateTime) { //valida formatação
            if (checkdate($mes, $dia, $ano)) { //valida numeros
                if( $data_de_nascimento_f < $data_atual_f) { //valida se é uma data anterior ao dia atual
                    if(isset($this->data_de_nascimento)){
                        $objectBefore = $this->data_de_nascimento;
                        $this->data_de_nascimento = $data_de_nascimento_f;
                        $objectAfter = $this->data_de_nascimento;
                        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
                    }else{
                        $objectBefore = null;
                        $this->data_de_nascimento = $data_de_nascimento_f;
                        $objectAfter = $this->data_de_nascimento;
                        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
                    }
                }
                else {
                    throw new InvalidArgumentException("\nErro: Data de nascimento inválida ");
                }
            } 
        }      
    } catch (InvalidArgumentException $e) {
        echo $e->getMessage();
    }
    
}
public function set_cpf($cpf_f) {
    if($this->nacionalidade == "brasileiro" || $this->nacionalidade == "brasileira"){
        try {
            if($this->valida_cpf($cpf_f)) {
                if(isset($this->cpf)){
                    $objectBefore = $this->cpf;
                    $this->cpf = $cpf_f;
                    $objectAfter = $this->cpf;
                    new logEscrita(get_called_class(), $objectBefore, $objectAfter);
                }else{
                    $objectBefore = null;
                    $this->cpf = $cpf_f;
                    $objectAfter = $this->cpf;
                    new logEscrita(get_called_class(), $objectBefore, $objectAfter);
                }
            }
            else {
                throw new InvalidArgumentException("\nErro: CPF inválido ");
            }
        } catch (InvalidArgumentException $e) {
            echo $e->getMessage();
        }
    }
    else {
        $this->cpf = "";
    }
}
public function valida_cpf($cpf_f) {
    //valida formataçao
    if(preg_match("/^[0-9]{3}\.[0-9]{3}\.[0-9]{3}\-[0-9]{2}$/", $cpf_f) == false) {
        return false;
    }
    //extrai somente os números
    $cpf_numeros = str_replace(['.','-'],"",$cpf_f);

     // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
     if (preg_match('/(\d)\1{10}/', $cpf_numeros)) {
        return false;
    }

    // Faz o calculo para validar o CPF
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf_numeros[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf_numeros[$c] != $d) {
            return false;
        }
    }

    return true;
}
public function set_email($email_f) {
    try {
        if(filter_var($email_f, FILTER_VALIDATE_EMAIL)) {
            if(isset($this->email)){
                $objectBefore = $this->email;
                $this->email = $email_f;
                $objectAfter = $this->email;
                new logEscrita(get_called_class(), $objectBefore, $objectAfter);
            }else{
                $objectBefore = null;
                $this->email = $email_f;
                $objectAfter = $this->email;
                new logEscrita(get_called_class(), $objectBefore, $objectAfter);
            }
        }
        else {
            throw new InvalidArgumentException("\nErro: email inválido ");
        }
    } catch (InvalidArgumentException $e) {
        echo $e->getMessage();
    }
    
}
public function get_nome_passageiro(){
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->nome_passageiro;
}
public function get_sobrenome_passageiro(){
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->sobrenome_passageiro;
}
public function get_documento_passageiro(){
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->documento_passageiro;
}
public function get_nbagagens(){
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->numero_bagagens;
}
public function get_vip(){
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->vip;
}
public function get_nacionalidade() {
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->nacionalidade;
}
public function get_cpf() {
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->cpf;
}
public function get_data_de_nascimento() {
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->data_de_nascimento;
}
public function get_email() {
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->email;
}
public function get_categoria() {
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->categoria;
}
public function set_categoria($pontos) {
    if(isset($this->programa_de_milhagem)){
        $objectBefore = $this->categoria;
    }else{
        $objectBefore = null;
    }
    $this->categoria = $this->programa_de_milhagem->get_categoria($pontos);
    $objectAfter = $this->categoria;
    new logEscrita(get_called_class(), $objectBefore, $objectAfter);
}
public function get_pontos() {
    $method = __METHOD__;
    new logLeitura(get_called_class(), $method);
    return $this->pontos;
}
public function set_pontos($pontos_f) {
    if(isset($this->programa_de_milhagem)){
        $objectBefore = $this->pontos;
        $this->pontos = $pontos_f;
        $objectAfter = $this->pontos;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }else{
        $objectBefore = null;
        $this->pontos = $pontos_f;
        $objectAfter = $this->pontos;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }
}
public function adicionar_pontos($pontos, DateTime $data){
    $this->pontos += $pontos;
    $this->historico_de_pontos[$data->format('d-m-Y')] = $pontos;
}
//Caso a quantidade mínima de pontos acumulados nos últimos 12 meses 
//de uma categoria não seja mantida, o passageiro vip tem um downgrade e retorna à categoria anterior.
//Checa o array historico_de_pontos e retorna a quantidade de pontos acumulados nos ultimos 12 meses
public function ultimos_doze_meses(DateTime $data_atual) {
    if ($this->programa_de_milhagem == null) {
        echo("\nPrograma de milhagem não definido");
    }
    else{
    $pontos_ultimos_doze_meses = 0;
    foreach($this->historico_de_pontos as $data => $pontos) {
        $data_formatada = DateTime::createFromFormat('d-m-Y', $data);
        $diferenca = $data_atual->diff($data_formatada);
        if($diferenca->y == 0 && $diferenca->m <= 12) {
            $pontos_ultimos_doze_meses += $pontos;
        }
    }
    $categoria = $this->programa_de_milhagem->get_categoria($pontos_ultimos_doze_meses);
    if(isset($this->categoria)){
        $objectBefore = $this->categoria;
        $this -> categoria = $categoria;
        $objectAfter = $this -> categoria;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }else{
        $objectBefore = null;
        $this -> categoria = $categoria;
        $objectAfter = $this -> categoria;
        new logEscrita(get_called_class(), $objectBefore, $objectAfter);
    }}
}
}
    