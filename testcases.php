<?php
include_once("Aeronave.php");
include_once("Aeroporto.php");
include_once("CompanhiaAerea.php");
include_once("Passageiro.php");
include_once("Passagens.php");
include_once("Usuario.php");
include_once("VooDecolado.php");
include_once("VooPlanejado.php");
include_once("Assento.php");

$saida = new DateTime("2023-04-19 16:45:32");
$chegada = new DateTime("2023-04-20 18:45:32");
$novasaida = new DateTime("2023-04-20 19:35:32");
$novachegada = new DateTime("2023-04-21 20:35:32");

//Test Cases para a classe CompanhiaAerea 
//public function __construct($nome_f,$razao_f,$codigo_f,$cnpj_f,$sigla_f,$preco_bagagem_f,$tarifa_f){
  
$companhia = new CompanhiaAerea("Gol", "Gol Linhas Aereas", "123", "15488222000172", "GL", 10.0,15.20);
echo  $companhia->get_razao()."\n";
//Test Cases para a classe Aeronave
//public function __construct($fabricante_f,$modelo_f,$carga_f,$passageiros_f,$registro_f,$companhiaAerea_f){

$aeronave = new Aeronave("Boeing", "A-800", 186, 600, "PR-GUO", $companhia);
$nova_aeronave = new Aeronave("AeroBus", "M-650", 186, 600, "PR-GUO", $companhia);
echo $aeronave->get_companhia_aerea()->get_nome()."\n";

//Test Cases para a classe Aeroporto
//public function __construct(string $sigla_f,string $cidade_f,string $estado_f,string $nome_f){

$congonhas = new Aeroporto("CNG", "Congonhas", "SP", "Aeroporto de Congonhas");
$teresina = new Aeroporto("THE", "Teresina", "PI", "Aeroporto de Teresina");
$guarulhos = new Aeroporto("GRU", "Guarulhos", "SP", "Aeroporto de Guarulhos");
echo $congonhas->get_nome_aero()."\n";

//Test Cases para a classe VooPlanejado
//public function __construct($codigo_f, $Aerop_origem_f, $Aerop_destino_f,
//Hora_agen_chegada_f,$Hora_agen_saida_f,$Aviao_f, 
//$dia_f,$frequencia_voo_f, $preco_f) {

$voo_planejado = new VooPlanejado("GL1234", $congonhas, $teresina, $chegada, $saida, $aeronave, '2', '2', 300);
echo $voo_planejado->get_frequencia()."\n";
$voo_planejado2 = new VooPlanejado("GL1534", $teresina, $guarulhos, $novachegada, $novasaida, $aeronave, '2', '2', 400);
$voo = new VooPlanejado("GL1255",  $congonhas, $teresina, $chegada, $saida, $aeronave, '2','2', 600);

//Test Cases para a classe VooDecolado
//public function __construct($voo_anunciado_f,$saida_f,$chegada_f,$Aviao_voo_f){

$voo_decolado = new Viagem($voo_planejado, $novasaida, $novachegada, $nova_aeronave);
echo $voo_decolado->get_aviao_voo()->get_companhia_aerea()->get_nome()."\n";
echo $voo_planejado->get_hist_planejado();
echo $voo_decolado->get_hist_executado();

//Test Case para a classe Passageiro
//public function __construct($nome_p, $sobrenome_p,$documento_p, $nbagagens_p, $vip_p){

$passageiro = new Passageiro("Bruna", "Faria", "12345678914", 2, true); 
echo $passageiro->get_nome_passageiro()."\n";
$passageiro_2 = new Passageiro("Gabriel", "Lott", "01905150660",0,false);


//Test Case para classe Assento
//public function __construct(VooPlanejado $voo, Passageiro $passageiro, string $numero_assento){

$assento = new Assento($voo_planejado, $passageiro, "15B");
echo $voo_planejado->get_assentos_ocupados();

//Test Case para venda de passagens em 30 dias
//public function __construct(Aeroporto $origem_f, Aeroporto $destino_f, Passageiro $passageiro_f, int $franquia_f){
  

$passagem = new Passagens($congonhas, $teresina, $passageiro, 2);
echo $passagem->string_passagem();

//Test Case conexão
$passagem = new Passagens($congonhas, $guarulhos, $passageiro, 0);
echo $passagem->get_preco();

//Test Case do preco da passagem
$passagem = new Passagens($congonhas, $guarulhos, $passageiro, -1);
//$passagem = new Passagens($congonhas, $guarulhos, $passageiro, 0);
//echo $passagem->string_passagem();
//$passagem = new Passagens($congonhas, $guarulhos, $passageiro, 1);
//echo $passagem->string_passagem();
$passagem = new Passagens($congonhas, $guarulhos, $passageiro, 2);
echo $passagem->string_passagem();
//$passagem = new Passagens($congonhas, $guarulhos, $passageiro_2, 0);
//echo $passagem->string_passagem();
$passagem = new Passagens($congonhas, $guarulhos, $passageiro_2, 2);
echo $passagem->string_passagem();

//$passagem = new Passagens($congonhas, $teresina, $passageiro, 0);
//echo $passagem->string_passagem();
$passagem = new Passagens($congonhas, $teresina, $passageiro, 2);
echo $passagem->string_passagem();
//$passagem = new Passagens($congonhas, $teresina, $passageiro_2, 0);
//echo $passagem->string_passagem();
$passagem = new Passagens($congonhas, $teresina, $passageiro_2, 2);
echo $passagem->string_passagem();
?>