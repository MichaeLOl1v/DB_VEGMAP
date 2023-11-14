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

 ?>