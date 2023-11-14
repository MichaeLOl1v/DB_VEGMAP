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

 ?>