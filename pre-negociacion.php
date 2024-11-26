<?php $root="";
//	require_once($root."includes/session.php"); 
	require_once($root."includes/connect.php"); 
	require_once($root."includes/functions.php");

//	if (!logged_in()) {
//		redirect_to("index.php");
//	}
?>
<?php include($root."includes/us_docheader.php");?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js" type="text/javascript"></script>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />
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
        <p>Hola <?php echo $_SESSION['usuario']."-".$_SESSION['universo']."-".$_SESSION['empresa'];?></p>
        <p> Informacion / Empresa Alpha Inc.</p>
      </div>
      <div>
        <!--id="left-column"-->
        <div id="tabs">
          <ul>
            <li><a href="#tabs-1">Integrante 1</a></li>
            <li><a href="#tabs-2">Integrante 2</a></li>
            <li><a href="#tabs-3">Integrante 3</a></li>
            <li><a href="#tabs-4">Integrante 4</a></li>
            <li><a href="#tabs-5">Integrante 5</a></li>
          </ul>
          <div id="tabs-1">
            <div class="float">
              <label for="integrante1_nombre">Nombre</label>
              <br />
              <input name="integrante1_nombre" type="text" class="required" />
            </div>
            <div class="float">
              <label for="integrante1_apellido">Apellido</label>
              <br />
              <input name="integrante1_apellido" type="text" class="required"/>
            </div>
            <div class="clearfix"></div>
            <div class="float">
              <label for="integrante1_rol">Rol</label>
              <br />
              <input name="integrante1_rol" type="text" class="required" />
            </div>
            <div class="float">
              <label for="integrante1_estilo">Estilo Personal</label>
              <br />
              <select name="integrante1_estilo" class="required">
                <option value="">Seleccionar...</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="E">E</option>
              </select>
            </div>
            <div class="clearfix">
              <label for="integrante1_descripcionrol">Breve descripci&oacute;n del rol</label>
              <br />
              <textarea name="integrante1_descripcionrol" class="required"></textarea>
            </div>
          </div>
          <div id="tabs-2">
            <div class="float">
              <label for="integrante2_nombre">Nombre</label>
              <br />
              <input name="integrante2_nombre" type="text" class="required" />
            </div>
            <div class="float">
              <label for="integrante2_apellido">Apellido</label>
              <br />
              <input name="integrante2_apellido" type="text" class="required"/>
            </div>
            <div class="clearfix"></div>
            <div class="float">
              <label for="integrante2_rol">Rol</label>
              <br />
              <input name="integrante2_rol" type="text" class="required" />
            </div>
            <div class="float">
              <label for="integrante2_estilo">Estilo Personal</label>
              <br />
              <select name="integrante2_estilo" class="required">
                <option value="">Seleccionar...</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="E">E</option>
              </select>
            </div>
            <div class="clearfix">
              <label for="integrante2_descripcionrol">Breve descripci&oacute;n del rol</label>
              <br />
              <textarea name="integrante2_descripcionrol" class="required"></textarea>
            </div>
          </div>
          <div id="tabs-3">
            <div class="float">
              <label for="integrante3_nombre">Nombre</label>
              <br />
              <input name="integrante3_nombre" type="text" class="required" />
            </div>
            <div class="float">
              <label for="integrante3_apellido">Apellido</label>
              <br />
              <input name="integrante3_apellido" type="text" class="required"/>
            </div>
            <div class="clearfix"></div>
            <div class="float">
              <label for="integrante3_rol">Rol</label>
              <br />
              <input name="integrante3_rol" type="text" class="required" />
            </div>
            <div class="float">
              <label for="integrante3_estilo">Estilo Personal</label>
              <br />
              <select name="integrante3_estilo" class="required">
                <option value="">Seleccionar...</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="E">E</option>
              </select>
            </div>
            <div class="clearfix">
              <label for="integrante3_descripcionrol">Breve descripci&oacute;n del rol</label>
              <br />
              <textarea name="integrante3_descripcionrol" class="required"></textarea>
            </div>
          </div>
          <div id="tabs-4">
            <div class="float">
              <label for="integrante4_nombre">Nombre</label>
              <br />
              <input name="integrante4_nombre" type="text" class="required" />
            </div>
            <div class="float">
              <label for="integrante4_apellido">Apellido</label>
              <br />
              <input name="integrante4_apellido" type="text" class="required"/>
            </div>
            <div class="clearfix"></div>
            <div class="float">
              <label for="integrante4_rol">Rol</label>
              <br />
              <input name="integrante4_rol" type="text" class="required" />
            </div>
            <div class="float">
              <label for="integrante4_estilo">Estilo Personal</label>
              <br />
              <select name="integrante4_estilo" class="required">
                <option value="">Seleccionar...</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="E">E</option>
              </select>
            </div>
            <div class="clearfix">
              <label for="integrante4_descripcionrol">Breve descripci&oacute;n del rol</label>
              <br />
              <textarea name="integrante4_descripcionrol" class="required"></textarea>
            </div>
          </div>
          <div id="tabs-5">
            <div class="float">
              <label for="integrante5_nombre">Nombre</label>
              <br />
              <input name="integrante5_nombre" type="text" class="required" />
            </div>
            <div class="float">
              <label for="integrante5_apellido">Apellido</label>
              <br />
              <input name="integrante5_apellido" type="text" class="required"/>
            </div>
            <div class="clearfix"></div>
            <div class="float">
              <label for="integrante5_rol">Rol</label>
              <br />
              <input name="integrante5_rol" type="text" class="required" />
            </div>
            <div class="float">
              <label for="integrante5_estilo">Estilo Personal</label>
              <br />
              <select name="integrante5_estilo" class="required">
                <option value="">Seleccionar...</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="E">E</option>
              </select>
            </div>
            <div class="clearfix">
              <label for="integrante5_descripcionrol">Breve descripci&oacute;n del rol</label>
              <br />
              <textarea name="integrante5_descripcionrol" class="required"></textarea>
            </div>
          </div>
        </div>
      </div>
      <!--      <div id="right-column"><img src="images/info-alpha.jpg" width="218" height="478" /></div>-->
      <div style="clear:both;"></div>
    </div>
  </div>
  <div id="footer">
    <div id="wrap">
      <p>© 2012 Brown Simulaciones | www.brownsimulaciones.com.ar | Diseñado y programado por © 6vDesign</p>
    </div>
  </div>
</div>
</body>
</html>
