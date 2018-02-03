<?php
	// $PDO2 = new PDO("mysql:host=mysql.hostinger.com.br;dbname=u240322781_teste;charset=utf8mb4", "u240322781_root", "chemical99");

	$PDO2 = new PDO("mysql:host=localhost;dbname=gridonline;charset=utf8mb4", "root", ""); 

?>

<html>
<head>
   <title>Upload arquivos de corrida</title>
</head>
<body>
   <form action="#" method="POST" enctype="multipart/form-data">
   <label>
   <span>Etapa</span>
		<select  name="etapa" >
		        <option id="etapa" value="-1">Escolha a Etapa</option>
		        <!-- Aqui combo com as Etapas-->
		        <?php
		     		$sql2 = "SELECT 
							a.idpistatorneio
							,b.nome
							 FROM pistatorneio as a
							 inner join
							 pista as b on a.idpista=b.idpista";
		         try{
		                $query2 = $PDO2->query($sql2);
					    $resultado2 = $query2->fetchAll(PDO::FETCH_ASSOC);
					}catch(PDOException $erro){
			   		 echo 'Erro '.$erro->getMessage();	
			 		}
		               foreach($resultado2 as $result){
						?>
				        <option value="<?php echo $result['idpistatorneio']; ?>"><?php echo $result['nome']; ?></option>
				        <?php 
				}
				?>
		</select>		
	</label>



   	<p>Arquivo de Race</p>	
      <input type="file" name="fileRaceUpload">
      <br>
     <p>Arquivo de Qualy</p>
      <input type="file" name="fileQualyUpload">
      <br>
      <br>
      <input type="submit" value="Enviar">


   </form>
</body>
</html>


