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

?>