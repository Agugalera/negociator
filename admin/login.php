<?php $root="../";?>
<?php require_once($root."includes/session.php"); ?>
<?php require_once($root."includes/connect.php"); ?>
<?php require_once($root."includes/functions.php"); ?>
<?php
	session_start();
	confirm_logged_in_admin();
	// START FORM PROCESSING
	if (isset($_POST['submit'])) { // Form has been submitted.
		$errors = array();
		$required_fields = array('usuario', 'password');
		$hashed_password = md5(trim(mysql_prep($_POST['password'])));
		
		// Check database to see if password is correct (no username!)
		$query = "SELECT * FROM tablaGeneral WHERE admin_username = '{$_POST['usuario']}' AND admin_pw = '{$hashed_password}' LIMIT 1";
		$result_set = mysql_query($query);
		confirm_query($result_set);
		if (mysql_num_rows($result_set) == 1) {
			// username/password authenticated
			// and only 1 match
				$_SESSION['admin'] = $_POST['usuario'];					
				$_SESSION['admin_time'] = time();
				redirect_to("index.php");  
		} else {
			// username/password combo was not found in the database
			$message = "<p class='error'>La contrase&ntilde;a no es v&aacute;lida.</p>";
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
    		<div class="logo"><img src="<?php echo $root;?>images/logo-aden.png" alt="Aden - Business School" /></div>
            <div class="leyenda"><img src="<?php echo $root;?>images/leyenda.png" alt="Simulador de negociacion" style="padding:15px 0;"/> </div>
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
                <div class="intro" style="height: 200px;">
<h3>Simulador de Negociaci&oacute;n</h3>
<p>Bienvenido al m&oacute;dulo de administrador del simulador de negociaci&oacute;n de ADEN. Desde este m&oacute;dulo podr&aacute; gestionar las actividades del taller-simulador.</p>
<p>Podr&aacute; gestionar, otorgar puntajes y examinar decisiones y resultados de cada equipo de negociaci&oacute;n.</p>
<p>&nbsp;</p>
                </div>
                </div>
	            
               <div style="float:right; width:300px;">
   					<div class="front-signin" style="height: 200px;">
					<form id="login" action="login.php" method="post">
   						<h2>Administrar  Simulador</h2>
						<?php echo $message;?>
                        <p>
                        <label for="usuario">Usuario</label>
						<input name="usuario" type="text" />
                        </p>                        
                        <p>
                        <label for="password">Contrase&ntilde;a</label>
						<input name="password" type="password" />
                        </p>
                    	<input type="submit" name="submit" value="Ingresar" class="button red" style="text-align: center; margin-left: 20px;"/>
                        <div class="clearfix"></div>
					</form>
               		</div>
		  	   </div>
			   <div style="clear:both;"></div>
      		</div>      
        </div>
            
<?php include ($root.'includes/us_footer.php');?>

</div>

</body>
</html>
