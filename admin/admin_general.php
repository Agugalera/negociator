<?php $root="../";
	require_once($root."includes/session.php"); 
	require_once($root."includes/connect.php"); 
	require_once($root."includes/functions.php");

	if (!logged_in_admin()) {
		redirect_to("login.php");
	}
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
<?php  //PROCESAMIENTO INICIAL


//REINICIAR PARTIDA 
	if ($_POST['confirm_reset']=="reiniciar") {
		$tablas = array('dataClima', 'dataEquipos', 'dataEstrategia', 'dataMensajes', 'dataNegociacion1', 'dataNegociacion2', 'dataSieteElementos', 'dataVarsClave', 'tablaEstadoFases');
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
	}
//FIN ESCENARIO

//CAMBIAR CONTRASEÑA
	
	if (isset($_POST['cambiar_pwd'])) {
		if ($_POST['password']=="") {
			$message = "<p class='error'>Debe ingresar una nueva contrase&ntilde;a.</p>";
		} elseif ($_POST['password']!=$_POST['repeat_password']) {
			$message = "<p class='error'>Las contrase&ntilde;as no coinciden.</p>";
		} else {
			$hashed_password = md5(trim(mysql_prep($_POST['password'])));
			$query = "UPDATE tablaGeneral SET juego_pw = '{$hashed_password}', reset_password = CURRENT_TIMESTAMP";
			$result = mysql_query($query, $connection);
			confirm_query($result);
			$message = "<p class='exito'>La contrase&ntilde;a se ha cambiado con &eacutexito.</p>";
		}
	} 
//FIN CAMBIAR CONTRASEÑA

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
		$("#dialog").dialog({
			  modal: true,
					bgiframe: true,
					width: 528,
					height: 261,
			  autoOpen: false
		});
		$(".deleteLink").click(function(e) {
			e.preventDefault();
			var theHREF = $(this).parents('form').attr("action");
	
			$("#dialog").dialog('option', 'buttons', {
					"Reiniciar" : function() {
						$('form#reiniciar_partida').submit();
					},
					"Cancelar" : function() {
						$(this).dialog("close");
						}
					});
	
			$("#dialog").dialog("open");
	
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
/*		
		$("form#reset_pwd").hide();
		$(".expand_pass").click(function(){
			$("form#reset_pwd").slideToggle();							 
		});
	*/			
	});
	</script>

</head>

<body>

<div id="container">
	<?php include($root."includes/us_header.php");?>
	<?php include($root."includes/admin_menu.php");?>
        
        <div id="content">
        	<div id="wrap">
                <div class="titulos">
					<p>Bienvenido al Simulador - <?php echo $message;?></p>
                </div>
        		<div id="left-column" class="admin">
                    <div id="accordion">
                        <h3><a href="#">Cambiar contrase&ntilde;a de los alumnos</a></h3>
                        <div>
                            <form action="index.php" method="post" id="reset_pwd">
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
                            <form action="index.php" method="post" id="nuevo_escenario">
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
                        <h3><a href="#">Reiniciar partida</a></h3>
                        <div>
                            <p>
                            Nam enim risus, molestie et, porta ac, aliquam ac, risus. Quisque lobortis.
                            Phasellus pellentesque purus in massa. Aenean in pede. Phasellus ac libero
                            ac tellus pellentesque semper. Sed ac felis. Sed commodo, magna quis
                            lacinia ornare, quam ante aliquam nisi, eu iaculis leo purus venenatis dui.
                            </p>
                            <ul>
                                <li>List item one</li>
                                <li>List item two</li>
                                <li>List item three</li>
                            </ul>
                        </div>
                        <h3><a href="#">Cambiar contrase&ntilde;a administador</a></h3>
                        <div>
                            <p>
                            Cras dictum. Pellentesque habitant morbi tristique senectus et netus
                            et malesuada fames ac turpis egestas. Vestibulum ante ipsum primis in
                            faucibus orci luctus et ultrices posuere cubilia Curae; Aenean lacinia
                            mauris vel est.
                            </p>
                            <p>
                            Suspendisse eu nisl. Nullam ut libero. Integer dignissim consequat lectus.
                            Class aptent taciti sociosqu ad litora torquent per conubia nostra, per
                            inceptos himenaeos.
                            </p>
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
