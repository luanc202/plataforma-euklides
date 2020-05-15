<?php

class AlunosDAO {
	
	public function ConsultarAlunoPorCod ($cod_aluno){
		$connect = mysqli_connect('localhost','root','admin');
		$db = mysqli_select_db($connect,'euklides');
		//consulta aluno por código
		$query_select_aluno = "SELECT* FROM aluno
		WHERE cod_aluno = $cod_aluno";
		//a variável $jogos recebe o resultado da execução da query
		$aluno 		 = mysqli_query($connect,$query_select_aluno);

		return  $aluno;
	}
}
?>