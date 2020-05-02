<?php
//os dados digitados pelo usuário são coletados
$email = $_POST['email'];
$entrar = $_POST['entrar'];
$senha = md5($_POST['senha']);
//criar a conexão
$connect = mysqli_connect('localhost','root','admin');
//seleciona o banco de dados
$db = mysqli_select_db($connect,'euklides');

//se for selecionado o botão entrar
if (isset($entrar)) {
	//a variável $verifica_professor recebe a consulta que verifica se existe um professor cadastrado
	//com o email e senha fornecidos
	$verifica_professor = mysqli_query($connect,"SELECT * FROM professor WHERE (email ='$email' AND senha = '$senha')") 
	or die("erro ao selecionar");
	
	//a variável $verifica_aluno recebe a consulta que verifica se existe um aluno cadastrado
	//com o email e senha fornecidos
	$verifica_aluno = mysqli_query($connect,"SELECT * FROM aluno WHERE (email ='$email' AND senha = '$senha')")
	or die("erro ao selecionar");
	
	//verifica caso não haja nenhum professor ou aluno cadastrado com os dados fornecidos, faz isso pelo número de linhas
	if (mysqli_num_rows($verifica_professor)<=0 && mysqli_num_rows($verifica_aluno)<=0){
		echo"<script language='javascript' type='text/javascript'>
        alert('Email e/ou senha incorretos');window.location
        .href='index.php';</script>";
		die();
		//se o número de linhas da variável $verifica_professor for maior que zero significa que há um professor
	}else if (mysqli_num_rows($verifica_professor)>0){
		//envia o email do professor como cookie
		setcookie("email",$email);
		//redireciona para página inicial_professor_view.php
		header("Location:inicial_professor_view.php");
	}else {
		//envia o email do aluno como cookie
		setcookie("email",$email);
		//redireciona para página inicial_aluno.php
		header("Location:inicial_aluno.php");
	}
}
?>