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


<script type="text/javascript">

      $(document).ready(function(){         
        $("select[name=carmodel]").change(function(){
            $("select[name=skin]").html('<option value="0">Carregando...</option>');
              $.post("inscrever.php",
                    {carmodel:$(this).val()},
                      function(valor){
                      $("select[name=skin]").html(valor);
                    }
          );
          });
      });
     function skinselec() {

    var skinList = document.getElementById("skin");
    var selskin = skinList.options[skinList.selectedIndex].text;

    document.getElementById("imgskin").src = "../img/gt2gte/skin/"+selskin+"/preview.jpg";
    }       
</script>


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
     #font{
      color:#000000;
      font-family:Roboto, sans-serif;
      line-height:1.5;
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
                <li><a href="numeracaooficial.html">Numeração Oficial</a></li>
                <li><a href="livetiming.html">Livetiming</a></li>              
                <li><a href="bancosetup.html">Banco de Setups</a></li>                 
              </ul>
              <ul class="nav navbar-nav navbar-right" >
                <li><a href="../login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
              </ul>
            </div>
          </div>
        </nav>
         <nav class="navbar navbar-inverse" data-spy="affix" data-offset-top="197">
          <ul class="nav navbar-nav">            
            <li><a href="pilotos.php">Pilotos</a></li>
            <li><a href="classificacao.php">Classificação</a></li>
            <li><a href="gt2gteresultados.php">Calendário/Resutados</a></li>
            <li><a href="download.php">Downloads</a></li>
            <li><a href="#">Regulamento</a></li>
            <li><a href="frminscricao.php">Inscrição</a></li>
            <li><a href="#">Contato</a></li>
          </ul>
        </nav>

        <div class="jumbotron" id="div-back-image">
          <div class="container text-center">
            <div align="center">
                <img src="../img/grid online logo principal.png" class="img-responsive" width="150" height="300" alt="Image" >
                <br>
                <br>
            </div>
          </div>
        </div>
  
    <div class="container-fluid"><!-- container -->  
      <div class="row">
        <main>
          <div class="col-lg-4 col-md-4 col-lg-offset-4 col-md-offset-4" id="form-cadastro">
                   
              <form id="form" action="frminscricao.php" method="post" enctype="multipart/form-data">             

                <fieldset>
                    <legend>Racelan GT2/GTE Series - Inscrição</legend>
                    <div>
                      <label> Nome </label>
                    </div>


                    <div class="form-group">
                        <label for="team">Equipe</label>

                        <select id="team" class="form-control" name="team" required="required">
                        <?php
                            $sqlteam = "SELECT * FROM  team; ";
                            $select = $PDO->query( $sqlteam );
                            $resultteam = $select->fetchAll( PDO::FETCH_ASSOC );

                          foreach($resultteam as $row)            
                            {               
                             ?>
                             <option value="<?php echo $row["idteam"] ?>"> <?php echo $row["name"] ?></option>
                            <?php
                            }
                            ?>
                        ?>
                        </select>                               
                    </div>

                    <div class="form-group">
                        <label for="carmodel">Carro</label>
                          <select  class="form-control" name="carmodel" >
                                  <option id="carmodel" value="-1">Escolha o Carro</option>
                                  <!-- Aqui você preenche a combo com as cidades existentes na sua base-->
                                  <?php
                               $sql = "SELECT * FROM  carmodel;";
                                   try{
                                          $query = $PDO->query($sql);
                                    $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
                            }catch(PDOException $erro){
                                echo 'Erro '.$erro->getMessage(); 
                             }
                                         foreach($resultado as $result){
                          ?>
                                  <option value="<?php echo $result['idcarmodel']; ?>"><?php echo $result['desccarmodel']; ?></option>
                                  <?php 
                          }
                          ?>
                          </select>                              
                    </div>    

                    <div class="form-group">
                        <label for="skin">Skin</label>
                          <select id="skin" class="form-control" name="skin">
                               <option value="0" disabled="disabled">Escolha o skin</option>
                          </select>                              
                    </div> 
                    <div align="center">
                      <button type="button" class="btn btn-default" onclick="skinselec()">Visualizar Skin</button>                        
                    </div>
                    <br>
                    <br>
                    
                    <div class="polaroid">   
                      <img id="imgskin"  class="img-responsive" >
                    </div>

                    <br>
                    <br>
                </fieldset>
                <input class="btn btn-primary btn-block" type="submit">
            </form>  

        </div>
      </div>   
    </div>

       
<br>

<hr>




</body>
</html>

