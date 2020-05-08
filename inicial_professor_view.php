<?php
//https://zerobugs.com.br/ver-post/exibir-dadosregistros-do-banco-de-dados-mysql-com-php/

	include 'header.php';

	//recebe o email do professor como cookie da p�gina login.php
	$email = $_COOKIE['email'];
	//cria a conex�o
	$connect = mysqli_connect('localhost','root','admin');
	//seleciona o banco de dados euklides
	$db = mysqli_select_db($connect,'euklides');
	
	//seleciona o nome de todas as salas criadas pelo professor do email recebido
	$query_select_salas = "SELECT s.cod_sala, s.nome, p.cod_professor, s.descricao FROM sala s, professor p WHERE p.email = '$email'
						AND s.professor_id = p.cod_professor";
	//a vari�vel $con recebe o resultado da execu��o da query
	$salas      = mysqli_query($connect,$query_select_salas);
	
	//seleciona o nome e o id de todos os objetos de aprendizagem cadastrados
	$query_select_jogos = "SELECT * FROM jogo";
	//a vari�vel $jogos recebe o resultado da execu��o da query
	$jogos      = mysqli_query($connect,$query_select_jogos);
	
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Minhas Salas</title>
  <link rel="stylesheet" type="text/css" href="css/inicial_professor.css">
</head>
<body>
	<div class="div_dash">
		<h4>Inicio</h4>
		<h2>Salas</h2>
	  	
	  	<?php 
	  	//enquanto houver salas, são criadas as divs
	  	while($dado_sala = $salas->fetch_array()) {?>
	  	<div class="div_sala">
	  		<a href="sala_view.php?cod_sala=<?php echo $dado_sala['cod_sala']; ?>&cod_prof=<?php echo $dado_sala['cod_professor']; ?>">
	  			<img class="imagem_sala" src="imgs/sala.png" alt="some text" ></a>
	  		<a href="sala_view.php?cod_sala=<?php echo $dado_sala['cod_sala']; ?>&cod_prof=<?php echo $dado_sala['cod_professor']; ?>">
	  		<p class="nome_sala"><?php echo $dado_sala['nome']; ?></p></a>
	  		<p class="descricao"><?php if ($dado_sala['descricao'] != null) echo $dado_sala['descricao']; ?></p>
	  	</div>
		<?php } ?>
		
		<div class="div_nova_sala">
			<input type="image" class="imagem_nova_sala" id="imagem_nova_sala"
		  		src="imgs/nova_sala.png" alt="some text" >
		</div>
	
		<!-- The Modal -->
		<div id="myModal" class="modal">
		
		  <!-- Modal content -->
		  <div class="modal-content">
		    <span class="close">&times;</span>
		    <form method="POST" action="inicial_professor.php">
			    <h4>Nova sala</h4>
			    <label class="labels">Nome</label><br>
			    <input class="campo" type="text" name="input_nome_sala" id="input_nome_sala"><br>
				<p class=margin_labels></p>
				<label class="labels">Disciplina</label><br>
				<input class="campo" type="text" name="input_disciplina" id="input_disciplina"><br>
				<p class=margin_labels></p>
				<label class="labels">Descri��o (opcional)</label><br>
				<input class="campo" type="text" name="input_descricao" id="input_descricao"><br>
				<p class=margin_labels></p>
				<label class="labels">Objetos de aprendizagem</label>
				<?php
				//enquanto houver jogos cadastrados no banco, � criado um checkbox
				while($dado_jogo = $jogos->fetch_array()) { ?>
					<br /><input class="labels" type="checkbox" id="<?php echo $dado_jogo['cod_jogo']; ?>" name="check_list[]" 
							value="<?php echo $dado_jogo['cod_jogo']; ?>">
			  		<label for="<?php echo $dado_jogo['cod_jogo']; ?>"> <?php echo $dado_jogo['nome']; ?></label><br />
				<?php } ?>
				<input type="submit" value="Criar sala" id="nova_sala" name="nova_sala">
	  		</form>
		  </div>
		
		</div>
  	
		<script>
		// Get the modal
		var modal = document.getElementById("myModal");
		
		// Get the button that opens the modal
		var btn = document.getElementById("imagem_nova_sala");
		
		// Get the <span> element that closes the modal
		var span = document.getElementsByClassName("close")[0];
		
		// When the user clicks the button, open the modal 
		btn.onclick = function() {
		  modal.style.display = "block";
		}
		
		// When the user clicks on <span> (x), close the modal
		span.onclick = function() {
		  modal.style.display = "none";
		}
		
		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
		  if (event.target == modal) {
		    modal.style.display = "none";
		  }
		}
		</script>
		
	</div>
</body>
</html>
