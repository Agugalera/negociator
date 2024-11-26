<?php $root="../";
	require_once($root."includes/session.php"); 
	require_once($root."includes/connect.php"); 
	require_once($root."includes/functions.php");

	if (!logged_in_admin()) {
		redirect_to("login.php");
	}

	$sel1a = "n1";
	
	if (isset($_POST['submit'])) {
		$universo = intval($_POST['universo']);
		$empresas = array ('alfa', 'beta');
		foreach($empresas as $empresa) {
			$usuario = $empresa.$universo;
			$puntaje = intval($_POST['puntaje_'.$empresa]); 
			if (!get_puntaje ($usuario, 'n1')) {
				$query = "INSERT INTO tablaPuntajes SET usuario = '{$usuario}', universo = {$universo}, fase = 'n1', puntaje = {$puntaje}";
			} else {
				$query = "UPDATE tablaPuntajes SET puntaje = {$puntaje} WHERE usuario = '{$usuario}' AND fase = 'n1'";
			}
			$result = mysql_query ($query);
			confirm_query($result);
		}
	}
	
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

</head>

<body>

<div id="container">
	<?php include($root."includes/admin_header.php");?>
	<?php include($root."includes/admin_menu.php");?>
        
        <div id="content">
        	<div id="wrap">
                <div class="titulos">
					<p>Agenda de la Negociaci&oacute;n / Resumen</p>
                </div>
        		<div id="left-column" class="admin">
                    <div id="accordion">
                    <?php for($i = 1; $i<=$current['universos']; $i++) {?>
                        <h3><a href="#">Universo <?php echo $i;?></a></h3>
                        <div>
							<?php
							$query = "SELECT * FROM dataNegociacion1 WHERE universo = {$i}"; 
							$query .= " AND status IS NOT NULL";
							$query .= " ORDER BY id DESC";
							$result = mysql_query ($query, $connection);
							$num_rows = mysql_num_rows($result);
							$j = 0;
							if ($num_rows==0) {
								echo "<p>No se han hecho propuestas a&uacuten.</p>";
							} else {
								$a = 0;
								while ($row = mysql_fetch_array($result)) {
									echo "<p>Propuesta ".($num_rows-$j).":  de ".ucfirst($row['empresa'])." a ".ucfirst(otra_emp($row['empresa'])).". Estado: ".$estados[$row['status']].". <a href='n1_ver.php?id=".$row['id']."'>Ver</a></p>";
									$j++;
									if (ucfirst($row['status'])== "A") {
										$a++;
										$acc_id = $row['id'];
									}
								}
								if ($a>0) {?>
									<form action="negociacion1.php" method="post" style="text-align: right;">
                                    	<input type="text" style="display:none;" name="universo" value="<?php echo $i;?>" />
                                        <p class="botonera">Puntaje Alfa:
                                        <select name="puntaje_alfa" style="width: 100px;">
                                        	<option value="">Seleccione...</option>
                                            <?php 
												$puntaje = get_puntaje ('alfa'.$i, 'n1');
												if ($puntaje) {
													$acc_puntaje = $puntaje['puntaje'];
												}
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
												$puntaje = get_puntaje ('beta'.$i, 'n1');
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
								<?php }
							} 
							?>
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