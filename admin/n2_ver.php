<?php $root="../";
	require_once($root."includes/session.php"); 
	require_once($root."includes/connect.php"); 
	require_once($root."includes/functions.php");

	if (!logged_in_admin()) {
		redirect_to("index.php");
	}
	$sel1a="n2";
	
	$accion = "ver";
?>
<?php include($root."includes/us_docheader.php");?>
<?php include($root."includes/jquery.php");?>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
<script>
	$(function() {
   		$('#tabla_n2 tr:odd').addClass('even');
		$('#tabla_n2 tr:even').addClass('odd');
		$('#tabla_n2 tr:first').removeClass('even');		
		$('#tabla_n2 tr:first').removeClass('odd');		

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
        <p>Negociaci&oacute;n / Ver propuesta</p>
      </div>
      <div class="n1 ver">
        <!--id="left-column"-->
        <?php 
		if ($_GET['id']) {
			$results = get_single_value ('dataNegociacion2', 'id', $_GET['id']); //Turn into POST!
			$num_rows = mysql_num_rows($results);
			$results = mysql_fetch_array($results);
			$estado = estado_prop($results['status']);
			$acuerdo_n1 = get_single_value ('dataNegociacion1', 'universo', $results['universo'], $and=" status = 'A'");
			$acuerdo_n1 = mysql_fetch_array($acuerdo_n1);

		?>
        <p>Propuesta de <span class='<?php echo ucfirst($results['empresa']);?>'><?php echo ucfirst($results['empresa']);?></span> 
        para <span class='<?php echo otra_emp($results['empresa']);?>'><?php echo ucfirst(otra_emp($results['empresa']));?></span> 
        - Estado: <span class="estado-<?php echo $estado[0];?>"><?php echo $estado[1];?></span></p>

		<?php
			include ($root."includes/tabla_n2.php");
		} else {echo "<p>No se ha seleccionado ninguna propuesta para ver. <a href='negociacion2.php'>Volver</a>";}
		

		//BOTONERA
?>		<p class="botonera"><a class="button red" href='simular.php?id=<?php echo $_GET['id'];?>&empresa=alfa'>Simular Alfa</a><a href='simular.php?id=<?php echo $_GET['id'];?>&empresa=beta' class="button blue">Simular Beta</a><a href="negociacion2.php" class="button white">Volver</a></p>
      </div>
      <!--      <div id="right-column"><img src="images/info-alpha.jpg" width="218" height="478" /></div>-->
      <div style="clear:both;"></div>
    </div>
  </div>
<?php include($root."includes/us_footer.php"); ?>
</div>
</body>
</html>