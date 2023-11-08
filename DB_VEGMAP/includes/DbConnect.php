<?php 

	class DbConnect
	{

		private $conexao;
		
		function __construct()
		{
			
		}


		function connect()
		{

			include_once dirname(__FILE__) .'/Constants.php';

			$this->conexao = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);	
			if (mysqli_connect_errno()) {
				echo "Falha ao conectar no banco de dados: " . mysqli_connect_error(); 
			}

			return $this->conexao;


		}
	}




 ?>