<?php

session_start();
require_once 'init.php';
require 'check.php';
$PDO = db_connect(); 

//print_r($_POST);

	if (!empty($_POST)) {

		if ($_POST["botao"]=="Inserir") {

			if ( !empty($_POST["pista"]) && !empty($_POST["data"]) && !empty($_POST["torneio"]) && !empty($_POST["ordem"]) ){
				try{

			$total=0;

			// $sql= "SELECT idtorneio FROM pistatorneio WHERE idpista =:idpista"; 
			// $stmt = $PDO->prepare($sql);
			// $stmt->bindParam(':idpista', $_POST['pista'] , PDO::PARAM_STR); 
			// $stmt->execute();
			// $obj = $stmt->fetchObject();  
			// $total = $stmt->rowCount();


					if ($total==0) {
							$sql2 = "INSERT INTO pistatorneio (
												
												idpista,
												data,
												idtorneio,
												ordempista
													) VALUES (
									             :idpista,
									             :data,
									             :idtorneio,
									             :ordempista
									             )";                 
									
									$stmtp = $PDO->prepare($sql2);                                  
									$stmtp->bindParam(':idpista', $_POST['pista'], PDO::PARAM_INT);        
									$stmtp->bindParam(':data', $_POST['data'], PDO::PARAM_STR); 
									$stmtp->bindParam(':idtorneio', $_POST['torneio'] , PDO::PARAM_INT); 
									$stmtp->bindParam(':ordempista', $_POST['ordem'] , PDO::PARAM_STR);
									$stmtp->execute(); 
									echo "<script>alert('Pista inserida com sucesso')</script>";   
					            	echo "<script>window.location = 'frminserirpistatorneio.php';</script>"; 
					} else {
									echo "<script>alert('Pista já existe no banco de dados')</script>";  
									echo "<script>window.location = 'frminserirpistatorneio.php';</script>"; 
					}
				}
				catch(PDOException $erro){   
				 echo "<script>alert('Erro na linha: {$erro->getLine()}')</script>";   
				}			
			echo "<script>window.location = 'frminserirpistatorneio.php';</script>"; 
			}
		}
		if ($_POST["botao"]=="Excluir") {
			if ( !empty($_POST["pista"]) && !empty($_POST["data"]) && !empty($_POST["torneio"]) && !empty($_POST["ordem"]) ){   
				try{
										$status="I";
										$sql2 = "UPDATE torneio SET status = :status 
										            		WHERE idnome = :idnome";                 
												$stmtp = $PDO->prepare($sql2);                                  
												$stmtp->bindParam(':status', $status , PDO::PARAM_STR); 
												$stmtp->bindParam(':idnome', $_POST['nome'], PDO::PARAM_STR);  
												$stmtp->execute();               
			 
												echo "<script>alert('Torneio desativado com sucesso')</script>";   
								            	echo "<script>window.location = 'panel.php';</script>"; 
							


					}
					catch(PDOException $erro){   
					 echo "<script>alert('Erro na linha: {$erro->getLine()}')</script>";                  			
					}

 			} 	
 		}

	}

?>


