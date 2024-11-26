<?php
		if ($fase == "pn") {
			$columna = array(0, 1, 0, 0, 1);
		} elseif ($fase == "admin_pn"
				  /* && strtolower($results['empresa'])=="alfa") {
			$columna = array (0, 0, 0, 0, 0, 0, 1, 1, 0, 1, 1);				  
		} elseif ($fase == "admin_pn" && strtolower($results['empresa'])=="beta"*/) {
			$columna = array (0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1);				  
		}elseif ($fase == "n1_redactar" ) {
//			$columna = array (1, 0, 1, 1, 0, 0, 0);
			$columna = array (1, 0, 0, 0, 0, 0, 0);
		} elseif ($fase == "n1_ver" ) {
//			$columna = array (0, 0, 0, 0, 0, 1, 1, 1);
			$columna = array (0, 0, 0, 0, 0, 1, 0, 0);
		} else {$columna = array (0, 0, 0, 0, 0);}
		$prios = array(1 => "Descartado", 2 => "Secundario", 3 => "Prioritario");
		$yesno = array('No', 'S&iacute;');
		$clasif = array (3=> "Roja", 2=>'Verde', 1=>"Amarilla");
?>
<table border="0" cellspacing="0" cellpadding="0" id="tabla_vars-clave" <?php if ($fase == "admin_pn") {echo "class='".$results['empresa']."  admin_varclave'";}?> >
              <tr class="table-head">
                  <td class="variable-name">&nbsp;</td>
                  <?php if ($columna[0]==1) {?>
                  <td class="variable-clasif">Prioridad</td>
                  <?php } ?>
                  <?php if ($columna[1]==1) {?>
                  <td class="variable-clasif">Clasificaci&oacute;n</td>
                  <?php } ?>
                  <?php if ($columna[2]==1) {?>
                  <td class="variable-objetivo"><?php if ($fase == 'n1_redactar' || $fase == 'n1_ver') {echo "L&iacute;mite inferior";} else {echo "Obj. de M&iacute;nima";}?></td>
                  <?php } ?>
                  <?php if ($columna[3]==1) {?>
                  <td class="variable-objetivo"><?php if ($fase == 'n1_redactar' || $fase == 'n1_ver') {echo "L&iacute;mite superior";} else {echo "Obj. de M&aacute;xima";}?></td>
                  <?php } ?>
                  <?php if ($columna[4]==1) {?>
                  <td class="variable-objetivo"><?php if ($_SESSION['empresa']=="alfa") {echo "Obj. Esperado";} else {echo "Objetivo";}?></td>
                  <?php } ?>
                  <?php if ($columna[9]==1) {?>
                  <td class="variable-objetivo-small" >Clasificaci&oacute;n</td>
                  <?php } ?>

                  <?php if ($columna[5]==1) {?>
                  <td class="variable-objetivo-small" >Prioridad</td>
                  <?php } ?>
                  <?php if ($columna[6]==1) {?>
              <td class="variable-objetivo-small">L&iacute;mite Inferior</td>
                  <?php } ?>
                  <?php if ($columna[7]==1) {?>
                  <td class="variable-objetivo-small">L&iacute;mite Superior</td>
                  <?php } ?>
                  <?php if ($columna[10]==1) {?>
                  <td class="variable-comment">Objetivo</td>
                  <?php } ?>
                  <td class="variable-comment"></td>
                </tr>
                <tr class="even">
                  <td class="variable-name">Cantidad de modelos de robots a ensamblar</td>
                  <?php if ($columna[0]==1) {?>
                  <td class="variable-clasif"><select name="modelos_ensamblar_prio" class="required" title="Elija una opci&oacute;n"  id="modelos_ensamblar_prio">
                    <option value="">Elija...</option>
                    <option value="3" <?php if ($results['modelos_ensamblar_prio'] ==3) {echo " selected='selected' ";}?>>Prioritaria</option>
                    <option value="2" <?php if ($results['modelos_ensamblar_prio'] ==2) {echo " selected='selected' ";}?>>Secundaria</option>
                  </select></td>
                  <?php } ?>
                  <?php if ($columna[1]==1) {?>
                  <td class="variable-clasif"><select name="modelos_ensamblar_clas" class="required" title="Elija una opci&oacute;n"  id="modelos_ensamblar_clas">
                      <option value="">Elija...</option>
                      <option value="3" <?php if ($results['modelos_ensamblar_clas'] ==3) {echo " selected='selected' ";}?>>Roja</option>
                      <option value="2" <?php if ($results['modelos_ensamblar_clas'] ==2) {echo " selected='selected' ";}?>>Verde</option>
                      <option value="1" <?php if ($results['modelos_ensamblar_clas'] ==1) {echo " selected='selected' ";}?>>Amarilla</option>
                    </select></td>
                  <?php } ?>
                  <?php if ($columna[2]==1) {?>
                  <td class="variable-objetivo"><input type="text" name="modelos_ensamblar_min" class="required" title="Valor inv&aacute;lido"  id="modelos_ensamblar_min" value="<?php echo $results['modelos_ensamblar_min'];?>" /></td>
                  <?php } ?>
                  <?php if ($columna[3]==1) {?>
                  <td class="variable-objetivo"><input type="text" name="modelos_ensamblar_max" class="required" title="Valor inv&aacute;lido"  id="modelos_ensamblar_max" value="<?php echo $results['modelos_ensamblar_max'];?>"/></td>
                  <?php } ?>
                  <?php if ($columna[4]==1) {?>
                  <td class="variable-objetivo"><input type="text" name="modelos_ensamblar_obj" class="required" title="Valor inv&aacute;lido"  id="modelos_ensamblar_obj" value="<?php echo $results['modelos_ensamblar_obj'];?> " />
                  </td>
                  <?php } ?>
                  <?php if ($columna[9]==1) {?>
                  <td class="variable-objetivo-small" ><?php echo $clasif[$results['modelos_ensamblar_clas']];?></td>
                  <?php } ?>
                  <?php if ($columna[5]==1) {?>
                  <td class="variable-objetivo-small" ><?php echo $prios[$results['modelos_ensamblar_prio']];?></td>
                  <?php } ?>
                  <?php if ($columna[6]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $results['modelos_ensamblar_min'];?></td>
                  <?php } ?>
                  <?php if ($columna[7]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $results['modelos_ensamblar_max'];?></td>
                  <?php }?>
                  <?php if ($columna[10]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $results['modelos_ensamblar_obj'];?></td>
                  <?php }?>
                  <td class="variable-comment"><p>De 1 a 10</p></td>
                </tr>
                        <tr class="odd">
                  <td class="variable-name">Cant. de unidades que se compromete    Alfa a comprar</td>
                  <?php if ($columna[0]==1) {?>
                  <td class="variable-clasif"><select name="unidades_comprar_prio" class="required" title="Elija una opci&oacute;n"  id="unidades_comprar_clas">
                    <option value="">Elija...</option>
                    <option value="3" <?php if ($results['unidades_comprar_prio'] ==3) {echo " selected='selected' ";}?>>Prioritaria</option>
                    <option value="2" <?php if ($results['unidades_comprar_prio'] ==2) {echo " selected='selected' ";}?>>Secundaria</option>
                  </select></td>
                  <?php } ?>
                  <?php if ($columna[1]==1) {?>
                  <td class="variable-clasif"><select name="unidades_comprar_clas" class="required" title="Elija una opci&oacute;n"  id="unidades_comprar_clas">
                      <option value="">Elija...</option>
                      <option value="3" <?php if ($results['unidades_comprar_clas'] ==3) {echo " selected='selected' ";}?>>Roja</option>
                      <option value="2" <?php if ($results['unidades_comprar_clas'] ==2) {echo " selected='selected' ";}?>>Verde</option>
                      <option value="1" <?php if ($results['unidades_comprar_clas'] ==1) {echo " selected='selected' ";}?>>Amarilla</option>
                    </select></td>
                  <?php } ?>
                  <?php if ($columna[2]==1) {?>
                  <td class="variable-objetivo"><input type="text" name="unidades_comprar_min" class="required" title="Valor inv&aacute;lido"  id="unidades_comprar_min" value="<?php echo $results['unidades_comprar_min'];?> " /></td>
                  <?php } ?>
                  <?php if ($columna[3]==1) {?>
                  <td class="variable-objetivo"><input type="text" name="unidades_comprar_max" class="required" title="Valor inv&aacute;lido"  id="unidades_comprar_max" value="<?php echo $results['unidades_comprar_max'];?> " /></td>
                  <?php } ?>
                  <?php if ($columna[4]==1) {?>
                  <td class="variable-objetivo"><input type="text" name="unidades_comprar_obj" class="required" title="Valor inv&aacute;lido"  id="unidades_comprar_obj" value="<?php echo $results['unidades_comprar_obj'];?> " /></td>
                  <?php } ?>
                  <?php if ($columna[9]==1) {?>
                  <td class="variable-objetivo-small" ><?php echo $clasif[$results['unidades_comprar_clas']];?></td>
                  <?php } ?>
                  <?php if ($columna[5]==1) {?>
                  <td class="variable-objetivo-small" ><?php echo $prios[$results['unidades_comprar_prio']];?></td>
                  <?php } ?>
                  <?php if ($columna[6]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $results['unidades_comprar_min'];?></td>
                  <?php } ?>
                  <?php if ($columna[7]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $results['unidades_comprar_max'];?></td>
                  <?php } ?>
                  <?php if ($columna[10]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $results['unidades_comprar_obj'];?></td>
                  <?php }?>
                  <td class="variable-comment"><p>De  100 a 5000</p></td>
                </tr>
                        <tr class="even">
                  <td class="variable-name">Duraci&oacute;n del compromiso de    compra de Alfa</td>
                  <?php if ($columna[0]==1) {?>
                  <td class="variable-clasif"><select name="duracion_prio" class="required" title="Elija una opci&oacute;n"  id="duracion_clas">
                    <option value="">Elija...</option>
                    <option value="3" <?php if ($results['duracion_prio'] ==3) {echo " selected='selected' ";}?>>Prioritaria</option>
                    <option value="2" <?php if ($results['duracion_prio'] ==2) {echo " selected='selected' ";}?>>Secundaria</option>
                  </select></td>
                  <?php } ?>
                  <?php if ($columna[1]==1) {?>
                  <td class="variable-clasif"><select name="duracion_clas" class="required" title="Elija una opci&oacute;n"  id="duracion_clas">
                      <option value="">Elija...</option>
                      <option value="3" <?php if ($results['duracion_clas'] ==3) {echo " selected='selected' ";}?>>Roja</option>
                      <option value="2" <?php if ($results['duracion_clas'] ==2) {echo " selected='selected' ";}?>>Verde</option>
                      <option value="1" <?php if ($results['duracion_clas'] ==1) {echo " selected='selected' ";}?>>Amarilla</option>
                    </select></td>
                  <?php } ?>
                  <?php if ($columna[2]==1) {?>
                  <td class="variable-objetivo"><input type="text" name="duracion_min" class="required" title="Valor inv&aacute;lido"  id="duracion_min"  value="<?php echo $results['duracion_min'];?>" />
                            a&ntilde;os</td>
                  <?php } ?>
                  <?php if ($columna[3]==1) {?>
                  <td class="variable-objetivo"><input type="text" name="duracion_max" class="required" title="Valor inv&aacute;lido"  id="duracion_max"  value="<?php echo $results['duracion_max'];?>" />
                            a&ntilde;os</td>
                  <?php } ?>
                  <?php if ($columna[4]==1) {?>
                  <td class="variable-objetivo"><input type="text" name="duracion_obj" class="required" title="Valor inv&aacute;lido"  id="duracion_obj"  value="<?php echo $results['duracion_obj'];?>" />
                            a&ntilde;os</td>
                  <?php } ?>
                  <?php if ($columna[9]==1) {?>
                  <td class="variable-objetivo-small" ><?php echo $clasif[$results['duracion_clas']];?></td>
                  <?php } ?>
                  <?php if ($columna[5]==1) {?>
                  <td class="variable-objetivo-small" ><?php echo $prios[$results['duracion_prio']];?></td>
                  <?php } ?>
                  <?php if ($columna[6]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $results['duracion_min'];?> años</td>
                  <?php } ?>
                  <?php if ($columna[7]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $results['duracion_max'];?> años</td>
                  <?php } ?>
                  <?php if ($columna[10]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $results['duracion_obj'];?> a&ntilde;os</td>
                  <?php }?>
                  <td class="variable-comment"><p>De 1 a 5    a&ntilde;os</p></td>
                </tr>
                        <tr class="odd">
                  <td class="variable-name">Cant. m&aacute;xima de unidades que    se compromete Beta a entregar</td>

                  <?php if ($columna[0]==1) {?>
                  <td class="variable-clasif"><select name="uni_entregar_beta_prio" class="required" title="Elija una opci&oacute;n"  id="uni_entregar_beta_clas">
                    <option value="">Elija...</option>
                    <option value="3" <?php if ($results['uni_entregar_beta_prio'] ==3) {echo " selected='selected' ";}?>>Prioritaria</option>
                    <option value="2" <?php if ($results['uni_entregar_beta_prio'] ==2) {echo " selected='selected' ";}?>>Secundaria</option>
                  </select></td>
                  <?php } ?>
                  <?php if ($columna[1]==1) {?>
                  <td class="variable-clasif"><select name="uni_entregar_beta_clas" class="required" title="Elija una opci&oacute;n"  id="uni_entregar_beta_clas">
                      <option value="">Elija...</option>
                      <option value="3" <?php if ($results['uni_entregar_beta_clas'] ==3) {echo " selected='selected' ";}?>>Roja</option>
                      <option value="2" <?php if ($results['uni_entregar_beta_clas'] ==2) {echo " selected='selected' ";}?>>Verde</option>
                      <option value="1" <?php if ($results['uni_entregar_beta_clas'] ==1) {echo " selected='selected' ";}?>>Amarilla</option>
                    </select></td>
                  <?php } ?>
                  <?php if ($columna[2]==1) {?>
                  <td class="variable-objetivo"><input type="text" name="uni_entregar_beta_min" class="required" title="Valor inv&aacute;lido"  id="uni_entregar_beta_min"   value="<?php echo $results['uni_entregar_beta_min'];?>" /></td>
                  <?php } ?>
                  <?php if ($columna[3]==1) {?>
                  <td class="variable-objetivo"><input type="text" name="uni_entregar_beta_max" class="required" title="Valor inv&aacute;lido"  id="uni_entregar_beta_max"   value="<?php echo $results['uni_entregar_beta_max'];?>" /></td>
                  <?php } ?>
                  <?php if ($columna[4]==1) {?>
                  <td class="variable-objetivo"><input type="text" name="uni_entregar_beta_obj" class="required" title="Valor inv&aacute;lido"  id="uni_entregar_beta_obj"   value="<?php echo $results['uni_entregar_beta_obj'];?>" /></td>
                  <?php } ?>
                  <?php if ($columna[9]==1) {?>
                  <td class="variable-objetivo-small" ><?php echo $clasif[$results['uni_entregar_beta_clas']];?></td>
                  <?php } ?>
                  
                  <?php if ($columna[5]==1) {?>
                  <td class="variable-objetivo-small" ><?php echo $prios[$results['uni_entregar_beta_prio']];?></td>
                  <?php } ?>
                  <?php if ($columna[6]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $results['uni_entregar_beta_min'];?></td>
                  <?php } ?>
                  <?php if ($columna[7]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $results['uni_entregar_beta_max'];?></td>
                  <?php } ?>
                  <?php if ($columna[10]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $results['uni_entregar_beta_obj'];?></td>
                  <?php }?>

          <td class="variable-comment"><p>De 100    a 5000</p></td>
                </tr>
                        <tr class="even">
                  <td class="variable-name">Precio de las piezas que vende Beta</td>
                  <?php if ($columna[0]==1) {?>
                  <td class="variable-clasif"><select name="precio_beta_prio" class="required" title="Elija una opci&oacute;n"  id="precio_beta_clas">
                    <option value="">Elija...</option>
                    <option value="3" <?php if ($results['precio_beta_prio'] ==3) {echo " selected='selected' ";}?>>Prioritaria</option>
                    <option value="2" <?php if ($results['precio_beta_prio'] ==2) {echo " selected='selected' ";}?>>Secundaria</option>
                  </select></td>
                  <?php } ?>
                  <?php if ($columna[1]==1) {?>
                  <td class="variable-clasif"><select name="precio_beta_clas" class="required" title="Elija una opci&oacute;n"  id="precio_beta_clas">
                      <option value="">Elija...</option>
                      <option value="3" <?php if ($results['precio_beta_clas'] ==3) {echo " selected='selected' ";}?>>Roja</option>
                      <option value="2" <?php if ($results['precio_beta_clas'] ==2) {echo " selected='selected' ";}?>>Verde</option>
                      <option value="1" <?php if ($results['precio_beta_clas'] ==1) {echo " selected='selected' ";}?>>Amarilla</option>
                    </select></td>
                  <?php } ?>
                  <?php if ($columna[2]==1) {?>
                  <td class="variable-objetivo"><input type="text" name="precio_beta_min" class="required" title="Valor inv&aacute;lido"  id="precio_beta_min" value="<?php echo $results['precio_beta_min'];?>"  />
                            mil U$S</td>
                  <?php } ?>
                  <?php if ($columna[3]==1) {?>
                  <td class="variable-objetivo"><input type="text" name="precio_beta_max" class="required" title="Valor inv&aacute;lido"  id="precio_beta_max" value="<?php echo $results['precio_beta_max'];?>"  />
                            mil U$S</td>
                  <?php } ?>
                  <?php if ($columna[4]==1) {?>
                  <td class="variable-objetivo"><input type="text" name="precio_beta_obj" class="required" title="Valor inv&aacute;lido"  id="precio_beta_obj" value="<?php echo $results['precio_beta_obj'];?>"  />
                            mil U$S</td>
                  <?php } ?>
                  <?php if ($columna[9]==1) {?>
                  <td class="variable-objetivo-small" ><?php echo $clasif[$results['precio_beta_clas']];?></td>
                  <?php } ?>
                  
                  <?php if ($columna[5]==1) {?>
                  <td class="variable-objetivo-small" ><?php echo $prios[$results['precio_beta_prio']];?></td>
                  <?php } ?>
                  <?php if ($columna[6]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $results['precio_beta_min'];?> mil U$S</td>
                  <?php } ?>
                  <?php if ($columna[7]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $results['precio_beta_max'];?> mil U$S</td>
                  <?php } ?>
                  <?php if ($columna[10]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $results['precio_beta_obj'];?> mil U$S</td>
                  <?php }?>
                  
          <td class="variable-comment"><p>De 50 a 150 mil U$S</p></td>
                </tr>
                        <tr class="odd">
                  <td class="variable-name">Cant. de modelos de robots a fabricar</td>
                  <?php if ($columna[0]==1) {?>
                  <td class="variable-clasif"><select name="modelos_fabricar_prio" class="required" title="Elija una opci&oacute;n"  id="modelos_fabricar_clas">
                    <option value="">Elija...</option>
                    <option value="3" <?php if ($results['modelos_fabricar_prio'] ==3) {echo " selected='selected' ";}?>>Prioritaria</option>
                    <option value="2" <?php if ($results['modelos_fabricar_prio'] ==2) {echo " selected='selected' ";}?>>Secundaria</option>
                  </select></td>
                  <?php } ?>
                  <?php if ($columna[1]==1) {?>
                  <td class="variable-clasif"><select name="modelos_fabricar_clas" class="required" title="Elija una opci&oacute;n"  id="modelos_fabricar_clas">
                      <option value="">Elija...</option>
                      <option value="3" <?php if ($results['modelos_fabricar_clas'] ==3) {echo " selected='selected' ";}?>>Roja</option>
                      <option value="2" <?php if ($results['modelos_fabricar_clas'] ==2) {echo " selected='selected' ";}?>>Verde</option>
                      <option value="1" <?php if ($results['modelos_fabricar_clas'] ==1) {echo " selected='selected' ";}?>>Amarilla</option>
                    </select></td>
                  <?php } ?>
                  <?php if ($columna[2]==1) {?>
                  <td class="variable-objetivo"><input type="text" name="modelos_fabricar_min" class="required" title="Valor inv&aacute;lido"  id="modelos_fabricar_min" value="<?php echo $results['modelos_fabricar_min'];?>"/></td>
                  <?php } ?>
                  <?php if ($columna[3]==1) {?>
                  <td class="variable-objetivo"><input type="text" name="modelos_fabricar_max" class="required" title="Valor inv&aacute;lido"  id="modelos_fabricar_max" value="<?php echo $results['modelos_fabricar_max'];?>"/></td>
                  <?php } ?>
                  <?php if ($columna[4]==1) {?>
                  <td class="variable-objetivo"><input type="text" name="modelos_fabricar_obj" class="required" title="Valor inv&aacute;lido"  id="modelos_fabricar_obj" value="<?php echo $results['modelos_fabricar_obj'];?>"/></td>
                  <?php } ?>
                  <?php if ($columna[9]==1) {?>
                  <td class="variable-objetivo-small" ><?php echo $clasif[$results['modelos_fabricar_clas']];?></td>
                  <?php } ?>
                  
                  <?php if ($columna[5]==1) {?>
                  <td class="variable-objetivo-small" ><?php echo $prios[$results['modelos_fabricar_prio']];?></td>
                  <?php } ?>
                  <?php if ($columna[6]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $results['modelos_fabricar_min'];?></td>
                  <?php } ?>
                  <?php if ($columna[7]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $results['modelos_fabricar_max'];?></td>
                  <?php } ?>
                  <?php if ($columna[10]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $results['modelos_fabricar_obj'];?></td>
                  <?php }?>
                  
          <td class="variable-comment"><p>De 1 a 10</p></td>
                </tr>
                        <tr class="even">
                  <td class="variable-name">Regal&iacute;as que paga Alfa por fabricar con tecnolog&iacute;a de Beta</td>
                  <?php if ($columna[0]==1) {?>
                  <td class="variable-clasif"><select name="regalias_beta_prio" class="required" title="Elija una opci&oacute;n"  id="regalias_beta_clas">
                    <option value="">Elija...</option>
                    <option value="3" <?php if ($results['regalias_beta_prio'] ==3) {echo " selected='selected' ";}?>>Prioritaria</option>
                    <option value="2" <?php if ($results['regalias_beta_prio'] ==2) {echo " selected='selected' ";}?>>Secundaria</option>
                  </select></td>
                  <?php } ?>
                  <?php if ($columna[1]==1) {?>
                  <td class="variable-clasif"><select name="regalias_beta_clas" class="required" title="Elija una opci&oacute;n"  id="regalias_beta_clas">
                      <option value="">Elija...</option>
                      <option value="3" <?php if ($results['regalias_beta_clas'] ==3) {echo " selected='selected' ";}?>>Roja</option>
                      <option value="2" <?php if ($results['regalias_beta_clas'] ==2) {echo " selected='selected' ";}?>>Verde</option>
                      <option value="1" <?php if ($results['regalias_beta_clas'] ==1) {echo " selected='selected' ";}?>>Amarilla</option>
                    </select></td>
                  <?php } ?>
                  <?php if ($columna[2]==1) {?>
                  <td class="variable-objetivo"><input type="text" name="regalias_beta_min" class="required" title="Valor inv&aacute;lido"  id="regalias_beta_min" value="<?php echo $results['regalias_beta_min'];?>"/>
                            %</td>
                  <?php } ?>
                  <?php if ($columna[3]==1) {?>
                  <td class="variable-objetivo"><input type="text" name="regalias_beta_max" class="required" title="Valor inv&aacute;lido"  id="regalias_beta_max" value="<?php echo $results['regalias_beta_max'];?>"/>
                            %</td>
                  <?php } ?>
                  <?php if ($columna[4]==1) {?>
                  <td class="variable-objetivo"><input type="text" name="regalias_beta_obj" class="required" title="Valor inv&aacute;lido"  id="regalias_beta_obj" value="<?php echo $results['regalias_beta_obj'];?>"/>
                            %</td>
                  <?php } ?>
                  <?php if ($columna[9]==1) {?>
                  <td class="variable-objetivo-small" ><?php echo $clasif[$results['regalias_beta_clas']];?></td>
                  <?php } ?>
                  
                  <?php if ($columna[5]==1) {?>
                  <td class="variable-objetivo-small" ><?php echo $prios[$results['regalias_beta_prio']];?></td>
                  <?php } ?>
                  <?php if ($columna[6]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $results['regalias_beta_min'];?>%</td>
                  <?php } ?>
                  <?php if ($columna[7]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $results['regalias_beta_max'];?>%</td>
                  <?php } ?>               
                  <?php if ($columna[10]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $results['regalias_beta_obj'];?>%</td>
                  <?php }?>
                  <td class="variable-comment"><p>De 1% a    20%</p></td>
                </tr>
                        <tr class="odd">
                  <td class="variable-name">Que Alfa comparta    tecnolog&iacute;a de Visi&oacute;n Artificial&nbsp;</td>
                  <?php if ($columna[0]==1) {?>
                  <td class="variable-clasif"><select name="compartir_va_prio" class="required" title="Elija una opci&oacute;n"  id="compartir_va_clas">
                    <option value="">Elija...</option>
                    <option value="3" <?php if ($results['compartir_va_prio'] ==3) {echo " selected='selected' ";}?>>Prioritaria</option>
                    <option value="2" <?php if ($results['compartir_va_prio'] ==2) {echo " selected='selected' ";}?>>Secundaria</option>
                    <option value="1" <?php if ($results['compartir_va_prio'] ==1) {echo " selected='selected' ";}?>>Descartada</option>
                  </select></td>
                  <?php } ?>
                  <?php if ($columna[1]==1) {?>
                  <td class="variable-clasif"><select name="compartir_va_clas" class="required" title="Elija una opci&oacute;n"  id="compartir_va_clas">
                      <option value="">Elija...</option>
                      <option value="3" <?php if ($results['compartir_va_clas'] ==3) {echo " selected='selected' ";}?>>Roja</option>
                      <option value="2" <?php if ($results['compartir_va_clas'] ==2) {echo " selected='selected' ";}?>>Verde</option>
                      <option value="1" <?php if ($results['compartir_va_clas'] ==1) {echo " selected='selected' ";}?>>Amarilla</option>
                    </select></td>
                  <?php } ?>
                  <?php if ($columna[2]==1) {?>
                  <td class="variable-objetivo"><select name="compartir_va_min" class="required" title="Elija una opci&oacute;n"  id="compartir_va_min">
                      <option value="">Elija...</option>
                      <option value="1" <?php if ($results['compartir_va_min'] ==1) {echo " selected='selected' ";}?>>Si</option>
                      <option value="0" <?php if ($num_rows>0 && $results['compartir_va_min'] < 1) {echo " selected='selected' ";}?>>No</option>
                    </select></td>
                  <?php } ?>
                  <?php if ($columna[3]==1) {?>
                  <td class="variable-objetivo"><select name="compartir_va_max" class="required" title="Elija una opci&oacute;n"  id="compartir_va_max">
                      <option value="">Elija...</option>
                      <option value="1" <?php if ($results['compartir_va_max'] ==1) {echo " selected='selected' ";}?>>Si</option>
                      <option value="0" <?php if ($num_rows>0 && $results['compartir_va_max'] <1) {echo " selected='selected' ";}?>>No</option>
                    </select></td>
                  <?php } ?>
                  <?php if ($columna[4]==1) {?>
                  <td class="variable-objetivo"><select name="compartir_va_obj" class="required" title="Elija una opci&oacute;n"  id="compartir_va_obj">
                      <option value="">Elija...</option>
                      <option value="1" <?php if ($results['compartir_va_obj'] ==1) {echo " selected='selected' ";}?>>Si</option>
                      <option value="0" <?php if ($num_rows>0 && $results['compartir_va_obj'] <1 ) {echo " selected='selected' ";}?>>No</option>
                    </select></td>
                  <?php } ?>
                  <?php if ($columna[9]==1) {?>
                  <td class="variable-objetivo-small" ><?php echo $clasif[$results['compartir_va_clas']];?></td>
                  <?php } ?>
                  
                  <?php if ($columna[5]==1) {?>
                  <td class="variable-objetivo-small" ><?php echo $prios[$results['compartir_va_prio']];?></td>
                  <?php } ?>
                  <?php if ($columna[6]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $yesno[$results['compartir_va_min']];?></td>
                  <?php } ?>
                  <?php if ($columna[7]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $yesno[$results['compartir_va_max']];?></td>
                  <?php } ?>
                  <?php if ($columna[10]==1) {?>
                  <td class="variable-objetivo-small"><?php echo  $yesno[$results['compartir_va_obj']];?></td>
                  <?php }?>
                  
          <td class="variable-comment">&nbsp;</td>
                </tr>
                <tr class="even">
                  <td class="variable-name">Que Beta comparta know-how de fabricaci&oacute;n</td>
                  <?php if ($columna[0]==1) {?>
                  <td class="variable-clasif"><select name="compartir_kh_prio" class="required" title="Elija una opci&oacute;n"  id="compartir_kh_clas">
                    <option value="">Elija...</option>
                    <option value="3" <?php if ($results['compartir_kh_prio'] ==3) {echo " selected='selected' ";}?>>Prioritaria</option>
                    <option value="2" <?php if ($results['compartir_kh_prio'] ==2) {echo " selected='selected' ";}?>>Secundaria</option>
                    <option value="1" <?php if ($results['compartir_kh_prio'] ==1) {echo " selected='selected' ";}?>>Descartada</option>
                  </select></td>
                  <?php } ?>
                  <?php if ($columna[1]==1) { ?>
                  <td class="variable-clasif">
                  <select name="compartir_kh_clas" class="required" title="Elija una opci&oacute;n"  id="compartir_kh_clas">
                      <option value="">Elija...</option>
                      <option value="3" <?php if ($results['compartir_kh_clas'] ==3) {echo " selected='selected' ";}?>>Roja</option>
                      <option value="2" <?php if ($results['compartir_kh_clas'] ==2) {echo " selected='selected' ";}?>>Verde</option>
                      <option value="1" <?php if ($results['compartir_kh_clas'] ==1) {echo " selected='selected' ";}?>>Amarilla</option>
                    </select></td>
                  <?php } ?>
                  <?php if ($columna[2]==1) {?>
                  <td class="variable-objetivo"><select name="compartir_kh_min" class="required" title="Elija una opci&oacute;n"  id="compartir_kh_min">
                      <option value="">Elija...</option>
                      <option value="1" <?php if ($results['compartir_kh_min'] ==1) {echo " selected='selected' ";}?>>Si</option>
                      <option value="0" <?php if ($num_rows>0 && $results['compartir_kh_min'] <1) {echo " selected='selected' ";}?>>No</option>
                    </select></td>
                  <?php } ?>
                  <?php if ($columna[3]==1) {?>
                  <td class="variable-objetivo"><select name="compartir_kh_max" class="required" title="Elija una opci&oacute;n"  id="compartir_kh_max">
                      <option value="">Elija...</option>
                      <option value="1" <?php if ($results['compartir_kh_max'] ==1) {echo " selected='selected' ";}?>>Si</option>
                      <option value="0" <?php if ($num_rows>0 && $results['compartir_kh_max'] <1) {echo " selected='selected' ";}?>>No</option>
                    </select></td>
                  <?php } ?>
                  <?php if ($columna[4]==1) {?>
                  <td class="variable-objetivo"><select name="compartir_kh_obj" class="required" title="Elija una opci&oacute;n"  id="compartir_kh_obj">
                      <option value="">Elija...</option>
                      <option value="1" <?php if ($results['compartir_kh_obj'] ==1) {echo " selected='selected' ";}?>>Si</option>
                      <option value="0" <?php if ($num_rows>0 && $results['compartir_kh_obj'] <1) {echo " selected='selected' ";}?>>No</option>
                    </select></td>
                  <?php } ?>
                  <?php if ($columna[9]==1) {?>
                  <td class="variable-objetivo-small" ><?php echo $clasif[$results['compartir_kh_clas']];?></td>
                  <?php } ?>

                  <?php if ($columna[5]==1) {?>
                  <td class="variable-objetivo-small" ><?php echo $prios[$results['compartir_kh_prio']];?></td>
                  <?php } ?>
                  <?php if ($columna[6]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $yesno[$results['compartir_kh_min']];?></td>
                  <?php } ?>
                  <?php if ($columna[7]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $yesno[$results['compartir_kh_max']];?></td>
                  <?php } ?>
                  <?php if ($columna[10]==1) {?>
                  <td class="variable-objetivo-small"><?php echo  $yesno[$results['compartir_kh_obj']];?></td>
                  <?php }?>
          <td class="variable-comment">&nbsp;</td>
                </tr>
                        <tr class="odd">
                  <td class="variable-name">Que Alfa compre exclusivamente    a Beta</td>
                  <?php if ($columna[0]==1) {?>
                  <td class="variable-clasif"><select name="exclusividad_compra_prio" class="required" title="Elija una opci&oacute;n"  id="exclusividad_compra_clas">
                    <option value="">Elija...</option>
                    <option value="3" <?php if ($results['exclusividad_compra_prio'] ==3) {echo " selected='selected' ";}?>>Prioritaria</option>
                    <option value="2" <?php if ($results['exclusividad_compra_prio'] ==2) {echo " selected='selected' ";}?>>Secundaria</option>
                    <option value="1" <?php if ($results['exclusividad_compra_prio'] ==1) {echo " selected='selected' ";}?>>Descartada</option>
                  </select></td>
                  <?php } ?>
                  <?php if ($columna[1]==1) {?>
                  <td class="variable-clasif"><select name="exclusividad_compra_clas" class="required" title="Elija una opci&oacute;n"  id="exclusividad_compra_clas">
                      <option value="">Elija...</option>
                      <option value="3" <?php if ($results['exclusividad_compra_clas'] ==3) {echo " selected='selected' ";}?>>Roja</option>
                      <option value="2" <?php if ($results['exclusividad_compra_clas'] ==2) {echo " selected='selected' ";}?>>Verde</option>
                      <option value="1" <?php if ($results['exclusividad_compra_clas'] ==1) {echo " selected='selected' ";}?>>Amarilla</option>
                    </select></td>
                  <?php } ?>
                  <?php if ($columna[2]==1) {?>
                  <td class="variable-objetivo"><select name="exclusividad_compra_min" class="required" title="Elija una opci&oacute;n"  id="exclusividad_compra_min">
                      <option value="">Elija...</option>
                      <option value="1" <?php if ($results['exclusividad_compra_min'] ==1) {echo " selected='selected' ";}?>>Si</option>
                      <option value="0" <?php if ($num_rows>0 && $results['exclusividad_compra_min'] ==0) {echo " selected='selected' ";}?>>No</option>
                    </select></td>
                  <?php } ?>
                  <?php if ($columna[3]==1) {?>
                  <td class="variable-objetivo"><select name="exclusividad_compra_max" class="required" title="Elija una opci&oacute;n"  id="exclusividad_compra_max">
                      <option value="">Elija...</option>
                      <option value="1" <?php if ($results['exclusividad_compra_max'] ==1) {echo " selected='selected' ";}?>>Si</option>
                      <option value="0" <?php if ($num_rows>0 && $results['exclusividad_compra_max'] ==0) {echo " selected='selected' ";}?>>No</option>
                    </select></td>
                  <?php } ?>
                  <?php if ($columna[4]==1) {?>
                  <td class="variable-objetivo"><select name="exclusividad_compra_obj" class="required" title="Elija una opci&oacute;n"  id="exclusividad_compra_obj">
                      <option value="">Elija...</option>
                      <option value="1" <?php if ($results['exclusividad_compra_obj'] ==1) {echo " selected='selected' ";}?>>Si</option>
                      <option value="0" <?php if ($num_rows>0 && $results['exclusividad_compra_obj'] ==0) {echo " selected='selected' ";}?>>No</option>
                    </select></td>
                  <?php } ?>
                  <?php if ($columna[9]==1) {?>
                  <td class="variable-objetivo-small" ><?php echo $clasif[$results['exclusividad_compra_clas']];?></td>
                  <?php } ?>
                  
                  <?php if ($columna[5]==1) {?>
                  <td class="variable-objetivo-small" ><?php echo $prios[$results['exclusividad_compra_prio']];?></td>
                  <?php } ?>
                  <?php if ($columna[6]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $yesno[$results['exclusividad_compra_min']];?></td>
                  <?php } ?>
                  <?php if ($columna[7]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $yesno[$results['exclusividad_compra_max']];?></td>
                  <?php } ?>
                  <?php if ($columna[10]==1) {?>
                  <td class="variable-objetivo-small"><?php echo  $yesno[$results['exclusividad_compra_obj']];?></td>
                  <?php }?>

                  <td class="variable-comment">&nbsp;</td>
                </tr>
                        <tr class="even">
                  <td class="variable-name">Que Beta le venda    exclusivamente a Alfa en Pa&iacute;s Alfa</td>
                  <?php if ($columna[0]==1) {?>
                  <td class="variable-clasif"><select name="exclusividad_venta_prio" class="required" title="Elija una opci&oacute;n"  id="exclusividad_venta_clas">
                    <option value="">Elija...</option>
                    <option value="3" <?php if ($results['exclusividad_venta_prio'] ==3) {echo " selected='selected' ";}?>>Prioritaria</option>
                    <option value="2" <?php if ($results['exclusividad_venta_prio'] ==2) {echo " selected='selected' ";}?>>Secundaria</option>
                    <option value="1" <?php if ($results['exclusividad_venta_prio'] ==1) {echo " selected='selected' ";}?>>Descartada</option>
                  </select></td>
                  <?php } ?>                  
                  <?php if ($columna[1]==1) {?>
                  <td class="variable-clasif"><select name="exclusividad_venta_clas" class="required" title="Elija una opci&oacute;n"  id="exclusividad_venta_clas">
                      <option value="">Elija...</option>
                      <option value="3" <?php if ($results['exclusividad_venta_clas'] ==3) {echo " selected='selected' ";}?>>Roja</option>
                      <option value="2" <?php if ($results['exclusividad_venta_clas'] ==2) {echo " selected='selected' ";}?>>Verde</option>
                      <option value="1" <?php if ($results['exclusividad_venta_clas'] ==1) {echo " selected='selected' ";}?>>Amarilla</option>
                    </select></td>
                  <?php } ?>
                  <?php if ($columna[2]==1) {?>
                  <td class="variable-objetivo"><select name="exclusividad_venta_min" class="required" title="Elija una opci&oacute;n"  id="exclusividad_venta_min">
                      <option value="">Elija...</option>
                      <option value="1" <?php if ($results['exclusividad_venta_min'] ==1) {echo " selected='selected' ";}?>>Si</option>
                      <option value="0" <?php if ($num_rows>0 && $results['exclusividad_venta_min'] <1) {echo " selected='selected' ";}?>>No</option>
                    </select></td>
                  <?php } ?>
                  <?php if ($columna[3]==1) {?>
                  <td class="variable-objetivo"><select name="exclusividad_venta_max" class="required" title="Elija una opci&oacute;n"  id="exclusividad_venta_max">
                      <option value="">Elija...</option>
                      <option value="1" <?php if ($results['exclusividad_venta_max'] ==1) {echo " selected='selected' ";}?>>Si</option>
                      <option value="0" <?php if ($num_rows>0 && $results['exclusividad_venta_max'] <1) {echo " selected='selected' ";}?>>No</option>
                    </select></td>
                  <?php } ?>
                  <?php if ($columna[4]==1) {?>
                  <td class="variable-objetivo"><select name="exclusividad_venta_obj" class="required" title="Elija una opci&oacute;n"  id="exclusividad_venta_obj">
                      <option value="">Elija...</option>
                      <option value="1" <?php if ($results['exclusividad_venta_obj'] ==1) {echo " selected='selected' ";}?>>Si</option>
                      <option value="0" <?php if ( $num_rows>0 && $results['exclusividad_venta_obj'] <1) {echo " selected='selected' ";}?>>No</option>
                    </select></td>
                  <?php } ?>
                  <?php if ($columna[9]==1) {?>
                  <td class="variable-objetivo-small" ><?php echo $clasif[$results['exclusividad_venta_clas']];?></td>
                  <?php } ?>
                  
                  <?php if ($columna[5]==1) {?>
                  <td class="variable-objetivo-small" ><?php echo $prios[$results['exclusividad_venta_prio']];?></td>
                  <?php } ?>
                  <?php if ($columna[6]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $yesno[$results['exclusividad_venta_min']];?></td>
                  <?php } ?>
                  <?php if ($columna[7]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $yesno[$results['exclusividad_venta_max']];?></td>
                  <?php } ?>
                  <?php if ($columna[10]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $yesno[$results['exclusividad_venta_obj']];?></td>
                  <?php }?>
                  
                  <td class="variable-comment">&nbsp;</td>
                </tr>
                        <tr class="odd">
                  <td class="variable-name">Adelanto en efectivo de Beta a    Alfa por el contrato</td>
                  <?php if ($columna[0]==1) {?>
                  <td class="variable-clasif"><select name="adelanto_beta_alfa_prio" class="required" title="Elija una opci&oacute;n"  id="adelanto_beta_alfa_clas">
                    <option value="">Elija...</option>
                    <option value="3" <?php if ($results['adelanto_beta_alfa_prio'] ==3) {echo " selected='selected' ";}?>>Prioritaria</option>
                    <option value="2" <?php if ($results['adelanto_beta_alfa_prio'] ==2) {echo " selected='selected' ";}?>>Secundaria</option>
                    <option value="1" <?php if ($results['adelanto_beta_alfa_prio'] ==1) {echo " selected='selected' ";}?>>Descartada</option>
                  </select></td>
                  <?php } ?>
                  <?php if ($columna[1]==1) {?>
                  <td class="variable-clasif"><select name="adelanto_beta_alfa_clas" class="required" title="Elija una opci&oacute;n"  id="adelanto_beta_alfa_clas">
                      <option value="">Elija...</option>
                      <option value="3" <?php if ($results['adelanto_beta_alfa_clas'] ==3) {echo " selected='selected' ";}?>>Roja</option>
                      <option value="2" <?php if ($results['adelanto_beta_alfa_clas'] ==2) {echo " selected='selected' ";}?>>Verde</option>
                      <option value="1" <?php if ($results['adelanto_beta_alfa_clas'] ==1) {echo " selected='selected' ";}?>>Amarilla</option>
                    </select></td>
                  <?php } ?>
                  <?php if ($columna[2]==1) {?>
                  <td class="variable-objetivo"><input type="text" name="adelanto_beta_alfa_min" class="required" title="Valor inv&aacute;lido"  id="adelanto_beta_alfa_min" value="<?php echo $results['adelanto_beta_alfa_min'];?>"/>
                            millones U$S</td>
                  <?php } ?>
                  <?php if ($columna[3]==1) {?>
                  <td class="variable-objetivo"><input type="text" name="adelanto_beta_alfa_max" class="required" title="Valor inv&aacute;lido"  id="adelanto_beta_alfa_max" value="<?php echo $results['adelanto_beta_alfa_max'];?>"/>
                            millones U$S</td>
                  <?php } ?>
                  <?php if ($columna[4]==1) {?>
                  <td class="variable-objetivo"><input type="text" name="adelanto_beta_alfa_obj" class="required" title="Valor inv&aacute;lido"  id="adelanto_beta_alfa_obj" value="<?php echo $results['adelanto_beta_alfa_obj'];?>"/>
                            millones U$S</td>
                  <?php } ?>
                  <?php if ($columna[9]==1) {?>
                  <td class="variable-objetivo-small" ><?php echo $clasif[$results['adelanto_beta_alfa_clas']];?></td>
                  <?php } ?>
                  
                  <?php if ($columna[5]==1) {?>
                  <td class="variable-objetivo-small" ><?php echo $prios[$results['adelanto_beta_alfa_prio']];?></td>
                  <?php } ?>
                  <?php if ($columna[6]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $results['adelanto_beta_alfa_min'];?> millones U$S</td>
                  <?php } ?>
                  <?php if ($columna[7]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $results['adelanto_beta_alfa_max'];?> millones U$S</td>
                  <?php } ?>
                  <?php if ($columna[10]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $results['adelanto_beta_alfa_obj'];?> millones U$S</td>
                  <?php }?>
                            
                  <td class="variable-comment">&nbsp;</td>
                </tr>
                        <tr class="even">
                  <td class="variable-name">Adelanto en efectivo de Alfa a    Beta por el contrato</td>
                  <?php if ($columna[0]==1) {?>
                  <td class="variable-clasif"><select name="adelanto_alfa_beta_prio" class="required" title="Elija una opci&oacute;n"  id="adelanto_alfa_beta_clas">
                    <option value="">Elija...</option>
                    <option value="3" <?php if ($results['adelanto_alfa_beta_prio'] ==3) {echo " selected='selected' ";}?>>Prioritaria</option>
                    <option value="2" <?php if ($results['adelanto_alfa_beta_prio'] ==2) {echo " selected='selected' ";}?>>Secundaria</option>
                    <option value="1" <?php if ($results['adelanto_alfa_beta_prio'] ==1) {echo " selected='selected' ";}?>>Descartada</option>
                  </select></td>
                  <?php } ?>
                  <?php if ($columna[1]==1) {?>
                  <td class="variable-clasif"><select name="adelanto_alfa_beta_clas" class="required" title="Elija una opci&oacute;n"  id="adelanto_alfa_beta_clas">
                      <option value="">Elija...</option>
                      <option value="3" <?php if ($results['adelanto_alfa_beta_clas'] ==3) {echo " selected='selected' ";}?>>Roja</option>
                      <option value="2" <?php if ($results['adelanto_alfa_beta_clas'] ==2) {echo " selected='selected' ";}?>>Verde</option>
                      <option value="1" <?php if ($results['adelanto_alfa_beta_clas'] ==1) {echo " selected='selected' ";}?>>Amarilla</option>
                    </select></td>
                  <?php } ?>
                  <?php if ($columna[2]==1) {?>
                  <td class="variable-objetivo"><input type="text" name="adelanto_alfa_beta_min" class="required" title="Valor inv&aacute;lido"  id="adelanto_alfa_beta_min" value="<?php echo $results['adelanto_alfa_beta_min'];?>"/>
                            millones U$S</td>
                  <?php } ?>
                  <?php if ($columna[3]==1) {?>
                  <td class="variable-objetivo"><input type="text" name="adelanto_alfa_beta_max" class="required" title="Valor inv&aacute;lido"  id="adelanto_alfa_beta_max" value="<?php echo $results['adelanto_alfa_beta_max'];?>"/>
                            millones U$S</td>
                  <?php } ?>
                  <?php if ($columna[4]==1) {?>
                  <td class="variable-objetivo"><input type="text" name="adelanto_alfa_beta_obj" class="required" title="Valor inv&aacute;lido"  id="adelanto_alfa_beta_obj" value="<?php echo $results['adelanto_alfa_beta_obj'];?>"/>
                  millones U$S</td>
                  <?php } ?>
                  <?php if ($columna[9]==1) {?>
                  <td class="variable-objetivo-small" ><?php echo $clasif[$results['adelanto_alfa_beta_clas']];?></td>
                  <?php } ?>
                  
                  <?php if ($columna[5]==1) {?>
                  <td class="variable-objetivo-small" ><?php echo $prios[$results['adelanto_alfa_beta_prio']];?></td>
                  <?php } ?>
                  <?php if ($columna[6]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $results['adelanto_alfa_beta_min'];?> millones U$S</td>
                  <?php } ?>
                  <?php if ($columna[7]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $results['adelanto_alfa_beta_max'];?>  millones U$S</td>
                  <?php } ?>
                  <?php if ($columna[10]==1) {?>
                  <td class="variable-objetivo-small"><?php echo $results['adelanto_alfa_beta_obj'];?> millones U$S</td>
                  <?php }?>
                  
          <td class="variable-comment">&nbsp;</td>
                </tr>                      </table>