<?php  
 if (!empty($_SESSION['user_name']))
 {
  if($_SESSION['user_nivel']=="A") {
                    echo '
                      <div class="row content">
                        <div class="col-sm-4">
                          <a href="./porschegt3/backend/porschegt3backend.php">
                            <img src="img/porschegt3/porschegt3logo.png">
                          </a>
                        </div>
                        <div class="col-sm-4">
                          <a href="index.php">
                            <img src="img/logogridonline.jpg">
                          </a>
                        </div>
                        <div class="col-sm-4">
                          <a href="#">
                            <img src="img/lambosf/lambosflogo.png">
                          </a>
                        </div>
                      </div>
                    ';                    
                } 
  if ($_SESSION['user_nivel']=="B"){                 
                    echo '
                      <div class="row content">
                        <div class="col-sm-4">
                          <a href="./porschegt3/backend/porschegt3backend.php">
                            <img src="img/porschegt3/porschegt3logo.png">
                          </a>
                        </div>
                        <div class="col-sm-4">
                          <a href="#">
                            <img src="img/logogridonline.jpg">
                          </a>
                        </div>
                        <div class="col-sm-4">
                          <a href="#">
                            <img src="img/lambosf/lambosflogo.png">
                          </a>
                        </div>
                      </div>
                    ';  
                }
} else{
                    echo '
                      <div class="row content">
                        <div class="col-sm-4">
                          <a href="./porschegt3/porschegt3.php">
                            <img src="img/porschegt3/porschegt3logo.png">
                          </a>
                        </div>
                        <div class="col-sm-4">
                          <a href="index.php">
                            <img src="img/logogridonline.jpg">
                          </a>
                        </div>
                        <div class="col-sm-4">
                          <a href="#">
                            <img src="img/lambosf/lambosflogo.png">
                          </a>
                        </div>
                      </div>
                    ';  
}




?>        