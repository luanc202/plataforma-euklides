<?php
//os dados digitados pelo usu�rio s�o coletados
$email = $_POST['email'];
$entrar = $_POST['entrar'];
$senha = md5($_POST['senha']);
//criar a conex�o
$connect = mysqli_connect('localhost','root','admin');
//seleciona o banco de dados
$db = mysqli_select_db($connect,'euklides');

//se for selecionado o bot�o entrar
if (isset($entrar)) {
	//a vari�vel $verifica_professor recebe a consulta que verifica se existe um professor cadastrado
	//com o email e senha fornecidos
	$verifica_professor = mysqli_query($connect,"SELECT * FROM professor WHERE (email ='$email' AND senha = '$senha')") 
	or die("erro ao selecionar");
	
	//a vari�vel $verifica_aluno recebe a consulta que verifica se existe um aluno cadastrado
	//com o email e senha fornecidos
	$verifica_aluno = mysqli_query($connect,"SELECT * FROM aluno WHERE (email ='$email' AND senha = '$senha')")
	or die("erro ao selecionar");
	
	//verifica caso n�o haja nenhum professor ou aluno cadastrado com os dados fornecidos, faz isso pelo n�mero de linhas
	if (mysqli_num_rows($verifica_professor)<=0 && mysqli_num_rows($verifica_aluno)<=0){
		echo"<script language='javascript' type='text/javascript'>
        alert('Email e/ou senha incorretos');window.location
        .href='index.php';</script>";
		die();
		//se o n�mero de linhas da vari�vel $verifica_professor for maior que zero significa que h� um professor
	}else if (mysqli_num_rows($verifica_professor)>0){
		//envia o email do professor como cookie
		setcookie("email",$email);
		//redireciona para p�gina inicial_professor_view.php
		header("Location:inicial_professor_view.php");
	}else {
		//envia o email do aluno como cookie
		setcookie("email",$email);
		//redireciona para p�gina inicial_aluno.php
		header("Location:inicial_aluno.php");
	}
}
?>