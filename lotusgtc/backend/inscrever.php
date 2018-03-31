<?php

$PDO = new PDO("mysql:host=localhost;dbname=gridonline;charset=utf8mb4", "root", ""); 


	 $stmt = $PDO->prepare('SELECT idskin,skin FROM skin WHERE idcarmodel=:idcarmodel AND idpiloto=:idpiloto'); 
	 $stmt->bindParam(':idpiloto', $_POST['piloto'], PDO::PARAM_INT);
	 $stmt->bindParam(':idcarmodel', $_POST['carmodel'], PDO::PARAM_INT);
	 $stmt->execute(); 	
	 $total = $stmt->rowCount(); 
	 $resultskinpiloto = $stmt->fetchAll( PDO::FETCH_ASSOC );  

					

	    if ($total==1) {

	    	    foreach($resultskinpiloto as $res){
       				 echo '<option value="'.$res['idskin'].'">'.$res['skin'].'</option>';
   				 }
	      
	    } else {

	    	   	$sth = $PDO->prepare('SELECT * FROM skin where skin not in (SELECT name FROM piloto) and idcarmodel=:id');
			    $sth->bindValue(':id', $_POST['carmodel'], PDO::PARAM_INT);
			    $sth->execute();
			    $resultado = $sth->fetchAll(PDO::FETCH_ASSOC);			    
			    foreach($resultado as $res){
       				 echo '<option value="'.$res['idskin'].'">'.$res['skin'].'</option>';
   				 }
	    }                                                

?>


