<?php $root="";
	require_once($root."includes/session.php"); 
	require_once($root."includes/connect.php"); 
	require_once($root."includes/functions.php");

	if (!logged_in()) {
		redirect_to("index.php");
	}
$cant_jugadores = 5;	
$sel1= "pn";
$sel2= "equipo";
?>
<?php 
	function createForm() {
		global $connection; 
		global $root;
		global $cant_jugadores;
		?>
                <p>Por favor, ingrese los datos correspondientes a los integrantes de su equipo.</p>
                <form action="pn_equipo.php" method="post" id="pn_equipo">
                  <div id="tabs">
                    <input type="submit" name="submit" value="Enviar" class="button white" style="position: absolute; bottom: 10px; right: 5px;" />
                    <ul>
                      <?php 
                                for ($i = 1; $i <= $cant_jugadores; $i++) {
                                    echo "<li><a href='#tabs-".$i."'>Integrante ".$i."</a></li>";
                                }
                             ?>
                    </ul>
                    <?php 
                        
                        for ($i = 1; $i <= $cant_jugadores; $i++) {
                            $query = "SELECT * FROM dataEquipos WHERE usuario = '{$_SESSION['usuario']}' AND integrante = {$i} LIMIT 1";
                            $result = mysql_query($query, $connection);
                            confirm_query ($result); 
                            $result = mysql_fetch_array($result);
                            ?>
                    <div id="tabs-<?php echo $i;?>" class="integrante">
                      <div class="float">
                        <label for="integrante<?php echo $i;?>_nombre">Nombre</label>
                        <br />
                        <input name="integrante<?php echo $i;?>_nombre" type="text" class="required" value="<?php echo $result['nombre'];?>" />
                      </div>
                      <div class="float">
                        <label for="integrante<?php echo $i;?>_apellido">Apellido</label>
                        <br />
                        <input name="integrante<?php echo $i;?>_apellido" type="text" class="required" value="<?php echo $result['apellido'];?>" />
                      </div>
                      <div class="clearfix"></div>
                      
                      <div class="float">
                        <label for="integrante<?php echo $i;?>_rol">Rol</label>
                        <br />
                        <input name="integrante<?php echo $i;?>_rol" type="text" class="required" value="<?php echo $result['rol'];?>" />
                      </div>
                      <div class="float">
                        <label for="integrante<?php echo $i;?>_estilo">Estilo Personal</label>
                        <br />
                        <select name="integrante<?php echo $i;?>_estilo" class="required">
                          <option value="">Seleccionar...</option>
                          <option value="A" <?php if ($result['estilo']=="A") {echo " selected = 'selected' ";}  ?>>A</option>
                          <option value="B" <?php if ($result['estilo']=="B") {echo " selected = 'selected' ";}  ?>>B</option>
                          <option value="C" <?php if ($result['estilo']=="C") {echo " selected = 'selected' ";}  ?>>C</option>
                          <option value="D" <?php if ($result['estilo']=="D") {echo " selected = 'selected' ";}  ?>>D</option>
                          <option value="E" <?php if ($result['estilo']=="E") {echo " selected = 'selected' ";}  ?>>E</option>
                        </select>
                      </div>
                    <div class="clearfix">
                       <!--   <label for="integrante<?php echo $i;?>_descripcionrol">Breve descripci&oacute;n del rol</label>
                        <br />
                        <textarea name="integrante<?php echo $i;?>_descripcionrol" class="required"><?php echo $result['rol_desc'];?></textarea>-->
                      </div>
                    </div>
                    <?php } ?>
                  </div>
                </form>
		<?php  	
	return $msj;		
		
		}
	function processForm() {
		global $connection; 
		global $root;
		global $cant_jugadores;
		$msj = "";
		for ($i = 1; $i <= $cant_jugadores; $i++) {
			
			/* 	columnas
			
				id
				usuario
				universo
				integrante
				empresa
				nombre
				apellido
				estilo
				rol
				rol_desc
			
			*/
			if ($_POST['integrante'.$i.'_nombre'] !="" && $_POST['integrante'.$i.'_apellido'] !="" ) {
				$query = "SELECT * FROM dataEquipos WHERE usuario = '{$_SESSION['usuario']}' AND integrante = {$i}";
				$results = mysql_query($query, $connection);
				confirm_query($results);
				$desc_rol = trim(mysql_prep($_POST['integrante'.$i.'_descripcionrol']));
				if (mysql_num_rows($results) == 0) {
					$query = "INSERT INTO dataEquipos ";
					$query .= "SET usuario = '{$_SESSION['usuario']}', universo = {$_SESSION['universo']}, empresa = '{$_SESSION['empresa']}', integrante = {$i}, 						nombre = '{$_POST['integrante'.$i.'_nombre']}', ";
					 $query .= "apellido = '{$_POST['integrante'.$i.'_apellido']}', estilo = '{$_POST['integrante'.$i.'_estilo']}', rol = '{$_POST['integrante'.$i.'_rol']}' ";
					 //, rol_desc = '{$desc_rol}' "; 
					$result = mysql_query($query, $connection);
					confirm_query ($result); 
					if ($result) {//$msj .= "Exito integrante ".$i.". ";
					} else {$msj .= "Problema integrante ".$i.". ";}
				} else {
					$query = "UPDATE dataEquipos
							SET nombre = '{$_POST['integrante'.$i.'_nombre']}', apellido = '{$_POST['integrante'.$i.'_apellido']}', estilo =  '{$_POST['integrante'.$i.'_estilo']}', rol = '{$_POST['integrante'.$i.'_rol']}' WHERE usuario = '{$_SESSION['usuario']}' AND integrante = {$i} LIMIT 1";  //, rol_desc = '{$desc_rol}'
					$result = mysql_query($query, $connection);
					confirm_query ($result); 
					if ($result) {//$msj .= "Exito update integrante ".$i.". ";
					} else {$msj .= "Problema update integrante ".$i.". ";}
				}
				
			} else {//$msj .= "No se ingresó datos para el integrante ".$i.". ";
			}
		}
	if ($msj =="") {$msj = "Los integrantes se han cargado con éxito.";}
	echo "<p>".$msj."</p>";		
	createForm();
	
	}


?>
<?php include($root."includes/us_docheader.php");?>
<?php include($root."includes/jquery.php");?>
<script>
	$(function() {
		$( "#tabs" ).tabs();
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
        <p>Prenegociación / El equipo <?php echo ucfirst($_SESSION['empresa']);?></p>
      </div>
      <div>
        <!--id="left-column"-->
					<?php 
                    //SOLO ESTO SE MUESTRA EN EL BODY! //
                    echo $msj;
					if(!isset($_POST['submit'])) {
                        createForm();
                    } else {
                        processForm();
                    }
                    //FIN DE LO QUE SE MUESTRA! //
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
