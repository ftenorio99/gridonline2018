<?php
require_once 'init.php';

$PDO = db_connect(); 




$sql = "SELECT data FROM `pistatorneio` WHERE data>CURRENT_DATE LIMIT 1";
$select = $PDO->query( $sql );
$result = $select->fetchAll( PDO::FETCH_ASSOC );

foreach($result as $row)            
                {   
                  $data = $row["data"];
                }

?>

  <script type="text/javascript">
      var dataproxima = "<?php print $data; ?>";

      $(function( ) {

        var endDate = dataproxima+", 19:00:00";
 
        $('.countdown.simple').countdown({ date: endDate });
 
        $('.countdown.styled').countdown({
          date: endDate,
          render: function(data) {
            $(this.el).html("<div>" + this.leadingZeros(data.days, 2) + " dias " + this.leadingZeros(data.hours, 2) + " horas " + this.leadingZeros(data.min, 2) + " min " + this.leadingZeros(data.sec, 2) + " seg</div>");

        if(this.leadingZeros(data.days, 2)=="00" && this.leadingZeros(data.hours, 2)=="00" && this.leadingZeros(data.min, 2)=="00" && this.leadingZeros(data.sec, 2) == "00") {
        alert("fim da contagem");
        }
  

        }
        });
 
        $('.countdown.callback').countdown({
          date: +(new Date) + 10000,
          render: function(data) {
            $(this.el).text(this.leadingZeros(data.sec, 2) + " sec");
          },
          onEnd: function() {
            $(this.el).addClass('ended');
          }
        }).on("click", function() {
          $(this).removeClass('ended').data('countdown').update(+(new Date) + 10000).start();
        });
 
        // End time for diff purposes
        var endTimeDiff = new Date().getTime() + 15000;
        // This is server's time
        var timeThere = new Date();
        // This is client's time (delayed)
        var timeHere = new Date(timeThere.getTime() - 5434);
        // Get the difference between client time and server time
        var diff_ms = timeHere.getTime() - timeThere.getTime();
        // Get the rounded difference in seconds
        var diff_s = diff_ms / 1000 | 0;
 
        var notice = [];
        notice.push('Server time: ' + timeThere.toDateString() + ' ' + timeThere.toTimeString());
        notice.push('Your time: ' + timeHere.toDateString() + ' ' + timeHere.toTimeString());
        notice.push('Time difference: ' + diff_s + ' seconds (' + diff_ms + ' milliseconds to be precise). Your time is a bit behind.');
 
        $('.offset-notice').html(notice.join('<br />'));
 
        $('.offset-server .countdown').countdown({
          date: endTimeDiff,
          offset: diff_s * 1000,
          onEnd: function() {
            $(this.el).addClass('ended');
          }
        });
 
        $('.offset-client .countdown').countdown({
          date: endTimeDiff,
          onEnd: function() {
            $(this.el).addClass('ended');
          }
        });
 
      });
  </script>
 

<?php
    $sql = "SELECT pistatorneio.data, pista.nome, torneio.nome as torneionome FROM pistatorneio INNER JOIN pista ON  pistatorneio.idpista = pista.idpista INNER JOIN torneio on pistatorneio.idtorneio = torneio.idtorneio WHERE pistatorneio.data>=CURRENT_DATE  order by pistatorneio.data LIMIT 1";

    $select = $PDO->query( $sql );
    $result = $select->fetchAll( PDO::FETCH_ASSOC );

    foreach($result as $row)            
          {   
            $nomepista = $row["nome"];
            $datapista = $row["data"];
            $nometorneio = $row["torneionome"];
          }
  $date = date_create($datapista);
  $data = date_format( $date ,"d/m/Y");          
?>



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
                        <li><a href='lerarquivosresult.php'>Ler arquivos do diretório result</a></li>

                        <li class='dropdown'>
                          <a class='dropdown-toggle' data-toggle='dropdown' href='#'>Skin
                          <span class='caret'></span></a>
                          <ul class='dropdown-menu'>
                            <li><a href='frminserirskin.php'>Inserir Skin</a></li>

                          </ul>
                        </li>

                        <li class='dropdown'>
                          <a class='dropdown-toggle' data-toggle='dropdown' href='#'>Piloto
                          <span class='caret'></span></a>
                          <ul class='dropdown-menu'>
                            <li><a href='pilotos.php'>Lista de pilotos</a></li>
                            <li><a href='frminserirpiloto.php'>Atualizar Piloto</a></li>
                          </ul>
                        </li>  

                        <li class='dropdown'>
                          <a class='dropdown-toggle' data-toggle='dropdown' href='#'>Equipe
                          <span class='caret'></span></a>
                          <ul class='dropdown-menu'>
                            <li><a href='frminserirequipe.php'>Inserir Equipe</a></li>
                            <li><a href='frmalterarequipe.php'>Alterar Equipe</a></li>
                            <li><a href='frmexcluirequipe.php'>Excluir Equipe</a></li>
                          </ul>
                        </li>                          


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
                        <li><a href='panel.php'>Início</a></li> 
                        <li><a href='frminserirskin.php'>Enviar Skin</a></li>                        
                        <li><a href='frminserirpiloto.php'>Atualizar Dados</a></li> 

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
                echo '<li><a href="#"><span></span>Próxima corrida: '.$nometorneio.' - '.$nomepista.' - '.$data.' </a></li>';              
                echo '<li><a href="#"><span class="glyphicon glyphicon-user"></span> '.$_SESSION['user_name'].'</a></li>';    
                echo '<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>';
                } else {             
                 echo '<li><a href="#"><span></span>Próxima corrida: '.$nometorneio.' - '.$nomepista.' - '.$data.' </a></li>';                 
                // echo '<li ><a href="#"><span class="countdown styled"></span></a></li>';
                 
                 echo '<li><a href="form-login.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>';                 
                }              
              ?>                  
          </ul>         
        </div>
      </div>
    </nav>

<!--     <div class="jumbotron" id="div-back-image">
      <div class="container text-center">
        <div align="center"> -->

            <br>
            <br>          
            <br>
            <br> 
            

          
  <!--       </div>
      </div>
    </div> -->

