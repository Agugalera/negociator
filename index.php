<?php $root="";?>
<?php require_once($root."includes/session.php"); ?>
<?php require_once($root."includes/connect.php"); ?>
<?php require_once($root."includes/functions.php"); ?>
<?php
	session_start();
	if (logged_in()) {
		redirect_to("simulador.php");
	}	
	// START FORM PROCESSING
	if (isset($_POST['submit'])) { // Form has been submitted.
		$errors = array();
		$required_fields = array('universo', 'empresa', 'password');
		$errors = array_merge($errors, check_required_fields($required_fields, $_POST));

		$hashed_password = md5(trim(mysql_prep($_POST['password'])));
		$universo = intval($_POST['universo']);
		$empresa = mysql_prep($_POST['empresa']);
		
		if ( empty($errors) ) {
			// Check database to see if password is correct (no username!)
			$query = "SELECT * FROM tablaGeneral WHERE juego_pw = '{$hashed_password}' ";
			$query .= "LIMIT 1";
			$result_set = mysql_query($query);
			confirm_query($result_set);
			if (mysql_num_rows($result_set) == 1) {
				// username/password authenticated
				// and only 1 match
					$_SESSION['universo'] = $universo;
					$_SESSION['empresa'] = $empresa;
					$_SESSION['usuario'] = $empresa.$universo;					
					$_SESSION['login_time'] = time();
					redirect_to("simulador.php");  
			} else {
				// username/password combo was not found in the database
				$message = "<p class='error'>La contrase&ntilde;a no es v&aacute;lida.</p>";
			}
		} else {
			if (count($errors) == 1) {
				$message = "Hubo 1 error en el formulario.";
			} else {
				$message = "Hubo " . count($errors) . " errores en el formulario.";
			}
			$none = "none";
		}
		
	} else { // Form has not been submitted.
		if (isset($_GET['logout']) && $_GET['logout'] == 1) {
			redirect_to($root."index.php");
		} 
		$username = "";
		$password = "";
	}
?>

<?php include($root."includes/us_docheader.php");?>
</head>

<body>
<div id="container" style="background: #84182E;">
	<div id="header">
    	<div id="wrap">
    		<div class="logo"><img src="images/logo-aden.png" alt="Aden - Business School" /></div>
            <div class="leyenda"><img src="images/leyenda.png" alt="Simulador de negociacion" style="padding:15px 0;"/> </div>
		</div>    
    </div>

  
		<div id="menu1" class="menu">
        	<div id="wrap">
&nbsp;
        	</div>
        </div>
        
        <div id="content" style="background-color:#84182e;">
        	
            <div id="wrap" style="padding-top:40px;">
                
                <div style="float:left; width:460px;">
            	<div class="intro">
<h3>Simulador de Negociaci&oacute;n</h3>
<p>Bienvenidos! Desde ahora, ustedes son un equipo de negociación. Deben llegar a un  acuerdo y firmar un contrato millonario, que cambiará al mercado mundial 
de la robótica. </p><p>¡Pero cuidado! Así como hay mucho en juego, también hay  muchos intereses encontrados, y ninguna de las partes firmará un acuerdo que la perjudique. </p><p>¿Están listos para el desafío?</p>
                </div><div class="clear"></div></div>
	            
               <div style="float:right; width:300px;">
   					<div class="front-signin">
					<form id="login" action="index.php" method="post">
   						<h2>Ingresar al Simulador</h2>
						<?php echo $message;?>
                		<p><label for="universo">Universo</label>
						<select name="universo">
							<option value="">Seleccionar...</option>
							<?php 
							for($i=1; $i<=$current['universos']; $i++) { 
								echo "<option value='".$i."'>".$i."</option>";
							}
							?>
						</select></p><br/>
						<p class="clearfix">
                        <label for="empresa">Empresa</label>
						<select name="empresa">
							<option value="">Seleccionar...</option>
							<option value="alfa">Alfa</option>
							<option value="beta">Beta</option>
						</select>
                        </p><br/>
                        <p class="clearfix">
                        <label for="password">Contrase&ntilde;a</label>
						<input name="password" type="password" />
                        </p>
                        <p class="text-align: center;"><input type="submit" name="submit" value="Ingresar" class="button red"/></p>
                        <div style="clear: both;" ></div>
					</form>
               		</div>
		  	   </div>
			   <div style="clear:both;"></div>
      		</div>      
        </div>
            
<?php include ('includes/us_footer.php');?>

</div>

</body>
</html>
