<?php $root="../";
	require_once($root."includes/session.php"); 
	require_once($root."includes/connect.php"); 
	require_once($root."includes/functions.php");

	if (!logged_in_admin()) {
		redirect_to("login.php");
	}
	$sel1a = "admin";
?>	
<?php  //PROCESAMIENTO INICIAL


//REINICIAR PARTIDA 
	if ($_POST['confirm_reset']=="reiniciar") {
		$tablas = array('dataClima', 'dataEquipos', 'dataEstrategia', 'dataMensajes', 'dataNegociacion1', 'dataNegociacion2', 'dataSieteElementos', 'dataVarsClave', 'tablaEstadoFases', 'tablaPuntajes');
		foreach($tablas as $tabla)  {
			$query = "TRUNCATE TABLE {$tabla}";
			$result = mysql_query($query, $connection);
		}
		$rows = 0;
		foreach ($tablas as $tabla) {
			$query = "SELECT * FROM  {$tabla}";
			$result = mysql_query($query, $connection);
			$rows = $rows + mysql_num_rows($result);
		}
		if ($rows > 0) {
			$msg = "<p class='error'>Hubo un error al reiniciar la partida.</p>";
		} else {
			$query = "UPDATE tablaGeneral SET reset_partida = CURRENT_TIMESTAMP WHERE admin_username = '{$_SESSION['admin']}'";
			$result = mysql_query($query, $connection);
			confirm_query($result);
		}
	}
//FIN REINICIAR PARTIDA

//ESCENARIO
	if (isset($_POST['nuevo_escenario']) && $_POST['escenario']) {
		$query = "UPDATE tablaGeneral SET escenario = {$_POST['escenario']} WHERE admin_username = '{$_SESSION['admin']}'";
		$result = mysql_query($query, $connection);
		confirm_query($result);
		$message = "<p class='exito'>El escenario se ha cambiado con &eacutexito.</p>";
	}
//FIN ESCENARIO

//CAMBIAR CONTRASEÑA JUEGO
	if (isset($_POST['cambiar_pwd'])) {
		if ($_POST['password']=="") {
			$message = "<p class='error'>Debe ingresar una nueva contrase&ntilde;a.</p>";
		} elseif ($_POST['password']!=$_POST['repeat_password']) {
			$message = "<p class='error'>Las contrase&ntilde;as no coinciden.</p>";
		} else {
			$hashed_password = md5(trim(mysql_prep($_POST['password'])));
			$query = "UPDATE tablaGeneral SET juego_pw = '{$hashed_password}', reset_password = CURRENT_TIMESTAMP WHERE admin_username = '{$_SESSION['admin']}'";
			$result = mysql_query($query, $connection);
			confirm_query($result);
			$message = "<p class='exito'>La contrase&ntilde;a se ha cambiado con &eacutexito.</p>";
		}
	} 
//FIN CAMBIAR CONTRASEÑA

//CAMBIAR CONTRASEÑA ADMIN
	if (isset($_POST['pass_admin'])) {
		if ($_POST['password']=="" || $_POST['current_password']=="" ) {
			$message2 = "<p class='error'>Debe completar todos los campos.</p>";
		} elseif ($_POST['password']!=$_POST['repeat_password']) {
			$message2 = "<p class='error'>Las contrase&ntilde;as no coinciden.</p>";
		} else {
			$hashed_password = md5(trim(mysql_prep($_POST['password'])));
			$hashed_current =  md5(trim(mysql_prep($_POST['current_password'])));
			$check_match = "SELECT * FROM tablaGeneral WHERE admin_pw = '{$hashed_current}'";
			$check_match = mysql_query($check_match, $connection); 
			if (mysql_num_rows($check_match)>0) {	
				$query = "UPDATE tablaGeneral SET admin_pw = '{$hashed_password}' WHERE admin_username = '{$_SESSION['admin']}'";
				$result = mysql_query($query, $connection);
				confirm_query($result);
				$message2 = "<p class='exito'>La contrase&ntilde;a se ha cambiado con &eacutexito.</p>";
			} else {
				$message2 = "<p class='error'>La contrase&ntilde;a actual no es correcta.</p>";
			}
		}
	} 
