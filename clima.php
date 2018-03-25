<?php
require_once 'init.php';

$PDO = db_connect(); 
//Endereço para inserir clima
//retorna um arquivo JSON
//Inserir no banco de dados as informações
$codigocidade="69261_poi";

$info = file_get_contents("http://apidev.accuweather.com/currentconditions/v1/".$codigocidade.".json?apikey=95df38db964c4236936b1e894ad2232f");
$json_output = json_decode($info);
	foreach ( $json_output as $r )
		{
			//print_r($r->WeatherText);						
			
			$tempac=$r->Temperature->Metric->Value;

			$sql ="SELECT * from clima where weathertext=:weathertext";																			

    		$sth = $PDO->prepare($sql);
	        $sth->bindParam("weathertext", $r->WeatherText);
	        $sth->execute();
	        $result = $sth->fetchAll( PDO::FETCH_ASSOC );

	        foreach($result as $row)
		        {
		        	$climaac=$row["acweather"];
		        }

		}

echo $climaac;
echo "<br>";
echo round(floatval($tempac));
?>

<!-- Array ( [0] => Array ( 
	[LocalObservationDateTime] => 2018-03-25T19:55:00+01:00 
	[EpochTime] => 1522004100 
	[WeatherText] => Partly cloudy 
	[WeatherIcon] => 35 
	[IsDayTime] => 
	[Temperature] => 
		Array ( 
			[Metric] =>Array ( 
					[Value] => 7.2 
					[Unit] => C 
					[UnitType] => 17 ) 

			[Imperial] => Array ( 
					[Value] => 45 
					[Unit] => F 
					[UnitType] => 18 ) ) 
	[MobileLink] => http://m.accuweather.com/en/gb/cadwell-park/ln11-9/current-weather/64328_poi?lang=en-us 
	[Link] => http://www.accuweather.com/en/gb/cadwell-park/ln11-9/current-weather/64328_poi?lang=en-us ) ) 
http://apidev.accuweather.com/hourly-weather-forecast/v1/69261_poi.json?apikey=95df38db964c4236936b1e894ad2232f
-->