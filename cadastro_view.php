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
</body>
</html>

