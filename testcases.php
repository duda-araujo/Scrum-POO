<?php
require_once "global.php";
ini_set('memory_limit', '512M');

$saida = new DateTime("2023-04-23 16:45:32");
$chegada = new DateTime("2023-04-24 18:45:32");
$novasaida = new DateTime("2023-04-24 19:35:32");
$novachegada = new DateTime("2023-04-25 20:35:32");

//Test Cases para a classe CompanhiaAerea
$companhia1 = new CompanhiaAerea("Gol", "Gol Linhas Aereas", "123", "15488222000172", "GL", "25", "50");
$companhia1->save();
//echo  $companhia->get_razao()."\n";
$companhias = CompanhiaAerea::getRecords();


//Test Cases para a classe Aeronave
//public function __construct($fabricante_f,$modelo_f,$carga_f,$passageiros_f,$registro_f,$companhiaAerea_f){
$aeronave1 = new Aeronave("Boeing", "A-800", 186, 600, "PR-GUO", $companhia1);
$aeronave2 = new Aeronave("AeroBus", "M-650", 186, 600, "PR-GUO", $companhia1);
//echo $aeronave->get_companhia_aerea()->get_nome()."\n";
$aeronave1->save();
$aeronave2->save();
$aeronaves = Aeronave::getRecords();


//Test Cases para a classe Aeroporto
//public function __construct(string $sigla_f,string $cidade_f,string $estado_f,string $nome_f){
$congonhas = new Aeroporto("CNG", "Congonhas", "SP", "Aeroporto de Congonhas");
$teresina = new Aeroporto("THE", "Teresina", "PI", "Aeroporto de Teresina");
$guarulhos = new Aeroporto("GRU", "Guarulhos", "SP", "Aeroporto de Guarulhos");
//echo $congonhas->get_nome_aero()."\n";
$congonhas->save();
$teresina->save();
$guarulhos->save();
$aeroportos = Aeroporto::getRecords();


//Test Cases para a classe VooPlanejado
//public function __construct($codigo_f, $Aerop_origem_f, $Aerop_destino_f,
//Hora_agen_chegada_f,$Hora_agen_saida_f,$Aviao_f, 
//$dia_f,$frequencia_voo_f, $preco_f) {
$voo_planejado = new VooPlanejado("GL1234", $congonhas, $teresina, $chegada, $saida, $aeronave1, '2', '2', 300);
//echo $voo_planejado1->get_frequencia()."\n";
$voo_planejado2 = new VooPlanejado("GL1534", $teresina, $guarulhos, $novachegada, $novasaida, $aeronave1, '2', '2', 400);
$voo_planejado3 = new VooPlanejado("GL1255",  $congonhas, $teresina, $chegada, $saida, $aeronave1, '2','2', 600);
$voo_planejado->save();
$voo_planejado2->save();
$voo_planejado3->save();
$voos_planejados = VooPlanejado::getRecords();


//Test Cases para a classe VooDecolado
//public function __construct($voo_anunciado_f,$saida_f,$chegada_f,$Aviao_voo_f){
echo $voo_planejado->get_hist_planejado();

//Test Case para a classe Passageiro
//public function __construct($nome_p, $sobrenome_p, $documento_p, $nbagagens_p, $vip_p, $nacionalidade_p, $cpf_p, $data_de_nascimento_p, $data_atual_p, $email_p){
$data_agora = new DateTime("now");
$data_nascimento = new DateTime("2001-03-28 12:49:00");  
$programaDeMilhagem = new ProgramaDeMilhagem('Smiles', $companhia1);
$passageiro1 = new Passageiro("Bruna", "Faria", "13748597614", 2, true, "brasileira", "948.884.119-21", $data_nascimento, $data_agora, "bruninha@gmail.com", "2A"); 
//echo $passageiro1->get_nome_passageiro()."\n";
$data_nascimento_2 = new DateTime("2001-02-20 12:49:00");  
$passageiro2 = new Passageiro("Gabriel", "Lott", "01905150660", 0, false, "brasileiro", "536.713.724-51",$data_nascimento_2, $data_agora, "lott@hotmail.com", "2B");
$passageiro3 = new Passageiro("Vinicius", "Cabral", "07251658399", 2, true, "brasileiro", "536.713.724-51",$data_nascimento_2, $data_agora, "viniciusmc.2109@gmail.com","3A"); 
$passageiro1->save();
$passageiro2->save();
$passageiro3->save();
$passageiros = Passageiro::getRecords();


//Test Case para classe Assento
//public function __construct(VooPlanejado $voo, Passageiro $passageiro, string $numero_assento){

echo $voo_planejado->get_assentos_ocupados();

