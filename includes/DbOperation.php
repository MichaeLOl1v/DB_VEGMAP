<?php 
	
class DbOperation
{

	private $conexao;
	
	function __construct()
	{

		require_once dirname(__FILE__) . 'DbConnect.php';

		$db = new DbConnect();

		$this->conexao = $db->connect();
	}


	function createusuario($nome, $telefone, $email, $senha){
		$stmt = $this->conexao->prepare("INSERT INTO usuario (nome, telefone, email, senha) VALUES (?, ?, ?, ?)");
		$stmt->db2_bind_param("siss", $nome, $telefone, $email, $senha);
		if ($stmt->execute()) 
			return true;
		return false;		
	}
	
}





 ?>