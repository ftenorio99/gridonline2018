<?php
require_once 'init.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'PHPMailer/src/Exception.php';
require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';



function gerarSenha($tamanho=6, $forca=4) {
	$vogais = 'aeuy';
	$consoantes = 'bdghjmnpqrstvz';
	if ($forca >= 1) {
		$consoantes .= 'BDGHJLMNPQRSTVWXZ';
	}
	if ($forca >= 2) {
		$vogais .= "AEUY";
	}
	if ($forca >= 4) {
		$consoantes .= '23456789';
	}
	if ($forca >= 8 ) {
		$vogais .= '@#$%';
	}

	$senha = '';
	$alt = time() % 2;
	for ($i = 0; $i < $tamanho; $i++) {
		if ($alt == 1) {
			$senha .= $consoantes[(rand() % strlen($consoantes))];
			$alt = 0;
		} else {
			$senha .= $vogais[(rand() % strlen($vogais))];
			$alt = 1;
		}
	}
	return $senha;
}

$senha = gerarSenha(10,8);

$PDO = db_connect(); 

$sql= "SELECT * FROM piloto WHERE email = :email";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':email', $_POST['email'] , PDO::PARAM_STR); 
$stmt->execute();
if($stmt->rowCount()==1){

	echo "<script>alert('E-mail já cadastrado')</script>";   
    echo "<script>window.location = 'frminscricao.php';</script>"; 

} else {



if (!empty($_POST["guid"]) && !empty($_POST["nome"]) && !empty($_POST["email"]) && !empty($_POST["celular"]) )

				{  

					$sql= "SELECT * FROM piloto WHERE guid = :guid";
					$stmt = $PDO->prepare($sql);
					$stmt->bindParam(':guid', $_POST['guid'] , PDO::PARAM_STR); 
					$stmt->execute();
					


						if($stmt->rowCount()==1){		

							$status = "B";
							$sql2 = "UPDATE piloto SET                       
								            email = :email,  
								            telefone = :telefone,
								            senha =:senha,
								            status =:status 					            
								            WHERE guid= :guid";          


								$stmtp = $PDO->prepare($sql2);                                  			       
								$stmtp->bindParam(':guid', $_POST['guid'], PDO::PARAM_STR); 			
								$stmtp->bindParam(':email', $_POST['email'], PDO::PARAM_STR);			
								$stmtp->bindParam(':telefone', $_POST['celular'] , PDO::PARAM_STR); 					
								$stmtp->bindParam(':senha', $senha , PDO::PARAM_STR); 					
								$stmtp->bindParam(':status', $status , PDO::PARAM_STR);
								$stmtp->execute();  

								$rowemail=$_POST['email'];
								$rowsenha=$senha;

								//enviar um email para variavel email juntamente com a variável senha;
								$mensage ='
								Seu Cadastro foi efetuado com sucesso, este é seu e-mail de login e sua senha.
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
								$mail->Subject = 'GridOnline - Dados de Acesso ao portal';
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
								} 

								echo "<script>alert('Cadastro inserido com sucesso, sua senha foi enviada para o e-mail cadastrado')</script>";   
						    	echo "<script>window.location = 'index.php';</script>"; 

							
						} else {
							
								$status="I";
								$sql2 = "INSERT INTO piloto (
								name
								,email
								,guid					
								,telefone
								,status
								,senha
								) VALUES (
								:name,
								:email,
								:guid,				
								:telefone ,
								:status ,
								:senha
					            ) ";          


								$stmtp = $PDO->prepare($sql2);                                  			       
								$stmtp->bindParam(':name', $_POST['nome'], PDO::PARAM_STR);
								$stmtp->bindParam(':email', $_POST['email'], PDO::PARAM_STR);			
								$stmtp->bindParam(':guid', $_POST['guid'], PDO::PARAM_STR);
								$stmtp->bindParam(':telefone', $_POST['celular'] , PDO::PARAM_STR); 
								$stmtp->bindParam(':status', $status , PDO::PARAM_STR);
								$stmtp->bindParam(':senha', $senha , PDO::PARAM_STR);  
								$stmtp->execute();  

								$rowemail=$_POST['email'];
								$rowsenha=$senha;

								//enviar um email para variavel email juntamente com a variável senha;
								$mensage ='
								Seu Cadastro foi efetuado com sucesso, este é seu e-mail de login e sua senha.
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
								$mail->Subject = 'GridOnline - Dados de Acesso ao portal';
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
								} 

								echo "<script>alert('Cadastro inserido com sucesso, sua senha foi enviada para o e-mail cadastrado')</script>";   
						    	echo "<script>window.location = 'index.php';</script>"; 


						}

				} else {
						echo "<script>alert('Todos os campos são obrigatórios')</script>";   
					    echo "<script>window.location = 'frminscricao.php';</script>"; 
				}

}

?>