<?php 
		if ($accion == "ver") {
			$columna = array(1,0,1,1);
		} elseif ($accion == "redactar") {
			$columna = array(1, 1, 0, 1);
		} 
		$prios = array(1 => "Descartado", 2 => "Secundario", 3 => "Prioritario");
		$yesno = array('No', 'Si');
?>
<table border="0" cellspacing="0" cellpadding="0" id="tabla_n2">
              <tr class="table-head">
                  <td class="variable-name">&nbsp;</td>
                  <?php if ($columna[0]==1) {?>
                  <td class="variable-objetivo-small" >Prioridad</td>
                  <?php } ?>
                  <?php if ($columna[1]==1) {?>
                  <td class="variable-objetivo">Propuesta</td>
                  <?php } ?>
                  <?php if ($columna[2]==1) {?>
	              <td class="variable-objetivo">Propuesta</td>
	             
                  <?php } ?>
                  <?php if ($columna[3]==1) {?>
                   <td class="variable-comment">L&iacute;mites</td>
                  <?php } ?>
                </tr>
                <tr>
                  <td class="variable-name">Cantidad de modelos de robots a ensamblar</td>
                  <?php if ($columna[0]==1) {?>
                  <td class="variable-objetivo-small" ><?php echo $prios[$acuerdo_n1['modelos_ensamblar_prio']];?></td>
                  <?php } ?>
                  <?php if ($columna[1]==1) {?>
                  <td class="variable-objetivo"><input type="text" name="modelos_ensamblar" class="required" title="Valor inv&aacute;lido"  id="modelos_ensamblar" value="<?php echo $results['modelos_ensamblar'];?> " />
                  </td>
                  <?php } ?>
                  <?php if ($columna[2]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $results['modelos_ensamblar'];?></td>
                 
                  <?php } ?>
                  <?php if ($columna[3]==1) {?>
 <td class="variable-comment"><p>De 1 a 10</p></td>
                  <?php }?>
                </tr>
                <tr>
                  <td class="variable-name">Cant. de unidades que se compromete    Alfa a comprar</td>
                  <?php if ($columna[0]==1) {?>
                  <td class="variable-objetivo-small" ><?php echo $prios[$acuerdo_n1['unidades_comprar_prio']];?></td>
                  <?php } ?>
                  <?php if ($columna[1]==1) {?>
                  <td class="variable-objetivo"><input type="text" name="unidades_comprar" class="required" title="Valor inv&aacute;lido"  id="unidades_comprar" value="<?php echo $results['unidades_comprar'];?> " /></td>
                  <?php } ?>
                  <?php if ($columna[2]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $results['unidades_comprar'];?></td>
                  
                  <?php } ?>
                  <?php if ($columna[3]==1) {?>
                  <td class="variable-comment"><p>De  100 a 5000</p></td>
                  <?php } ?>                
                </tr>
				<tr>
                  <td class="variable-name">Duraci&oacute;n del compromiso de    compra de Alfa</td>
                  <?php if ($columna[0]==1) {?>
                  <td class="variable-objetivo-small" ><?php echo $prios[$acuerdo_n1['duracion_prio']];?></td>
                  <?php } ?>
                  <?php if ($columna[1]==1) {?>
                  <td class="variable-objetivo"><input type="text" name="duracion" class="required" title="Valor inv&aacute;lido"  id="duracion"  value="<?php echo $results['duracion'];?>" />
                            a&ntilde;os</td>
                  <?php } ?>
                  <?php if ($columna[2]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $results['duracion'];?> años</td>
                  
                  <?php } ?>
                  <?php if ($columna[3]==1) {?>
<td class="variable-comment"><p>De 1 a 5    a&ntilde;os</p></td>
                  <?php } ?>                </tr>
				<tr>
                  <td class="variable-name">Cant. m&aacute;xima de unidades que    se compromete Beta a entregar</td>
                  <?php if ($columna[0]==1) {?>
                  <td class="variable-objetivo-small" ><?php echo $prios[$acuerdo_n1['uni_entregar_beta_prio']];?></td>
                  <?php } ?>
                  <?php if ($columna[1]==1) {?>
                  <td class="variable-objetivo"><input type="text" name="uni_entregar_beta" class="required" title="Valor inv&aacute;lido"  id="uni_entregar_beta"   value="<?php echo $results['uni_entregar_beta'];?>" /></td>
                  <?php } ?>
                  <?php if ($columna[2]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $results['uni_entregar_beta'];?></td>
                  
                  <?php } ?>
                  <?php if ($columna[3]==1) {?>
<td class="variable-comment"><p>De 100    a 5000</p></td>
                  <?php } ?>                </tr>
                        <tr>
                  <td class="variable-name">Precio de las piezas que vende Beta</td>
                  <?php if ($columna[0]==1) {?>
                  <td class="variable-objetivo-small" ><?php echo $prios[$acuerdo_n1['precio_beta_prio']];?></td>
                  <?php } ?>
                  <?php if ($columna[1]==1) {?>
                  <td class="variable-objetivo"><input type="text" name="precio_beta" class="required" title="Valor inv&aacute;lido"  id="precio_beta" value="<?php echo $results['precio_beta'];?>"  />
                            mil U$S</td>
                  <?php } ?>

                  <?php if ($columna[2]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $results['precio_beta'];?> mil U$S</td>
                  
                  <?php } ?>
                  <?php if ($columna[3]==1) {?>
                  <td class="variable-comment"><p>De 50 a 150 mil U$S</p></td>
                  <?php } ?>
                </tr>
                        <tr>
                  <td class="variable-name">Cant. de modelos de robots a fabricar</td>
                  <?php if ($columna[0]==1) {?>
                  <td class="variable-objetivo-small" ><?php echo $prios[$acuerdo_n1['modelos_fabricar_prio']];?></td>
                  <?php } ?>
                  <?php if ($columna[1]==1) {?>
                  <td class="variable-objetivo"><input type="text" name="modelos_fabricar" class="required" title="Valor inv&aacute;lido"  id="modelos_fabricar" value="<?php echo $results['modelos_fabricar'];?>"/></td>
                  <?php } ?>
                  <?php if ($columna[2]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $results['modelos_fabricar'];?></td>
                  
                  <?php } ?>
                  <?php if ($columna[3]==1) {?>
<td class="variable-comment"><p>De 1 a 10</p></td>
          <?php } ?>                </tr>
                        <tr>
                  <td class="variable-name">Regal&iacute;as que paga Alfa por fabricar con tecnolog&iacute;a de Beta</td>
                  <?php if ($columna[0]==1) {?>
                  <td class="variable-objetivo-small" ><?php echo $prios[$acuerdo_n1['regalias_beta_prio']];?></td>
                  <?php } ?>
                  <?php if ($columna[1]==1) {?>
                  <td class="variable-objetivo"><input type="text" name="regalias_beta" class="required" title="Valor inv&aacute;lido"  id="regalias_beta" value="<?php echo $results['regalias_beta'];?>"/>
                            %</td>
                  <?php } ?>
                  <?php if ($columna[2]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $results['regalias_beta'];?> %</td>
                  
                  <?php } ?>
                  <?php if ($columna[3]==1) {?>
                  <td class="variable-comment"><p>De 1% a    20%</p></td>
                  <?php } ?>                            
                </tr>
				<?php if ($acuerdo_n1['compartir_va_prio']>1) { ?>
                <tr>
                  <td class="variable-name">Que Alfa comparta    tecnolog&iacute;a de Visi&oacute;n Artificial&nbsp;</td>
                  <?php if ($columna[0]==1) {?>
                  <td class="variable-objetivo-small" ><?php echo $prios[$acuerdo_n1['compartir_va_prio']];?></td>
                  <?php } ?>
                  <?php if ($columna[1]==1) {?>
                  <td class="variable-objetivo"><select name="compartir_va" class="required" title="Elija una opci&oacute;n"  id="compartir_va">
                      <option value="">Elija...</option>
                      <option value="1" <?php if ($results['compartir_va'] ==1) {echo " selected='selected' ";}?>>Si</option>
                      <option value="0" <?php if ($results['id']>0 && $results['compartir_va'] ==0) {echo " selected='selected' ";}?>>No</option>
                    </select></td>
                  <?php } ?>
                  <?php if ($columna[2]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $yesno[$results['compartir_va']];?></td>
                  <?php } ?>
                  <?php if ($columna[3]==1) {?>
                  <td class="variable-comment">&nbsp;</td>

          <?php } ?>                </tr><?php } 
				if ($acuerdo_n1['compartir_kh_prio']>1) { ?>
                <tr>
                  <td class="variable-name">Que Beta comparta know-how de fabricaci&oacute;n</td>
                  <?php if ($columna[0]==1) {?>
                  <td class="variable-objetivo-small" ><?php echo $prios[$acuerdo_n1['compartir_kh_prio']];?></td>
                  <?php } ?>
                  <?php if ($columna[1]==1) {?>
                  <td class="variable-objetivo"><select name="compartir_kh" class="required" title="Elija una opci&oacute;n"  id="compartir_kh">
                      <option value="">Elija...</option>
                      <option value="1" <?php if ($results['compartir_kh'] ==1) {echo " selected='selected' ";}?>>Si</option>
                      <option value="0" <?php if ($results['id']>0 && $results['compartir_kh'] ==0) {echo " selected='selected' ";}?>>No</option>
                    </select></td>
                  <?php } ?>
                  <?php if ($columna[2]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $yesno[$results['compartir_kh']];?></td>
                  <?php } ?>
                  <?php if ($columna[3]==1) {?>
                  <td class="variable-comment">&nbsp;</td>
          <?php } ?>
                </tr><?php } 
				if ($acuerdo_n1['exclusividad_compra_prio']>1) { ?>
                        <tr>
                  <td class="variable-name">Que Alfa compre exclusivamente    a Beta</td>
                  <?php if ($columna[0]==1) {?>
                  <td class="variable-objetivo-small" ><?php echo $prios[$acuerdo_n1['exclusividad_compra_prio']];?></td>
                  <?php } ?>
                  <?php if ($columna[1]==1) {?>
                  <td class="variable-objetivo"><select name="exclusividad_compra" class="required" title="Elija una opci&oacute;n"  id="exclusividad_compra">
                      <option value="">Elija...</option>
                      <option value="1" <?php if ($results['exclusividad_compra'] ==1) {echo " selected='selected' ";}?>>Si</option>
                      <option value="0" <?php if ($results['id']>0 && $results['exclusividad_compra'] ==0) {echo " selected='selected' ";}?>>No</option>
                    </select></td>
                  <?php } ?>
                  <?php if ($columna[2]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $yesno[$results['exclusividad_compra']];?></td>
                  <?php } ?>
                  <?php if ($columna[3]==1) {?>
                  <td class="variable-comment">&nbsp;</td>
                  <?php } ?>
                </tr><?php } 
				if ($acuerdo_n1['exclusividad_venta_prio']>1) { ?>
                        <tr>
                  <td class="variable-name">Que Beta le venda    exclusivamente a Alfa en Pa&iacute;s Alfa</td>
                  <?php if ($columna[0]==1) {?>
                  <td class="variable-objetivo-small" ><?php echo $prios[$acuerdo_n1['exclusividad_venta_prio']];?></td>
                  <?php } ?>                  
                  <?php if ($columna[1]==1) {?>
                  <td class="variable-objetivo"><select name="exclusividad_venta" class="required" title="Elija una opci&oacute;n"  id="exclusividad_venta">
                      <option value="">Elija...</option>
                      <option value="1" <?php if ($results['exclusividad_venta'] ==1) {echo " selected='selected' ";}?>>Si</option>
                      <option value="0" <?php if ($results['id']>0   && $results['exclusividad_venta'] ==0) {echo " selected='selected' ";}?>>No</option>
                    </select></td>
                  <?php } ?>
                  <?php if ($columna[2]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $yesno[$results['exclusividad_venta']];?></td>

                  <?php } ?>
                  <?php if ($columna[3]==1) {?>
                  <td class="variable-comment">&nbsp;</td>                  <?php } ?>
                </tr><?php } 
				if ($acuerdo_n1['adelanto_beta_alfa_prio']>1) { ?>
                        <tr>
                  <td class="variable-name">Adelanto en efectivo de Beta a    Alfa por el contrato</td>
                  <?php if ($columna[0]==1) {?>
                  <td class="variable-objetivo-small" ><?php echo $prios[$acuerdo_n1['adelanto_beta_alfa_prio']];?></td>
                  <?php } ?>
                  <?php if ($columna[1]==1) {?>
                  <td class="variable-objetivo"><input type="text" name="adelanto_beta_alfa" class="required" title="Valor inv&aacute;lido"  id="adelanto_beta_alfa" value="<?php echo $results['adelanto_beta_alfa'];?>"/>
                            millones U$S</td>
                  <?php } ?>
                  <?php if ($columna[2]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $results['adelanto_beta_alfa'];?> millones U$S</td>
                  
                  <?php } ?>
                  <?php if ($columna[3]==1) {?><td class="variable-comment">&nbsp;</td>
                  <?php } ?>
                </tr><?php } 
				if ($acuerdo_n1['adelanto_alfa_beta_prio']>1) { ?>
                <tr>
                  <td class="variable-name">Adelanto en efectivo de Alfa a    Beta por el contrato</td>
                  <?php if ($columna[0]==1) {?>
                  <td class="variable-objetivo-small" ><?php echo $prios[$acuerdo_n1['adelanto_alfa_beta_prio']];?></td>
                  <?php } ?>
                  <?php if ($columna[1]==1) {?>
                  <td class="variable-objetivo"><input type="text" name="adelanto_alfa_beta" class="required" title="Valor inv&aacute;lido"  id="adelanto_alfa_beta" value="<?php echo $results['adelanto_alfa_beta'];?>"/>
                  millones U$S</td>
                  <?php } ?>
                  <?php if ($columna[2]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $results['adelanto_alfa_beta'];?> millones U$S</td>
                  
                  <?php } ?>
                  <?php if ($columna[3]==1) {?><td class="variable-comment">&nbsp;</td>
		          <?php } ?>                  
                </tr><?php }?>
                
         </table>