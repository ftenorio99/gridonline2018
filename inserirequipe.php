<?php

$PDO = new PDO("mysql:host=localhost;dbname=gridonline;charset=utf8mb4", "root", ""); 


if (!empty($_POST["name"])):   
try{

$sql= "SELECT idteam FROM team WHERE name = ':name'"; 
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':name', $_POST['name'] , PDO::PARAM_STR); 
$stmt->execute();
$obj = $stmt->fetchObject();  
$total = $stmt->rowCount();

		if ($total==0) {
				$sql2 = "INSERT INTO team (
									name
										) VALUES (
						             :name) ";                 

						$stmtp = $PDO->prepare($sql2);                                  
						$stmtp->bindParam(':name', $_POST['name'], PDO::PARAM_STR);        
						$stmtp->execute(); 
						echo "<script>alert('Equipe inserida com sucesso')</script>";   
		            	echo "<script>window.location = 'panel.php';</script>"; 
		} else {
						echo "<script>alert('Equipe já existe no banco de dados')</script>";  
						echo "<script>window.location = 'panel.php';</script>"; 
		}
	}
	catch(PDOException $erro){   
	 echo "<script>alert('Erro na linha: {$erro->getLine()}')</script>";                  			
	}
endif; 	

?>