<?php
	

	if(isset($_FILES['fileRaceUpload']))
   	{
      $nomearquivo = $_FILES['fileRaceUpload']['name'];

	
	// $PDO = new PDO("mysql:host=mysql.hostinger.com.br;dbname=u240322781_teste;charset=utf8mb4", "u240322781_root", "chemical99"); 
	$PDO = new PDO("mysql:host=localhost;dbname=gridonline;charset=utf8mb4", "root", ""); 


	// Atribui o conteúdo do arquivo para variável $arquivo
	$arquivo = file_get_contents('resultados/'.$nomearquivo,0,null,null); 

	// Decodifica o formato JSON e retorna um Objeto
	$json_output2 = json_decode($arquivo);

	// pega o nome do arquivo
	function pega_nome_arquivo($arquivo){
	$nome = pathinfo($arquivo);
	return $nome['filename'];
	}

	function idsessao($sessao){
	
	$idsessao=substr($sessao,0,strrpos($sessao,"RACE"));	
	$valorsessao=str_replace("_","", $idsessao);
	return $valorsessao;	
	
	}

	function idsessaoqualy($sessao){
	$idsessao=substr($sessao,0,strrpos($sessao,"QUALIFY"));	
	$valorsessao=str_replace("_","", $idsessao);
	return $valorsessao;	
	
	}

	function nomesessao($sessao){

	strlen($sessao);
	$nomesessao=substr($sessao,strrpos($sessao,"RACE"),strlen($sessao));	
	return $nomesessao;
	}

	function nomequaly($sessao){

	strlen($sessao);
	$nomesessao=substr($sessao,strrpos($sessao,"QUALIFY"),strlen($sessao));	
	return $nomesessao;
	}

	$idsession = pega_nome_arquivo($nomearquivo);
	$TrackName =  $json_output2->TrackName;
	$TrackConfig =  $json_output2->TrackConfig;
	$Type= $json_output2->Type;
	$Result = $json_output2->Result;
	$pos=0;
	$Laps = $json_output2->Laps;
	$Events = $json_output2->Events;

	$valorsessao=idsessao($idsession);
	$nomesessao=nomesessao($idsession);


		try {

			// set the PDO error mode to exception
			$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			foreach ( $Result as $r ) 
			{ 			
				if ($r->DriverName<>("")) {
				$pos=$pos+1;	

				$sql ="INSERT INTO jsonassetorace 
							(drivername, driverguid, carmodel, bestlap, totaltime, posicao, carid, trackname, trackconfig,idsession,nomesession) 
						 VALUES 
						 	(:drivername, :driverguid, :carmodel, :bestlap, :totaltime, :posicao, :carid, :trackname, :trackconfig, :idsession, :nomesession) "; 		

				$sth = $PDO->prepare($sql);
			    $sth->bindParam("drivername", $r->DriverName);
			    $sth->bindParam("driverguid", $r->DriverGuid);
			    $sth->bindParam("carmodel", $r->CarModel);
			    $sth->bindParam("bestlap", $r->BestLap);
			    $sth->bindParam("totaltime", $r->TotalTime);
			    $sth->bindParam("posicao", $pos);
			    $sth->bindParam("carid", $r->CarId);
			    $sth->bindParam("trackname", $TrackName);
			    $sth->bindParam("trackconfig", $TrackConfig);
			    $sth->bindParam("idsession",$valorsessao );
			    $sth->bindParam("nomesession",$nomesessao );
			    
			    $sth->execute();

			    
				echo "New record Result created successfully<br>";
				}
			; 
			}

			foreach ( $Laps as $l ) 
			{ 			
				if ($l->DriverName<>("")) {						

				$sql ="INSERT INTO lapracesassetto 
							(drivername, driverguid, laptime, sectors0, sectors1, sectors2, cuts, tyre, laptimestamp ,idsession,nomesession) 
						 VALUES 
						 	(:drivername, :driverguid, :laptime, :sectors0, :sectors1, :sectors2, :cuts, :tyre, :laptimestamp ,:idsession, :nomesession)"; 			
				$sth = $PDO->prepare($sql);
			    $sth->bindParam("drivername", $l->DriverName);
			    $sth->bindParam("driverguid", $l->DriverGuid);
			    $sth->bindParam("laptime", $l->LapTime);
			    $sth->bindParam("sectors0", $l->Sectors[0]);
			    $sth->bindParam("sectors1", $l->Sectors[1]);
			    $sth->bindParam("sectors2", $l->Sectors[2]);
			    $sth->bindParam("cuts", $l->Cuts);
			    $sth->bindParam("tyre", $l->Tyre);
			    $sth->bindParam("laptimestamp", $l->Timestamp);
			    $sth->bindParam("idsession",$valorsessao );
			    $sth->bindParam("nomesession",$nomesessao );
			    $sth->execute();
			    


				echo "New record Lap created successfully<br>";
				}
			; 
			}

			foreach ( $Events as $ev ) 
			{ 			
				if ($ev->Type<>("COLLISION_WITH_ENV")) {						

				$sql ="INSERT INTO jsonassettoevents 
							(type, carid, othercarid, impactspeed, idsession,nomesession) 
						 VALUES 
						 	(:type, :carid, :othercarid, :impactspeed, :idsession, :nomesession)"; 			
				$sth = $PDO->prepare($sql);
			    $sth->bindParam("type", $ev->Type);
			    $sth->bindParam("carid", $ev->CarId);
			    $sth->bindParam("othercarid", $ev->OtherCarId);
			    $sth->bindParam("impactspeed", $ev->ImpactSpeed);
			    $sth->bindParam("idsession",$valorsessao );
			    $sth->bindParam("nomesession",$nomesessao );
			    $sth->execute();
			    
				echo "New record event created successfully<br>";
				}
			; 
			}
			
			$origem = 'resultados/'.$nomearquivo;
			$destino = 'resultados/lidos/'.$nomearquivo;
			copy($origem, $destino);
			unlink($origem);

			}
			catch(PDOException $e)
			{
			echo $sql . "<br>" . $e->getMessage();
			}

			$PDO = null;

		}



			if(isset($_FILES['fileQualyUpload']))
			   	{
			      $nomearquivo = $_FILES['fileQualyUpload']['name'];

			      $dir = 'resultados/'; //Diretório para uploads

			      move_uploaded_file($nomearquivo, $dir); //Fazer upload do arquivo


				//Passar a session como parâmetro

				// $PDO = new PDO("mysql:host=mysql.hostinger.com.br;dbname=u240322781_teste;charset=utf8mb4", "u240322781_root", "chemical99"); 
				$PDO = new PDO("mysql:host=localhost;dbname=gridonline;charset=utf8mb4", "root", ""); 


				// Atribui o conteúdo do arquivo para variável $arquivo
				$arquivo = file_get_contents('resultados/'.$nomearquivo,0,null,null); 

				// Decodifica o formato JSON e retorna um Objeto

				$json_output2 = json_decode($arquivo);

				// pega o nome do arquivo

				$idsession = pega_nome_arquivo($nomearquivo);
				$TrackName =  $json_output2->TrackName;
				$TrackConfig =  $json_output2->TrackConfig;
				$Type= $json_output2->Type;
				$Result = $json_output2->Result;
				$valorsessaoqualy=idsessaoqualy($idsession);
				$nomequaly=nomequaly($idsession);


			try {

				// set the PDO error mode to exception
				$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				foreach ( $Result as $r ) 
						{ 			
								if ($r->DriverName<>("")) {
									

								$sql ="INSERT INTO jsonassetoqualy 
											(trackname, trackconfig, drivername, driverguid, carid, carmodel, bestlap, idsession,nomesession) 
										 VALUES 
										 	(:trackname, :trackconfig, :drivername, :driverguid, :carid, :carmodel, :bestlap, :idsession, :nomesession)"; 			

					    		$sth = $PDO->prepare($sql);
			    		        $sth->bindParam("trackname", $TrackName);
			    		        $sth->bindParam("trackconfig", $TrackConfig);
			    		        $sth->bindParam("drivername", $r->DriverName);
						        $sth->bindParam("driverguid", $r->DriverGuid);
						        $sth->bindParam("carid", $r->CarId);
						        $sth->bindParam("carmodel", $r->CarModel);
						        $sth->bindParam("bestlap", $r->BestLap);			        			        
						        $sth->bindParam("idsession", $valorsessaoqualy);
						        $sth->bindParam("nomesession", $nomequaly);
						        $sth->execute();
						        
					    		echo "New record Qualy created successfully<br>";
								}
						   ; 
						}




					
					$origem = 'resultados/'.$nomearquivo;
					$destino = 'resultados/lidos/'.$nomearquivo;
					copy($origem, $destino);
					unlink($origem);

				}
				catch(PDOException $e)
				{
				echo $sql . "<br>" . $e->getMessage();
				}

				$PDO = null;
			}


			  // Verifica se a variável $_POST['etapa'] existe
			  if (isset($_POST['etapa'])) 
			  	{
			    
			    if (!empty($_POST['etapa'])) 
			    	{

			      		$idpistatorneio = $_POST['etapa'];

			      					try {

										// $PDOEtapa = new PDO("mysql:host=mysql.hostinger.com.br;dbname=u240322781_teste;charset=utf8mb4", "u240322781_root", "chemical99");
										$PDOEtapa = new PDO("mysql:host=localhost;dbname=gridonline;charset=utf8mb4", "root", "");

										$sql ="UPDATE pistatorneio
													SET idsessionrace =:sessaorace, idsessionqualy =:sessaoqualy
													WHERE idpistatorneio=:torneio;"; 			

											    		$sth = $PDOEtapa->prepare($sql);
									    		        $sth->bindParam("torneio", $idpistatorneio);
			        			        				$sth->bindParam("sessaorace", $valorsessao);
												        $sth->bindParam("sessaoqualy", $valorsessaoqualy);
												        
												        $sth->execute();
												        
											    		echo "Update PistaTorneio successfully<br>";
														
												    
												
										}
										catch(PDOException $e)
										{
										echo $sql . "<br>" . $e->getMessage();
										}

										$PDO = null;
									      
			   						} 

			   						 else {
			     							 echo "Por favor, selecione a Etapa";
			    						}

				}



?>