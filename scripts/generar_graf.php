<script type="text/javascript">
  // Load the Visualization API and the piechart package.
  google.load('visualization', '1.0', {'packages':['corechart']});

  // Set a callback to run when the Google Visualization API is loaded.
 // google.setOnLoadCallback(drawChart);

  // Callback that creates and populates a data table,
  // instantiates the pie chart, passes in the data and
  // draws it.
  	<?php 
	
		$simulacion = get_single_value ('dataNegociacion2', 'id', $id);
		$simulacion = mysql_fetch_array($simulacion);
		$graf1 = SimuladorAlfayBeta ($simulacion['modelos_ensamblar'], $simulacion['unidades_comprar'], $simulacion['duracion'], $simulacion['uni_entregar_beta'], $simulacion['precio_beta'], $simulacion['modelos_fabricar'], $simulacion['regalias_beta'], $simulacion['compartir_va'], $simulacion['compartir_kh'], $simulacion['exclusividad_compra'], $simulacion['exclusividad_venta'], $simulacion['adelanto_beta_alfa'], $simulacion['adelanto_alfa_beta']); 
		$Venta_robots_ensamblados = $graf1['Venta_robots_ensamblados'];
		$Venta_robots_fabricados =  $graf1['Venta_robots_fabricados'];
		$Venta_robots_otros =  $graf1['Venta_robots_otros'];
	?>

