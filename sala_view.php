<?php
include 'header.php';

//cria a conexão
$connect = mysqli_connect('localhost','root','admin');
//seleciona o banco de dados euklides
$db = mysqli_select_db($connect,'euklides');

//verifica se há o parâmetro nome na url
if (isset($_GET['nome'])){
	//se sim, a variável $nome_sala e $id_professor recebem os respectivos valores
	$nome_sala = $_GET['nome'];
	$id_professor = $_GET['cod_prof'];
	//é criado o link para a tela cadastro_view e adicionado como parâmetro o nome da sala
	//dessa forma, os alunos podem se cadastrar direto na sala
	$link = "http://localhost/euklides/plataforma-euklides/index.php?nome=$nome_sala&cod_prof=$id_professor";
	
	//cria a query para verificar quais jogos há na sala
	$query_select_jogo = "SELECT s.cod_sala, j.cod_jogo, j.nome FROM jogo j, sala s, sala_jogo sj
	WHERE s.nome = '$nome_sala' AND s.cod_sala = sj.sala_id AND j.cod_jogo = sj.jogo_id";
	//a variável $jogos recebe o resultado da execução da query
	$jogos 		 = mysqli_query($connect,$query_select_jogo);
// 	$array_jogos = mysqli_fetch_array($jogos);
	$cod_sala = 0;
		
	//cria a query para verificar quais alunos estão na sala
	$query_alunos = "SELECT a.cod_aluno, a.nome FROM sala s, aluno a WHERE a.sala_id = s.cod_sala AND s.nome = '$nome_sala'";
	//a variável $alunos recebe o resultado da execução da query
	$alunos       = mysqli_query($connect,$query_alunos);
	
} 
?>

<html>
<head>
  <meta charset="UTF-8">
  <title>Minhas Salas</title>
  <link rel="stylesheet" type="text/css" href="css/sala.css">
</head>
<body>
	<div class="div_dash">
		<h4>Inicio > <?php echo $nome_sala; ?></h4>
		<h2><?php echo $nome_sala; ?></h2>
		
		<div class="div_link">
			<h3>Link para a sala: </h3> 
			<p class="p_link"><?php echo $link?></p>
			<input type="image" id="copiar_imagem" class="copiar_imagem" alt="copiar"
       			onclick="copiarTexto()" src="imgs/copy_icon.png"> 
		</div>
		
		<script>
		
		function copiarTexto() {
			const texto = "<?php echo $link;?>";
			//Cria um elemento input
			let inputTest = document.createElement("input");
            inputTest.value = texto;
            //Anexa o elemento ao body
            document.body.appendChild(inputTest);
            //seleciona todo o texto do elemento
            inputTest.select();
            //executa o comando copy
            //aqui é feito o ato de copiar para a area de trabalho com base na seleção
            var ok = document.execCommand('copy');
            //remove o elemento
            document.body.removeChild(inputTest)
            if (ok) alert('Texto copiado para a área de transferência');
		}
		
		</script>
		
		<form class="div_buttons" id="div_buttons"  method="POST">
			<input type="submit" value="Jogos" id="button_jogos" class="button_jogos" name="button_jogos">
			<input type="submit" value="Alunos" id="button_alunos" class="button_alunos" name="button_alunos">
			<input type="submit" value="Gerenciar" id="button_gerenciar" class="button_gerenciar" name="button_gerenciar">
		</form>
		
		<div class="div_jogos" id="div_jogos">
		<?php
			//enquanto houver jogos, saão criadas as divs
			while($dado_jogo = $jogos->fetch_array()) {?>
			<?php 
				$cod_sala = $dado_jogo['cod_sala'];
				?> 
			<?php ?>
		  	<form class="div_jogo" method="POST">
		  		<a href="<?php echo $dado_jogo['cod_jogo'];?>/index.html?<?php echo $cod_sala;?>">
		  			<img class="imagem_jogo" src="imgs/jogo.jpg" alt="some text" ></a>
		  		<a href="<?php echo $dado_jogo['cod_jogo'];?>/index.html?<?php echo $cod_sala;?>">
		  		<p class="nome_jogo"><?php echo $dado_jogo['nome']; ?></p></a>
		  		<button type="submit" id="deletar_jogo" class="deletar_jogo" name ="deletar_jogo[]" 
		  		value="<?php echo $dado_jogo['cod_jogo'];?>" >
		  		</button>
		  	</form>
		  	
			<?php } //fecha o while ?> 
			
			<div class="div_novo_jogo">
				<input type="image" class="imagem_novo_jogo" id="imagem_novo_jogo"
		  			src="imgs/nova_sala.png" alt="some text" >
			</div>
		
		</div>
		
		<div class="div_alunos" id="div_alunos">
			
		</div>
		
		<div class="div_gerenciar" id="div_gerenciar">
			
		</div>
		
	</div>
</body>
</html>

<?php

if (isset($_POST['deletar_jogo'])) {
	foreach ($_POST['deletar_jogo'] as $cod_jogo){
		$query_deletar = "DELETE FROM sala_jogo WHERE sala_id = $cod_sala AND jogo_id = $cod_jogo";
		$delete = mysqli_query($connect,$query_deletar);
	}
}

if(isset($_POST["button_jogos"])){
	//se for selecionado o botão de cadastro, o formulário do cadastro é escondido
	?>
	<script type='text/javascript'>
		document.getElementById("div_jogos").style.display = 'block';
		document.getElementById("div_alunos").style.display = 'none';
		document.getElementById("div_gerenciar").style.display = 'none';
	</script>
	<?php
}

if(isset($_POST["button_alunos"])){
	//se for selecionado o botão de cadastro, o formulário do login é escondido
	?>
	<script type='text/javascript'>
		document.getElementById("div_jogos").style.display = 'none';
		document.getElementById("div_alunos").style.display = 'block';
		document.getElementById("div_gerenciar").style.display = 'none';
	</script>
	<?php
}

if(isset($_POST["button_gerenciar"])){
	//se for selecionado o botão de cadastro, o formulário do cadastro é escondido
	?>
	<script type='text/javascript'>
		document.getElementById("div_jogos").style.display = 'none';
		document.getElementById("div_alunos").style.display = 'none';
		document.getElementById("div_gerenciar").style.display = 'block';
	</script>
	<?php
}
?>
