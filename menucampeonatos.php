<?php      
    if (!empty($_SESSION['user_name'])){        
      if ($_SESSION['user_nivel']=="A") {
        echo '
          <div class="row content">
            <div class="col-sm-4">
              <a href="./porschegt3/backend/porschegt3backend.php">
                <img src="img/porschegt3/porschegt3logo.png">
              </a>
              <div>
                <label for="insc">Campeonato encerrado</label>
              </div>            </div>
            <div class="col-sm-4">
              <a href="#">
                <img src="img/logogridonline.png">
              </a>
            </div>
            <div class="col-sm-4">
              <a href="./lotusgtc/backend/pilotos.php">
                <img src="img/lotus_evora_gtc/lotus_evora_gtclogo.png">
              </a>
              <div>
                <label for="insc">Inscrições abertas</label>
              </div>              
            </div>
          </div>                                               
             ';
     }
     if ($_SESSION['user_nivel']=="B") {
        echo '
          <div class="row content">
            <div class="col-sm-4">
              <a href="./porschegt3/backend/porschegt3backend.php">
                <img src="img/porschegt3/porschegt3logo.png">
              </a>
              <div>
                <label for="insc">Campeonato encerrado</label>
              </div>
            </div>
            <div class="col-sm-4">
              <a href="#">
                <img src="img/logogridonline.png">
              </a>
            </div>
            <div class="col-sm-4">
              <a href="./lotusgtc/backend/pilotos.php">
                <img src="img/lotus_evora_gtc/lotus_evora_gtclogo.png">
              </a>
              <div>
                <label for="insc">Inscrições abertas</label>
              </div> 
            </div>
          </div>                                        
             ';
     } 
     if ($_SESSION['user_nivel']=="I") {
        echo '
          <div class="row content">
            <div class="col-sm-4">
              <a href="./porschegt3/backend/porschegt3backend.php">
                <img src="img/porschegt3/porschegt3logo.png">
              </a>
              <div>
                <label for="insc">Campeonato encerrado</label>
              </div>
            </div>
            <div class="col-sm-4">
              <a href="#">
                <img src="img/logogridonline.png">
              </a>
            </div>
            <div class="col-sm-4">
              <a href="./lotusgtc/backend/pilotos.php">
                <img src="img/lotus_evora_gtc/lotus_evora_gtclogo.png">
              </a>
              <div>
                <label for="insc">Inscrições abertas</label>
              </div> 
            </div>
          </div>                    
             ';
     }                                                                                
    } if(empty($_SESSION['user_name'])) {
        echo '     
          <div class="row content">
            <div class="col-sm-4">
              <a href="./porschegt3/porschegt3.php">
                <img src="img/porschegt3/porschegt3logo.png">
              </a>
              <div>
                <label for="insc">Campeonato encerrado</label>
              </div>
            </div>
            <div class="col-sm-4">
              <a href="index.php">
                <img src="img/logogridonline.png">
              </a>
            </div>
            <div class="col-sm-4">
              <a href="./lotusgtc/lotusgtc.php">
                <img src="img/lotus_evora_gtc/lotus_evora_gtclogo.png">
              </a>
              <div>
                <label for="insc">Inscrições abertas</label>
              </div> 
            </div>
          </div>                    ';
    }                  

?> 

      