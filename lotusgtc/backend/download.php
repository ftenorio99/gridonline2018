<?php
 
  if(!isset($_SESSION)){
      session_start();
      require_once '../../init.php';
      require '../../check.php';
    }

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
          <div><h2>GridOnline Bitdefender Porsche SuperCup - Downloads</h2></div>   
          <hr>
        </div> 
  
        <div class="container">
                  <div class="row" >
                    <h3>GridOnline Grid Online Lotus Trophy - Pistas</h3>
                    <h4>
                      <a href="http://www.racedepartment.com/downloads/donington-park.3031/">Grid Online Lotus Trophy - Donington Park </a>
                    </h4>  
                    <h4>
                      <a href="http://www.racedepartment.com/downloads/croft-circuit.16806/">Grid Online Lotus Trophy - Croft</a>
                    </h4>         
                    <h4>
                      <a href="https://actrackrebootproject.wixsite.com/ac-track-re-boot/snetterton2017">Grid Online Lotus Trophy - Snetterton</a>
                    </h4> 
                    <h4>
                      <a href="https://actrackrebootproject.wixsite.com/ac-track-re-boot/knockhillcircuit2017">Grid Online Lotus Trophy - Knockhill</a>
                    </h4>
                    <h4>
                      <a href="https://www.racedepartment.com/downloads/goodwood-circuit.17228/">Grid Online Lotus Trophy - Goodwood</a>
                    </h4>                      

                                       
                    <hr>                                        
                    <h3>GridOnline Grid Online Lotus Trophy - Apps</h3>
                      <h4>
                        <a href="http://n-e-y-s.de/downloads/ptracker/stable/ptracker-V3.4.0.exe">Ptracker v3.4.0</a>
                      </h4>                     
                    <hr>  
                    <h3>GridOnline Grid Online Lotus Trophy - Skin</h3>
                      <h4>
                        <a href="https://mega.nz/#!AtY2yYLb!MXhsXncn9GHMOmpaMtggH6RteP0IYLrGoR8WFnk6Ves">Skin Template 2018 - Grid Online Lotus Trophy</a>
                      </h4>                       
                      <h4>
                        <a href="https://mega.nz/#!s1QFRDTK!Kf8dR3kKg6bG2SvjZvCfWSsmqIjx-RIjM4tQ0iJ2Ijg">Skin Pack - Grid Online Lotus Trophy</a>
                      </h4> 
                  </div>
        </div>       

</body>

</html>