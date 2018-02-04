<?php
require_once 'init.php';

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
 
<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});
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

      <div class="container-fluid text-center">  
        <?php    
            include 'menucampeonatos.php';
        ?>
        <hr>


        <hr>
        <div class="col-sm-12 text-left"> 
           
            <div class="col-lg-4 col-md-4 col-lg-offset-4 col-md-offset-4">
            <form name="form" method="post" action="inscricao.php" >            
              <legend>Inscrição GridOnline Asseto Corsa</legend> 
                <fieldset>                   
                    <div class="form-group">
                      <label> GUID: </label>   
                        <input type="text" class="form-control" id="guid" name="guid" placeholder="Número de identificação do Steam" >  
                        <a href="#" data-toggle="popover" title="Como achar o seu Steam GUID" data-content="Na pasta Documentos\Assetto Corsa\logs , abra o arquivo log e ache a linha Steam Community ID: (essa é sua GUID).">Como achar o seu Steam GUID</a> 
                    </div>   
                    <div class="form-group">
                      <br>
                      <label >Nome:</label>  
                      <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome Utilizado no jogo Asseto Corsa" >                    
                    </div>                                                                
                    <div class="form-group">
                      <br>
                      <label >Email:</label>  
                      <input type="text" class="form-control" id="email" name="email" placeholder="Email de contato" >                    
                    </div>    
 
                    <div class="form-group">
                      <br>
                      <label for="name">Número do Celular:</label>
                      <input type="text" class="form-control" id="celular" name="celular" placeholder="Celular com DDD para comunicação por Whatsap">   
                    </div>      
                    <button type="submit" class="btn btn-primary btn-block" value="enviar"  >Enviar</button>
                </fieldset>                               
            </form>
            </div>
          
        </div>

<!--           <div class="col-sm-3 sidenav" align="center">
            <div class="panel panel-default col-lg-8 col-lg-offset-2">
              <h2 class="title">
                <a href="#" title="">
                  <span>Next Race</span>
                </a>
              </h2>
              <div class="well well-sm" style="width: 250px ; background-color:#343739; color:#f8fafb;" >
                  <?php

                   $sql = "SELECT pistatorneio.data, pista.nome, torneio.nome as torneionome FROM pistatorneio INNER JOIN pista ON  pistatorneio.idpista = pista.idpista INNER JOIN torneio on pistatorneio.idtorneio = torneio.idtorneio WHERE pistatorneio.data>=CURRENT_DATE  order by pistatorneio.data LIMIT 1";

                    $select = $PDO->query( $sql );
                    $result = $select->fetchAll( PDO::FETCH_ASSOC );

                    foreach($result as $row)            
                          {   
                            $nomepista = $row["nome"];
                            $datapista = $row["data"];
                            $nometorneio = $row["torneionome"];
                          }
                    ?>    
                    <p><?php $date = date_create($datapista);
                                      echo date_format( $date ,"d/m/Y");?></p>

                <div class="countdown styled"></div>
              </div>

              <div class="well well-sm" style="width: 250px ; background-color:#343739; color:#f8fafb;" >                      
                  <h3><?php echo $nomepista; ?></h3>
                  <p><?php echo $nometorneio; ?></p>              
              </div>
            </div>
            <br>
            <br>
              <div>
                 <iframe  src="https://discordapp.com/widget?id=265546426908540939&theme=dark" width="350" height="350" allowtransparency="true" frameborder="0"></iframe> 
              </div>
           
          </div> -->
        </div>
      </div>

<!--       <footer class="container-fluid text-center">
        <p>Footer Text</p>
      </footer> -->



  </body>
</html>
