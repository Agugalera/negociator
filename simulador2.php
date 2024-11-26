<?php $root="";
	require_once($root."includes/session.php"); 
	require_once($root."includes/connect.php"); 
	require_once($root."includes/functions.php");
	require_once($root."includes/FuncionALFAyBETA.php");

	$query = "SELECT * FROM tablaGeneral";
	$current = mysql_query ($query, $connection);
	confirm_query ($current);
	$current = mysql_fetch_array($current);
	$anios = 5;
?>
<?php include($root."includes/us_docheader.php");?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<?php include($root."includes/jquery.php");?>
<script type="text/javascript">
	$(function() {
		$( "#accordion" ).accordion({
			autoHeight: false,
			navigation: true
		});
	});


</script>
<script type="text/javascript">

  // Load the Visualization API and the piechart package.
  google.load('visualization', '1.0', {'packages':['corechart']});

  // Set a callback to run when the Google Visualization API is loaded.
 // google.setOnLoadCallback(drawChart);

  // Callback that creates and populates a data table,
  // instantiates the pie chart, passes in the data and
  // draws it.
  	<?php 
		$simulacion = get_single_value ('dataNegociacion2', 'id', $_GET['id']);
		$simulacion = mysql_fetch_array($simulacion);
		$graf1 = SimuladorAlfa ($simulacion['modelos_ensamblar'], $simulacion['unidades_comprar'], $simulacion['duracion'], $simulacion['uni_entregar_beta'], $simulacion['precio_beta'], $simulacion['modelos_fabricar'], $simulacion['regalias_beta'], $simulacion['compartir_va'], $simulacion['compartir_kh'], $simulacion['exclusividad_compra'], $simulacion['exclusividad_venta'], $simulacion['adelanto_beta_alfa'], $simulacion['adelanto_alfa_beta']); 
		$Venta_robots_ensamblados = $graf1['Venta_robots_ensamblados'];
		$Venta_robots_fabricados =  $graf1['Venta_robots_fabricados'];
		$Venta_robots_otros =  $graf1['Venta_robots_otros'];
	?>

  
  function drawGraf1() {
		
	// Create the data table.
	var data = new google.visualization.arrayToDataTable([
         ['A&ntilde;o', 'Robots Ensamblados', 'Robots Fabricados', 'Robots-Otros'],
	<?php 
	
		for ($i=0; $i<$anios; $i++) {
			echo "['".($i+1)."',".$Venta_robots_ensamblados[$i].",".$Venta_robots_fabricados[$i].",".$Venta_robots_otros[$i]." ]";
			if ($i<($anios-1)) {echo ",";}
		}
	?>
       ]);


	// Set chart options
	var options = {
		'title': 'Ventas de Robots',
        'hAxis': {'title': 'A\xf1o'},
        'isStacked' : true, 
		'width':540,
		'height':300
	};

	// Instantiate and draw our chart, passing in some options.
	var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
	chart.draw(data, options);
  }
  
  function drawGraf2() {
		
	// Create the data table.
	var data = new google.visualization.arrayToDataTable([
         ['A&ntilde;o', 'Costo de venta', 'Costo robots de otros proveedores', 'Costo de fabricacion', 'Costo regalias', 'Costo ensamblaje', 'Costo financiero de tenencia de piezas', 'Costo piezas de Beta', 'Margen (ganancia)'],
	<?php 
	
		for ($i=0; $i<$anios; $i++) {
			echo "['".($i+1)."',".$graf1['Costo_de_Venta'][$i].",".$graf1['Costo_Robots_Otros_Proveedores'][$i].",".$graf1['Costo_Fabricacion'][$i].",".$graf1['Costo_Regalias'][$i].",".$graf1['Costo_Ensamblaje'][$i].",".$graf1['Costo_Financiero_Tenencia_Piezas'][$i].",".$graf1['Costo_Piezas_Beta'][$i].", ".$graf1['Margen_de_Ganancia'][$i]." ]";
			if ($i<($anios-1)) {echo ",";}
		}
	?>
       ]);


	// Set chart options
	var options = {
		'title': 'Ventas de Robots',
        'hAxis': {'title': 'A\xf1o'},
        'isStacked' : true, 
		'width':540,
		'height':300
	};

	// Instantiate and draw our chart, passing in some options.
	var chart = new google.visualization.AreaChart(document.getElementById('graf_2'));
	chart.draw(data, options);
	
  }
  function drawGraf3() {
		
	// Create the data table.
	var data = new google.visualization.arrayToDataTable([
         ['A&ntilde;o', 'Ingresos', 'Egresos', 'Flujo de fondos'],
	<?php 
	
		for ($i=0; $i<$anios; $i++) {
			echo "['".($i+1)."',".$graf1['Ingresos_Totales'][$i].",".$graf1['Egresos_Totales'][$i].",".$graf1['Flujo_de_Fondos'][$i]." ]";
			if ($i<($anios-1)) {echo ",";}
		}
	?>
       ]);


	// Set chart options
	var options = {
		'title': 'Flujo de Fondos',
        'hAxis': {'title': 'A\xf1o'},
		'width':540,
		'height':300, 
		'seriesType': "area",
        'series': {2: {'type': "line"}}, 
	};

	// Instantiate and draw our chart, passing in some options.
	var chart = new google.visualization.ComboChart(document.getElementById('graf_3'));
	chart.draw(data, options);
	
  }

  function drawGraf4() {
		
	// Create the data table.
	var data = new google.visualization.arrayToDataTable([
		['Riesgo', '','Riesgos'],
	<?php 
        $riesgos_tit = array('Por cantidad minima', 'Por cantidad maxima', 'Por aporte inicial', 'Riesgo');	
		for ($i=0; $i<count($riesgos_tit); $i++) {
			echo "['".$riesgos_tit[$i]."',".$graf1['Serie_Invisible_Riesgos'][$i].",".$graf1['Riesgos'][$i]." ]";
			if ($i<(count($riesgos_tit)-1)) {echo ",";}
		}
	?>
       ]);


	// Set chart options
	var options = {
		'title': 'Riesgos',
		'width':540,
		'height':300, 
		'isStacked': true, 
		colors: ['#ffffff', '#ff0000']
		
	};

	// Instantiate and draw our chart, passing in some options.
	var chart = new google.visualization.ColumnChart(document.getElementById('graf_4'));
	chart.draw(data, options);
	
  }
  function drawGraf5() {
		
	// Create the data table.
	var data = new google.visualization.arrayToDataTable([
		['Resumen', ''],
	<?php 
        $resumen_tit = array('Valor Actual', 'Margen', 'Market Share', 'Seguridad');	
		for ($i=0; $i<count($resumen_tit); $i++) {
			echo "['".$resumen_tit[$i]."',".$graf1['Resumen'][$i]." ]";
			if ($i<(count($resumen_tit)-1)) {echo ",";}
		}
	?>
       ]);


	// Set chart options
	var options = {
		'title': 'Resultados',
		'width':540,
		'height':300, 
	};

	// Instantiate and draw our chart, passing in some options.
	var chart = new google.visualization.ColumnChart(document.getElementById('graf_5'));
	chart.draw(data, options);
	
  }
	function drawVisualization() {
		drawGraf1();
        drawGraf2();
		drawGraf3();
		drawGraf4();
		drawGraf5();
    }


google.setOnLoadCallback(drawVisualization);
</script>
</head>

<body>

<div id="container">
	<?php include($root."includes/us_header.php");?>
	<?php include($root."includes/us_menu.php");?>

        
        <div id="content">
        	<div id="wrap">
                <div class="titulos">
					<p>Bienvenido al Simulador</p>
                </div>
        		<div >
                <?php 
		$graf1 = SimuladorAlfayBeta($simulacion['modelos_ensamblar'], $simulacion['unidades_comprar'], $simulacion['duracion'], $simulacion['uni_entregar_beta'], $simulacion['precio_beta'], $simulacion['modelos_fabricar'], $simulacion['regalias_beta'], $simulacion['compartir_va'], $simulacion['compartir_kh'], $simulacion['exclusividad_compra'], $simulacion['exclusividad_venta'], $simulacion['adelanto_beta_alfa'], $simulacion['adelanto_alfa_beta']); 
?>
                
                
                </div>
				<div style="clear:both;"></div>
      		</div>      
        </div>
            
	<?php include($root."includes/us_footer.php");?>


</div>

</body>
</html>
