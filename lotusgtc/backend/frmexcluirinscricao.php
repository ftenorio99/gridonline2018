<?php
session_start();
require_once '../../init.php';
require '../../check.php';
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
        background-image: url("../../img/lotus_evora_gtc/lotus_evora_gtcheader.png");
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

<?php    
    include 'menubackend.php';
    include 'menu.php';
?>
  
    <div class="container-fluid"><!-- container -->  
      <div class="row">
        <main>
          <div class="col-lg-4 col-md-4 col-lg-offset-4 col-md-offset-4" id="form-cadastro">
                   
            <form id="form" name="form" action="excluirinscricao.php" method="post" enctype="multipart/form-data">             

                <fieldset>
                    <legend>Exclusão do piloto no torneio</legend>
                    <div>
                      <label> Nome: </label>  
                      <?php

                        if ($_SESSION['user_nivel']=='A') {
                          ?>
                            <select id="piloto" class="form-control" name="piloto" required="required">
                              <?php
                                   $sqlpiloto = "Select  
                                                      piloto.idpiloto  
                                                     ,piloto.name
                                                      from

                                                      piloto
                                                      where
                                                      piloto.idpiloto in (SELECT idpiloto FROM pilototorneio WHERE idtorneio = 6)  ; ";  

                                  $stmt = $PDO->prepare($sqlpiloto);                                   
                                  $stmt->execute(); 
                                  $total = $stmt->rowCount(); 
                                  $resultpiloto = $stmt->fetchAll( PDO::FETCH_ASSOC );                                                                                                                           
                                foreach($resultpiloto as $row)            
                                  {               
                                    ?>
                                      <option value="<?php echo $row["idpiloto"] ?>"> <?php echo $row["name"] ?></option>
                                    <?php
                                  }
                                  ?>
                              ?>
                            </select>  
                            <br>
                            <br>
                            <button type="submit" class="btn btn-primary btn-block" id="enviar">Excluir</button>                              
                          <?php
                        } else {

                        ?>


                        <select id="piloto" class="form-control" name="piloto" required="required">
                        <?php

                              $sqlpiloto = "Select  
                                                  piloto.idpiloto  
                                                 ,piloto.name
                                                  from

                                                  piloto
                                                  where
                                                  piloto.idpiloto =:piloto
                                                  and
                                                  piloto.idpiloto in (SELECT idpiloto FROM pilototorneio WHERE idtorneio = 6)  ; ";  

                              $stmt = $PDO->prepare($sqlpiloto); 
                              $stmt->bindParam(':piloto', $_SESSION['user_id'], PDO::PARAM_STR);
                              $stmt->execute(); 
                              $total = $stmt->rowCount(); 
                              $resultpiloto = $stmt->fetchAll( PDO::FETCH_ASSOC );  
                              if ($total==1) {
                                foreach($resultpiloto as $row)            
                                    {               
                                     ?>
                                     <option value="<?php echo $row["idpiloto"] ?>"> <?php echo $row["name"] ?></option>
                                    <?php
                                    }
                                ?>
                                 </select>
                                 </div>
                                  <br>
                                  <br>
                                  <button type="submit" class="btn btn-primary btn-block" id="enviar">Excluir</button>    
                              </fieldset>
                                          
                          </form>  
                            <?php                                
                              }  else {?>

                              <option value="0>"> Não está inscrito no torneio</option>
                              </select>
                              </div>
                              <br>
                              <br>
                              </fieldset>                  
                              </form>  
                              <?php
                            }                                                                                      

                            ?>
                          
                        <?php
                        }
                        
                      ?>
        </div>
      </div>   
    </div>

       
<br>

<hr>




</body>
</html>

