<?php
 
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
        background-image: url("../img/lotus_evora_gtc/lotus_evora_gtcheader.png");
      }

    .affix {
      top: 0;
      width: 100%;
    }

     .affix + .container-fluid {
      padding-top: 70px;
     }
     #testefundo{
      background-color: white;
     }
     #font{
      color:#000000;
      font-family:Roboto, sans-serif;
      line-height:1.5;
    }
    #tabelamodal{
      width: 570px

    }
    div.polaroid {
      width: 72%;
      background-color: white;
      box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
      margin-bottom: 15px;
    }

  </style>
</head>

<body>

<?php        
    include 'menubackend.php';
    include 'menu.php';
?>


        <div class="container-fluid bg-3 text-center"> 
          <hr>
          <div><h2>GridOnline - Contribuição</h2></div>   
          <hr>
        </div> 
  
        <div class="container" ">
                  <div class="row" align="center" >
                    <h3>Contribua para o nosso servidor e encaminhe pra “diretoria@gridonline.com.br” o comprovante.</h3>
            						<!-- INICIO FORMULARIO BOTAO PAGSEGURO -->
            						<form action="https://pagseguro.uol.com.br/checkout/v2/payment.html" method="post">
            						<!-- NÃO EDITE OS COMANDOS DAS LINHAS ABAIXO -->
            						<input type="hidden" name="code" value="205766F7A7A7025664D36FBE19CC0A49" />
            						<input type="hidden" name="iot" value="button" />
            						<input type="image" src="https://stc.pagseguro.uol.com.br/public/img/botoes/pagamentos/120x53-pagar-laranja.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
            						</form>
            						<!-- FINAL FORMULARIO BOTAO PAGSEGURO -->
                  </div>
        </div>       

</body>

</html>