<?php
require_once "global.php";
$saida = new DateTime("2023-04-23 16:45:32");
$chegada = new DateTime("2023-04-24 18:45:32");
$congonhas = new Aeroporto("CNG", "Congonhas", "SP", "Aeroporto de Congonhas");
$teresina = new Aeroporto("THE", "Teresina", "PI", "Aeroporto de Teresina");
$companhia1 = new CompanhiaAerea("Gol", "Gol Linhas Aereas", "123", "15488222000172", "GL", "25", "50");
$aeronave1 = new Aeronave("Boeing", "A-800", 186, 600, "PR-GUO", $companhia1);
$voo_planejado = new VooPlanejado("GL1234", $congonhas, $teresina, $chegada, $saida, $aeronave1, '2', '2', 300, 1000,50);
$voo_planejado->voo_com_frequencia(1);
echo($voo_planejado->get_hist_planejado());
$companhia1->save();
$aeronave1->save();
$aeronave2->save();
$congonhas->save();
$teresina->save();