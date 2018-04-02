<?php
session_start();
require_once 'init.php';
require 'check.php';

$PDO = db_connect(); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Grid Online</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="http://web.crea.acsta.net/rep_dif/Smart/Warner/BatmanVsSuperman/Arrobas-250/Contagem/dest/jquery.countdown.js"></script>
 
<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});
</script>


  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
      background-color: white;

    }
   
    #div-back-image{
        background-image: url("img/fundoheader.png");
      }
   
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 100px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }

  </style>
</head>

  <body>

<?php    
    include 'menu.php';
?>

      <div class="container-fluid text-center">  
<!--         <?php    
            include 'menucampeonatos.php';
        ?> -->
        <hr>        

        <hr>
        <div class="col-sm-12 text-left">            
            <div class="col-lg-4 col-md-4 col-lg-offset-4 col-md-offset-4">
              <legend>Enviar e-mail para participantes do campeonato</legend> 
                  <form id="form" action="enviaremail.php" method="post"  enctype="multipart/form-data">                                  
                    
                      <fieldset>                   
                          <div class="form-group">
                            <label for="selCampeonato">Campeonato:</label>                            
                            <select  id="torneio" class="form-control" name="torneio" >
                              <?php
                              $sql3 = "SELECT * FROM torneio";                                                     
                                            $sth3 = $PDO->prepare($sql3);                                                      
                                            $sth3->execute(); 
                                            $result3 = $sth3->fetchAll( PDO::FETCH_ASSOC );
                                           
                                          foreach($result3 as $row3)
                                              {
                                                ?>                                                          
                                                <?php 
                                                echo "<option value=".$row3['idtorneio']." >".$row3['nome']."</option>" 
                                                ?> 
                              <?php 
                            } 
                            ?>
                            </select>
                          </div> 
                          <div class="form-group">
                            <label for="comment">Email:</label>
                            <textarea class="form-control" rows="5" id="mensagem" name="mensagem"></textarea>
                          </div>
                          <div class="form-group">
                            <label for="comment">Título:</label>
                            <textarea class="form-control" rows="5" id="titulo" name="titulo"></textarea>
                          </div>                    

                        <button type="submit" class="btn btn-primary btn-block" value="enviar" name="botao" >Enviar</button>
                      </fieldset>                               
                  </form>
            </div>
          
        </div>



  </body>
</html>
