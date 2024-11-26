<?php $root="../";
	require_once($root."includes/session.php"); 
	require_once($root."includes/connect.php"); 
	require_once($root."includes/functions.php");
	require_once($root."includes/FuncionALFAyBETA.php");

	if (!logged_in_admin()) {
		redirect_to("login.php");
	}
$sel1a = "resumen";
if ($_GET['universo'] && $_GET['universo'] <= $current['universos']) {
	$universo = $_GET['universo'];
} else {
	$universo = 1;
}
?>	
<?php  //PROCESAMIENTO INICIAL
?>
<?php include($root."includes/us_docheader.php");?>
<?php include($root."includes/jquery.php");?>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
<!-- <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />-->
<script>
</script>
<script>
	$(function() {
		$( "#accordion" ).accordion({
			autoHeight: false,
			navigation: true,
			collapsible: true
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
					<p>Resumen de resultados - Universo: 
                    <?php for($i = 1; $i<=$current['universos']; $i++) {?>
	                    <a class="button <?php if ($universo == $i) {echo "red";} else {echo "blue";}?>" id="bot_universo<?php echo $i;?>" href="resumen.php?universo=<?php echo $i;?>"><?php echo $i;?></a>
                    <?php } ?>
                    </p>
                </div>
        		<div id="left-column" class="fullcol">
               	<?php echo $msg; ?>
				<div id="accordion">
                    <h3><a href="#">Contrato Final</a></h3>
                    <div>
                    	<?php                        		
							$results = fase_completa('dataNegociacion2', $universo);
							$accion = "ver";
							if (!$results) {echo "<p>A&uacute;n no se ha llegado a una decisi&oacute;n final en el Universo ".$universo.".</p>";}
							else {	
								$acuerdo_n1 = get_single_value ('dataNegociacion1', 'universo', $universo, $and=" status = 'A'");
								$acuerdo_n1 = mysql_fetch_array($acuerdo_n1);
								include ($root."includes/tabla_n2.php");
							}
							if ($results) {
						//BOTONERA							
						?>
						<p class="botonera">
                        	<a class="button red" href='simular.php?id=<?php echo $results['id'];?>&empresa=alfa'>Simular Alfa</a>
                            <a href='simular.php?id=<?php echo $results['id'];?>&empresa=beta' class="button blue">Simular Beta</a>
                        </p>
                        <?php }?>

					</div>    
                    <h3><a href="#">Puntajes</a></h3>
                    <div>
                    <?php 
						$ptos_alfa_pn = puntuacion_PN('alfa'.$universo);
						$ptos_beta_pn = puntuacion_PN('beta'.$universo);
						$neg_alfa = get_puntaje_gral('alfa'.$universo);
						$neg_beta = get_puntaje_gral('beta'.$universo);		
						$anios = 5;
						if (!$results) {
							$output = FALSE;
						} else {
							$output = SimuladorAlfayBeta ($results['modelos_ensamblar'], $results['unidades_comprar'], $results['duracion'], $results['uni_entregar_beta'], $results['precio_beta'], $results['modelos_fabricar'], $results['regalias_beta'], $results['compartir_va'], $results['compartir_kh'], $results['exclusividad_compra'], $results['exclusividad_venta'], $results['adelanto_beta_alfa'], $results['adelanto_alfa_beta']); 
						}
							include('test_tabla_resumen.php');
					?>
                    </div>
                </div>
                

              </div>
			  <div style="clear:both;"></div>
      		</div>      
        </div>
            
<?php include($root."includes/us_footer.php");?>


</div>

</body>
</html>
