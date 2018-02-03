
<?php

//$PDO = new PDO("mysql:host=mysql.hostinger.com.br;dbname=u240322781_teste;charset=utf8mb4", "u240322781_root", "chemical99"); 
$PDO = new PDO("mysql:host=localhost;dbname=gridonline;charset=utf8mb4", "root", ""); 



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
        background-image: url("../img/enduranceac/enduranceacheader.png");
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

        <nav class="navbar navbar-inverse" >
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
              </button>
              <a class="navbar-brand" href="supertrofeo.php"> <img src="../img/enduranceac/endurancelogo.png" width="100" height="30" alt=""/> </a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
              <ul class="nav navbar-nav">
                <li><a href="../index.php">Início</a></li>
<!--                 <li><a href="numeracaooficial.html">Numeração Oficial</a></li> -->
                <li><a href="../livetiming.html">Livetiming</a></li>             
<!--                 <li><a href="bancosetup.html">Banco de Setups</a></li>                 
 -->              </ul>
              <ul class="nav navbar-nav navbar-right" >
                <li><a href="../login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
              </ul>
            </div>
          </div>
        </nav>
         <nav class="navbar navbar-inverse" data-spy="affix" data-offset-top="197">
          <ul class="nav navbar-nav">     
            <li><a href="enduranceac.php">Race Report</a></li> 
            <li><a href="classes.php">Classes</a></li>       
            <li><a href="pilotos.php">Pilotos</a></li>
            <li><a href="classificacao.php">Classificação</a></li>
            <li><a href="enduranceacresultados.php">Calendário/Resutados</a></li>
            <li><a href="download.php">Downloads</a></li>
<!--             <li><a href="#">Regulamento</a></li>
            <li><a href="frminscricao.php">Inscrição</a></li>
            <li><a href="#">Contato</a></li> -->
          </ul>
        </nav>

        <div class="jumbotron" id="div-back-image">
          <div class="container text-center">
            <div align="center">
                <img src="../img/grid online logo principal.png" class="img-responsive" width="150" height="300" alt="Image" >
                <br>
            </div>
          </div>
        </div>

        <div class="container-fluid bg-3 text-center"> 
          <div><hr></div>   
          <div><h2>GridOnline Endurance Series - Pilotos</h2></div>   
        <div><hr></div>  
        </div> 
  

        <div class="container-fluid" align="center">
          <div class="row" >
              <?php
                $sql =  "Select  
                               piloto.name as piloto
                              ,piloto.guid
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
                          torneio.idtorneio=4                        ";
                        //alterar o idtorneio para o torneio que quer mostrar na página
              $select = $PDO->query( $sql );
              $result = $select->fetchAll( PDO::FETCH_ASSOC );

              foreach($result as $row)            
                {               
                 ?>
                <div class="col-lg-2 col-md-2 col-sm-2 " id="font">
                   <div class="polaroid">   
                      <img src=<?php echo "../img/enduranceac/skin/".$row["skin"]."/preview.jpg"?> class="img-responsive" >
                   </div>
                   <?php echo $row["piloto"] ?> <p> <?php echo $row["team"] ?>                  
                </div>
                <?php
                }
                ?>
          </div>  
        </div> 
<hr>

</body>
</html>