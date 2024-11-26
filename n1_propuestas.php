<?php $root="";
	require_once($root."includes/session.php"); 
	require_once($root."includes/connect.php"); 
	require_once($root."includes/functions.php");

	if (!logged_in()) {
		redirect_to("index.php");
	}
$sel1="n1";
$sel2="lista";
		if ($_GET['op'] && $_GET['id']>0) {
		change_status ('dataNegociacion1',$_GET['id'], $_GET['op']);
		//send_message (ucfirst(otra_emp($_SESSION['empresa'])).$_SESSION['universo'], 'Sistema', ucfirst($_SESSION['empresa'])." ha enviado una nueva propuesta.");
}

		
		$mensajes = get_ultimas_dos ('dataNegociacion1', $_SESSION['universo']);
//		if ($_GET['op']=='A') {redirect_to("n2_propuestas.php");
		?>

<?php include($root."includes/us_docheader.php");?>
<meta http-equiv="refresh" content="30" />
<?php include($root."includes/jquery.php");?>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
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
        <p>Agenda de la Negociaci&oacute;n</p>
      </div>
      <div id="left-column">

		<?php 
		$xcount = 0;
		if (mysql_num_rows($mensajes) == 0) {
			echo "<p>No se han hecho propuestas a&uacute;n.</p>";
		} else {
			$prop_txt = array("Última propuesta: ", "Propuesta anterior: ");
			$i=0;
			while ($row = mysql_fetch_array($mensajes)) {; 
				if ($row['status']!="") {$status = $row['status'];} else {$status="W";}
				echo "<div class='box_propuesta' style='position: relative; width: 250px; margin-bottom: 30px;'>";				
				echo "<h2>".$prop_txt[$i]."</h2>";
				echo "<p>Enviada por ".ucfirst($row['empresa'])."</p>";
				echo "<p>Estado: ".$estados[$status]."</p>";
				echo "<a class='button white ver' href='n1_ver.php?id=".$row['id']."' style='position: absolute; top: 0px; right: 0'>Ver</a>";
				echo "</div>";
				$i++;
				if ($estados[$status]=="x") {$xcount++;}
			}
		}
		if ($xcount == 2) {?>
			<div id="acciones">
            	<a href="n1_redactar.php" class="button red">Nueva propuesta</a>
            </div>
		<?php
		}
		?>
      </div>
      <div id="right-column">
        <?php $prox = prox_n2 ('dataNegociacion1', $_SESSION['universo']); 
			if ($prox == FALSE) {
		?>
        <div class="done" style="font-size: 27px; background: #333; color: #CCC; padding: 15px; text-align:center; line-height: normal; height: 100%; padding: 20px 0;">
			Fase<br/>COMPLETA
        </div>
        <?php } else { ?>
      	<div class="esperando <?php echo strtolower($prox);?>" >
        	Esperando acción de
            <span class="proximo"><?php echo strtoupper($prox);?></span>
        </div>
        <?php } ?>
</div>
      <div style="clear:both;"></div>
    </div>
  </div>
<?php include($root."includes/us_footer.php"); ?>
</div>
</body>
</html>