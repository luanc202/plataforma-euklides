<?php
$connect = mysqli_connect('200.137.132.9','darti_user','1RApnE0P');
//$connect = mysqli_connect('localhost','root','admin');
$db = mysqli_select_db($connect,'darti_db');

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
$pontuacao = $_POST["pontuacao"];

$query = "INSERT INTO `jogada` (`tempo_gasto`,`num_dicas`,`num_acertos`,`num_erros`,`level`,`pontuacao`,`aluno_id`,`sala_id`,`jogo_id`) 
VALUES ($tempo_gasto,$num_dicas,$num_acertos,$num_erros,'$level',$pontuacao,$cod_aluno,$cod_sala,$cod_jogo);";
//a vari�vel $insert recebe o resultado da execu��o da query
$insert = mysqli_query($connect,$query) or die("2: Insert failed");

echo "0";
?>