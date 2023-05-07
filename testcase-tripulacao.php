<?php
require_once("global.php");
// //include_once("classes\CompanhiaAerea.php");
// include_once("classes\Aeronave.php");
// include_once("classes\Aeroporto.php");
// include_once("classes\Tripulacao.php");
// include_once("classes\Piloto.php");
// include_once("classes\ComissarioDeBordo.php");
// include_once("classes\Passageiro.php");
// include_once("classes\Passagem.php");
// include_once("classes\Reserva.php");
// include_once("classes\Bagagem.php");


$data_nascimento = new DateTime("2002-08-24 12:49:00");  
$Aeroporto_base = new Aeroporto("CNG", "Congonhas", "SP", "Aeroporto de Congonhas");
$companhiaAerea = new CompanhiaAerea("Gol", "Gol Linhas Aereas", "123", "15488222000172", "GL", 10.0,15.20);
$Tripulante_1Tripulante_1 = new Tripulacao("Ana Raquel","Linhares","MG17866125","12852087650","Brasileira",$data_nascimento,"anarlba.auto@gmail.com","3857358348","Rua Claudio Manoel","197","Funcionarios","Belo Horizonte","Minas Gerais",$Aeroporto_base,$companhiaAerea);
echo $companhiaAerea->get_tripulacao()[0]->get_nome();



