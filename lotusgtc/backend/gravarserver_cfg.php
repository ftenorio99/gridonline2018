<?php
session_start();
require_once '../../init.php';
//require '../../check.php';
$PDO = db_connect(); 


try{   

    $myfile = fopen("server_cfg.ini", "w") or die("Unable to open file!");


    $sqlslots =  "SELECT pista.slots, pistatorneio.idpista, pistatorneio.idtorneio, pistatorneio.idpistatorneio 
                  FROM pistatorneio
                  INNER JOIN pista on pista.idpista=pistatorneio.idpista
                  WHERE pistatorneio.data>CURRENT_DATE 
                  ORDER BY pistatorneio.data asc LIMIT 1";

                  $selectslots = $PDO->query( $sqlslots );
                  $resultslots = $selectslots->fetchAll( PDO::FETCH_ASSOC );
                  foreach($resultslots as $row)
                    {
                      $slots = $row['slots'];
                      $torneio = $row['idtorneio'];
                      $pistatorneio = $row['idpistatorneio'];
                    }
    

    $sql =  "Select  
                               pistatorneio.data
                              ,pista.pista
                              ,pista.nome
                              ,pista.config
                              ,pista.imagemnome
                              ,torneio.nome as torneionome

                              from

                              pistatorneio

                              INNER JOIN pista ON  pistatorneio.idpista = pista.idpista
                              INNER JOIN torneio on pistatorneio.idtorneio = torneio.idtorneio

                              where
                              pistatorneio.data>=CURRENT_DATE
                              order by pistatorneio.data LIMIT 1
                               ";

                  $select = $PDO->query( $sql );
                  $result = $select->fetchAll( PDO::FETCH_ASSOC );
                  $i=0;
     foreach($result as $row)
      {
              
$txt ="[SERVER]
NAME=".$row["torneionome"]." - Corrida - ".$row["nome"]."
CARS=lotus_evora_gtc
CONFIG_TRACK=".$row["config"]."
TRACK=".$row["pista"]."
SUN_ANGLE=16
PASSWORD=
ADMIN_PASSWORD=ACAC
UDP_PORT=9020
TCP_PORT=9020
HTTP_PORT=8020
MAX_BALLAST_KG=150
QUALIFY_MAX_WAIT_PERC=120
RACE_PIT_WINDOW_START=10
RACE_PIT_WINDOW_END=35
REVERSED_GRID_RACE_POSITIONS=0
LOCKED_ENTRY_LIST=1
PICKUP_MODE_ENABLED=0
LOOP_MODE=1
SLEEP_TIME=1
CLIENT_SEND_INTERVAL_HZ=18
SEND_BUFFER_SIZE=0
RECV_BUFFER_SIZE=0
RACE_OVER_TIME=150
KICK_QUORUM=101
VOTING_QUORUM=101
VOTE_DURATION=15
BLACKLIST_MODE=0
FUEL_RATE=100
DAMAGE_MULTIPLIER=60
TYRE_WEAR_RATE=100
ALLOWED_TYRES_OUT=2
ABS_ALLOWED=1
TC_ALLOWED=1
START_RULE=2
RACE_GAS_PENALTY_DISABLED=1
TIME_OF_DAY_MULT=1
RESULT_SCREEN_TIME=60
MAX_CONTACTS_PER_KM=0
STABILITY_ALLOWED=0
AUTOCLUTCH_ALLOWED=1
TYRE_BLANKETS_ALLOWED=1
FORCE_VIRTUAL_MIRROR=0
REGISTER_TO_LOBBY=1
MAX_CLIENTS=".$slots."
NUM_THREADS=2
UDP_PLUGIN_LOCAL_PORT=11020
UDP_PLUGIN_ADDRESS=127.0.0.1:12020
AUTH_PLUGIN_ADDRESS=
LEGAL_TYRES=
RACE_EXTRA_LAP=1
WELCOME_MESSAGE=

[FTP]
HOST=
LOGIN=
PASSWORD=W4tgzEwsonZKvqwo//H4qQ==
FOLDER=
LINUX=0

[PRACTICE]
NAME=Practice
TIME=120
IS_OPEN=1

[QUALIFY]
NAME=Qualify
TIME=15
IS_OPEN=1

[RACE]
NAME=Race
LAPS=0
TIME=45
WAIT_TIME=100
IS_OPEN=0

[DYNAMIC_TRACK]
SESSION_START=98
RANDOMNESS=2
SESSION_TRANSFER=100
LAP_GAIN=50

[WEATHER_0]
GRAPHICS=3_clear
BASE_TEMPERATURE_AMBIENT=32
BASE_TEMPERATURE_ROAD=7
VARIATION_AMBIENT=2
VARIATION_ROAD=2
WIND_BASE_SPEED_MIN=0
WIND_BASE_SPEED_MAX=5
WIND_BASE_DIRECTION=45
WIND_VARIATION_DIRECTION=5

[WEATHER_1]
GRAPHICS=7_heavy_clouds
BASE_TEMPERATURE_AMBIENT=20
BASE_TEMPERATURE_ROAD=7
VARIATION_AMBIENT=2
VARIATION_ROAD=2
WIND_BASE_SPEED_MIN=0
WIND_BASE_SPEED_MAX=5
WIND_BASE_DIRECTION=45
WIND_VARIATION_DIRECTION=5

[WEATHER_2]
GRAPHICS=1_heavy_fog
BASE_TEMPERATURE_AMBIENT=10
BASE_TEMPERATURE_ROAD=7
VARIATION_AMBIENT=2
VARIATION_ROAD=2
WIND_BASE_SPEED_MIN=0
WIND_BASE_SPEED_MAX=5
WIND_BASE_DIRECTION=45
WIND_VARIATION_DIRECTION=5

[WEATHER_3]
GRAPHICS=5_light_clouds
BASE_TEMPERATURE_AMBIENT=25
BASE_TEMPERATURE_ROAD=7
VARIATION_AMBIENT=2
VARIATION_ROAD=2
WIND_BASE_SPEED_MIN=0
WIND_BASE_SPEED_MAX=5
WIND_BASE_DIRECTION=45
WIND_VARIATION_DIRECTION=5

[WEATHER_4]
GRAPHICS=2_light_fog
BASE_TEMPERATURE_AMBIENT=12
BASE_TEMPERATURE_ROAD=7
VARIATION_AMBIENT=2
VARIATION_ROAD=2
WIND_BASE_SPEED_MIN=0
WIND_BASE_SPEED_MAX=5
WIND_BASE_DIRECTION=45
WIND_VARIATION_DIRECTION=5

[WEATHER_5]
GRAPHICS=4_mid_clear
BASE_TEMPERATURE_AMBIENT=25
BASE_TEMPERATURE_ROAD=7
VARIATION_AMBIENT=2
VARIATION_ROAD=2
WIND_BASE_SPEED_MIN=0
WIND_BASE_SPEED_MAX=5
WIND_BASE_DIRECTION=45
WIND_VARIATION_DIRECTION=5

[WEATHER_6]
GRAPHICS=6_mid_clouds
BASE_TEMPERATURE_AMBIENT=20
BASE_TEMPERATURE_ROAD=7
VARIATION_AMBIENT=2
VARIATION_ROAD=2
WIND_BASE_SPEED_MIN=0
WIND_BASE_SPEED_MAX=5
WIND_BASE_DIRECTION=45
WIND_VARIATION_DIRECTION=5

[DATA]
DESCRIPTION=Server 2
EXSERVEREXE=
EXSERVERBAT=
EXSERVERHIDEWIN=0
WEBLINK=
WELCOME_PATH=
"."\n";

        fwrite($myfile, $txt);
        $i++;
      }

    fclose($myfile);


    //Destino do Servidor de Teste
    //$destino = 'C:/Program Files (x86)/Steam/steamapps/common/assettocorsa/server/cfg/server_cfg.ini';
    //Destino do servidor de Producao
    $destino = 'C:/Gridonline/acPackage/server2/cfg/server_cfg.ini';

    unlink($destino);

    $origem = 'server_cfg.ini';

    copy($origem, $destino);

    unlink($origem);



     echo "<script>alert('Arquivo de config do servidor gerado com sucesso')</script>";   
     echo "<script>window.location = 'pilotos.php';</script>";
    }catch(PDOException $erro){   
      echo "<script>alert('Entry List não foi gerado')</script>"; 
      echo "<script>alert('Erro na linha: {$erro->getLine()}')</script>";   
    }   

?>



                        