<?php $root="";
	require_once($root."includes/session.php"); 
	require_once($root."includes/connect.php"); 
	require_once($root."includes/functions.php");

	if (!logged_in()) {
		redirect_to("index.php");
	}
$sel1= "pn";
$sel2= "varclave";
	
?>
<?php 

	function createForm() {
		global $connection; 
		global $root; 
		$results = get_single_user_info ('dataVarsClave', $_SESSION['usuario']);
		$num_rows = mysql_num_rows($results);
		$results = mysql_fetch_array($results);

		$fase = "pn";
	?>
    <p>Por favor, identifique las variables de la negociación según sean rojas (sensibles), verdes (comunes) o amarillas (superfluas).</p>
	<form action="pn_variablesclave.php" id="variablesclave" class="input <?php echo $_SESSION['empresa'];?>"method="post">
	<?php include ($root."includes/tabla_variables.php");?>      
		<p class="botonera"><input type="submit" name="submit" value="Enviar" class="button white" /></p>
    </form>
    <?php
	}
	
	function processForm() {
		global $connection; 
		global $root;
		$msj = "";
	
		$varclave = array('modelos_ensamblar', 'unidades_comprar', 'duracion', 'uni_entregar_beta', 'precio_beta', 'modelos_fabricar', 'regalias_beta', 'compartir_va', 'compartir_kh', 'exclusividad_compra', 'exclusividad_venta', 'adelanto_beta_alfa', 'adelanto_alfa_beta'); 
		$query_varclave = "";
		for ($i = 0; $i < count($varclave); $i++) {
			$query_varclave .= $varclave[$i]."_clas = ".$_POST[$varclave[$i].'_clas'].", ";
/*			if ($_SESSION['empresa']=="alfa"){ 
				$query_varclave .= $varclave[$i]."_min = ".$_POST[$varclave[$i].'_min'].", ";
				$query_varclave .= $varclave[$i]."_max = ".$_POST[$varclave[$i].'_max'].", ";
			} */
			$query_varclave .= $varclave[$i]."_obj = ".$_POST[$varclave[$i].'_obj'];
			if ($i < (count($varclave)-1)) {$query_varclave .=", ";}
		}

		$results = get_single_user_info ('dataVarsClave', $_SESSION['usuario']);

		if (mysql_num_rows($results) == 0) {
			$query = "INSERT INTO dataVarsClave SET usuario = '{$_SESSION['usuario']}', universo = {$_SESSION['universo']}, empresa = '{$_SESSION['empresa']}', ";
			
			 $query .= $query_varclave;
		} elseif (mysql_num_rows($results) > 0) {
			$query = "UPDATE dataVarsClave SET ";
			$query .= $query_varclave;
			$query .= " WHERE usuario = '{$_SESSION['usuario']}'";
		}
		$result = mysql_query($query, $connection);
		confirm_query($result);
		if ($result) {echo "Sus datos se han cargado con &eacute;xito.";}
	}
?>
<?php 
//DOCTYPE AND STYLES
include($root."includes/us_docheader.php");
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js" type="text/javascript"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
<!-- <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />-->
<script>
	$(function() {
		
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

		$("select[name$='_clas']").parent().prev('.variable-name').addClass(function() {
			var value = $(this).next().children("select[name$='_clas']").val();
			if (value == 3) {
				newclass = 'rojo';
			} else if (value == 2) {
				newclass = 'verde';
			} else if (value == 1) {
				newclass = 'amarillo';
			} else {newclass = '';}
			return newclass;
													 
		 });
		
		$("select[name$='_clas']").change( function () {
			var selectitem  = $(this);
			var value = $(this).val();
			var newclass;
			if (value == 3) {
				newclass = 'rojo';
			} else if (value == 2) {
				newclass = 'verde';
			} else if (value == 1) {
				newclass = 'amarillo';
			} else {newclass = '';}
			selectitem.parent().prev('.variable-name').removeClass('verde').removeClass('rojo').removeClass('amarillo').addClass(newclass);
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
        <p>Prenegociación / Variables Clave</p>
      </div>
      <div>
        <!--id="left-column"-->
 					<?php 
                    //SOLO ESTO SE MUESTRA EN EL BODY! //
                   
					if(!isset($_POST['submit'])) {
                        createForm();
                    } else {
                        processForm();
						createForm();						
                    }
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