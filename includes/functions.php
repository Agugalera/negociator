<?php //FORM FUNCTIONS
function check_required_fields($required_array) {
	$field_errors = array();
	foreach($required_array as $fieldname) {
		if (!isset($_POST[$fieldname]) || (empty($_POST[$fieldname]) && $_POST[$fieldname] != 0) || $_POST[$fieldname] =="") { 
			$field_errors[] = $fieldname; 
		}
	}
	return $field_errors;
}

function check_max_field_lengths($field_length_array) {
	$field_errors = array();
	foreach($field_length_array as $fieldname => $maxlength ) {
		if (strlen(trim(mysql_prep($_POST[$fieldname]))) > $maxlength) { $field_errors[] = $fieldname; }
	}
	return $field_errors;
}

function check_min_field_lengths($field_length_array) {
	$field_errors = array();
	foreach($field_length_array as $fieldname => $minlength ) {
		if (strlen(trim(mysql_prep($_POST[$fieldname]))) < $minlength) { $field_errors[] = $fieldname; }
	}
	return $field_errors;
}

function display_errors($error_array) {
	echo "<p class=\"errors\">";
	echo "Please review the following fields:<br />";
	foreach($error_array as $error) {
		echo " - " . $error . "<br />";
	}
	echo "</p>";
}

function exists($value, $table, $table_field, $additional) {
	global $connection; 
	$query = "SELECT * FROM {$table} WHERE {$table_field} = '{$value}' ";
	$query .= $additional;
	$results = mysql_query($query, $connection);
	confirm_query($results);
	if (mysql_num_rows($results) == 0) {return FALSE;} else {return TRUE;}
}
?>
<?php //FUNCIONES GRALES

//Checks if query was ok and provides Error message
function confirm_query ($resultados) {
	if (!$resultados) {
		die ("Error en la query: ".mysql_error());
	}
}
function redirect_to( $location = NULL ) {
    if ($location != NULL) {
        header("Location: {$location}");
        exit;
    }
}
function mysql_prep( $value ) {
	$magic_quotes_active = get_magic_quotes_gpc();
	$new_enough_php = function_exists( "mysql_real_escape_string" ); // i.e. PHP >= v4.3.0
	if( $new_enough_php ) { // PHP v4.3.0 or higher
		// undo any magic quote effects so mysql_real_escape_string can do the work
		if( $magic_quotes_active ) { $value = stripslashes( $value ); }
		$value = mysql_real_escape_string( $value );
	} else { // before PHP v4.3.0
		// if magic quotes aren't already on then add slashes manually
		if( !$magic_quotes_active ) { $value = addslashes( $value ); }
		// if magic quotes are active, then the slashes already exist
	}
	return $value;
}

?>
<?php // FUNCIONES DE DB

function get_info ($escenario) {
	global $connection; 
	$query = "SELECT * FROM baseInformacion WHERE escenario = {$escenario} AND empresa = '{$_SESSION['empresa']}' LIMIT 1";
	$result = mysql_query($query, $connection);
	confirm_query ($result);
	return $result = mysql_fetch_array($result);
}

function get_single_user_info ($db, $user, $and="") {
	global $connection; 
	$query = "SELECT * FROM {$db} WHERE usuario = '{$user}' {$and}";
	$result = mysql_query($query, $connection);
	confirm_query($result);
	return $result;
}
function get_single_value ($db, $field, $criteria, $and="") {
	global $connection; 
	$query = "SELECT * FROM {$db} WHERE {$field} = ";
	if (is_string($criteria)) {
				  $query .= "'{$criteria}' ";} 	else {$query .= " {$criteria} ";} 
	if ($and !="") {$query .=  " AND ".$and;}
//	echo $query; 
	$result = mysql_query($query, $connection);
	confirm_query($result);
	return $result;
}

