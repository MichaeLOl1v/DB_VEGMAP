<?php 

	require_once '../includes/DbOperation.php';

	// USUARIO

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
	
	
	$response = array();
	

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
					
					$response['error'] = false; 

					
					$response['message'] = 'Usuario adicionado com sucesso';

					
					$response['usuarios'] = $db->getusuarios();
				}else{

					
					$response['error'] = true; 

				
					$response['message'] = 'Algum erro ocorreu por favor tente novamente';
				}
				
			break; 
			
		
			case 'getusuarios':
				$db = new DbOperation();
				$response['error'] = false; 
				$response['message'] = 'Pedido concluído com sucesso';
				$response['usuarios'] = $db->getusuarios();
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
					$response['error'] = false; 
					$response['message'] = 'Usuario atualizado com sucesso';
					$response['usuarios'] = $db->getusuarios();
				}else{
					$response['error'] = true; 
					$response['message'] = 'Algum erro ocorreu por favor tente novamente';
				}
			break; 
			
			
			case 'deleteusuario':

				
				if(isset($_GET['idusuario'])){
					$db = new DbOperation();
					if($db->deleteusuario($_GET['idusuario'])){
						$response['error'] = false; 
						$response['message'] = 'Usuario excluído com sucesso';
						$response['usuarios'] = $db->getusuarios();
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


	// UsuarioPC


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
	
	
	$response = array();
	

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


?>