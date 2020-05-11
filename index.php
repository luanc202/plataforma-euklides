<?php

include 'header_index.php';

?>

<html>
<head>
	<title>Euklides</title>
	<link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>
	<p class=margin_form></p>
	<form class="form_buttons" method="POST">
		<input type="submit" value="Entrar" id="button_login" class="button_login" name="button_login"><br>
		<input type="submit" value="Criar Conta" id="button_cadastro" class="button_cadastro" name="button_cadastro"><br>
	</form>
	<div class="div_login_cadastro">
		<form id="form_login" class="form_login" method="POST" action="login.php">
			<p class=margin_campos></p>
			<label>E-mail</label><br><input class="campo" type="text" name="email" id="email"><br>
			<p class=margin_labels></p>
			<label>Senha</label><br><input class="campo" type="password" name="senha" id="senha"><br>
			<p class=margin_campos></p>
			<input type="submit" value="Entrar" id="entrar" name="entrar"><br>
			<!-- <a href="recuperar_senha.html">esqueci a senha</a> -->
			<!-- <a href="cadastro_view.php">Cadastre-se</a>-->
		</form>
		<form id="form_cadastro" class="form_cadastro" method="POST" action="cadastro.php">
			<p class=margin_campos></p>
			<label>Nome</label><br><input class="campo" type="text" name="nome" id="nome"><br>
			<p class=margin_labels></p>
			<label>E-mail</label><br><input class="campo" type="text" name="email" id="email"><br>
			<p class=margin_labels></p>
			<label>Senha</label><br><input class="campo" type="password" name="senha" id="senha"><br>
			<p class=margin_labels></p>
			<label>Confirmar a senha</label><br><input class="campo" type="password" name="rsenha" id="rsenha"><br>
			<p class=margin_campos></p>
			<input type="submit" value="Cadastrar" id="cadastrar" name="cadastrar"><br>
		</form>
	</div>
	<?php 
		//verifica se h� um par�metro cod_sala na url, o que significa que um aluno est� fazendo CADASTRO
		if (isset($_GET['cod_sala'])){
			//esconde o formul�rio do login e mostra o formul�rio do cadastro
			?>
			<script type='text/javascript'>
				document.getElementById("form_login").style.visibility = 'hidden';
				document.getElementById("form_cadastro").style.visibility = 'visible';
			</script>
			<?php 
			//verifica se h� o par�metro a��o na url e � igual a cadastro
		} else if ($_GET['acao'] == 'cadastro'){
			//esconde o formul�rio do login e mostra o formul�rio do cadastro
			?>
			<script type='text/javascript'>
				document.getElementById("form_login").style.visibility = 'hidden';
				document.getElementById("form_cadastro").style.visibility = 'visible';
			</script>
			<?php 
			//verifica se h� o par�metro a��o na url e � igual a login
		} else if ($_GET['acao'] == 'login'){
			//esconde o formul�rio do cadastro e mostra o formul�rio do login
			?>
			<script type='text/javascript'>
				document.getElementById("form_login").style.visibility = 'visible';
				document.getElementById("form_cadastro").style.visibility = 'hidden';
			</script>
			<?php 
			//qualquer outro jeito, mostra o login que � a forma padr�o
		} else {
			?>
			<script type='text/javascript'>
				document.getElementById("form_login").style.visibility = 'visible';
				document.getElementById("form_cadastro").style.visibility = 'hidden';
			</script>
			<?php 
		}
	?>
</body>
</html>

<?php

if(isset($_POST["button_login"])){
	//se for selecionado o bot�o de cadastro, o formul�rio do cadastro � escondido
	?>
	<script type='text/javascript'>
		//forms
		document.getElementById("form_login").style.visibility = 'visible';
		document.getElementById("form_cadastro").style.visibility = 'hidden';
		//bot�es
		document.getElementById("button_login").style.backgroundColor = '#F2F2F2';
		document.getElementById("button_login").style.color = 'black';
		document.getElementById("button_cadastro").style.backgroundColor = '#7F7F7F';
		document.getElementById("button_cadastro").style.color = 'white';
	</script>
	<?php
}

if(isset($_POST["button_cadastro"])){
	//se for selecionado o bot�o de cadastro, o formul�rio do login � escondido
	?>
	<script type='text/javascript'>
		//forms
		document.getElementById("form_login").style.visibility = 'hidden';
		document.getElementById("form_cadastro").style.visibility = 'visible';
		//bot�es
		document.getElementById("button_login").style.backgroundColor = '#7F7F7F';
		document.getElementById("button_login").style.color = 'white';
		document.getElementById("button_cadastro").style.backgroundColor = '#F2F2F2';
		document.getElementById("button_cadastro").style.color = 'black';
	</script>
	<?php
}

//verifica se h� o par�metro sala na url
if (isset($_GET['cod_sala'])){
	//se existir, a vari�vel existe_sala recebe 1
	$existe_sala = isset($_GET['cod_sala']);
	//se existir, a vari�vel cod_sala e id_professor recebe os valores que est�o na url
	$cod_sala = $_GET['cod_sala'];
	$id_professor = $_GET['cod_prof'];
	session_start();
	$_SESSION['existe_sala'] = $existe_sala;
	$_SESSION['cod_sala_index'] = $cod_sala;
	$_SESSION['id_professor_index'] = $id_professor;
	//se existir, as vari�veis s�o enviadas como cookies
// 	setcookie("existe_sala",$existe_sala);
// 	setcookie("sala",$cod_sala);
// 	setcookie("cod_prof",$id_professor);
}else {
	//se n�o existir, s�o enviados os valores 0 e espa�o
// 	setcookie("existe_sala",0);
// 	setcookie("sala",0);
// 	setcookie("cod_prof",0);
	$_SESSION['existe_sala'] = 0;
	$_SESSION['cod_sala_index'] = 0;
	$_SESSION['id_professor_index'] = 0;
}

?>