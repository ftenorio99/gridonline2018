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

                <form id="form" action="inserirequipe.php" method="post" enctype="multipart/form-data">  

                  <fieldset>

                  <legend>Inscrição da Equipe na GridOnline Asseto Corsa</legend>  

                        <div class="form-group">
                          <label for="name">Name:</label>
                          <input type="text" class="form-control" id="name" name="name" >
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
  <h2>Equipe</h2>
  <p>Lista das equipes já cadastrados no sistema</p>            
  <table class="table">
    <thead>
      <tr>
        <th>Equipe</th>

      </tr>
    </thead>
    <tbody>
                <?php
                $sql =  "Select  
                               *
                          from
                          team
                          order by team.name                     ";

              $select = $PDO->query( $sql );
              $result = $select->fetchAll( PDO::FETCH_ASSOC );
              foreach($result as $row)            
                {   
                 ?>
                 <tr>

                  <td>                        
                      <?php echo $row["name"] ?>         
                  </td>
                   </tr>
                <?php
                }
            ?>
     
    </tbody>
  </table>
</div>


</body>
</html>      
      