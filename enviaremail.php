<?php
                          
 require_once 'init.php';

 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;

 require_once 'PHPMailer/src/Exception.php';
 require_once 'PHPMailer/src/PHPMailer.php';
 require_once 'PHPMailer/src/SMTP.php';

 $PDO = db_connect(); 

        // Define busca a ser realizada no MySQL
        $sql = "select 
                gridonline.piloto.name AS name,
                gridonline.piloto.email AS email,
                gridonline.pilototorneio.idtorneio

                from (gridonline.piloto join gridonline.pilototorneio on((gridonline.pilototorneio.idpiloto = gridonline.piloto.idpiloto)))

                WHERE

                gridonline.pilototorneio.idtorneio=:torneio
                AND
                gridonline.piloto.email<>''";
                      
                      $sth = $PDO->prepare($sql);   
                      $sth->bindParam(':torneio', $_POST["torneio"], PDO::PARAM_STR);                             
                      $sth->execute(); 
                      $result = $sth->fetchAll( PDO::FETCH_ASSOC );   
  
                      //Create a new PHPMailer instance
                      $mail = new PHPMailer;

                      foreach($result as $row)
                      {                       

                         $mail->AddBCC($row["email"]);

                      }


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
                        //Set an alternative reply-to address
                        $mail->addReplyTo('gridonline2018@gmail.com', 'gridonline2018');
                        //Set who the message is to be sent to
                        //$mail->addAddress($row["email"]);
                        //Set the subject line
                        $mail->Subject = $_POST["titulo"];
                        //Read an HTML message body from an external file, convert referenced images to embedded,
                        //convert HTML into a basic plain-text alternative body
                        // $mail->msgHTML(file_get_contents('contents.html'), __DIR__);
                        //Replace the plain text body with one created manually

                        $mail->Body = $_POST["mensagem"];

                        $mail->AltBody = 'This is a plain-text message body';
                        //Attach an image file
                        //$mail->addAttachment('images/phpmailer_mini.png');
                        //send the message, check for errors
                        //sleep(10); 





/*
                     
        */
      
      if (!$mail->send()) {
        echo "<script>alert('Email não cadastrado no sistema')</script>";
          //echo "Mailer Error: " . $mail->ErrorInfo;
          echo "<script>window.location = 'panel.php';</script>";
      } 

        echo "<script>alert('E-mail enviado com sucesso')</script>";   
        echo "<script>window.location = 'panel.php';</script>"; 

?>
