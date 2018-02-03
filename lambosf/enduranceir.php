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
    
    /* Add a gray background color and some padding to the footer */
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
    #p1 {
        background-color:yellow;
        vertical-align:middle;
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
              <a class="navbar-brand" href="enduranceac.php"> <img src="../img/enduranceac/racelan.png" width="60" height="30" alt=""/> </a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
              <ul class="nav navbar-nav">
                <li><a href="../index.php">Início</a></li>
<!--                 <li><a href="numeracaooficial.html">Numeração Oficial</a></li>
  -->                <li><a href="../campeonato.html">Campeonato</a></li> 
 -->                 <li><a href="../livetiming.html">Livetiming</a></li>              
<!--                 <li><a href="bancosetup.html">Banco de Setups</a></li>                 
 -->              </ul>
              <ul class="nav navbar-nav navbar-right" >
                <li><a href="../login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
              </ul>
            </div>
          </div>
        </nav>
        <nav class="navbar navbar-inverse" data-offset-top="197">
          <ul class="nav navbar-nav">    
            <li><a href="enduranceac.php">Race Report</a></li>        
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
                <br>
                <br>
            </div>
          </div>
        </div>

        <div class="container-fluid bg-3 text-center"> 
          <div><hr></div>   
          <div><h2>Racelan GT2/GTE Series - Race Report</h2></div>   
        <div><hr></div>  
        </div> 

        <div class="container">
          <div class="row" >
              <?php
                $sql =  "SELECT * FROM  post where idtorneio=4 order by datapost DESC";

              $select = $PDO->query( $sql );
              $result = $select->fetchAll( PDO::FETCH_ASSOC );

              foreach($result as $row)            
                {               
                 ?>
                <div class="col-md-6"><br>
                    <div class="panel panel-default">   
                      <div class="panel-body">
                        <h2><?php echo $row["titulopost"]?></h2>
                                <h5><?php $date = date_create($row["datapost"]);
                                echo date_format( $date ,"d/m/Y");?></h5>
                                <p id="div1" >
                                <?php echo $row["descpost"]?>
                                </p>                     
                            <hr>                            
                                <img src=<?php echo"../img/racereport/".$row["idsession"]."/capa.png"?> height="300" width="525">
                            <hr>        
                                <div class="row">
                                  <div class="col-sm-1">
                                    <a><img src="../img/iconfacebook.png" height="40" width="40"></a>  
                                  </div >
                                  <div class="col-sm-1"> 
                                    <a><img src="../img/icontwiter.png" height="40" width="40"></a>  
                                  </div>
                                  <div class="col-sm-1">
                                    <a><img src="../img/icongoogle.png" height="40" width="40"></a>  
                                  </div>
                                  <div class="col-sm-9" align="right">
                                    <a><p>Leia mais...</p></a>  
                                  </div>                                                                                                              
                                </div>
                                  
                      </div>
                    </div>  
                </div> 
                <?php
                }
                ?> 
            </div>
        </div>
<br>

<hr>
</body>
</html>
