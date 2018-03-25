<!DOCTYPE html>
<html lang="en">
<head>
  <title>Grid Online</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
        background-image: url("../img/lotus_evora_gtc/lotus_evora_gtcheader.png");
      }
    #div-foto{
        background-color: white;
        align-content: center;       
      }
  </style>
</head>
<body>

<?php    
    include 'menu.php';
?>

  
<div class="container-fluid bg-3 text-center"> 
  <div><hr></div>   
  <div><h2>Livetiming</h2></div>   
  <div><hr></div>   
</div>  

<div class="embed-responsive embed-responsive-16by9" id="div-foto">
  <iframe class="embed-responsive-item" src="http://18.231.168.55:50041/lapstat"></iframe>
</div>

<br>

<br>

</body>
</html>
