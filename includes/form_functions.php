<?php
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