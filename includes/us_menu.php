<?php
$selT="class='selected'";
//SUB-MENUES INFO
$info="";
$info .= "<li><a href='informacion.php?seccion=miempresa' ";
if ($sel2=="miempresa") {$info .= $selT;};
$info .=">Sobre ".ucfirst(otra_emp($_SESSION['empresa']))." Inc.</a></li>\n";
$info .= "<li><a href='informacion.php?seccion=mercado' ";
if ($sel2=="mercado") {$info .= $selT;};
$info .=">El Mercado de la Rob&oacute;tica</a></li>\n";
$info .= "<li><a href='informacion.php?seccion=otraempresa' ";
if ($sel2=="otraempresa") {$info .= $selT;};
$info .=">".ucfirst($_SESSION['empresa'])." Inc.</a></li>\n";
$info .= "<li><a href='informacion.php?seccion=robots' ";
if ($sel2=="robots") {$info .= $selT;};
$info .=">Los Robots</a></li>\n";
$info .= "<li><a href='informacion.php?seccion=riesgos' ";
if ($sel2=="riesgos") {$info .= $selT;};
$info .=">Los Riesgos</a></li>\n";
$info .= "<li><a href='informacion.php?seccion=negociacion' ";
if ($sel2=="negociacion") {$info .= $selT;};
$info .=">La Negociaci&oacute;n</a></li>\n";

//SUB-MENUES PN
$pn="";
$pn .= "<li><a href='pn_equipo.php' ";
if ($sel2=="equipo") {$pn .= $selT;};
$pn .=">El Equipo</a></li>\n";
$pn .= "<li><a href='pn_clima.php' ";
if ($sel2=="clima") {$pn .= $selT;};
$pn .=">El Clima</a></li>\n";
$pn .= "<li><a href='pn_variablesclave.php' ";
if ($sel2=="varclave") {$pn .= $selT;};
$pn .=">Variables Clave</a></li>\n";
$pn .= "<li><a href='pn_estrategia.php' ";
if ($sel2=="estrategia") {$pn .= $selT;};
$pn .=">La Estrategia</a></li>\n";
$pn .= "<li><a href='pn_sieteelementos.php' ";
if ($sel2=="elemtos") {$pn .= $selT;};
$pn .=">Los 7 Elementos</a></li>\n";
$pn .= "<li><a href='pn_empresa.php' ";
if ($sel2=="otra_emp") {$pn .= $selT;};
$pn .=">Empresa ".ucfirst(otra_emp($_SESSION['empresa']))."</a></li>\n";

//SUB-MENUES N1 
$n1 .="<li><a href='n1_propuestas.php' ";
if ($sel2=="lista") {$n1 .= $selT;};
$n1 .=">Ver propuestas</a></li>\n";

if(fase_completa ('dataNegociacion1', $_SESSION['universo']) == FALSE) {
	$n1 .= "<li><a href='n1_redactar.php' "; //QUE NO ESTE DISPONIBLE CUANDO NO ME TOCA REDACTAR!
	if ($sel2=="new") {$n1 .= $selT;};
	$n1 .=">Crear propuesta</a></li>\n";
}

//SUB-MENUES N2
if(!fase_completa ('dataNegociacion2', $_SESSION['universo'])) {
$n2 .= "<li><a href='n2_vern1.php' "; //n2_ver.php
if ($sel2=="n2_vern1") {$n2 .= $selT;};
$n2 .=">Agenda acordada</a></li>\n";
}
$f2_completa = fase_completa ('dataNegociacion2', $_SESSION['universo']);
if(!$f2_completa) {
$item_propuestas = "Ver propuestas";}else {$item_propuestas= "Contrato Final";
}
$n2 .="<li><a href='n2_propuestas.php' ";
if ($sel2=="listas") {$n2 .= $selT;};
$n2 .=">".$item_propuestas."</a></li>\n";

if(!$f2_completa) {
	$n2 .= "<li><a href='n2_redactar.php' ";
	if ($sel2=="new") {$n2 .= $selT;};
	$n2 .=">Crear propuesta</a></li>\n";
}
if($f2_completa) {
	
	$n2 .= "<li><a href='n2_simular.php?id=".$f2_completa['id']."&empresa=".$_SESSION['empresa']."' ";
	if ($sel2=="sim") {$n2 .= $selT;};
	$n2 .=">Simular</a></li>\n";
	$n2 .= "<li><a href='n2_ver.php?id=".$f2_completa['id']."' ";
	if ($sel2=="tabla") {$n2 .= $selT;};
	$n2 .=">Tabla de decisiones</a></li>\n";
}


//SUB-MENUES MSJS
$msjs = "<li><a href='mensajes.php' ";
if ($sel2=="ver") {$msjs .= $selT;};
$msjs .=">Ver todos</a></li>\n";
$msjs .="<li><a href='mensaje-escribir.php' ";
if ($sel2=="new") {$msjs .= $selT;};
$msjs .=">Redactar</a></li>\n";

$menu = array('info'=>$info, 'pn'=>$pn,'n1'=>$n1,'n2'=>$n2, 'msjs'=>$msjs);
?>
		<div id="menu1" class="menu">
        	<div id="wrap">
	        	<ul>	
    	    		<li><a href="informacion.php" <?php if($sel1=="info") {echo $selT;}?>>Información</a></li>
        			<li><a href="pn_equipo.php" <?php if($sel1=="pn") {echo $selT;}?>>Pre-negociación</a></li>
					<?php if ((pn_aprobado($_SESSION['usuario'])) && !fase_completa('dataNegociacion1', $_SESSION['universo'])) {?>
        			<li>
						<a href="n1_propuestas.php" <?php if($sel1=="n1") {echo $selT;}?>>
                        Agenda de la Negociación
					  </a>
                    </li>
                    <?php }?>
					<?php if (fase_completa('dataNegociacion1', $_SESSION['universo'])) {?>
                    <li><a href="n2_propuestas.php" <?php if($sel1=="n2") {echo $selT;}?>>Negociaci&oacute;n</a></li>
                    <?php }?>
        			<li><a href="mensajes.php" <?php if($sel1=="msjs") {echo $selT;}?>>Mensajes</a></li>
           			<li><a href="resultados.php" <?php if($sel1=="res") {echo $selT;}?>>Resultados</a></li> 
       			</ul>
        	</div>
        </div>

	<?php if ($sel1!="") {?>
		<div id="menu2" class="menu">
        	<div id="wrap">
	        	<ul>	
					<?php echo $menu[$sel1];?>
       			</ul>
        	</div>
        </div>
	<?php }?>
