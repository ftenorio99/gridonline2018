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

            <form name="frmBusca" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>?a=buscar" >
            
                <fieldset>
                  <legend>Atualizar Dados do Piloto na GridOnline Asseto Corsa</legend>  
                                   
            </form>

            <form id="form" action="inserirpiloto.php" method="post" enctype="multipart/form-data">  

                    
                    <div class="form-group">
                      <label> GUID: </label>                    
                        <?php
                            $sqlpiloto = "Select  *
                                                from

                                                piloto
                                                where
                                                piloto.idpiloto =:piloto  ; ";                            
                            $stmt = $PDO->prepare($sqlpiloto); 
                            $stmt->bindParam(':piloto', $_SESSION['user_id'], PDO::PARAM_STR);
                            $stmt->execute(); 

                            $resultpiloto = $stmt->fetchAll( PDO::FETCH_ASSOC );

                          foreach($resultpiloto as $row)            
                            {                                           
                             ?>
                              <input type="text" class="form-control" id="guid2" name="guid2" readonly="true" value="<?php echo $row["guid"]?>"> 
                              <br>
                              <label for="name">Nome:</label>
                              <input type="text" class="form-control" id="name" name="name" disabled="true" value="<?php echo $row["name"]?>">                                                       
                            <?php
                            }                            
                            ?>                                                                         
                      
                    </div>  
 
                    <div class="form-group">
                      <label for="name">Telefone:</label>
                      <input class="form-control" id="telefone" type="text" name="telefone" placeholder="ex.(11)-1111-1111" value="<?php echo $row["telefone"]?>">
                    </div>                                                 

                    <div class="form-group">
                      <label for="name">Email:</label>
                      <input class="form-control" id="email" type="text" name="email" value="<?php echo $row["email"]?>">
                    </div> 

<!-- 
                    <div class="form-group">
                      <label for="name">Login:</label>
                      <input class="form-control" id="login" type="text" name="login" value="<?php echo $row["login"]?>" >
                    </div>  -->

                    <div class="form-group">
                      <label for="name">Senha:</label>
                      <input class="form-control" id="senha" type="password" name="senha" value="<?php echo $row["senha"]?>">
                    </div> 

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
      
      