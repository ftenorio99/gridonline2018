<?php

//$PDO = new PDO("mysql:host=mysql.hostinger.com.br;dbname=u240322781_teste;charset=utf8mb4", "u240322781_root", "chemical99"); 
$PDO = new PDO("mysql:host=localhost;dbname=gridonline;charset=utf8mb4", "root", ""); 


$sql= "SELECT idpiloto FROM pilototorneio WHERE idtorneio=3 and idpiloto=:piloto";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':piloto', $_POST['piloto'], PDO::PARAM_STR);
$stmt->execute();
$total = $stmt->rowCount();

if ($total<1) {

		if (!empty($_POST["piloto"]) && !empty($_POST["team"]) && !empty($_POST["carmodel"]) && !empty($_POST["skin"])):   
		try{   

		$PDO = new PDO("mysql:host=localhost;dbname=gridonline;charset=utf8mb4", "root", ""); 
		 
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
		$stmtp->bindParam(':idpiloto', $_POST['piloto'], PDO::PARAM_STR);   

		$stmtp->execute();   


		 echo "<script>alert('Registro inserido com sucesso')</script>";   
		 echo "<script>window.location = 'porschegt3backend.php';</script>";
		}catch(PDOException $erro){   
		 echo "<script>alert('Erro na linha: {$erro->getLine()}')</script>";   
		}   
		endif;  

} else {
	echo "<script>alert('Piloto já inserido neste campeonato')</script>"; 
	echo "<script>window.location = 'porschegt3backend.php';</script>";
}


?>
