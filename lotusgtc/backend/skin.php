<?php
$PDO = new PDO("mysql:host=localhost;dbname=gridonline;charset=utf8mb4", "root", ""); 
?>

<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">

      $(document).ready(function(){         
        $("select[name=carmodel]").change(function(){
            $("select[name=skin]").html('<option value="0">Carregando...</option>');
              $.post("inscrever.php",
                    {carmodel:$(this).val()},
                      function(valor){
                      $("select[name=skin]").html(valor);
                    }
          );
          });
      });

</script>
<title></title>
</head>
<body>
<label>
   <span>Carmodel</span>
		<select  name="carmodel" >
		        <option id="carmodel" value="-1">Escolha o Carro</option>
		        <!-- Aqui você preenche a combo com as cidades existentes na sua base-->
		        <?php
		     $sql = "SELECT * FROM  carmodel;";
		         try{
		                $query = $PDO->query($sql);
					    $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
			}catch(PDOException $erro){
			    echo 'Erro '.$erro->getMessage();	
			 }
		               foreach($resultado as $result){
		?>
		        <option value="<?php echo $result['idcarmodel']; ?>"><?php echo $result['carmodel']; ?></option>
		        <?php 
		}//foreach
		?>
		</select>
		
</label>

	      <label>
	       	<span>Skin <p id="demo"></p> </span>
	       	
	        <select name="skin">
	             <option value="0" disabled="disabled">Escolha o skin</option>
	        </select>
	      </label>

</body>
</html>



