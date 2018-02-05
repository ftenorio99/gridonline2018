<?php
session_start();
require_once '../../init.php';
require '../../check.php';
$PDO = db_connect(); 

function clearBrowserCache() {
    header("Pragma: no-cache");
    header("Cache: no-cache");
    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
}

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

    document.getElementById("imgskin").src = "../../img/porschegt3/skin/"+selskin+"/preview.jpg";
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

  </style>
</head>
<body>

<?php    
    include 'menubackend.php';
    clearBrowserCache();
?>
 
    <div class="container-fluid"><!-- container -->  
      <div class="row">
        <main>
          <div class="col-lg-4 col-md-4 col-lg-offset-4 col-md-offset-4" id="form-cadastro">
            <legend>Inscrição no Torneio Porsche GT3 Supercup</legend>

                        <?php

                              $sqlpiloto = "Select  
                                                  piloto.idpiloto  
                                                 ,piloto.name
                                                  from

                                                  piloto
                                                  where
                                                  piloto.idpiloto =:piloto
                                                  and
                                                  piloto.idpiloto not in (SELECT idpiloto FROM pilototorneio WHERE idtorneio = 3)  ; ";  

                              $stmt = $PDO->prepare($sqlpiloto); 
                              $stmt->bindParam(':piloto', $_SESSION['user_id'], PDO::PARAM_STR);
                              $stmt->execute(); 
                              $total = $stmt->rowCount(); 
                              $resultpiloto = $stmt->fetchAll( PDO::FETCH_ASSOC );                                                                                          
                        ?>

                        
                        <?php
                          if ($total==0) {
                            ?>
                              <input type="text" class="form-control" id="name" name="name" disabled="true" value="Piloto já inscrito">
                            <?php
                          } else {
                            foreach($resultpiloto as $row){
                            ?>

                             <form id="form" action="inscrevertorneio.php" method="post" enctype="multipart/form-data">             
                                  <fieldset>                                      
                                      <div>                                        
                                        <div>
                                            <label>Nome:</label>                                                                                        
                                        </div>                     
                                               
                                              <input type="text" class="form-control" id="name" name="name" disabled="true" value="<?php echo $row["name"]?>">
                                              <br>
                                              <div class="form-group">
                                                <br>
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
                                                    <select id="carmodel" class="form-control" name="carmodel" >
                                                            <option id="carmodel" value="0">Escolha o Carro</option>
                                                            <!-- Aqui você preenche a combo com as cidades existentes na sua base-->
                                                            <?php
                                                              $sql = "SELECT * FROM  carmodel where idcarmodel=16;";
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
                                          <button type="submit" class="btn btn-primary btn-block">Salvar</button>
                                      </form>                              

                            <?php
                          }
                         } 
                        ?>
                        
                    </div>




  



        </div>
      </div>   
    </div>

       
<br>

<hr>

</body>
</html>

