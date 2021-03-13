<?php

//verifica se há o parâmetro nome na url
if (isset($_GET['cod_sala'])){
	include 'header.php';
	include 'dao/jogos_dao.php';
	include 'dao/alunos_dao.php';
	
	//cria a conexão
	$connect = mysqli_connect('localhost','root','admin');
	//$connect = mysqli_connect('200.137.132.9','darti_user','1RApnE0P');
	//seleciona o banco de dados euklides
	$db = mysqli_select_db($connect,'euklides');
	
	//se sim, a variável $nome_sala e $id_professor recebem os respectivos valores
	$cod_sala = $_GET['cod_sala'];
	$id_professor = $_GET['cod_prof'];
	//é criado o link para a tela cadastro_view e adicionado como parâmetro o nome da sala
	//dessa forma, os alunos podem se cadastrar direto na sala
	//$link = "http://www.darti.ufma.br/plataforma-euklides/index.php?cod_sala=$cod_sala&cod_prof=$id_professor";
	$link = "http://localhost/plataforma-euklides/index.php?cod_sala=$cod_sala&cod_prof=$id_professor";
	
// 	//cria a query para verificar quais jogos há na sala
// 	$query_select_jogo = "SELECT j.cod_jogo, j.nome FROM jogo j, sala s, sala_jogo sj
// 	WHERE s.cod_sala = $cod_sala AND s.cod_sala = sj.sala_id AND j.cod_jogo = sj.jogo_id";
// 	//a variável $jogos recebe o resultado da execução da query
// 	$jogos 		 = mysqli_query($connect,$query_select_jogo);
// // 	$array_jogos = mysqli_fetch_array($jogos);
		
	//cria a query para verificar quais alunos estão na sala
	$query_alunos = "SELECT a.cod_aluno, a.nome FROM sala s, aluno a WHERE a.sala_id = s.cod_sala AND s.cod_sala = $cod_sala";
	//a variável $alunos recebe o resultado da execução da query
	$alunos       = mysqli_query($connect,$query_alunos);
	
	//cria a query para descobrir dados da sala
	$query_sala = "SELECT * FROM sala s WHERE s.cod_sala = '$cod_sala'";
	$select_sala = mysqli_query($connect,$query_sala);
	$array_sala = mysqli_fetch_array($select_sala);
	$nome_sala = $array_sala['nome'];
	$disciplina_sala = $array_sala['disciplina'];
	$descricao_sala = $array_sala['descricao'];
	
	//cria query para descobrir todos os jogos disponíveis
	$query_todos_jogos = "SELECT * FROM jogo";
	$todos_jogos = mysqli_query($connect,$query_todos_jogos);	
	
	?>

	<html>
	<head>
	  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	  <title>Minhas Salas</title>
	  <link rel="stylesheet" type="text/css" href="css/sala.css">
	</head>
	<body>
		<div class="div_dash">
			<div class="atalhos">
			<a href="inicial_professor_view.php">Início ></a>
			<a href="sala_view.php?cod_sala=<?php echo $cod_sala;?>&cod_prof=<?php echo $id_professor;?>"><?php echo $nome_sala; ?></a>
			</div>
			
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
			
			<div class="div_gerenciar" id="div_gerenciar">
				<p class=margin_campos></p>
				<form id="form_editar_sala" class="form_editar_sala" method="POST">
				<p class=margin_campos></p>
				<label>Nome</label><br><input class="campo" type="text" name="nome" id="nome" value="<?php echo $nome_sala;?>"><br>
				<p class=margin_labels></p>
				<label>Disciplina</label><br><input class="campo" type="text" name="disciplina" id="disciplina" 
				value="<?php echo $disciplina_sala;?>"><br>
				<p class=margin_labels></p>
				<label>Descrição (opcional)</label><br><input class="campo" type="text" name="descricao" id="descricao" 
				value="<?php echo $descricao_sala;?>"><br>
				<p class=margin_labels></p>
				<label>Objetos de aprendizagem</label><br>
				
				<?php
					//enquanto houver jogos cadastrados no banco, é criado um checkbox
				while($dado_jogos = $todos_jogos->fetch_array()) { 
					$cod_jogo = $dado_jogos['cod_jogo'];
					$query_jogo_sala = "SELECT * FROM sala_jogo sg WHERE sg.jogo_id=$cod_jogo AND sg.sala_id=$cod_sala";
					$jogo_sala = mysqli_query($connect,$query_jogo_sala);
					$teste = 0;
					if(mysqli_num_rows($jogo_sala) > 0){
					?>
					<br /><input class="labels" type="checkbox" id="<?php echo $dado_jogos['cod_jogo']; ?>" name="check_list[]" 
							value="<?php echo $dado_jogos['cod_jogo']; ?>" checked>
				  	
					<?php } else {?>
					<br /><input class="labels" type="checkbox" id="<?php echo $dado_jogos['cod_jogo']; ?>" name="check_list[]" 
							value="<?php echo $dado_jogos['cod_jogo']; ?>">
					<?php } ?>
					<label for="<?php echo $dado_jogos['cod_jogo']; ?>"> <?php echo $dado_jogos['nome']; ?></label><br />
				<?php } ?>
	
				<input type="submit" value="Editar" id="button_editar" name="button_editar"><br>
				<p class="p_resultado"></p>
			</form>
			</div>
			
			<div class="div_jogos" id="div_jogos">
			<?php
				$jogosDAO  = new JogosDAO();
				$jogos = $jogosDAO->ConsultarJogosDaSala($cod_sala);
				//enquanto houver jogos, saão criadas as divs
				while($dado_jogo = $jogos->fetch_array()) {?>
			  	<form class="div_jogo" method="POST">
			  		<a href="<?php echo $dado_jogo['cod_jogo'];?>/index.html">
			  			<img class="imagem_jogo" src="imgs/<?php echo $dado_jogo['nome']; ?>.jpg" alt="imagem do jogo" ></a>
			  		<a href="<?php echo $dado_jogo['cod_jogo'];?>/index.html">
			  		<p class="nome_jogo"><?php echo $dado_jogo['nome']; ?></p></a>
			  		<button type="submit" id="deletar_jogo" class="deletar_jogo" 
			  		name ="deletar_jogo[]" value="<?php echo $dado_jogo['cod_jogo'];?>" >
			  		</button>
			  	</form>
			  	
				<?php } //fecha o while ?> 
				
				<div class="div_novo_jogo">
					<input type="image" class="imagem_novo_jogo" id="imagem_novo_jogo"
			  			src="imgs/nova_sala.png" alt="some text" >
				</div>
			
			</div>
			
			<div class="div_alunos" id="div_alunos">
				<form method="POST">
				<table>
					<tr>
				    	<th>Aluno</th>
				    	<th>Jogo</th>
				    	<th>Level</th>
				    	<th>Número de acertos</th>
				    	<th>Tempo gasto</th>
				    	<th>Número de dicas</th>
				    	<th>Número de erros</th>
				    	<th>Número de tentativas</th>
				  	</tr>
				  	<?php
				  	//na tabela deve ser registrado um registro para cada aluno e para cada jogo jogado
				  	while($dado_aluno = $alunos->fetch_array()) {
					  	// logo, enquanto houver jogos na sala deverá criar um registro
				  		$cod_aluno = $dado_aluno['cod_aluno'];
				  		$jogosDAO  = new JogosDAO();
				  		$jogos = $jogosDAO->ConsultarJogosDaSala($cod_sala);
				  						  		
					  	while ($dado_jogo = $jogos->fetch_array()) {
					  		//descobre o codigo de cada jogo cadastrado na sala
					  		$cod_jogo = $dado_jogo['cod_jogo'];
					  		
					  		$query_tentativas = "SELECT COUNT(jg.aluno_id) AS num_tentativas 
							FROM jogada jg 
							WHERE jg.aluno_id = $cod_aluno AND jg.jogo_id = $cod_jogo";
					  		$tentativas = mysqli_query($connect,$query_tentativas);
					  		$array_tentativas = mysqli_fetch_array($tentativas);
					  		$num_tentativas = $array_tentativas['num_tentativas'];
					  		
					  		//cria a query para verificar as jogadas de determinado aluno
					  		$query_jogadas = "SELECT jg.tempo_gasto,
					  		jg.num_dicas,
					  		jg.num_acertos,
					  		jg.num_erros,
					  		jg.level,
							jg.aluno_id,
					  		j.nome
					  		FROM jogada jg, jogo j
					  		WHERE 
							jg.aluno_id = $cod_aluno AND 
							jg.jogo_id = j.cod_jogo AND 
							jg.jogo_id = $cod_jogo AND 
							jg.num_acertos =  
								(SELECT MAX(num_acertos) FROM jogada WHERE jogo_id = $cod_jogo AND 
								aluno_id = $cod_aluno)";
					  		//a variável $jogadas recebe o resultado da execução da query
					  		$jogadas       = mysqli_query($connect,$query_jogadas);
					  		
					  		//enquanto houver jogos, são criadas as divs
					  		while ($dado_jogada = $jogadas->fetch_array()) {
					  			if($num_tentativas > 0){
						  		?>
						  		<tr>		  		
						  			<td><button type="submit" id="button_aluno_indiv" class="button_aluno_indiv" 
						  			name = "button_aluno_indiv[]" value="<?php echo $cod_aluno;?>">
						  			<?php echo $dado_aluno['nome'];?></button></td>
						  			
						    		<td><?php echo $dado_jogada['nome'];?></td>
						    		<td><?php echo $dado_jogada['level'];?></td>
						    		<td><?php echo $dado_jogada['num_acertos'];?></td>
						    		<td><?php echo $dado_jogada['tempo_gasto'];?></td>
						    		<td><?php echo $dado_jogada['num_dicas'];?></td>
						    		<td><?php echo $dado_jogada['num_erros'];?></td>
						    		<td><?php echo $num_tentativas;?></td>
						  		</tr>
					  			<?php } //fecha o while ?> 
					  	<?php } //fecha o while ?> 
					<?php } //fecha o while ?> 
				<?php } //fecha o while ?> 
				</table>
				</form>
			</div>
			
			
			<div class="div_aluno_individual" id="div_aluno_individual">
			
			<?php
	
				if(isset($_POST["button_aluno_indiv"])){
					?>
					<script type='text/javascript'>
					//divs
					document.getElementById("div_jogos").style.display = 'none';
					document.getElementById("div_alunos").style.display = 'none';
					document.getElementById("div_aluno_individual").style.display = 'block';
					document.getElementById("div_gerenciar").style.display = 'none';
					//botões
					document.getElementById("button_jogos").style.backgroundColor = '#d67d31';
					document.getElementById("button_jogos").style.color = 'white';
					document.getElementById("button_alunos").style.backgroundColor = '#F2F2F2';
					document.getElementById("button_alunos").style.color = 'black';
					document.getElementById("button_gerenciar").style.backgroundColor = '#d67d31';
					document.getElementById("button_gerenciar").style.color = 'white';
					</script>
					<?php 
					foreach ($_POST['button_aluno_indiv'] as $cod_aluno){
							$alunosDAO = new AlunosDAO();
							$aluno = $alunosDAO->ConsultarAlunoPorCod($cod_aluno);
							$aluno_array = mysqli_fetch_array($aluno);
						?>
						<h2>Dados <?php echo $aluno_array['nome']?></h2>
						
						<table>
						<tr>
						<th>Jogo</th>
						<th>Level</th>
						<th>Número de acertos</th>
						<th>Tempo gasto</th>
						<th>Número de dicas</th>
						<th>Número de erros</th>
						</tr>
						<?php
						$jogosDAO  = new JogosDAO();
						$jogos = $jogosDAO->ConsultarJogosDaSala($cod_sala);
						
						while ($dado_jogo = $jogos->fetch_array()) {
							//descobre o codigo de cada jogo cadastrado na sala
							$cod_jogo = $dado_jogo['cod_jogo'];
							
							//cria a query para verificar as jogadas de determinado aluno
							$query_jogadas = "SELECT jg.tempo_gasto,
							jg.num_dicas,
							jg.num_acertos,
							jg.num_erros,
							jg.level,
							jg.aluno_id,
							j.nome
							FROM jogada jg, jogo j
							WHERE
							jg.aluno_id = $cod_aluno AND
							jg.jogo_id = j.cod_jogo AND
							jg.jogo_id = $cod_jogo 
							ORDER BY jg.num_acertos DESC";
							//a variável $jogadas recebe o resultado da execução da query
							$jogadas       = mysqli_query($connect,$query_jogadas);
							
							//enquanto houver jogos, são criadas as divs
							while ($dado_jogada = $jogadas->fetch_array()) {
								?>
						  	<tr>
						    	<td><?php echo $dado_jogada['nome'];?></td>
						    	<td><?php echo $dado_jogada['level'];?></td>
						    	<td><?php echo $dado_jogada['num_acertos'];?></td>
						    	<td><?php echo $dado_jogada['tempo_gasto'];?></td>
						    	<td><?php echo $dado_jogada['num_dicas'];?></td>
						    	<td><?php echo $dado_jogada['num_erros'];?></td>
						  	</tr> 
							<?php } //fecha o while ?> 
						<?php } //fecha o while ?>
						</table>
						<input type="submit" value="Voltar" id="voltar_alunos" 
						class="voltar_alunos" name="voltar_alunos" onclick="history.back()">
					<?php } //fecha o for ?>
				<?php } //fecha o if ?>
								
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
		echo "<meta http-equiv='refresh' content='0'>";
	}
	
	if(isset($_POST["button_jogos"])){
		//se for selecionado o botão de cadastro, o formulário do cadastro é escondido
		?>
		<script type='text/javascript'>
			//divs
			document.getElementById("div_jogos").style.display = 'block';
			document.getElementById("div_alunos").style.display = 'none';
			document.getElementById("div_aluno_individual").style.display = 'none';
			document.getElementById("div_gerenciar").style.display = 'none';
			//botões
			document.getElementById("button_jogos").style.backgroundColor = '#F2F2F2';
			document.getElementById("button_jogos").style.color = 'black';
			document.getElementById("button_alunos").style.backgroundColor = '#d67d31';
			document.getElementById("button_alunos").style.color = 'white';
			document.getElementById("button_gerenciar").style.backgroundColor = '#d67d31';
			document.getElementById("button_gerenciar").style.color = 'white';
		</script>
		<?php
	}
	
	if(isset($_POST["button_alunos"])){
		//se for selecionado o botão de cadastro, o formulário do login é escondido
		?>
		<script type='text/javascript'>
			//divs
			document.getElementById("div_jogos").style.display = 'none';
			document.getElementById("div_alunos").style.display = 'block';
			document.getElementById("div_aluno_individual").style.display = 'none';
			document.getElementById("div_gerenciar").style.display = 'none';
			//botões
			document.getElementById("button_jogos").style.backgroundColor = '#d67d31';
			document.getElementById("button_jogos").style.color = 'white';
			document.getElementById("button_alunos").style.backgroundColor = '#F2F2F2';
			document.getElementById("button_alunos").style.color = 'black';
			document.getElementById("button_gerenciar").style.backgroundColor = '#d67d31';
			document.getElementById("button_gerenciar").style.color = 'white';
		</script>
		<?php
	}
	
	if(isset($_POST["button_gerenciar"])){
		//se for selecionado o botão de cadastro, o formulário do cadastro é escondido
		?>
		<script type='text/javascript'>
			//divs
			document.getElementById("div_jogos").style.display = 'none';
			document.getElementById("div_alunos").style.display = 'none';
			document.getElementById("div_aluno_individual").style.display = 'none';
			document.getElementById("div_gerenciar").style.display = 'block';
			//botões
			document.getElementById("button_jogos").style.backgroundColor = '#d67d31';
			document.getElementById("button_jogos").style.color = 'white';
			document.getElementById("button_alunos").style.backgroundColor = '#d67d31';
			document.getElementById("button_alunos").style.color = 'white';
			document.getElementById("button_gerenciar").style.backgroundColor = '#F2F2F2';
			document.getElementById("button_gerenciar").style.color = 'black';
		</script>
		<?php
	}
	
	if(isset($_POST["button_editar"])){
		$nome_editar = $_POST['nome'];
		$descricao_editar = $_POST['descricao'];
		$disciplina_editar = $_POST['disciplina'];
		
		$query_update_sala = "UPDATE sala SET nome='$nome_editar', descricao='$descricao_editar', disciplina='$disciplina_editar' 
		WHERE cod_sala=$cod_sala";
		$update_result = mysqli_query($connect,$query_update_sala);
		
		if($update_result){
			$query_delete_sg = "DELETE FROM sala_jogo WHERE sala_id=$cod_sala";
			$delete = mysqli_query($connect,$query_delete_sg);
			//cria um registro na tabela sala_jogo paracada jogo selecionado pelo professor
			foreach($_POST['check_list'] as $selected) {
				//cria a query para cadastrar o jogo e a sala na tabela sala_jogo
				$query_insert_sala_jogo = "INSERT INTO sala_jogo (sala_id,jogo_id) VALUES ($cod_sala,$selected)";
				$insert_sala_jogo = mysqli_query($connect,$query_insert_sala_jogo);
			}
			echo "<meta http-equiv='refresh' content='0'>";
			//emite a mensagem e encaminha para a página sala_view.php
	
			?>
			<script>
				//document.getElementById("p_resultado").innerHTML = "Sala editada com sucesso";
				alert("Sala editada com sucesso!");
			</script>
			<?php 
			
		} else {
			//emite a mensagem e encaminha para a página inicial_professor.php
			?>
			<script>
				alert("Não foi possível editar a sala");
			</script>
			<?php 
		}
	}
	
} else {
    header("Location:index.php");
}
?>
	
 
