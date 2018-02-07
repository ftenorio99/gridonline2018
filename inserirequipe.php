<?php

session_start();
require_once 'init.php';
require 'check.php';
$PDO = db_connect(); 

if (!empty($_POST)):   
try{
	if ($_POST["botao"]=="Inserir") {

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


	if ($_POST["botao"]=="Alterar") {

									$sql2 = "UPDATE team SET name = :name 
							            		WHERE idteam = :idteam ";                 
									$stmtp = $PDO->prepare($sql2);                                  
									$stmtp->bindParam(':name', $_POST['namenovo'], PDO::PARAM_STR); 
									$stmtp->bindParam(':idteam', $_POST['team'], PDO::PARAM_STR);  
									$stmtp->execute(); 
									echo "<script>alert('Equipe atualizada com sucesso')</script>";   
					            	echo "<script>window.location = 'panel.php';</script>"; 					
				}


	if ($_POST["botao"]=="Excluir") {

							$sql2 = "DELETE FROM team WHERE idteam =  :idteam  ";                 

									$stmtp = $PDO->prepare($sql2);                                  
									$stmtp->bindParam(':idteam', $_POST['team'], PDO::PARAM_STR);        
									$stmtp->execute(); 
									echo "<script>alert('Equipe excluída com sucesso')</script>";   
					            	echo "<script>window.location = 'panel.php';</script>"; 
				}


	}
				catch(PDOException $erro){   
				 echo "<script>alert('Erro na linha: {$erro->getLine()}')</script>";                  			
				}
endif; 	

?>

