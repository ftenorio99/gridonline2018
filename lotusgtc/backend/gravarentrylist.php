<?php
session_start();
require_once '../../init.php';
require '../../check.php';
$PDO = db_connect(); 


try{   

    $myfile = fopen("entry_list.ini", "w") or die("Unable to open file!");

   
    $sql =  "Select  
                               piloto.name as piloto
                              ,piloto.guid
                              ,team.name as team
                              ,carmodel.carmodel
                              ,skin.skin

                              from

                              pilototorneio

                              INNER JOIN piloto     ON    pilototorneio.idpiloto = piloto.idpiloto 
                              INNER JOIN team     ON    pilototorneio.idteam = team.idteam
                              INNER JOIN carmodel   ON    pilototorneio.idcarmodel = carmodel.idcarmodel
                              INNER JOIN skin     ON    pilototorneio.idskin = skin.idskin 
                              INNER JOIN torneio    ON    pilototorneio.idtorneio = torneio.idtorneio
                              where
                              torneio.idtorneio=6 ";

                  $select = $PDO->query( $sql );
                  $result = $select->fetchAll( PDO::FETCH_ASSOC );
                  $i=0;
     foreach($result as $row)
      {
                    
$txt ="[CAR_".$i."]
MODEL=".$row["carmodel"]."
SKIN=".$row["skin"]."
SPECTATOR_MODE=0
DRIVERNAME=".$row["piloto"]."
TEAM=".$row["team"]."
GUID=".$row["guid"]."
BALLAST=0
RESTRICTOR=0
"."\n";
        fwrite($myfile, $txt);
        $i++;
      }

    fclose($myfile);


    //Destino do Servidor de Teste
    //$destino = 'C:/Program Files (x86)/Steam/steamapps/common/assettocorsa/server/cfg/entry_list.ini';
    //Destino do servidor de Producao
    $destino = 'C:/Gridonline/acPackage/server2/cfg/entry_list.ini';
    $destino2 = 'C:/Gridonline/acPackage/server2/cfg/entry_list.ini';

    unlink($destino);
    unlink($destino2);

    $origem = 'entry_list.ini';

    copy($origem, $destino);
    copy($origem, $destino2);

    unlink($origem);



     echo "<script>alert('Entry List gerado com sucesso nos servidores')</script>";   
     echo "<script>window.location = 'lotusgtcbackend.php';</script>";
    }catch(PDOException $erro){   
    echo "<script>alert('Entry List não foi gerado')</script>"; 
    echo "<script>alert('Erro na linha: {$erro->getLine()}')</script>";   
    }   

?>



                        