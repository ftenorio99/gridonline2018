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
              <legend>Numeração Oficial GridOnline Asseto Corsa</legend> 
                <fieldset>                   
                    <div class="form-group">
                      <label> GUID: </label>                    
                      <?php
                          $sqlpiloto = "Select  
                                              piloto.idpiloto  
                                             ,piloto.name
                                             ,guid
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
                            <input type="text" class="form-control" id="guid" name="guid" readonly="true" value="<?php echo $row["guid"]?>"> 
                            <br>
                            <label for="name">Nome:</label>
                            <input type="text" class="form-control" id="name" name="name" readonly="true" value="<?php echo $row["name"]?>">                                                       
                          <?php
                          }                            
                      ?>         
                      <br>              
                      <label for="name">Número do piloto:</label>
                      <input type="text" class="form-control" id="numero" name="numero" placeholder="Escolha seu número e verifique se ele não está sendo utilizado clicando no botão buscar" >
                      <button type="submit" class="btn btn-primary btn-block" value="buscar">Buscar</button>                      
                      <label for="numeroexiste"></label>
                </fieldset>                               
            </form>

            <form id="form" name="form" action="numeracaooficial.php" method="post" enctype="multipart/form-data">  

                    <div class="form-group">
                      <label >GUID:</label>  
                      <input type="text" class="form-control" id="guid2" name="guid2" readonly="true">                    
                    </div>    

                    <div class="form-group">
                      <label for="name">Name:</label>
                      <input type="text" class="form-control" id="name2" name="name2" readonly="true">
                    </div>     
 
                    <div class="form-group">
                      <label for="name">Número:</label>
                      <input type="text" class="form-control" id="numero2" name="numero2" readonly="true">   
                    </div>              
                                
                <button type="submit" class="btn btn-primary btn-block" id="enviar" disabled="enable">Salvar</button>
            </form>  
        </div>
      </div>   
    </div>

       
<br>

<hr>


</body>
</html>
      <?php                        
            // Recuperamos a ação enviada pelo formulário
      if (isset($_GET['a'])) {
            $a = $_GET['a'];
             
            // Verificamos se a ação é de busca
          if ($a == "buscar") {
             
            // Pegamos o guid
            $guid = trim($_POST['guid']);
             
            $PDO = new PDO("mysql:host=localhost;dbname=gridonline;charset=utf8mb4", "root", ""); 

            $sql ="SELECT * from piloto where guid=:guid"; 
            $sth = $PDO->prepare($sql);
            $sth->bindParam("guid", $guid);
            $sth->execute(); 
            $result= $sth->fetchAll(PDO::FETCH_ASSOC);

            $total = $sth->rowCount();      

            if ($total==1) {
                    foreach($result as $resultado){   

                                  $numero = trim($_POST['numero']);            

                                  $PDO2 = new PDO("mysql:host=localhost;dbname=gridonline;charset=utf8mb4", "root", ""); 

                                  $sql2 ="SELECT * from piloto where numero=:numero"; 
                                  $sth2 = $PDO2->prepare($sql2);
                                  $sth2->bindParam("numero", $numero);
                                  $sth2->execute(); 
                                  $result2= $sth2->fetchAll(PDO::FETCH_ASSOC);
                                  $total2 = $sth2->rowCount();   
                                  if ($total2 == 0) {

                                        echo '<script> 
                                                document.getElementById("guid2").value = "'.$resultado['guid'].'";
                                                document.getElementById("name2").value = "'.$resultado['name'].'";     
                                                document.getElementById("numero2").value = "'.$_POST['numero'].'";
                                                document.form.enviar.disabled = false;
                                              </script>';   
                                  } else {
                                        
                                        echo '<script> 
                                              document.getElementById("numero").placeholder = "Número já utilizado";
                                            </script>'; 

                                  }   
                    }
            } 
            else{
                echo '<script> 
                        document.getElementById("guid").placeholder = "Número GUID não encontrado na base de dados";
                      </script>'; 

            }      
          }            
      }
        

      ?>
      