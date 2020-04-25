<?php
//recebe o email do aluno como cookie da página login.php
$email = $_COOKIE['email'];
//exclui o cookie recebido
unset($_COOKIE['email']);

//cria a conexão
$connect = mysqli_connect('localhost','root','admin');
//seleciona o banco de dados euklides
$db = mysqli_select_db($connect,'euklides');

//seleciona o nome da sala em que o aluno está
$query_select_aluno = "SELECT s.nome, a.id FROM aluno a, sala s WHERE a.email = '$email' AND
					s.id = a.sala_id";
//$select_aluno recebe o resultado da execução da query
$select_aluno = mysqli_query($connect,$query_select_aluno);
//$array_aluno recebe todos os dados recebidos
$array_aluno = mysqli_fetch_array($select_aluno);
//$nome_sala recebe o nome da sala do aluno
$nome_sala = $array_aluno['nome'];
$cod_aluno = $array_aluno['id'];

//apenas emite uma mensagem de qual sala o aluno está
echo '<p>Voce esta na sala '.$nome_sala.'</p>';
?>

<html>
<head>
  <meta charset="UTF-8">
  <title>Salas</title>
</head>
<body>
  <table border="1">
    <tr>
      <td>Jogo</td>
      <td>Descricao</td>
    </tr>
    <tr>
      <td>
      	<a href="quiz-game/index.html?<?php echo $cod_aluno; ?>">Quiz Game</a></td>
      <td>Descricao do jogo</td>
    </tr>
  </table>
</body>
</html>
