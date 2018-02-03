<?php
require_once 'init.php';


function gerarSenha($tamanho=6, $forca=4) {
	$vogais = 'aeuy';
	$consoantes = 'bdghjmnpqrstvz';
	if ($forca >= 1) {
		$consoantes .= 'BDGHJLMNPQRSTVWXZ';
	}
	if ($forca >= 2) {
		$vogais .= "AEUY";
	}
	if ($forca >= 4) {
		$consoantes .= '23456789';
	}
	if ($forca >= 8 ) {
		$vogais .= '@#$%';
	}

	$senha = '';
	$alt = time() % 2;
	for ($i = 0; $i < $tamanho; $i++) {
		if ($alt == 1) {
			$senha .= $consoantes[(rand() % strlen($consoantes))];
			$alt = 0;
		} else {
			$senha .= $vogais[(rand() % strlen($vogais))];
			$alt = 1;
		}
	}
	return $senha;
}

$senha = gerarSenha(10,8);

$PDO = db_connect(); 

if (!empty($_POST["guid"]) && !empty($_POST["nome"]) && !empty($_POST["email"]) && !empty($_POST["celular"]) )
	{  



		$sql= "SELECT * FROM piloto WHERE guid = :guid";
		$stmt = $PDO->prepare($sql);
		$stmt->bindParam(':guid', $_POST['guid'] , PDO::PARAM_STR); 
		$stmt->execute();
		


			if($stmt->rowCount()==1){		

				$status = "B";
				$sql2 = "UPDATE piloto SET                       
					            email = :email,  
					            telefone = :telefone,
					            senha =:senha,
					            status =:status 					            
					            WHERE guid= :guid";          


					$stmtp = $PDO->prepare($sql2);                                  			       
					$stmtp->bindParam(':guid', $_POST['guid'], PDO::PARAM_STR); 			
					$stmtp->bindParam(':email', $_POST['email'], PDO::PARAM_STR);			
					$stmtp->bindParam(':telefone', $_POST['celular'] , PDO::PARAM_STR); 					
					$stmtp->bindParam(':senha', $senha , PDO::PARAM_STR); 					
					$stmtp->bindParam(':status', $status , PDO::PARAM_STR);
					$stmtp->execute();  

					//enviar um email para o usuario cadastrado
					$mensage ="Você efetuou o Cadastro na GridOnline, este foi seu e-mail cadastrado e esta é sua senha de acesso.";
					$mensage .="E-mail= " . $_POST['email'];
					$mensage .="Senha:" . $senha;
					mail($rowemail, "Grid Online, Senha de Acesso", $mensage);

					echo "<script>alert('Cadastro inserido com sucesso, sua senha foi enviada para o e-mail cadastrado')</script>";   
			    	echo "<script>window.location = 'index.php';</script>"; 

				
			} else {
				
					$status="I";
					$sql2 = "INSERT INTO piloto (
					name
					,email
					,guid					
					,telefone
					,status
					) VALUES (
					:name,
					:email,
					:guid,				
					:telefone ,
					:status ,
					:senha
		            ) ";          


					$stmtp = $PDO->prepare($sql2);                                  			       
					$stmtp->bindParam(':name', $_POST['nome'], PDO::PARAM_STR);
					$stmtp->bindParam(':email', $_POST['email'], PDO::PARAM_STR);			
					$stmtp->bindParam(':guid', $_POST['guid'], PDO::PARAM_STR);
					$stmtp->bindParam(':telefone', $_POST['celular'] , PDO::PARAM_STR); 
					$stmtp->bindParam(':status', $status , PDO::PARAM_STR);
					$stmtp->bindParam(':senha', $senha , PDO::PARAM_STR);  
					$stmtp->execute();  

					//enviar um email para o usuario cadastrado
					$mensage ="Você efetuou o Cadastro na GridOnline, este foi seu e-mail cadastrado e esta é sua senha de acesso.";
					$mensage .="E-mail= " . $_POST['email'];
					$mensage .="Senha:" . $senha;
					mail($rowemail, "Grid Online, Senha de Acesso", $mensage);


				echo "<script>alert('Cadastro inserido com sucesso, efetue o pagamento para efetivar sua participação')</script>";   
		    	echo "<script>window.location = 'index.php';</script>"; 


			}

	} else {
			echo "<script>alert('Todos os campos são obrigatórios')</script>";   
		    echo "<script>window.location = 'frminscricao.php';</script>"; 
	}

?>