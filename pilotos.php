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

      <div class="container-fluid">  
        <hr>
        <div  class="col-lg-4 col-md-4 col-lg-offset-4 col-md-offset-4"> 
           
              
              <h2>Pilotos</h2>
                <p>Lista de pilotos cadastrados na GridOnline :</p>            
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Número</th>
                      <th>Nome</th>                      
                      <th>Email</th> 
                    </tr>
                  </thead>
                  <tbody>
                    
                      <?php
                        $sql =  " SELECT * FROM piloto ";                                
                        $select = $PDO->query( $sql );
                        $result = $select->fetchAll( PDO::FETCH_ASSOC );
                        foreach($result as $row)            
                          {               
                           ?>
                            <tr> 
                             <td width=10%><?php echo $row["numero"] ?></td>
                             <td width=40%><?php echo $row["name"] ?></td>                                         
                             <td width=50%><?php echo $row["email"] ?></td>    
                            </tr>
                          <?php
                          }
                      ?>                      
                    
                  </tbody>
                </table>
                
          </div>
        

          
      </div>

      <footer class="container-fluid text-center">
        <p>Footer Text</p>
      </footer>



  </body>
</html>
