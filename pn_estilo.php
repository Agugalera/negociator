<?php $root="";
	require_once($root."includes/session.php"); 
	require_once($root."includes/connect.php"); 
	require_once($root."includes/functions.php");

	if (!logged_in()) {
		redirect_to("index.php");
	}
$sel1= "pn";
$sel2= "estilo";
?>
<?php include($root."includes/us_docheader.php");?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js" type="text/javascript"></script>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />
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
        <p>Prenegociación / El estilo</p>
      </div>
      <div>
        <!--id="left-column"-->
			<?php 

			$result = get_info($current['escenario']);

            //SOLO ESTO SE MUESTRA EN EL BODY! //
			echo $result['pn_estilo'];
            

            //FIN DE LO QUE SE MUESTRA! //

            ?>
      </div>
      <!--      <div id="right-column"><img src="images/info-alpha.jpg" width="218" height="478" /></div>-->
      <div style="clear:both;"></div>
    </div>
  </div>
  <?php include($root."includes/us_footer.php");?>
</div>
</body>
</html>
