<?php $root="";
	require_once($root."includes/session.php"); 
	require_once($root."includes/connect.php"); 
	require_once($root."includes/functions.php");

	if (!logged_in()) {
		redirect_to("index.php");
	}
$sel1= "pn";
$sel2= "estrategia";
	
?>
<?php 

	function createForm() {
		global $connection; 
		global $root; 
		$results = get_single_user_info ('dataEstrategia', $_SESSION['usuario']);
		$num_rows = mysql_num_rows($results);
		$results = mysql_fetch_array($results);

		$fase = "pn";
	?>
	<p>Por favor, describa brevemente cuál cree que será su estrategia de negociación con <?php echo ucfirst(otra_emp($_SESSION['empresa'])); ?>.</p>

	<form action="pn_estrategia.php" id="pn_estrategia" method="post">
        <textarea name="pn_estrategia" ><?php echo $results['estrategia']; ?></textarea>
		<p style="text-align: right;"><input type="submit" name="submit" value="Enviar" class="button white" /></p>
    </form>
    <?php
	}
	
	function processForm() {
		global $connection; 
		global $root;
		$msj = "";
	
		$results = get_single_user_info ('dataEstrategia', $_SESSION['usuario']);

		if (mysql_num_rows($results) == 0) {
			$query = "INSERT INTO dataEstrategia SET usuario = '{$_SESSION['usuario']}', universo = {$_SESSION['universo']}, empresa = '{$_SESSION['empresa']}', estrategia='{$_POST['pn_estrategia']}'";
		} elseif (mysql_num_rows($results) > 0) {
			$query = "UPDATE dataEstrategia SET estrategia='{$_POST['pn_estrategia']}' WHERE usuario = '{$_SESSION['usuario']}'";
		}
		$result = mysql_query($query, $connection);
		confirm_query($result);
		if ($result) {echo "Los datos se han cargado con &eacute;xito.";}
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
<script>$(function() {});</script>
</head>
<body>
<div id="container">
  <?php include($root."includes/us_header.php");?>
  <?php include($root."includes/us_menu.php");?>
  <div id="content">
    <div id="wrap">
      <div class="titulos">
        <p>Prenegociación / La estrategia</p>
      </div>
      <div>
        <!--id="left-column"-->
 					<?php 
                    //SOLO ESTO SE MUESTRA EN EL BODY! //
                   
					if(!isset($_POST['submit'])) {
                        createForm();
                    } else {
                        processForm();
						createForm();						
                    }
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