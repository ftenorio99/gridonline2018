<?php
 
  if(!isset($_SESSION)){
      session_start();
      require_once '../../init.php';
      require '../../check.php';
    }
    $PDO = db_connect(); 
    $PDO1 = db_connect();
    $PDO2 = db_connect();
    $PDO3 = db_connect();


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
  <script src="../../js/sorttable.js">
  	
  </script>
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
        background-image: url("../../img/lotus_evora_gtc/lotus_evora_gtcheader.png");
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
    include 'menubackend.php';
    include 'menu.php';
?>

 

        <div class="container-fluid bg-3 text-center"> 
          <div><hr></div>   
          <div><h2>Grid Online Lotus Trophy - Classificação de Pilotos</h2></div>   
          <div><hr></div>  
        </div> 

        <div class="container-fluid">  
          <div class="row" align="center">
            <div class="col-lg-6 col-md-6 col-lg-offset-3 col-md-offset-3">
              <table class="table table-striped sortable" id="tabela" >
                <thead>
                  <tr>      
                  	<th width="10%">Posição</th>              
                    <th>Nome</th>
                    <th width="10%">Pontos</th>
                  </tr>
                </thead>
                  <tbody>
                    <?php

                     	$sqlqtdetapas = "SELECT COUNT(idpistatorneio) as etapa FROM `pistatorneio` WHERE idtorneio = 6                                                          
                                 ";

						$stetapa = $PDO2->prepare($sqlqtdetapas); 			                      	
                      	$stetapa->execute();                       	
                      	$resultetapa = $stetapa->fetchAll( PDO::FETCH_ASSOC );   

                      	foreach($resultetapa as $rowresultetapa)
                        { 
                        	$qtdetapa = $rowresultetapa['etapa'];
                        } 

                    	$a=array();
                    	$b=array();


						$sqlpiloto = "SELECT piloto.idpiloto,piloto.name,piloto.guid FROM piloto
											INNER JOIN pilototorneio on piloto.idpiloto = pilototorneio.idpiloto
										AND
										pilototorneio.idtorneio=6";

                        $selectpiloto = $PDO->query( $sqlpiloto );    
                        $resultpiloto = $selectpiloto->fetchAll( PDO::FETCH_ASSOC );

                        foreach($resultpiloto as $row){

								$pontuacaofinal=0;




			                     			$sqletapaspiloto = "SELECT COUNT(driverguid) as etapaspiloto FROM `jsonassetorace` WHERE driverguid=:driverguid                                               
			                                                                                                
			                                 ";


									$stetapaspiloto = $PDO2->prepare($sqletapaspiloto); 
			                      	$stetapaspiloto->bindParam(':driverguid', $row['guid'], PDO::PARAM_INT);
			                      	$stetapaspiloto->execute();                       	
			                      	$resultetapaspiloto = $stetapaspiloto->fetchAll( PDO::FETCH_ASSOC );   

			                      	foreach($resultetapaspiloto as $rowresultetapaspiloto)
			                        { 
			                        	$etapaspiloto = $rowresultmenorpontuacao['etapaspiloto'];
			                        } 


			                        $sqlpontuacao = "SELECT
			                                                                                                                
			                                      	sum(IF(pistatorneio.pontuacaodobrada='S', (tabelapontuacao.ponto*2) , tabelapontuacao.ponto )) as pontuacao
			                                          
			                                          FROM jsonassetorace

			                                  INNER JOIN tabelapontuacao on tabelapontuacao.posicao=jsonassetorace.posicao
			                                  INNER JOIN pistatorneio on pistatorneio.idsessionrace=jsonassetorace.idsession
			                                  INNER JOIN piloto on piloto.guid=jsonassetorace.driverguid

			                                  WHERE pistatorneio.idtorneio=6 

			                                  AND piloto.idpiloto=:piloto                                                         			                                  
			                                  
			                                  order BY jsonassetorace.driverguid, tabelapontuacao.ponto ASC                                                            
			                                 ";

											$stpontuacao = $PDO1->prepare($sqlpontuacao); 
					                      	$stpontuacao->bindParam(':piloto', $row['idpiloto'] , PDO::PARAM_INT);
					                      	$stpontuacao->execute();                      
					                      	$resultpontuacao = $stpontuacao->fetchAll( PDO::FETCH_ASSOC );   



						                      	foreach($resultpontuacao as $rowresultpontuacao)
						                        { 						                        	
						                        	$pontuacao = $rowresultpontuacao['pontuacao'];
						                        } 


						                if ($etapaspiloto>=$qtdetapa) {
						                	
						                	$sqlmenorpontuacao = "SELECT
			                                                                                                                
			                                     MIN(tabelapontuacao.ponto) as menorpontuacao
			                                      			                                          
			                                          FROM jsonassetorace

			                                  INNER JOIN tabelapontuacao on tabelapontuacao.posicao=jsonassetorace.posicao
			                                  INNER JOIN pistatorneio on pistatorneio.idsessionrace=jsonassetorace.idsession
			                                  INNER JOIN piloto on piloto.guid=jsonassetorace.driverguid

			                                  WHERE pistatorneio.idtorneio=6       
			                                  AND piloto.idpiloto=:piloto  
			                                  AND pistatorneio.pontuacaodobrada='N'                                                     
			                                  
			                                  
			                                  order BY jsonassetorace.driverguid, tabelapontuacao.ponto ASC					                                                                                                
			                                 ";

												$stmenorpontuacao = $PDO2->prepare($sqlmenorpontuacao); 
						                      	$stmenorpontuacao->bindParam(':piloto', $row['idpiloto'], PDO::PARAM_INT);
						                      	$stmenorpontuacao->execute();                       	
						                      	$resultmenorpontuacao = $stmenorpontuacao->fetchAll( PDO::FETCH_ASSOC );   

						                      	foreach($resultmenorpontuacao as $rowresultmenorpontuacao)
						                        { 
						                        	$menorpontuacao = $rowresultmenorpontuacao['menorpontuacao'];
						                        } 

						                        if ($pontuacao==$menorpontuacao) {
						                        	$pontuacaofinal=$pontuacao;
						                        } else {
						                        	$pontuacaofinal=$pontuacao-$menorpontuacao;
						                        }
						                } else {
						                	$pontuacaofinal=$pontuacao-0;
						                }
			                     					                        		                        

	                                 $sqlqualy= "SELECT pistatorneio.idsessionqualy
		                                         FROM
		                                         jsonassetorace
		                                         INNER JOIN 
		                                         pistatorneio ON jsonassetorace.idsession=pistatorneio.idsessionrace
		                                         WHERE
		                                         pistatorneio.idtorneio=6
		                                         GROUP BY pistatorneio.idsessionqualy"; 


									$stqualy = $PDO3->prepare($sqlqualy); 
			                      	$stqualy->execute();                      
			                      	$resultqualy = $stqualy->fetchAll( PDO::FETCH_ASSOC );   			                                         

	                                $pontoqualy=0;

	                                 foreach($resultqualy as $rowqualy)                                         
	                                   {
	                                      $sqlqualy2 = "SELECT piloto.idpiloto, min(bestlap) as bestlap FROM jsonassetoqualy 

														 INNER JOIN piloto on jsonassetoqualy.driverguid=piloto.guid

														 WHERE idsession=:idsessionqualy ";          

	                                               $stqualy2 = $PDO3->prepare($sqlqualy2);                                                                                   
	                                               $stqualy2->bindParam(':idsessionqualy', $rowqualy['idsessionqualy'], PDO::PARAM_STR);                                                     
	                                               $stqualy2->execute(); 
	                                               $obj2 = $stqualy2->fetchObject();  

	                                             if ($obj2->idpiloto == $row['idpiloto'] ) {
	                                                  $pontuacaofinal = $pontuacaofinal + ($pontoqualy+1);
	                                             }
	                                   }

                              ?>                 
              
                      <?php
                      
						array_push($a,$row['name']);       
						array_push($b,$pontuacaofinal); 

                      }?>  
	<?php 

			arsort($a,1);
			arsort($b,1);
			$y=1;
				foreach ($b AS $indice=>$valor)
				{				  

			    ?>
						<tr>                 
							<td >  <?php echo $y;?></td>                                                 
                            <td >  <?php echo $a[$indice];?></td>
                            <td align="center">  <?php echo $b[$indice];?></td>                            
                        </tr>   

		<?php $y++;	}

	?>   
                    
                  </tbody>
              </table>
            </div>  
          </div>
       </div>
      <hr>	
  </body>
</html>


                                 