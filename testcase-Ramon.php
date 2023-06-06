<?php

include_once("global.php");

$companhia1 = new CompanhiaAerea("Latam","Latam Airlines do Brasil S.A.","001","11.222.333/4444-55","LA",100,100);
$companhia2 = new CompanhiaAerea("Azul","Azul Linhas Aéreas Brasileiras S.A.","002","22.111.333/4444-55","AD",100,100);

$aeronave1 = new Aeronave("Embraer","L-175","600","180","PX-RUZ",$companhia1); 
$aeronave2 = new Aeronave("Embraer","A-175","600","180","PR-GUO",$companhia2);

$aeroporto1 = new Aeroporto("CNG","Congonhas","SP","Aeroporto Deputado Freitas Nobre");
$aeroporto2 = new Aeroporto("GIG","Rio de Janeiro","RJ","Aeroporto Internacional Tom Jobim");
$aeroporto3 = new Aeroporto("GRU","Guarulhos","SP","Aeroporto de São Paulo - Guarulhos");
$aeroporto4 = new Aeroporto("CWB","Curitiba","PR","Aeroporto Afonso Pena");
$aeroporto5 = new Aeroporto("CNF","Confins","MG", "Aeroporto Internacional Tancredo Neves");

#O código deve validar o código do voo, tratar a exceção e alterar o código para utilizar a sigla correta
$voo1 = new VooPlanejado("AC1329", $aeroporto5, $aeroporto3,
new DateTime("10:45"), new DateTime("09:45"),$aeronave2, 1, 2, "350.00","100", "50.00");


$voo2_ida = new VooPlanejado("AD1329", $aeroporto5, $aeroporto3,
new DateTime("12:49"),new DateTime("11:49"), $aeronave2, 2, 1, "350.00","100", "50.00");
$voo2_volta = new VooPlanejado("AD1329", $aeroporto3, $aeroporto5,
new DateTime("18:49"), new DateTime("17:49"), $aeronave2, 1, 1, "350.00","100", "50.00");

$voo3_ida = new VooPlanejado("AD1330", $aeroporto5, $aeroporto1, 
new DateTime("12:49"), new DateTime("11:49"), $aeronave2, 1, 1, "350.00","100", "50.00");
$voo3_volta = new VooPlanejado("AD1330", $aeroporto1, $aeroporto5, 
new DateTime("18:49"), new DateTime("17:49"), $aeronave2, 2, 1, "350.00","100", "50.00");

$voo4_ida = new VooPlanejado("AD1331", $aeroporto3, $aeroporto2,
new DateTime("12:49"), new DateTime("11:49"), $aeronave1, 3, 1, "350.00", "100", "50.00");
$voo4_volta = new VooPlanejado("AD1331", $aeroporto2, $aeroporto3,
new DateTime("18:49"), new DateTime("17:49"), $aeronave1, 4, 1, "350.00", "100", "50.00");

$voo5_ida = new VooPlanejado("AD1332", $aeroporto1, $aeroporto4,
new DateTime("12:49"), new DateTime("11:49"), $aeronave1, 4, 1, "350.00", "100", "50.00");
$voo5_volta = new VooPlanejado("AD1332", $aeroporto4, $aeroporto1,
new DateTime("18:49"), new DateTime("17:49"), $aeronave1, 3, 1, "350.00", "100", "50.00");


$resultado = VooPlanejado::get_hist_planejado();
echo $resultado;


