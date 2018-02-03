<?php
session_start();
require_once '../../init.php';
require '../../check.php';

$PDO = db_connect();

if (!empty($_SESSION['user_id']) && !empty($_POST["team"]) && !empty($_POST["carmodel"]) && !empty($_POST["skin"])):   
		try{   		 
		 
		$idtorneio=3;

		$sql2 = "INSERT INTO pilototorneio (
					idteam,
					idcarmodel,
					idskin,
					idtorneio,
					idpiloto) VALUES (
		             :idteam, 
		             :idcarmodel, 
		             :idskin,  
		             :idtorneio,  
		             :idpiloto) ";                 

		$stmtp = $PDO->prepare($sql2);                                  
		$stmtp->bindParam(':idteam', $_POST['team'], PDO::PARAM_STR);       
		$stmtp->bindParam(':idcarmodel', $_POST['carmodel'], PDO::PARAM_STR);    
		$stmtp->bindParam(':idskin', $_POST['skin'], PDO::PARAM_STR);
		$stmtp->bindParam(':idtorneio', $idtorneio , PDO::PARAM_STR); 
		$stmtp->bindParam(':idpiloto', $_SESSION['user_id'], PDO::PARAM_STR);   

		$stmtp->execute();   


		 echo "<script>alert('Inscrição inserida com sucesso')</script>";   
		 echo "<script>window.location = 'porschegt3backend.php';</script>";
		}catch(PDOException $erro){   
		 echo "<script>alert('Erro na linha: {$erro->getLine()}')</script>";   
		}   
		endif;  

?>
