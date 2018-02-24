<?php
// inclui o arquivo de inicialização
require 'init.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'PHPMailer/src/Exception.php';
require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';

// echo (extension_loaded('openssl')?'SSL loaded':'SSL not loaded')."\n";
// echo "<br>";

if ($_POST['RecuperarSenha']=='RecuperarSenha') {


			//busca no db o usuario com o email 
			$PDO=db_connect();
			$sqlpiloto = "Select  *
                                    from

                                    piloto
                                    where
                                    email =:email  ; ";                            
            $stmt = $PDO->prepare($sqlpiloto); 
            $stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
            $stmt->execute(); 
            $resultpiloto = $stmt->fetchAll( PDO::FETCH_ASSOC );

            
            	//se tiver  + de 1 cadastrado
            
            	if($stmt->rowCount()==1){

			            foreach($resultpiloto as $row){
			            	$rowemail= $row['email'];
			            	$rowsenha= $row['senha'];

							
							//enviar um email para variavel email juntamente com a variável senha;
							$mensage ='
							Você solicitou a recuperação de senha confira seu dados.
							E-mail: '.$rowemail.'
							Senha: '.$rowsenha;
						

							
							/**
							 * This example shows settings to use when sending via Google's Gmail servers.
							 * This uses traditional id & password authentication - look at the gmail_xoauth.phps
							 * example to see how to use XOAUTH2.
							 * The IMAP section shows how to save this message to the 'Sent Mail' folder using IMAP commands.
							 */

							//Create a new PHPMailer instance
							$mail = new PHPMailer;
							//Tell PHPMailer to use SMTP
							$mail->isSMTP();
							//Enable SMTP debugging
							// 0 = off (for production use)
							// 1 = client messages
							// 2 = client and server messages
							$mail->SMTPDebug = 0;
							//Set the hostname of the mail server
							$mail->Host = 'tls://smtp.gmail.com:587';
							// use
							// $mail->Host = gethostbyname('smtp.gmail.com');
							// if your network does not support SMTP over IPv6
							//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
							$mail->Port = 587;

							$mail->SMTPOptions = array(
							    'ssl' => array(
							        'verify_peer' => false,
							        'verify_peer_name' => false,
							        'allow_self_signed' => true
							    )
							);
							//Set the encryption system to use - ssl (deprecated) or tls
							$mail->SMTPSecure = 'tls';
							//Whether to use SMTP authentication
							$mail->SMTPAuth = true;
							//Username to use for SMTP authentication - use full email address for gmail
							$mail->Username = "gridonline2018@gmail.com";
							//Password to use for SMTP authentication
							$mail->Password = "Grid@2018!";
							//Set who the message is to be sent from
							$mail->setFrom('gridonline2018@gmail.com', 'gridonline2018');
/*							//Set an alternative reply-to address
							$mail->addReplyTo('gridonline2018@gmail.com', 'gridonline2018');*/
							//Set who the message is to be sent to
							$mail->addAddress($rowemail, $_POST['nome']);
							//Set the subject line
							$mail->Subject = 'GridOnline - Recuperacao de Senha';
/*							//Read an HTML message body from an external file, convert referenced images to embedded,
							//convert HTML into a basic plain-text alternative body
							$mail->msgHTML(file_get_contents('contents.html'), __DIR__);*/
							//Replace the plain text body with one created manually

							$mail->Body = $mensage;

							$mail->AltBody = 'This is a plain-text message body';
							//Attach an image file
/*							$mail->addAttachment('images/phpmailer_mini.png');
							//send the message, check for errors*/
							if (!$mail->send()) {
								echo "<script>alert('Email não cadastrado no sistema')</script>";
							    //echo "Mailer Error: " . $mail->ErrorInfo;
							    echo "<script>window.location = 'index.php';</script>";
							} else {
								echo "<script>alert('Sua senha foi enviada para o e-mail indicado')</script>";  
								echo "<script>window.location = 'index.php';</script>";	
							}

			            }			
				} 
}

if ($_POST['Entrar']=='Entrar') {
	// resgata variáveis do formulário
			$email = isset($_POST['email']) ? $_POST['email'] : '';
			$password = isset($_POST['password']) ? $_POST['password'] : '';
			 
			if (empty($email) || empty($password))
			{
			    echo "Informe email e senha";
			    exit;
			}
			 
			// cria o hash da senha
			//$passwordHash = make_hash($password);
			 
			$PDO = db_connect();
			 
			$sql = "SELECT idpiloto, name, status FROM piloto WHERE email = :email AND senha = :senha";
			$stmt = $PDO->prepare($sql);
			 
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':senha', $password);
			 
			$stmt->execute();
			 
			$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
			 
			if ($stmt->rowCount() <= 0)
			{
				echo "<script>alert('Email ou senha incorretos')</script>";  
				echo "<script>window.location = 'form-login.php';</script>";	    
			    exit;
			}
			 
			// pega o primeiro usuário
			$user = $users[0];
			 
			session_start();
			$_SESSION['logged_in'] = true;
			$_SESSION['user_id'] = $user['idpiloto'];
			$_SESSION['user_name'] = $user['name'];
			$_SESSION['user_nivel'] = $user['status'];
			 
			if ($_SESSION['user_nivel']=="A" || $_SESSION['user_nivel']=="B" || $_SESSION['user_nivel']=="I"){
			 	header('Location: panel.php');
			 } else {
			 	header('Location: index.php');
			 }
}

?>



