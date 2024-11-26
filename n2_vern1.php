<?php $root="";
	require_once($root."includes/session.php"); 
	require_once($root."includes/connect.php"); 
	require_once($root."includes/functions.php");

	if (!logged_in()) {
		redirect_to("index.php");
	}
	$sel1= "n2";
	$sel2= "n2_vern1";
	$fase = "n1_ver";
?>
<?php include($root."includes/us_docheader.php");?>
<?php include($root."includes/jquery.php");?>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
<script>

</script>
<style>
	td.variable-comment {display:none;}
	td.variable-name {width: 500px;}
	td.variable-objetivo-small {width: 100px;}
</style>
</head>
<body>
<div id="container">
  <?php include($root."includes/us_header.php");?>
  <?php include($root."includes/us_menu.php");?>
  <div id="content">
    <div id="wrap">
      <div class="titulos">
        <p>Prenegociaci&oacute;n / Ver propuesta</p>
      </div>
      <div class="n1 ver">
        <!--id="left-column"-->
        <?php 
		$fasen1 = fase_completa('dataNegociacion1', $_SESSION['universo']);
		if ($fasen1) {
			$results = get_single_value ('dataNegociacion1', 'id', $fasen1['id']); //Turn into POST!
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
		
?>
      </div>
      <div style="clear:both;"></div>
    </div>
  </div>
<?php include($root."includes/us_footer.php"); ?>
</div>
</body>
</html>