
<?php
 
  if(!isset($_SESSION)){
      session_start();
      require_once '../init.php';
      require '../check.php';
    }

    $PDO = db_connect(); 
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
     #font{
      color:#000000;
      font-family:Roboto, sans-serif;
      line-height:1.5;
    }
    div.polaroid {
      width: 76%;
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


?>




        <div class="container-fluid bg-3 text-center"> 
          <div><hr></div>   
          <div><h2>Grid Online Lotus Trophy - Pilotos Classificados para próxima etapa - Vagas:<?php echo $slots; ?></h2></div>   
        <div><hr></div>  
        </div> 
  
          <div class="container">
            <div class="row">
              <?php
                $sql = "SELECT  
                               piloto.idpiloto,
                               piloto.name, 
                               qualyresult.bestlap
                                  
                                  FROM qualyresult

                          INNER JOIN pistatorneio on qualyresult.idpistatorneio= pistatorneio.idpistatorneio

                          INNER JOIN piloto on piloto.guid=qualyresult.guid

                          INNER JOIN pista on pista.idpista=pistatorneio.idpista

                          INNER JOIN pilototorneio on pilototorneio.idpiloto=piloto.idpiloto

                          WHERE qualyresult.idpistatorneio=:pista 

                          and pilototorneio.idtorneio=:torneio

                          ORDER by qualyresult.bestlap ASC limit ".$slots."";

                         
                        //alterar o idtorneio para o torneio que quer mostrar na página              
              $select = $PDO->prepare($sql);              
              $select->bindParam(':pista', $pistatorneio, PDO::PARAM_INT);
              $select->bindParam(':torneio', $torneio, PDO::PARAM_INT);
              $select->execute();
              $result = $select->fetchAll( PDO::FETCH_ASSOC );
                 ?>                  
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Classificados</th>

                        </tr>
                      </thead>
                      <tbody>    
                        <?php                                
                                foreach($result as $row)            
                                  {   
                                   ?>
                                   <tr>

                                    <td>                        
                                       <?php echo $row["name"]?> - <?php 
                                                                                $numstring = strval($row['bestlap']);
                                                                                $milesimos= substr($numstring, -3);
                                                                                $segundos= substr($numstring, 0, -3);
                                                                                $tempo=gmdate("i:s", $segundos);
                                                                                echo  $tempo.'.'.$milesimos;?>         
                                    </td>
                                     </tr>
                                  <?php
                                  }
                              ?>
                       
                      </tbody>
                    </table>
                  </div>
      
          </div>  
        </div>

<hr>

</body>
</html>