function send_message ($to, $from, $msj) {
	global $connection;
	$query ="INSERT INTO `dataMensajes` (`id_msj`, `recipient`, `sender`, `msj`, `hora`) VALUES (NULL, '{$to}', '{$from}', '{$msj}', CURRENT_TIMESTAMP)";
	$result = mysql_query($query, $connection);
	confirm_query ($result); 
	return $result; 
}
function change_status ($db, $id, $status) {
	global $connection;
	$query ="UPDATE {$db} SET status = '{$status}' WHERE id = {$id}";
	$result = mysql_query($query, $connection);
	confirm_query ($result); 
	$action = array("X" => "rechazado ", "A" => "aceptado ", "R" => "respondido a ");
	send_message (ucfirst(otra_emp($_SESSION['empresa'])).$_SESSION['universo'], 'Sistema', ucfirst($_SESSION['empresa'])." ha ".$action[$status]."tu propuesta.");
	return $result;	
}
function get_ultimas_dos ($tabla, $universo) {
	global $connection; 
	$query = "SELECT {$tabla}.* FROM {$tabla} 
			RIGHT JOIN (SELECT Max({$tabla}.ID) AS MaxOfID FROM {$tabla}
			GROUP BY {$tabla}.Universo, {$tabla}.Empresa
			HAVING ({$tabla}.Universo = {$universo}))  as Intermedia ON  {$tabla}.ID = Intermedia.MaxOfID
			ORDER BY ID DESC";
	$result = mysql_query($query, $connection);
	confirm_query($result);	
	return $result;
}

function ult_prop ($tabla, $formal, $universo, $usuario=FALSE) {
	global $connection; 
	if ($formal == 1) {
		$query = "SELECT * FROM {$tabla} WHERE status IS NOT NULL AND universo = {$universo} ORDER BY id DESC LIMIT 1";
	}
	if ($formal == 0) {
		$query = "SELECT * FROM {$tabla} WHERE status IS NULL ";
		if ($usuario) {
			$query.= "AND usuario = '{$usuario}' ";
		}
		$query .= "ORDER BY id DESC LIMIT 1";
	}
	$result = mysql_query($query, $connection);
	confirm_query ($result); 
	return $result; 
}
function get_current_game () {
	global $connection; 
	$query = "SELECT * FROM tablaGeneral";
	$current = mysql_query($query, $connection);
	confirm_query($current);	
	return $current = mysql_fetch_array($current);
}
function getMensajesByUser ($user) {
	global $connection; 
	$query = "SELECT * FROM dataMensajes WHERE sender = '{$user}' OR recipient = '{$user}' ORDER BY hora DESC";
	$current = mysql_query($query, $connection);
	confirm_query($current);	
	return $current;
}
function getMensajesByUniverse ($universo) {
	global $connection; 
	$query = "SELECT * FROM dataMensajes WHERE sender LIKE '%{$universo}' OR recipient  LIKE '%{$universo}' ORDER BY hora DESC";
	$current = mysql_query($query, $connection);
	confirm_query($current);	
	return $current;
}
function puntuacion_PN($usuario) {
	global $connection;
	$tablas = array('dataVarsClave' => 'claves', 'dataClima'=>'clima', 'dataSieteElementos'=>'elementos', 'dataEstrategia'=>'estrategia'); 
	$puntaje_pn = FALSE;
	foreach($tablas as $tabla => $key) {
		$query = "SELECT puntaje FROM {$tabla} WHERE usuario = '{$usuario}'";
		$result = mysql_query ($query, $connection);
		confirm_query($query);
		if (count($result)>0) {
			$row = mysql_fetch_array($result);
			if ($row['puntaje']>0) {
				$puntaje_pn[$key]=$row['puntaje'];
			}
		}
	}
	return $puntaje_pn;
}
function pn_aprobado ($usuario) {
	global $passing_note;
	$puntajes = puntuacion_PN($usuario); 
	$aprobado = TRUE; 
	if ($puntajes == FALSE || count($puntajes)==0) {
		$aprobado=FALSE;
	} else {
		if (count($puntajes) >= 3) {
		foreach ($puntajes as $puntaje) {
			if ($puntaje < $passing_note || $puntaje=="") {
				$aprobado = FALSE;
			}
		}} else {$aprobado = FALSE;}
	}
	return $aprobado;
}
function prop_aceptada($tabla, $universo) {
	global $connection; 
	$query = "SELECT * FROM {$tabla} WHERE universo = {$universo} AND status = 'A'";
	$result = mysql_query ($query, $connection);
	confirm_query($query);
	if (mysql_num_rows($result) > 0 ) {
		return TRUE;
	} else {
		return FALSE;
	}
}
function val_prop_aceptada($tabla, $universo) {
	global $connection; 
	$query = "SELECT * FROM {$tabla} WHERE universo = {$universo} AND status = 'A'";
	$result = mysql_query ($query, $connection);
	confirm_query($query);
	if (mysql_num_rows($result) > 0 ) {
		return $result;
	} else {
		return FALSE;
	}
}

