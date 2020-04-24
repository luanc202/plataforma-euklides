<?php
//https://zerobugs.com.br/ver-post/exibir-dadosregistros-do-banco-de-dados-mysql-com-php/

	$email = $_COOKIE['email'];
	$connect = mysqli_connect('localhost','root','admin');
	$db = mysqli_select_db($connect,'euklides');
	
	$query_select_salas = "SELECT s.nome FROM sala s, professor p WHERE p.email = '$email'
						AND s.professor_id = p.id";
	$con      = mysqli_query($connect,$query_select_salas);
	
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Salas</title>
</head>
<body>
  <table border="1">
    <tr>
      <td>Nome</td>
      <td>Acao</td>
    </tr>
    <?php while($dado = $con->fetch_array()) { ?>
    <tr>
      <td><a href="sala.php?nome=<?php echo $dado['nome']; ?>"><?php echo $dado['nome']; ?></a></td>
      <td>
        <a href="inicial_professor_view.php">Editar</a>
        <a href="inicial_professor_view.php">Excluir</a>
        <a href="cadastro_view.php?nome=<?php echo $dado['nome']; ?>">URL</a>
      </td>
    </tr>
    <?php } ?>
  </table>
  <form method="POST" action="inicial_professor.php">
	<label>Nome da sala:</label><input type="text" name="nome_sala" id="nome_sala"><br>
	<input type="submit" value="Criar sala" id="nova_sala" name="nova_sala">
  </form>
</body>
</html>
