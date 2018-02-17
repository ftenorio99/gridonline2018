
<?php
session_start();
require_once 'init.php';
require 'check.php';

if (!empty($_POST["guid2"]) && !empty($_POST["senha"]) && !empty($_POST["email"]) && !empty($_POST["telefone"]))
	{
		$PDO = db_connect();

			$sql2 = "UPDATE piloto SET 
			                       
			            email = :email                         
			            ,telefone = :telefone
			            ,senha = :senha
			  /*        ,login = :login            
			            ,status = :status*/

            WHERE guid = :guid";          


			$stmtp = $PDO->prepare($sql2);                                  
			       
			$stmtp->bindParam(':guid', $_POST['guid2'] , PDO::PARAM_STR); 
			$stmtp->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
			$stmtp->bindParam(':telefone', $_POST["telefone"] , PDO::PARAM_STR);   
			// $stmtp->bindParam(':login', $_POST['login'], PDO::PARAM_STR); 
			$stmtp->bindParam(':senha', $_POST['senha'] , PDO::PARAM_STR); 
			// $stmtp->bindParam(':status', $obj->status, PDO::PARAM_STR); 

			$stmtp->execute();  

			echo "<script>alert('Dados do piloto atualizado com sucesso')</script>";   
		    echo "<script>window.location = 'panel.php';</script>"; 

	}  else {
		echo "<script>alert('Todos os campos são obrigatórios')</script>";
		echo "<script>window.location = 'frminserirpiloto.php';</script>"; 
	} 

?>
