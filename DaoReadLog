1 <?php
2  // Abre o Arquvio no Modo r (para leitura)
3  $arquivo = fopen ('arquivo-texto.txt', 'r');
4	
5  // Lê o conteúdo do arquivo 
6  while(!feof($arquivo))
7  {
8   //Mostra uma linha do arquivo
9   $linha = fgets($arquivo, 1024);
10   echo $linha.'<br />';
11  }
12
13  // Fecha arquivo aberto
14  fclose($arquivo);
15 ?>