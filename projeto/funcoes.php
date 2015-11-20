<?php
ini_set("display_errors","off");

function conectar(){
	$host = "localhost";
	$user = "root";
	$password = "";
	$database = "maratona";

	$conexao = mysql_connect($host,$user,$password);
	if (!$conexao) 
		die("Falha ao conectar ao banco de dados.");
		

	$db = mysql_select_db($database);
	if (!$db)
		die("Falha ao selecionar o banco de dados.");	

	return $conexao;	

}

function desconectar($con){
	mysql_close($con);
}

function salvarDificuldade($id,$descricao,$peso,$cor){
	$conexao = conectar();
	if ((is_null($id)) || ($id == ''))
		$sql = "insert into dificuldade (descricao,peso,cor) values ('$descricao','$peso','$cor')";
	else
		$sql = "update dificuldade set descricao ='$descricao',peso ='$peso',cor ='$cor' where id = '$id'";
	if (mysql_query($sql))

		$result = true;
	else
		$result = false;
	desconectar($conexao);
	return $result;
}

function salvarEquipe($id,$nome,$tecnico){
	$conexao = conectar();
	if ((is_null($id)) || ($id == ''))
		$sql = "insert into equipe (nome,tecnico) values ('$nome','$tecnico')";
	else
		$sql = "update equipe set nome ='$nome',tecnico ='$tecnico' where id = '$id'";
	if (mysql_query($sql))

		$result = true;
	else
		$result = false;
	desconectar($conexao);
	return $result;
}

function salvarMembro($id,$nome,$equipe){
	$conexao = conectar();
	if ((is_null($id)) || ($id == ''))
		$sql = "insert into membros (nome,equipe) values ('$nome','$equipe')";
	else
		$sql = "update membros set nome ='$nome',equipe ='$equipe' where id = '$id'";
	if (mysql_query($sql))
		$result = true;
	else
		$result = false;
	desconectar($conexao);
	return $result;
}

function salvarAvaliacao($id,$avaliacao,$questao,$equipe){
	$hora = date('Y-m-d H:i');
	$conexao = conectar();
	if ((is_null($id)) || ($id == ''))
		$sql = "insert into avaliacao (hora,avaliacao,questao,equipe) values ('$hora','$avaliacao','$questao','$equipe')";
	else
		$sql = "update avaliacao set hora ='$hora',equipe ='$equipe',avaliacao ='$avaliacao',questao ='$questao' where id = '$id'";
	if (mysql_query($sql))
		$result = true;
	else
		$result = false;
	desconectar($conexao);
	return $result;
}

function excluirDificuldade($id){
	$conexao = conectar();
	$sql = "delete from dificuldade where id = '$id'";
	if (mysql_query($sql))

		$result = true;
	else
		$result = false;
	desconectar($conexao);
	return $result;
}
function excluirEquipe($id){
	$conexao = conectar();
	$sql = "delete from equipe where id = '$id'";
	if (mysql_query($sql))

		$result = true;
	else
		$result = false;
	desconectar($conexao);
	return $result;
}

function excluirMembro($id){
	$conexao = conectar();
	$sql = "delete from membros where id = '$id'";
	if (mysql_query($sql))
		$result = true;
	else
		$result = false;
	desconectar($conexao);
	return $result;
}

function excluir($conteudo,$id){
	$conexao = conectar();
	$sql = "delete from $conteudo where id = '$id'";
	if (mysql_query($sql))
		$result = true;
	else
		$result = false;
	desconectar($conexao);
	return $result;
}

function listar($relacao){
	$conexao = conectar();
	$sql = "select * from {$relacao}";
	$query = mysql_query($sql);

	while ($obj = mysql_fetch_object($query))
		$lista[] = $obj;

	desconectar($conexao);
	return $lista;
}

function getRegistro($relacao,$id){
	$conexao = conectar();
	$sql = "select * from {$relacao} where id='{$id}'";
	$query = mysql_query($sql);

	$obj = mysql_fetch_object($query);

	desconectar($conexao);
	return $obj;
}

function getAcertos($equipe){
	$conexao = conectar();
	$sql = "select * from vacertos where equipe='{$equipe}'";
	$query = mysql_query($sql);

	while ($obj = mysql_fetch_object($query))
		$lista[] = $obj;

	desconectar($conexao);
	return $lista;
}



	header("Location: " . $_REQUEST["view"] . "-" .$code);

}


