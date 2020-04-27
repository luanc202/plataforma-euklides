<?php

$con = mysqli_connect('localhost','root','admin','euklides');

if(mysqli_connect_error()){
	echo "1: Connection failed";
	exit();
}

$cod_aluno = $_POST["cod_aluno"];
$cod_sala = $_POST["cod_sala"];
$cod_jogo = $_POST["cod_jogo"];
$tempo_gasto = $_POST["tempo_gasto"];
$num_dicas = $_POST["num_dicas"];
$num_acertos = $_POST["num_acertos"];
$num_erros = $_POST["num_erros"];
$level = $_POST["level"];

$query = "INSERT INTO `jogada` (`tempo_gasto`,`num_dicas`,`num_acertos`,`num_erros`,`level`,`aluno_id`,`sala_id`,`jogo_id`) 
VALUES ($tempo_gasto,$num_dicas,$num_acertos,$num_erros,'$level',$cod_aluno,$cod_sala,$cod_jogo);";
//a variсvel $insert recebe o resultado da execuчуo da query
$insert = mysqli_query($con,$query) or die("2: Insert failed");

echo "0";
?>