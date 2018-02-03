<?php
session_start();
require_once 'init.php';
require 'check.php';
$PDO = db_connect(); 


if (!empty($_POST["guid2"]) && !empty($_POST["numero2"])):   
try{

$sql2 = "UPDATE piloto SET 
                     
            numero = :numero  

            WHERE guid = :guid";          

			$stmtp = $PDO->prepare($sql2);                                  			
			$stmtp->bindParam(':numero', $_POST['numero2'], PDO::PARAM_STR);
			$stmtp->bindParam(':guid', $_POST["guid2"], PDO::PARAM_STR); 
			$stmtp->execute();

            echo "<script>alert('Número atualizado com sucesso')</script>";   
            echo "<script>window.location = 'piloto.php';</script>";  
	}
	catch(PDOException $erro){   
	 echo "<script>alert('Erro na linha: {$erro->getLine()}')</script>";                  			
	}
endif; 	
?>
