<?php $root="";
	require_once($root."includes/session.php"); 
	require_once($root."includes/connect.php"); 
	require_once($root."includes/functions.php");

	if (!logged_in()) {
		redirect_to("index.php");
	}
$sel1= "pn";
$sel2= "otra_emp";
	
?>
<?php 
//DOCTYPE AND STYLES
include($root."includes/us_docheader.php");
include($root.'includes/jquery.php');
?>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
<script>
	$(function() {
		$( "#tabs" ).tabs();
	});
</script>
</head>
<body>
<div id="container">
  <?php include($root."includes/us_header.php");?>
  <?php include($root."includes/us_menu.php");?>
  <div id="content">
    <div id="wrap">
      <div class="titulos">
        <p>Prenegociación / <?php echo otra_emp($_SESSION['empresa']);?> Inc.</p>
      </div>
      <div>
        <!--id="left-column"-->
        
				<?php 
					$otro_eq = strtolower(otra_emp($_SESSION['empresa']).$_SESSION['universo']);
					$query = "SELECT * FROM dataEquipos WHERE usuario = '{$otro_eq}'";
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
									$query = "SELECT * FROM dataEquipos WHERE usuario = '{$otro_eq}' AND integrante = {$j} LIMIT 1";
									$result = mysql_query($query, $connection);
									confirm_query ($result); 
									$result = mysql_fetch_array($result);
									?>
									<div id="tabs-<?php echo $j;?>" class="integrante">
										<p>Nombre y apellido: <?php echo $result['nombre']." ".$result['apellido'];?></p>
										<p>Estilo Personal: <?php echo $result['estilo'];?></p>
										<p>Rol: <?php echo $result['rol'];?></p>
										<p>Breve descripci&oacute;n del rol: <?php echo $result['rol_desc'];?></p>
									</div>
								<?php } ?>
							</div>
					<?php
					} else {
						echo "<p>Esperando a que ".ucfirst(otra_emp($_SESSION['empresa']))." cargue sus datos.</p>";
					} ?>                       
                    <p>&nbsp;</p> 
	 		<?php
            	$result = get_single_user_info ('dataSieteElementos', $otro_eq);
				if (mysql_num_rows($result)!=0) {
					$row = mysql_fetch_array($result);
				} else {"<p><strong>Siete Elementos:</strong> Esperando a que el otro equipo cargue los 7 Elementos.</p>";
			}
			$sum = $row['share_alternativas'] + $row['share_intereses'] + $row['share_opciones'] + $row['share_legitimidad'] + $row['share_compromisos'] + $row['share_comunicacion'] + $row['share_relacion'];
			if ($sum > 0) {
				echo "<h3>Los Siete Elementos</h3>";
			}
            if ($row['share_alternativas']>0) {
            	echo "<p><strong>Alternativas:</strong> ".$row['alternativas']."</p>";
			}
            if ($row['share_intereses']>0) {
            	echo "<p><strong>Intereses:</strong> ".$row['intereses']."</p>";
			}
            if ($row['share_opciones']>0) {
            	echo "<p><strong>Opciones:</strong> ".$row['opciones']."</p>";
			}
            if ($row['share_legitimidad']>0) {
            	echo "<p><strong>Legitimidad:</strong> ".$row['legitimidad']."</p>";
			}
            if ($row['share_compromisos']>0) {
            	echo "<p><strong>Compromisos:</strong> ".$row['compromisos']."</p>";
			}
            if ($row['share_comunicacion']>0) {
            	echo "<p><strong>Comunicaci&oacute;n:</strong> ".$row['comunicacion']."</p>";
			}
            if ($row['share_relacion']>0) {
            	echo "<p><strong>Relaci&oacute;n:</strong> ".$row['relacion']."</p>";
			}
			if ($sum < 1) {
				echo "<p><strong>Siete Elementos:</strong> La empresa ".ucfirst(otra_emp($_SESSION['empresa']))." no desea compartir esta informaci&oacute;n.</p>";
			}
			?>					
					<?php 
					//SOLO ESTO SE MUESTRA EN EL BODY! //
                    //FIN DE LO QUE SE MUESTRA! //
                    ?>

        
      </div>
      <!--      <div id="right-column"><img src="images/info-alpha.jpg" width="218" height="478" /></div>  -->
      <div style="clear:both;"></div>
    </div>
  </div>
<?php include($root."includes/us_footer.php"); ?>
</div>
</body>
</html>