<?php

require_once 'init.php';

$PDO = db_connect(); 

$sqlcarmodel= "SELECT carmodel FROM carmodel WHERE idcarmodel =:carmodel"; 
$stmtcarmodel = $PDO->prepare($sqlcarmodel);
$stmtcarmodel->bindParam(':carmodel', $_POST['carmodel'] , PDO::PARAM_INT); 
$stmtcarmodel->execute();
$objcarmodel = $stmtcarmodel->fetchObject();

function Compress($source_path, $carmodel)
{
    // Normaliza o caminho do diretório a ser compactado
    $source_path = realpath($source_path);

    // Caminho com nome completo do arquivo compactado
    // Nesse exemplo, será criado no mesmo diretório de onde está executando o script
    $zip_file = __DIR__.'/'.$carmodel.'.zip';

    // Inicializa o objeto ZipArchive
    $zip = new ZipArchive();
    $zip->open($zip_file, ZipArchive::CREATE | ZipArchive::OVERWRITE);

    // Iterador de diretório recursivo
    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($source_path),
        RecursiveIteratorIterator::LEAVES_ONLY
    );

    foreach ($files as $name => $file) {
        // Pula os diretórios. O motivo é que serão inclusos automaticamente
        if (!$file->isDir()) {
            // Obtém o caminho normalizado da iteração corrente
            $file_path = $file->getRealPath();

            // Obtém o caminho relativo do mesmo.
            $relative_path = substr($file_path, strlen($source_path) + 1);

            // Adiciona-o ao objeto para compressão
            $zip->addFile($file_path, $relative_path);
        }
    }

    // Fecha o objeto. Necessário para gerar o arquivo zip final.
    $zip->close();

    // Retorna o caminho completo do arquivo gerado
    return $zip_file;
}

// O diretório a ser compactado PRODUCAO
$source_path = "C:/Gridonline/acPackage/content/cars/".$objcarmodel->carmodel."/skins/";
// Diretorio Server Teste
//$source_path = "C:/Program Files (x86)/Steam/steamapps/common/assettocorsa/content/cars/".$objcarmodel->carmodel."/skins";

$filename = Compress($source_path,$objcarmodel->carmodel);

echo $filename;

echo "<script>alert('Carset gerado com sucesso')</script>";
?>


