<?php 



function SimuladorAlfayBeta ($modelos_ensamblar, $unidades_comprar, $duracion, $uni_entregar_beta, $precio_beta, $modelos_fabricar, $regalias_beta, $compartir_va, $compartir_kh, $exclusividad_compra, $exclusividad_venta, $adelanto_beta_alfa, $adelanto_alfa_beta) {
/*
echo $modelos_ensamblar;
echo $unidades_comprar;
echo $duracion;
echo $uni_entregar_beta; echo $precio_beta; echo  $modelos_fabricar; echo  $regalias_beta; echo  $compartir_va; echo  $compartir_kh; echo  $exclusividad_compra; echo  $exclusividad_venta; echo  $adelanto_beta_alfa; echo  $adelanto_alfa_beta;*/
	$regalias_beta = $regalias_beta/100; //pasar de porcentajes a decimales


//Comentario: la función debería dar como output los arrays que van a los gráficos

global $anios;

global $current; 



//////////////////////////////////////////////////////////////////////////////////////////////

// -- Obtención de PARAMETROS de ALFA(segun escenario) ///////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////



	$parametros = get_single_value ('baseParametros', 'escenario', $current['escenario']);

	$parametros = mysql_fetch_array($parametros);



	$Precio_Venta = $parametros['Precio_Venta'];

	$Costo_Fabric = $parametros['Costo_Fabric'];

	$Costo_Ensam =  $parametros['Costo_Ensam'];

	$Costo_Compra_Ot_Prov =  $parametros['Costo_Compra_Ot_Prov'];

	$Costo_Venta_Equipo_Beta = $parametros['Costo_Venta_Equipo_Beta'];

	$Costo_Venta_Otros_Proveedores =  $parametros['Costo_Venta_Otros_Proveedores'];

	

	$Inversion_Fabricacion =  $parametros['Inversion_Fabricacion'];

	$Inversion_ConKnowHowBeta = $parametros['Inversion_ConKnowHowBeta'];

	

	$Variac_Mercado_para_Riesgo =  $parametros['Variac_Mercado_para_Riesgo'];

	$Riesgo_Pasarse_compromiso =  $parametros['Riesgo_Pasarse_compromiso'];



	$Total_Mercado = unserialize($parametros['Total_Mercado']);

	$Market_Share_Base = unserialize($parametros['Market_Share_Base']); //OK



	$Impacto_Calidad_Beta =  $parametros['Impacto_Calidad_Beta'];

	$Coefic_Impacto_Variedad =  $parametros['Coefic_Impacto_Variedad'];

	

	$A_Para_Cuadratica =  $parametros['A_Para_Cuadratica'];

	$B_Para_Cuadratica =  $parametros['B_Para_Cuadratica'];

	

	$Impacto_Penetracion_Beta_Base = unserialize($parametros['Impacto_Penetracion_Beta_Base']); //OK

	

	$Impacto_Tecnolog_Vision_en_Beta =  $parametros['Impacto_Tecnolog_Vision_en_Beta'];

	$Tasa_de_Descuento_Financiera = $parametros['Tasa_de_Descuento_Financiera'];

	

// NUEVOS parametros de ALFA!!!



/*	$Valor_Actual_contrato_MinMax = array(0.641406792, 460.0163837);

	$Margen_Medio_MinMax = array(0.071428571, 0.406731235);

	$Market_Share_Medio_MinMax = array(0.10505, 0.175);

	$Seguridad_Final_MinMax = array(0.187685216, 1);*/
	
	$Valor_Actual_contrato_MinMax = array(0, 206.14);
	$Margen_Medio_MinMax = array(0.071, 0.379);
	$Market_Share_Medio_MinMax = array(0.11, 0.175);
	$Seguridad_Final_MinMax = array(0.2, 1);



	

	



/////////////////////////////////////////////////////////////////////////////////////////////

// -- Obtención de PARAMETROS de BETA (segun escenario) /////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////

 

	$Market_Share_Base_BETA = array(0.01, 0.02, 0.03, 0.04, 0.05);

	$Aumento_MS_por_estar_con_Alfa = array(0, 0.05, 0.1, 0.15, 0.2);

	$MS_max_de_Alfa = array(0.1, 0.127525, 0.15505, 0.182575, 0.2101);

	$Impacto_MS_perdido_de_Alfa_para_Beta = array(0.33, 0.3725, 0.415, 0.4575, 0.5);

	$Impacto_Vision_Artificial_en_MS_Beta = array(0, 0.075, 0.15, 0.225, 0.3);



	$Modelos_a_Fabricar_Deseados_por_Beta = array(4, 4.5, 5, 5.5, 6);	

		

	$Inversion_por_Modelo_a_Fabricar = 30;

	$Inversion_por_Capacidad_Produccion = 5;

	

	$Precio_de_Venta_de_Beta_en_PaisAlfa = 120;

	$Costo_Fabricacion_y_Flete = 49;

	$Costo_Venta_Beta = 20;

	

	$Tasa_Descuento_Beta = 0.1;



	/*

	$Valor_Actual_contrato_Beta_MinMax = array(0, 200);
	$Margen_Medio_Beta_MinMax = array(0, 1);
	$Market_Share_Medio_Beta_MinMax = array(0, 0.1);
	$Seguridad_Final_Beta_MinMax = array(0.187685216, 1);
	*/
	

		$Valor_Actual_contrato_Beta_MinMax = array(-50.4, 268);
		$Margen_Medio_Beta_MinMax = array(0.29, 0.43);
		$Market_Share_Medio_Beta_MinMax = array(0.056, 0.0925);
		$Seguridad_Final_Beta_MinMax = array(0, 0.83);

	



 

////////////////////////////////////////////////////////////////////////////////////////////////

// Aca empiezan las cuentas del modelo /////////////////////////////////////////////////////////

// 1A) MODELO DE MERCADO ALFA //////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////



	if ($compartir_kh == 1) {

		$Posibilidad_Fabricacion = array(0,1,1,1,1);

	}else{

		$Posibilidad_Fabricacion = array(0,0,0,1,1);

	}

	$Modelos_Beta_Fabricados = array();

	$Modelos_Beta_Ensamblados = array();

	$Modelos_Beta_Totales = array();

	$Modelos_Otros = array();

	

	for ($i = 0; $i < $anios; $i++) {

		$Modelos_Beta_Fabricados[] = $Posibilidad_Fabricacion[$i]* $modelos_fabricar;

		$Modelos_Beta_Ensamblados[] = $modelos_ensamblar;

		$Modelos_Beta_Totales[] = max($Modelos_Beta_Ensamblados[$i], $Modelos_Beta_Fabricados[$i]);

		$Modelos_Otros[] = 10 - $Modelos_Beta_Totales[$i];

		//echo "Modelos_Beta_Fabricados: ".$Modelos_Beta_Fabricados[$i]."<br/>";

		//echo "Modelos_Beta_Ensamblados: ".$Modelos_Beta_Ensamblados[$i]."<br/>";

		//echo "Modelos_Beta_Totales: ".$Modelos_Beta_Totales[$i]."<br/>";

		//echo "Modelos otros: ".$Modelos_Otros[$i]."<br/>";

	}

	

	$PorcentajeRobotsBeta = array();

	$ImpactoCalidadBetaenMS = array();

	

	for ($i = 0; $i < $anios; $i++) {

		array_push($PorcentajeRobotsBeta, $Modelos_Beta_Totales[$i] * $A_Para_Cuadratica - pow($Modelos_Beta_Totales[$i],2) * $B_Para_Cuadratica);

		array_push($ImpactoCalidadBetaenMS, $PorcentajeRobotsBeta[$i] * $Impacto_Calidad_Beta); //OK

		//echo "PorcentajeRobotsBeta: ".$PorcentajeRobotsBeta[$i]."<br/>";

		//echo "ImpactoCalidadBetaenMS: ".$ImpactoCalidadBetaenMS[$i]."<br/>"; //OK!

	}

	

	$ImpactoCalidadBetaACUM = array();

	

	for ($i = 0; $i < $anios; $i++) {

		if ( $i == 0){

			array_push($ImpactoCalidadBetaACUM, 0); //OK

			// echo "ImpactoCalidadBetaACUM: ".$ImpactoCalidadBetaACUM[$i]."<br/>"; //OK!



		}else{

			array_push($ImpactoCalidadBetaACUM, $ImpactoCalidadBetaACUM[$i-1]+$ImpactoCalidadBetaenMS[$i-1]/4); //OK!

	//		echo "ImpactoCalidadBetaACUM: ".$ImpactoCalidadBetaACUM[$i]."<br/>"; //OK!

		}

	}

	

	$Impacto_Penetracion_Beta_Final = array();

	

	for ($i = 0; $i < $anios; $i++) {

		array_push($Impacto_Penetracion_Beta_Final, $Impacto_Penetracion_Beta_Base[$i]*(1+$Impacto_Tecnolog_Vision_en_Beta*$compartir_va )); //OK

		// echo "Impacto_Penetracion_Beta_Final: ".$Impacto_Penetracion_Beta_Final[$i]."<br/>";

	}

	

	$Impacto_Variedad_Ventas = array();

	

	if ($exclusividad_compra == 0){

		$Impacto_Variedad_Ventas = array(1, 1, 1, 1, 1);

	}else{

		for ($i = 0; $i < $anios; $i++) {

		

			array_push($Impacto_Variedad_Ventas, pow($PorcentajeRobotsBeta[$i], $Coefic_Impacto_Variedad));

			//echo "Impacto_Variedad_Ventas: ".$Impacto_Variedad_Ventas[$i]."<br/>";

		}

	}

		

	$Market_Share_Final_Alfa = array();

	$Demanda_Total_Robots_Alfa = array();

	

	for ($i = 0; $i < $anios; $i++) {

		array_push($Market_Share_Final_Alfa, ($Market_Share_Base[$i] + $ImpactoCalidadBetaACUM[$i] + $Impacto_Penetracion_Beta_Final[$i]) * $Impacto_Variedad_Ventas[$i]); //OK

		array_push($Demanda_Total_Robots_Alfa, $Total_Mercado[$i] * $Market_Share_Final_Alfa[$i]);

	//		echo "Market_Share_Final_Alfa: ".$Market_Share_Final_Alfa[$i]."<br/>"; //OK!

//		echo "Demanda_Total_Robots_Alfa: ".$Demanda_Total_Robots_Alfa[$i]."<br/>";

	}

	

/////////////////////////////////////////////////////////////////////////////////////////////

// 1B) MODELO DE MERCADO BETA ///////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////



$MS_Beta_vendidos_a_traves_de_ALFA = array();

$MS_Extra_por_Efecto_WOM_de_ventas_Alfa = array();

$MS_perdido_por_Alfa_en_manos_de_Beta = array();

$MS_ganado_por_Beta_a_Alfa = array();

$Impacto_Vision_Artificial_en_MS_BETA = array();



$Market_Share_Final_BETA = array();



for ($i = 0; $i < $anios; $i++) {



	array_push($MS_Beta_vendidos_a_traves_de_ALFA, $Market_Share_Final_Alfa[$i] * max($exclusividad_compra, $PorcentajeRobotsBeta[$i]));

	

	array_push($MS_Extra_por_Efecto_WOM_de_ventas_Alfa, $Aumento_MS_por_estar_con_Alfa[$i]*$MS_Beta_vendidos_a_traves_de_ALFA[$i]);

	

	array_push($MS_perdido_por_Alfa_en_manos_de_Beta, max($MS_max_de_Alfa[$i]- $Market_Share_Final_Alfa[$i], 0));

	

	array_push($MS_ganado_por_Beta_a_Alfa, $MS_perdido_por_Alfa_en_manos_de_Beta[$i] * $Impacto_MS_perdido_de_Alfa_para_Beta[$i]);

	

	array_push($Impacto_Vision_Artificial_en_MS_BETA, $Impacto_Vision_Artificial_en_MS_Beta[$i] * $compartir_va);

	

	array_push($Market_Share_Final_BETA, ($Market_Share_Base_BETA[$i] + $MS_Extra_por_Efecto_WOM_de_ventas_Alfa[$i] + $MS_ganado_por_Beta_a_Alfa[$i]) * (1+ $Impacto_Vision_Artificial_en_MS_BETA[$i]) );

}



	

	

	

	

	

	

	

	

	

	

	

	

	

	

	

	

	

	

	

	

	

	

	

	

 

////////////////////////////////////////////////////////////////////////////////////////////

// 2A) BALANCE FISICO ALFA /////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////



	$Cant_Robots_Deseados_de_Beta = array();

	$Robots_Fabricados_DESEADOS_Beta = array();

	$Robots_Ensamblados_DESEADOS_Beta = array();

	$Robots_Ensamblados_MAXIMO_Beta = array();

	$Compra_Minima_Piezas = array(); 

	

	for ($i = 0; $i < $anios; $i++) {

	

		array_push($Cant_Robots_Deseados_de_Beta, ($Demanda_Total_Robots_Alfa[$i] * $PorcentajeRobotsBeta[$i]));

		array_push($Robots_Fabricados_DESEADOS_Beta, ($Modelos_Beta_Fabricados[$i] * $A_Para_Cuadratica - pow($Modelos_Beta_Fabricados[$i],2) * $B_Para_Cuadratica) * $Demanda_Total_Robots_Alfa[$i]);

		array_push($Robots_Ensamblados_DESEADOS_Beta, (min($Cant_Robots_Deseados_de_Beta[$i] - $Robots_Fabricados_DESEADOS_Beta[$i], $uni_entregar_beta) + max(0, ($Cant_Robots_Deseados_de_Beta[$i] - $Robots_Fabricados_DESEADOS_Beta[$i] - $uni_entregar_beta) * $Riesgo_Pasarse_compromiso))); //OK!

		array_push($Robots_Ensamblados_MAXIMO_Beta, ($Modelos_Beta_Ensamblados[$i] * $A_Para_Cuadratica - pow($Modelos_Beta_Ensamblados[$i],2) * $B_Para_Cuadratica) * $Demanda_Total_Robots_Alfa[$i]);

	

//		echo "Cant_Robots_Deseados_de_Beta: ".$Cant_Robots_Deseados_de_Beta[$i]."<br/>"; 

//		echo "Robots_Fabricados_DESEADOS_Beta: ".$Robots_Fabricados_DESEADOS_Beta[$i]."<br/>";

//		echo "Robots_Ensamblados_DESEADOS_Beta: ".$Robots_Ensamblados_DESEADOS_Beta[$i]."<br/>"; //OK

//		echo "Robots_Ensamblados_MAXIMO_Beta: ".$Robots_Ensamblados_MAXIMO_Beta[$i]."<br/>";



		if ($i>= $duracion){

			array_push($Compra_Minima_Piezas,0); //OK!

//					echo "Compra_Minima_Piezas: ".$Compra_Minima_Piezas[$i]."<br/>"; //OK!

		}else{

			array_push($Compra_Minima_Piezas, $unidades_comprar); //OK!

//					echo "Compra_Minima_Piezas: ".$Compra_Minima_Piezas[$i]."<br/>"; //OK!

		}

	}

	 

	$Almacenados_a_ppios_anio = array();

	$Cant_Piezas_Compradas = array();

	$Cantidad_Robots_Ensamblados_FINAL = array();

	

	for ($i = 0; $i < $anios; $i++) {

	

		if ($i== 0){

			array_push($Almacenados_a_ppios_anio, 0);

			//echo "Almacenados_a_ppios_anio: ".$Almacenados_a_ppios_anio[$i]."<br/>";

			

		}else{

			array_push($Almacenados_a_ppios_anio, max(0,$Almacenados_a_ppios_anio[$i-1] + $Cant_Piezas_Compradas[$i-1] -$Cantidad_Robots_Ensamblados_FINAL[$i-1]  ));

			//echo "Almacenados_a_ppios_anio: ".$Almacenados_a_ppios_anio[$i]."<br/>";		

		}

	

	array_push($Cant_Piezas_Compradas, (min(max($Compra_Minima_Piezas[$i], $Robots_Ensamblados_DESEADOS_Beta[$i] - $Almacenados_a_ppios_anio[$i]), $uni_entregar_beta)+max(max($Compra_Minima_Piezas[$i], $Robots_Ensamblados_DESEADOS_Beta[$i]- $Almacenados_a_ppios_anio[$i])- $uni_entregar_beta,0)* $Riesgo_Pasarse_compromiso));

		//echo "Cant_Piezas_Compradas: ".$Cant_Piezas_Compradas[$i]."<br/>";		

	array_push($Cantidad_Robots_Ensamblados_FINAL, min($Robots_Ensamblados_MAXIMO_Beta[$i], $Almacenados_a_ppios_anio[$i]+ $Cant_Piezas_Compradas[$i]) );

		//echo "Cantidad_Robots_Ensamblados_FINAL: ".$Cantidad_Robots_Ensamblados_FINAL[$i]."<br/>";		

	}

	

	$Cantidad_Robots_Fabricados_FINAL = array();

	$Cantidad_Robots_Otros_FINAL = array();

	

	for ($i = 0; $i < $anios; $i++) {

	

		array_push($Cantidad_Robots_Fabricados_FINAL, ($Robots_Fabricados_DESEADOS_Beta[$i] - max($Cantidad_Robots_Ensamblados_FINAL[$i] - $Robots_Ensamblados_DESEADOS_Beta[$i], 0)));

	//	echo "Cantidad_Robots_Fabricados_FINAL: ".$Cantidad_Robots_Fabricados_FINAL[$i]."<br/>";		

		array_push($Cantidad_Robots_Otros_FINAL, ($Demanda_Total_Robots_Alfa[$i] - $Cantidad_Robots_Ensamblados_FINAL[$i] - $Cantidad_Robots_Fabricados_FINAL[$i]));

		//echo "Cantidad_Robots_Otros_FINAL: ".$Cantidad_Robots_Otros_FINAL[$i]."<br/>";		

//	$Cantidad_Robots_Otros_FINAL = array_push($Cantidad_Robots_Otros_FINAL, ($Demanda_Total_Robots_Alfa[$i] – ($Cantidad_Robots_Ensamblados_FINAL[$i] + $Cantidad_Robots_Fabricados_FINAL[$i])));

} 









////////////////////////////////////////////////////////////////////////////////////////////

// 2B) BALANCE FISICO BETA /////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////



$Demanda_BETA_Otros_Clientes = array();



for ($i = 0; $i < $anios; $i++) {

	array_push($Demanda_BETA_Otros_Clientes, $Market_Share_Final_BETA[$i]*$Total_Mercado[$i]);

}



$Modelos_Restantes_Beta = array();

$Unidades_Restantes_Beta = array();

$Capacidad_Fabricacion_en_PaisAlfa = array();

$Venta_a_Otros_Fabricado_en_PaisAlfa = array();

$Venta_a_Otros_Fabricado_en_PaisBeta = array();

$Venta_a_Otros_Total = array();



for ($i = 0; $i < $anios; $i++) {

	array_push($Modelos_Restantes_Beta, max($Modelos_a_Fabricar_Deseados_por_Beta[$i]- $modelos_ensamblar, 0));

	

	array_push($Unidades_Restantes_Beta, max($Demanda_BETA_Otros_Clientes[$i] - $uni_entregar_beta, 0));

	

	array_push($Capacidad_Fabricacion_en_PaisAlfa, $Unidades_Restantes_Beta[$i] + $uni_entregar_beta);

	

	//las ventas de piezas a alfa = $Cant_Piezas_Compradas;



	array_push($Venta_a_Otros_Fabricado_en_PaisAlfa, max(min($Demanda_BETA_Otros_Clientes[$i],$Capacidad_Fabricacion_en_PaisAlfa[$i] - $Cant_Piezas_Compradas[$i]), 0) );

	

	array_push($Venta_a_Otros_Fabricado_en_PaisBeta, ($Demanda_BETA_Otros_Clientes[$i] - $Venta_a_Otros_Fabricado_en_PaisAlfa[$i]) * $Riesgo_Pasarse_compromiso);

	

	// echo "$Venta_a_Otros_Fabricado_en_PaisAlfa: ".$Venta_a_Otros_Fabricado_en_PaisAlfa[$i]."<br/>";

	// echo "$Venta_a_Otros_Fabricado_en_PaisBeta: ".$Venta_a_Otros_Fabricado_en_PaisBeta[$i]."<br/>";

	

	array_push($Venta_a_Otros_Total, $Venta_a_Otros_Fabricado_en_PaisBeta[$i] + $Venta_a_Otros_Fabricado_en_PaisAlfa[$i]);

	

}



//print_r($Demanda_BETA_Otros_Clientes); //OK

//print_r($Capacidad_Fabricacion_en_PaisAlfa); //OK

//print_r($Cant_Piezas_Compradas); //OK

	

	

	

	

	

	

	

	

	

	

	

	

	

	

	

	

	

	

	

	











///////////////////////////////////////////////////////////////////////////////////////////

// 3A) BALANCE ECONOMICO ALFA /////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////////////



$Total_Ventas_de_Alfa = array();

$Total_Market_Share_Alfa = array();

$Ingresos_por_Ventas_MMUSD = array();

$Costo_Piezas_Beta = array();

$Costo_Financiero_Tenencia_Piezas = array();

$Costo_Ensamblaje = array();

$Costo_Regalias = array();

$Costo_Fabricacion = array();

$Costo_Robots_Otros_Proveedores = array();

$Costo_de_Venta = array();

$Margen_de_Ganancia = array();

$Margen_por_Unidad = array();



for ($i = 0; $i < $anios; $i++) {

	array_push($Total_Ventas_de_Alfa, $Cantidad_Robots_Otros_FINAL[$i] + $Cantidad_Robots_Fabricados_FINAL[$i] + $Cantidad_Robots_Ensamblados_FINAL[$i]);

	array_push($Total_Market_Share_Alfa, $Total_Ventas_de_Alfa[$i] / $Total_Mercado[$i] );

	array_push($Ingresos_por_Ventas_MMUSD, $Total_Ventas_de_Alfa[$i] * $Precio_Venta / 1000);

	array_push($Costo_Piezas_Beta, $Cant_Piezas_Compradas[$i] * $precio_beta / 1000);

	array_push($Costo_Financiero_Tenencia_Piezas, $Almacenados_a_ppios_anio[$i] * $precio_beta * $Tasa_de_Descuento_Financiera / 1000);

	array_push($Costo_Ensamblaje, ($Cantidad_Robots_Fabricados_FINAL[$i] + $Cantidad_Robots_Ensamblados_FINAL[$i]) * $Costo_Ensam / 1000);

	array_push($Costo_Regalias, $Precio_Venta * $regalias_beta * $Cantidad_Robots_Fabricados_FINAL[$i] / 1000);

	array_push($Costo_Fabricacion, $Cantidad_Robots_Fabricados_FINAL[$i] * $Costo_Fabric / 1000);

	array_push($Costo_Robots_Otros_Proveedores, $Cantidad_Robots_Otros_FINAL[$i] * $Costo_Compra_Ot_Prov / 1000);

	array_push($Costo_de_Venta, ( ( $Cantidad_Robots_Fabricados_FINAL[$i] + $Cantidad_Robots_Ensamblados_FINAL[$i] ) * $Costo_Venta_Equipo_Beta + $Cantidad_Robots_Otros_FINAL[$i] * $Costo_Venta_Otros_Proveedores ) / 1000);

	array_push($Margen_de_Ganancia, 

			   ($Ingresos_por_Ventas_MMUSD[$i] - $Costo_Piezas_Beta[$i] - $Costo_Financiero_Tenencia_Piezas[$i] - $Costo_Ensamblaje[$i] - $Costo_Regalias[$i]- $Costo_Fabricacion[$i] - $Costo_Robots_Otros_Proveedores[$i] - $Costo_de_Venta[$i])

	); //OK!

//	echo "Margen_de_Ganancia: ".$Margen_de_Ganancia[$i]."<br/>"; //OK!



	array_push($Margen_por_Unidad, $Margen_de_Ganancia[$i] * 1000 / $Total_Ventas_de_Alfa[$i]);

}



$Venta_robots_otros = $Cantidad_Robots_Otros_FINAL;

$Venta_robots_fabricados = $Cantidad_Robots_Fabricados_FINAL;

$Venta_robots_ensamblados = $Cantidad_Robots_Ensamblados_FINAL;









////////////////////////////////////////////////////////////////////////////////////////////

// 3B) BALANCE ECONOMICO BETA //////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////



$Costo_de_Fabricacion_y_Flete_piezas_a_Alfa = array();

$Margen_Venta_Piezas_a_Alfa = array();



for ($i = 0; $i < $anios; $i++) {

	//unidades vendidas a Alfa = $Cant_Piezas_Compradas

	

	array_push($Costo_de_Fabricacion_y_Flete_piezas_a_Alfa, $Cant_Piezas_Compradas[$i] * $Costo_Fabricacion_y_Flete / 1000);

	

	// ingresos por venta = $Costo_Piezas_Beta	

	array_push($Margen_Venta_Piezas_a_Alfa, $Costo_Piezas_Beta[$i] - $Costo_de_Fabricacion_y_Flete_piezas_a_Alfa[$i]);

	

	// ingresos por Regalias = $Costo_Regalias

}



$Ingresos_por_Venta_Otros = array();



$Costos_Fabricacion_para_Otros = array();

$Costos_Ensamblaje_para_Otros = array();

$Costos_de_Venta_Otros = array();



$Margen_Ventas_Otros = array();



for ($i = 0; $i < $anios; $i++) {

	array_push($Ingresos_por_Venta_Otros, $Venta_a_Otros_Total[$i] * $Precio_de_Venta_de_Beta_en_PaisAlfa /1000);

	

	array_push($Costos_Fabricacion_para_Otros, $Costo_Fabricacion_y_Flete*$Venta_a_Otros_Total[$i]/1000);

	array_push($Costos_Ensamblaje_para_Otros, $Costo_Ensam*$Venta_a_Otros_Total[$i]/1000);

	array_push($Costos_de_Venta_Otros, $Costo_Venta_Beta*$Venta_a_Otros_Total[$i]/1000);

	

	array_push($Margen_Ventas_Otros, $Ingresos_por_Venta_Otros[$i] - $Costos_Fabricacion_para_Otros[$i] - $Costos_Ensamblaje_para_Otros[$i] - $Costos_de_Venta_Otros[$i]);

}	

	

	







	

	

	

	

	

	

	

	

	

	

	

	

	

	

	

	

	









////////////////////////////////////////////////////////////////////////////////////////////

// 4A) FLUJO DE FONDOS ALFA ////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////



$Aportes_Netos_de_Beta_a_Alfa = array($adelanto_beta_alfa - $adelanto_alfa_beta, 0, 0, 0, 0); //OK

//print_r($Aportes_Netos_de_Beta_a_Alfa); //OK!



if ($compartir_kh == 1) {

		$Inversion_Fabricacion_en_Tiempo = array(- $Inversion_ConKnowHowBeta,0,0,0,0);//OK!

//					print_r($Inversion_Fabricacion_en_Tiempo); //OK!

	}else{

		$Inversion_Fabricacion_en_Tiempo = array((-$Inversion_Fabricacion / 3),(- $Inversion_Fabricacion / 3),(-$Inversion_Fabricacion / 3),0,0);//OK!

//					print_r($Inversion_Fabricacion_en_Tiempo);

	}

$Valor_Contrato = array();

$Total_Ingresos = array();

$Total_Egresos = array();

$Descuento_en_Tiempo = array();

$Valor_Contrato_Descontado = array();

for ($i = 0; $i < $anios; $i++) {

array_push($Valor_Contrato, $Margen_de_Ganancia[$i] + $Aportes_Netos_de_Beta_a_Alfa[$i] + $Inversion_Fabricacion_en_Tiempo[$i]); //OK!

//					echo "Valor contrato: ".$Valor_Contrato[$i]."<br/>"; //OK!



array_push($Total_Ingresos, max($Aportes_Netos_de_Beta_a_Alfa[$i], 0) + $Margen_de_Ganancia[$i] );

array_push($Total_Egresos, $Inversion_Fabricacion_en_Tiempo[$i] - max(-$Aportes_Netos_de_Beta_a_Alfa[$i], 0));



array_push($Descuento_en_Tiempo, pow((1+$Tasa_de_Descuento_Financiera), 1+$i));



array_push($Valor_Contrato_Descontado, $Valor_Contrato[$i] / $Descuento_en_Tiempo[$i]);

}







//////////////////////////////////////////////////////////////////////////////////////////

// 4B) FLUJO DE FONDOS BETA //////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////



$Inversion_Inicial_por_modelos = array($modelos_ensamblar * $Inversion_por_Modelo_a_Fabricar, 0, 0, 0, 0);

$Inversion_Inicial_por_cant_Unidades = array($uni_entregar_beta * $Inversion_por_Capacidad_Produccion / 1000, 0, 0, 0, 0);



$Inversion_Extra_por_modelos = array();

$Inversion_Extra_por_cant_Unidades = array();



$Total_Inversiones_Beta = array();



for ($i = 0; $i < $anios; $i++) {

		if ($i== 0){

			array_push($Inversion_Extra_por_modelos, 0);

			array_push($Inversion_Extra_por_cant_Unidades, 0);

			

		}else{

			array_push($Inversion_Extra_por_modelos, ($Modelos_Restantes_Beta[$i] - $Modelos_Restantes_Beta[$i -1]) * $Inversion_por_Modelo_a_Fabricar);

			array_push($Inversion_Extra_por_cant_Unidades, ($Unidades_Restantes_Beta[$i] - $Unidades_Restantes_Beta[$i -1]) * $Inversion_por_Capacidad_Produccion / 1000);

		}	

	array_push($Total_Inversiones_Beta, $Inversion_Inicial_por_modelos[$i] + $Inversion_Inicial_por_cant_Unidades[$i] + $Inversion_Extra_por_modelos[$i] + $Inversion_Extra_por_cant_Unidades[$i]);

}



$Total_Ingresos_Netos_Beta = array();

$Total_Inversiones_Incluyendo_Aportes = array();

$Valor_Contrato_Beta = array();



$Descuento_en_Tiempo_Beta = array();

$Valor_Contrato_Descontado_Beta = array();



for ($i = 0; $i < $anios; $i++) {



	array_push($Total_Ingresos_Netos_Beta, $Margen_Ventas_Otros[$i] + $Margen_Venta_Piezas_a_Alfa[$i] + $Costo_Regalias[$i] + max(-$Aportes_Netos_de_Beta_a_Alfa[$i], 0) );



	array_push($Total_Inversiones_Incluyendo_Aportes, - $Total_Inversiones_Beta[$i] - max($Aportes_Netos_de_Beta_a_Alfa[$i], 0) ); 



	array_push($Valor_Contrato_Beta, $Total_Ingresos_Netos_Beta[$i] + $Total_Inversiones_Incluyendo_Aportes[$i]);



	array_push($Descuento_en_Tiempo_Beta, pow((1+$Tasa_Descuento_Beta), 1+$i));



	array_push($Valor_Contrato_Descontado_Beta, $Valor_Contrato_Beta[$i] / $Descuento_en_Tiempo_Beta[$i]);

}

//print_r($Valor_Contrato_Beta);

//print_r($Valor_Contrato_Descontado_Beta);





















































/////////////////////////////////////////////////////////////////////////////////////////////

// 5A) RIESGOS ALFA /////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////



//Riesgo por compra Minima



$Riesgo_por_Cant_Minima =  array();

for ($i = 0; $i < $anios; $i++) {

	if($Robots_Ensamblados_DESEADOS_Beta[$i] == 0) {

		array_push($Riesgo_por_Cant_Minima,0);

	}else{

		array_push($Riesgo_por_Cant_Minima, 1/(1+EXP(($Robots_Ensamblados_DESEADOS_Beta[$i]-$Compra_Minima_Piezas[$i])*1.68695782277808/($Robots_Ensamblados_DESEADOS_Beta[$i]*$Variac_Mercado_para_Riesgo))));

	}

}

$Ponderador_riesgo_Cant_Minima = $precio_beta * $Tasa_de_Descuento_Financiera; //OK!

// echo "ponderador r cant minima".$Ponderador_riesgo_Cant_Minima ; //OK!

//echo "ARRAY SUM: ".array_sum($Riesgo_por_Cant_Minima); //OK!

$Riesgo_por_cant_Minima_FINAL = array_sum($Riesgo_por_Cant_Minima) * $Ponderador_riesgo_Cant_Minima; //OK!

//echo "Riesgo_por_cant_Minima_FINAL: ".$Riesgo_por_cant_Minima_FINAL; //OK!





// Riesgo por Cantidad Maxima



$Deseo_de_Ensamblar_Maximo = array();

$Riesgo_por_Cant_Maxima = array();

	

for ($i = 0; $i < $anios; $i++) {

	array_push($Deseo_de_Ensamblar_Maximo, max($Cantidad_Robots_Ensamblados_FINAL[$i], $Demanda_Total_Robots_Alfa[$i] * (1- $Posibilidad_Fabricacion[$i])));

	

	if($Deseo_de_Ensamblar_Maximo[$i] == 0) {

		array_push($Riesgo_por_Cant_Maxima,0);

	}else{

		array_push($Riesgo_por_Cant_Maxima, 1-1/(1+EXP(($Deseo_de_Ensamblar_Maximo[$i]- $uni_entregar_beta)*1.68695782277808/($Deseo_de_Ensamblar_Maximo[$i]*$Variac_Mercado_para_Riesgo))));

	}	

}



$Ponderador_riesgo_Cant_Maxima = array();

$Riesgo_Total_por_Cant_Maxima = array();	

	

for ($i = 0; $i < $anios; $i++) {



array_push($Ponderador_riesgo_Cant_Maxima, ($exclusividad_compra) * (max(0, $Precio_Venta -($Costo_Compra_Ot_Prov +	$Costo_Venta_Otros_Proveedores)*$PorcentajeRobotsBeta[$i])/$Riesgo_Pasarse_compromiso) + MAX($Costo_Compra_Ot_Prov + $Costo_Venta_Otros_Proveedores -$Costo_Venta_Equipo_Beta - $precio_beta -$Costo_Ensam,0) ); //OK!

//echo $Costo_Compra_Ot_Prov."-";

//echo $Costo_Venta_Otros_Proveedores."-"; 

//echo $Costo_Venta_Equipo_Beta."-"; 

//echo $precio_beta."-";

//echo "Ponderador_riesgo_Cant_Maxima: ".$Ponderador_riesgo_Cant_Maxima[$i]; //OK!

array_push($Riesgo_Total_por_Cant_Maxima, $Riesgo_por_Cant_Maxima[$i]*$Ponderador_riesgo_Cant_Maxima[$i]); //OK!

//echo "Riesgo_Total_por_Cant_Maxima: ".$Riesgo_Total_por_Cant_Maxima[$i]; //OK!

}



$Riesgo_por_cant_Maxima_FINAL = array_sum($Riesgo_Total_por_Cant_Maxima); //OK!

//echo "Riesgo_por_cant_Maxima_FINAL: ".$Riesgo_por_cant_Maxima_FINAL;//OK!



// Riesgo por Aporte Inicial



$Total_Robots_del_Contrato = array_sum($Cantidad_Robots_Ensamblados_FINAL) + array_sum($Cantidad_Robots_Fabricados_FINAL);



if($Total_Robots_del_Contrato == 0) {

		$Riesgo_por_Aporte_Inicial = 0;

	}else{

		$Riesgo_por_Aporte_Inicial = ($adelanto_alfa_beta - $adelanto_beta_alfa)*1000/$Total_Robots_del_Contrato;

	}	

	

// Resumen Riesgos



$Ponderador_Final_Riesgos = max($Costo_Compra_Ot_Prov + $Costo_Venta_Otros_Proveedores - $Costo_Venta_Equipo_Beta - $Costo_Ensam - $precio_beta, 0.000001); //OK!

// echo "Ponderador_Final_Riesgos: ".$Ponderador_Final_Riesgos; //OK!



$Riesgo_por_cant_Minima_FINAL = $Riesgo_por_cant_Minima_FINAL / $Ponderador_Final_Riesgos /5;



$Riesgo_por_cant_Maxima_FINAL = $Riesgo_por_cant_Maxima_FINAL / $Ponderador_Final_Riesgos /5;



$Riesgo_por_Aporte_Inicial_FINAL = $Riesgo_por_Aporte_Inicial / $Ponderador_Final_Riesgos/5;



$Riesgo_TOTAL = $Riesgo_por_cant_Minima_FINAL + $Riesgo_por_cant_Maxima_FINAL + $Riesgo_por_Aporte_Inicial_FINAL;






$Riesgo_Output = array($Riesgo_por_cant_Minima_FINAL, $Riesgo_por_cant_Maxima_FINAL, abs($Riesgo_por_Aporte_Inicial_FINAL), $Riesgo_TOTAL, 0);
//print_r($Riesgo_Output);

$Riesgo_Output_InvisibleParche = array(0, $Riesgo_por_cant_Minima_FINAL, $Riesgo_por_cant_Minima_FINAL + $Riesgo_por_cant_Maxima_FINAL + max($Riesgo_por_Aporte_Inicial_FINAL, 0), 0, 0, 0);


/////////////////////////////////////////////////////////////////////////////////////////////

// 5B) RIESGOS BETA /////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////



// Riesgo de no cubrir la capacidad productiva:



$Demanda_Minima_Alfa_Para_Riesgo_Beta = array();

$Demanda_Minima_Otros_Para_Riesgo_Beta = array();

$Demanda_Minima_Total_Para_Riesgo_Beta = array();

$Demanda_Minima_Considerada_Para_Riesgo_Beta = array();



for ($i = 0; $i < $anios; $i++) {

	array_push($Demanda_Minima_Alfa_Para_Riesgo_Beta, (($Compra_Minima_Piezas[$i]-max($Compra_Minima_Piezas[$i], $Robots_Ensamblados_DESEADOS_Beta[$i])) * $Variac_Mercado_para_Riesgo)+ max($Compra_Minima_Piezas[$i], $Robots_Ensamblados_DESEADOS_Beta[$i]));

	

	array_push($Demanda_Minima_Otros_Para_Riesgo_Beta, $Demanda_BETA_Otros_Clientes[$i] * (1 - $Variac_Mercado_para_Riesgo) );



	array_push($Demanda_Minima_Total_Para_Riesgo_Beta, $Demanda_Minima_Alfa_Para_Riesgo_Beta[$i] + $Demanda_Minima_Otros_Para_Riesgo_Beta[$i]);

	

	array_push($Demanda_Minima_Considerada_Para_Riesgo_Beta, min($Demanda_Minima_Total_Para_Riesgo_Beta[$i], $Capacidad_Fabricacion_en_PaisAlfa[$i]));

}
//print_r($Capacidad_Fabricacion_en_PaisAlfa);
$Riesgo_No_Cubrir_Capacidad_Productiva = 1- (array_sum($Demanda_Minima_Considerada_Para_Riesgo_Beta)/array_sum($Capacidad_Fabricacion_en_PaisAlfa));




$Demanda_Maxima_Alfa_Para_Riesgo_Beta = array();
$Demanda_Maxima_Otros_Para_Riesgo_Beta = array();
$Demanda_Maxima_Total_Para_Riesgo_Beta = array();
$Demanda_Maxima_Considerada_Para_Riesgo_Beta = array();



for ($i = 0; $i < $anios; $i++) {

	array_push($Demanda_Maxima_Alfa_Para_Riesgo_Beta, ((max($Compra_Minima_Piezas[$i], $Robots_Ensamblados_DESEADOS_Beta[$i])-$Compra_Minima_Piezas[$i]) * $Variac_Mercado_para_Riesgo)+ max($Compra_Minima_Piezas[$i], $Robots_Ensamblados_DESEADOS_Beta[$i]));

	

	array_push($Demanda_Maxima_Otros_Para_Riesgo_Beta, $Venta_a_Otros_Total[$i] * (1 + $Variac_Mercado_para_Riesgo) );
	array_push($Demanda_Maxima_Total_Para_Riesgo_Beta, $Demanda_Maxima_Alfa_Para_Riesgo_Beta[$i] + $Demanda_Maxima_Otros_Para_Riesgo_Beta[$i]);
	array_push($Demanda_Maxima_Considerada_Para_Riesgo_Beta, max($Demanda_Maxima_Total_Para_Riesgo_Beta[$i], $Capacidad_Fabricacion_en_PaisAlfa[$i]));
}

$Riesgo_No_Satisfacer_Demanda = (1- (array_sum($Capacidad_Fabricacion_en_PaisAlfa)/array_sum($Demanda_Maxima_Considerada_Para_Riesgo_Beta)) )*$Riesgo_Pasarse_compromiso;

// RIESGO POR APORTE INICIAL





$Total_Robots_del_Contrato_Beta = array_sum($Cant_Piezas_Compradas) + array_sum($Cantidad_Robots_Fabricados_FINAL);



if($Total_Robots_del_Contrato_Beta == 0) {

		$Riesgo_por_Aporte_Inicial_Beta = 0;

	}else{

		$Riesgo_por_Aporte_Inicial_Beta = ($adelanto_beta_alfa - $adelanto_alfa_beta)*1000/ $Total_Robots_del_Contrato_Beta;

	}	



$Riesgo_Por_Aporte_Inicial_Beta_Ponderado = $Riesgo_por_Aporte_Inicial_Beta / ($precio_beta - $Costo_Fabricacion_y_Flete);



//FINAL Riesgos Beta




$Riesgo_TOTAL_Beta = $Riesgo_No_Cubrir_Capacidad_Productiva + $Riesgo_No_Satisfacer_Demanda + $Riesgo_Por_Aporte_Inicial_Beta_Ponderado;

$Riesgo_Output_Beta = array($Riesgo_No_Cubrir_Capacidad_Productiva, $Riesgo_No_Satisfacer_Demanda, abs($Riesgo_Por_Aporte_Inicial_Beta_Ponderado), $Riesgo_TOTAL_Beta,
0);

$Riesgo_Output_InvisibleParche_Beta = array(0, $Riesgo_No_Cubrir_Capacidad_Productiva, $Riesgo_No_Cubrir_Capacidad_Productiva + $Riesgo_No_Satisfacer_Demanda
+ max($Riesgo_Por_Aporte_Inicial_Beta_Ponderado, 0), 0, 0, 0);

///////////////////////////////////////////////////////////////////////////////////////////

// 6A) INDICADORES RESUMEN ALFA /////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////



//print_r($Valor_Contrato_Descontado);

$Valor_Actual_Contrato = array_sum($Valor_Contrato_Descontado); //OK!



$Margen_Medio = array_sum($Margen_de_Ganancia)*1000/ (array_sum($Total_Ventas_de_Alfa) * $Precio_Venta);



$Market_Share_Medio = array_sum($Total_Market_Share_Alfa) / 5;



$Seguridad_Final_Media = 1-$Riesgo_TOTAL;



$Valor_Actual_normalizado = min(max(($Valor_Actual_Contrato - $Valor_Actual_contrato_MinMax[0])/($Valor_Actual_contrato_MinMax[1]-$Valor_Actual_contrato_MinMax[0]),0),1);



//echo "Contrato: ".$Valor_Actual_contrato."<br/>"; OK!

//echo "minmax1: ".$Valor_Actual_contrato_MinMax[0]."<br/>";

//echo "minmax2: ".$Valor_Actual_contrato_MinMax[1]."<br/>";



$Margen_Medio_normalizado = min(max(($Margen_Medio-$Margen_Medio_MinMax[0])/($Margen_Medio_MinMax[1]-$Margen_Medio_MinMax[0]),0),1);



$Market_Share_normalizado = min(max(($Market_Share_Medio - $Market_Share_Medio_MinMax[0])/($Market_Share_Medio_MinMax[1]-$Market_Share_Medio_MinMax[0]),0),1);



$Seguridad_Final_normalizada = min(max(($Seguridad_Final_Media - $Seguridad_Final_MinMax[0])/($Seguridad_Final_MinMax[1]-$Seguridad_Final_MinMax[0]),0),1);



//echo "Seguridad_Final_Media: ".$Seguridad_Final_Media;



$Outputs_Resumen = array($Valor_Actual_normalizado, $Margen_Medio_normalizado, $Market_Share_normalizado, $Seguridad_Final_normalizada, 0);







/////////////////////////////////////////////////////////////////////////////////////////

// 6B) INDICADORES RESUMEN BETA /////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////



$Valor_Actual_contrato_Beta = array_sum($Valor_Contrato_Descontado_Beta);



//print_r($Total_Ingresos_Netos_Beta);

//print_r($Costo_Piezas_Beta);

//print_r($Ingresos_por_Venta_Otros);

//print_r($Costo_Regalias);



$Margen_Medio_Beta = array_sum($Total_Ingresos_Netos_Beta)/(array_sum($Costo_Piezas_Beta) + array_sum($Ingresos_por_Venta_Otros) + array_sum($Costo_Regalias));



//echo "---- $Margen_Medio_Beta".$Margen_Medio_Beta;



$Market_Share_Medio_Beta = array_sum($Venta_a_Otros_Total) / array_sum($Total_Mercado);

	

$Seguridad_Final_Media_Beta = 1-$Riesgo_TOTAL_Beta;



//echo "Valor_Actual_contrato_Beta".$Valor_Actual_contrato_Beta;

//echo "BetaMinMax".$Valor_Actual_contrato_Beta_MinMax[0];

//echo "betaminmax2".$Valor_Actual_contrato_Beta_MinMax[1];



$Valor_Actual_Beta_normalizado = min(max(($Valor_Actual_contrato_Beta - $$Valor_Actual_contrato_Beta_MinMax[0])/($Valor_Actual_contrato_Beta_MinMax[1]-$Valor_Actual_contrato_Beta_MinMax[0]),0),1);



$Margen_Medio_Beta_normalizado = min(max(($Margen_Medio_Beta - $Margen_Medio_Beta_MinMax[0])/($Margen_Medio_Beta_MinMax[1] - $Margen_Medio_Beta_MinMax[0]),0),1);



//echo "---$Margen_Medio_Beta_normalizado".$Margen_Medio_Beta_normalizado;



$Market_Share_Beta_normalizado = min(max(($Market_Share_Medio_Beta - $Market_Share_Medio_Beta_MinMax[0])/($Market_Share_Medio_Beta_MinMax[1]-$Market_Share_Medio_Beta_MinMax[0]),0),1);



$Seguridad_Final_Beta_normalizada = min(max(($Seguridad_Final_Media_Beta - $Seguridad_Final_Beta_MinMax[0])/($Seguridad_Final_Beta_MinMax[1]-$Seguridad_Final_Beta_MinMax[0]),0),1);



$Outputs_Resumen_Beta = array($Valor_Actual_Beta_normalizado, $Margen_Medio_Beta_normalizado, $Market_Share_Beta_normalizado, $Seguridad_Final_Beta_normalizada, 0);

















































/////////////////////////////////////////////////////////////////////////////////////////////

// 7) OUTPUTS ///////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////



//echo "hola " .$Cantidad_Robots_Otros_FINAL[0];

//echo "hola " .$Cantidad_Robots_Fabricados_FINAL[1];

//echo "hola " .$Cantidad_Robots_Ensamblados_FINAL[2];

//echo $output_alfa['Venta_robots_ensamblados'][2];



$output_alfa_y_beta = array (

						

						/////////////////////////////////

						///////ALFA//////////////////////

						/////////////////////////////////

						

						'Venta_robots_ensamblados' => $Cantidad_Robots_Ensamblados_FINAL,

						'Venta_robots_fabricados'=>$Cantidad_Robots_Fabricados_FINAL,

						'Venta_robots_otros' => $Cantidad_Robots_Otros_FINAL,

						

						'Costo_Piezas_Beta' => $Costo_Piezas_Beta,

						'Costo_Financiero_Tenencia_Piezas' => $Costo_Financiero_Tenencia_Piezas,

						'Costo_Ensamblaje' => $Costo_Ensamblaje,

						'Costo_Regalias' => $Costo_Regalias,

						'Costo_Fabricacion' => $Costo_Fabricacion,

						'Costo_Robots_Otros_Proveedores' => $Costo_Robots_Otros_Proveedores,

						'Costo_de_Venta' => $Costo_de_Venta,

						'Margen_de_Ganancia' => $Margen_de_Ganancia,



						'Ingresos_Netos' => $Total_Ingresos,

						'Inversiones_Totales' => $Total_Egresos,

						'Flujo_de_Fondos' => $Valor_Contrato,

						

						'Riesgos' => $Riesgo_Output,

						'Serie_Invisible_Riesgos' => $Riesgo_Output_InvisibleParche,

						

						'Resumen' => $Outputs_Resumen,

						

						/////////////////////////////////

						///////BETA//////////////////////

						/////////////////////////////////

						

						'Venta_Piezas_a_Alfa' => $Cant_Piezas_Compradas,

						'Venta_Robots_a_Otros' => $Venta_a_Otros_Total, 

						'Robots_Fabricados_por_Alfa_(regalias)' => $Cantidad_Robots_Fabricados_FINAL,

						

						'Costos_Fabricacion_para_Otros' => $Costos_Fabricacion_para_Otros,

						'Costos_Ensamblaje_para_Otros' => $Costos_Ensamblaje_para_Otros,

						'Costos_Venta_a_Otros' => $Costos_de_Venta_Otros,

						'Costos_Fabricacion_para_Alfa' => $Costo_de_Fabricacion_y_Flete_piezas_a_Alfa,

						'Margen_Ventas_Otros' => $Margen_Ventas_Otros,

						'Margen_Venta_Piezas_a_Alfa' => $Margen_Venta_Piezas_a_Alfa	,

						'Ingresos_por_Regalias' => $Costo_Regalias,

						

						'Ingresos_Netos_Beta' => $Total_Ingresos_Netos_Beta,

						'Inversiones_Totales_Beta' => $Total_Inversiones_Incluyendo_Aportes,

						'Flujo_de_Fondos_Beta' => $Valor_Contrato_Beta,

						

						'Riesgos_Beta' => $Riesgo_Output_Beta,

						'Serie_Invisible_Riesgos_Beta' => $Riesgo_Output_InvisibleParche_Beta,

						

						'Resumen_Beta' => $Outputs_Resumen_Beta

						

						);

						

					//Versión final al 1-may-2012

					

return $output_alfa_y_beta;

}