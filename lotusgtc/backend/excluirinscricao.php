<?php

if (!empty($_POST["piloto"])):   
try{   

$PDO = new PDO("mysql:host=localhost;dbname=gridonline;charset=utf8mb4", "root", ""); 

$sql= "SELECT idpilototorneio FROM pilototorneio WHERE idpiloto = :idpiloto and idtorneio=6"; 
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':idpiloto', $_POST["piloto"] , PDO::PARAM_INT); 
$stmt->execute();
$obj = $stmt->fetchObject();
echo $obj->idpilototorneio;

$sql2 = "DELETE FROM pilototorneio   
            WHERE idpilototorneio =:idpilototorneio";

$stmtp = $PDO->prepare($sql2);
$stmtp->bindParam(':idpilototorneio', $obj->idpilototorneio , PDO::PARAM_INT);   
$stmtp->execute();  



 echo "<script>alert('Registro excluído com sucesso')</script>";  
 echo "<script>window.location = 'pilotos.php';</script>"; 
}catch(PDOException $erro){   
 echo "<script>alert('Erro na linha: {$erro->getLine()}')</script>";   
}   
endif;   

?>