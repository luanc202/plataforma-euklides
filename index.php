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
		//verifica se há um parâmetro nome na url, o que significa que um aluno está fazendo CADASTRO
		if (isset($_GET['nome'])){
			//esconde o formulário do login e mostra o formulário do cadastro
			?>
			<script type='text/javascript'>
				document.getElementById("form_login").style.visibility = 'hidden';
				document.getElementById("form_cadastro").style.visibility = 'visible';
			</script>
			<?php 
			//verifica se há o parâmetro ação na url e é igual a cadastro
		} else if ($_GET['acao'] == 'cadastro'){
			//esconde o formulário do login e mostra o formulário do cadastro
			?>
			<script type='text/javascript'>
				document.getElementById("form_login").style.visibility = 'hidden';
				document.getElementById("form_cadastro").style.visibility = 'visible';
			</script>
			<?php 
			//verifica se há o parâmetro ação na url e é igual a login
		} else if ($_GET['acao'] == 'login'){
			//esconde o formulário do cadastro e mostra o formulário do login
			?>
			<script type='text/javascript'>
				document.getElementById("form_login").style.visibility = 'visible';
				document.getElementById("form_cadastro").style.visibility = 'hidden';
			</script>
			<?php 
			//qualquer outro jeito, mostra o login que é a forma padrão
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
	//se for selecionado o botão de cadastro, o formulário do cadastro é escondido
	?>
	<script type='text/javascript'>
		//forms
		document.getElementById("form_login").style.visibility = 'visible';
		document.getElementById("form_cadastro").style.visibility = 'hidden';
		//botões
		document.getElementById("button_login").style.backgroundColor = '#F2F2F2';
		document.getElementById("button_login").style.color = 'black';
		document.getElementById("button_cadastro").style.backgroundColor = '#7F7F7F';
		document.getElementById("button_cadastro").style.color = 'white';
	</script>
	<?php
}

if(isset($_POST["button_cadastro"])){
	//se for selecionado o botão de cadastro, o formulário do login é escondido
	?>
	<script type='text/javascript'>
		//forms
		document.getElementById("form_login").style.visibility = 'hidden';
		document.getElementById("form_cadastro").style.visibility = 'visible';
		//botões
		document.getElementById("button_login").style.backgroundColor = '#7F7F7F';
		document.getElementById("button_login").style.color = 'white';
		document.getElementById("button_cadastro").style.backgroundColor = '#F2F2F2';
		document.getElementById("button_cadastro").style.color = 'black';
	</script>
	<?php
}

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