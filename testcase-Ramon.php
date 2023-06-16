<?php
include_once("global.php");
ini_set('memory_limit', '512M');
//Teste de funcionalidade antes do cadastro de usuário 
$aeroporto_teste = new Aeroporto("CNG", "Congonhas", "SP", "Aeroporto de Congonhas");

//Cadastro de um usuário
$usuario = new Usuario("Vinicius", "Cabral", "viniciusmc.2109@gmail.com", "aabbccdd", "123456");
new Sistema($usuario);

//Cadastro de duas companhias aéreas 
$companhia1 = new CompanhiaAerea("Latam","Latam Airlines do Brasil S.A.","001","11.222.333/4444-55","LA",100,100);
$companhia2 = new CompanhiaAerea("Azul","Azul Linhas Aéreas Brasileiras S.A.","002","22.111.333/4444-55","AD",100,100);

//Cadastro de duas aeronaves, uma para cada companhia aérea
$aeronave1 = new Aeronave("Embraer","L-175","600","180","PX-RUZ",$companhia1); 
$aeronave2 = new Aeronave("Embraer","A-175","600","180","PR-GUO",$companhia2);

//Cadastro dos cinco aeroportos 
$aeroporto1 = new Aeroporto("CNG","Congonhas","SP","Aeroporto Deputado Freitas Nobre");
$aeroporto2 = new Aeroporto("GIG","Rio de Janeiro","RJ","Aeroporto Internacional Tom Jobim");
$aeroporto3 = new Aeroporto("GRU","Guarulhos","SP","Aeroporto de São Paulo - Guarulhos");
$aeroporto4 = new Aeroporto("CWB","Curitiba","PR","Aeroporto Afonso Pena");
$aeroporto5 = new Aeroporto("CNF","Confins","MG", "Aeroporto Internacional Tancredo Neves");

//O código deve validar o código do voo, tratar a exceção e alterar o código para utilizar a sigla correta
$voo1 = new VooPlanejado("AC1329", $aeroporto5, $aeroporto3,
new DateTime("10:45"), new DateTime("09:45"),$aeronave2,"350.00","100", "50.00");
$voo1->voo_com_frequencia(1);


$voo2_ida = new VooPlanejado("AD1329", $aeroporto5, $aeroporto3,
new DateTime("12:49"),new DateTime("11:49"), $aeronave2,"350.00","100", "50.00");
$voo2_ida->voo_com_frequencia(1);

$voo2_volta = new VooPlanejado("AD1330", $aeroporto3, $aeroporto5,
new DateTime("18:49"), new DateTime("17:49"), $aeronave2,  "350.00","100", "50.00");
$voo2_volta->voo_com_frequencia(1);

$voo3_ida = new VooPlanejado("AD1331", $aeroporto5, $aeroporto1, 
new DateTime("12:49"), new DateTime("11:49"), $aeronave2,  "350.00","100", "50.00");
$voo3_ida->voo_com_frequencia(1);
$voo3_volta = new VooPlanejado("AD1332", $aeroporto1, $aeroporto5, 
new DateTime("18:49"), new DateTime("17:49"), $aeronave2,  "350.00","100", "50.00");
$voo3_volta->voo_com_frequencia(1);

$voo4_ida = new VooPlanejado("LA1333", $aeroporto3, $aeroporto2,
new DateTime("12:49"), new DateTime("11:49"), $aeronave1, "350.00", "100", "50.00");
$voo4_ida->voo_com_frequencia(1);
$voo4_volta = new VooPlanejado("LA1334", $aeroporto2, $aeroporto3,
new DateTime("18:49"), new DateTime("17:49"), $aeronave1,  "350.00", "100", "50.00");
$voo4_volta->voo_com_frequencia(1);

$voo5_ida = new VooPlanejado("LA1335", $aeroporto1, $aeroporto4,
new DateTime("12:49"), new DateTime("11:49"), $aeronave1,  "350.00", "100", "50.00");
$voo5_ida->voo_com_frequencia(1);
$voo5_volta = new VooPlanejado("LA1336", $aeroporto4, $aeroporto1,
new DateTime("18:49"), new DateTime("17:49"), $aeronave1,  "350.00", "100", "50.00");
$voo5_volta->voo_com_frequencia(1);

