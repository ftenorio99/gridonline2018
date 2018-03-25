<?php

//$PDO = new PDO("mysql:host=mysql.hostinger.com.br;dbname=u240322781_teste;charset=utf8mb4", "u240322781_root", "chemical99"); 
$PDO = new PDO("mysql:host=localhost;dbname=gridonline;charset=utf8mb4", "root", ""); 

    $sth = $PDO->prepare('SELECT * FROM  skin where idcarmodel = :id ');
    $sth->bindValue(':id', $_POST['carmodel'], PDO::PARAM_INT);
    $sth->execute();
    $resultado = $sth->fetchAll(PDO::FETCH_ASSOC);

    foreach($resultado as $res){
        echo '<option value="'.$res['idskin'].'">'.$res['skin'].'</option>';
    }//fim foreach 
?>


