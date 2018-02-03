<?php

$PDO = new PDO("mysql:host=localhost;dbname=gridonline;charset=utf8mb4", "root", ""); 

if (!empty($_POST["carmodel"]) && !empty($_POST["desccarmodel"])):   
try{

$total=0;

$sql= "SELECT idcarmodel FROM carmodel WHERE carmodel =:carmodel"; 
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':carmodel', $_POST['carmodel'] , PDO::PARAM_STR); 
$stmt->execute();
$obj = $stmt->fetchObject();  
$total = $stmt->rowCount();


echo $total;

		if ($total==0) {
				$sql2 = "INSERT INTO carmodel (
									
									carmodel,
									desccarmodel
										) VALUES (
						             :carmodel,
						             :desccarmodel
						             ) ";                 

						$stmtp = $PDO->prepare($sql2);                                  
						$stmtp->bindParam(':carmodel', $_POST['carmodel'], PDO::PARAM_STR);        
						$stmtp->bindParam(':desccarmodel', $_POST['desccarmodel'], PDO::PARAM_INT); 
						$stmtp->execute(); 
						echo "<script>alert('Carmodel inserida com sucesso')</script>";   
		            	echo "<script>window.location = 'frmcarmodel.php';</script>"; 
		} else {
						echo "<script>alert('Carmodel já existe no banco de dados')</script>";  
						echo "<script>window.location = 'frmcarmodel.php';</script>"; 
		}
	}
	catch(PDOException $erro){   
	 echo "<script>alert('Erro na linha: {$erro->getLine()}')</script>";   

	}
endif; 	
echo "<script>window.location = 'frmcarmodel.php';</script>"; 

?>


