<?php $root="../";
	require_once($root."includes/session.php"); 
	require_once($root."includes/connect.php"); 
	require_once($root."includes/functions.php");

	if (!logged_in_admin()) {
		redirect_to("login.php");
	}
	$sel1a = "pn";
	
	
	function display_responses ($tabla, $page) {
		global $connection;
		global $current;
		$display = "";
		for($i = 1; $i<=$current['universos']; $i++) {
			$query = "SELECT * FROM {$tabla} WHERE universo = {$i} GROUP BY usuario ORDER BY empresa ASC";
			$this_universe = mysql_query($query, $connection);
			$univ_rows = mysql_num_rows($this_universe);
			$display .= "<div class='universo'><strong>Universo ".$i."</strong></div>\n";
			if ($univ_rows==0) {
				$display .= "<p>Esperando a que los equipos Alfa y Beta env&iacute;en la informaci&oacute;n.</p>\n"; 
			} else {
				while ($row=mysql_fetch_array($this_universe)) {
					$display .= "<p class='float' style='margin-right: 15px;'><a href='".$page."?equipo=".$row['usuario']."' class='ficha-equipo'>Respuesta de ".ucfirst($row['empresa'])."</a>"; 					
					if ($row['puntaje']>0) {
						$display .= " <span class='puntaje_admin'>".$row['puntaje']."</span>";
					}
					$display .= "</p>\n";
				}
				$display .= "<div class='clearfix' style='height: 1em;'></div>";
			}
		}
		return $display;
	}?>
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
	});
</script>
<meta http-equiv="refresh" content="30" />
</head>

<body>

<div id="container">
	<?php include($root."includes/admin_header.php");?>
	<?php include($root."includes/admin_menu.php");?>
        
        <div id="content">
        	<div id="wrap">
                <div class="titulos">
					<p>Prenegociaci&oacute;n / Resumen</p>
                </div>
        		<div id="left-column" class="admin">
                    <div id="accordion">
                        <h3><a href="#">Los Equipos</a></h3>
                        <div>
							<?php for($i = 1; $i<=$current['universos']; $i++) {
								$query = "SELECT * FROM dataEquipos WHERE universo = {$i} GROUP BY usuario ORDER BY empresa ASC, integrante ASC";
								$this_universe = mysql_query($query, $connection);
								$univ_rows = mysql_num_rows($this_universe);
							?>
								<div class='universo'><strong>Universo <?php echo $i;?></strong></div>
								<?php if ($univ_rows==0) {
									echo "<p>Esperando a que los equipos Alfa y Beta env&iacute;en la informaci&oacute;n.</p>"; 
								} else {
									while ($row=mysql_fetch_array($this_universe)) {
										echo "<p class='float' style='margin-right: 15px;'><a href='pn_equipo.php?equipo=".$row['usuario']."' class='ficha-equipo'>Ficha equipo ".ucfirst($row['empresa'])."</a></p>";
									}
									echo "<div class='clearfix'  style='height: 1em;'></div> \n";

								}
							} ?>
                        </div>
						<h3><a href="#">El Clima</a></h3>
						<div>
							<?php echo display_responses ('dataClima', 'pn_clima.php'); ?>
						</div>
						<h3><a href="#">Variables Clave</a></h3>
						<div>
							<?php echo display_responses ('dataVarsClave', 'pn_variablesclave.php'); ?>
						</div>
						<h3><a href="#">La Estrategia</a></h3>
						<div>
							<?php echo display_responses ('dataEstrategia', 'pn_estrategia.php'); ?>
						</div>
						<h3><a href="#">Los 7 Elementos</a></h3>
						<div>
							<?php echo display_responses ('dataSieteElementos', 'pn_sieteelementos.php'); ?>
						</div>

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
