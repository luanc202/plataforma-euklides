<?php
include 'header.php';
//recebe o email do aluno como cookie da página login.php
$email = $_COOKIE['email'];
//exclui o cookie recebido
unset($_COOKIE['email']);

//cria a conexão
$connect = mysqli_connect('localhost','root','admin');
//seleciona o banco de dados euklides
$db = mysqli_select_db($connect,'euklides');

//seleciona o nome da sala em que o aluno está
$query_select_aluno = "SELECT s.nome, a.cod_aluno, a.sala_id FROM aluno a, sala s WHERE a.email = '$email' AND
					s.cod_sala = a.sala_id";
//$select_aluno recebe o resultado da execução da query
$select_aluno = mysqli_query($connect,$query_select_aluno);
//$array_aluno recebe todos os dados recebidos
$array_aluno = mysqli_fetch_array($select_aluno);
//$nome_sala recebe o nome da sala do aluno
$nome_sala = $array_aluno['nome'];
$cod_aluno = $array_aluno['cod_aluno'];
$cod_sala = $array_aluno['sala_id'];

//seleciona os jogos disponíveis na sala
$query_select_jogo = "SELECT j.cod_jogo, j.nome FROM jogo j, sala s, sala_jogo sj 
WHERE s.cod_sala = '$cod_sala' AND s.cod_sala = sj.sala_id AND j.cod_jogo = sj.jogo_id";
//$select_jogo recebe o resultado da execução da query
$select_jogo = mysqli_query($connect,$query_select_jogo);
?>

<html>
<head>
  <title>Meus jogos</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="stylesheet" type="text/css" href="css/inicial_aluno.css">
</head>
<body>

	<div class="div_dash">
		<h4>Início</h4>
		<h2><?php echo $nome_sala; ?></h2>
	  	
	  	<?php 
	  	//enquanto houver jogos, são criada as divs
	  	while($dado_jogo = $select_jogo->fetch_array()) {
	  	$cod_jogo = $dado_jogo['cod_jogo']; ?>
	  	<div class="div_jogo">
	  		<a href="<?php echo $dado_jogo['cod_jogo']; ?>/index.html?<?php echo $cod_aluno; ?>,<?php echo $cod_sala; ?>">
	  			<img class="imagem_jogo" src="imgs/jogo.jpg" alt="some text" ></a>
	  		<a href="<?php echo $dado_jogo['cod_jogo']; ?>/index.html?<?php echo $cod_aluno; ?>,<?php echo $cod_sala; ?>">
	  		<p class="nome_jogo"><?php echo $dado_jogo['nome']; ?></p></a>
	  		<a class="link_avaliar" 
	  		href="avaliacao.php?cod_jogo=<?php echo $dado_jogo['cod_jogo']; ?>&cod_aluno=<?php echo $cod_aluno; ?>">Avaliar jogo</a>
	  	</div>
		<?php } ?>
		
	</div>
	
</body>
</html>
