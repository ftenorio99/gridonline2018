        
    <nav class="navbar navbar-default navbar-fixed-top">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
              </button>
              <a class="navbar-brand" href="porschegt3backend.php"> <img src="../../img/porschegt3/porschegt3logo.png" width="100" height="30" alt=""/> </a>                
            </div>

            <div class="collapse navbar-collapse" id="myNavbar">
              <ul class="nav navbar-nav">                  

                <?php         
                  if (!empty($_SESSION['user_name'])){
                      if ($_SESSION['user_nivel']=="A") {
                      echo 
                        "                
                        <li><a href='../../panel.php'>Início</a></li>                                                                          
                        <li class='dropdown'>
                          <a class='dropdown-toggle' data-toggle='dropdown' href='#'>Piloto no Torneio
                          <span class='caret'></span></a>
                          <ul class='dropdown-menu'>
                            <li><a href='frminseririnscricao.php'>Inserir Piloto no Torneio</a></li>
                            <li><a href='frmatualizarinscricao.php'>Atualizar Piloto no Torneio</a></li>
                            <li><a href='frmexcluirinscricao.php'>Excluir Piloto no Torneio</a></li>                            
                          </ul>
                        </li>                         
                        <li><a href='gravarentrylist.php'>Gerar Entry List no servidor</a></li> 
                        ";
                      } 
                      if ($_SESSION['user_nivel']=="B") {
                      echo 
                        "                
                        <li><a href='../../panel.php'>Início</a></li>                                                     
                        <li class='dropdown'>
                          <a class='dropdown-toggle' data-toggle='dropdown' href='#'>Piloto no Torneio
                          <span class='caret'></span></a>
                          <ul class='dropdown-menu'>
                            <li><a href='frminscrevertorneio.php'>Inscrever no Torneio</a></li>
                            <li><a href='frmatualizarinscricao.php'>Atualizar Piloto no Torneio</a></li>
                            <li><a href='frmexcluirinscricao.php'>Excluir Piloto no Torneio</a></li>
                          </ul>
                        </li> 
                        ";
                      }                                           
                    }                  
                ?>                
              </ul>

              <ul class="nav navbar-nav navbar-right">                
                  <?php
                    if (!empty($_SESSION['user_name'])){
                     echo '<li><a href="#"><span class="glyphicon glyphicon-user"></span> '.$_SESSION['user_name'].'</a></li>';    
                     echo '<li><a href="../../logout.php"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>';
                    } else {
                     echo '<li><a href="../../form-login.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>';                 
                    }              
                  ?>                                             
              </ul>   
            </div>
          </div>
        </nav>        

        <div class="jumbotron" id="div-back-image">
          <div class="container text-center">
            <div align="center">
            <br>          
            <br>          
            <br>          
            <br>          
            <br>
            <br>
            </div>
          </div>
        </div>