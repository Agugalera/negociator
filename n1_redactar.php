<?php $root="";
	require_once($root."includes/session.php"); 
	require_once($root."includes/connect.php"); 
	require_once($root."includes/functions.php");

	if (!logged_in()) {
		redirect_to("index.php");
	}
$sel1="n1";
$sel2="new";
$prox = prox_n2 ('dataNegociacion1', $_SESSION['universo']); 
$ult_prop = ult_prop ('dataNegociacion1', 1, $_SESSION['universo']) ;

?>
<?php 

	function createForm() {
		global $connection; 
		global $root; 
		if ($_GET['id']) {
			$results = get_single_value ('dataNegociacion1', 'id',$_GET['id'],"");
			$num_rows = mysql_num_rows($results);
			$results = mysql_fetch_array($results);
		}
		$fase = "n1_redactar";
?>
	<form action="n1_redactar.php" id="variablesclave" method="post" class="n1 redactar">
        <?php include ($root."includes/tabla_variables.php");?>      
		<p class="botonera"><input type="submit" name="submit" value="Enviar" class="button blue" /><input type="reset" name="reset" value="Reestablecer" class="button white" /></p>
    </form>
    <?php
	}
	function processForm() {
		global $connection; 
		global $root;
		global $ult_prop;
		$msj = "";
	
		$varclave = array('modelos_ensamblar', 'unidades_comprar', 'duracion', 'uni_entregar_beta', 'precio_beta', 'modelos_fabricar', 'regalias_beta', 'compartir_va', 'compartir_kh', 'exclusividad_compra', 'exclusividad_venta', 'adelanto_beta_alfa', 'adelanto_alfa_beta'); 
		$query_varclave = "";
		for ($i = 0; $i < count($varclave); $i++) {
			$query_varclave .= $varclave[$i]."_prio = ".$_POST[$varclave[$i].'_prio'];
/*			$query_varclave .= $varclave[$i]."_min = ".$_POST[$varclave[$i].'_min'].", ";
			$query_varclave .= $varclave[$i]."_max = ".$_POST[$varclave[$i].'_max'];*/
			if ($i < (count($varclave)-1)) {$query_varclave .=", ";}
		}

		$results = get_single_user_info ('dataNegociacion1', $_SESSION['usuario']);

		$query = "INSERT INTO dataNegociacion1 SET usuario = '{$_SESSION['usuario']}', universo = {$_SESSION['universo']}, empresa = '{$_SESSION['empresa']}', status='W', ";
	
		$query .= $query_varclave;
		$result = mysql_query($query, $connection);
		confirm_query($result);
		if ($result) {
			if (count($ult_prop)>0) {
				$ult_prop = mysql_fetch_array($ult_prop);
				if ($ult_prop['status']=="W") {
					change_status ('dataNegociacion1', $ult_prop['id'], 'R');
				} else {send_message (ucfirst(otra_emp($_SESSION['empresa'])).$_SESSION['universo'], 'Sistema', ucfirst($_SESSION['empresa'])." ha enviado una nueva propuesta.");}
			} else {send_message (ucfirst(otra_emp($_SESSION['empresa'])).$_SESSION['universo'], 'Sistema', ucfirst($_SESSION['empresa'])." ha enviado una nueva propuesta.");}
			echo "Su propuesta se ha enviado con &eacute;xito. <a href='n1_propuestas.php' class='button white'>Volver</a>";
		}
	}
?>
<?php include($root."includes/us_docheader.php");?>
<?php include($root."includes/jquery.php");?>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
<script>
	$(function() {
		$("td.variable-comment").hide();
			   
		$("#variablesclave").validate({
		    errorElement: "div",
			rules: {
			<?php 
				echo minmax('modelos_ensamblar', 1, 10);
				echo ", ";
				echo minmax('unidades_comprar', 100, 5000);
				echo ", ";
				echo minmax('duracion', 1, 5);
				echo ", ";
				echo minmax('uni_entregar_beta', 100, 5000);
				echo ", ";
				  echo minmax('precio_beta', 50, 150);
				echo ", ";
				echo minmax('modelos_fabricar', 1, 10);
				echo ", ";
				echo minmax('regalias_beta', 1, 20);
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
        <p>Agenda de la Negociaci&oacute;n - Crear propuesta</p>
      </div>
      <div>
        <!--id="left-column"-->
					<?php 
                    //SOLO ESTO SE MUESTRA EN EL BODY! //
					if(isset($_POST['submit'])) {
                        processForm();
                    } else {
						if (strtolower($prox) != strtolower($_SESSION['empresa'])) {
							echo "No es su turno. <a href='n1_propuestas.php' class='button white'>Volver</a>"; 
						} else {
							$results = get_ultimas_dos ('dataNegociacion1', $_SESSION['universo']);
							$row = mysql_fetch_array($results);
	                        createForm();
						}
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
