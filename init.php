<?php
 
// constantes com as credenciais de acesso ao banco MySQL
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'gridonline');
 
// habilita todas as exibições de erros
//ini_set('display_errors', true);
ini_set( 'display_errors', 0 ); // deve ser definida para zero (0) em ambiente de produção

error_reporting(E_ALL);

// tempo máximo de execução de um script
set_time_limit( 60 );

// timezone
date_default_timezone_set( 'America/Sao_Paulo' );
 
// inclui o arquivo de funçõees
require_once 'functions.php';


?>

 
