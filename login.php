<?php
$email = $_POST['email'];
$entrar = $_POST['entrar'];
$senha = md5($_POST['senha']);
$connect = mysqli_connect('localhost','root','admin');
$db = mysqli_select_db($connect,'euklides');
if (isset($entrar)) {
	
	$verifica_professor = mysqli_query($connect,"SELECT * FROM professor WHERE (email ='$email' AND senha = '$senha')") 
	or die("erro ao selecionar");
	
	$verifica_aluno = mysqli_query($connect,"SELECT * FROM aluno WHERE (email ='$email' AND senha = '$senha')")
	or die("erro ao selecionar");
	
	if (mysqli_num_rows($verifica_professor)<=0 && mysqli_num_rows($verifica_aluno)<=0){
		echo"<script language='javascript' type='text/javascript'>
        alert('Email e/ou senha incorretos');window.location
        .href='login.html';</script>";
		die();
	}else if (mysqli_num_rows($verifica_professor)>0){
		setcookie("email",$email);
		header("Location:inicial_professor_view.php");
	}else {
		setcookie("email",$email);
		header("Location:inicial_aluno.php");
	}
}
?>