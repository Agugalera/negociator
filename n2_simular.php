<?php $root="";
	require_once($root."includes/session.php"); 
	require_once($root."includes/connect.php"); 
	require_once($root."includes/functions.php");
	require_once($root."includes/FuncionALFAyBETA.php");

	if (!logged_in()) {
		redirect_to("index.php");
	}
	$query = "SELECT * FROM tablaGeneral";
	$current = mysql_query ($query, $connection);
	confirm_query ($current);
	$current = mysql_fetch_array($current);
	$anios = 5;
	$sel1 = "n2";
	$sel2 = "sim";
?>
<?php  include($root."includes/us_docheader.php");?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<?php include($root."includes/jquery.php");?>
<script type="text/javascript">
	$(function() {
		$( "#accordion" ).accordion({
			autoHeight: false,
			navigation: true,
			collapsible: true
		});
			
		$(".infoadicional").toggle(function() {
			$(this).children('button').text('-').parent().next(".explicacion").slideToggle();
		}, function() {
			$(this).children('button').text('+').parent().next(".explicacion").slideToggle();
		});
	});
</script>
<?php /*GRAF PARAMETERS */ 
$empresa = $_SESSION['empresa'];
$id = $_GET['id'];
include ($root."scripts/generar_graf.php");
?>
</head>

<body>

<div id="container">
	<?php include($root."includes/us_header.php");?>
	<?php include($root."includes/us_menu.php");?>

        
        <div id="content">
        	<div id="wrap">
                <div class="titulos">
					<p>Simular propuesta</p>
                </div>
        		<div ><?php include($root."includes/mostrar_graficos.php");?></div>
				<div style="clear:both;"></div>
      		</div>      
        </div>
            
	<?php include($root."includes/us_footer.php");?>


</div>

</body>
</html>