<?php
session_start();
require_once '../../init.php';
require '../../check.php';
$PDO = db_connect(); 

 function update($categoria, $titulo, $autor, $id){   
   if (!empty($categoria) && !empty($titulo) && !empty($autor) && !empty($id)):   
    try{   
    
    $PDO = new PDO("mysql:host=localhost;dbname=gridonline;charset=utf8mb4", "root", ""); 

    $sql= "SELECT idpilototorneio FROM pilototorneio WHERE idpiloto = :idpiloto and idtorneio=6"; 
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':idpiloto', $idpiloto, PDO::PARAM_INT); 
    $stmt->execute();
    $obj = $stmt->fetchObject();  
    
    $sql2 = "UPDATE pilototorneio SET 
                idteam = :$idteam, 
                idcarmodel = :$idcarmodel, 
                idskin = :$idskin,  
                idtorneio = :$idtorneio,  
                idpiloto = :$idpiloto  
                WHERE idpilototorneio = :$obj->idpilototorneio";

    $stmt = $PDO->prepare($sql);                                  
    $stmt->bindParam(':idteam', $_POST['filmName'], PDO::PARAM_STR);       
    $stmt->bindParam(':idcarmodel', $_POST['$filmDescription'], PDO::PARAM_STR);    
    $stmt->bindParam(':idskin', $_POST['filmImage'], PDO::PARAM_STR);
    // use PARAM_STR although a number  
    $stmt->bindParam(':idtorneio', $_POST['filmPrice'], PDO::PARAM_STR); 
    $stmt->bindParam(':idpiloto', $_POST['piloto'], PDO::PARAM_STR);   
    
    $stmt->execute();   
     echo "<script>alert('Registro atualizado com sucesso')</script>";   
    }catch(PDOException $erro){   
     echo "<script>alert('Erro na linha: {$erro->getLine()}')</script>";   
    }   
   endif;   
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

    document.getElementById("imgskin").src = "../../img/lotus_evora_gtc/skin/"+selskin+"/preview.jpg";
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
?>
 
    <div class="container-fluid"><!-- container -->  
      <div class="row">
        <main>
          <div class="col-lg-4 col-md-4 col-lg-offset-4 col-md-offset-4" id="form-cadastro">
                   
            <form id="form" action="inseririnscricao.php" method="post" enctype="multipart/form-data">             

                <fieldset>
                    <legend>Inscrição no Torneio Lotus GTC</legend>
                    <div>
                      <label> Nome </label>
                      <select id="piloto" class="form-control" name="piloto" required="required">
                        <?php
                            $sqlpiloto = "Select  
                                                piloto.idpiloto  
                                               ,piloto.name
                                               
                                                from

                                                piloto
                          

                          where
                          piloto.idpiloto not in (SELECT idpiloto FROM pilototorneio WHERE idtorneio = 6) ";

                            $select = $PDO->query( $sqlpiloto );
                            $resultpiloto = $select->fetchAll( PDO::FETCH_ASSOC );

                          foreach($resultpiloto as $row)            
                            {               
                             ?>
                             <option value="<?php echo $row["idpiloto"] ?>"> <?php echo $row["name"] ?></option>
                            <?php
                            }
                            ?>
                        ?>
                      </select> 
                    </div>


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
                                    $sql = "SELECT * FROM  carmodel where idcarmodel=18;";
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

        </div>
      </div>   
    </div>

       
<br>

<hr>




</body>
</html>

