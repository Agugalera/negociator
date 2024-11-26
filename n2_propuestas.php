<?php $root="";
	require_once($root."includes/session.php"); 
	require_once($root."includes/connect.php"); 
	require_once($root."includes/functions.php");

	if (!logged_in()) {
		redirect_to("index.php");
	}
$sel1="n2";
$sel2="listas";
$prox = prox_n2 ('dataNegociacion2', $_SESSION['universo']);
?>
<?php include($root."includes/us_docheader.php");?>
<meta http-equiv="refresh" content="30" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js" type="text/javascript"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
<!-- <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />-->
<script>
	$(function() {
	});
</script>
</head>
<body>
<div id="container">
  <?php include($root."includes/us_header.php");?>
  <?php include($root."includes/us_menu.php");?>
  <div id="content">
    <div id="wrap">
      <div class="titulos">
        <p> Negociaci&oacute;n / <?php if ($prox == FALSE ) {echo "Contrato Final";} else {echo "Resumen general";}?></p>
         <?php if ($prox == FALSE ) {
         	$prop = val_prop_aceptada('dataNegociacion2', $_SESSION['universo']);
			$prop = mysql_fetch_array($prop);
		?>
         <p class="botonera">
            <a class="button blue" href="n2_ver.php?id=<?php echo $prop['id'];?>&from=n2_propuestas">Tabla de decisiones</a>
            <a class="button blue" href='n2_simular.php?id=<?php echo $prop['id'];?>&empresa=<?php echo $_SESSION['empresa'];?>&from=n2_propuestas'>Simular</a>
        </p>
        <?php }?>
      </div>
      <div id="left-column" <?php if ($prox == FALSE) {echo "style='width: 100%;'";}?> >
	 	<?php
			if ($prox == FALSE) {include($root."includes/contrato.php");} else {
		
		if ($_GET['op'] && $_GET['id']>0) {
		change_status ('dataNegociacion2',$_GET['id'], $_GET['op']);
		}

		$estados = array('X'=>'Rechazada', 'A'=>'Aceptada', 'R'=>'Respondida', 'W'=>'Esperando respuesta');
		
		$formal = ult_prop ('dataNegociacion2', 1, $_SESSION['universo'], $_SESSION['usuario']);
		$formal_num = mysql_num_rows($formal);
		$formal = mysql_fetch_array($formal);
		
		$informal = ult_prop ('dataNegociacion2', 0, $_SESSION['universo'], $_SESSION['usuario']); 
		$informal_num = mysql_num_rows($informal);
		$informal = mysql_fetch_array($informal);
		?>

        <?php if ($formal_num == 1) {?>
			<div class='box_propuesta' style='position: relative; width: 450px; margin-bottom: 30px;'>				
                <h2>Ultima propuesta enviada: </h2>
                <p>Enviada por <?php echo ucfirst($formal['empresa']);?></p>
                <p>Estado: <?php echo $estados[$formal['status']];?></p>
                <div class="box_botones" style='position: absolute; top: 0px; right: 0;'>
                    <a class='button white ver' href='n2_ver.php?id=<?php echo $formal['id'];?>' style='float: left;'>Ver</a>
                    <a class='button white ver' href='n2_simular.php?id=<?php echo $formal['id'];?>' style='float: left;'>Simular</a>
                    <div class="clearfix"></div>
                </div>
			</div>
		<?php } else {echo "<p>No se han enviado propuestas aún.</p>"; }?>  
              
        <?php if ($informal_num == 1) {?>
			<div class='box_propuesta' style='position: relative; width: 450px; margin-bottom: 30px;'>				
                <h2>Ultima propuesta simulada</h2>
                <div class="box_botones" style='position: absolute; top: 0px; right: 0;'>
                    <a class='button white ver' href='n2_ver.php?id=<?php echo $informal['id'];?>' style='float: left;'>Ver</a>
                    <a class='button white ver' href='n2_simular.php?id=<?php echo $informal['id'];?>' style='float: left;'>Simular</a>
                    <div class="clearfix"></div>
                </div>
			</div>
		<?php } ?>        

        <p style="clear: both;"><a href="n2_redactar.php" class="button blue">Crear nueva propuesta <?php if ($prox != strtolower($_SESSION['empresa'])) {?>(de prueba)<?php }?></a></p>
      </div>
      <div id="right-column">        
	  <?php
			if ($prox == FALSE) {
		?>
        <div class="done" style="font-size: 27px; background: #333; color: #CCC; padding: 15px; text-align:center; line-height: normal; height: 100%;">
			Fase<br/>COMPLETA
        </div>
        <?php } else { ?>
      	<div class="esperando <?php echo strtolower($prox);?>">
        	Esperando acción de
            <span class="proximo"><?php echo strtoupper($prox);?></span>
        </div>
        <?php } }?> 
</div>
      <div style="clear:both;"></div>
    </div>
  </div>
<?php include($root."includes/us_footer.php"); ?>
</div>
</body>
</html>