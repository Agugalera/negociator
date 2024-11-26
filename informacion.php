<?php $root="";

	require_once($root."includes/session.php"); 

	require_once($root."includes/connect.php"); 

	require_once($root."includes/functions.php");



	if (!logged_in()) {
		redirect_to("index.php");
	}

$sel1= "info";
$sel2= $_GET['seccion'];

$escenario = 1;
$result = get_info($escenario);
//miempresa, otraempresa, negociacion, riesgos, robots, mercado

?>


<?php 

//DOCTYPE AND STYLES

include($root."includes/us_docheader.php");

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js" type="text/javascript"></script>

<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>

<!-- <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />-->



</head>

<body>

<div id="container">

  <?php include($root."includes/us_header.php");?>

  <?php include($root."includes/us_menu.php");?>

  <div id="content">

    <div id="wrap" id="informacion">

      <div class="seccion_info">

        <!--id="left-column"-->

			<?php 

            //SOLO ESTO SE MUESTRA EN EL BODY! //
            if($sel2=='') {
				$sel2 = 'miempresa';
			}
			echo $result[$sel2];
            

            //FIN DE LO QUE SE MUESTRA! //

            ?>



        

      </div>

      <!--      <div id="right-column"><img src="images/info-alpha.jpg" width="218" height="478" /></div>  -->

      <div style="clear:both;"></div>

    </div>

  </div>

<?php include($root."includes/us_footer.php"); ?>

</div>

</body>

</html>