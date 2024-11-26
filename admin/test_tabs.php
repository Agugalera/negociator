<?php 

$empresas = array('alfa', 'beta')

foreach($empresas as $empresa) {

	$query = "SELECT * FROM dataEquipos WHERE universo = {$i} AND empresa = '{$empresa}'";

	$result = mysql_query($query, $connection);

	confirm_query ($result); 

	$num_rows = mysql_num_rows($result);

	$data = mysql_fetch_array($result);

	?>

	<div id="tabs">

		<ul>

		<?php for ($j=1; $j<=($num_rows+1); $j++) { ?>

			<li><a href="#tabs-<?php echo $i."-".$j;?>">Integrante <?php echo $j;?></a></li>

		<?php } ?>

		</ul>

		<?php 

		

		for ($j=1; $j<=($num_rows+1); $j++) { 

			$query = "SELECT * FROM dataEquipos WHERE universo = {$i} AND empresa = '{$empresa}' AND integrante = {$i} LIMIT 1";

			$result = mysql_query($query, $connection);

			confirm_query ($result); 

			$result = mysql_fetch_array($result);

		?>

			<div id="tabs-<?php echo $i."-".$j;?>" class="integrante">

			  <p>Nombre y apellido: <?php echo $result['nombre']." ".$result['apellido'];?></p>

			  <p>Estilo Personal: <?php echo $result['estilo'];?></p>

			  <p>Rol: <?php echo $result['rol'];?></p>

			  <p>Breve descripci&oacute;n del rol: <?php echo $result['rol_desc'];?></p>

			</div>

		<?php } ?>

	</div>

<?php } ?>