//FIN CAMBIAR ADMIN

//DEFINIR UNIVERSOS
	if (isset($_POST['send_universos'])) {
		$universos = intval($_POST['universos']);
		if ($universos==0) {
			$message2 = "<p class='error'>Debe indicar un n&uacute;mero v&aacute;lido de universos.</p>";
		} else {
			$query = "UPDATE tablaGeneral SET universos = {$universos} WHERE admin_username = '{$_SESSION['admin']}'";
			$result = mysql_query($query, $connection);
			confirm_query($result);
			$message3 = "<p class='exito'>La cantidad de universos se ha cambiado con &eacutexito.</p>";
		}
	} 
//FIN DEFINIR UNIVERSOS 
?>
<?php //DATA INICIAL
	$query = "SELECT DISTINCT escenario FROM baseInformacion ORDER BY escenario ASC";
	$escenarios = mysql_query($query, $connection);
	confirm_query($escenarios);
	
	$query = "SELECT * FROM tablaGeneral";
	$current = mysql_query($query, $connection);
	confirm_query($current);	
	$current = mysql_fetch_array($current);
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
		$("#reset_pwd").validate({
			errorElement: "div",
			rules: {
				repeat_password: {
				  equalTo: "#password"
				}
			}, 
			messages: {
				repeat_password: {
					equalTo: "Las contrase&ntilde;as no coinciden."
				}
			}
		}); 
		$("#pass_admin").validate({
			errorElement: "div",
			rules: {
				repeat_password: {
				  equalTo: "#password2"
				}
			}, 
			messages: {
				repeat_password: {
					equalTo: "Las contrase&ntilde;as no coinciden."
				}
			}
		}); 
		$("#form_universos").validate();
		
		// POP UPS DE WARNING!
/*		$("#dialog_univ").dialog({
		  modal: true,
				bgiframe: true,
				width: 250,
				height: 150,
		  autoOpen: false
		  });
	
	

	
		$("#form_universos").submit(function(){
			e.preventDefault();
			$("#dialog_univ").dialog('option', 'buttons', {
					"OK" : function() {
						$("#form_universos").submit();
						},
					"Cancelar" : function() {
						$(this).dialog("close");
						}
					});
			$("#dialog_univ").dialog("open");
	
		});*/

	});
	</script>

</head>

<body>

<div id="container">
	<?php include($root."includes/admin_header.php");?>
	<?php include($root."includes/admin_menu.php");?>
        
        <div id="content">
        	<div id="wrap">


<!-- WARNINGS -->
<!--                <div id="dialog_univ" title="Cambiar n&uacute;mero de universos?" class="dialog">
                  Esto cambiar&aacute; la cantidad de universos disponibles. Importante: NO reduzca la cantidad de universos durante un juego, se perder&aacute; toda la informaci&oacute;n de los universos superiores al n&uacute;mero elegido. <br />
¿Est&aacute; seguro?
                </div>                        -->