echo("\n".VooPlanejado::proximos_voos_string());

$data_amanha = new DateTime("tomorrow");
$programa_azul = new ProgramaDeMilhagem("TudoAzul", $companhia2);
$passageiro_vip = new PassageiroVip("Bruno", "Rodrigues", "MG-10.123.345", 2, true, "brasileiro", "948.884.119-21", new DateTime("1995-03-15"), new DateTime("now"), "bruno@gmail.com", "2A", $programa_azul, "102");
$passagem_vip = new Passagens($aeroporto5, $aeroporto4, $passageiro_vip, 30, $usuario,2, new DateTime("now"));
$amanhã = ((new DateTime("now"))->modify('+3 days'));
$passagem_volta = new Passagens($aeroporto4, $aeroporto5, $passageiro_vip, 30, $usuario,2, $amanhã);
$passagem_vip->realizar_check_in();
$passagem_volta->cancelar_passagem();
$passagem_volta->realizar_check_in();

$nascimento = new DateTime("15-03-1995");
$piloto_1= new Piloto("Jorge","Pereira","01906650660","01906650660","Brasileiro",$nascimento,"jorge@gmail.com","naoseioqehisso","Avenida Brasil","1438","Santa Efigênia","Belo Horizonte","Minas Gerais",$aeroporto5,$companhia2);
$piloto_2= new Piloto("Pedro","Augusto","01906650660","01906650660","Brasileiro",$nascimento,"jorge@gmail.com","naoseioqehisso","Rua Antônio Aleixo","205","Lourdes","Belo Horizonte","Minas Gerais",$aeroporto5,$companhia2);
$comissario = new ComissarioDeBordo("Marcos","Silva","01906650660","01906650660","Brasileiro",$nascimento,"jorge@gmail.com","naoseioqehisso","Rua Olegário Maciel","126","Lourdes","Belo Horizonte","Minas Gerais",$aeroporto5,$companhia2);
$tripulacao[0]=$piloto_1;
$tripulacao[1]=$piloto_2;
$tripulacao[2]=$comissario;
$carro_1 = new Veiculo($companhia2,$aeroporto5,"Onibus",18);
$transporte = new Rota($aeroporto5,$carro_1,$tripulacao,$passagem_vip->get_voo());

$piloto_3= new Piloto("Aninha","Patrícia","01906650660","01906650660","Brasileiro",$nascimento,"jorge@gmail.com","naoseioqehisso","Avenida Afonso Pena","3111","Funcionários","São Paulo","São Paulo",$aeroporto1,$companhia2);
$piloto_4= new Piloto("Ana","Fernandes","01906650660","01906650660","Brasileiro",$nascimento,"jorge@gmail.com","naoseioqehisso","Avenida Paulista","1374","Jardins","São Paulo","São Paulo",$aeroporto1,$companhia2);
$comissario_1= new ComissarioDeBordo("Antônio","Souza","01906650660","01906650660","Brasileiro",$nascimento,"jorge@gmail.com","naoseioqehisso","Rua dos Bandeirantes","456","Bom Retiro","São Paulo","São Paulo",$aeroporto1,$companhia2);

$transporte_conexao[0]=$piloto_3;
$transporte_conexao[1]=$piloto_4;
$transporte_conexao[2]=$comissario_1;
$carro_2 = new Veiculo($companhia2,$aeroporto1,"Van",18);
$transporte_conexao = new Rota($aeroporto1,$carro_2,$transporte_conexao,$passagem_vip->get_conexao());
print_r($transporte_conexao->definir_rota());

$conteudo_log_leitura = file_get_contents('logLeitura.txt');
$conteudo_log_escrita = file_get_contents('logEscrita.txt');
//echo $conteudo_log_leitura;
//echo $conteudo_log_escrita;