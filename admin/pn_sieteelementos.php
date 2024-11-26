<?php $root="../";

	require_once($root."includes/session.php"); 

	require_once($root."includes/connect.php"); 

	require_once($root."includes/functions.php");



	if (!logged_in_admin()) {

		redirect_to("login.php");

	}

$sel1a= "pn";

$sel2a= "sieteelementos";

?>
<?php 

	if (isset($_POST['submit'])) {

		$query = "UPDATE dataSieteElementos SET puntaje = {$_POST['puntaje']} WHERE usuario = '{$_POST['equipo']}'";

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

		    errorElement: "div"

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

        <p>Prenegociación / Los 7 Elementos</p>

      </div>

      <div>

        <!--id="left-column"-->

 					<?php 

					if ($_GET['equipo']) {

						$row = get_single_value ('dataSieteElementos', 'usuario', $_GET['equipo']);

						if (mysql_num_rows($row)>0) {

							$row = mysql_fetch_array($row);

							echo "<p>De la empresa ".ucfirst($row['empresa'])." del universo ".$row['universo']."</p>";

							?>

							  <table cellspacing="0" cellpadding="0" class="admin_elementos">

								<tr class="table-head">

								  <td class="txt"></td>

								  <td class="share">Compartir</td>
								  <td class="textarea">An&aacute;lisis</td>
							    </tr>

								<tr class="odd">

								  <td class="txt"><strong>Alternativas (obligatorio)</strong></td>

								  <td class="share"><input type="checkbox" name="share_alternativas" id="share_alternativas"  value="1" <?php if ($row['share_alternativas']==1) {echo " checked = 'checked' ";}?> disabled="disabled" /></td>
								  <td class="textarea"><?php echo $row['alternativas'];?></td>
							    </tr>

								<tr class="even">

								  <td class="txt"><strong>Intereses (obligatorio)</strong></td>

								  <td class="share"><input type="checkbox" name="share_intereses" id="share_intereses" value="1" <?php if ($row['share_intereses']==1) {echo " checked = 'checked' ";}?>  disabled="disabled"/></td>
								  <td class="textarea"><?php echo $row['intereses'];?></td>
							    </tr>

								<tr class="odd">

								  <td class="txt"><strong>Opciones (obligatorio)</strong></td>

								  <td class="share"><input type="checkbox" name="share_opciones" id="share_opciones" value="1" <?php if ($row['share_opciones']==1) {echo " checked = 'checked' ";}?>   disabled="disabled"/></td>
								  <td class="textarea"><?php echo $row['opciones'];?></td>
							    </tr>

								<tr class="even">

								  <td class="txt">Legitimidad</td>

								  <td class="share"><input type="checkbox" name="share_legitimidad" id="share_legitimidad" value="1" <?php if ($row['share_legitimidad']==1) {echo " checked = 'checked' ";}?>  disabled="disabled"/></td>
								  <td class="textarea"><?php echo $row['legitimidad'];?></td>
							    </tr>

								<tr class="odd">

								  <td class="txt">Compromisos</td>

								  <td class="share"><input type="checkbox" name="share_compromisos" id="share_compromisos" value="1" <?php if ($row['share_compromisos']==1) {echo " checked = 'checked' ";}?>  disabled="disabled"/></td>
								  <td class="textarea"><?php echo $row['compromisos'];?></td>
							    </tr>

								<tr class="even">

								  <td class="txt">Comunicaci&oacute;n</td>

								  <td class="share"><input type="checkbox" name="share_comunicacion" id="share_comunicacion"  value="1" <?php if ($row['share_comunicacion']==1) {echo " checked = 'checked' ";}?>  disabled="disabled" /></td>
								  <td class="textarea"><?php echo $row['comunicacion'];?></td>
							    </tr>

								<tr class="odd">

								  <td class="txt">Relaci&oacute;n</td>

								  <td class="share"><input type="checkbox" name="share_relacion" id="share_relacion" value="1" <?php if ($row['share_relacion']==1) {echo " checked = 'checked' ";}?>  disabled="disabled"/></td>
								  <td class="textarea"><?php echo $row['relacion'];?></td>
							    </tr>

							  </table>



							

							<?php

							echo "<p>".$row['clima']."</p>";

							echo "<p class='botonera'>"?>

<form method="post" action="pn_sieteelementos.php?equipo=<?php echo $_GET['equipo'];?>">

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