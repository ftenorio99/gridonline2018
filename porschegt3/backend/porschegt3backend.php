<?php
 
  if(!isset($_SESSION)){
      session_start();
      require_once '../../init.php';
      require '../../check.php';
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
    
    /* Add a gray background color and some padding to the footer */
    #div-back-image{
        background-image: url("../../img/porschegt3/porschegt3header.png");
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
    #p1 {
        background-color:yellow;
        vertical-align:middle;
    }
    

  </style>
</head>
<body>

<?php    
    include 'menubackend.php';
?>

<br>
        <div class="container-fluid bg-3 text-center"> 
          <div><hr></div>   
          <div><h2>GridOnline Bitdefender Porsche SuperCup - Pilotos</h2></div>   
        <div><hr></div>  
        </div> 
  

        <div class="container-fluid" align="center">
          <div class="container-fluid">
              <?php
                $sql =  "Select  
                               piloto.name as piloto
                              ,piloto.guid
                              ,piloto.numero
                              ,team.name as team
                              ,carmodel.carmodel
                              ,skin.skin
                              ,torneio.nome 
                              ,torneio.categoria

                          from

                          pilototorneio

                          INNER JOIN piloto     ON    pilototorneio.idpiloto = piloto.idpiloto 
                          INNER JOIN team     ON    pilototorneio.idteam = team.idteam
                          INNER JOIN carmodel   ON    pilototorneio.idcarmodel = carmodel.idcarmodel
                          INNER JOIN skin     ON    pilototorneio.idskin = skin.idskin 
                          INNER JOIN torneio    ON    pilototorneio.idtorneio = torneio.idtorneio
                          where
                          torneio.idtorneio=3                        ";
                        //alterar o idtorneio para o torneio que quer mostrar na página
              $select = $PDO->query( $sql );
              $result = $select->fetchAll( PDO::FETCH_ASSOC );

              foreach($result as $row)            
                {               
                 ?>
                <div class="col-md-4" id="font">
                  <div>   
                      <img src=<?php echo "../../img/porschegt3/skin/".$row["skin"]."/preview.jpg"?> class="img-thumbnail" >                      
                  </div>    
                  <div>
                    #<?php echo $row["numero"] ?> - <?php echo $row["piloto"] ?> - <?php echo $row["team"] ?>                  
                    <br>
                    <br>
                    <br>
                    <br>
                  </div>
                </div>

                <?php
                }
                ?>
          </div>  
        </div> 
<hr>
</body>
</html>
