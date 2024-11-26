<?php // $root="../";?>
<?php // require_once($root."includes/session.php"); ?>
<?php //require_once($root."includes/connect.php"); ?>
<?php // require_once($root."includes/functions.php"); ?>
<?php 
	$clausulas = 0;
	$claus_text = array("Quinta", "Sexta", "S&eacute;ptima");
	function get_team ($equipo, $universo) {
		global $connection;
		$query = "SELECT nombre, apellido, empresa, universo FROM dataEquipos WHERE empresa = '{$equipo}' AND universo = {$universo}";
		$result = mysql_query($query, $connection);
		confirm_query($result);
		return $result;
	}

	$equipo_alfa = get_team("alfa", $_SESSION['universo']);
	$alfa_num = mysql_num_rows($equipo_alfa);
	$count = 1;
	$eq_alfa = "";
	if ($alfa_num > 0) {
		while ($row = mysql_fetch_array($equipo_alfa)) {
			$eq_alfa .= ucfirst(strtolower($row['nombre']))." ".ucfirst(strtolower($row['apellido'])); 
			if ($count<$alfa_num)  {$eq_alfa .= ", ";}
			$count++;
		}
	}

	$equipo_beta = get_team ("beta", $_SESSION['universo']);
	$beta_num = mysql_num_rows($equipo_beta);
	$count = 1;
	$eq_beta = "";
	while ($row = mysql_fetch_array($equipo_beta)) {
		$eq_beta .= ucfirst(strtolower($row['nombre']))." ".ucfirst(strtolower($row['apellido'])); 
		if ($count<$beta_num)  {$eq_beta .= ", ";}
		$count++;

	}

	$prop = val_prop_aceptada('dataNegociacion2', $_SESSION['universo']);
	if ($prop) {$prop = mysql_fetch_array($prop);}

?>
<?php $month = array("","enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiempre", "diciembre");?>
<p>En el pa&iacute;s de Pa&iacute;s  Beta, el <?php echo date("d"); ?> de <?php echo $month[intval(date("m"))]; ?> de <?php echo date("Y"); ?>, la empresa Alfa Inc., representada  en este acto por <?php echo $eq_alfa;?> y la empresa Beta Inc., representada en  este acto por <?php echo $eq_beta;?>, en adelante conjuntamente LAS PARTES, convienen  en celebrar el presente acuerdo denominado CONTRATO DE COMPRA DE ROBOTS Y DE  LICENCIA DE FABRICACION (en adelante &ldquo;el Contrato&rdquo;) que se regir&aacute; por las  siguientes condiciones: </p>
<p><strong>Cl&aacute;usula Primera</strong> (Generales)<br />
  El objeto del acuerdo es establecer los  compromisos asumidas mutuamente por las partes. El acuerdo entra en vigor en el  d&iacute;a de la fecha y continuar&aacute; durante los pr&oacute;ximos cinco a&ntilde;os.</p>
<p><strong>Cl&aacute;usula Segunda </strong>(Venta de robots)<br />
  La empresa Beta Inc. se compromete a vender  hasta un volumen de <?php echo $prop['uni_entregar_beta'];?> unidades de robots al a&ntilde;o, de <?php echo $prop['modelos_ensamblar'];?> modelos diferentes,  a elecci&oacute;n de Alfa Inc. Cada unidad vendida tendr&aacute; un precio de U$S <?php echo $prop['precio_beta'];?> mil la  unidad.</p>
<p><strong>Cl&aacute;usula  Tercera </strong>(Compromiso de Compra)<br />
  La empresa Alfa Inc. se compromete a comprar,  como m&iacute;nimo, un volumen anual de <?php echo $prop['unidades_comprar'];?> unidades, durante <?php echo $prop['duracion'];?> a&ntilde;o<?php if ($prop['duracion']>1) {echo "s";}?> a  partir del d&iacute;a de la fecha.</p>
<p><strong>Cl&aacute;usula Cuarta:</strong> (Fabricaci&oacute;n y Regal&iacute;as)<br />
  La empresa Alfa Inc. podr&aacute;, a su sola capacidad,  fabricar <?php echo $prop['modelos_fabricar'];?> modelos diferentes de robots de Beta Inc. Alfa Inc. podr&aacute; fabricar  cualquier cantidad de unidades de estos modelos. La empresa Beta Inc. se  compromete a facilitar a Alfa Inc. toda la informaci&oacute;n y conocimientos  necesarios para que Alfa Inc. fabrique los robots correspondientes a dichos  modelos. Beta Inc., como toda retribuci&oacute;n por el traspaso de la tecnolog&iacute;a  correspondiente, recibir&aacute; un <?php echo $prop['regalias_beta'];?> % del precio de venta de los mismos, en  calidad de regal&iacute;as. </p>

