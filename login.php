<?php $root="../";?>
<?php require_once($root."includes/session.php"); ?>
<?php require_once($root."includes/connect.php"); ?>
<?php require_once($root."includes/functions.php"); ?>
<?php
	if (logged_in()) {
		redirect_to("index.php");
	}
	include_once($root."includes/form_functions.php");
	
	// START FORM PROCESSING
	if (isset($_POST['submit'])) { // Form has been submitted.
		$errors = array();

		// perform validations on the form data
		$required_fields = array('email', 'password');
		$errors = array_merge($errors, check_required_fields($required_fields, $_POST));

//		$fields_with_lengths = array('username' => 30, 'password' => 30);
//		$errors = array_merge($errors, check_max_field_lengths($fields_with_lengths, $_POST));

		$email = trim(mysql_prep($_POST['email']));
		$password = trim(mysql_prep($_POST['password']));
		$hashed_password = md5($password);
		
		if ( empty($errors) ) {
			// Check database to see if username and the hashed password exist there.
			$query = "SELECT tblUsers.id, tblUsers.username, tblUsers.temp, tblUsers.confirm_code, tblEmpresas.id AS emp_id, tblEmpresas.empresa, tblEmpresas.admin_email ";
			$query .= "FROM tblUsers JOIN tblEmpresas ON tblUsers.id = tblEmpresas.user_id ";
			$query .= "WHERE admin_email = '{$email}' ";
			$query .= "AND hashed_password = '{$hashed_password}' ";
			$query .= "LIMIT 1";
			$result_set = mysql_query($query);
			confirm_query($result_set);
			if (mysql_num_rows($result_set) == 1) {
				// username/password authenticated
				// and only 1 match
				$found_user = mysql_fetch_array($result_set);
				if ($found_user['temp'] == 0) {
					$_SESSION['user_id'] = $found_user['id'];
					$_SESSION['username'] = $found_user['username'];
					$_SESSION['email'] = $found_user['admin_email'];					
					$_SESSION['name'] = $found_user['empresa'];										
					$_SESSION['login_time'] = time();
					$_SESSION['emp_id'] = $found_user['emp_id'];
					redirect_to("index.php");  
				} elseif ($found_user['temp'] == 1) {
					$message = "La cuenta debe ser validada. Ingrese a su mail. <br /><a href='mail_confirmacion.php?id=".$found_user['id']."'>Reenviar mail de confirmación.</a>";
				}
			} else {
				// username/password combo was not found in the database
				$message = "Combinaci&oacute;n de usuario/contrase&ntilde;a incorrecta.<br />
					Int&eacute;ntelo nuevamente.";
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


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Acceso al Sitio</title>
<link href="<?php echo $root;?>style.css" rel="stylesheet" type="text/css" />
</head>		
<body>	
		<div id="container">
            <div id="header" style="border-bottom:1px solid #ccc;">
				<div class="logo"><a href="<?php echo $root;?>index.php" alt="Equipamiento Medico.net"><img src="<?php echo $root;?>images/logo.jpg" width="320" height="60" alt="Equipamiento Medico.net" /></a></div>
                
            </div>
            <div id="login">
            	<div class="login-head">
                	<h3>Ingresa a mi cuenta</h3><p style="float:right; margin:0; padding-left:220px;"><a href="<?php echo $root;?>index.php">Volver al sitio</a></p>
                </div>

                <form action="login.php" method="post">
                
                <div class="clearfix"> 
				<br />
<br />
<?php if (!empty($message)) {echo "<p class=\"message\">" . $message . "</p>";} ?>
			<?php if (!empty($errors)) { display_errors($errors); } ?><br />
          			<label for="user_name">Email</label>
                    <div class="input"><input type="text" name="email" maxlength="30" value="<?php echo htmlentities($email); ?>" />      
                    </div>
				</div>
             	<div class="clearfix">
					<label for="user_name">Contraseña</label>
  					<div class="input"><input type="password" name="password" maxlength="30" value="<?php echo htmlentities($password); ?>" />
				    <p class="help-block">Olvide mi clave (?)</p>
                    </div>
                </div>
                <div style="padding-left:165px;"><input type="submit" class="button blue" name="submit" value="Login" /></div>
            
            </form>
            <p style="border-top:1px solid #ddd; padding-top:10px; text-align:center;">¿Aún no eres usuario? <a href="http://www.6vdesign.com.ar/equipamientos_medicos/usuario-nuevo.php">Registrate </a></p>
        </div> 
        
        
       

<?php // include("includes/footer.php"); ?>
</div>

</body></html>