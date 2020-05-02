<?php

// session_start();
// $existe_sala = $_SESSION['existe_sala'];
// $sala = $_SESSION['sala'];

// unset($_SESSION['existe_sala'], $_SESSION['sala']);

//s�o coletados os cookies enviados da cadastro_view.php
$existe_sala = $_COOKIE['existe_sala'];
$sala = $_COOKIE['sala'];
$id_professor = $_COOKIE['cod_prof'];
//os cookies s�o deletados para que possam receber novos valores a cada cadastro
unset($_COOKIE['existe_sala'], $_COOKIE['sala']);

//os dados digitados na cadastro_view.php s�o coletados
$nome = $_POST['nome'];
$email = $_POST['email'];
//o md5 serve para criptograr a senha
$senha = MD5($_POST['senha']);
$rsenha = MD5($_POST['rsenha']);
//� criada a conex�o com o banco
$connect = mysqli_connect('localhost','root','admin');
//o banco de dados selecionado � o euklides
$db = mysqli_select_db($connect,'euklides');

//criada a query para verificar se existe algum aluno com o email digitado
$query_select_aluno = "SELECT * FROM aluno WHERE email = '$email'";
//a vari�vel $select_aluno recebe o resultado da execu��o dessa query
$select_aluno = mysqli_query($connect,$query_select_aluno);
//o array $array_aluno recebe todos os valores da busca
$array_aluno = mysqli_fetch_array($select_aluno);
//o array $email_aluno_array recebe os emails retornados na busca, se ele n�o encontrar email igual, 
//n�o vai retornar nenhum �ndice
$email_aluno_array = $array_aluno['email'];

//criada a query para verificar se existe algum professor com o email digitado
$query_select_professor = "SELECT * FROM professor WHERE email = '$email'";
//a vari�vel $select_professor recebe o resultado da execu��o dessa query
$select_professor = mysqli_query($connect,$query_select_professor);
//o array $array_professor recebe todos os valores da busca
$array_professor = mysqli_fetch_array($select_professor);
//o array $email_professor_array recebe os emails retornados na busca, se ele n�o encontrar email igual,
//n�o vai retornar nenhum �ndice
$email_professor_array = $array_professor['email'];

//verifica se h� algum campo vazio
if($email == "" || $email == null || $nome == "" || $nome == null|| $senha == "" || $senha == null
		|| $rsenha == "" || $rsenha == null){
	//se houver algum campo vazio, ir� emitir uma janela com a mensagem e o usu�rio ser� encaminhado para a p�gina
	//cadastro.view
	echo"<script language='javascript' type='text/javascript'>
		          alert('Todos os campos devem ser preenchidos');window.location
		          .href='index.php?acao=cadastro'</script>";
	die();

//verifica se o email inserido j� foi cadastrado no banco
}else{
	if($email_aluno_array == $email || $email_professor_array == $email){
		echo"<script language='javascript' type='text/javascript'>
		          alert('Esse login j� existe');window.location
		          .href='index.php?acao=cadastro'</script>";
		die();
		
	//verifica se as senhas digitadas s�o iguais
	}else if (strcmp($senha,$rsenha) != 0){
		echo"<script language='javascript' type='text/javascript'>
		          alert('Senhas n�o coincidem');window.location
		          .href='index.php?acao=cadastro'</script>";
		die();
	//se n�o houver nenhum erro, deve prosseguir para o cadastro dos dados
	}else{
		//se houver uma sala na URL, significa que quem est� sendo cadastrado � um aluno
		if ($existe_sala == 1){
			//como h� uma sala, � necess�rio descobrir o id dessa sala
			//para isso, � feito um select com o nome da sala para descobrir o id
			$query_select_sala = "SELECT id FROM sala WHERE nome = '$sala' AND professor_id = '$id_professor'";
			//a vari�vel $select_sala recebe o resultado da execu��o da query
			$select_sala = mysqli_query($connect,$query_select_sala);
			//o array $array_sala recebe os valores retornados
			$array_sala = mysqli_fetch_array($select_sala);
			//a vari�vel $id_sala recebe o valor do array corresponde ao id
			$id_sala = $array_sala['id'];
			
			//query para ser inserido na tabela aluno, incluindo a sala em que ele est�
			$query = "INSERT INTO aluno (nome,email,senha,sala_id) VALUES ('$nome','$email','$senha',$id_sala)";
			//a vari�vel $insert recebe o resultado da execu��o da query
			$insert = mysqli_query($connect,$query);
			
			if($insert){
				//se tiver sido um sucesso, aparecer a mensagem o usu�rio ser� encaminhado para o login
				echo"<script language='javascript' type='text/javascript'>
		          alert('Aluno cadastrado com sucesso!');window.location.
		          href='index.php'</script>";
			}else{
				//se tiver sido uma falha, aparecer a mensagem o usu�rio ser� encaminhado para o cadastro novamente
				echo"<script language='javascript' type='text/javascript'>
		          alert('N�o foi poss�vel cadastrar esse aluno');window.location
		          .href='index.php?acao=cadastro'</script>";
			}
		//se n�o houver uma sala na URL, significa que quem est� sendo cadastrado � um professor
		} else {
			//query para ser inserido na tabela professor
			$query = "INSERT INTO professor (nome,email,senha) VALUES ('$nome','$email','$senha')";
			//a vari�vel $insert recebe o resultado da execu��o da query
			$insert = mysqli_query($connect,$query);
			
			//se tiver sido um sucesso, aparecer a mensagem o usu�rio ser� encaminhado para o login
			if($insert){
				echo"<script language='javascript' type='text/javascript'>
		          alert('Professor cadastrado com sucesso!');window.location.
		          href='index.php'</script>";
			//se tiver sido uma falha, aparecer a mensagem o usu�rio ser� encaminhado para o cadastro novamente
			}else{
				echo"<script language='javascript' type='text/javascript'>
		          alert('N�o foi poss�vel cadastrar esse professor');window.location
		          .href='index.php?acao=cadastro'</script>";
			}
		}
		
	}
}
?>