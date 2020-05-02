<?php

include 'header.php';

?>

<html>
<head>
	<title>Euklides</title>
	<link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>
	<p class=margin_form></p>
	<form class="form_buttons" method="POST">
		<input type="submit" value="Login" id="button_login" class="button_login" name="button_login"><br>
		<input type="submit" value="Cadastro" id="button_cadastro" class="button_cadastro" name="button_cadastro"><br>
	</form>
	<p class=margin_buttons></p>
	<div class="div_login_cadastro">
		<form id="form_login" class="form_login" method="POST" action="login.php">
			<label>Email: </label><input type="text" name="email" id="email"><br>
			<label>Senha:</label><input type="password" name="senha" id="senha"><br>
			<input type="submit" value="Entrar" id="entrar" name="entrar"><br>
			<!-- <a href="recuperar_senha.html">esqueci a senha</a> -->
			<!-- <a href="cadastro_view.php">Cadastre-se</a>-->
		</form>
		<form id="form_cadastro" class="form_cadastro" method="POST" action="cadastro.php">
			<label>Nome:</label><input type="text" name="nome" id="nome"><br>
			<label>Email: </label><input type="text" name="email" id="email"><br>
			<label>Senha:</label><input type="password" name="senha" id="senha"><br>
			<label>Confirmar a senha:</label><input type="password" name="rsenha" id="rsenha"><br>
			<input type="submit" value="Cadastrar" id="cadastrar" name="cadastrar"><br>
		</form>
	</div>
	<?php 
		if (isset($_GET['nome'])){
			?>
			<script type='text/javascript'>
				document.getElementById("form_login").style.visibility = 'hidden';
				document.getElementById("form_cadastro").style.visibility = 'visible';
			</script>
			<?php 
		} else if ($_GET['acao'] == 'cadastro'){
			?>
			<script type='text/javascript'>
				document.getElementById("form_login").style.visibility = 'hidden';
				document.getElementById("form_cadastro").style.visibility = 'visible';
			</script>
			<?php 
		} else if ($_GET['acao'] == 'login'){
			?>
			<script type='text/javascript'>
				document.getElementById("form_login").style.visibility = 'visible';
				document.getElementById("form_cadastro").style.visibility = 'hidden';
			</script>
			<?php 
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
	?>
	<script type='text/javascript'>
		document.getElementById("form_login").style.visibility = 'visible';
		document.getElementById("form_cadastro").style.visibility = 'hidden';
	</script>
	<?php
}

if(isset($_POST["button_cadastro"])){
	//verifica se há o parâmetro sala na url
	if (isset($_GET['nome'])){
		//se existir, a variável existe_sala recebe 1
		$existe_sala = isset($_GET['nome']);
		//se existir, a variável nome_sala eid_professor recebe os valores que estão na url
		$nome_sala = $_GET['nome'];
		$id_professor = $_GET['cod_prof'];
		// 	session_start();
		// 	$_SESSION['existe_sala'] = $existe_sala;
		// 	$_SESSION['sala'] = $sala;
		//se existir, as variáveis são enviadas como cookies
		setcookie("existe_sala",$existe_sala);
		setcookie("sala",$nome_sala);
		setcookie("cod_prof",$id_professor);
	}else {
		//se não existir, são enviados os valores 0 e espaço
		setcookie("existe_sala",0);
		setcookie("sala","");
		setcookie("cod_prof",0);
	}
	?>
	<script type='text/javascript'>
		document.getElementById("form_login").style.visibility = 'hidden';
		document.getElementById("form_cadastro").style.visibility = 'visible';
	</script>
	<?php
}

?>