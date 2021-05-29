<?php

class JogosDAO {

	public function ConsultarJogosDaSala ($cod_sala){
		//$connect = mysqli_connect('localhost','root','admin');
		$connect = mysqli_connect('200.137.132.9','darti_user','1RApnE0P');
		$db = mysqli_select_db($connect,'darti_db');
		//cria a query para verificar quais jogos há na sala
		$query_select_jogo = "SELECT j.cod_jogo, j.nome FROM jogo j, sala s, sala_jogo sj
		WHERE s.cod_sala = $cod_sala AND s.cod_sala = sj.sala_id AND j.cod_jogo = sj.jogo_id";
		//a variável $jogos recebe o resultado da execução da query
		$jogos 		 = mysqli_query($connect,$query_select_jogo);
		// 	$array_jogos = mysqli_fetch_array($jogos);
		return  $jogos;
	}
}
?>