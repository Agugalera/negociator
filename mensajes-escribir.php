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
					<form class="nuevo-msj">
						<p>Para: <select name="to">
							<option value="<?php if ($_SESSION['empresa']=='alfa') {echo "beta".$_SESSION['universo']} else {echo "alfa".$_SESSION['universo']}?>"><?php if ($_SESSION['empresa']=='alfa') {echo "Beta"} else {echo "Alfa"}?></option>
							<option value="instructor">Instructor</option>
						</select></p>
						<p>Mensaje: <textarea name="msj"></textarea></p>
						<p><input type="submit" class="button <?php if ($_SESSION['empresa']=='alfa') {echo "blue"} else {echo "red"}?>" value="Enviar"/></p>
					</form>
				
				<p>
				
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultricies enim est. Morbi vehicula velit at turpis posuere vitae ornare ante blandit. Duis tempor dictum est vel rhoncus. Suspendisse sed tellus leo. Sed vestibulum, libero id rhoncus bibendum, nisl turpis convallis erat, nec aliquam ligula enim non est. Vestibulum porta dapibus eleifend. Mauris in erat lectus, sed vehicula diam. Duis a nisl magna. Integer magna leo, feugiat vel ultricies sit amet, pellentesque porta augue. Nam hendrerit urna vel orci laoreet vehicula. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Integer vel nibh elit, eget pretium turpis. Nulla luctus arcu quis neque rutrum quis dapibus urna sagittis.

Donec euismod vestibulum laoreet. Etiam sit amet tellus quis velit semper dapibus sed vel elit. Integer at augue euismod mauris dapibus euismod nec sagittis enim. Etiam fringilla enim sit amet tellus sagittis tincidunt. In hac habitasse platea dictumst. Cras ut arcu libero, nec euismod eros. Integer dapibus dictum hendrerit. Donec eget lacus nisl.

Vivamus sed orci varius mauris sollicitudin hendrerit eu at sapien. Praesent lorem nulla, fringilla ac consequat vitae, tristique vel magna. Ut blandit interdum leo eget laoreet. Vivamus et justo lectus. Sed consectetur faucibus mauris, quis ullamcorper magna convallis in. Curabitur at mi nisi, quis dignissim ante. Nunc iaculis lorem in urna auctor fringilla. Curabitur in volutpat est. Quisque non turpis enim. Phasellus id magna eget tortor ullamcorper ultricies et posuere arcu. Morbi non orci ligula. Nunc aliquet nulla non felis suscipit viverra. Ut aliquam, sapien posuere scelerisque egestas, orci odio lobortis magna, non porta magna orci et eros. In dignissim lorem vitae felis euismod sed vulputate libero pellentesque. Duis pellentesque aliquet urna a interdum.

Suspendisse condimentum vestibulum augue, id mattis nulla iaculis ac. Vestibulum ultricies hendrerit ipsum vitae ultricies. Cras lobortis ultrices fermentum. Suspendisse pharetra </p></div>
	            <div id="right-column"><img src="images/info-alpha.jpg" width="218" height="478" /></div>
				<div style="clear:both;"></div>
      		</div>      
        </div>
            
<?php include($root."includes/us_footer.php");?>


</div>

</body>
</html>
