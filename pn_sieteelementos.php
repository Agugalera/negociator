<?php $root="";
	require_once($root."includes/session.php"); 
	require_once($root."includes/connect.php"); 
	require_once($root."includes/functions.php");

	if (!logged_in()) {
		redirect_to("index.php");
	}
$sel1= "pn";
$sel2= "elemtos";
?>
<?php 
	function createForm() {
	global $root;
	global $connection; 

	$result = get_single_user_info ('dataSieteElementos', $_SESSION['usuario']);
	if (mysql_num_rows($result)>0) {
		$row = mysql_fetch_array($result);
	}

?>
        <p>Por favor, evalúe los 7 Elementos de esta negociación, con un breve párrafo para cada uno, y decida si quiere compartir cada análisis con la empresa <?php echo ucfirst(otra_emp($_SESSION['empresa']));?> Inc.</p>
        <form action="pn_sieteelementos.php" id="sieteelementos" method="post">
          <table cellspacing="0" cellpadding="0">
            <tr class="table-head">
              <td class="txt"></td>
              <td class="textarea">An&aacute;lisis</td>
              <td class="share">Compartir</td>
            </tr>
            <tr class="odd">
              <td class="txt"><strong>Alternativas</strong> (obligatorio)</td>
              <td class="textarea"><textarea name="alternativas" id="alternativas" cols="45" rows="5" class="required" title="Este campo es obligatorio"><?php echo $row['alternativas'];?></textarea></td>
              <td class="share"><input type="checkbox" name="share_alternativas" id="share_alternativas"  value="1" <?php if ($row['share_alternativas']==1) {echo " checked = 'checked' ";}?> /></td>
            </tr>
            <tr class="even">
              <td class="txt"><strong>Intereses</strong> (obligatorio)</td>
              <td class="textarea"><textarea name="intereses" id="intereses" cols="45" rows="5" class="required" title="Este campo es obligatorio"><?php echo $row['intereses'];?></textarea></td>
              <td class="share"><input type="checkbox" name="share_intereses" id="share_intereses" value="1" <?php if ($row['share_intereses']==1) {echo " checked = 'checked' ";}?> /></td>
            </tr>
            <tr class="odd">
              <td class="txt"><strong>Opciones</strong> (obligatorio)</td>
              <td class="textarea"><textarea name="opciones" id="opciones" cols="45" rows="5" class="required" title="Este campo es obligatorio"><?php echo $row['opciones'];?></textarea></td>
              <td class="share"><input type="checkbox" name="share_opciones" id="share_opciones" value="1" <?php if ($row['share_opciones']==1) {echo " checked = 'checked' ";}?>  /></td>
            </tr>
            <tr class="even">
              <td class="txt">Legitimidad</td>
              <td class="textarea"><textarea name="legitimidad" id="legitimidad" cols="45" rows="5" class="" title="Este campo es opcional"><?php echo $row['legitimidad'];?></textarea></td>
              <td class="share"><input type="checkbox" name="share_legitimidad" id="share_legitimidad" value="1" <?php if ($row['share_legitimidad']==1) {echo " checked = 'checked' ";}?> /></td>
            </tr>
            <tr class="odd">
              <td class="txt">Compromisos</td>
              <td class="textarea"><textarea name="compromisos" id="compromisos" cols="45" rows="5" class="" title="Este campo es opcional"><?php echo $row['compromisos'];?></textarea></td>
              <td class="share"><input type="checkbox" name="share_compromisos" id="share_compromisos" value="1" <?php if ($row['share_compromisos']==1) {echo " checked = 'checked' ";}?> /></td>
            </tr>
            <tr class="even">
              <td class="txt">Comunicaci&oacute;n</td>
              <td class="textarea"><textarea name="comunicacion" id="comunicacion" cols="45" rows="5" class="" title="Este campo es opcional"><?php echo $row['comunicacion'];?></textarea></td>
              <td class="share"><input type="checkbox" name="share_comunicacion" id="share_comunicacion"  value="1" <?php if ($row['share_comunicacion']==1) {echo " checked = 'checked' ";}?> /></td>
            </tr>
            <tr class="odd">
              <td class="txt">Relaci&oacute;n</td>
              <td class="textarea"><textarea name="relacion" id="relacion" cols="45" rows="5" class="" title="Este campo es opcional"><?php echo $row['relacion'];?></textarea></td>
              <td class="share"><input type="checkbox" name="share_relacion" id="share_relacion" value="1" <?php if ($row['share_relacion']==1) {echo " checked = 'checked' ";}?> /></td>
            </tr>
          </table>
          <p class="botonera">
            <input type="submit" class="button white" name="submit" value="Enviar" />
          </p>
        </form>
<?php
	}
	function processForm() {
		global $root; 
		global $connection; 
		$msj = "";
		$varclave = array('alternativas', 'intereses', 'opciones', 'legitimidad', 'compromisos', 'comunicacion', 'relacion'); 
		$query_varclave = "";
		for ($i = 0; $i < count($varclave); $i++) {
			$query_varclave .= $varclave[$i]." = '".$_POST[$varclave[$i]]."', ";
			$query_varclave .= "share_".$varclave[$i]." = ";
			if ($_POST['share_'.$varclave[$i]] == 0) {$query_varclave .=  '0';} else {$query_varclave .= '1';};
			if ($i < (count($varclave)-1)) {$query_varclave .=", ";}
		}
		$query_varclave;
		$results = get_single_user_info ('dataSieteElementos', $_SESSION['usuario']) ;

		if (mysql_num_rows($results) == 0) {
			$query = "INSERT INTO dataSieteElementos SET usuario = '{$_SESSION['usuario']}', universo = {$_SESSION['universo']}, empresa = '{$_SESSION['empresa']}', ";
			$query .= $query_varclave;
		} elseif (mysql_num_rows($results) > 0) {
			$query = "UPDATE dataSieteElementos SET ";
			$query .= $query_varclave;
			$query .= " WHERE usuario = '{$_SESSION['usuario']}'";
		}
		$result = mysql_query($query, $connection);
		confirm_query($result);
		if ($result) {echo "<p class='exito'>Sus datos se han cargado con &eacute;xito</p>";}
	}


?>
<?php include($root."includes/us_docheader.php");?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js" type="text/javascript"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
<!-- <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />-->
<script>
	$(function() {
		$("#sieteelementos").validate({
		    errorElement: "div"
		});
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
        <p>Prenegociación / Los 7 elementos</p>
      </div>
      <div>
        <!--id="left-column"-->
        <?php 
                    //SOLO ESTO SE MUESTRA EN EL BODY! //
					if(!isset($_POST['submit'])) {
                        createForm();
                    } else {
                        processForm();
						createForm();						
                    }                    //FIN DE LO QUE SE MUESTRA! //
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
