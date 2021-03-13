<?php

if(isset($_GET['cod_jogo'])){
	include 'header.php';
	//cria a conexão
	$connect = mysqli_connect('localhost','root','admin');
	//$connect = mysqli_connect('200.137.132.9','darti_user','1RApnE0P');
	//seleciona o banco de dados euklides
	$db = mysqli_select_db($connect,'euklides');
	
	$nome_jogo = "";
	
	$cod_jogo = $_GET['cod_jogo'];
	$cod_aluno = $_GET['cod_aluno'];
	
	setcookie("avaliacao_cod_jogo",$cod_jogo);
	setcookie("avaliacao_cod_aluno", $cod_aluno);
	
	//seleciona o nome do jogo
	$query_select_jogo = "SELECT * FROM jogo j WHERE j.cod_jogo = $cod_jogo";
	//$select_jogo recebe o resultado da execução da query
	$select_jogo = mysqli_query($connect,$query_select_jogo);
	//$array_jogo recebe todos os dados recebidos
	$array_jogo = mysqli_fetch_array($select_jogo);
	//$nome_jogo recebe o nome da sala do aluno
	$nome_jogo = $array_jogo['nome'];
	
	$url = './data_perguntas/' . $nome_jogo . '/perguntas.json'; // path to your JSON file
	$data = file_get_contents($url); // put the contents of the file into a variable
	$perguntas = json_decode($data); // decode the JSON feed
	
	?>

	<html>
	<head>
	  <title>Avaliação</title>
	  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	  <link rel="stylesheet" type="text/css" href="css/avaliacao.css">
	</head>
	<body>
		<form class="div_dash" method="POST" action="avaliacao.php">
			<h1>Avaliação <?php echo $nome_jogo;?></h1>
			
			<?php foreach ( $perguntas as $p ) {
			    // pergunta referente a frequência de jogo
			    if($p->id == 1){?>
			    	<div class="div_pergunta">
        				<p class="p_pergunta"><?php echo $p->id?> - <?php echo $p->texto?></p>
        				<br /><input class="labels" type="radio" id="1" name="selected-<?php echo $p->id?>" 
        								value="1">
        				<label for="1"> Nunca: nunca jogo.</label><br />
        				<br /><input class="labels" type="radio" id="2" name="selected-<?php echo $p->id?>" 
        								value="2">
        				<label for="2"> Raramente: jogo de tempos em tempos.</label><br />
        				<br /><input class="labels" type="radio" id="3" name="selected-<?php echo $p->id?>" 
        								value="3">
        				<label for="3"> Mensalmente: jogo pelo menos uma vez por mês.</label><br />
        				<br /><input class="labels" type="radio" id="4" name="selected-<?php echo $p->id?>" 
        								value="4">
        				<label for="4"> Semanalmente: jogo pelo menos uma vez por semana.</label><br />
        				<br /><input class="labels" type="radio" id="5" name="selected-<?php echo $p->id?>" 
        								value="5">
        				<label for="5"> Diariamente: jogo todos os dias.</label><br />
        			</div>
			    <?php }
			    // pergunta referente a faixa etária
			    else if ($p->id == 2){ ?>
			    	<div class="div_pergunta">
        				<p class="p_pergunta"><?php echo $p->id?> - <?php echo $p->texto?></p>
        				<br /><input class="labels" type="radio" id="1" name="selected-<?php echo $p->id?>" 
        								value="1">
        				<label for="1"> Menos de 18 anos</label><br />
        				<br /><input class="labels" type="radio" id="2" name="selected-<?php echo $p->id?>" 
        								value="2">
        				<label for="2"> 18 a 28 anos</label><br />
        				<br /><input class="labels" type="radio" id="3" name="selected-<?php echo $p->id?>" 
        								value="3">
        				<label for="3"> 29 a 39 anos</label><br />
        				<br /><input class="labels" type="radio" id="4" name="selected-<?php echo $p->id?>" 
        								value="4">
        				<label for="4"> 40 a 50 anos</label><br />
        				<br /><input class="labels" type="radio" id="5" name="selected-<?php echo $p->id?>" 
        								value="5">
        				<label for="5"> Mais de 50 anos</label><br />
        			</div>
			    <?php }
			    else {?>
        			<div class="div_pergunta">
        				<p class="p_pergunta"><?php echo $p->id?> - <?php echo $p->texto?></p>
        				<br /><input class="labels" type="radio" id="1" name="selected-<?php echo $p->id?>" 
        								value="1">
        				<label for="1"> Discordo totalmente</label><br />
        				<br /><input class="labels" type="radio" id="2" name="selected-<?php echo $p->id?>" 
        								value="2">
        				<label for="2"> Discordo</label><br />
        				<br /><input class="labels" type="radio" id="3" name="selected-<?php echo $p->id?>" 
        								value="3">
        				<label for="3"> Nem discordo, nem concordo</label><br />
        				<br /><input class="labels" type="radio" id="4" name="selected-<?php echo $p->id?>" 
        								value="4">
        				<label for="4"> Concordo</label><br />
        				<br /><input class="labels" type="radio" id="5" name="selected-<?php echo $p->id?>" 
        								value="5">
        				<label for="5"> Concordo totalmente</label><br />
        			</div>
				<?php }?>
			<?php }?>
			
			<input type="submit" value="Salvar" id="salvar" class="salvar" name="salvar"><br>
			
		</form>
		
	</body>
	</html>
<?php 
} else {
    header("Location:index.php");
}

?>


