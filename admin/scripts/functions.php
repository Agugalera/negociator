<?php 
	$root = "../../";
	require_once($root."includes/session.php"); 
	require_once($root."includes/connect.php"); 
	require_once($root."includes/functions.php");


//REINICIAR PARTIDA 
if (isset($_POST['reiniciar_partida'])) {
	$tablas = array('dataClima', 'dataEquipos', 'dataEstrategia', 'dataMensajes', 'dataNegociacion1', 'dataNegociacion2', 'dataSieteElementos', 'dataVarsClave', 'tablaEstadoFases');
	foreach($tablas as $tabla)  {
		$query = "TRUNCATE TABLE {$tabla}";
		$result = mysql_query($query, $connection);
	}
	$rows = 0;
	foreach ($tablas as $tabla) {
		$query = "SELECT * FROM  {$tabla}";
		$result = mysql_query($query, $connection);
		$rows = $rows + mysql_num_rows($result);
	}
	if ($rows > 0) {
		$msg = "<p class='error'>Hubo un error al reiniciar la partida.</p>";
	} else {
		$query = "UPDATE tablaGeneral SET reset_partida = CURRENT_TIMESTAMP WHERE admin_username = '{$_SESSION['admin']}'";
		$result = mysql_query($query, $connection);
		confirm_query($result);
		redirect_to($root.'admin/index.php');
	}
}
?>