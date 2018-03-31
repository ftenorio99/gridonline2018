
<?php
 
  if(!isset($_SESSION)){
      session_start();
      require_once '../../init.php';
      require '../../check.php';
    }

    $PDO = db_connect(); 
    $PDO2 = db_connect(); 
    $PDO3 = db_connect(); 

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Grid Online</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
      background-color: white;
    }

    #div-back-image{
        background-image: url("../img/lotus_evora_gtc/lotus_evora_gtcheader.png");
      }

    .affix {
      top: 0;
      width: 100%;
    }

     .affix + .container-fluid {
      padding-top: 70px;
     }
     #testefundo{
      background-color: white;
     }
     #font{
      color:#000000;
      font-family:Roboto, sans-serif;
      line-height:1.5;
    }
    #tabelamodal{
      width: 570px

    }
    div.polaroid {
      width: 72%;
      background-color: white;
      box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
      margin-bottom: 15px;
    }

  </style>
</head>
<body>

<?php        
    include 'menubackend.php';
    include 'menu.php';
?>



        <div class="container-fluid bg-3 text-center"> 
          <hr>
          <div><h2>Grid Online Lotus Trophy - Calendário/Resultados</h2></div>   
          <hr>
        </div> 

        <?php
          $sql =  "SELECT nome,pista,imagemnome,imagemmapa,data,ordempista,idsessionrace,idsessionqualy
                    FROM  pista
                    INNER JOIN  pistatorneio ON  pista.idpista =  pistatorneio.idpista
                    where  pistatorneio.idtorneio=6
                    order by
                    ordempista";

          $select = $PDO->query( $sql );
          $result = $select->fetchAll( PDO::FETCH_ASSOC );
        ?>


      <div class="container-fluid text-center"> 

        <div class="row content">
                <?php foreach($result as $row)            
                { ?>  
                    
                    <div class="col-sm-3">    
                      <br>                                                                                      

                        <img <?php echo "src=../../img/lotus_evora_gtc/tracks/".$row['imagemnome'].".png";?> >
                                                                               
                        <h4 id="font"><?php $date = date_create($row["data"]); echo date_format( $date ,"d/m/Y");?></h4>
                        
                            <button type="button" class="btn btn-default" data-toggle="modal" <?php echo "data-target=#".$row['idsessionqualy'];?> >Qualy</button>
                            <button type="button" class="btn btn-default" data-toggle="modal" <?php echo "data-target=#".$row['idsessionrace'];?> >Race</button>
                        
                    </div>
                              
                                <!-- Modal Race-->
                                <div class="modal" <?php echo "id=".$row['idsessionrace'];?> role="dialog">
                                  <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h2 class="modal-title"><?php echo $row['nome'];?> - Resultados</h2>
                                      </div>
                                      <div class="modal-body">

                                          <table class="table table-striped" id="tabelamodal" >
                                              <thead>
                                                <tr>
                                                  <th width="10%">Posição</th>
                                                  <th width="50%">Nome</th>
                                                  <th width="20%" >Tempo Total</th>
                                                  <th width="20%" >Melhor Volta</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                <?php
                                                    $sql2 = "SELECT idjsonassetorace, drivername, driverguid, carmodel, bestlap, totaltime, posicao, carid FROM jsonassetorace where idsession=:idsessao order by posicao";
                                                      
                                                      $sth2 = $PDO2->prepare($sql2);
                                                      $sth2->bindParam("idsessao", $row['idsessionrace']);
                                                      $sth2->execute(); 
                                                      $result2 = $sth2->fetchAll( PDO::FETCH_ASSOC );
                                                     
                                                    foreach($result2 as $row2)
                                                    {?>
                                                    <tr>                                        
                                                        <td align="center">  <?php echo $row2['posicao'];?></td>
                                                        <td>                 <?php echo $row2['drivername'];?></td>
                                                        <td align="center">  <?php 
                                                                                $numstring = strval($row2['totaltime']);
                                                                                $milesimos= substr($numstring, -3);
                                                                                $segundos= substr($numstring, 0, -3);
                                                                                $tempo=gmdate("H:i:s", $segundos);
                                                                                echo  $tempo.'.'.$milesimos;?></td>


                                                        <td align="center">  <?php 
                                                                                $numstring = strval($row2['bestlap']);
                                                                                $milesimos= substr($numstring, -3);
                                                                                $segundos= substr($numstring, 0, -3);
                                                                                $tempo= gmdate("i:s", $segundos);
                                                                                echo  $tempo.'.'.$milesimos;?></td>
                                                        
                                                    </tr>  
                                                  <?php
                                                    }
                                                  ?>  
                                              </tbody>
                                            </table>                         
                                      </div>
                                      <div class="modal-footer">
                                        <?php
                                        $sql3 = "SELECT simresult FROM pistatorneio WHERE idsessionrace=:idsessao";
                                                      
                                                      $sth3 = $PDO3->prepare($sql3);
                                                      $sth3->bindParam("idsessao", $row['idsessionrace'] );
                                                      $sth3->execute(); 
                                                      $result3 = $sth3->fetchAll( PDO::FETCH_ASSOC );
                                                     
                                                    foreach($result3 as $row3)
                                                        {
                                        ?>
                                        <a <?php echo "href=". $row3['simresult']."" ?> target="_blank" class="btn btn-info" role="button">Detalhes</a>
                                        <?php } ?>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                      </div>
                                    </div>                    
                                  </div>
                                </div>                     

                                <!-- Modal Qualy-->
                                <div class="modal fade" <?php echo "id=".$row['idsessionqualy'];?> role="dialog">
                                  <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h2 class="modal-title"><?php echo $row['nome'];?>  - Qualy</h2>
                                      </div>
                                      <div class="modal-body">

                                          <table class="table table-striped" id="tabelamodal" >
                                              <thead>
                                                <tr>
                                                  <th width="10%">Posição</th>
                                                  <th width="50%">Nome</th>
                                                  <th width="40%" >Melhor Volta</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                <?php
                                                    $i=0;
                                                    $sql3 = "SELECT idjsonassetoqualy, drivername, driverguid, carmodel, bestlap, carid FROM jsonassetoqualy where idsession=:idsessao order by bestlap";

                                                      $sth3 = $PDO3->prepare($sql3);
                                                      $sth3->bindParam("idsessao", $row['idsessionqualy']);
                                                      $sth3->execute(); 
                                                      $result3 = $sth3->fetchAll( PDO::FETCH_ASSOC );
                                                     
                                                    foreach($result3 as $row3)
                                                    {$i++?>
                                                    <tr>                                        
                                                        <td align="center">  <?php echo $i;?></td>
                                                        <td>                 <?php echo $row3['drivername'];?></td>

                                                        <td align="center">  <?php 
                                                                                $numstring = strval($row3['bestlap']);
                                                                                $milesimos= substr($numstring, -3);
                                                                                $segundos= substr($numstring, 0, -3);
                                                                                $tempo= gmdate("i:s", $segundos);
                                                                                echo  $tempo.'.'.$milesimos;?></td>
                                                        
                                                    </tr>  
                                                  <?php
                                                    }
                                                  ?>  
                                              </tbody>
                                            </table>                         
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                      </div>
                                    </div>                    
                                  </div>
                                </div> 
                                <!-- Modal Qualy-->

                <?php }             
                         ?>
  </div>
  <hr>
  <br>
  <br>
  <br>
  <br>


 </div>


  
          

</body>

</html>




