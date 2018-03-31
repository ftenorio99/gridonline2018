<?php
 
    require_once '../init.php';

    $PDO = db_connect(); 

$i=1;
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
    #tabela {
      width: 50%; 
      font-family:Roboto, sans-serif;

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

 

        <div class="container-fluid bg-3 text-center"> 
          <div><hr></div>   
          <div><h2>Grid Online Lotus Trophy - Classificação de Equipes</h2></div>   
          <div><hr></div>  
        </div> 

        <div class="container-fluid"><!-- container -->  
          <div class="row" align="center">
            <div class="col-lg-6 col-md-6 col-lg-offset-3 col-md-offset-3">
              <table class="table table-striped" id="tabela" >
                <thead>
                  <tr>
                    <th width="10%">Posição</th>
                    <th>Equipe</th>
                    <th width="10%">Pontos</th>
                  </tr>
                </thead>
                  <tbody>
                    <?php
                        $sql = "SELECT
                                               
                                  team.name,
                                  sum(IF(pistatorneio.pontuacaodobrada='S', tabelapontuacao.ponto*2,tabelapontuacao.ponto)) as pontuacao                                                                            
                                          FROM jsonassetorace

                                  INNER JOIN tabelapontuacao on tabelapontuacao.posicao=jsonassetorace.posicao
                                  INNER JOIN pistatorneio on pistatorneio.idsessionrace=jsonassetorace.idsession
                                  INNER JOIN piloto on piloto.guid=jsonassetorace.driverguid
                                  INNER JOIN pilototorneio on pilototorneio.idpiloto=piloto.idpiloto
                                  INNER JOIN team ON team.idteam=pilototorneio.idteam

                                  WHERE pistatorneio.idtorneio=6

                                  group by pilototorneio.idteam
                                  order by pontuacao DESC";
                        $select = $PDO->query( $sql );
                         
                        $result = $select->fetchAll( PDO::FETCH_ASSOC );
                         
                        foreach($result as $row)
                        {?>
                        <tr>
                            <td align="center">  <?php echo $i;?></td>                                        
                            <td>  <?php echo $row['name'];?></td>
                            <td align="center">  <?php echo $row['pontuacao'];?></td>
                            
                        </tr>  
                      <?php
                        $i++;}
                      ?>  
                  </tbody>
              </table>
            </div>  
          </div>
       </div>
      <hr>
  </body>
</html>



