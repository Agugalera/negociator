<?php $root="../";
	require_once($root."includes/session.php"); 
	require_once($root."includes/connect.php"); 
	require_once($root."includes/functions.php");
	if (!logged_in_admin()) {
		redirect_to("login.php");
	}
$sel1a="msjs";
$sel2a="new";
?>	
<?php
	function createForm() { 
		global $current;
	?>
		<form class="nuevo-msj" method="POST" action="mensaje-escribir.php" id="escribir_mensaje">
			<p>Para: <select name="to">
				<option value="">Seleccione...</p>
				<?php
				for ($i=1; $i<=$current['universos']; $i++) {
					echo "<option value='alfa".$i."'>Alfa ".$i."</option>";
					echo "<option value='beta".$i."'>Beta ".$i."</option>";
				} 
				?>
				</select></p>
			<p>Mensaje:<br/> <textarea name="msj"></textarea></p>
			<p><input type="submit" name="submit" class="button blue" value="Enviar"/></p>
		</form>	
	
<?php }?>	
<?php
	function processForm() { 
		global $root;
		global $connection; 

		$to = $_POST['to'];
		$from = 'instructor';
		$msj = trim(mysql_prep($_POST['msj']));
										
		if (($to != "") && ($msj !="")) {
			$result = send_message($to, $from, $msj);
			if ($result) {
				echo "<p class='exito'>El mensaje se ha enviado con &eacute;xito. <a href='mensajes.php'>Volver</a></p>";
			} else {
				$message .= "<p class='error'>Error. </p><a href='mensajes.php'>Volver</a>"; 
			}
		}
	}
?>
<?php include($root."includes/us_docheader.php");?>
</head>
<body>
<div id="container">
	<?php include($root."includes/admin_header.php");?>
	<?php include($root."includes/admin_menu.php");?>

        
        <div id="content">
        	<div id="wrap">
                <div class="titulos">
                	<p> Mensajes / Empresa <?php echo $_SESSION['empresa'];?> Inc.</p>
                </div>
        		<div id="left-column">
					<?php 
					echo $message;
                    //SOLO ESTO SE MUESTRA EN EL BODY! //
                    if(!isset($_POST['submit'])) {
                        createForm();
                    } else {
                        processForm();
                    }
                    //FIN DE LO QUE SE MUESTRA! //
                    ?>


				
				</div>
	            <div id="right-column"><img src="<?php echo $root;?>images/info-alpha.jpg" width="218" height="478" /></div>
				<div style="clear:both;"></div>
      		</div>      
        </div>
            
<?php include($root."includes/us_footer.php");?>


</div>

</body>
</html>
