<?php $root="";
	require_once($root."includes/session.php"); 
	require_once($root."includes/connect.php"); 
	require_once($root."includes/functions.php");

	if (!logged_in()) {
		redirect_to("index.php");
	}
$sel1="n2";
$sel2="new";
		$acuerdo_n1 = get_single_value ('dataNegociacion1', 'universo', $_SESSION['universo'], $and=" status = 'A'");
		$acuerdo_n1 = mysql_fetch_array($acuerdo_n1);
?>
<?php 
	function createForm() {
		global $connection; 
		global $root; 
		global $acuerdo_n1; 
		$accion = "redactar";
		$last = ult_prop ('dataNegociacion2', 1, $_SESSION['universo'], $_SESSION['usuario']);
		if ($_GET['id']) {
			$results = get_single_value ('dataNegociacion2', id, $_GET['id'], " universo = ".$_SESSION['universo']);
			$results = mysql_fetch_array($results);
		}
?>
	<form action="n2_script.php" id="variablesclave" method="post">
        <?php include ($root."includes/tabla_n2.php");?>      
		<p class="botonera">
		<?php 
			if (strtolower(prox_n2('dataNegociacion2', $_SESSION['universo'])) == strtolower($_SESSION['empresa'])) { ?>
        	<input type="submit" name="enviar" value="Enviar" class="button white" />
            <?php }?>
        	<input type="submit" name="simular" value="Simular" class="button white" />
        	<a href='n2_propuestas.php' class="button white">Volver</a>                
<!--            <input type="reset" name="reset" value="Reestablecer" class="button white" /> -->
        </p>
    </form>
    <?php
	}
?>
<?php include($root."includes/us_docheader.php");?>
<?php include($root."includes/jquery.php");?>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
<script>
	$(function() {
		$('#tabla_n2 tr:odd').addClass('even');
		$('#tabla_n2 tr:even').addClass('odd');
		$('#tabla_n2 tr:first').removeClass('even');		
		$('#tabla_n2 tr:first').removeClass('odd');		
		
		$("#variablesclave").validate({
		    errorElement: "div",
			rules: {
			<?php 
				echo minmax_simple('modelos_ensamblar', 1, 10);
				echo ", ";
				echo minmax_simple('unidades_comprar', 100, 5000);
				echo ", ";
				echo minmax_simple('duracion', 1, 5);
				echo ", ";
				echo minmax_simple('uni_entregar_beta', 100, 5000);
				echo ", ";
				echo minmax_simple('precio_beta', 50, 150);
				echo ", ";
				echo minmax_simple('modelos_fabricar', 1, 10);
				echo ", ";
				echo minmax_simple('regalias_beta', 1, 20);

/*				echo minmax_simple('modelos_ensamblar', min($acuerdo_n1['modelos_ensamblar_min'],$acuerdo_n1['modelos_ensamblar_max']), max($acuerdo_n1['modelos_ensamblar_min'],$acuerdo_n1['modelos_ensamblar_max']));
				echo ", ";
				echo minmax_simple('unidades_comprar', min($acuerdo_n1['unidades_comprar_min'],$acuerdo_n1['unidades_comprar_max']), max($acuerdo_n1['unidades_comprar_min'],$acuerdo_n1['unidades_comprar_max']));
				echo ", ";
				echo minmax_simple('duracion', min($acuerdo_n1['duracion_min'],$acuerdo_n1['duracion_max']), max($acuerdo_n1['duracion_min'],$acuerdo_n1['duracion_max']));
				echo ", ";
				echo minmax_simple('uni_entregar_beta', min($acuerdo_n1['uni_entregar_beta_min'],$acuerdo_n1['uni_entregar_beta_max']), max($acuerdo_n1['uni_entregar_beta_min'],$acuerdo_n1['uni_entregar_beta_max']));
				echo ", ";
				echo minmax_simple('precio_beta', min($acuerdo_n1['precio_beta_min'],$acuerdo_n1['precio_beta_max']), max($acuerdo_n1['precio_beta_min'],$acuerdo_n1['precio_beta_max']));
				echo ", ";
				echo minmax_simple('modelos_fabricar', min($acuerdo_n1['modelos_fabricar_min'],$acuerdo_n1['modelos_fabricar_max']), max($acuerdo_n1['modelos_fabricar_min'],$acuerdo_n1['modelos_fabricar_max']));
				echo ", ";
				echo minmax_simple('regalias_beta', $acuerdo_n1['regalias_beta_min'],$acuerdo_n1['regalias_beta_max']);
				echo ", ";
				echo minmax_simple('adelanto_beta_alfa', $acuerdo_n1['adelanto_beta_alfa_min'], $acuerdo_n1['adelanto_beta_alfa_max']);
				echo ", ";
				echo minmax_simple('adelanto_alfa_beta', $acuerdo_n1['adelanto_alfa_beta_min'],$acuerdo_n1['adelanto_alfa_beta_max']);*/
			?>
		  }
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
        <p>Negociacion / Crear propuesta</p>
      </div>
      <div>
        <!--id="left-column"-->
					<?php 
                    //SOLO ESTO SE MUESTRA EN EL BODY! //
					if(isset($_POST['submit'])) {
                        processForm();
                    } else {
	                        createForm();
                    }
                    //FIN DE LO QUE SE MUESTRA! //
                    ?>
      </div>
      <!--      <div id="right-column"><img src="images/info-alpha.jpg" width="218" height="478" /></div>-->
      <div style="clear:both;"></div>
    </div>
  </div>
<?php include($root."includes/us_footer.php"); ?>
</div>
</body>
</html>
