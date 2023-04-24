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

$saida1 = new DateTime("2023-04-19 16:45:32");
$chegada1 = new DateTime("2023-04-20 18:45:32");
$saida2 = new DateTime("2023-04-23 17:45:32");
$chegada2 = new DateTime("2023-04-24 19:45:32");
$saida3 = new DateTime("2023-04-27 18:45:32");
$chegada3 = new DateTime("2023-04-29 20:45:32");
$saida4 = new DateTime("2023-05-19 19:45:32");
$chegada4 = new DateTime("2023-05-20 21:45:32");

$companhia = new CompanhiaAerea("Gol", "Gol Linhas Aereas", "123", "15488222000172", "GL", 10.0,15.20);
$aeronave = new Aeronave("Boeing", "A-800", 186, 600, "PR-GUO", $companhia);
$congonhas = new Aeroporto("CNG", "Congonhas", "SP", "Aeroporto de Congonhas");
$teresina = new Aeroporto("THE", "Teresina", "PI", "Aeroporto de Teresina");
$guarulhos = new Aeroporto("GRU", "Guarulhos", "SP", "Aeroporto de Guarulhos");

$voo_planejado = new VooPlanejado("GL1234", $congonhas, $teresina, $chegada1, $saida1, $aeronave, '2', '2', 300);
$voo_planejado2 = new VooPlanejado("GL1534", $teresina, $guarulhos, $chegada2, $saida2, $aeronave, '2', '2', 400);
$voo_planejado3 = new VooPlanejado("GL1634", $guarulhos, $congonhas, $chegada3, $saida3, $aeronave, '2', '2', 500);
$voo_planejado4 = new VooPlanejado("GL1734", $guarulhos, $teresina, $chegada4, $saida4, $aeronave, '2', '2', 600);

$data_agora = new DateTime("now");
$data_nascimento = new DateTime("2001-03-28 12:49:00");  
$passageiro = new Passageiro("Bruna", "Faria", "13748597614", 2, true, "brasileira", "948.884.119-21", $data_nascimento, $data_agora, "bruninha@gmail.com" ); 

$passagem1 = new Passagens($congonhas, $teresina, $passageiro, 2);
$passagem2 = new Passagens($teresina, $guarulhos, $passageiro, 2);
$passagem3 = new Passagens($guarulhos, $congonhas, $passageiro, 2);
$passagem4 = new Passagens($guarulhos, $teresina, $passageiro, 2);


$passagens = [];
$passagens = Passagens::get_passagens("948.884.119-21");
foreach($passagens as $passagem){

    $nome = $passagem->get_cliente()->get_nome_passageiro();
    $sobrenome = $passagem->get_cliente()->get_sobrenome_passageiro();
    $origem = $passagem->get_origem()->get_nome_aero();
    $destino = $passagem->get_destino()->get_nome_aero();
    $hora = $passagem->get_voo()->get_hora_agenda_saida()->format('d/m/Y H:i'); 

    $s = "\nPassagem para $nome $sobrenome, de $origem para $destino, $hora";
    echo $s;
}