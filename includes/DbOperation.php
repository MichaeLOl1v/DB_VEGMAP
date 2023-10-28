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

		function deleteusuario($idusuario){
			$stmt = $this->conexao->prepare("DELETE FROM usuario WHERE idusuario = ? ");
			$stmt->bind_param("i", $idusuario);
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

		function updateestabelecimento($idestab, $nome_estab, $endereco, $telefone_estab, $descricaoestab, $idusuarioPC, $tipo){
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

			return $produtos;
		}

		function updateproduto($idprodu, $nomeprodu, $tipoprodu, $medidaprodu, $saborprodu){
			$stmt = $this->conexao->prepare("UPDATE produto SET nomeprodu = ?, tipoprodu = ?, medidaprodu = ?, saborprodu = ? WHERE idprodu = ?");
			$stmt->bind_param("ssisi", $nomeprodu, $tipoprodu, $medidaprodu, $saborprodu, $idprodu);
			if($stmt->execute())
					return true;
				return false;
		}

		function deleteproduto($idprodu){
			$stmt = $this->conexao->prepare("DELETE FROM produto WHERE idprodu = ? ");
			$stmt->bind_param("i", $idprodu);
			if($stmt->execute())
				return true;
		}

		// TABELA AVALIAÇÃO

		function createavaliacao($idavaliacao, $nota, $comentario, $idestab){
			$stmt = $this->conexao->prepare("INSERT INTO avaliacao (nota, comentario, idestab) VALUES (?, ?, ?)");
			$stmt->db2_bind_param("isi", $nota, $comentario, $idestab);
			if (stmt->execute()) 
					return true;
				return false;		
		}

		function getavaliacaos(){
			$stmt = $this->conexao->prepare("SELECT idavaliacao, nota, comentario, idestab FROM avaliacao")
			$stmt->execute();
			$stmt->bind_result($idavaliacao, $nota, $comentario, $idestab);

			$produtos = array();

			while($stmt->fetch()){
					$avaliacao = array();
					$avaliacao['idavaliacao'] = $idavaliacao;
					$avaliacao['nota'] = $nota;
					$avaliacao['comentario'] = $comentario;
					$avaliacao['idestab'] = $idestab;

					array_push($avaliacaos, $avaliacao);
			}

			return $avaliacaos;
		}

		function updateavaliacao($idavaliacao, $nota, $comentario, $idestab){
			$stmt = $this->conexao->prepare("UPDATE avaliacao SET nota = ?, comentario = ?, idestab = ? WHERE idavaliacao = ?");
			$stmt->bind_param("ssii", $nota, $comentario, $idestab, $idavaliacao);
			if($stmt->execute())
					return true;
				return false;
		}

		function deleteavaliacao($idavaliacao){
			$stmt = $this->conexao->prepare("DELETE FROM avaliacao WHERE idavaliacao = ? ");
			$stmt->bind_param("i", $idavaliacao);
			if($stmt->execute())
				return true;
		}

		// TABELA AVALIAÇÃOP

		function createavaliacaop($idavaliacaop, $notap, $comentariop, $idprodu){
			$stmt = $this->conexao->prepare("INSERT INTO avaliacaop (notap, comentariop, idprodu) VALUES (?, ?, ?)");
			$stmt->db2_bind_param("isi", $notap, $comentariop, $idprodu);
			if (stmt->execute()) 
					return true;
				return false;		
		}

		function getavaliacaosp(){
			$stmt = $this->conexao->prepare("SELECT idavaliacaop, notap, comentariop, idprodu FROM avaliacaop")
			$stmt->execute();
			$stmt->bind_result($idavaliacaop, $notap, $comentariop, $idprodu);

			$produtos = array();

			while($stmt->fetch()){
					$avaliacaop = array();
					$avaliacaop['idavaliacaop'] = $idavaliacaop;
					$avaliacaop['notap'] = $notap;
					$avaliacaop['comentariop'] = $comentariop;
					$avaliacaop['idprodu'] = $idprodu;

					array_push($avaliacaosp, $avaliacaop);
			}

			return $avaliacaosp;
		}

		function updateavaliacaop($idavaliacaop, $notap, $comentariop, $idprodu){
			$stmt = $this->conexao->prepare("UPDATE avaliacaop SET notap = ?, comentariop = ?, idestabp = ? WHERE idavaliacaop = ?");
			$stmt->bind_param("ssii", $notap, $comentariop, $idprodu, $idavaliacaop);
			if($stmt->execute())
					return true;
				return false;
		}

		function deleteavaliacaop($idavaliacaop){
			$stmt = $this->conexao->prepare("DELETE FROM avaliacaop WHERE idavaliacaop = ? ");
			$stmt->bind_param("i", $idavaliacaop);
			if($stmt->execute())
				return true;
		}
	}
 ?>