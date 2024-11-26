<?php $root="";
	require_once($root."includes/session.php"); 
	require_once($root."includes/connect.php"); 
	require_once($root."includes/functions.php");

	if (!logged_in()) {
		redirect_to("index.php");
	}
	$fase = "n1_ver";
?>
<?php include($root."includes/us_docheader.php");?>
<?php include($root."includes/jquery.php");?>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
<style>
	td.variable-comment {display:none;}
	td.variable-name {width: 500px;}
	td.variable-objetivo-small {width: 100px;}
</style></head>
<body>
<div id="container">
  <?php include($root."includes/us_header.php");?>
  <?php include($root."includes/us_menu.php");?>
  <div id="content">
    <div id="wrap">
      <div class="titulos">
        <p>Agenda de la Negociaci&oacute;n / Ver propuesta</p>
      </div>
      <div class="n1 ver">
        <!--id="left-column"-->
        <?php 
		if ($_GET['id']) {
			$results = get_single_value ('dataNegociacion1', 'id', $_GET['id']); //Turn into POST!
			$num_rows = mysql_num_rows($results);
			$results = mysql_fetch_array($results);
			$estado = estado_prop($results['status']);
		?>
        <p>Propuesta de <span class='<?php echo ucfirst($results['empresa']);?>'><?php echo ucfirst($results['empresa']);?></span> 
        para <span class='<?php echo otra_emp($results['empresa']);?>'><?php echo ucfirst(otra_emp($results['empresa']));?></span> 
        - Estado: <span class="estado-<?php echo $estado[0];?>"><?php echo $estado[1];?></span></p>

		<?php
			include ($root."includes/tabla_variables.php");
		} else {echo "<p>No se ha seleccionado ninguna propuesta para ver. <a href='n1_propuestas.php'>Volver</a>";}
		

		//BOTONERA
?>		<p class="botonera"> <?php 

		if ($results['empresa']!=$_SESSION['empresa'] && $estado[0]=="W") { ?>
			<a href="n1_propuestas.php?op=A&id=<?php echo $_GET['id'];?>" class="button blue">Aceptar</a>
			<!--<a href="n1_propuestas.php?op=X&id=<?php echo $_GET['id'];?>" class="button red">Rechazar</a>-->
			<a href="n1_redactar.php?id=<?php echo $_GET['id'];?>" class="button white">Ofrecer contrapropuesta</a>
        <?php }  
		?>      
		<a href="n1_propuestas.php" class="button white">Volver</a>                
		</p>
      </div>
      <div style="clear:both;"></div>
    </div>
  </div>
<?php include($root."includes/us_footer.php"); ?>
</div>
</body>
</html>