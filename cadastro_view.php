<html>
<head>
	<meta charset="UTF-8">
	<title> Cadastro de Usuário </title>
</head>
<body>
<form method="POST" action="cadastro.php">
	<label>Nome:</label><input type="text" name="nome" id="nome"><br>
	<label>Email:</label><input type="text" name="email" id="email"><br>
	<label>Senha:</label><input type="password" name="senha" id="senha"><br>
	<label>Confirmar a senha:</label><input type="password" name="rsenha" id="rsenha"><br>
<input type="submit" value="Cadastrar" id="cadastrar" name="cadastrar">
</form>
<?php 
if (isset($_GET['nome'])){
	$existe_sala = isset($_GET['nome']);
	$nome_sala = $_GET['nome'];
// 	session_start();
// 	$_SESSION['existe_sala'] = $existe_sala;
// 	$_SESSION['sala'] = $sala;
	setcookie("existe_sala",$existe_sala);
	setcookie("sala",$nome_sala);
	echo $existe_sala;
}else {
	setcookie("existe_sala",0);
	setcookie("sala","");
}
?>
</body>
</html>