?>
<?php //FUNCIONES VARIAS 
	function otra_emp($emp) {
		if ($emp =="alfa") {return "Beta";} else {return "Alfa";}
	}
	function estado_prop($ini="") {
		$estados = array('X'=>'Rechazada', 'A'=>'Aceptada', 'R'=>'Respondida', 'W'=>'Esperando respuesta');
		if (!$estados[$ini]) {$ini = "W";}

		$estado = array($ini, $estados[$ini]);
		return $estado;
	}
	function prox_n2 ($tabla, $universo) {
		global $connection; 
		$last = ult_prop ($tabla, 1, $universo);
		$num_row = mysql_num_rows($last);
		$last = mysql_fetch_array($last);
		if ($num_row == 0) {
			$prox = "alfa";
		} elseif ($last['status']=="A") {
			$prox = FALSE;
		} elseif ($last['status']=="X") {
			$prox = $last['empresa'];
		} else {
			$prox = otra_emp($last['empresa']);
		}
		return $prox;
	}
	function fase_completa ($tabla, $universo) {
		global $connection; 
		$query = "SELECT * FROM {$tabla} WHERE universo = {$universo} AND status = 'A' LIMIT 1";
		$result = mysql_query($query, $connection);
		confirm_query($result);		
		if (mysql_num_rows($result) >= 1) {
			return $row = mysql_fetch_array($result);
		} else {
			return FALSE;
		}
	}
	function displayMensajes($result, $full_username) {
		if (mysql_num_rows($result)==0) {
			echo "<p>No hay mensajes.</p>";
		}else {
		//$full_username = TRUE, show full user - Otherwise, show only company name.
		while ($msj = mysql_fetch_array($result)) {
		echo "<div class='mensaje ".substr($msj['sender'], 0, 4)."'>";
			echo "<div class='header'>Mensaje de ";
			if($full_username == FALSE && (strtolower(substr($msj['sender'],0,4)) =="alfa" || strtolower(substr($msj['sender'],0,4) =="beta"))) 
				{echo ucfirst(substr($msj['sender'],0,4));
				} else {echo ucfirst($msj['sender']);}
			echo " a ";
			if($full_username == FALSE && (strtolower(substr($msj['recipient'],0,4)) =="alfa" || strtolower(substr($msj['recipient'],0,4)) =="beta"))
				{
					echo ucfirst(substr($msj['recipient'],0,4));
				} else {
					echo ucfirst($msj['recipient']);
				}
				
			echo "<span class='hora'>";
			echo date('H:i', (strtotime($msj["hora"])+(14400)))." ART";
			echo "</span>";
			echo "</div>";
			echo "<div class='msj'>".$msj['msj']."</div>";
		echo "</div>";
		}
		}
	}
	function get_puntaje ($usuario, $fase) {
		global $connection; 
		$query = "SELECT * FROM tablaPuntajes WHERE usuario = '{$usuario}' AND fase = '{$fase}'";
		$result = mysql_query ($query, $connection);
		confirm_query($result); 
		if (mysql_num_rows($result)>0) {
			return $row = mysql_fetch_array($result);
		} else {return FALSE;}
	}
	function get_puntaje_gral ($usuario) {
		global $connection; 
		$query = "SELECT * FROM tablaPuntajes WHERE usuario = '{$usuario}' ORDER BY fase ASC";
		$result = mysql_query ($query, $connection);
		confirm_query($result); 
		if (mysql_num_rows($result)>0) {
			$neg = array();
			while ($row = mysql_fetch_array($result)) {
				$neg[$row['fase']] = $row ['puntaje'];
			};
			return $neg;
		} else {return FALSE;}
	}
	function minmax($var, $min, $max) {		
		$min_max = "{min: ".min($min, $max).", max: ".max($min, $max)."}";
		echo $var."_min: ".$min_max.", ";
		echo $var."_max: ".$min_max.", ";
		echo $var."_obj: ".$min_max;				
	} 
	function minmax_simple ($var, $min, $max) {		
		$min_max = "{min: ".min($min, $max).", max: ".max($min, $max)."}";
		echo $var.": ".$min_max;	
	} 
?>
<?php //CONSTANTES Y CONTROLES
	$cant_jugadores = 5;
	$estados = array('X'=>'Rechazada', 'A'=>'Aceptada', 'R'=>'Respondida', 'W'=>'Esperando respuesta');
	$puntaje_maximo = 10;
	$current = get_current_game(); 
	$passing_note = 4;
?>