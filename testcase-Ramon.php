<?php

include_once("global.php");

$companhia1 = new CompanhiaAerea("Latam","Latam Airlines do Brasil S.A.","001","11.222.333/4444-55","LA",100,100);
$companhia2 = new CompanhiaAerea("Azul","Azul Linhas Aéreas Brasileiras S.A.","002","22.111.333/4444-55","AD",100,100);

$aeronave1 = new Aeronave("Embraer","175","600","180","PX-RUZ",$companhia1); #obs: o codigo deve validar a sigla e tratar a exceção. A sigla deve ser corrigida para PP-RUZ
$aeronave2 = new Aeronave("Embraer","175","600","180","PR-GUO",$companhia2);

$aeroporto1 = new Aeroporto("CNG","Congonhas","SP","Aeroporto Deputado Freitas Nobre");
$aeroporto2 = new Aeroporto("GIG","Rio de Janeiro","RJ","Aeroporto Internacional Tom Jobim");
$aeroporto3 = new Aeroporto("GRU","Guarulhos","SP","Aeroporto de São Paulo - Guarulhos");
$aeroporto4 = new Aeroporto("CWB","Curitiba","PR","Aeroporto Afonso Pena");
$aeroporto5 = new Aeroporto("CNF","Confins","MG", "Aeroporto Internacional Tancredo Neves");

#O código deve validar o código do voo, tratar a exceção e alterar o código para utilizar a sigla correta
$voo1 = new VooPlanejado("AC1329", $aeroporto5, $aeroporto3,
"10:45", "09:45",$aeronave2, "03/09/2023",2, "350.00","100", "50.00");


$voo2_ida = new VooPlanejado("AD1329", $aeroporto5, $aeroporto3,
"10:45", "09:45", $aeronave2, "Segunda", 1, "350.00","100", "50.00");
$voo2_volta = new VooPlanejado("AD1329", $aeroporto3, $aeroporto5,
"17:45", "16:45", $aeronave2, "Terça", 1, "350.00","100", "50.00");

$voo3_ida = new VooPlanejado("AD1330", $aeroporto5, $aeroporto1, 
"10:45", "09:45", $aeronave2, "Segunda", 1, "350.00","100", "50.00");
$voo3_volta = new VooPlanejado("AD1330", $aeroporto1, $aeroporto5, 
"17:45", "16:45", $aeronave2, "Terça", 1, "350.00","100", "50.00");

$voo4_ida = new VooPlanejado("AD1331", $aeroporto3, $aeroporto2,
"10:45", "09:45", $aeronave1, "Quarta", 1, "350.00", "100", "50.00");
$voo4_volta = new VooPlanejado("AD1331", $aeroporto2, $aeroporto3,
"17:45", "16:45", $aeronave1, "Quinta", 1, "350.00", "100", "50.00");

$voo5_ida = new VooPlanejado("AD1332", $aeroporto1, $aeroporto4,
"10:45", "09:45", $aeronave1, "Quarta", 1, "350.00", "100", "50.00");
$voo5_volta = new VooPlanejado("AD1332", $aeroporto4, $aeroporto1,
"17:45", "16:45", $aeronave1, "Quinta", 1, "350.00", "100", "50.00");




