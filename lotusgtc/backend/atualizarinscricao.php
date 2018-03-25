<?php
require_once 'init.php';
$PDO = db_connect(); 

if (!empty($_POST["piloto"]) && !empty($_POST["team"]) && !empty($_POST["carmodel"]) && !empty($_POST["skin"])):   
try{   



$sql= "SELECT idpilototorneio FROM pilototorneio WHERE idpiloto = :idpiloto and idtorneio=6"; 
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':idpiloto', $_POST["piloto"] , PDO::PARAM_INT); 
$stmt->execute();
$obj = $stmt->fetchObject();  

$sql2 = "UPDATE pilototorneio SET 
            idteam = :idteam, 
            idcarmodel = :idcarmodel, 
            idskin = :idskin  

            WHERE idpilototorneio =:idpilototorneio";

$stmtp = $PDO->prepare($sql2);                                  
$stmtp->bindParam(':idteam', $_POST['team'], PDO::PARAM_STR);       
$stmtp->bindParam(':idcarmodel', $_POST['carmodel'], PDO::PARAM_STR);    
$stmtp->bindParam(':idskin', $_POST['skin'], PDO::PARAM_STR);
 
$stmtp->bindParam(':idpilototorneio', $obj->idpilototorneio , PDO::PARAM_STR);   
$stmtp->execute();   


 echo "<script>alert('Registro atualizado com sucesso')</script>";  
 echo "<script>window.location = 'lotusgtcbackend.php';</script>"; 
}catch(PDOException $erro){   
 echo "<script>alert('Erro na linha: {$erro->getLine()}')</script>";   
}   
endif;   

?>
