<?php

$path = "uploads/";
$patchskin = "C:/xampp/htdocs/gridonline/img/porschegt3/skin/";
$diretorio = "C:/xampp/htdocs/gridonline/uploads/";


function copiar_diretorio($diretorio, $destino, $ver_acao ){


  if ($destino{strlen($destino) - 1} == '/'){
     $destino = substr($destino, 0, -1);
    }
  if (!is_dir($destino)){
     if ($ver_acao){
        echo "Criando diretorio {$destino}<br>";
        }
     mkdir($destino, 0755);
  }
     
  $folder = opendir($diretorio);     
  while ($item = readdir($folder)){
     if ($item == '.' || $item == '..'){
        continue;
        }
     if (is_dir("{$diretorio}/{$item}")){

        $dir=$diretorio."/".$item;
        $listDir = scandir($dir, 1);// Recebendo todos os dados do diretório
        $total = count($listDir);//Verificando total do array
        for($i = 0; $i < $total; $i++){//Percorre todo o array
            if(is_dir($listDir[$i])){//Verifica se é arquivo ou diretório e transfere só os arquivos
            } else {
            copy($dir."/".$listDir[$i], $destino."/".$listDir[$i]);
            }

        }

        //Implementação antiga
        // copy_dir("{$diretorio}/{$item}", "{$destino}/{$item}", $ver_acao);

     }else{
        if ($ver_acao){
           echo "Copiando {$item} para {$destino}"."<br>";
        }
        copy("{$diretorio}/{$item}", "{$destino}/{$item}");
        }

  }
}

function deleteDirectory($dir) {
    if (!file_exists($dir)) {
        return true;
    }

    if (!is_dir($dir)) {
        return unlink($dir);
    }

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }

    }

    return rmdir($dir);
}

$dh = opendir($path);

try {

    // loop que busca todos os arquivos até que não encontre mais nada
    while (false !== ($filename = readdir($dh))) { 
        
            if (substr($filename,-3) == "zip"){

                $arquivo = $diretorio.$filename;

                $za = new ZipArchive();

                $za->open($arquivo);
                
                $nomedir = substr($filename, 0, -4);

                deleteDirectory($path.$nomedir); 

                mkdir($nomedir);

                $za->extractTo($nomedir); 
                $za->close();      
                
                copiar_diretorio($nomedir, $diretorio.$nomedir, $ver_acao = false);

                if (is_dir($patchskin.$nomedir)) {
                    copy($diretorio.$nomedir."/preview.jpg", $patchskin.$nomedir."/preview.jpg");
                } else{
                    mkdir($patchskin.$nomedir, 0755);
                    copy($diretorio.$nomedir."/preview.jpg", $patchskin.$nomedir."/preview.jpg");
                }
                
                deleteDirectory($nomedir);  
                unlink($diretorio.$filename);



            } 
        }
     
 } catch (Exception $e) {
    echo "<script>alert('A extração não foi executada')</script>"; 
    echo "<script>window.location = 'frmextrairskins.php';</script>"; 
 } 


echo "<script>alert('Todos os arquivos foram extraídos')</script>"; 
echo "<script>window.location = 'panel.php';</script>"; 

?>
