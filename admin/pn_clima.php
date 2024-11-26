<?php $root="../";

	require_once($root."includes/session.php"); 

	require_once($root."includes/connect.php"); 

	require_once($root."includes/functions.php");



	if (!logged_in_admin()) {

		redirect_to("login.php");

	}

$sel1a= "pn";

$sel2a	= "clima";

?><?php 

	if (isset($_POST['submit'])) {

		$query = "UPDATE dataClima SET puntaje = {$_POST['puntaje']} WHERE usuario = '{$_POST['equipo']}'";

		$result = mysql_query($query, $connection);

		confirm_query($result);
		redirect_to('prenegociacion.php');
		$ptje_msg = "<span class='exito'>El puntaje se carg&oacute; con &eacute;xito.</span>";

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

		$("form").validate({

		    errorElement: "div",

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

        <p>Prenegociación / El clima</p>

      </div>

      <div>

        <!--id="left-column"-->

 					<?php 

					if ($_GET['equipo']) {

						$row = get_single_value ('dataClima', 'usuario', $_GET['equipo']);

						if (mysql_num_rows($row)>0) {

							$row = mysql_fetch_array($row);

							echo "<p>De la empresa ".ucfirst($row['empresa'])." del universo ".$row['universo']."</p>";

							echo "<p>".$row['clima']."</p>";

							echo "<p class='botonera'>"?>

							<form method="post" action="pn_clima.php?equipo=<?php echo $_GET['equipo'];?>">

								<input type="text" name="equipo" value="<?php echo $_GET['equipo'];?>" style="display: none;"/>

								<p class="botonera">Puntaje: 

									<select name="puntaje" style="width: 100px;" class="required" title="Este campo es obligatorio.">

										<option value="">Seleccione...</option>

											<?php 

												for($y = 1; $y<=$puntaje_maximo; $y++) {

													if ($row['puntaje'] == $y) {$selT = "selected='selected'";} else {$selT = "";}

													echo "<option value='".$y."' ".$selT.">".$y."</option>";

												}

											?>

									</select>

									<input type="submit" name="submit" value="Otorgar puntaje" class="button blue"/><br />

									<?php echo $ptje_msg;?>

								</p>

							</form>

						<?php

						} else {echo "<p>La empresa ".ucfirst($_GET['equipo'])." no ha cargado sus datos a&uacute;n.</p>";}

					} else {echo "<p>No ha seleccionado equipo. <a href='prenegociacion.php'>Volver</a>.</p>";}

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