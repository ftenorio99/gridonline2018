<?php
session_start();
require_once 'init.php';
require 'check.php';
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

                <form id="form" action="inserirpistatorneio.php" method="post" enctype="multipart/form-data">  

                    <fieldset>

                    <legend>Cadastro de Pista no Torneio na GridOnline Asseto Corsa</legend>  


                    <div class="form-group">
                          <label for="name">Torneio:</label>
                            <select id="torneio" class="form-control" name="torneio" required="required">
                              <?php
                                  $sqltorneio = "SELECT * FROM  torneio; ";
                                  $select = $PDO->query( $sqltorneio );
                                  $resulttorneio = $select->fetchAll( PDO::FETCH_ASSOC );

                                foreach($resulttorneio as $row)            
                                  {               
                                   ?>
                                   <option value="<?php echo $row["idtorneio"] ?>"> <?php echo $row["nome"] ?></option>
                                  <?php
                                  }
                                  ?>
                              ?>
                            </select> 
                    </div>    

                    <div class="form-group">
                          <label for="name">Pista:</label>
                            <select id="pista" class="form-control" name="pista" required="required">
                              <?php
                                  $sqltorneio = "SELECT * FROM  pista; ";
                                  $select = $PDO->query( $sqltorneio );
                                  $resulttorneio = $select->fetchAll( PDO::FETCH_ASSOC );

                                foreach($resulttorneio as $row)            
                                  {               
                                   ?>
                                   <option value="<?php echo $row["idpista"] ?>"> <?php echo $row["nome"] ?></option>
                                  <?php
                                  }
                                  ?>
                              ?>
                            </select> 
                    </div>                      

                    <div class="form-group">
                      <label for="name">Data do Torneio:</label>
                        <input id="data" type="date" name="data">                                                                   
                    </div>     

                    <div class="form-group">
                      <label for="name">Ordem da Pista:</label>
                          <select class="form-control" id="ordem" name="ordem">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                          </select>
                    </div>                   

                    </fieldset>
                  <input class="btn btn-primary btn-block" type="submit" value="Inserir" name="botao">
                </form>  
            </div>
          </div>   
        </div>
       
<br>

<hr>


<div class="container">
  <h2>Car Model</h2>
  <p>Lista dos torneios já cadastrados no sistema</p>            
  <table class="table">
    <thead>
      <tr>
        <th>Torneio</th>
        <th>Categoria</th>        
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>John</td>
        <td>Doe</td>
      </tr>
    </tbody>
  </table>
</div>


</body>
</html>      
      