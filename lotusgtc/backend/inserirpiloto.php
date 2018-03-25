<?php

if (!empty($_POST["guid2"])):   
try{ 

$PDO = new PDO("mysql:host=localhost;dbname=gridonline;charset=utf8mb4", "root", ""); 

$sql= "SELECT * FROM piloto WHERE guid = :guid"; 
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':guid', $_POST['guid2'] , PDO::PARAM_INT); 
$stmt->execute();
$obj = $stmt->fetchObject(); 

$sql2 = "UPDATE piloto SET 
            
           
            email = :email,  
                       
            telefone = :telefone,  
            senha = :senha,
            status = :status

            WHERE idpiloto= :idpiloto";          


			$stmtp = $PDO->prepare($sql2);                                  
			       
			$stmtp->bindParam(':idpiloto', $obj->idpiloto, PDO::PARAM_STR); 			
			$stmtp->bindParam(':email', $_POST['email'], PDO::PARAM_STR);			
			$stmtp->bindParam(':telefone', $_POST['telefone'] , PDO::PARAM_STR); 
			$stmtp->bindParam(':senha', $_POST['senha'] , PDO::PARAM_STR); 
			$stmtp->bindParam(':status', $obj->status, PDO::PARAM_STR); 

			$stmtp->execute();  

			echo "<script>alert('Piloto inserido com sucesso')</script>";   
		     echo "<script>window.location = 'lotusgtcbackend.php';</script>"; 
		    
		}catch(PDOException $erro){   
		 echo "<script>alert('Erro na linha: {$erro->getLine()}')</script>";   
		}   
		endif; 

?>