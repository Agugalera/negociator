<?php
	$selT="selected";
	$selTL=" class='selected' ";
	
//SUB-MENUES MSJS
$msjs = "<li><a href='mensajes.php' ";
if ($sel2a=="ver") {$msjs .= $selTL;};
$msjs .=">Ver todos</a></li>\n";
$msjs .="<li><a href='mensaje-escribir.php' ";
if ($sel2a=="new") {$msjs .= $selTL;};
$msjs .=">Redactar</a></li>\n";

$menuA = array('info'=>FALSE,"pn"=>FALSE,"n1"=>FALSE, "n2"=>FALSE, "msjs"=>$msjs, "admin"=>FALSE );
?>
		<div id="menu1" class="menu">
        	<div id="wrap">
	        	<ul>	
    	    		<li><a href="index.php" class="nosub <?php if($sel1a=="info") {echo $selT;}?>">Gu&iacute;a</a></li>
        			<li><a href="prenegociacion.php" class="nosub <?php if($sel1a=="pn") {echo $selT;}?>">Prenegociaci&oacute;n</a></li>
        			<li><a href="negociacion1.php" class="nosub <?php if($sel1a=="n1") {echo $selT;}?>">Agenda</a></li>
                    <li><a href="negociacion2.php" class="nosub <?php if($sel1a=="n2") {echo $selT;}?>">Negociaci&oacute;n</a></li>
					<li><a href="ptajefinal.php" class="nosub <?php if($sel1a=="fin") {echo $selT;}?>">Puntaje Final</a></li>
                    <li><a href="resumen.php" class="nosub <?php if($sel1a=="resumen") {echo $selT;}?>">Resumen</a></li>
        			<li><a href="mensajes.php" class="<?php if($sel1a=="msjs") {echo $selT;}?>">Mensajes</a></li>
           			<li><a href="admin.php" class="nosub <?php if($sel1a=="admin") {echo $selT;}?>">Administraci&oacute;n</a></li>
       			</ul>
        	</div>
        </div>

	<?php if ($sel1a!="" && $menuA[$sel1a]!=FALSE) {?>

		<div id="menu2" class="menu">
        	<div id="wrap">
	        	<ul>	
					<?php echo $menuA[$sel1a];?>
       			</ul>
        	</div>
        </div>
	<?php }?>