<?php if ($empresa=='alfa') {?>
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
        'hAxis': {'title': 'A\xf1o'},
        'isStacked' : true, 
		'width':720,
		'height':400, 
		'chartArea': 600,
	};

	// Instantiate and draw our chart, passing in some options.
	var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
	chart.draw(data, options);
  }
  
  function drawGraf2() {
		
	// Create the data table.
	var data = new google.visualization.arrayToDataTable([
         ['A&ntilde;o', 'Venta (Costo)', 'Robots de otros proveedores (Costo)', 'Fabricacion (Costo)', 'Regalias (Costo)', 'Ensamblaje (Costo)', 'Tenencia de piezas (Costo)', 'Piezas de Beta (Costo)', 'Margen (ganancia)'],
	<?php 
	
		for ($i=0; $i<$anios; $i++) {
			echo "['".($i+1)."',".$graf1['Costo_de_Venta'][$i].",".$graf1['Costo_Robots_Otros_Proveedores'][$i].",".$graf1['Costo_Fabricacion'][$i].",".$graf1['Costo_Regalias'][$i].",".$graf1['Costo_Ensamblaje'][$i].",".$graf1['Costo_Financiero_Tenencia_Piezas'][$i].",".$graf1['Costo_Piezas_Beta'][$i].", ".$graf1['Margen_de_Ganancia'][$i]." ]";
			if ($i<($anios-1)) {echo ",";}
		}
	?>
       ]);


	// Set chart options
	var options = {
		'legend':{'position': 'right'},
        'hAxis': {'title': 'A\xf1o'},
        'isStacked' : true, 
		'width':720,
		'height':300, 
		'chartArea':{width: 300}
	};

	// Instantiate and draw our chart, passing in some options.
	var chart = new google.visualization.AreaChart(document.getElementById('graf_2'));
	chart.draw(data, options);
	
  }
  function drawGraf3() {
		
	// Create the data table.
	var data = new google.visualization.arrayToDataTable([
         ['A&ntilde;o', 'Ingresos Netos', 'Inversiones', 'Flujo de fondos'],
	<?php 
	
		for ($i=0; $i<$anios; $i++) {
			echo "['".($i+1)."',".$graf1['Ingresos_Netos'][$i].",".$graf1['Inversiones_Totales'][$i].",".$graf1['Flujo_de_Fondos'][$i]." ]";
			if ($i<($anios-1)) {echo ",";}
		}
	?>
       ]);


	// Set chart options
	var options = {
        'hAxis': {'title': 'A\xf1o'},
		'width':720,
		'height':400, 
		'chartArea': 600,
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
        $riesgos_tit = array('Por cant. minima', 'Por cant. maxima', 'Por aporte inicial', 'Riesgo');	
		for ($i=0; $i<count($riesgos_tit); $i++) {
			echo "['".$riesgos_tit[$i]."',".$graf1['Serie_Invisible_Riesgos'][$i].",".$graf1['Riesgos'][$i]." ]";
			if ($i<(count($riesgos_tit)-1)) {echo ",";}
		}
	?>
       ]);


	// Set chart options
	var options = {
        'vAxis': {format:'#%'},
		'legend': {position: 'none'},
		'width':720,
		'height':400, 
		'chartArea': 600,
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
        'vAxis': {format:'#%'},
		'width':720,
		'height':400, 
		'chartArea': 600,
		'legend': {position: 'none'}
	};

	// Instantiate and draw our chart, passing in some options.
	var chart = new google.visualization.ColumnChart(document.getElementById('graf_5'));
	chart.draw(data, options);
	
  }
  
  
 <?php } elseif ($empresa=='beta') {?>
  
//BETA/////////////////////////
  function drawGraf6() {
		
	// Create the data table.
	var data = new google.visualization.arrayToDataTable([
         ['A&ntilde;o', 'Venta de piezas a Alfa', 'Venta Robots a Otros', 'Robots fabricados por Alfa (regalias)'],
	<?php 
	
		for ($i=0; $i<$anios; $i++) {
			echo "['".($i+1)."',".$graf1['Venta_Piezas_a_Alfa'][$i].",".$graf1['Venta_Robots_a_Otros'][$i].",".$graf1['Robots_Fabricados_por_Alfa_(regalias)'][$i]." ]";
			if ($i<($anios-1)) {echo ",";}
		}
	?>
       ]);


	// Set chart options
	var options = {
        'hAxis': {'title': 'A\xf1o'},
        'isStacked' : true, 
		'width':720,
		'height':400, 
		'chartArea': 600,
	};

	// Instantiate and draw our chart, passing in some options.
	var chart = new google.visualization.AreaChart(document.getElementById('graf_6'));
	chart.draw(data, options);
  }

    function drawGraf7() {
		
	// Create the data table.
	var data = new google.visualization.arrayToDataTable([
         ['A&ntilde;o', 'Costo Fabricacion para Otros', 'Costo Ensamblaje para Otros', 'Costo Venta a Otros', 'Costo Fabricacion para Alfa', 'Ventas Otros (Margen)', 'Margen Venta Piezas a Alfa', 'Ingreso Regalias'],
		 
		
	<?php 
	
		for ($i=0; $i<$anios; $i++) {
			echo "['".($i+1)."',".$graf1['Costos_Fabricacion_para_Otros'][$i].",".$graf1['Costos_Ensamblaje_para_Otros'][$i].",".$graf1['Costos_Venta_a_Otros'][$i].",".$graf1['Costos_Fabricacion_para_Alfa'][$i].",".$graf1['Margen_Ventas_Otros'][$i].",".$graf1['Margen_Venta_Piezas_a_Alfa'][$i].",".$graf1['Ingresos_por_Regalias'][$i]." ]";
			if ($i<($anios-1)) {echo ",";}
		}
	?>
       ]);


	// Set chart options
	var options = {
        'hAxis': {'title': 'A\xf1o'},
        'isStacked' : true, 
		'width':720,
		'height':300, 
		'chartArea':{width: 300}
	};

	// Instantiate and draw our chart, passing in some options.
	var chart = new google.visualization.AreaChart(document.getElementById('graf_7'));
	chart.draw(data, options);
	
  }
  function drawGraf8() {
		
	// Create the data table.
	var data = new google.visualization.arrayToDataTable([
         ['A&ntilde;o', 'Ingresos Netos', 'Inversiones', 'Flujo de fondos'],
	<?php 
	
		for ($i=0; $i<$anios; $i++) {
			echo "['".($i+1)."',".$graf1['Ingresos_Netos_Beta'][$i].",".$graf1['Inversiones_Totales_Beta'][$i].",".$graf1['Flujo_de_Fondos_Beta'][$i]." ]";
			if ($i<($anios-1)) {echo ",";}
		}
	?>
       ]);


	// Set chart options
	var options = {
        'hAxis': {'title': 'A\xf1o'},
		'width':720,
		'height':400, 
		'chartArea': 600,
		'seriesType': "area",
        'series': {2: {'type': "line"}}, 
	};

	// Instantiate and draw our chart, passing in some options.
	var chart = new google.visualization.ComboChart(document.getElementById('graf_8'));
	chart.draw(data, options);
	
  }
  
    function drawGraf9() {
		
	// Create the data table.
	var data = new google.visualization.arrayToDataTable([
		['Riesgo', '','Riesgos'],
	<?php 
        $riesgos_tit = array('Por cant. minima', 'Por cant. maxima', 'Por aporte inicial', 'Riesgo');	
		for ($i=0; $i<count($riesgos_tit); $i++) {
			echo "['".$riesgos_tit[$i]."',".$graf1['Serie_Invisible_Riesgos_Beta'][$i].",".$graf1['Riesgos_Beta'][$i]." ]";
			if ($i<(count($riesgos_tit)-1)) {echo ",";}
		}
	?>
       ]);


	// Set chart options
	var options = {
        'vAxis': {format:'#%'},
		'legend': {position: 'none'},
		'width':720,
		'height':400, 
		'chartArea': 600,
		'isStacked': true, 
		colors: ['#ffffff', '#ff0000']
		
	};

	// Instantiate and draw our chart, passing in some options.
	var chart = new google.visualization.ColumnChart(document.getElementById('graf_9'));
	chart.draw(data, options);
	
  }

  
  
  function drawGraf10() {
		
	// Create the data table.
	var data = new google.visualization.arrayToDataTable([
		['Resumen', ''],
	<?php 
        $resumen_tit = array('Valor Actual', 'Margen', 'Market Share', 'Seguridad');	
		for ($i=0; $i<count($resumen_tit); $i++) {
			echo "['".$resumen_tit[$i]."',".$graf1['Resumen_Beta'][$i]." ]";
			if ($i<(count($resumen_tit)-1)) {echo ",";}
		}
	?>
       ]);


	// Set chart options
	var options = {
        'vAxis': {format:'#%'},
		'width':720,
		'height':400, 
		'chartArea': 600,
		'legend': {position: 'none'}
	};

	// Instantiate and draw our chart, passing in some options.
	var chart = new google.visualization.ColumnChart(document.getElementById('graf_10'));
	chart.draw(data, options);
	
  }
<?php }?>  
	function drawVisualization() {
<?php if ($empresa=="alfa"){?>
		drawGraf1();
        drawGraf2();
		drawGraf3();
		drawGraf4();
		drawGraf5();
<?php } elseif ($empresa=="beta"){?>		
		drawGraf6();
		drawGraf7();		
		drawGraf8();		
		drawGraf9();		
		drawGraf10();		
<?php }?>		
    }


google.setOnLoadCallback(drawVisualization);
</script>