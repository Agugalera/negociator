<?php $root="";
	require_once($root."includes/session.php"); 
	require_once($root."includes/connect.php"); 
	require_once($root."includes/functions.php");

	if (!logged_in()) {
		redirect_to("index.php");
	}
?>	


<?php include($root."includes/us_docheader.php");?>
</head>

<body>

<div id="container">
	<?php include($root."includes/us_header.php");?>
	<?php include($root."includes/us_menu.php");?>

        
        <div id="content">
        	<div id="wrap">
                <div class="titulos">
					<p>Hola <?php echo $_SESSION['usuario']."-".$_SESSION['universo']."-".$_SESSION['empresa'];?></p>
                	<p> Informacion / Empresa Alpha Inc.</p>
					<p><a href="<?php echo $root;?>mensaje-escribir.php">Redactar</a></p><p><a href="<?php echo $root;?>mensajes.php">Ver todos</a></p>
                </div>
        		<div id="left-column">
					<?php 
					echo $query = "SELECT * FROM dataMensajes WHERE to = '{$_SESSION['usuario']}' OR from = '{$_SESSION['usuario']}' ORDER BY hora DESC";
					$result = mysql_query($query, $connection);
					confirm_query ($result); 
					while ($msj = mysql_fetch_array($result)) {
						echo "<div class='mensaje-".substr($msj['to'], 0, 4)."'>";
							echo "<div class='header'>Mensaje de ";
							echo substr($msj['to'],0,4;
							if(substr($msj['to'],0,4) =="alfa" || substr($msj['to'],0,4) =="beta") {echo ucfirst(substr($msj['to'],0,4))} else {echo ucfirst($msj['to']);}
							echo "</div>";
							echo "<div class='msj'>".$msj['msj']."</div>";
						echo "</div>";
					}
					?>
				
					<p>Suspendisse condimentum vestibulum augue, id mattis nulla iaculis ac. Vestibulum ultricies hendrerit ipsum vitae ultricies. Cras lobortis ultrices fermentum. Suspendisse pharetra </p>
				</div>
	            <div id="right-column"><img src="images/info-alpha.jpg" width="218" height="478" /></div>
				<div style="clear:both;"></div>
      		</div>      
        </div>
            
<?php include($root."includes/us_footer.php");?>


</div>

</body>
</html>
