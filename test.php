<?php 
require_once "global.php";

//teste cases para o arquivo rotas.php

//Declarando companhias aereas
$companhiaAerea = new CompanhiaAerea(
    "Nome da Companhia",
    "Razão Social",
    "123",
    "12.345.678/0001-90",
    "SI",
    50.0,
    100.0
);

$Latam = new CompanhiaAerea(
    "Latam",
    "Latam Airlines do Brasil S.A.",
    "001",
    "02.012.862/0001-60",
    "LA",
    40.0,
    80.0
);

$Azul = new CompanhiaAerea(
    "Latam",
    "Azul Linhas Aéreas Brasileiras S.A.",
    "002",
    "09.296.295/0001-60",
    "AD",
    55.0,
    90.0
);

//Declarando aeroportos
$confins = new Aeroporto(
    "CNF", 
    "Confins", 
    "MG", 
    "Aeroporto de Confins"
);

$congonhas = new Aeroporto(
    "CGH", 
    "Congonhas", 
    "SP", 
    "Aeroporto de Congonhas"
);

$galeao = new Aeroporto(
    "GIG", 
    "Galeao", 
    "RJ", 
    "Aeroporto Internacional Tom Jobim"
);

$afonsoPena = new Aeroporto(
    "GRU", 
    "Guarulhos", 
    "SP", 
    "Aeroporto de Guarulhos"
);

$guarulhos = new Aeroporto(
    "GRU", 
    "Guarulhos", 
    "SP", 
    "Aeroporto de Guarulhos"
);

$aeroportoBase = new Aeroporto(
    "ABC",
    "São Paulo",
    "SP",
    "Aeroporto Internacional"
);

//Declarando tripulações
$tripulacao1 = new Tripulacao(
    "João",
    "Silva",
    "123456789",
    "123.456.789-00",
    "Brasileira",
    new DateTime("1990-01-01"),
    "joao.silva@example.com",
    "CHT123",
    "Rua A",
    "123",
    "Centro",
    "São Paulo",
    "SP",
    $companhiaAerea,
    $aeroportoBase
);

$tripulacao2 = new Tripulacao(
    "Maria",
    "Santos",
    "987654321",
    "987.654.321-00",
    "Brasileira",
    new DateTime("1995-05-10"),
    "maria.santos@example.com",
    "CHT456",
    "Rua B",
    "456",
    "Centro",
    "Rio de Janeiro",
    "RJ",
    $companhiaAerea,
    $aeroportoBase
);

$tripulacao3 = new Tripulacao(
    "Pedro",
    "Ribeiro",
    "456123789",
    "456.123.789-00",
    "Brasileira",
    new DateTime("1985-12-20"),
    "pedro.ribeiro@example.com",
    "CHT789",
    "Rua C",
    "789",
    "Centro",
    "Belo Horizonte",
    "MG",
    $companhiaAerea,
    $aeroportoBase
);

$veiculo = new Veiculo(
    $companhiaAerea,
    $aeroportoBase,
    "ABC1234",
    10
);

$saida = new DateTime("2023-04-23 16:45:32");
$chegada = new DateTime("2023-04-24 18:45:32");

//Declarando aeronaves
$aeronave1 = new Aeronave(
    "Embraer",
    "175",
    600, 
    180, 
    "PX-RUZ", 
    $Latam
);

$aeronave2 = new Aeronave(
    "Embraer",
    "175",
    600, 
    180, 
    "PP-RUZ", 
    $Azul
);

//Declarando voos
$voo = new VooPlanejado(
    "AC1329",
    $confins,
    $guarulhos,
    $chegada,
    $saida, 
    $aeronave1, 
    '2', 
    '2', 
    300, 
    1000,
    50
);

$tripulantes = [$tripulacao1, $tripulacao2, $tripulacao3];

$rota = new Rota(
    $aeroportoBase,
    $veiculo,
    $tripulantes,
    $voo
);
echo $rota -> definir_rota();
