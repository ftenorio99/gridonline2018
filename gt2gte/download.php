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
        background-image: url("../img/gt2gte/gt2gteheader.png");
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

        <nav class="navbar navbar-inverse" >
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
              </button>
              <a class="navbar-brand" href="supertrofeo.php"> <img src="../img/gt2gte/racelan.png" width="60" height="30" alt=""/> </a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
              <ul class="nav navbar-nav">
                <li><a href="../index.php">Início</a></li>
  <!--               <li><a href="numeracaooficial.html">Numeração Oficial</a></li> -->
                <li><a href="livetiming.html">Livetiming</a></li>            
 <!--                <li><a href="bancosetup.html">Banco de Setups</a></li>   -->               
              </ul>
              <ul class="nav navbar-nav navbar-right" >
                <li><a href="../login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
              </ul>
            </div>
          </div>
        </nav>
         <nav class="navbar navbar-inverse" data-offset-top="197">
          <ul class="nav navbar-nav">     
            <li><a href="gt2gte.php">Race Report</a></li>       
            <li><a href="pilotos.php">Pilotos</a></li>
            <li><a href="classificacao.php">Classificação</a></li>
            <li><a href="gt2gteresultados.php">Calendário/Resutados</a></li>
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
          <hr>
          <div><h2>Racelan GT2/GTE Series - Downloads</h2></div>   
          <hr>
        </div> 
  
        <div class="container">
                  <div class="row" >
                    <h3>Racelan GT2/GTE Series - Pistas</h3>
                    <h4>
                      <a href="http://www.racedepartment.com/downloads/paul-ricard.6115/">RaceLan GTE/GT2 Series - Paul Ricard</a>
                    </h4>            
                    <hr>
                    <h3>Racelan GT2/GTE Series - Skinpack</h3>
                  </div>
        </div>       

</body>

</html>