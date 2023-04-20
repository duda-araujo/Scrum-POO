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
$companhia = new CompanhiaAerea("Gol", "Gol Linhas Aereas", "123", "15488222000172", "GL", "25");
echo  $companhia->get_razao()."\n";
//Test Cases para a classe Aeronave
$aeronave = new Aeronave("Boeing", 27, "A-800", 186, 600, "PR-GUO", $companhia);
$nova_aeronave = new Aeronave("AeroBus", 35, "M-650", 186, 600, "PR-GUO", $companhia);
echo $aeronave->get_companhia_aerea()->get_nome()."\n";

//Test Cases para a classe Aeroporto
$congonhas = new Aeroporto("CNG", "Congonhas", "SP", "Aeroporto de Congonhas");
$teresina = new Aeroporto("THE", "Teresina", "PI", "Aeroporto de Teresina");
$guarulhos = new Aeroporto("GRU", "Guarulhos", "SP", "Aeroporto de Guarulhos");
echo $congonhas->get_nome_aero()."\n";

//Test Cases para a classe VooPlanejado
$voo_planejado = new VooPlanejado("GL1234", $congonhas, $teresina, $chegada, $saida, $aeronave, '2', '2', 50, 300);
echo $voo_planejado->get_frequencia()."\n";
$voo_planejado2 = new VooPlanejado("GL1534", $teresina, $guarulhos, $novachegada, $novasaida, $aeronave, '2', '2', 50, 400);

//Test Case para código do VooPlanejado
$voo = new VooPlanejado("GL1255",  $congonhas, $teresina, $chegada, $saida, $aeronave, '2','2', 50, 600);

//Test Cases para a classe VooDecolado
$voo_decolado = new Viagem($voo_planejado, $novasaida, $novachegada, $nova_aeronave);
echo $voo_decolado->get_aviao_voo()->get_companhia_aerea()->get_nome()."\n";
echo $voo_planejado->get_hist_planejado();
echo $voo_decolado->get_hist_executado();

//Test Case para a classe Passageiro
$passageiro = new Passageiro("Bruna", "Faria", "12345678914", 2); 
echo $passageiro->get_nome_passageiro()."\n";

//Test Case para classe Assento
$assento = new Assento($voo_planejado, $passageiro, "15B");
echo $voo_planejado->get_assentos_ocupados();

//Test Case para venda de passagens em 30 dias
$passagem = new Passagens($congonhas, $teresina, $passageiro);
echo $passagem->string_passagem();

//Test Case conexão
$passagem = new Passagens($congonhas, $guarulhos, $passageiro);
echo $passagem->get_preco();

?>