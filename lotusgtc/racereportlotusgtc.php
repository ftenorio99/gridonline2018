<?php

//$PDO = new PDO("mysql:host=mysql.hostinger.com.br;dbname=u240322781_teste;charset=utf8mb4", "u240322781_root", "chemical99"); 
$PDO = new PDO("mysql:host=localhost;dbname=gridonline;charset=utf8mb4", "root", ""); 

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
    
    /* Add a gray background color and some padding to the footer */
    #div-back-image{
        background-image: url("../img/lotus_evora_gtc/lotus_evora_gtcheader.png");
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
    #p1 {
        background-color:yellow;
        vertical-align:middle;
    }
    

  </style>
</head>
<body>

<?php    
    include 'menu.php';
?>



<!--         <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="http://gridonline.ddns.net/wordpress/category/acetapaporsche/"></iframe>
        </div> -->
       
<br>

<hr>
</body>
</html>
