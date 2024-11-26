<?php $root="";
	require_once($root."includes/session.php"); 
	require_once($root."includes/connect.php"); 
	require_once($root."includes/functions.php");

	if (!logged_in()) {
		redirect_to("index.php");
	}
$sel1="msjs";
$sel2a="ver";
?>	


<?php include($root."includes/us_docheader.php");?>
<meta http-equiv="refresh" content="30" />
</head>

<body>

<div id="container">
	<?php include($root."includes/us_header.php");?>
	<?php include($root."includes/us_menu.php");?>

        
        <div id="content">
        	<div id="wrap">
                <div class="titulos">
                	<p> Mensajes / Empresa <?php echo ucfirst($_SESSION['empresa']);?> Inc.</p>
                </div>
        		<div id="left-column">
					<?php 
					$result = getMensajesByUser($_SESSION['usuario']);
					displayMensajes($result, FALSE); 
					?>
				</div>
	            <div id="right-column"><img src="images/<?php if ($_SESSION['empresa']=="alfa") {echo "info-alpha";} else {echo "info-beta";}?>" width="218" height="478" /></div>
				<div style="clear:both;"></div>
      		</div>      
        </div>
            
<?php include($root."includes/us_footer.php");?>


</div>

</body>
</html>
