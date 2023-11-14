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



 ?>