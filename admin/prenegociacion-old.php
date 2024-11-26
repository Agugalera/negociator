<?php $root="../";
	require_once($root."includes/session.php"); 
	require_once($root."includes/connect.php"); 
	require_once($root."includes/functions.php");

	if (!logged_in_admin()) {
		redirect_to("login.php");
	}
	$sel1 = "pn";
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
		// a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
		$( "#accordion" ).accordion({
			autoHeight: false,
			navigation: true
		});
		$( ".tabs" ).tabs();
		$("#reset_pwd").validate({
			errorElement: "div",
			rules: {
				repeat_password: {
				  equalTo: "#password"
				}
			}, 
			messages: {
				repeat_password: {
					equalTo: "Las contrase&ntilde;as no coinciden."
				}
			}
		}); 
		$("#pass_admin").validate({
			errorElement: "div",
			rules: {
				repeat_password: {
				  equalTo: "#password2"
				}
			}, 
			messages: {
				repeat_password: {
					equalTo: "Las contrase&ntilde;as no coinciden."
				}
			}
		}); 
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
					<p>Prenegociacion / Los equipos</p>
                </div>
        		<div id="left-column" class="admin">
                    <div id="accordion">
                    <?php for($i = 1; $i<=$current['universos']; $i++) {?>
                        <h3><a href="#">Universo <?php echo $i;?></a></h3>
                        <div>
							<?php 
							$empresas = array('alfa', 'beta');
							foreach($empresas as $empresa) {
								$query = "SELECT * FROM dataEquipos WHERE universo = {$i} AND empresa = '{$empresa}'";
								$result = mysql_query($query, $connection);
								confirm_query ($result); 
								$num_rows = mysql_num_rows($result);
								$data = mysql_fetch_array($result);
								if ($num_rows > 0) {
								?>
								<h2><?php echo ucfirst($empresa);?></h2>
								<div class="tabs">
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
							<?php } else { echo "<p>La empresa ".ucfirst($empresa)." todav&iacute;a no ha cargado estos datos.";} 
							} ?>
                        </div>
                      <?php } ?>
	                 </div>
                </div>
	            <div id="right-column"><img src="<?php echo $root;?>images/info-alpha.jpg" width="218" height="478" /></div>
				<div style="clear:both;"></div>
      		</div>      
        </div>
            
<?php include($root."includes/us_footer.php");?>


</div>

</body>
</html>