<!-- /WARNINGS -->            
                <div class="titulos">
					<p>Administraci&oacute;n General - <?php echo $message; echo $message2;echo $message3; ?></p>
                </div>
        		<div id="left-column" class="admin">
                    <div id="accordion">
                        <h3><a href="#">Cambiar contrase&ntilde;a de los alumnos</a></h3>
                        <div>
                        	<p>&Uacute;ltima vez que se cambi&oacute; la contrase&ntilde;a: <?php echo $current['reset_password']; ?></p>
                            <form action="admin.php" method="post" id="reset_pwd">
                                <?php echo $message;?>
                                <p>
                                <label for="password">Nueva contrase&ntilde;a</label>
                                <input name="password" type="password" class="required" title="Debe ingresar una nueva contrase&ntilde;a" id="password"  />
                                </p>                        
                                <p>
                                <label for="repeat_password">Repetir contrase&ntilde;a</label>
                                <input name="repeat_password" id="repeat_password" type="password" />
                                </p>
                                <p class="botonera"><input type="submit" name="cambiar_pwd" value="Cambiar contrase&ntilde;a" class="button red" style="text-align: center; margin-left: 20px;"/></p>
                            </form>
                        </div>
					<?php if ((mysql_num_rows($escenarios)) > 1) {?>
                        <h3><a href="#">Seleccionar Escenario</a></h3>
                        <div>
                            <p>Escenario actual: <?php echo $current['escenario'];?></p>
                            <form action="admin.php" method="post" id="nuevo_escenario">
                                <label for="escenario">Nuevo escenario</label>
                                <select name="escenario" class="required" title="Debe seleccionar una opci&oacute;n.">
                                	 <option value="">Seleccione...</option>
                                     <?php while ($row = mysql_fetch_array($escenarios)) {
                                	 	echo "<option value='".$row['escenario']."'>".$row['escenario']."</option>";										 									 } ?>
                                </select>
                                <p class="botonera"><input type="submit" name="nuevo_escenario" value="Seleccionar escenario" class="button blue" /></p>
                            </form>
                        </div>
					<?php }?>
                        <h3><a href="#">Definir universos</a></h3>
                        <div>
                        <p>Esto cambiar&aacute; la cantidad de universos disponibles. Importante: NO reduzca la cantidad de universos durante un juego, se perder&aacute; toda la informaci&oacute;n de los universos superiores al n&uacute;mero elegido. </p><form action="admin.php" method="post" id="form_universos">
                        <?php echo $message3;?>
                        	<input name="universos" class="required digits" title="Ingrese un n&uacute;mero v&aacute;lido." />
                            <input type="submit" name="send_universos"  id="send_universos" class="button red" value="Definir universos"/>
                        </form>
                        </div>
                        <h3><a href="#">Reiniciar partida</a></h3>
                        <div>
                        	<p>&Uacute;ltima vez que se reinici&oacute; la partida: <?php echo $current['reset_partida'];?></p>
                        	<p>Al comenzar una nueva simulaci&oacute;n, ya sea en un taller nuevo o con un escenario nuevo, debe borrar los datos correspondientes a partidas anteriores. Haga click en "Reinicar partida" para hacerlo.</p>
                            <form action="admin.php" id="reiniciar_partida" method="post" style="float: right;">
                                <input name="confirm_reset" type="password" value="reiniciar" style="display:none;"/>
                                <input type="submit" name="reiniciar_partida" class="button red deleteLink" value="Reiniciar partida"/>
                            </form>
                        </div>
                        <h3><a href="#">Cambiar contrase&ntilde;a administador</a></h3>
                        <div>
                            <form action="admin.php" method="post" id="pass_admin">
                                <?php echo $message2;?>
                                <p>
                                <label for="current_password">Contrase&ntilde;a actual</label>
                                <input name="current_password" type="password" class="required" title="Debe ingresar la contrase&ntilde;a actual" id="current_password"  />
                                </p>                        
                                <p>
                                <label for="password">Nueva contrase&ntilde;a</label>
                                <input name="password" type="password" class="required" title="Debe ingresar una nueva contrase&ntilde;a" id="password2"  />
                                </p>                        
                                <p>
                                <label for="repeat_password">Repetir contrase&ntilde;a</label>
                                <input name="repeat_password" id="repeat_password2" type="password" />
                                </p>
                                <p class="botonera"><input type="submit" name="pass_admin" value="Cambiar contrase&ntilde;a" class="button red" style="text-align: center; margin-left: 20px;"/></p>
                            </form>
                        </div>
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
