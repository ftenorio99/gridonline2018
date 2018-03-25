<?php

session_start();
require_once 'init.php';
require 'check.php';
$PDO = db_connect(); 

print_r($_POST);

if (!empty($_POST)):   
try{

	if ($_POST["botao"]=="Inserir") {

			if (!empty($_POST["nome"]) && !empty($_POST["categoria"])):   
			try{

			$total=0;

			$sql= "SELECT idtorneio FROM torneio WHERE nome =:nome"; 
			$stmt = $PDO->prepare($sql);
			$stmt->bindParam(':nome', $_POST['nome'] , PDO::PARAM_STR); 
			$stmt->execute();
			$obj = $stmt->fetchObject();  
			$total = $stmt->rowCount();

					if ($total==0) {
							$sql2 = "INSERT INTO torneio (
												
												nome,
												categoria,
												status
													) VALUES (
									             :nome,
									             :categoria,
									             :status
									             ) ";                 
									$status = "A";
									$stmtp = $PDO->prepare($sql2);                                  
									$stmtp->bindParam(':nome', $_POST['nome'], PDO::PARAM_STR);        
									$stmtp->bindParam(':categoria', $_POST['categoria'], PDO::PARAM_INT); 
									$stmtp->bindParam(':status',$status , PDO::PARAM_STR); 
									$stmtp->execute(); 
									echo "<script>alert('Torneio inserido com sucesso')</script>";   
					            	echo "<script>window.location = 'frminserirtorneio.php';</script>"; 
					} else {
									echo "<script>alert('Torneio já existe no banco de dados')</script>";  
									echo "<script>window.location = 'frminserirtorneio.php';</script>"; 
					}
				}
				catch(PDOException $erro){   
				 echo "<script>alert('Erro na linha: {$erro->getLine()}')</script>";   

				}
			endif; 	
			echo "<script>window.location = 'frminserirtorneio.php';</script>"; 
		}

		if ($_POST["botao"]=="Excluir") {
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


	}
				catch(PDOException $erro){   
				 echo "<script>alert('Erro na linha: {$erro->getLine()}')</script>";                  			
				}
endif; 	

?>


