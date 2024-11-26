<?php $root="";
	require_once($root."includes/session.php"); 
	require_once($root."includes/connect.php"); 
	require_once($root."includes/functions.php");
	if (!logged_in()) {
		redirect_to("index.php");
	}
$sel1="msjs";
$sel2a="new";

	function createForm() { ?>
		<form class="nuevo-msj" method="POST" action="mensaje-escribir.php" id="escribir_mensaje">
			<p>Para: <select name="to">
            <?php 
			if (pn_aprobado($_SESSION['usuario'])) {?>
				<option value="<?php if ($_SESSION['empresa']=='alfa') {echo "beta".$_SESSION['universo'];} else {echo "alfa".$_SESSION['universo'];}?>"><?php if ($_SESSION['empresa']=='alfa') {echo "Beta";} else {echo "Alfa";}?></option>
            <?php }?>
				<option value="instructor">Instructor</option>
			</select></p>
			<p>Mensaje:<br/> <textarea name="msj"></textarea></p>
			<p><input type="submit" name="submit" class="button <?php if ($_SESSION['empresa']=='alfa') {echo "blue";} else {echo "red";}?>" value="Enviar"/></p>
		</form>	
<?php }?>
<?php
if (isset($_POST['submit'])) {processForm();}

function processForm() { 
		global $root;
		global $connection; 

		$to = $_POST['to'];
		$from = $_SESSION['usuario'];
		$msj = trim(mysql_prep($_POST['msj']));
										
		if (($to != "") && ($msj !="")) {
			$result = send_message($to, $from, $msj);
			if ($result) {
				redirect_to($root."mensajes.php");
			} else {
				$message .= "<p class='error'>Se ha producido un error. </p><a class='button white' href='mensajes.php'>Volver</a>"; 
			}
		}
	}
?>
<?php include($root."includes/us_docheader.php");?>
</head>
<body>
<div id="container">
	<?php include($root."includes/us_header.php");?>
	<?php include($root."includes/us_menu.php");?>

        
        <div id="content">
        	<div id="wrap">
                <div class="titulos">
                	<p>Escribir Mensaje</p>
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
	            <div id="right-column"><img src="images/<?php if ($_SESSION['empresa']=="alfa") {echo "info-alpha";} else {echo "info-beta";}?>" width="218" height="478" /></div>
				<div style="clear:both;"></div>
      		</div>      
        </div>
            
<?php include($root."includes/us_footer.php");?>


</div>

</body>
</html>
