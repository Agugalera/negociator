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
					<p>Bienvenido a la Negociaci&oacute;n de <?php echo ucfirst($_SESSION['empresa']);?> Inc.</p>
                </div>
        		<div id="left-column">
                <?php if ($_SESSION['empresa']=="alfa") {?>
        		  <p>Su empresa, Alfa Inc., es una compa&ntilde;&iacute;a de productos  electr&oacute;nicos de gran tama&ntilde;o y muy diversificada, que tiene su base de  operaciones en Pa&iacute;s Alfa. Planea convertirse en l&iacute;der en el equipamiento de  &quot;la f&aacute;brica del futuro&quot;, pero en el corto plazo carece de la  tecnolog&iacute;a de automatizaci&oacute;n adecuada. Debe adquirir equipos extranjeros, de  alta calidad, y debe hacerlo pronto.</p><p>
        		    Para eso, debe llegar a un acuerdo con Beta Inc., el principal  fabricante de equipos el&eacute;ctricos integrados en Pa&iacute;s Beta. Beta Inc. ya fabrica  estos equipos, y desea expandir su mercado.</p>
                  <p>Para lograr este acuerdo deber&aacute;n realizar una negociaci&oacute;n. </p><p>
                    Primero, deben obtener informaci&oacute;n sobre Alfa Inc., sobre el  mercado de la rob&oacute;tica y su tecnolog&iacute;a (Secci&oacute;n <strong>Informaci&oacute;n</strong>), armar un equipo negociador y evaluar la situaci&oacute;n  previa a la negociaci&oacute;n (secci&oacute;n <strong>Pre-negociaci&oacute;n</strong>).</p>
                  <p>
                    Luego, comunic&aacute;ndose con la otra parte (en persona, o a trav&eacute;s  de la secci&oacute;n <strong>Mensajes</strong>) deber&aacute;n  acordar los Agenda de la negociaci&oacute;n, y luego llegar a un acuerdo firme para  cerrar un contrato (secci&oacute;n <strong>Negociaci&oacute;n</strong>). </p><p>
                    Siempre podr&aacute;n ver las consecuencias que dicho contrato tiene  en el futuro de la empresa, para poder evaluar los resultados de una propuesta  u otra.</p><p>
                    El Instructor estar&aacute; evaluando su desempe&ntilde;o, tanto en la  pre-negociaci&oacute;n como en la negociaci&oacute;n, y mostrar&aacute; su evaluaci&oacute;n en la secci&oacute;n <strong>Resultados</strong>.</p>
                  <p>&iexcl;Muchos &eacute;xitos!</p>
                <?php } if ($_SESSION['empresa']=="beta") {?>
                  
                  <p>Su empresa, Beta Inc., es el principal fabricante de equipos  el&eacute;ctricos integrados en Pa&iacute;s Beta; es una firma l&iacute;der en el campo y est&aacute;  produciendo robots de alta calidad y a buenos costos. Busca convertirse en el  mayor productor mundial de rob&oacute;tica en los pr&oacute;ximos a&ntilde;os, para lo que deber&aacute;  duplicar su capacidad de producci&oacute;n y desarrollar una gran cartera de clientes.  Pero el mercado de robots de Pa&iacute;s Beta se est&aacute; saturando, y para seguir  creciendo Beta Inc. debe encontrar clientes en otras latitudes.</p>
<p>Beta Inc. quiere llegar a un acuerdo con Alfa Inc., una  compa&ntilde;&iacute;a de productos electr&oacute;nicos de gran tama&ntilde;o y muy diversificada, que  tiene su base de operaciones en Pa&iacute;s Alfa y cuenta con una gran experiencia en  el mercado, una gran red de servicio, el mayor sistema de distribuci&oacute;n de Pa&iacute;s  Alfa y una buena reputaci&oacute;n.</p>
                  <p>Para lograr este acuerdo deber&aacute;n realizar una negociaci&oacute;n. </p><p>
                    Primero, deben obtener informaci&oacute;n sobre Alfa Inc., sobre el  mercado de la rob&oacute;tica y su tecnolog&iacute;a (Secci&oacute;n <strong>Informaci&oacute;n</strong>), armar un equipo negociador y evaluar la situaci&oacute;n  previa a la negociaci&oacute;n (secci&oacute;n <strong>Pre-negociaci&oacute;n</strong>).</p>
                  <p>
                    Luego, comunic&aacute;ndose con la otra parte (en persona, o a trav&eacute;s  de la secci&oacute;n <strong>Mensajes</strong>) deber&aacute;n  acordar la Agenda de la negociaci&oacute;n, y luego llegar a un acuerdo firme para  cerrar un contrato (secci&oacute;n <strong>Negociaci&oacute;n</strong>). </p><p>
                    Siempre podr&aacute;n ver las consecuencias que dicho contrato tiene  en el futuro de la empresa, para poder evaluar los resultados de una propuesta  u otra.</p><p>
                    El Instructor estar&aacute; evaluando su desempe&ntilde;o, tanto en la  pre-negociaci&oacute;n como en la negociaci&oacute;n, y mostrar&aacute; su evaluaci&oacute;n en la secci&oacute;n <strong>Resultados</strong>.</p>
                  <p>&iexcl;Muchos &eacute;xitos!</p>
                                  <?php }?>

              </div>
	            <div id="right-column"><img src="images/<?php if ($_SESSION['empresa']=="alfa") {echo "info-alpha";} else {echo "info-beta";}?>.jpg" width="218" height="478" /></div>
				<div style="clear:both;"></div>
      		</div>      
        </div>
            
<?php include($root."includes/us_footer.php");?>

</div>

</body>
</html>
