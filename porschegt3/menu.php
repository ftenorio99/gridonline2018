        
    <nav class="navbar navbar-default navbar-fixed-top">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
              </button>
              <a class="navbar-brand" href="porschegt3.php"> <img src="../img/porschegt3/porschegt3logo.png" width="100" height="30" alt=""/> </a>                
            </div>

            <div class="collapse navbar-collapse" id="myNavbar">
              <ul class="nav navbar-nav">    

                <li><a href="../index.php">Início</a></li>  
                <li><a href="racereportporschegt3.php">Race Report</a></li>                   
                <li><a href="pilotos.php">Pilotos</a></li>
                <li><a href="classificacao.php">Classificação</a></li>
                <li><a href="porschegt3resultados.php">Calendário/Resutados</a></li>
                <li><a href="download.php">Downloads</a></li>
                <li><a href="#">Regulamento</a></li>
                <li><a href="#">Pagamento de Inscrição</a></li>
                <li><a href="livetiming.php">Livetiming</a></li>      
                <?php         
                  if (!empty($_SESSION['user_name'])){
                      if ($_SESSION['user_nivel']=="A") {
                      echo 
                        "
                        <li><a href='frminserirpiloto.php'>Inscrição de Piloto</a></li>                 
                        <li><a href='frminseririnscricao.php'>Inscrição do Piloto no Torneio</a></li>  
                        <li><a href='frmatualizarinscricao.php'>Atualizar inscrição do Piloto no Torneio</a></li>  
                        <li><a href='gravarentrylist.php'>Gerar Entry List no servidor</a></li> 
                        ";
                      }  
                      if ($_SESSION['user_nivel']=="B") {
                      echo 
                        "        
                        <li><a href='frminserirpiloto.php'>Inscrição de Piloto</a></li>                 
                        <li><a href='frminseririnscricao.php'>Inscrição do Piloto no Torneio</a></li>  
                        <li><a href='frmatualizarinscricao.php'>Atualizar inscrição do Piloto no Torneio</a></li>  
                        ";
                      }                                          
                    }                  
                ?>                
              </ul> 
            </div>
          </div>
        </nav>        
