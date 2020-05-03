<?php

//caso o professor tenha criado uma nova sala, a variável $nome_sala irá receber o nome digitado
$nome_sala = $_POST['input_nome_sala'];
//caso o professor tenha criado uma nova sala, a variável $descricao irá receber a descrição digitado
$descricao = $_POST['input_descricao'];
//caso o professor tenha criado uma nova sala, a variável $disciplina irá receber a disciplina digitado
$disciplina = $_POST['input_disciplina'];
//recebe o cookie referente ao email enviado pela página login.php
$email = $_COOKIE['email'];

//cria a conexão
$connect = mysqli_connect('localhost','root','admin');
//seleciona o banco de dados euklides
$db = mysqli_select_db($connect,'euklides');

//criada a query descobrir o id do professor com o email digitado
$query_select_professor = "SELECT id FROM professor WHERE email = '$email'";
//a variável $select_professor recebe o resultado da execução dessa query
$select_professor = mysqli_query($connect,$query_select_professor);
//o array $array_professor recebe todos os valores da busca
$array_professor = mysqli_fetch_array($select_professor);
//a variável $id_professor recebe o id do professor
$id_professor = $array_professor['id'];

if(empty($_POST['check_list']) || $nome_sala == "" || $nome_sala == null|| $descricao == "" || $descricao == null
		|| $disciplina == "" || $disciplina == null) {
	echo"<script language='javascript' type='text/javascript'>
		          alert('Todos os campos devem ser preenchidos');window.location
		          .href='inicial_professor_view.php'</script>";
	die();
} else{	
	//criada a query para verificar se existe alguma sala desse professor com o mesmo nome
	$query_select_sala = "SELECT * FROM sala WHERE nome = '$nome_sala' AND professor_id = '$id_professor'";
	//a variável $select_sala recebe o resultado da execução dessa query
	$select_sala = mysqli_query($connect,$query_select_sala);
	//o array $array_sala recebe todos os valores da busca
	$array_sala = mysqli_fetch_array($select_sala);
	//o array $nome_sala_array recebe os nomes retornados na busca, se ele não encontrar nome igual,
	//não vai retornar nenhum índice
	$nome_sala_array = $array_sala['nome'];
	
	// se encontrar alguma sala com nome igual retorna para a página inicial do professor	
	if($nome_sala_array == $nome_sala){
		echo"<script language='javascript' type='text/javascript'>
		          alert('Essa sala já existe');window.location
		          .href='inicial_professor_view.php'</script>";
		die();
	//fazer o cadastro da sala
	} else {
		//exclui o cookie recebido
		unset($_COOKIE['email']);
		//cria a query para criar uma nova sala
		$query = "INSERT INTO sala (nome,professor_id,descricao,disciplina) VALUES 
					('$nome_sala',$id_professor,'$descricao','$disciplina')";
		//a variável $insert recebe o resultado (true ou false) da inserção
		$insert = mysqli_query($connect,$query);
		
		//cria a query para obter o id da sala
		$query_select_sala = "SELECT id FROM sala WHERE nome='$nome_sala'";
		//a variável $select_sala recebe o resultado da execução da query
		$select_sala = mysqli_query($connect,$query_select_sala);
		//o array $array_sala recebe os valores retornados
		$array_sala = mysqli_fetch_array($select_sala);
		//a variável $id_sala recebe o valor do array corresponde ao id
		$id_sala = $array_sala['id'];
		
		//cria um registro na tabela sala_jogo paracada jogo selecionado pelo professor
		foreach($_POST['check_list'] as $selected) {
			
			//criada a query para verificar se já exite um registro sala_jogo com esses dados
			$query_select_sala = "SELECT * FROM sala_jogo WHERE sala_id = $id_sala AND jogo_id = $selected";
			//se não voltar nennhum registro (número de linhas menor igual a zero zero) cadastra
			if (mysqli_num_rows($query_select_sala)<=0) {
				//cria a query para cadastrar o jogo e a sala na tabela sala_jogo
				$query_insert_sala_jogo = "INSERT INTO sala_jogo (sala_id,jogo_id) VALUES ($id_sala,$selected)";
				$insert_sala_jogo = mysqli_query($connect,$query_insert_sala_jogo);
			}		
		}
	}
	
	//se a inserção tiver ocorrido
	if($insert){
		//emite a mensagem, encaminha para a página sala.php e coloca com parâmetro o nome da sala e o id do professor
		echo"<script language='javascript' type='text/javascript'>
				alert('Sala cadastrada com sucesso!');";
		echo "javascript:window.location='sala.php?nome=".$nome_sala."&cod_prof=".$id_professor."';</script>";
		
		//se a inserção não tiver ocorrido
	} else {
		//emite a mensagem e encaminha para a página inicial_professor.php
		echo"<script language='javascript' type='text/javascript'>
		          alert('Não foi possível cadastrar essa sala');window.location
		          .href='inicial_professor.php'</script>";
	}
}

?>