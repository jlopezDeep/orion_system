<link rel="stylesheet" type="text/css" href="<?php echo base_url('application/modules/ordermanage/assets/css/onoing_ajax.css'); ?>">
<div class="col-md-12">
  <div class="row mb-2">
    <!--<div class="col-sm-3">
      <select id="ongoingtable_name" class="form-control dont-select-me  search-table-field" dir="ltr" name="s">
      </select>
    </div>
    <div class="col-sm-3">
      <select id="ongoingtable_sr" class="form-control dont-select-me  search-tablesr-field" dir="ltr" name="ts">
      </select>
    </div>-->
    <!-- <div class="col-sm-1">
      <button class="btn btn-success pull-right" style="width: 100%;" onclick="mergeorderlist()"><?php echo "Fusionar"; ?></button>
    </div> -->
    <div class="col-sm-1">
      <button class="btn btn-success pull-right" style="width: 100%;font-weight: bold;" onclick="freeTables()"><?php echo "LIBERAR"; ?></button>
    </div>
    <div class="col-sm-1">
      <button class="btn btn-success pull-right" style="width: 100%;font-weight: bold;" onclick="filterOrdersType(0)"><?php echo "TODAS"; ?></button>
    </div>
    <div class="col-sm-1">
      <button class="btn btn-warning pull-right" style="width: 100%;font-weight: bold;" onclick="filterOrdersType(2)"><?php echo "LIBRES"; ?></button>
    </div>
    <div class="col-sm-1">
      <button class="btn btn-info pull-right" style="width: 100%;font-weight: bold;" onclick="filterOrdersType(1)"><?php echo "MESA"; ?></button>
    </div>
    <div class="col-sm-1">
      <button class="btn btn-error pull-right" style="width: 100%;background-color: #E3527A;color:white;font-weight: bold;" onclick="filterOrdersType(3)"><?php echo "VIEJAS"; ?></button>
    </div>
    <div class="col-sm-1">
      <button class="btn btn-error pull-right" style="width: 100%;background-color: green;color:white;font-weight: bold;" onclick="filterOrdersType(5)"><?php echo "HOY"; ?></button>
    </div>
    <div class="col-sm-1">
      <button class="btn btn-error pull-right" style="width: 100%;background-color: #955b88;color:white;font-weight: bold;" onclick="filterOrdersType(4)"><?php echo "MIAS"; ?></button>
    </div>
  </div>
  <div class="row mb-12">
    <div class="col-sm-9">
      <input name="search_text" type="text" class="form-control" id="search_text" placeholder="BUSCAR ORDEN/MESA/CLIENTE/COMENTARIO" />
    </div>
    <div class="col-sm-3">
      <input type="button" class="btn btn-success pull-left" style="font-weight: bold;margin-right: 10px;" value="BUSCAR" onclick="filterOrdersSearch($('#search_text').val())" />
      <input type="button" class="btn btn-info pull-left" style="font-weight: bold;" value="LIMPIAR" onclick="filterOrdersSearch(0);" />
    </div>
  </div>
  <hr />
  <?php
  if ($_SESSION['search_orders'] == 0) {
    if ($_SESSION['view_ongoingorder'] == 0) {
      echo "<b>TODAS LAS ORDENES<b>";
    }
    if ($_SESSION['view_ongoingorder'] == 1) {
      echo "<b>ORDENES DE MESAS</b>";
    }
    if ($_SESSION['view_ongoingorder'] == 2) {
      echo "<b>ORDENES LIBRES</b>";
    }
    if ($_SESSION['view_ongoingorder'] == 3) {
      echo "<b>ORDENES DE JORNADAS ANTERIORES</b>";
    }
    if ($_SESSION['view_ongoingorder'] == 4) {
      echo "<b>ORDENES ABIERTAS POR MI USUARIO</b>";
    }
    if ($_SESSION['view_ongoingorder'] == 5) {
      echo "<b>ORDENES ABIERTAS HOY</b>";
    }
  } else {
    echo "<b>BUSQUEDA: " . $_SESSION['search_orders']."</b>";
  }
  ?>
  <hr />
  <div class="row">
    <?php

    if (!empty($ongoingorder)) {
      foreach ($ongoingorder as $onprocess) {
        $billtotal = round($onprocess->totalamount - $onprocess->customerpaid);

    ?>
        <?php
        $color_mark = "#F8EDC9";
        $value_mark = 1;
        if ($onprocess->is_mark == 1) {
          $color_mark = "#DCF3DE";
          $value_mark = 0;
        }
        ?>
        <div class="col-sm-4 col-md-3 col-xs-6 col-xlg-2">
          <?php if (!empty($onprocess->marge_order_id)) { ?>
            <div class="hero-widget well well-sm height-abg">
              <div class="mdjc">
                <label class="text-muted"><strong><?php echo display('table'); ?>:<?php echo $onprocess->tablename; ?></strong></label>
                <?php if ($this->permission->method('ordermanage', 'update')->access() && $onprocess->splitpay_status == 0) : ?>
                  <div class="display-flex align-items-center">
                    <?php $margeinfo = $this->db->select('order_id')->from('customer_order')->where('marge_order_id', $onprocess->marge_order_id)->get()->result();
                    $allmergeid = "";
                    foreach ($margeinfo as $mergeord) {
                      $allmergeid .= $mergeord->order_id . ',';
                    }
                    $allorder = trim($allmergeid, ',');
                    ?>
                    <input name="margeid" id="allmerge_<?php echo $onprocess->marge_order_id; ?>" type="hidden" value="<?php echo $allorder ?>" />
                  </div>
                <?php endif; ?>
              </div>
              <p class="m-0">
                <label class="text-muted"><?php echo display('ord_num'); ?>:<?php echo $allorder; ?></label>
              </p>
              <p class="m-0">
                <label class="text-muted"><?php echo display('waiter'); ?>:<?php echo $onprocess->firstname; ?></label>
              </p>
              <p class="m-0">
                <label class="text-muted" style="font-size:10px;"><?php echo "CLIENTE"; ?>:<?php echo $onprocess->customer_name ?></label>
              </p>
              <p class="m-0">
                <label class="text-muted" style="font-size:10px;"><?php echo "FECHA"; ?>:<?php echo $onprocess->order_date ?></label>
              </p>

              <p class="m-0">
                <label class="text-muted" style="font-size:10px;"><?php echo "HORA"; ?>:<?php echo $onprocess->order_time ?></label>
              </p>


              <?php
              $diff = 0;
              $actualtime = date('H:i:s');
              $array1 = explode(':', $actualtime);
              $array2 = explode(':', $onprocess->order_time);
              $minutes1 = ($array1[0] * 3600.0 + $array1[1] * 60.0 + $array1[2]);
              $minutes2 = ($array2[0] * 3600.0 + $array2[1] * 60.0 + $array2[2]);
              $diff = $minutes1 - $minutes2;
              $format = sprintf('%02d:%02d:%02d', ($diff / 3600), ($diff / 60 % 60), $diff % 60);
              ?>
              <p class="m-0">
                <label class="text-muted"><?php echo display('before_time'); ?>:<?php echo  $format; ?></label>
              </p>
              <hr />
              <div>
                <a href="javascript:;" onclick="duemergeorder(<?php echo $onprocess->order_id; ?>,'<?php echo $onprocess->marge_order_id; ?>')" class="btn btn-xs btn-success btn-sm mr-1"><?php echo display('cmplt'); ?></a>

                <?php if ($this->permission->method('ordermanage', 'delete')->access()) { ?>
                  <a href="javascript:;" data-id="<?php echo $onprocess->order_id; ?>" class="btn btn-xs btn-danger btn-sm mr-1 cancelorder" data-toggle="tooltip" data-placement="left" title="" data-original-title="Cancel Order"><i class="fa fa-trash-o"></i></a>&nbsp;
                <?php } ?>
                <a href="javascript:;" onclick="printmergeinvoice('<?php echo base64_encode($onprocess->marge_order_id); ?>')" class="btn btn-xs btn-success btn-sm mr-1" data-toggle="tooltip" data-placement="left" title="" data-original-title="Pos Invoice"><i class="fa fa-window-maximize"></i></a>&nbsp;<a href="javascript:;" class="btn btn-xs btn-success btn-sm mr-1 due_mergeprint" data-toggle="tooltip" data-placement="left" title="" data-url="<?php echo base_url("ordermanage/order/checkprintdue/" . $onprocess->marge_order_id) ?>" data-original-title="Due Invoice"><i class="fa fa-window-restore"></i></a>
              </div>

            </div>
          <?php } else { ?>
            <div class="hero-widget well well-sm height-auto">
              <div class="mdjc">
                <?php
                $table_name = "";
                $color = "green";
                if ($onprocess->tablename != "") {
                  $table_name = $onprocess->tablename;
                } else {
                  $table_name = "LIBRE";
                  $color = "orange";
                }
                ?>
                <label onclick="editposorder(<?php echo $onprocess->order_id; ?>,1,<?php echo  $onprocess->user_view; ?>)" class="text-muted" style="width:100%;cursor:pointer;background-color: <?php echo $color; ?>;color: white;color: white !important;padding:10px;font-size: 18px;border-radius:5px;"><strong><?php echo $table_name; ?></strong></label>
                <?php if ($this->permission->method('ordermanage', 'update')->access() && $onprocess->splitpay_status == 0) : ?>
                  <div class="display-flex align-items-center">
                    <!--<div class=""><a href="javascript:;" onclick="editposorder(<?php echo $onprocess->order_id; ?>,1)" class="btn btn-xs btn-success btn-sm mr-1 pdmr" data-toggle="tooltip" data-placement="left" title="" data-original-title="Update Order" id="table-<?php echo $onprocess->order_id; ?>"><i class="fa fa-pencil"></i></a></div>
                                          -->
                    <!--<div class="kitchen-tab bd-pd-overflow">
                      <input id='chkbox-<?php echo $onprocess->order_id; ?>' type='checkbox' class="individual" name="margeorder" value="<?php echo $onprocess->order_id; ?>" />
                      <label for='chkbox-<?php echo $onprocess->order_id; ?>' class="mb-0">
                        <span class="radio-shape mr-0"> <i class="fa fa-check"></i> </span> </label>
                    </div>-->
                  </div>
                <?php endif; ?>
              </div>
              <p class="m-0">
                <label onclick="checkordertransfer(<?php echo $onprocess->order_id; ?>)" class="text-muted" style="cursor:pointer;background:blue;color: white !important; border-radius: 10px;padding:10px;font-size:20px;"><?php echo $onprocess->saleinvoice; ?></label>
              </p>
              <div onclick="mark_order(<?php echo $onprocess->order_id; ?>, <?php echo $value_mark; ?>)" style="overflow-y:scroll;max-height:80px;height:80px;cursor:pointer;margin-bottom:5px;padding:5px;border:solid 1px #D0D2D3;font-size:14px;border-radius:5px;background-color: <?php echo $color_mark; ?>;">
                <p class="m-0">
                  <label class="text-muted"><?php echo ""; ?><?php echo $onprocess->firstname; ?></label>
                </p>
                <p class="m-0">
                  <label class="text-muted"><?php echo ""; ?><?php echo $onprocess->customer_name ?></label>
                </p>
                <p class="m-0">
                  <label class="text-muted"><?php echo ""; ?><?php echo $onprocess->comentario ?></label>
                </p>
              </div>
              <?php
              $order_old = "#FFF";
              $order_old_text = "#9A9AAC";
              if ($onprocess->journal_id != $_SESSION['journal']) {
                $order_old = "#E3527A";
                $order_old_text = "#FFF";
              }
              ?>
              <div style="cursor:pointer;margin-bottom:5px;padding:5px;border:solid 1px #D0D2D3;font-size:14px;border-radius:5px;background-color: <?php echo $order_old; ?>;color:<?php echo $order_old_text; ?>;">
                <p class="m-0">
                  <label class="text-muted" style="font-size:14px;color: <?php echo $order_old_text; ?> !important;"><?php echo "FECHA"; ?>:<?php echo $onprocess->order_date ?></label>
                </p>

                <p class="m-0">
                  <label class="text-muted" style="font-size:14px;color:<?php echo $order_old_text; ?> !important;"><?php echo "HORA"; ?>:<?php echo $onprocess->order_time ?></label>
                </p>
              </div>

              <?php if ($onprocess->nosendproducts == 0) { ?>
                <p class="m-0">
                  <label class="text-muted" style="color: green !important;font-size:18px;margin-top:5px;"><?php echo round($onprocess->totalamount, 2); ?></label>
                </p>
              <?php } else { ?>
                <p class="m-0">
                  <label class="text-muted" style="color: red !important;font-size:18px;margin-top:5px;">ENVIE</label>
                </p>
              <?php } ?>
              <?php
              $diff = 0;

              $actualtime = date('H:i:s');

              $array1 = explode(':', $actualtime);
              $array2 = explode(':', $onprocess->order_time);
              $minutes1 = ($array1[0] * 3600.0 + $array1[1] * 60.0 + $array1[2]);
              $minutes2 = ($array2[0] * 3600.0 + $array2[1] * 60.0 + $array2[2]);
              $diff = $minutes1 - $minutes2;
              $format = sprintf('%02d:%02d:%02d', ($diff / 3600), ($diff / 60 % 60), $diff % 60);
              ?>
              <p class="m-0">
                <!--<label class="text-muted"><?php echo display('before_time'); ?>:<?php echo  $format; ?></label>
                                          -->
              </p>

              <div>
                <?php if ($onprocess->splitpay_status == 0) { ?>

                  <?php if ($onprocess->nosendproducts == 0) { ?>
                    <a href="javascript:;" style="width: 100%;height: 40px;padding-top:10px;font-weight: bold;background-color:brown;" class="btn btn-xs btn-success btn-sm mr-1 due_print" data-toggle="tooltip" data-placement="left" title="" data-url="<?php echo base_url("ordermanage/order/dueinvoice/" . $onprocess->order_id) ?>" data-original-title="Imprime la cuenta de esta orden">CUENTA</a>
                    <?php if ($station_info->is_billing_station == 1) { ?>
                      <a href="javascript:;" style="width: 100%;height: 40px;padding-top:10px;font-weight: bold;" onclick="createMargeorder(<?php echo $onprocess->order_id; ?>,1)" class="btn btn-xs btn-success btn-sm mr-1">FACTURAR</a>
                    <?php } ?>
                    <!--<a href="javascript:;" style="width: 100%;height: 40px;padding-top:10px;font-weight: bold;background-color:blue;" onclick="showsplitmodal(<?php echo $onprocess->order_id; ?>)" class="btn btn-xs btn-success btn-sm mr-1">DIVIDIR</a>-->
                    <a href="javascript:;" style="width: 100%;height: 40px;padding-top:10px;font-weight: bold;background-color:orange;" onclick="table_transfer(<?php echo $onprocess->order_id; ?>, 0, <?php echo $onprocess->table_no; ?>)" class="btn btn-xs btn-success btn-sm mr-1">TRANSFERIR</a>

                    <?php if ($this->permission->method('ordermanage', 'delete')->access()) { ?>
                      <a href="javascript:;" style="width: 100%;height: 40px;padding-top:10px;" data-id="<?php echo $onprocess->order_id; ?>" class="btn btn-xs btn-danger btn-sm mr-1 cancelorder" data-toggle="tooltip" data-placement="left" title="" data-original-title="Cancelar Orden">ELIMINAR</i></a>&nbsp;
                    <?php } ?>
                    <!--<a href="javascript:;" onclick="createMargeorder(<?php echo $onprocess->order_id; ?>,1)" class="btn btn-xs btn-success btn-sm mr-1" data-toggle="tooltip" data-placement="left" title="" data-original-title="Pos Invoice"></a>-->
                  <?php } else { ?>
                    <a href="javascript:;" disabled="true" style="width: 100%;height: 40px;padding-top:10px;font-weight: bold;background-color:brown;" class="btn btn-xs btn-success btn-sm mr-1 due_print" data-toggle="tooltip" data-placement="left" title="" data-original-title="Imprime la cuenta de esta orden">CUENTA</a>
                    <?php if ($station_info->is_billing_station == 1) { ?>
                      <a href="javascript:;" disabled="true" style="width: 100%;height: 40px;padding-top:10px;font-weight: bold;" onclick="" class="btn btn-xs btn-success btn-sm mr-1">FACTURAR</a>
                    <?php } ?>
                    <!--<a href="javascript:;" disabled="true" style="width: 100%;height: 40px;padding-top:10px;font-weight: bold;background-color:blue;" onclick="" class="btn btn-xs btn-success btn-sm mr-1">DIVIDIR</a>-->
                    <a href="javascript:;" disabled="true" style="width: 100%;height: 40px;padding-top:10px;font-weight: bold;background-color:orange;" onclick="" class="btn btn-xs btn-success btn-sm mr-1">TRANSFERIR</a>

                    <?php if ($this->permission->method('ordermanage', 'delete')->access()) { ?>
                      <a href="javascript:;" style="width: 100%;height: 40px;padding-top:10px;" data-id="<?php echo $onprocess->order_id; ?>" class="btn btn-xs btn-danger btn-sm mr-1 cancelorder" data-toggle="tooltip" data-placement="left" title="" data-original-title="Cancelar Orden">ELIMINAR</i></a>&nbsp;
                    <?php } ?>
                  <?php } ?>
                <?php } else { ?>
                  <a href="javascript:;" onclick="showsplitmodal(<?php echo $onprocess->order_id; ?>)" class="btn btn-xs btn-success btn-sm mr-1"><?php echo display('split'); ?></a>

                <?php
                } ?>


              </div>

            </div>
          <?php } ?>
        </div>
    <?php }
    } else {
      $odmsg = display('no_order_run');
      echo "<p class='pl-12'>" . $odmsg . "</p>";
    }
    ?>
  </div>
</div>
<script src="<?php echo base_url('application/modules/ordermanage/assets/js/ongoing.js'); ?>" type="text/javascript"></script>