<?php
require_once "global.php";
$usuario = new Usuario("Vinicius", "Cabral", "viniciusmc.2109@gmail.com", "aabbccdd", "123456");
new Sistema($usuario);
$saida = new DateTime("now");
$chegada = new DateTime("tomorrow");
$congonhas = new Aeroporto("CNG", "Congonhas", "SP", "Aeroporto de Congonhas");
$teresina = new Aeroporto("THE", "Teresina", "PI", "Aeroporto de Teresina");
$companhia1 = new CompanhiaAerea("Gol", "Gol Linhas Aereas", "123", "15488222000172", "GL", "25", "50");
$aeronave1 = new Aeronave("Boeing", "A-800", 186, 600, "PR-GUO", $companhia1);
$voo_planejado = new VooPlanejado("GL1234", $congonhas, $teresina, $chegada, $saida, $aeronave1, 300, 1000, 50);
$voo_planejado->voo_com_frequencia(4);
echo($voo_planejado->get_hist_planejado());