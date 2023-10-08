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

		function getusuarios(){
			$stmt = $this->conexao->prepare("SELECT idusuario, nome, telefone, email, senha FROM usuario");
			$stmt->execute();
			$stmt->bind_result($idusuario, $nome, $telefone, $email, $senha);

			$usuarios = array();

			while($stmt->fetch()){
					$usuario = array();
					$usuario['idusuario'] = $idusuario;
					$usuario['nome'] = $nome;
					$usuario['telefone'] = $telefone;
					$usuario['email'] = $email;
					$usuario['senha'] = $senha;

					array_push($usuarios, $usuario);
			
			}

			return $usuarios;

		}

		function updateusuario($idusuario, $nome, $telefone, $email, $senha){
			$stmt = $this->conexao->prepare("UPDATE usuario SET nome = ?, telefone = ?, email = ?, senha = ? WHERE id = ?");
			$stmt->bind_param("sissi", $nome, $telefone, $email, $senha, $id);
			if($stmt->execute())
				return true;
			return false;
		}

		function deleteusuario($id){
			$stmt = $this->conexao->prepare("DELETE FROM usuario WHERE id = ? ");
			$stmt->bind_param("i", $id);
			if($stmt->execute())
				return true;
		}	



		function createusuariopc($idusuarioPC, $nomePC, $cnpj, $telefonePC, $emailPC, $senhaPC){
			$stmt = $this->conexao->prepare("INSERT INTO usuariopc (nomepc, cnpj, telefonePC, emailPC, senhaPC) VALUES (?, ?, ?, ?, ?)");
			$stmt->db2_bind_param("siiss", $nomePC, $cnpj, $telefonePC, $emailPC, $senhaPC);
			if (stmt->execute()) 
					return true;
				return false;		
		}

		function getusuariospc(){
			$stmt = $this->conexao->prepare("SELECT idusuarioPC, nomePC, cnpj, telefonePC, emailPC, senhaPC FROM usuariopc")
			$stmt->execute();
			$stmt->bind_result($idusuarioPC, $nomePC, $cnpj, $telefonePC, $emailPC, $senhaPC);

			$usuariospc = array();

			while($stmt->fetch()){
					$usuariopc = array();
					$usuariopc['idusuarioPC'] = $idusuarioPC;
					$usuariopc['nomePC'] = $nomePC;
					$usuariopc['cnpj'] = $cnpj;
					$usuariopc['telefonePC'] = $telefonePC;
					$usuariopc['emailPC'] = $emailPC;
					$usuariopc['senhaPC'] = $senhaPC;

					array_push($usuariospc, $usuariopc);
			}

			return $usuariospc;
		}

		function updateusuariopc($idusuarioPC, $nomePC, $cnpj, $telefonePC, $emailPC, $senhaPC){
			$stmt = $this->conexao->prepare("UPDATE usuariopc SET nomePC = ?, cnpj = ?, telefonePC = ?, emailPC = ?, senhaPC = ? WHERE idusuarioPC = ?");
			$stmt->bind_param("siissi", $nomePC, $cnpj, $telefonePC, $emailPC, $senhaPC, $idusuarioPC);
			if($stmt->execute())
					return true;
				return false;
		}

		function deleteusuariopc($idusuarioPC){
			$stmt = $this->conexao->prepare("DELETE FROM usuariopc WHERE idusuarioPC = ? ");
			$stmt->bind_param("i", $idusuarioPC);
			if($stmt->execute())
				return true;
		}
	}
 ?>