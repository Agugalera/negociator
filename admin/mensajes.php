<?php $root="../";
	require_once($root."includes/session.php"); 
	require_once($root."includes/connect.php"); 
	require_once($root."includes/functions.php");

	if (!logged_in_admin()) {
		redirect_to("index.php");
	}
$sel1a="msjs";
$sel2a="ver";
	if (isset($_POST['submit'])) {
		$universo = intval($_POST['universo']);
		$empresas = array ('alfa', 'beta');
		foreach($empresas as $empresa) {
			$usuario = $empresa.$universo;
			$puntaje = intval($_POST['puntaje_'.$empresa]); 
			if (!get_puntaje ($usuario, 'msj')) {
				$query = "INSERT INTO tablaPuntajes SET usuario = '{$usuario}', universo = {$universo}, fase = 'msj', puntaje = {$puntaje}";
			} else {
				$query = "UPDATE tablaPuntajes SET puntaje = {$puntaje} WHERE usuario = '{$usuario}' AND fase = 'msj'";
			}
			$result = mysql_query ($query);
			confirm_query($result);
		}
	}

?>	


<?php include($root."includes/us_docheader.php");?>
<?php include($root."includes/jquery.php");?>
<meta http-equiv="refresh" content="30" />
</head>
<script type="text/javascript">
	$(function() {
		$( "#accordion" ).accordion({
			autoHeight: false,
			navigation: true
		});
	});
</script>
<body>

<div id="container">
	<?php include($root."includes/admin_header.php");?>
	<?php include($root."includes/admin_menu.php");?>
        <div id="content">
        	<div id="wrap">
                <div class="titulos">
                	<p> Mensajes / Resumen General</p>
                </div>
        		<div id="left-column">
					<div id="accordion">
						<h3><a href="#">Instructor</a></h3>
						<div>
							<?php 
								$mensajes = getMensajesByUser ('instructor');
								displayMensajes($mensajes, TRUE);
							?>

						</div>
					<?php for ($i=1; $i<=$current['universos'];$i++) {?>
						<h3><a href="#">Universo <?php echo $i;?></a></h3>
						<div>
							<?php
								$mensajes = getMensajesByUniverse ($i);
								displayMensajes($mensajes, FALSE);
							?>
                            		<form action="mensajes.php" method="post" style="text-align: right;">
                                    	<input type="text" style="display:none;" name="universo" value="<?php echo $i;?>" />
                                        <p class="botonera">Puntaje Alfa:
                                        <select name="puntaje_alfa" style="width: 100px;">
                                        	<option value="">Seleccione...</option>
                                            <?php 
												$puntaje = get_puntaje ('alfa'.$i, 'msj');
												if ($puntaje) {
													$acc_puntaje = $puntaje['puntaje'];
												} else {$acc_puntaje = "";}
												for($y = 1; $y<=$puntaje_maximo; $y++) {
													if ($acc_puntaje == $y) {$selT = "selected='selected'";} else {$selT = "";}
													echo "<option value='".$y."' ".$selT.">".$y."</option>";
												}
											?>
                                        </select>
                                        Puntaje Beta:
                                        <select name="puntaje_beta" style="width: 100px;">
                                        	<option value="">Seleccione...</option>
                                            <?php 
												$puntaje = get_puntaje ('beta'.$i, 'msj');
												if ($puntaje) {
													$acc_puntaje = $puntaje['puntaje'];
												}
												for($y = 1; $y<=$puntaje_maximo; $y++) {
													if ($acc_puntaje == $y) {$selT = "selected='selected'";} else {$selT = "";}
													echo "<option value='".$y."' ".$selT.">".$y."</option>";
												}
											?>
                                        </select>
                                        </p><p><input type="submit" name="submit" value="Otorgar puntaje" class="button blue"/></p>
                                    </form>

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
