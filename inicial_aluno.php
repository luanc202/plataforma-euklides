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
$query_select_aluno = "SELECT s.nome, a.id, a.sala_id FROM aluno a, sala s WHERE a.email = '$email' AND
					s.id = a.sala_id";
//$select_aluno recebe o resultado da execução da query
$select_aluno = mysqli_query($connect,$query_select_aluno);
//$array_aluno recebe todos os dados recebidos
$array_aluno = mysqli_fetch_array($select_aluno);
//$nome_sala recebe o nome da sala do aluno
$nome_sala = $array_aluno['nome'];
$cod_aluno = $array_aluno['id'];
$cod_sala = $array_aluno['sala_id'];

//seleciona os jogos disponíveis na sala
$query_select_jogo = "SELECT j.id, j.nome FROM jogo j, sala s, sala_jogo sj 
WHERE s.id = '$cod_sala' AND s.id = sj.sala_id AND j.id = sj.jogo_id";
//$select_jogo recebe o resultado da execução da query
$select_jogo = mysqli_query($connect,$query_select_jogo);
?>

<html>
<head>
  <meta charset="UTF-8">
  <title>Meus jogos</title>
  <link rel="stylesheet" type="text/css" href="css/inicial_aluno.css">
</head>
<body>

	<div class="div_dash">
		<h4>Inicio</h4>
		<h2><?php echo $nome_sala; ?></h2>
	  	
	  	<?php 
	  	//enquanto houver jogos, são criada as divs
	  	while($dado_jogo = $select_jogo->fetch_array()) {?>
	  	<div class="div_jogo">
	  		<a href="<?php echo $dado_jogo['id']; ?>/index.html?<?php echo $cod_aluno; ?>,<?php echo $cod_sala; ?>">
	  			<img class="imagem_jogo" src="imgs/jogo.jpg" alt="some text" ></a>
	  		<a href="<?php echo $dado_jogo['id']; ?>/index.html?<?php echo $cod_aluno; ?>,<?php echo $cod_sala; ?>">
	  		<p class="nome_jogo"><?php echo $dado_jogo['nome']; ?></p></a>
	  		<a class="link_avaliar" href="">Avaliar jogo</a>
	  	</div>
		<?php } ?>
		
	</div>
	
</body>
</html>