<?php if ($prop['compartir_va'] + $prop['compartir_kh'] >= 1) {?>
<p><strong>Cl&aacute;usula <?php echo $claus_text[$clausulas];?> </strong>(Intercambio tecnol&oacute;gico) <br />
<?php 
$clausulas++;
} 
if ($prop['compartir_va'] == 1) {?>
  Alfa Inc. se compromete a  facilitar a Beta Inc. todo el conocimiento, informaci&oacute;n y datos relativos a su  investigaci&oacute;n sobre Visi&oacute;n Artificial, y a mantener actualizado a Beta Inc.  respecto de los avances relativos a dicha investigaci&oacute;n.<br />
<?php } 
if ($prop['compartir_kh'] == 1) {?>
  Beta Inc. se compromete a  facilitar a Alfa Inc. todo el conocimiento, informaci&oacute;n y datos relativos al  desarrollo, construcci&oacute;n y gesti&oacute;n de una planta industrial para la fabricaci&oacute;n  de robots, optimizada para la fabricaci&oacute;n de los modelos especificados en la  cl&aacute;usula Cuarta del presente contrato.<?php } 
if ($prop['compartir_va'] + $prop['compartir_kh'] >= 1) {?>
</p>
<?php } ?>

<?php if ($prop['exclusividad_compra'] + $prop['exclusividad_venta'] >= 1) {?>
<p><strong>Cl&aacute;usula <?php echo $claus_text[$clausulas]; $clausulas++;?> </strong>(Exclusividad) <br /><?php } 
if ($prop['exclusividad_compra'] == 1) {?>
  Alfa Inc. se compromete  comprar &uacute;nicamente robots de Beta Inc., qued&aacute;ndole prohibida, durante el  per&iacute;odo de validez del presente contrato, la compra de robots de otros  proveedores.<br />
  <?php } 
if ($prop['exclusividad_venta'] == 1) {?>
  Beta Inc. se compromete a  vender, dentro del territorio de Pa&iacute;s Alfa, &uacute;nicamente a Alfa Inc., qued&aacute;ndole prohibida,  durante el per&iacute;odo de validez del presente contrato, la venta de robots de  otros clientes de dicho pa&iacute;s.<?php } if ($prop['exclusividad_compra'] + $prop['exclusividad_venta'] >= 1) {?></p>
<?php }?>

<?php if ($prop['adelanto_beta_alfa'] + $prop['adelanto_alfa_beta'] >0) {?>
<p><strong>Cl&aacute;usula <?php echo $claus_text[$clausulas]; $clausulas++;?> </strong>(aporte  inicial)<br />
<?php } 
if ($prop['adelanto_beta_alfa'] > 0) {?>
  Beta Inc. aportar&aacute; a Alfa  Inc., dentro de los 2 meses de firmado este contrato, el valor de U$S <?php echo $prop['adelanto_beta_alfa'];?> millones.<br />
<?php } 
if ($prop['adelanto_alfa_beta'] > 0) {?>  
  Alfa Inc. aportar&aacute; a Beta  Inc., dentro de los 2 meses de firmado este contrato, el valor de U$S <?php echo $prop['adelanto_alfa_beta'];?> millones.<?php }if ($prop['adelanto_beta_alfa'] + $prop['adelanto_alfa_beta'] >0) {?></p><?php }?>
<p>En  prueba de conformidad de ambas partes, se firman dos (2) ejemplares de un mismo  tenor y a un solo efecto, en el lugar y fecha de celebraci&oacute;n.</p>
<p>&nbsp;</p>
<div class="firma" style="background: url(<?php echo $root;?>images/AA.png) no-repeat left top; height: 90px; width: 230px; position: relative; float: left; margin-right: 100px; "><div style="position: absolute; bottom: 2px; left: 10px;">Por Alfa Inc.</div></div>
<div class="firma" style="background: url(<?php echo $root;?>images/BB.png) no-repeat left top; height: 90px; width: 230px; position: relative; float: left;"><div style="position: absolute; bottom: 2px; left: 20px;">Por Beta Inc.</div></div>
<div style="clear: both;"></div>