//Test Case para venda de passagens em 30 dias
//public function __construct(Aeroporto $origem_f, Aeroporto $destino_f, Passageiro $passageiro_f, int $franquia_f){
  

$usuario = new Usuario("Gabriel","Lott","01905150660","lottlindo", "123456");
$passagem1 = new Passagens($congonhas, $teresina, $passageiro1, 2,$usuario);
echo $passagem1->string_passagem();
echo $voo_planejado->get_assentos_ocupados();
//Test Case conexão
$passagem2 = new Passagens($congonhas, $guarulhos, $passageiro3, 3,$usuario);
echo $passagem2->string_passagem();
echo ("\n").$passagem1->get_preco();
echo $voo_planejado->get_assentos_ocupados();
echo $voo_planejado->get_assentos_ocupados();
echo ("\n----------------------------------------\n");
echo ("\nTESTES DE ESTADO\n");
echo $passagem1->get_estado_da_passagem();

$passagem1->realizar_check_in();
$passagem2->realizar_check_in();
$embarque = new Embarque($voo_planejado);
$embarque->embarcar_passageiro($passagem1);
$embarque->embarcar_passageiro($passagem2);
$embarque->set_status_embarque(3);
//public function __construct($nome_p,$sobrenome_p,$documento_p,$cpf_p,$nacionalidade_p,DateTime $data_nascimento_p,$email_p,
//$cht_p,$logradouro_p,$numero_p,$bairro_p,$cidade_p,$estado_p,$Aerop_base_p,$companhiaAerea_p ){
$hora_1 = new DateTime("now");
$piloto_1 = new Piloto("Gabriel","Lott","MG-17.685.694","01905150660","Brasileiro",$hora_1,"gabriellg2011@gmail.com","sei oq eh isso n","Antonio Aleixo 205",205,"Lourdes","Belo Horizonte","Minas Gerais",$guarulhos,$companhia1);
$piloto_2 = new Piloto("Gabriel_fake","Lott","MG-17.685.694","01905150660","Brasileiro",$hora_1,"gabriellg2011@gmail.com","sei oq eh isso n","Antonio Aleixo 205",205,"Lourdes","Belo Horizonte","Minas Gerais",$guarulhos,$companhia1);
$voo_decolado = new Viagem($voo_planejado, $saida, $chegada, $aeronave1, $embarque,$piloto_1,$piloto_2);
echo $passagem1->get_estado_da_passagem();
$passagem1->save();
$passagem2->save();
$passagens = Passagens::getRecords();
$embarque->save();
$embarques = Embarque::getRecords();
$voo_decolado->save();
$viagens = Viagem::getRecords();

//Test Case do preco da passagem
$passagem3 = new Passagens($congonhas, $guarulhos, $passageiro1, -1,$usuario);
//$passagem3 = new Passagens($congonhas, $guarulhos, $passageiro, 0);
//echo $passagem3->string_passagem();
//$passagem3 = new Passagens($congonhas, $guarulhos, $passageiro, 1);
//echo $passagem3->string_passagem();
$passagem3 = new Passagens($congonhas, $guarulhos, $passageiro1, 2,$usuario);
echo $passagem3->string_passagem();
//$passagem = new Passagens($congonhas, $guarulhos, $passageiro_2, 0);
//echo $passagem->string_passagem();
$passagem3 = new Passagens($congonhas, $guarulhos, $passageiro2, 2,$usuario);
echo $passagem3->string_passagem();

//$passagem = new Passagens($congonhas, $teresina, $passageiro, 0);
//echo $passagem->string_passagem();
$passagem = new Passagens($congonhas, $teresina, $passageiro1, 2,$usuario);
echo $passagem->string_passagem();
//$passagem = new Passagens($congonhas, $teresina, $passageiro_2, 0);
//echo $passagem->string_passagem();
$passagem = new Passagens($congonhas, $teresina, $passageiro2, 2,$usuario);
echo $passagem->string_passagem();

$passagem3->save();
$passagens = Passagens::getRecords();

//Test case get_passagens
// $passagem1 = new Passagens($congonhas, $teresina, $passageiro, 2);
// $passagens = [];
// $passagens = $passagem->get_passagens("536.713.724-51");
// foreach($passagens as $passagens1){

//     $nome = $passagens1->get_cliente()->get_nome_passageiro();
//     $sobrenome = $passagens1->get_cliente()->get_sobrenome_passageiro();
//     $origem = $passagens1->get_origem()->get_nome_aero();
//     $destino = $passagens1->get_destino()->get_nome_aero();
//     $hora = $passagens1->get_voo()->get_hora_agenda_saida()->format('d/m/Y H:i'); 

//     $s = "\nPassagem para $nome $sobrenome, de $origem para $destino, $hora";
//     echo $s;
// }