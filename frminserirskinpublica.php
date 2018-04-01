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
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type="text/javascript">

 
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
    include 'menu.php';
?>
 
        <div class="container-fluid"><!-- container -->  
          <div class="row">
            <main>
              <div class="col-lg-4 col-md-4 col-lg-offset-4 col-md-offset-4" id="form-cadastro">   

            <form id="form" name="form" action="inserirskinpublica.php" method="post" enctype="multipart/form-data">             

                <fieldset>
                    <legend>Inserir Skin</legend>
                    <div class="form-group">
                        <label for="carmodel">Carro:</label>
                          <select id="carmodel" class="form-control" name="carmodel" >
                                  <option id="carmodel" value="0">Escolha o Carro</option>                                  
                                  <?php
                                    $sql = "SELECT * FROM  carmodel where status='A'";
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
                    <label>Arquivo:</label>
                    <input type="file" name="arquivo" accept=".zip" />
                  </div>    
                  
                    <br>
                    <br>
                </fieldset>
                  <input class="btn btn-primary btn-block" type="submit" id="enviar" >

            </form>  


            </div>
          </div>   
        </div>

       
<br>

<hr>

</body>
</html>      
      

