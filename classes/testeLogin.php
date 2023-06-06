<?php

include_once("global.php");
$user1 = new Usuario("João", "Silva", "joao123@gmail.com", "joao123", "123456");

$user1->cadastrar_usuario($user1);
$user1->realizar_login("joao123", "123456");

