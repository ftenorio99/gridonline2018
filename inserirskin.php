<?php
session_start();
require_once 'init.php';
require 'check.php';

$PDO = db_connect();

if (!empty($_POST["piloto"]) && !empty($_POST["carmodel"]) && !empty($_FILES["arquivo"]['name'])): 

$diretorio = "C:/xampp/htdocs/gridonline/uploads/";
$palavras = explode(" ", $_SESSION['user_name']);
$primeiro_nome = $palavras[0];
$segundo_nome = $palavras[1];
$nomeskin=$primeiro_nome.'_'.$segundo_nome.'_'.$_POST['carmodel'];
$ext = pathinfo($_FILES["arquivo"]['name'], PATHINFO_EXTENSION);


$total=0;

try{



$sql= "SELECT idskin FROM skin WHERE skin =:skin"; 
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':skin', $nomeskin , PDO::PARAM_STR); 
$stmt->execute();
$obj = $stmt->fetchObject();  
$total = $stmt->rowCount();

		if ($total==0) {
				$sql2 = "INSERT INTO skin (
									
									skin,
									idcarmodel
										) VALUES (
						             :skin,
						             :idcarmodel
						             ) ";                 

						$stmtp = $PDO->prepare($sql2);                                  
						$stmtp->bindParam(':skin', $nomeskin, PDO::PARAM_STR);        
						$stmtp->bindParam(':idcarmodel', $_POST['carmodel'], PDO::PARAM_INT); 
						 

						// Pasta onde o arquivo vai ser salvo
						$_UP['pasta'] = 'uploads/';
						// Tamanho máximo do arquivo (em Bytes)
						$_UP['tamanho'] = 20000000; // 20Mb
						// Array com as extensões permitidas
						$_UP['extensoes'] = array('zip');
						// Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
						$_UP['renomeia'] = true;
						// Array com os tipos de erros de upload do PHP
						$_UP['erros'][0] = 'Não houve erro';
						$_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
						$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
						$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
						$_UP['erros'][4] = 'Não foi feito o upload do arquivo';
						// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
						if ($_FILES['arquivo']['error'] != 0) {
						  die("Não foi possível fazer o upload, erro:" . $_UP['erros'][$_FILES['arquivo']['error']]);
						  exit; // Para a execução do script
						}
						// Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar
						// Faz a verificação da extensão do arquivo					
						$extensao = explode('.', $_FILES['arquivo']['name']);
						$extensao = end($extensao);
						$extensao = strtolower($extensao);


						if (array_search($extensao, $_UP['extensoes']) === false) {						
  						echo "<script>alert('Por favor, envie arquivos com as seguintes extensões: zip.')</script>";   
		            	echo "<script>window.location = 'frminserirskin.php';</script>"; 

						  exit;
						}
						// Faz a verificação do tamanho do arquivo
						if ($_UP['tamanho'] < $_FILES['arquivo']['size']) {
					  
  						echo "<script>alert('O arquivo enviado é muito grande, envie arquivos de até 20Mb.')</script>";   
		            	echo "<script>window.location = 'frminserirskin.php';</script>"; 						  
						  exit;
						}
						// O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
						// Primeiro verifica se deve trocar o nome do arquivo
						if ($_UP['renomeia'] == true) {
						  // Cria um nome baseado no ID do Usuario
						  $nome_final = $nomeskin.'.'.$ext;
						} else {
						  // Mantém o nome original do arquivo
						  $nome_final = $_FILES['arquivo']['name'];
						}
						  
						// Depois verifica se é possível mover o arquivo para a pasta escolhida
						if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'] . $nome_final)) {
						  // Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
	  						echo "<script>alert('Upload efetuado com sucesso!')</script>";   	            	
						} else {
						  // Não foi possível fazer o upload, provavelmente a pasta está incorreta
						echo "<script>alert('Não foi possível enviar o arquivo, tente novamente')</script>";   
		            	echo "<script>window.location = 'frminserirskin.php';</script>"; 
						}

						$stmtp->execute();
						echo "<script>alert('Skin inserida com sucesso')</script>";   
		            	echo "<script>window.location = 'frminserirskin.php';</script>"; 
		} else {
						unlink($diretorio.$nomeskin.'.'.$ext);
						// Pasta onde o arquivo vai ser salvo
						$_UP['pasta'] = 'uploads/';
						// Tamanho máximo do arquivo (em Bytes)
						$_UP['tamanho'] = 20000000; // 20Mb
						// Array com as extensões permitidas
						$_UP['extensoes'] = array('zip');
						// Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
						$_UP['renomeia'] = true;
						// Array com os tipos de erros de upload do PHP
						$_UP['erros'][0] = 'Não houve erro';
						$_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
						$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
						$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
						$_UP['erros'][4] = 'Não foi feito o upload do arquivo';
						// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
						if ($_FILES['arquivo']['error'] != 0) {
						  die("Não foi possível fazer o upload, erro:" . $_UP['erros'][$_FILES['arquivo']['error']]);
						  exit; // Para a execução do script
						}
						// Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar
						// Faz a verificação da extensão do arquivo					
						$extensao = explode('.', $_FILES['arquivo']['name']);
						$extensao = end($extensao);
						$extensao = strtolower($extensao);


						if (array_search($extensao, $_UP['extensoes']) === false) {						
  						echo "<script>alert('Por favor, envie arquivos com as seguintes extensões: zip.')</script>";   
		            	echo "<script>window.location = 'frminserirskin.php';</script>"; 

						  exit;
						}
						// Faz a verificação do tamanho do arquivo
						if ($_UP['tamanho'] < $_FILES['arquivo']['size']) {
					  
  						echo "<script>alert('O arquivo enviado é muito grande, envie arquivos de até 20Mb.')</script>";   
		            	echo "<script>window.location = 'frminserirskin.php';</script>"; 						  
						  exit;
						}
						// O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
						// Primeiro verifica se deve trocar o nome do arquivo
						if ($_UP['renomeia'] == true) {
						  // Cria um nome baseado no ID do Usuario
						  $nome_final = $nomeskin.'.'.$ext;
						} else {
						  // Mantém o nome original do arquivo
						  $nome_final = $_FILES['arquivo']['name'];
						}
						  
						// Depois verifica se é possível mover o arquivo para a pasta escolhida
						if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'] . $nome_final)) {
						  // Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
	  						echo "<script>alert('Upload efetuado com sucesso!')</script>";   	            	
						} else {
						  // Não foi possível fazer o upload, provavelmente a pasta está incorreta
						echo "<script>alert('Não foi possível enviar o arquivo, tente novamente')</script>";   
		            	echo "<script>window.location = 'frminserirskin.php';</script>"; 
						}

						echo "<script>alert('Skin atualizada')</script>";  
						echo "<script>window.location = 'frminserirskin.php';</script>"; 
		}
	}
	catch(PDOException $erro){   
	 echo "<script>alert('Erro na linha: {$erro->getLine()}')</script>";                  			
	}
endif; 	

?>