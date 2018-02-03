<?php
include("functions.php");

//pega a variavel via post
$email = $_POST['email'];
//busca no db o usuario com o email 
$sqlpiloto = "Select  *
                                                from

                                                piloto
                                                where
                                                piloto.email =:email  ; ";                            
                            $stmt = $PDO->prepare($sqlpiloto); 
                            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                            $stmt->execute(); 

                            $resultpiloto = $stmt->fetchAll( PDO::FETCH_ASSOC );

//se tiver  + de 1 cadastrado
if($stmt->rowCount()==1){
	//faz um while para vc coloar os dados nas variavels
	while($Row_email = mysql_fetch_array($result)){
		$rowemail = $Row_email['email'];
		$rowsenha = $Row_email['senha'];
		}
		
//enviar um email para variavel email juntamente com a variável senha;
$mensage ="Você solicitou a recuperacao de senhha confira seu dados.";
$mensage .="E-mail= " . $rowemail;
$mensage .="Senha:" . $rowsenha;
mail($rowemail, "Grid Online, recuperação de senha", $mensage);

echo"<script>alert(Sua senha foi enviada para o e-mail indicado.),window.open('recuperar_senha_enviado.php','_self')</script>";


}else{
	
	
	echo"<script>alert('E-mail não cadastrado em nosso sistema'),window.open('recuperar_senha.php','_self')</script>";
	
}


?>