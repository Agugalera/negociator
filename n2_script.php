<?php
	$root="";
	require_once($root."includes/session.php"); 
	require_once($root."includes/connect.php"); 
	require_once($root."includes/functions.php");

	//CASO 1: SIMULAR
	if (isset($_POST['simular']) && $_POST['modelos_ensamblar']) {
		//VIENE DE REDACTAR --> crear id nuevo
		$varclave = array('modelos_ensamblar', 'unidades_comprar', 'duracion', 'uni_entregar_beta', 'precio_beta', 'modelos_fabricar', 'regalias_beta', 'compartir_va', 'compartir_kh', 'exclusividad_compra', 'exclusividad_venta', 'adelanto_beta_alfa', 'adelanto_alfa_beta'); 
		$query_varclave = "";
		for ($i = 0; $i < count($varclave); $i++) {
			if ($_POST[$varclave[$i]] !="") {
				$query_varclave .= $varclave[$i]." = ".$_POST[$varclave[$i]];
				$query_varclave .=", ";
			}
		}
		$query = "INSERT INTO dataNegociacion2 SET ";
		$query .= $query_varclave;
		$query .= " usuario = '{$_SESSION['usuario']}', universo = {$_SESSION['universo']}, empresa = '{$_SESSION['empresa']}' ";
		
		$result = mysql_query($query, $connection);
		confirm_query($result);
		if ($result) {redirect_to($root.'n2_simular.php?id='.mysql_insert_id());}
	}
	
	
	//CASO 2: ENVIAR
	if (isset($_POST['enviar']) && $_POST['modelos_ensamblar']) {
		//CAMBIAR ESTADO ULT PROPUESTA
		$ult_prop = ult_prop('dataNegociacion2', 1, $_SESSION['universo'], $_SESSION['usuario']);
		if (mysql_num_rows($ult_prop)>0) {
			$ult_prop = mysql_fetch_array($ult_prop); 
			change_status ('dataNegociacion2', $ult_prop['id'], 'R');
		}
		//GUARDAR NUEVA PROPUESTA
		$varclave = array('modelos_ensamblar', 'unidades_comprar', 'duracion', 'uni_entregar_beta', 'precio_beta', 'modelos_fabricar', 'regalias_beta', 'compartir_va', 'compartir_kh', 'exclusividad_compra', 'exclusividad_venta', 'adelanto_beta_alfa', 'adelanto_alfa_beta'); 
		$query_varclave = "";
		for ($i = 0; $i < count($varclave); $i++) {
			if ($_POST[$varclave[$i]] !="") {
				$query_varclave .= $varclave[$i]." = ".$_POST[$varclave[$i]];
				$query_varclave .=", ";
			}
		}
		$query = "INSERT INTO dataNegociacion2 SET ";
		$query .= $query_varclave;
		$query .= "usuario = '{$_SESSION['usuario']}', universo = {$_SESSION['universo']}, empresa = '{$_SESSION['empresa']}', status='W'";
		$result = mysql_query($query, $connection);
		confirm_query($result);
		if ($result) {redirect_to('n2_propuestas.php');}
	}

?>