    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">

          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>                        
          </button>                
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">                                    
            <?php      
                if (!empty($_SESSION['user_name'])){        
                  if ($_SESSION['user_nivel']=="A") {
                    echo "
                        <li><a href='panel.php'>Início</a></li>
                        <li><a href='frmnumeracaooficial.php'>Alterar Número Asseto Corsa</a></li> 
                        <li><a href='frminserirskin.php'>Inserir Skin</a></li>
                        <li><a href='frmextrairskin.php'>Extrair Skins</a></li>
                        <li><a href='frminserirpiloto.php'>Atualizar Piloto</a></li>
                        <li><a href='lerarquivosresult.php'>Ler arquivos do diretório result</a></li>             
                        <li><a href='pilotos.php'>Lista de pilotos</a></li>
                        <li><a href='frminserirequipe.php'>Inserir Equipe</a></li>
                        <li class='dropdown'>
                          <a class='dropdown-toggle' data-toggle='dropdown' href='#'>Carmodel
                          <span class='caret'></span></a>
                          <ul class='dropdown-menu'>
                            <li><a href='frmcarmodel.php'>Inserir Carmodel</a></li>
                          </ul>
                        </li>                            
                         ";
                 }
                 if ($_SESSION['user_nivel']=="B") {
                    echo "
                        <li><a href='panel.php'>Início</a></li>
                        <li><a href='frmnumeracaooficial.php'>Alterar Número</a></li> 
                        <li><a href='frminserirskin.php'>Enviar Skin</a></li>                        
                        <li><a href='frminserirpiloto.php'>Atualizar Dados</a></li>                        
                         ";
                 } 
                 if ($_SESSION['user_nivel']=="I") {
                    echo "
                        <li><a href='index.php'>Início</a></li>                       
                         ";
                 }                                                                                
                } if(empty($_SESSION['user_name'])) {
                    echo "<li><a href='index.php'>Início</a></li>
                          <li><a href='frminscricao.php'>Inscrição</a></li>";
                }                  

            ?>  
          </ul>         

          <ul class="nav navbar-nav navbar-right">            
              <?php
                if (!empty($_SESSION['user_name'])){
                 echo '<li><a href="#"><span class="glyphicon glyphicon-user"></span> '.$_SESSION['user_name'].'</a></li>';    
                 echo '<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>';
                } else {

                 echo '<li><a href="form-login.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>';                 
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