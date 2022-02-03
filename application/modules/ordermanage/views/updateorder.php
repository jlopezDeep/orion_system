<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('application/modules/ordermanage/assets/css/posordernew.css'); ?>">
<div id="edit" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong></strong>
            </div>
            <div class="modal-body addonsinfo">

            </div>

        </div>
        <div class="modal-footer">
        </div>
    </div>
</div>
<div id="items" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong><?php echo "Item Information"; ?></strong>
            </div>
            <div class="modal-body iteminfo">

            </div>

        </div>
        <div class="modal-footer">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel">
            <!--<fieldset class="border p-2">
                <legend  class="w-auto"><?php //echo "Update Order" 
                                        ?></legend>
            </fieldset>-->
            <input name="url" type="hidden" id="posurl_update" value="<?php echo base_url("ordermanage/order/getitemlist") ?>" />
            <input name="url" type="hidden" id="productdata" value="<?php echo base_url("ordermanage/order/getitemdata") ?>" />
            <input name="url" type="hidden" id="updatecarturl" value="<?php echo base_url("ordermanage/order/addtocartupdate") ?>" />
            <input name="url" type="hidden" id="cartupdateturl" value="<?php echo base_url("ordermanage/order/poscartupdate") ?>" />
            <input name="url" type="hidden" id="addonexsurl" value="<?php echo base_url("ordermanage/order/posaddonsmenu") ?>" />
            <input name="url" type="hidden" id="removeurl" value="<?php echo base_url("ordermanage/order/removetocart") ?>" />
            <div class="row">
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-12">
                            <form class="navbar-search" method="get" action="<?php echo base_url("ordermanage/order/pos_invoice") ?>">
                                <label class="sr-only screen-reader-text" for="search"><?php echo display('search') ?>:</label>
                                <div class="input-group">
                                    <select id="update_product_name" class="form-control dont-select-me  update_search-field" dir="ltr" name="s">
                                    </select>


                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="product-category">
                                <div class="listcat" onclick="getslcategory_update('', 'TODOS', '')">TODOS</div>
                                <?php //$result = array_diff($categorylist, array("Select Food Category"));
                                foreach ($allcategorylist as $category) {
                                    if (!empty($category->sub)) {
                                ?>
                                        <div class="listcat dropdown cat-nav">
                                            <button class="btn dropdown-toggle listcat listcat2" style="background-color: <?php echo $category->color; ?>" type="button" data-toggle="dropdown">
                                                <?php echo $category->Name; ?>
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu dropcat">
                                                <?php foreach ($category->sub as $subcat) { ?>
                                                    <li><a onclick="getslcategory_update(<?php echo $subcat->CategoryID; ?>, '<?php echo $subcat->Name; ?>', '<?php echo $category->color; ?>')"><?php echo $subcat->Name; ?></a></li>
                                                <?php } ?>
                                            </ul>


                                        </div>
                                    <?php } else { ?>

                                        <div style="background-color: <?php echo $category->color; ?>" class="listcat dropdown cat-nav" onclick="getslcategory_update(<?php echo $category->CategoryID; ?>, '<?php echo $category->Name; ?>', '<?php echo $category->color; ?>')"><?php echo $category->Name; ?></div>
                                <?php  }
                                } ?>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <script>
                                //$('#product-grid').bind('touchmove', function(e){e.preventDefault()});
                                function move_up_update() {
                                    $('#product-grid').removeClass('stop-scrolling');
                                    document.getElementById('product-grid-update').scrollTop += 40;
                                    $('#product-grid').addClass('stop-scrolling');
                                }

                                function move_down_update() {
                                    $('#product-grid').removeClass('stop-scrolling');
                                    document.getElementById('product-grid-update').scrollTop -= 40;
                                    $('#product-grid').addClass('stop-scrolling');
                                }
                            </script>
                            <div style="padding:10px;font-weight: bold;float:initial;" id="category_active_update">
                                TODOS
                            </div>
                            <div style="height:100%">
                                <div class="product-grid stop-scrolling" id="product-grid-update">
                                    <div class="row row-m-3" id="product_search_update">
                                        <?php $i = 0;
                                        foreach ($itemlist as $item) {
                                            $item = (object)$item;
                                            $i++;
                                            if ($item->isgroup == 1) {
                                                $isgroupid = 1;
                                            } else {
                                                $isgroupid = 0;
                                            }
                                            $this->db->select('*');
                                            $this->db->from('menu_add_on');
                                            $this->db->where('menu_id', $item->ProductsID);
                                            $query = $this->db->get();
                                            $getadons = "";
                                            if ($query->num_rows() > 0) {
                                                $getadons = 1;
                                            } else {
                                                $getadons =  0;
                                            }
                                        ?>
                                            <div class="col-xs-6 col-sm-4 col-md-4 col-lg-3 col-p-3">
                                                <div class="panel panel-bd product-panel update_select_product">
                                                    <div class="panel-body">
                                                        <img src="<?php echo base_url(!empty($item->ProductImage) ? $item->ProductImage : 'assets/img/icons/default.jpg'); ?>" class="img-responsive" alt="<?php echo $item->ProductName; ?>">
                                                        <input type="hidden" name="update_select_product_id" class="select_product_id" value="<?php echo $item->ProductsID; ?>">
                                                        <input type="hidden" name="update_select_totalvarient" class="select_totalvarient" value="<?php echo $item->totalvarient; ?>">
                                                        <input type="hidden" name="update_select_iscustomeqty" class="select_iscustomeqty" value="<?php echo $item->is_customqty; ?>">
                                                        <input type="hidden" name="update_select_product_size" class="select_product_size" value="<?php echo $item->variantid; ?>">
                                                        <input type="hidden" name="update_select_product_isgroup" class="select_product_isgroup" value="<?php echo $isgroupid; ?>">
                                                        <input type="hidden" name="update_select_product_cat" class="select_product_cat" value="<?php echo $item->CategoryID; ?>">
                                                        <input type="hidden" name="update_select_varient_name" class="select_varient_name" value="<?php echo $item->variantName; ?>">
                                                        <input type="hidden" name="update_select_product_name" class="select_product_name" value="<?php echo $item->ProductName;
                                                                                                                                                    if (!empty($item->itemnotes)) {
                                                                                                                                                        echo " -" . $item->itemnotes;
                                                                                                                                                    } ?>">
                                                        <input type="hidden" name="update_select_product_price" class="select_product_price" value="<?php echo $item->price; ?>">
                                                        <input type="hidden" name="update_select_addons" class="select_addons" value="<?php echo $getadons; ?>">
                                                    </div>
                                                    <?php
                                                    $color_text = "green";
                                                    if ($item->color != '') {
                                                        $color_text = "white";
                                                    }
                                                    ?>
                                                    <div class="panel-footer" style="background-color: <?php echo $item->color; ?>;">
                                                        <span style="color: <?php echo $color_text; ?>"><?php echo $item->ProductName; ?> (<?php echo $item->variantName; ?>)<?php if (!empty($item->itemnotes)) {
                                                                                                                                                                                    echo " -" . $item->itemnotes;
                                                                                                                                                                                } ?></span>


                                                        <div style="font-weight:bold;color:<?php echo $color_text; ?>;"><?php if ($currency->position == 1) {
                                                                                                                            echo $currency->curr_icon;
                                                                                                                        } ?><?php echo $item->price; ?>
                                                            <?php if ($currency->position == 2) {
                                                                echo $currency->curr_icon;
                                                            } ?>

                                                            <?php echo "<br/>"; ?>
                                                            <?php if ($currency->position == 1) {
                                                                echo $currency->curr_icon;
                                                            } ?>
                                                            <?php echo round($item->price + ($item->price * ($item->productvat / 100)), 2); ?>
                                                            <?php if ($currency->position == 2) {
                                                                echo $currency->curr_icon;
                                                            } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div style="margin-top:5px;">
                                <button onclick="move_up_update();" style="padding:10px;font-weight: bold;margin-right: 5px;float:right;" class="btn dropdown-toggle listcat listcat2" type="button" data-toggle="dropdown">
                                    ABAJO
                                </button>
                                <button onclick="move_down_update();" style="padding:10px;font-weight: bold;margin-right: 5px;float:right;" class="btn dropdown-toggle listcat listcat2" type="button" data-toggle="dropdown">
                                    ARRIBA
                                </button>
                            </div>

                        </div>

                    </div>
                </div>
                <?php echo form_open_multipart('ordermanage/order/modifyoreder', array('class' => 'form-vertical', 'id' => 'insert_purchase', 'name' => 'insert_purchase')) ?>
                <div class="col-md-5">
                    <input name="url" type="hidden" id="url" value="<?php echo base_url("ordermanage/order/itemlistselect") ?>" />
                    <input name="url" type="hidden" id="addonsurl" value="<?php echo base_url("ordermanage/order/addonsmenu") ?>" />
                    <input name="url" type="hidden" id="updatecarturl" value="<?php echo base_url("ordermanage/order/addtocartupdate") ?>" />
                    <input name="url" type="hidden" id="delurl" value="<?php echo base_url("ordermanage/order/deletetocart") ?>" />
                    <input name="updateid" type="hidden" id="uidupdateid" value="<?php echo $orderinfo->order_id; ?>" />
                    <input name="custmercode" type="hidden" id="custmercode" value="<?php echo $customerinfo->cuntomer_no; ?>" />
                    <input name="custmername" type="hidden" id="custmername" value="<?php echo $customerinfo->customer_name; ?>" />
                    <input name="saleinvoice" type="hidden" id="saleinvoice" value="<?php echo $orderinfo->saleinvoice; ?>" />
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="customer_name">MODIFICAR ORDEN<span class="color-red"></span></label>
                            <div class="d-flex">
                                <span style="color: white; background-color:green;padding:5px;font-weight:bold;border-radius: 5px;font-size:20px;padding-left: 10px;padding-right: 10px;"><?php echo $orderinfo->order_id; ?></span>

                                <!--<span style="color: white; background-color:blue;padding:5px;font-weight:bold;border-radius: 5px;"><?php echo $customerinfo->cuntomer_no; ?></span>
                                <span>&nbsp;&nbsp;-&nbsp;&nbsp;</span>-->
                                <?php
                                $table = $orderinfo->tablename;
                                if ($orderinfo->tablename == "") {
                                    $table = "LIBRE";
                                } ?>
                                <span style="color: white; background-color:blue;padding:5px;font-weight:bold;border-radius: 5px;font-size:20px;padding-left: 10px;padding-right: 10px;margin-left: 10px;"><?php echo $table; ?></span>
                                <span style="color: grey; background-color:#F5F5F5;padding:5px;font-weight:bold;border-radius: 5px;font-size:12px;padding-left: 10px;padding-right: 10px;margin-left: 10px;"><?php echo $orderinfo->comentario; ?></span>

                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="customer_name"><?php echo display('customer_name'); ?> <span class="color-red">*</span></label>
                            <div class="d-flex">
                                <?php $cusid = 1;
                                echo form_dropdown('customer_name', $customerlist, (!empty($orderinfo->customer_id) ? $orderinfo->customer_id : null), 'class="postform resizeselect form-control" id="customer_name_update" required')
                                ?>
                                <button type="button" class="btn btn-primary ml-l" aria-hidden="true" data-toggle="modal" data-target="#client-info"><i class="ti-plus"></i></button>
                            </div>
                        </div>
                        <!--<div class="col-md-6 form-group">
                            <label for="store_id"><?php echo display('customer_type'); ?> <span class="color-red">*</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <?php //$ctype = 1;
                            //echo form_dropdown('ctypeid', $curtomertype, (!empty($orderinfo->cutomertype) ? $orderinfo->cutomertype : null), 'class="form-control" id="ctypeid_update" required') 
                            ?>
                        </div>-->
                        <div id="nonthirdparty_update" class="col-md-12">
                            <div class="row">
                                <?php if ($possetting->waiter == 1) { ?>
                                    <!--<div class="col-md-6 form-group">
                                        <label for="store_id"><?php //echo display('waiter'); 
                                                                ?> <span class="color-red">*</span>&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                        <?php //echo form_dropdown('waiter', $waiterlist, (!empty($orderinfo->waiter_id) ? $orderinfo->waiter_id : null), 'class="form-control" id="waiter_update" required') 
                                        ?>
                                    </div>-->
                                <?php }
                                if ($possetting->tableid == 1) {
                                ?>
                                    <!--<div class="col-md-6 form-group" id="tblsec_update display-none">
                                        <label for="store_id"><?php //echo display('table'); 
                                                                ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="color-red">*</span></label>
                                        <?php //echo form_dropdown('tableid', $tablelist, (!empty($orderinfo->table_no) ? $orderinfo->table_no : null), 'class="form-control" id="tableid_update" required') 
                                        ?>
                                    </div>-->
                                <?php } ?>
                            </div>
                        </div>
                        <div id="thirdparty_update" class="col-md-12 display-none">
                            <div class="form-group">
                                <label for="store_id"><?php echo display('del_company'); ?> <span class="color-red">*</span>&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                <?php echo form_dropdown('delivercom', $thirdpartylist, (!empty($orderinfo->isthirdparty) ? $orderinfo->isthirdparty : null), 'class="form-control wpr_95" id="delivercom_update" required disabled="disabled"') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="hidden" id="order_date" name="order_date" required value="<?php echo date('d-m-Y') ?>" />
                            <input class="form-control" type="hidden" id="bill_info" name="bill_info" required value="<?php echo $billinfo->bill_status; ?>" />
                            <input type="hidden" id="card_type" name="card_type" value="<?php echo $billinfo->payment_method_id; ?>" />
                            <input type="hidden" id="orderstatus" name="orderstatus" value="<?php echo $orderinfo->order_status; ?>" />
                            <input type="hidden" id="assigncard_terminal" name="assigncard_terminal" value="" />
                            <input type="hidden" id="assignbank" name="assignbank" value="" />
                            <input type="hidden" id="assignlastdigit" name="assignlastdigit" value="" />
                            <input type="hidden" id="product_value" name="">
                        </div>

                    </div>
                    <div class="product-list">
                        <div id="updatefoodlist">


                            <div class="table-wrapper-scroll-y productclist" id="product-list-update">
                                <div class="table-responsive">
                                    <table class="table table-fixed table-bordered table-hover bg-white" id="purchaseTable">
                                        <thead>
                                            <tr>
                                                <th class="text-center"><?php echo display('item') ?> </th>
                                                <th class="text-center"><?php echo display('varient_name') ?></th>
                                                <th class="text-center wp_100"><?php echo display('price') ?></th>
                                                <th class="text-center wp_100"><?php echo display('quantity'); ?></th>
                                                <th class="text-center"><?php echo "Subtotal" ?></th>
                                                <th class="text-center"><?php echo display('total_price') ?></th>
                                                <th class="text-center"><?php echo display('action') ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $this->load->model('ordermanage/order_model', 'ordermodel');
                                            $i = 0;
                                            $totalamount = 0;
                                            $subtotal = 0;
                                            $pvat = 0;
                                            $total = $orderinfo->totalamount;
                                            $pdiscount = 0;
                                            $discount = 0;
                                            $multiplletax = array();
                                            foreach ($iteminfo as $item) {
                                                $i++;

                                                if ($item->isgroup == 1) {
                                                    $isgroupidp = 1;
                                                    $isgroup = $item->menu_id;
                                                } else {
                                                    $isgroupidp = 0;
                                                    $isgroup = 0;
                                                }
                                                if ($item->price > 0) {
                                                    $itemprice = $item->price * $item->menuqty;
                                                    $itemsingleprice = $item->price;
                                                } else {
                                                    $itemprice = $item->mprice * $item->menuqty;
                                                    $itemsingleprice = $item->mprice;
                                                }

                                                $iteminfo = $this->ordermodel->getiteminfo($item->menu_id);
                                                $mypdiscountprice = 0;
                                                if (!empty($taxinfos)) {
                                                    $tx = 0;
                                                    if ($iteminfo->OffersRate > 0) {
                                                        $mypdiscountprice = $iteminfo->OffersRate * $itemprice / 100;
                                                    }
                                                    $itemvalprice =  ($itemprice - $mypdiscountprice);
                                                    foreach ($taxinfos as $taxinfo) {
                                                        $fildname = 'tax' . $tx;
                                                        if (!empty($iteminfo->$fildname)) {
                                                            $vatcalc = $itemvalprice * $iteminfo->$fildname / 100;
                                                            $multiplletax[$fildname] = $multiplletax[$fildname] + $vatcalc;
                                                        } else {
                                                            $vatcalc = $itemvalprice * $taxinfo['default_value'] / 100;
                                                            $multiplletax[$fildname] = $multiplletax[$fildname] + $vatcalc;
                                                        }
                                                        $pvat = $pvat + $vatcalc;
                                                        $vatcalc = 0;
                                                        $tx++;
                                                    }
                                                } else {
                                                    $vatcalc = $itemprice * $item->productvat / 100;
                                                    $pvat = $pvat + $vatcalc;
                                                }
                                                if ($iteminfo->OffersRate > 0) {
                                                    $mypdiscount = $iteminfo->OffersRate * $itemprice / 100;
                                                    $pdiscount = $pdiscount + ($iteminfo->OffersRate * $itemprice / 100);
                                                } else {
                                                    $mypdiscount = 0;
                                                    $pdiscount = $pdiscount + 0;
                                                }

                                                $adonsprice = 0;
                                                if (!empty($item->add_on_id)) {
                                                    $addons = explode(",", $item->add_on_id);
                                                    $addonsqty = explode(",", $item->addonsqty);
                                                    $text = '&nbsp;&nbsp;<a class="text-right adonsmore" onclick="expand(' . $i . ')">More..</a>';
                                                    $x = 0;
                                                    foreach ($addons as $addonsid) {
                                                        $adonsinfo = $this->order_model->read('*', 'add_ons', array('add_on_id' => $addonsid));
                                                        $adonsprice = $adonsprice + $adonsinfo->price * $addonsqty[$x];
                                                        $x++;
                                                    }
                                                    $nittotal = $adonsprice;
                                                    $itemprice = $itemprice;
                                                } else {
                                                    $nittotal = 0;
                                                    $text = '';
                                                }
                                                $totalamount = $totalamount + $nittotal;
                                                $subtotal = $subtotal + $nittotal + $itemsingleprice * $item->menuqty;
                                            ?>
                                                <?php
                                                $color = "white";
                                                $prefix = "";
                                                if ($item->istransfer == 1) {
                                                    $color = "#DAEAFC";
                                                    $prefix = "(T) ";
                                                }

                                                if ($item->isupdate == 1) {
                                                    $color = "#DCF3DE";
                                                }
                                                //$color = "#FCFBEA";
                                                if (!empty($iteminfo->color_category_grid)) {
                                                    $color = $iteminfo->color_category_grid . ";color:white";
                                                }
                                                ?>
                                                <tr style="background-color: <?php echo $color; ?>;">
                                                    <td class="product_name_MFU4E">
                                                        <?php echo $prefix . $item->ProductName; ?><?php echo $text; ?>
                                                        <?php if ($item->isupdate == 1) { ?>
                                                            <a class="serach pl-15" onclick="itemnote('<?php echo $item->row_id; ?>','<?php echo $item->notes; ?>',<?php echo $item->order_id; ?>,1,<?php echo $isgroup; ?>)" title="<?php echo display('foodnote') ?>"> <i class="fa fa-sticky-note" aria-hidden="true"></i> </a>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $item->variantName; ?>

                                                    </td>
                                                    <td class="text-right"><?php if ($currency->position == 1) {
                                                                                echo $currency->curr_icon;
                                                                            } ?> <?php echo round($itemsingleprice, 2); ?> <?php if ($currency->position == 2) {
                                                                                                                                echo $currency->curr_icon;
                                                                                                                            } ?> </td>
                                                    <td class="text-right">
                                                        <?php
                                                        if ($item->isupdate == 1) {
                                                        ?>
                                                            <div onclick="updateProductQty(<?php echo $item->row_id; ?>, <?php echo $item->order_id; ?>)" style="border-radius:5px;background-color: #428BCA;padding:5px;color:white;">
                                                            <?php } else { ?>
                                                                <div>
                                                                <?php } ?>
                                                                <?php
                                                                if ($item->isupdate == 1) {
                                                                ?>
                                                                    <!--
                                                            <a class="btn btn-danger btn-sm btnrightalign" onclick="positemupdate('<?php echo $item->menu_id ?>',<?php echo $item->menuqty; ?>,'<?php echo $item->order_id; ?>','<?php echo $item->varientid ?>','<?php echo $isgroupidp; ?>','<?php echo $item->addonsuid ?>','del')"><i class="fa fa-minus" aria-hidden="true"></i></a>
                                                        -->
                                                                <?php } ?>
                                                                <input class="exists_qty" type="hidden" name="select_qty_<?php echo $item->menu_id ?>" id="select_qty_<?php echo $item->menu_id ?>_<?php echo $item->varientid ?>" value="<?php echo $item->menuqty; ?>">
                                                                <span id="productionsetting-update-<?php echo $item->menu_id . '-' . $item->varientid ?>" style="font-size:18px;"><?php echo number_format($item->menuqty, 0); ?> </span>
                                                                <?php
                                                                if ($item->isupdate == 1) {
                                                                ?>
                                                                    <!--
                                                            <a class="btn btn-info btn-sm btnleftalign" onclick="positemupdate('<?php echo $item->menu_id ?>',<?php echo $item->menuqty; ?>,'<?php echo $item->order_id; ?>','<?php echo $item->varientid ?>','<?php echo $isgroupidp; ?>','<?php echo $item->addonsuid ?>','add')"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                                        -->
                                                                <?php } ?>
                                                                </div>
                                                    </td>
                                                    <td class="text-right"><strong><?php if ($currency->position == 1) {
                                                                                        echo $currency->curr_icon;
                                                                                    } ?> <?php echo number_format($itemprice - $mypdiscount, 2); ?> <?php if ($currency->position == 2) {
                                                                                                                                                        echo $currency->curr_icon;
                                                                                                                                                    } ?> </strong></td>

                                                    <td class="text-right"><strong><?php if ($currency->position == 1) {
                                                                                        echo $currency->curr_icon;
                                                                                    } ?> <?php echo number_format(($itemprice - $mypdiscount) + ($itemprice * ($item->productvat / 100)), 2); ?> <?php if ($currency->position == 2) {
                                                                                                                                                                                                        echo $currency->curr_icon;
                                                                                                                                                                                                    } ?> </strong></td>
                                                    <td class="text-right"><?php if ($orderinfo->order_status != 4) { ?><a class="btn btn-danger btn-sm btnrightalign" onclick="deletecart(<?php echo $item->row_id; ?>,<?php echo $item->order_id; ?>,<?php echo $item->menu_id ?>,<?php echo $item->varientid ?>,<?php echo $item->menuqty; ?>, <?php echo $item->isupdate; ?>)"><i class="fa fa-trash-o" aria-hidden="true"></i></a><?php } ?></td>
                                                </tr>
                                                <?php if ($item->notes != '') { ?>
                                                    <tr>
                                                        <td colspan="7">
                                                            <?php echo $item->notes; ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                <?php
                                                if (!empty($item->add_on_id)) {
                                                    $y = 0;
                                                    foreach ($addons as $addonsid) {
                                                        $adonsinfo = $this->order_model->read('*', 'add_ons', array('add_on_id' => $addonsid));
                                                        $adonsprice = $adonsprice + $adonsinfo->price * $addonsqty[$y];
                                                        /*for adonsval cal*/
                                                        if (!empty($taxinfos)) {
                                                            $tax = 0;

                                                            foreach ($taxinfos as $taxainfo) {

                                                                $fildaname = 'tax' . $tax;

                                                                if (!empty($adonsinfo->$fildaname)) {

                                                                    $avatcalc = ($adonsinfo->price * $addonsqty[$y]) * ($adonsinfo->$fildaname) / 100;
                                                                    $multiplletax[$fildaname] = $multiplletax[$fildaname] + $avatcalc;
                                                                } else {
                                                                    $avatcalc = ($adonsinfo->price * $addonsqty[$y]) * $taxainfo['default_value'] / 100;
                                                                    $multiplletax[$fildaname] = $multiplletax[$fildaname] + $avatcalc;
                                                                }

                                                                $pvat = $pvat + $avatcalc;

                                                                $avatcalc = 0;
                                                                $tax++;
                                                            }
                                                        }
                                                        /*adonse update val cal*/
                                                ?>
                                                        <tr class="bg-deep-purple get_<?php echo $i; ?> hasaddons" id="expandcol_<?php echo $i; ?>">
                                                            <td colspan="2">
                                                                <?php echo $adonsinfo->add_on_name; ?>
                                                            </td>
                                                            <td class="text-right"><?php if ($currency->position == 1) {
                                                                                        echo $currency->curr_icon;
                                                                                    } ?> <?php echo $adonsinfo->price; ?> <?php if ($currency->position == 2) {
                                                                                                                                echo $currency->curr_icon;
                                                                                                                            } ?> </td>
                                                            <td class="text-right"><?php echo $addonsqty[$y]; ?></td>
                                                            <td class="text-right"><strong><?php if ($currency->position == 1) {
                                                                                                echo $currency->curr_icon;
                                                                                            } ?> <?php echo $adonsinfo->price * $addonsqty[$y]; ?> <?php if ($currency->position == 2) {
                                                                                                                                                        echo $currency->curr_icon;
                                                                                                                                                    } ?> </strong></td>
                                                            <td class="text-right">&nbsp;</td>
                                                        </tr>
                                            <?php $y++;
                                                    }
                                                }
                                            }
                                            $itemtotal = $subtotal;

                                            if (empty($taxinfos)) {
                                                if ($settinginfo->vat > 0) {
                                                    $calvat = ($itemtotal - $pdiscount) * $settinginfo->vat / 100;
                                                } else {
                                                    $calvat = $pvat;
                                                }
                                            } else {
                                                $calvat = $pvat;
                                            }
                                            $multiplletaxvalue = htmlentities(serialize($multiplletax));
                                            ?>
                                            <!--<tr>
                                                <td class="text-right" colspan="4"><strong><?php echo display('subtotal') ?></strong></td>
                                                <td class="text-right"><strong><?php if ($currency->position == 1) {
                                                                                    echo $currency->curr_icon;
                                                                                } ?> <?php echo number_format($itemtotal - $pdiscount, 3); ?> <?php if ($currency->position == 2) {
                                                                                                                                                    echo $currency->curr_icon;
                                                                                                                                                } ?> </strong></td>
                                            </tr>-->
                                        </tbody>
                                        <tfoot>

                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <input name="subtotal" id="subtotal_update" type="hidden" value="<?php echo $subtotal; ?>" />
                            <input name="multiplletaxvalue" id="multiplletaxvalue_update" type="hidden" value="<?php echo $multiplletaxvalue; ?>" />
                            <?php $servicecharge = 0;
                            if (empty($billinfo)) {
                                $servicecharge = 0;
                            } else {
                                if ($settinginfo->service_chargeType == 0) {
                                    $servicecharge = $settinginfo->servicecharge;
                                } else {
                                    $totalsercharge = $subtotal - $pdiscount;
                                    $servicecharge = $settinginfo->servicecharge * $totalsercharge / 100;
                                }
                                $sdamount = $settinginfo->service_charge;
                            }
                            ?>
                            <?php $discount = 0;
                            $customerinfo = $this->ordermodel->read('*', 'customer_info', array('customer_id' => $billinfo->customer_id));
                            $mtype = $this->order_model->read('*', 'membership', array('id' => $customerinfo->membership_type));
                            if (empty($billinfo)) {
                                $discount = $pdiscount;
                            } else {
                                $newsubtotal = $subtotal - $pdiscount;
                                $discount = $pdiscount + ($mtype->discount * $newsubtotal / 100);
                                $disamount = $billinfo->discount;
                            }

                            ?>
                            <input name="distype" id="distype_update" type="hidden" value="<?php echo $settinginfo->discount_type; ?>" />
                            <input name="sdtype" id="sdtype_update" type="hidden" value="<?php echo $settinginfo->service_chargeType; ?>" />
                            <input name="invoice_discount" class="text-right" id="invoice_discount_update" type="hidden" value="<?php echo $discount; ?>" />
                            <!--<table class="table table-bordered bg-white">

                                <tr>
                                    <td class="text-right wpr_494"><strong><?php echo display('service_chrg') ?><?php if ($settinginfo->service_chargeType == 0) {
                                                                                                                    echo "(" . $currency->curr_icon . ")";
                                                                                                                } else {
                                                                                                                    echo "(%)";
                                                                                                                } ?></strong></td>
                                    <td class="text-right wpr_28">
                                        <strong>
                                            <input name="service_charge" class="text-right" id="service_charge_update" type="number" placeholder="0.00" onkeyup="sumcalculation(1)" value="<?php echo $settinginfo->servicecharge; ?>" />
                                        </strong>
                                    </td>
                                    <td class="text-right wpr_126">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td class="text-right wpr_494"><strong><?php echo display('vat_tax') ?></strong></td>
                                    <td class="text-right wpr_28">
                                        <!--<input id="vat_update" name="vat" type="hidden" value="<?php echo $calvat; ?>" />
                                        <strong><?php if ($currency->position == 1) {
                                                    echo $currency->curr_icon;
                                                } ?> <?php echo number_format($calvat, 3); ?> <?php if ($currency->position == 2) {
                                                                                                    echo $currency->curr_icon;
                                                                                                } ?> </strong>
                                    </td>
                                    <td class="text-right wpr_126">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td class="text-right wpr_494"><strong><?php echo display('grand_total') ?></strong></td>
                                    <td class="text-right wpr_28"><input name="vat" type="hidden" value="<?php echo $calvat; ?>" />
                                        <input name="tgtotal" type="hidden" value="<?php echo $calvat + $itemtotal + $servicecharge - $discount; ?>" id="tgtotal" />
                                        <input name="orginattotal" id="orginattotal_update" type="hidden" value="<?php echo $calvat + $itemtotal + $servicecharge - $discount; ?>" /><input name="grandtotal" id="grandtotal_update" type="hidden" value="<?php echo $calvat + $itemtotal + $servicecharge - $discount; ?>" /><?php if ($currency->position == 1) {
                                                                                                                                                                                                                                                                                                                                    echo $currency->curr_icon;
                                                                                                                                                                                                                                                                                                                                } ?> <strong id="gtotal_update"><?php echo number_format($calvat + $itemtotal + $servicecharge - $discount, 3); ?></strong> <?php if ($currency->position == 2) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                echo $currency->curr_icon;
                                                                                                                                                                                                                                                                                                                                                                                                                                                            } ?>
                                    </td>
                                    <td class="text-right wpr_126">&nbsp;</td>
                                </tr>

                            </table>-->
                        </div>
                    </div>

                </div>
                <!--<div class="fixedclasspos">
                    <div class="bottomarea">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <input type="button" id="update_order_confirm" onclick="postupdateorder_ajax()" class="btn btn-success btn-large cusbtn" name="add-payment" value="ACTUALIZAR PEDIDO">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>-->
                <div class="fixedclasspos">
                    <div class="row d-flex flex-wrap align-items-center">
                        <div class="col-sm-6 leftview">
                            <input name="tgtotal" type="hidden" value="<?php echo $calvat + $itemtotal + $servicecharge - $discount; ?>" id="tgtotal" />
                            <input name="distype" id="distype" type="hidden" value="<?php echo $settinginfo->discount_type; ?>" />
                            <input name="sdtype" id="sdtype" type="hidden" value="<?php echo $settinginfo->service_chargeType; ?>" />
                            <input type="hidden" id="orginattotal_jose_ajuste" value="<?php echo $calvat + $itemtotal + $servicecharge - ($discount + $pdiscount); ?>" name="orginattotal">
                            <input type="hidden" id="invoice_discount" class="form-control text-right" name="invoice_discount" value="<?php echo $discount + $pdiscount ?>">
                            <table class="table table-bordered footersumtotal">
                                <tr>
                                    <td>
                                        <div class="row m-0">
                                            <label for="date" class="col-sm-8 mb-0"><?php echo display('vat_tax1') ?>: </label>
                                            <label class="col-sm-4 mb-0">
                                                <input type="hidden" id="vat_update" name="vat" value="<?php echo $calvat; ?>" />
                                            </label>
                                            <strong>
                                                <?php if ($currency->position == 1) {
                                                    echo $currency->curr_icon;
                                                } ?>
                                                <span id="calvat_update"> <?php echo round($calvat, 2); ?></span>
                                                <?php if ($currency->position == 2) {
                                                    echo $currency->curr_icon;
                                                } ?>
                                            </strong>
                                            </label>
                                        </div>
                                    </td>

                                    <td rowspan="2"><label for="date" class="mb-0 col-sm-6"><?php echo display('grand_total') ?>:</label>
                                        <label class="col-sm-6 p-0 mb-0">
                                            <input type="hidden" id="orggrandTotal" value="<?php echo $calvat + $itemtotal + $servicecharge - ($discount + $pdiscount); ?>" name="orggrandTotal">
                                            <input name="grandtotal" type="hidden" value="<?php echo $calvat + $itemtotal + $servicecharge - ($discount + $pdiscount); ?>" id="grandtotal" />
                                            <span class="badge badge-primary grandbg font-26"><strong>
                                                    <?php if ($currency->position == 1) {
                                                        echo $currency->curr_icon;
                                                    } ?>
                                                    <span id="caltotal_update"><?php echo round($calvat + $itemtotal + $servicecharge - $discount, 2); ?></span>
                                                    <!--<span id="caltotal_tasa"><?php //echo (($calvat + $itemtotal + $servicetotal - ($discount + $pdiscount)) * $parameters[0]["value"]); 
                                                                                    ?></span>-->
                                                    <?php if ($currency->position == 2) {
                                                        echo $currency->curr_icon;
                                                    } ?>
                                                </strong></span></label>
                                    </td>
                                </tr>
                                <tr>
                                    <script>
                                        function removeService() {
                                            document.getElementById("service_charge_update").value = "0";
                                            sumcalculation(1);
                                        }
                                    </script>
                                    <td>
                                        <label for="date" class="col-sm-6 mb-0"><?php echo display('service_chrg') ?>
                                            <?php if ($settinginfo->service_chargeType == 0) {
                                                echo "(" . $currency->curr_icon . ")";
                                            } else {
                                                echo "(%)";
                                            } ?>
                                            :</label>

                                        <div class="col-sm-3 p-0">
                                            <input type="text" id="service_charge_update" name="service_charge" onchange="sumcalculation(1);" class="form-control text-right mb-5" value="<?php if ($servicecharge > 0) {
                                                                                                                                                                                                echo $settinginfo->servicecharge;
                                                                                                                                                                                            } else {
                                                                                                                                                                                                echo "0";
                                                                                                                                                                                            } ?>" name="service_charge" placeholder="0.00" />
                                        </div>
                                        <?php if ($servicecharge == 0) {
                                            echo "<script>$('#remove_service_btn').click();</script>";
                                        } ?>
                                        <div class="col-sm-3 p-0">

                                            <a id="remove_service_btn" style="margin-top:10px;font-weight: bold;cursor:pointer;color:red;" onclick="removeService();">ELIMINAR</a>
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="col-sm-8 mb-0">
                                            TASA:
                                        </label>
                                        <div class="col-sm-4 p-0">
                                            <input id="caltotal_tasa" type="text" disabled="true" class="form-control text-right mb-5" value="<?php echo round($currency_rate->curr_rate, 2); ?>" placeholder="0.00" />
                                        </div>

                                    </td>

                                    <td>
                                        <label class="col-sm-8 mb-0">
                                            TOTAL (<?php echo $currency_rate->curr_icon; ?>):
                                        </label>
                                        <div class="col-sm-4 p-0">
                                            <span class="badge badge-primary grandbg font-26" id="caltotal_total_update"><?php echo round($currency_rate->curr_rate * ($calvat + $itemtotal + $servicecharge - $discount), 2); ?>
                                            </span>
                                        </div>

                                    </td>

                                </tr>

                            </table>
                        </div>
                        <div class="col-sm-6 text-right">
                            <a class="btn btn-primary cusbtn" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-calculator" aria-hidden="true"></i></a>
                            <!--<a href="<?php echo base_url("ordermanage/order/posclear") ?>" type="button" class="btn btn-danger cusbtn"><?php echo display('cancel') ?></a>-->
                            <!--<input type="hidden" id="getitemp" name="getitemp" value="<?php echo $totalitem - $discount; ?>" />
                            <input type="button" id="add_payment2" class="btn btn-primary btn-large cusbtn" onclick="quickorder()" name="add-payment" value="<?php echo display('quickorder') ?>">
                            <input type="button" id="add_payment" class="btn btn-success btn-large cusbtn" onclick="placeorder()" name="add-payment" value="<?php echo display('placeorder') ?>">


                            <input type="hidden" id="production_setting" value="<?php echo $possetting->productionsetting; ?>">
                            <input type="hidden" id="production_url" value="<?php echo base_url("production/production/ingredientcheck") ?>">-->
                            <script>
                                function tyransferProductsFinal(order_id) {

                                    products_transfer(order_id)
                                    //===================================================================
                                    //$("#ongoingorder").click();
                                    //===================================================================


                                }

                                function billing(order_id) {
                                    createMargeorder(order_id, 1);
                                }
                            </script>
                            <?php if ($station_info->is_billing_station == 1) { ?>
                                <input type="button" id="transfer_order_confirm" style="font-weight: bold;" onclick="billing(<?php echo $orderinfo->order_id; ?>)" class="btn btn-success btn-large cusbtn" name="add-payment" value="FACTURAR">
                            <?php } ?>
                            <input type="button" id="transfer_order_confirm" style="font-weight: bold;" onclick="tyransferProductsFinal(<?php echo $orderinfo->order_id; ?>)" class="btn btn-info btn-large cusbtn" name="add-payment" value="TRANSF. PRODUCTOS">
                            <input type="button" id="update_order_confirm" style="font-weight: bold;" onclick="postupdateorder_ajax()" class="btn btn-success btn-large cusbtn" name="add-payment" value="ACTUALIZAR PEDIDO">
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('ordermanage/order/updateorderjs/' . $orderinfo->order_id) ?>" type="text/javascript"></script>
<script src="<?php echo base_url('application/modules/ordermanage/assets/js/posupdate.js'); ?>" type="text/javascript"></script>
<style>
    .product-grid {
        background-color: #f8edc9;
        padding: 5px;
    }

    .productclist {
        height: calc(100vh - 320px) !important;
    }

    .table-wrapper-scroll-y {
        display: block;
        max-height: none;
        overflow-y: none;
    }

    .product_name_MFU4E {
        text-align: initial !important;
        text-transform: uppercase;
        font-weight: bold;
    }
</style>
<style>
    /* Estilos para motores Webkit y blink (Chrome, Safari, Opera... )*/

    #product-list-update::-webkit-scrollbar {
        -webkit-appearance: none;
    }

    #product-list-update::-webkit-scrollbar:vertical {
        width: 10px;
    }

    #product-list-update::-webkit-scrollbar-button:increment,
    #product-list-update::-webkit-scrollbar-button {
        display: none;
    }

    #product-list-update::-webkit-scrollbar:horizontal {
        height: 10px;
    }

    #product-list-update::-webkit-scrollbar-thumb {
        background-color: #797979;
        border-radius: 20px;
        border: 2px solid #f1f2f3;
    }

    #product-list-update::-webkit-scrollbar-track {
        border-radius: 10px;
    }

    #product-list-update {
        /*Estilos estándar experimentales (Principalmente Firefox)*/
        scrollbar-color: rgba(0, 0, 0, .5) rgba(0, 0, 0, 0) !important;
        scrollbar-width: thin !important;
    }
</style>