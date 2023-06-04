<?php 
require_once "global.php";

//teste cases para o arquivo rotas.php
$companhiaAerea = new CompanhiaAerea(
    "Nome da Companhia",
    "Razão Social",
    "123",
    "12.345.678/0001-90",
    "SI",
    50.0,
    100.0
);
$aeroportoBase = new Aeroporto(
    "ABC",
    "São Paulo",
    "SP",
    "Aeroporto Internacional"
);
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

$confins = new Aeroporto("CNF", "Confins", "MG", "Aeroporto de Confins");
$guarulhos = new Aeroporto("GRU", "Guarulhos", "SP", "Aeroporto de Guarulhos");

$aeronave1 = new Aeronave("Boeing", "A-800", 186, 600, "PR-GUO", $companhiaAerea);

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
