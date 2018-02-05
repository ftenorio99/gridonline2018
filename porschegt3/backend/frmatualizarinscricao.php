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

    document.form.enviar.disabled = false;

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
?>

    <div class="container-fluid"><!-- container -->  
      <div class="row">
        <main>
          <div class="col-lg-4 col-md-4 col-lg-offset-4 col-md-offset-4" id="form-cadastro">                   
            <form id="form" name="form" action="atualizarinscricao.php" method="post" enctype="multipart/form-data">             

                <fieldset>
                    <legend>Inscrição</legend>
      <!-- Se tiver nivel de admin constroi este combo -->
      <?php if ($_SESSION['user_nivel']=='A') { ?>
                    <div>                      
                      <label> Nome </label>
                      <select id="piloto" class="form-control" name="piloto" required="required">
                        <?php
                            $sqlpiloto = "Select  
                                                piloto.idpiloto  
                                               ,piloto.name
                                                from
                                                pilototorneio
                                                INNER JOIN piloto     ON    pilototorneio.idpiloto = piloto.idpiloto 
                                                INNER JOIN torneio    ON    pilototorneio.idtorneio = torneio.idtorneio
                                                where
                                                torneio.idtorneio=3  ; ";
                            $select = $PDO->query( $sqlpiloto );
                            $resultpiloto = $select->fetchAll( PDO::FETCH_ASSOC );

                          foreach($resultpiloto as $row)            
                            {               
                             ?>
                             <option value="<?php echo $row["idpiloto"] ?>"> <?php echo $row["name"] ?></option>
                            <?php
                            }
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
                  <input class="btn btn-primary btn-block" type="submit" id="enviar" disabled="true">

      <?php } ?>

      <?php if ($_SESSION['user_nivel']=='B') {
                      $sqlpiloto = "Select  
                                          piloto.idpiloto  
                                         ,piloto.name
                                          from
                                          piloto
                                          where
                                          piloto.idpiloto =:piloto
                                          and
                                          piloto.idpiloto in (SELECT idpiloto FROM pilototorneio WHERE idtorneio = 3); ";  
                      $stmt = $PDO->prepare($sqlpiloto); 
                      $stmt->bindParam(':piloto', $_SESSION['user_id'], PDO::PARAM_STR);
                      $stmt->execute(); 
                      $total = $stmt->rowCount(); 
                      $resultpiloto = $stmt->fetchAll( PDO::FETCH_ASSOC );

                                if ($total==1) { ?>
                                    <div>
                                      <label> Nome </label>
                                        <select id="piloto" class="form-control" name="piloto" required="required">
                                        <?php                                                       
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
                                  <input class="btn btn-primary btn-block" type="submit" id="enviar" disabled="true">
                                <?php
                                 } 
                                 else 
                                      { ?> 
                                        <label>Piloto não inscrito no Torneio</label> 
                                      <?php } ?>
        <?php 
        }
        ?>

    


      <?php if ($_SESSION['user_nivel']=='I') { ?>   
          <label>Piloto não inscrito no Torneio</label>
      <?php } ?>



              </fieldset>
            </form>  
        </div>
      </div>   
    </div>

       
<br>

<hr>




</body>
</html>

