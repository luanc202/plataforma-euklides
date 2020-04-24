<?php

// session_start();
// $existe_sala = $_SESSION['existe_sala'];
// $sala = $_SESSION['sala'];

// unset($_SESSION['existe_sala'], $_SESSION['sala']);

$existe_sala = $_COOKIE['existe_sala'];
$sala = $_COOKIE['sala'];
unset($_COOKIE['existe_sala'], $_COOKIE['sala']);

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = MD5($_POST['senha']);
$rsenha = MD5($_POST['rsenha']);
$connect = mysqli_connect('localhost','root','admin');
$db = mysqli_select_db($connect,'euklides');

$query_select_aluno = "SELECT * FROM aluno WHERE email = '$email'";
$select_aluno = mysqli_query($connect,$query_select_aluno);
$array_aluno = mysqli_fetch_array($select_aluno);
$email_aluno_array = $array_aluno['email'];

$query_select_professor = "SELECT * FROM aluno WHERE email = '$email'";
$select_professor = mysqli_query($connect,$query_select_professor);
$array_professor = mysqli_fetch_array($select_professor);
$email_professor_array = $array_professor['email'];

if($email == "" || $email == null || $nome == "" || $nome == null){
	echo"<script language='javascript' type='text/javascript'>
		          alert('Todos os campos devem ser preenchidos');window.location
		          .href='cadastro_view.php'</script>";
	die();
	
}else{
	if($email_aluno_array == $email || $email_professor_array == $email){
		
		echo"<script language='javascript' type='text/javascript'>
		          alert('Esse login já existe');window.location
		          .href='cadastro_view.php'</script>";
		die();
		
	}else if (strcmp($senha,$rsenha) != 0){
		echo"<script language='javascript' type='text/javascript'>
		          alert('Senhas não coincidem');window.location
		          .href='cadastro_view.php'</script>";
		die();
	}else{
		if ($existe_sala == 1){
			$query_select_sala = "SELECT id FROM sala WHERE nome = '$sala'";
			$select_sala = mysqli_query($connect,$query_select_sala);
			$array_sala = mysqli_fetch_array($select_sala);
			$id_sala = $array_sala['id'];
			
			$query = "INSERT INTO aluno (nome,email,senha,sala_id) VALUES ('$nome','$email','$senha',$id_sala)";
			$insert = mysqli_query($connect,$query);
			
			if($insert){
				echo"<script language='javascript' type='text/javascript'>
		          alert('Aluno cadastrado com sucesso!');window.location.
		          href='login.html'</script>";
			}else{
				echo"<script language='javascript' type='text/javascript'>
		          alert('Não foi possível cadastrar esse aluno');window.location
		          .href='cadastro_view.php'</script>";
			}
		} else {
			$query = "INSERT INTO professor (nome,email,senha) VALUES ('$nome','$email','$senha')";
			$insert = mysqli_query($connect,$query);
			
			if($insert){
				echo"<script language='javascript' type='text/javascript'>
		          alert('Professor cadastrado com sucesso!');window.location.
		          href='login.html'</script>";
			}else{
				echo"<script language='javascript' type='text/javascript'>
		          alert('Não foi possível cadastrar esse professor');window.location
		          .href='cadastro_view.php'</script>";
			}
		}
		
	}
}
?>