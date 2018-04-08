<?php
//session_start();
require_once '../../init.php';
//require '../../check.php';
$PDO = db_connect(); 


try{   

    $myfile = fopen("entry_list.ini", "w") or die("Unable to open file!");

    $sqlslots =  "SELECT pista.slots, pistatorneio.idpista, pistatorneio.idtorneio, pistatorneio.idpistatorneio 
                  FROM pistatorneio
                  INNER JOIN pista on pista.idpista=pistatorneio.idpista
                  WHERE pistatorneio.data>CURRENT_DATE 
                  ORDER BY pistatorneio.data asc LIMIT 1";

                  $selectslots = $PDO->query( $sqlslots );
                  $resultslots = $selectslots->fetchAll( PDO::FETCH_ASSOC );
                  foreach($resultslots as $row)
                    {
                      $slots = $row['slots'];
                      $torneio = $row['idtorneio'];
                      $pistatorneio = $row['idpistatorneio'];
                    }
                     
   
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
                              torneio.idtorneio=6 order by pilototorneio.idpilototorneio";

                  $select = $PDO->query( $sql );
                  $result = $select->fetchAll( PDO::FETCH_ASSOC );
                  $i=0;
     foreach($result as $row)
      {     

        if ($i<$slots) {                 
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
        }

    fclose($myfile);


    //Destino do Servidor de Teste
   //$destino = 'C:/Program Files (x86)/Steam/steamapps/common/assettocorsa/server/cfg/entry_list.ini';
    //Destino do servidor de Producao
    $destino = 'C:/Gridonline/acPackage/server2/cfg/entry_list.ini';
    $destino2 = 'C:/Gridonline/acPackage/server/cfg/entry_list.ini';

    unlink($destino);
    unlink($destino2);

    $origem = 'entry_list.ini';

    copy($origem, $destino);
    copy($origem, $destino2);

    unlink($origem);



     echo "<script>alert('Entry List gerado com sucesso nos servidores')</script>";   
     echo "<script>window.location = 'pilotos.php';</script>";
    }catch(PDOException $erro){   
    echo "<script>alert('Entry List não foi gerado')</script>"; 
    echo "<script>alert('Erro na linha: {$erro->getLine()}')</script>";   
    }   

?>


<!-- Novo select para formato de qualificação para entrada no campeonato
         SELECT piloto.guid,
            piloto.name,             
               ,team.name as team
                 ,carmodel.carmodel
                 ,skin.skin
                                          
                    
                              

                              FROM qualyresult

                      

                          INNER JOIN piloto on piloto.guid=qualyresult.guid                        
                          
                          INNER JOIN pilototorneio on pilototorneio.idpiloto=piloto.idpiloto
                          
                          INNER JOIN team on team.idteam=pilototorneio.idteam
                          
                          INNER JOIN carmodel on carmodel.idcarmodel=pilototorneio.idcarmodel
                          
                          INNER JOIN skin on skin.idskin=pilototorneio.idskin

                          WHERE qualyresult.idpistatorneio=16 and pilototorneio.idtorneio=6

                          ORDER by qualyresult.bestlap ASC limit 10 -->