<table width="100%" border="0" cellspacing="0" cellpadding="0" class="resumen_ptos">
  <tr class="equipos">
    <td class="fase">&nbsp;</td>
    <td class="subcat">&nbsp;</td>
    <td class="puntos">Alfa</td>
    <td class="puntos">Beta</td>
  </tr>
  <tr class="header pn" id="pn_header">
    <td class="fase">Prenegociaci&oacute;n</td>
    <td class="subcat">Promedio</td>
    <td class="puntos"><?php if (is_array($ptos_alfa_pn)) { echo round(array_sum($ptos_alfa_pn)/count($ptos_alfa_pn),1); } else {echo 0;} ?>&nbsp;</td>
    <td class="puntos"><?php if (is_array($ptos_beta_pn)) { echo round(array_sum($ptos_beta_pn)/count($ptos_beta_pn),1); } else {echo 0;} ?>&nbsp;</td>
  </tr>
  <tr class="pn odd">
    <td class="fase">&nbsp;</td>
    <td class="subcat">Estrategia</td>
    <td class="puntos"><?php echo $ptos_alfa_pn['estrategia']; ?></td>
    <td class="puntos"><?php echo $ptos_beta_pn['estrategia']; ?></td>
  </tr>
  <tr class="pn even">
    <td class="fase">&nbsp;</td>
    <td class="subcat">Clima</td>
    <td class="puntos"><?php echo $ptos_alfa_pn['clima']; ?></td>
    <td class="puntos"><?php echo $ptos_beta_pn['clima']; ?></td>
  </tr>
  <tr class="pn odd">
    <td class="fase">&nbsp;</td>
    <td class="subcat">Los siete elementos</td>
    <td class="puntos"><?php echo $ptos_alfa_pn['elementos']; ?></td>
    <td class="puntos"><?php echo $ptos_beta_pn['elementos']; ?></td>
  </tr>
  <tr class="pn even">
    <td class="fase">&nbsp;</td>
    <td class="subcat">Variables Clave</td>
    <td class="puntos"><?php echo $ptos_alfa_pn['claves']; ?></td>
    <td class="puntos"><?php echo $ptos_beta_pn['claves']; ?></td>
  </tr>
  <tr class="neg header">
    <td class="fase">Negociaci&oacute;n</td>
    <td class="subcat">Promedio</td>
		<?php 
		$neg_keys = array("n1", "n2", "msj");
		$neg_alfa_array = array(); $neg_beta_array = array();
		foreach ($neg_keys as $key) {
			if ($neg_alfa[$key] > 0) {$neg_alfa_array[$key] = $neg_alfa[$key];}
			if ($neg_beta[$key] > 0) {$neg_beta_array[$key] = $neg_beta[$key];}
		} 
		?>
    <td class="puntos"><?php echo round(array_sum($neg_alfa_array)/count($neg_alfa_array), 1); ?></td>
    <td class="puntos"><?php echo round(array_sum($neg_beta_array)/count($neg_beta_array), 1); ?></td>
  </tr>
  <tr class="neg odd">
    <td class="fase">&nbsp;</td>
    <td class="subcat">Agenda de la negociaci&oacute;n</td>
    <td class="puntos"><?php echo $neg_alfa['n1']; ?></td>
    <td class="puntos"><?php echo $neg_beta['n1']; ?></td>
  </tr>
  <tr class="neg even">
    <td class="fase">&nbsp;</td>
    <td class="subcat">Cantidad y variedad de propuestas</td>
    <td class="puntos"><?php echo $neg_alfa['n2']; ?></td>
    <td class="puntos"><?php echo $neg_beta['n2']; ?></td>
  </tr>
  <tr class="neg odd">
    <td class="fase">&nbsp;</td>
    <td class="subcat">Comunicaci&oacute;n</td>
    <td class="puntos"><?php echo $neg_alfa['msj']; ?></td>
    <td class="puntos"><?php echo $neg_beta['msj']; ?></td>
  </tr>
  <tr class="contrato header">
    <td class="fase">Contrato</td>
    <td class="subcat">Promedio</td>
    <td class="puntos"><?php echo round(($output['Resumen'][0]+$output['Resumen'][1]+$output['Resumen'][2]+$output['Resumen'][3])*$puntaje_maximo/4,1);?></td>
    <td class="puntos"><?php echo round(($output['Resumen_Beta'][0]+$output['Resumen_Beta'][1]+$output['Resumen_Beta'][2]+$output['Resumen_Beta'][3])*$puntaje_maximo/4,1);?></td>
  </tr>
  <tr class="contr odd">
    <td class="fase">&nbsp;</td>
    <td class="subcat">Valor actual</td>
    <td class="puntos"><?php if ($output) {echo round($output['Resumen'][0]*$puntaje_maximo,1);}?></td>
    <td class="puntos"><?php if ($output) {echo round($output['Resumen_Beta'][0]*$puntaje_maximo,1);}?></td>
  </tr>
  <tr class="contr even">
    <td class="fase">&nbsp;</td>
    <td class="subcat">Margen</td>
    <td class="puntos"><?php if ($output) {echo round($output['Resumen'][1]*$puntaje_maximo,1);}?></td>
    <td class="puntos"><?php if ($output) {echo round($output['Resumen_Beta'][1]*$puntaje_maximo,1);}?></td>
  </tr>
  <tr class="contr odd">
    <td class="fase">&nbsp;</td>
    <td class="subcat">Market Share</td>
    <td class="puntos"><?php if ($output) {echo round($output['Resumen'][2]*$puntaje_maximo,1);}?></td>
    <td class="puntos"><?php if ($output) {echo round($output['Resumen_Beta'][2]*$puntaje_maximo,1);}?></td>
  </tr>
  <tr class="contr even">
    <td class="fase">&nbsp;</td>
    <td class="subcat">Seguridad</td>
    <td class="puntos"><?php if ($output) {echo round($output['Resumen'][3]*$puntaje_maximo,1);}?></td>
    <td class="puntos"><?php if ($output) {echo round($output['Resumen_Beta'][3]*$puntaje_maximo,1);}?></td>
  </tr>
  <tr class="puntajefinal header">
    <td class="fase">Puntaje Final</td>
    <td class="subcat"></td>
    <td class="puntos"><?php echo $neg_alfa['fin'];?></td>
    <td class="puntos"><?php echo $neg_beta['fin'];?></td>
  </tr>
</table>