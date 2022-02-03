
<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">
                    <fieldset class="border p-2">
                       <legend  class="w-auto"><?php echo $title; ?></legend>
                    </fieldset>
					<div class="row bg-brown">
                             <div class="col-sm-12 kitchen-tab" id="option">
                             					<p  class="productionset_rightg">
                     <strong class="productionset_color">NOTA***:</strong>Un restaurante debe tener una receta fija para una comida en particular para facilitar su trabajo. Esta aplicación tiene un sistema de producción automática que describe así:
Si tiene una cantidad suficiente de ingredientes en el stock de su restaurante, se actualizará automáticamente la cantidad de producción para cada venta. Permítame explicarle cómo: Suponga que establece una receta para arroz frito y pollo a la barbacoa en su sistema una vez en el módulo Administración de recetas> Agregar producción con los ingredientes, la unidad de porción, la variante y el precio. Ahora tienes un pedido de 3 arroces fritos y 2 pollo a la barbacoa. No es necesario realizar esta producción una y otra vez. Simplemente seleccione la comida y haga el pedido desde el TPV. El sistema preparará el plato y actualizará automáticamente la cantidad en stock y fuera de stock en el INFORME (en cuanto a producción) y los ingredientes se reducirán del INFORME (en cuanto a cocina). 
                 </p>
                                                <input id="chkbox-1760" type="checkbox" class="individual" name="productionsetting" value="productionsetting" <?php if($possetting->productionsetting==1){ echo "checked";}?>>
                                                <label for="chkbox-1760" class="productionsets_color">
                                                    <span class="radio-shape">
                                                        <i class="fa fa-check"></i>
                                                    </span>
                                                   <?php echo display('select_auto') ?>
                                                </label>
                                               
                            </div>
                        </div>
                </div> 
            </div>
        </div>
    </div>

<script src="<?php echo base_url('application/modules/production/assets/js/production.js'); ?>" type="text/javascript"></script>
