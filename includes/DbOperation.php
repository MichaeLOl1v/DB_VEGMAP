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

		// TABELA USUARIOS

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

		// TABELA USUARIOS PARCEIROS

		function createusuariopc($idusuarioPC, $nomePC, $cnpj, $telefonePC, $emailPC, $senhaPC){
			$stmt = $this->conexao->prepare("INSERT INTO usuariopc (nomePC, cnpj, telefonePC, emailPC, senhaPC) VALUES (?, ?, ?, ?, ?)");
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

		// TABELA ESTABELECIMENTOS
		
		function createestabelecimento($idestab, $nome_estab, $endereco, $telefone_estab, $descricaoestab, $idusuarioPC, $tipo){
			$stmt = $this->conexao->prepare("INSERT INTO  (nome_estab, endereco, telefone_estab, descricaoestab, idusuarioPC, tipo) VALUES (?, ?, ?, ?, ?, ?)");
			$stmt->db2_bind_param("ssisis", $nome_estab, $endereco, $telefone_estab, $descricaoestab, $idusuarioPC, $tipo);
			if (stmt->execute()) 
					return true;
				return false;
		}

		function getestabelecimentos(){
			$stmt = $this->conexao->prepare("SELECT idestab, nome_estab, endereco, telefone_estab, descricaoestab, idusuarioPC, tipo FROM estabelecimento")
			$stmt->execute();
			$stmt->bind_result($idestab, $nome_estab, $endereco, $telefone_estab, $descricaoestab, $idusuarioPC, $tipo);

			$estabelecimentos = array();

			while($stmt->fetch()){
					$estabelecimento = array();
					$estabelecimento['idestab'] = $idestab;
					$estabelecimento['nome_estab'] = $nome_estab;
					$estabelecimento['endereco'] = $endereco;
					$estabelecimento['telefone_estab'] = $telefone_estab;
					$estabelecimento['descricaoestab'] = $descricaoestab;
					$estabelecimento['idusuarioPC'] = $idusuarioPC;
					$estabelecimento['tipo'] = $tipo;

					array_push($estabelecimentos, $estabelecimento);
			}

			return $estabelecimentos;
		}

		function updateestabelecimento($idestab, $nome_estab, $endereco, $telefone_estab, $descricaoestab, $idestab, $tipo){
			$stmt = $this->conexao->prepare("UPDATE estabelecimento SET nome_estab = ?, endereco = ?, telefone_estab = ?, descricaoestab = ?, idusuarioPC = ?, tipo = ? WHERE idestab = ?");
			$stmt->bind_param("ssisisi", $nome_estab, $endereco, $telefone_estab, $descricaoestab, $idusuarioPC, $tipo, $idestab);
			if($stmt->execute())
					return true;
				return false;
		}

		function deleteestabelecimento($idestab){
			$stmt = $this->conexao->prepare("DELETE FROM estabelecimento WHERE idestab = ? ");
			$stmt->bind_param("i", $idestab);
			if($stmt->execute())
				return true;
		}

		// TABELA USUARIOS PRODUTO

		function createproduto($idprodu, $nomeprodu, $tipoprodu, $medidaprodu, $saborprodu){
			$stmt = $this->conexao->prepare("INSERT INTO produto (nomeprodu, tipoprodu, medidaprodu, saborprodu) VALUES (?, ?, ?, ?)");
			$stmt->db2_bind_param("ssis", $nomeprodu, $tipoprodu, $medidaprodu, $saborprodu);
			if (stmt->execute()) 
					return true;
				return false;		
		}

		function getprodutos(){
			$stmt = $this->conexao->prepare("SELECT idprodu, nomeprodu, tipoprodu, medidaprodu, saborprodu FROM produto")
			$stmt->execute();
			$stmt->bind_result($idprodu, $nomeprodu, $tipoprodu, $medidaprodu, $saborprodu);

			$produtos = array();

			while($stmt->fetch()){
					$produto = array();
					$produto['idprodu'] = $idprodu;
					$produto['nomeprodu'] = $nomeprodu;
					$produto['tipoprodu'] = $tipoprodu;
					$produto['medidaprodu'] = $medidaprodu;
					$produto['saborprodu'] = $saborprodu;

					array_push($produtos, $produto);
			}

	}
 ?>