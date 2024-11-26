<?php $root="";
	require_once($root."includes/session.php"); 
	require_once($root."includes/connect.php"); 
	require_once($root."includes/functions.php");
	require_once($root."includes/FuncionALFAyBETA.php");
	$sel1= "res";
	if (!logged_in()) {
		redirect_to("index.php");
	}
	$query = "SELECT * FROM tablaGeneral";
	$current = mysql_query ($query, $connection);
	confirm_query ($current);
	$current = mysql_fetch_array($current);
	$anios = 5;
?>
<?php include($root."includes/us_docheader.php");?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<?php include($root."includes/jquery.php");?>
<script type="text/javascript">
	$(function() {
		$( "#accordion" ).accordion({
			autoHeight: false,
			navigation: true
		});
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
					<p>Resumen de Resultados</p>
                </div>
        		<div >
                	<div id="accordion" class="simulador">
                    <?php 
					$pn = puntuacion_PN($_SESSION['usuario']); 
					if ($pn!=FALSE) {
						?>
                    	<h3>Pre-Negociaci&oacute;n <span class="puntaje"><?php echo $avg = round(array_sum($pn)/count($pn),1);?></span></h3>
                        <div>
                        <?php 
						$secciones = array('estrategia'=>'estrategia', 'clima'=>'clima', 'elementos'=>'Los siete elementos', 'claves'=>'Variables Clave');
						foreach ($pn as $key => $pje) {
							echo "<li><span class='puntaje'>".$pje."</span>".strtoupper($secciones[$key])."</li>";
						}?>
                        </div>
                    <?php }?>
                    <?php 
//						$negociacion_pt = array();
						$fases = array('n1', 'n2', 'msj');
						$titulos_fases = array('n1'=>'Agenda de la negociacion', 'n2'=>'Cantidad y variedad de propuestas', 'msj'=>'Comunicacion');
						$puntaje = get_puntaje_gral($_SESSION['usuario']);
						$neg_array = array(); 
						foreach ($fases as $key) {
							if ($puntaje[$key] > 0) {$neg_array[$key] = $puntaje[$key];}
						} 

						
						if ($puntaje) {?>
                        <h3>Negociaci&oacute;n <span class="puntaje"><?php echo round(array_sum($neg_array)/count($neg_array),1);?></span></h3>
                        <div>
                        <?php 
							foreach ($puntaje as $key => $val) {
								if (in_array($key, $fases)) {
								echo "<li><span class='puntaje'>".$val."</span>".strtoupper($titulos_fases[$key])." </li>";
								}
							}
						?>
                        </div>
                        <?php }?>
                        <?php 
						$prop_aceptada = fase_completa ('dataNegociacion2', $_SESSION['universo']);
						if ($prop_aceptada){
							$simulacion = get_single_value ('dataNegociacion2', 'id', $prop_aceptada['id']);
							$simulacion = mysql_fetch_array($simulacion);
							$output = SimuladorAlfayBeta ($simulacion['modelos_ensamblar'], $simulacion['unidades_comprar'], $simulacion['duracion'], $simulacion['uni_entregar_beta'], $simulacion['precio_beta'], $simulacion['modelos_fabricar'], $simulacion['regalias_beta'], $simulacion['compartir_va'], $simulacion['compartir_kh'], $simulacion['exclusividad_compra'], $simulacion['exclusividad_venta'], $simulacion['adelanto_beta_alfa'], $simulacion['adelanto_alfa_beta']); 
							if ($_SESSION['empresa']=="alfa") {
								$emp_letras = "Resumen";
							} else {
								$emp_letras = "Resumen_Beta";
							}
	
?>
                        <h3>Contrato <span class="puntaje"><?php echo round(array_sum($output[$emp_letras])*$puntaje_maximo/4,1);?></span></h3>
                        <div>
                          	<?php 
							?>
                            <li><span class="puntaje"><?php echo round($output[$emp_letras][0]*$puntaje_maximo,1);?></span>VALOR ACTUAL</li>
                            <li><span class="puntaje"><?php echo round($output[$emp_letras][1]*$puntaje_maximo,1);?></span>MARGEN</li>
                            <li><span class="puntaje"><?php echo round($output[$emp_letras][2]*$puntaje_maximo,1);?></span>MARKET SHARE</li>
                            <li><span class="puntaje"><?php echo round($output[$emp_letras][3]*$puntaje_maximo,1);?></span>SEGURIDAD</li>                            
                        </div>
						<?php if ($puntaje["fin"] > 0) :?><h3>Puntaje final <span class="puntaje"><?php echo $puntaje["fin"];?></span></h3><?php endif;?>
 						<?php }?>
                    </div>
                
                
                </div>
				<div style="clear:both;"></div>
      		</div>      
        </div>
            
	<?php include($root."includes/us_footer.php");?>


</div>

</body>
</html>