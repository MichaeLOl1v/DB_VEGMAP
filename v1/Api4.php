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