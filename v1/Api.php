<?php 

	require_once '../includes/DbOperation.php';

	function isTheseParametersAvailable($params){
	
		$available = true; 
		$missingparams = ""; 
		
		foreach($params as $param){
			if(!isset($_POST[$param]) || strlen($_POST[$param])<=0){
				$available = false; 
				$missingparams = $missingparams . ", " . $param; 
			}
		}

		if(!$available){
			$response = array(); 
			$response['error'] = true; 
			$response['message'] = 'Parameters ' . substr($missingparams, 1, strlen($missingparams)) . ' missing';
			
		
			echo json_encode($response);
			
		
			die();
		}
	}

	// USUARIO
	
	
	$response1 = array();
	

	if(isset($_GET['apicall'])){
		
		switch($_GET['apicall']){
	
			case 'createusuario':
	
				isTheseParametersAvailable(array('nome','telefone','email','senha'));
				
				$db = new DbOperation();
				
				$result = $db->createusuario(
					$_POST['nome'],
					$_POST['telefone'],
					$_POST['email'],
					$_POST['senha']
				);
				

			
				if($result){
					
					$response1['error'] = false; 

					
					$response1['message'] = 'Usuario adicionado com sucesso';

					
					$response1['usuarios'] = $db->getusuarios();
				}else{

					
					$response1['error'] = true; 

				
					$response1['message'] = 'Algum erro ocorreu por favor tente novamente';
				}
				
			break; 
			
		
			case 'getusuarios':
				$db = new DbOperation();
				$response1['error'] = false; 
				$response1['message'] = 'Pedido concluído com sucesso';
				$response1['usuarios'] = $db->getusuarios();



			break; 
			
			
		
			case 'updateusuario':
				isTheseParametersAvailable(array('idusuario','nome','telefone','email','senha'));
				$db = new DbOperation();
				$result = $db->updateusuario(
					$_POST['idusuario'],
					$_POST['nome'],
					$_POST['telefone'],
					$_POST['email'],
					$_POST['senha']
				);
				
				if($result){
					$response1['error'] = false; 
					$response1['message'] = 'Usuario atualizado com sucesso';
					$response1['usuarios'] = $db->getusuarios();
				}else{
					$response1['error'] = true; 
					$response1['message'] = 'Algum erro ocorreu por favor tente novamente';
				}
			break; 
			
			
			case 'deleteusuario':

				
				if(isset($_GET['idusuario'])){
					$db = new DbOperation();
					if($db->deleteusuario($_GET['idusuario'])){
						$response1['error'] = false; 
						$response1['message'] = 'Usuario excluído com sucesso';
						$response1['usuarios'] = $db->getusuarios();
					}else{
						$response1['error'] = true; 
						$response1['message'] = 'Algum erro ocorreu por favor tente novamente';
					}
				}else{
					$response1['error'] = true; 
					$response1['message'] = 'Não foi possível deletar, forneça um id por favor';
				}
			break; 
		}
		
	}else{
		 
		$response1['error'] = true; 
		$response1['message'] = 'Chamada de API inválida';

	}

	echo json_encode($response1);


	// UsuarioPC
	
	
	$response2 = array();
	

	if(isset($_GET['apicall'])){
		
		switch($_GET['apicall']){
	
			case 'createusuariopc':
				
				isTheseParametersAvailable(array('nomePC','cnpj','emailPC','senhaPC'));
				
				$db = new DbOperation();
				
				$result = $db->createusuariopc(
					$_POST['nomePC'],
					$_POST['cnpj'],
					$_POST['emailPC'],
					$_POST['senhaPC']
				);
				

			
				if($result){
					
					$response['error'] = false; 

					
					$response['message'] = 'Usuario parceiro adicionado com sucesso';

					
					$response['usuariospc'] = $db->getusuariospc();
				}else{

					
					$response['error'] = true; 

				
					$response['message'] = 'Algum erro ocorreu por favor tente novamente';
				}
				
			break; 
			
		
			case 'getusuariospc':
				$db = new DbOperation();
				$response['error'] = false; 
				$response['message'] = 'Pedido concluído com sucesso';
				$response['usuariospc'] = $db->getusuariospc();
			break; 
			
			
		
			case 'updateusuariopc':
				isTheseParametersAvailable(array('idusuarioPC','nomePC','cnpj','emailPC','senhaPC'));
				$db = new DbOperation();
				$result = $db->updateusuariopc(
					$_POST['idusuarioPC'],
					$_POST['nomePC'],
					$_POST['cnpj'],
					$_POST['emailPC'],
					$_POST['senhaPC']
				);
				
				if($result){
					$response['error'] = false; 
					$response['message'] = 'Usuario parceiro atualizado com sucesso';
					$response['usuariospc'] = $db->getusuariospc();
				}else{
					$response['error'] = true; 
					$response['message'] = 'Algum erro ocorreu por favor tente novamente';
				}
			break; 
			
			
			case 'deleteusuariopc':

				
				if(isset($_GET['idusuarioPC'])){
					$db = new DbOperation();
					if($db->deleteusuarioPC($_GET['idusuariopc'])){
						$response['error'] = false; 
						$response['message'] = 'Usuario parceiro excluído com sucesso';
						$response['usuariospc'] = $db->getusuariospc();
					}else{
						$response['error'] = true; 
						$response['message'] = 'Algum erro ocorreu por favor tente novamente';
					}
				}else{
					$response['error'] = true; 
					$response['message'] = 'Não foi possível deletar, forneça um id por favor';
				}
			break; 
		}
		
	}else{
		 
		$response['error'] = true; 
		$response['message'] = 'Chamada de API inválida';
	}
	
	echo json_encode($response);

	// ESTABELECIMENTO


	
	
	
	$response = array();
	

	if(isset($_GET['apicall'])){
		
		switch($_GET['apicall']){
	
			case 'createestabelecimento':
				
				isTheseParametersAvailable(array('nome_estab','endereco','telefone_estab','descricaoestab','idusuarioPC','tipo'));
				
				$db = new DbOperation();
				
				$result = $db->createestabelecimento(
					$_POST['nome_estab'],
					$_POST['endereco'],
					$_POST['telefone_estab'],
					$_POST['descricaoestab'],
					$_POST['idusuarioPC'],
					$_POST['tipo']
				);
				

			
				if($result){
					
					$response['error'] = false; 

					
					$response['message'] = 'Estabelecimento adicionado com sucesso';

					
					$response['estabelecimento'] = $db->getestabelecimentos();
				}else{

					
					$response['error'] = true; 

				
					$response['message'] = 'Algum erro ocorreu por favor tente novamente';
				}
				
			break; 
			
		
			case 'estabelecimentos':
				$db = new DbOperation();
				$response['error'] = false; 
				$response['message'] = 'Pedido concluído com sucesso';
				$response['estabelecimentos'] = $db->getestabelecimentos();
			break; 
			
			
		
			case 'updateestabelecimento':
				isTheseParametersAvailable(array('idestab','nome_estab','endereco','telefone_estab','descricaoestab','idusuarioPC','tipo'));
				$db = new DbOperation();
				$result = $db->updateusuariopc(
					$_POST['idestab'],
					$_POST['nome_estab'],
					$_POST['endereco'],
					$_POST['telefone_estab'],
					$_POST['descricaoestab'],
					$_POST['idusuarioPC'],
					$_POST['tipo']
				);
				
				if($result){
					$response['error'] = false; 
					$response['message'] = 'Estabelecimento atualizado com sucesso';
					$response['estabelecimentos'] = $db->getestabelecimentos();
				}else{
					$response['error'] = true; 
					$response['message'] = 'Algum erro ocorreu por favor tente novamente';
				}
			break; 
			
			
			case 'deleteestabelecimento':

				
				if(isset($_GET['idestab'])){
					$db = new DbOperation();
					if($db->deleteestabelecimento($_GET['idestab'])){
						$response['error'] = false; 
						$response['message'] = 'Estabelecimento excluído com sucesso';
						$response['estabelecimentos'] = $db->getestabelecimentos();
					}else{
						$response['error'] = true; 
						$response['message'] = 'Algum erro ocorreu por favor tente novamente';
					}
				}else{
					$response['error'] = true; 
					$response['message'] = 'Não foi possível deletar, forneça um id por favor';
				}
			break; 
		}
		
	}else{
		 
		$response['error'] = true; 
		$response['message'] = 'Chamada de API inválida';
	}

	echo json_encode($response);

	// PRODUTO


	
	
	
	$response = array();
	

	if(isset($_GET['apicall'])){
		
		switch($_GET['apicall']){
	
			case 'createproduto':
				
				isTheseParametersAvailable(array('nomeprodu','tipoprodu','medidaprodu','saborprodu'));
				
				$db = new DbOperation();
				
				$result = $db->createproduto(
					$_POST['nomeprodu'],
					$_POST['tipoprodu'],
					$_POST['medidaprodu'],
					$_POST['saborprodu']
				);
				

			
				if($result){
					
					$response['error'] = false; 

					
					$response['message'] = 'Produto adicionado com sucesso';

					
					$response['produtos'] = $db->getprodutos();
				}else{

					
					$response['error'] = true; 

				
					$response['message'] = 'Algum erro ocorreu por favor tente novamente';
				}
				
			break; 
			
		
			case 'getprodutos':
				$db = new DbOperation();
				$response['error'] = false; 
				$response['message'] = 'Pedido concluído com sucesso';
				$response['produtos'] = $db->getprodutos();
			break; 
			
			
		
			case 'updateproduto':
				isTheseParametersAvailable(array('idprodu','nomeprodu','tipoprodu','medidaprodu','saborprodu'));
				$db = new DbOperation();
				$result = $db->updateproduto(
					$_POST['idprodu'],
					$_POST['nomeprodu'],
					$_POST['tipoprodu'],
					$_POST['medidaprodu'],
					$_POST['saborprodu']
				);
				
				if($result){
					$response['error'] = false; 
					$response['message'] = 'Produto atualizado com sucesso';
					$response['produtos'] = $db->getprodutos();
				}else{
					$response['error'] = true; 
					$response['message'] = 'Algum erro ocorreu por favor tente novamente';
				}
			break; 
			
			
			case 'deleteproduto':

				
				if(isset($_GET['idprodu'])){
					$db = new DbOperation();
					if($db->deleteusuario($_GET['idprodu'])){
						$response['error'] = false; 
						$response['message'] = 'Produto excluído com sucesso';
						$response['produtos'] = $db->getprodutos();
					}else{
						$response['error'] = true; 
						$response['message'] = 'Algum erro ocorreu por favor tente novamente';
					}
				}else{
					$response['error'] = true; 
					$response['message'] = 'Não foi possível deletar, forneça um id por favor';
				}
			break; 
		}
		
	}else{
		 
		$response['error'] = true; 
		$response['message'] = 'Chamada de API inválida';
	}

	echo json_encode($response);


	// AVALIAÇÃO


	
	
	
	$response = array();
	

	if(isset($_GET['apicall'])){
		
		switch($_GET['apicall']){
	
			case 'createavaliacao':
				
				isTheseParametersAvailable(array('nota','comentario','idestab'));
				
				$db = new DbOperation();
				
				$result = $db->createavaliacao(
					$_POST['nota'],
					$_POST['comentario'],
					$_POST['idestab'],
				);
				

			
				if($result){
					
					$response['error'] = false; 

					
					$response['message'] = 'Avaliação adicionado com sucesso';

					
					$response['avaliacaos'] = $db->getavaliacaos();
				}else{

					
					$response['error'] = true; 

				
					$response['message'] = 'Algum erro ocorreu por favor tente novamente';
				}
				
			break; 
			
		
			case 'getavaliacaos':
				$db = new DbOperation();
				$response['error'] = false; 
				$response['message'] = 'Pedido concluído com sucesso';
				$response['avaliacaos'] = $db->getavaliacaos();
			break; 
			
			
		
			case 'updateavaliacao':
				isTheseParametersAvailable(array('idavaliacao','nota','comentario','idestab'));
				$db = new DbOperation();
				$result = $db->updateavaliacao(
					$_POST['idavaliacao'],
					$_POST['nota'],
					$_POST['comentario'],
					$_POST['idestab']
				);
				
				if($result){
					$response['error'] = false; 
					$response['message'] = 'Produto atualizado com sucesso';
					$response['avaliacaos'] = $db->getavaliacaos();
				}else{
					$response['error'] = true; 
					$response['message'] = 'Algum erro ocorreu por favor tente novamente';
				}
			break; 
			
			
			case 'deleteavaliacao':

				
				if(isset($_GET['idavaliacao'])){
					$db = new DbOperation();
					if($db->deleteusuario($_GET['idavaliacao'])){
						$response['error'] = false; 
						$response['message'] = 'Avaliação excluído com sucesso';
						$response['avaliacaos'] = $db->getavaliacaos();
					}else{
						$response['error'] = true; 
						$response['message'] = 'Algum erro ocorreu por favor tente novamente';
					}
				}else{
					$response['error'] = true; 
					$response['message'] = 'Não foi possível deletar, forneça um id por favor';
				}
			break; 
		}
		
	}else{
		 
		$response['error'] = true; 
		$response['message'] = 'Chamada de API inválida';
	}

	echo json_encode($response);


	// AVALIAÇÃO P


	
	
	$response = array();
	

	if(isset($_GET['apicall'])){
		
		switch($_GET['apicall']){
	
			case 'createavaliacaop':
				
				isTheseParametersAvailable(array('notap','comentariop','idprodu'));
				
				$db = new DbOperation();
				
				$result = $db->createavaliacaop(
					$_POST['notap'],
					$_POST['comentariop'],
					$_POST['idprodu'],
				);
				

			
				if($result){
					
					$response['error'] = false; 

					
					$response['message'] = 'Avaliação adicionado com sucesso';

					
					$response['avaliacaosp'] = $db->getavaliacaosp();
				}else{

					
					$response['error'] = true; 

				
					$response['message'] = 'Algum erro ocorreu por favor tente novamente';
				}
				
			break; 
			
		
			case 'getavaliacaosp':
				$db = new DbOperation();
				$response['error'] = false; 
				$response['message'] = 'Pedido concluído com sucesso';
				$response['avaliacaosp'] = $db->getavaliacaosp();
			break; 
			
			
		
			case 'updateavaliacaop':
				isTheseParametersAvailable(array('idavaliacaop','notap','comentariop','idprodu'));
				$db = new DbOperation();
				$result = $db->updateavaliacaop(
					$_POST['idavaliacaop'],
					$_POST['notap'],
					$_POST['comentariop'],
					$_POST['idprodu']
				);
				
				if($result){
					$response['error'] = false; 
					$response['message'] = 'Avaliaçãop atualizado com sucesso';
					$response['avaliacaosp'] = $db->getavaliacaosp();
				}else{
					$response['error'] = true; 
					$response['message'] = 'Algum erro ocorreu por favor tente novamente';
				}
			break; 
			
			
			case 'deleteavaliacaop':

				
				if(isset($_GET['idavaliacaop'])){
					$db = new DbOperation();
					if($db->deleteusuario($_GET['idavaliacaop'])){
						$response['error'] = false; 
						$response['message'] = 'Avaliação excluído com sucesso';
						$response['avaliacaosp'] = $db->getavaliacaosp();
					}else{
						$response['error'] = true; 
						$response['message'] = 'Algum erro ocorreu por favor tente novamente';
					}
				}else{
					$response['error'] = true; 
					$response['message'] = 'Não foi possível deletar, forneça um id por favor';
				}
			break; 
		}
		
	}else{
		 
		$response['error'] = true; 
		$response['message'] = 'Chamada de API inválida';
	}


	

	echo json_encode($response);
?>