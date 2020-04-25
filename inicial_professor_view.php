<?php
//https://zerobugs.com.br/ver-post/exibir-dadosregistros-do-banco-de-dados-mysql-com-php/

	//recebe o email do professor como cookie da página login.php
	$email = $_COOKIE['email'];
	//cria a conexão
	$connect = mysqli_connect('localhost','root','admin');
	//seleciona o banco de dados euklides
	$db = mysqli_select_db($connect,'euklides');
	
	//seleciona o nome de todas as salas criadas pelo professor do email recebido
	$query_select_salas = "SELECT s.nome FROM sala s, professor p WHERE p.email = '$email'
						AND s.professor_id = p.id";
	//a variável $con recebe o resultado da execução da query
	$salas      = mysqli_query($connect,$query_select_salas);
	
	//seleciona o nome e o id de todos os objetos de aprendizagem cadastrados
	$query_select_jogos = "SELECT * FROM jogo";
	//a variável $con recebe o resultado da execução da query
	$jogos      = mysqli_query($connect,$query_select_jogos);
	
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
    <?php
    //a variável $dado irá receber cada índice do array criado a partir da variável $con
    //enquanto houver índices vai ser criado uma tupla na tabela do html 
    while($dado = $salas->fetch_array()) { ?>
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
	<label>Objetos de aprendizagem</label>
	<select name="jogo" id="jogo">
		<option value="">Selecione</option>
		<?php
	    while($dado_jogo = $jogos->fetch_array()) { ?>
		<option value="<?php echo $dado_jogo['id']; ?>"><?php echo $dado_jogo['nome']; ?></option>
		<?php } ?>
	</select>
	<input type="submit" value="Criar sala" id="nova_sala" name="nova_sala">
  </form>
</body>
</html>
