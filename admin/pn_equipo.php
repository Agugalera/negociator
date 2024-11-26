<?php $root="../";
	require_once($root."includes/session.php"); 
	require_once($root."includes/connect.php"); 
	require_once($root."includes/functions.php");

	if (!logged_in_admin()) {
		redirect_to("login.php");
	}
	$sel1a = "pn";
	
?>	
<?php  //PROCESAMIENTO INICIAL
?>
<?php //DATA INICIAL
	$query = "SELECT * FROM tablaGeneral";
	$current = mysql_query($query, $connection);
	confirm_query($current);	
	$current = mysql_fetch_array($current);
?>
<?php include($root."includes/us_docheader.php");?>
<?php include($root."includes/jquery.php");?>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
<!-- <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />-->
<script>
</script>
<script>
	$(function() {
		$( "#tabs" ).tabs();
	});
</script>

</head>

<body>

<div id="container">
	<?php include($root."includes/admin_header.php");?>
	<?php include($root."includes/admin_menu.php");?>
        
        <div id="content">
        	<div id="wrap">
                <div class="titulos">
					<p>Prenegociacion / El equipo <?php echo ucfirst(substr($_GET['equipo'], 0,4))." del universo ".substr($_GET['equipo'], -1);?></p>
                </div>
        		<div id="left-column" class="admin">
					<?php 
					if ($_GET['equipo']) {
						$query = "SELECT * FROM dataEquipos WHERE usuario = '{$_GET['equipo']}'";
						$equipo = mysql_query($query, $connection);
						$rows_eq = mysql_num_rows($equipo);
						if ($rows_eq >0) {
							$equipo = mysql_fetch_array($equipo); 
							//CODIGO OOOOOOO ?>
							<div id="tabs">
									<ul>
									<?php for ($j=1; $j<=($rows_eq); $j++) { ?>
										<li><a href="#tabs-<?php echo $j;?>">Integrante <?php echo $j;?></a></li>
									<?php } ?>
									</ul>
									<?php 
									
									for ($j=1; $j<=($rows_eq); $j++) { 
										$query = "SELECT * FROM dataEquipos WHERE usuario = '{$_GET['equipo']}' AND integrante = {$j} LIMIT 1";
										$result = mysql_query($query, $connection);
										confirm_query ($result); 
										$result = mysql_fetch_array($result);
										?>
										<div id="tabs-<?php echo $j;?>" class="integrante">
											<p>Nombre y apellido: <?php echo $result['nombre']." ".$result['apellido'];?></p>
											<p>Estilo Personal: <?php echo $result['estilo'];?></p>
											<p>Rol: <?php echo $result['rol'];?></p>
										<!--	<p>Breve descripci&oacute;n del rol: <?php echo $result['rol_desc'];?></p>-->
										</div>
									<?php } ?>
								</div><?php
						} else {
							echo "<p>No ha seleccionado un equipo v&aacute;lido.</p>";
						}
					} else {
						echo "<p>No ha seleccionado un equipo v&aacute;lido.</p>";
					} ?>                        
                </div>
	            <div id="right-column"><img src="<?php echo $root;?>images/info-alpha.jpg" width="218" height="478" /></div>
				<div style="clear:both;"></div>
      		</div>      
        </div>
            
<?php include($root."includes/us_footer.php");?>


</div>

</body>
</html>
