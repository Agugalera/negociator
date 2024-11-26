<?php $root="../";
	require_once($root."includes/session.php"); 
	require_once($root."includes/connect.php"); 
	require_once($root."includes/functions.php");

	if (!logged_in_admin()) {
		redirect_to("login.php");
	}
$sel1a = "info";
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
		// a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
		
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
					<p>Bienvenido al Simulador - <?php echo $message;?></p>
                </div>
        		<div id="left-column" class="admin">
               	<?php echo $msg; ?>
				<ol>
                    <li>Eliminar datos de partidas anteriores. Ir a <a href="admin.php">Administraci&oacute;n</a>.</li> 
					<li>Cambiar contrase&ntilde;a de los alumnos. Ir a <a href="admin.php">Administraci&oacute;n</a>.</li>
					<li>Seleccionar escenario de juego. Ir a <a href="admin.php">Administraci&oacute;n</a>.</li>
					<li>Explicar funcionamiento de secci&oacute;n de mensajes y resultados.</li>
                	<li>Instruir alumnos a que lean la secci&oacute;n de informaci&oacute;n.</li>
                	<li>Instruir alumnos a que completen los elementos de la prenegociaci&oacute;n</li>
                	<li>Corregir pre-negociaci&oacute;n.</li>
                    <li>Instruir alumnos a que ingresen a la Agenda de la Negociaci&oacute;n. </li>
                    <li>Corregir elementos de la primera fase</li>
                    <li>Instruir alumnos a que ingresen a la Negociaci&oacute;n. </li>
                    <li>Puntuar respuestas de la segunda fase.</li>
                    <li>Puntuar calidad de la comunicaci&oacute;n en la secci&oacute;n de mensajes.</li>
                  </ol>

                
                <div id="dialog" title="Realmente desea reiniciar la partida?" class="dialog">
		      <p>Al reiniciar la partida, <b>todos los datos de las negociaciones y mensajes existentes se perder&aacute;n.</b> </p>
                    <p>Se recomienda realizar esta acci&oacute;n &uacute;nicamente al comienzo de una capacitaci&oacute;n, o en el momento de cambiar de escenario.</p>
               
					<p>Haga click en <strong>Reiniciar </strong>para reiniciar la partida, o en <strong>Cancelar</strong>, si desea conservar los datos.</p>
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
