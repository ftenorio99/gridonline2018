<!DOCTYPE html>
<html>
<head>
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

<div class="col-lg-4 col-md-4 col-lg-offset-4 col-md-offset-4">
    
      <h2>Login</h2>
      <form action="login.php" method="post">
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" class="form-control" id="email" placeholder="Insira o email" name="email">
        </div>
        <div class="form-group">
          <label for="pwd">Password:</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Insira a senha">
        </div>
        <button type="submit" value="Entrar" class="btn btn-default" name="Entrar">Entrar</button>        
      
        <button type="submit" value="RecuperarSenha" class="btn btn-default" name="RecuperarSenha">Recuperar senha</button>
      </form>
    
</div>

</body> 
</html>