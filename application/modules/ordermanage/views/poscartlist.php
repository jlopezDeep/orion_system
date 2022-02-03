<?php $grtotal = 0;
$totalitem = 0;
$calvat = 0;
$discount = 0;
$itemtotal = 0;
$pdiscount = 0;
$multiplletax = array();
$this->load->model('ordermanage/order_model', 'ordermodel');
if ($cart = $this->cart->contents()) { ?>
  <table class="table table-bordered wpr_100" border="1" id="addinvoice">
    <thead>
      <tr>
        <th><?php echo display('item') ?></th>
        <th><?php echo display('varient_name') ?></th>
        <th><?php echo display('price'); ?></th>
        <th><?php echo display('quantity'); ?></th>
        <th><?php echo "Subtotal"; ?></th>
        <th><?php echo display('total'); ?></th>
        <th><?php echo display('action'); ?></th>
      </tr>
    </thead>
    <tbody class="itemNumber">
      <?php $i = 0;
      $totalamount = 0;
      $subtotal = 0;
      $ptdiscount = 0;
      $pvat = 0;
      foreach ($cart as $item) {
        $iteminfo = $this->ordermodel->getiteminfo($item['pid']);
        $itemprice = $item['price'] * $item['qty'];
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
          $vatcalc = $itemprice * $iteminfo->productvat / 100;
          $pvat = $pvat + $vatcalc;
        }

        if ($iteminfo->OffersRate > 0) {
          $mypdiscount = $iteminfo->OffersRate * $itemprice / 100;
          $ptdiscount = $ptdiscount + ($iteminfo->OffersRate * $itemprice / 100);
        } else {
          $mypdiscount = 0;
          $pdiscount = $pdiscount + 0;
        }
        if (!empty($item['addonsid'])) {
          $nittotal = $item['addontpr'];
          $itemprice = $itemprice + $item['addontpr'];
        } else {
          $nittotal = 0;
          $itemprice = $itemprice;
        }
        $totalamount = $totalamount + $nittotal;
        $subtotal = $subtotal + $nittotal + $item['price'] * $item['qty'];
        $i++;
        $color = "#FCFBEA";
        if (!empty($iteminfo->color_category_grid)) {
          $color = $iteminfo->color_category_grid.";color:white";
        }
      ?>
        <tr id="<?php echo $i; ?>" style="background-color:<?php echo $color; ?>;">
          <th id="product_name_MFU4E">
            <?php echo  $item['name'];
            if (!empty($item['addonsid'])) {
              echo "<br>";
              echo $item['addonname'];
              if (!empty($taxinfos)) {

                $addonsarray = explode(',', $item['addonsid']);
                $addonsqtyarray = explode(',', $item['addonsqty']);
                $getaddonsdatas = $this->db->select('*')->from('add_ons')->where_in('add_on_id', $addonsarray)->get()->result_array();
                $addn = 0;
                foreach ($getaddonsdatas as $getaddonsdata) {
                  $tax = 0;

                  foreach ($taxinfos as $taxainfo) {

                    $fildaname = 'tax' . $tax;

                    if (!empty($getaddonsdata[$fildaname])) {

                      $avatcalc = ($getaddonsdata['price'] * $addonsqtyarray[$addn]) * $getaddonsdata[$fildaname] / 100;
                      $multiplletax[$fildaname] = $multiplletax[$fildaname] + $avatcalc;
                    } else {
                      $avatcalc = ($getaddonsdata['price'] * $addonsqtyarray[$addn]) * $taxainfo['default_value'] / 100;
                      $multiplletax[$fildaname] = $multiplletax[$fildaname] + $avatcalc;
                    }

                    $pvat = $pvat + $avatcalc;

                    $tax++;
                  }
                  $addn++;
                }
              }
            }
            ?><a class="serach pl-15" onclick="itemnote('<?php echo $item['rowid'] ?>','<?php echo $item['itemnote'] ?>',<?php echo $item['qty']; ?>,2)" title="<?php echo display('foodnote') ?>"> <i class="fa fa-sticky-note" aria-hidden="true"></i> </a></th>
          <td><?php echo $item['size']; ?></td>
          <td width=""><?php if ($currency->position == 1) {
                          echo $currency->curr_icon;
                        } ?>
            <?php echo $item['price']; ?>
            <?php if ($currency->position == 2) {
              echo $currency->curr_icon;
            } ?></td>
          <td scope="row">
            <div style="border-radius:5px;background-color: #428BCA;padding:5px;color:white;" onclick="updatecartqty('<?php echo $item['rowid'] ?>')">
              <!-- <a class="btn btn-info btn-sm btnleftalign" onclick="posupdatecart('<?php echo $item['rowid'] ?>',<?php echo $item['pid']; ?>,<?php echo $item['sizeid'] ?>,<?php echo $item['qty']; ?>,'add')"><i class="fa fa-plus" aria-hidden="true"></i></a> 
                                      -->
              <span id="productionsetting-<?php echo $item['pid'] . '-' . $item['sizeid'] ?>" style="font-size:18px;"> <?php echo $item['qty']; ?> </span>
              <!--<a class="btn btn-danger btn-sm btnrightalign" onclick="posupdatecart('<?php echo $item['rowid'] ?>',<?php echo $item['pid']; ?>,<?php echo $item['sizeid'] ?>,<?php echo $item['qty']; ?>,'del')"><i class="fa fa-minus" aria-hidden="true"></i></a></td>
                                      -->

            </div>
          <td width=""><?php if ($currency->position == 1) {
                          echo $currency->curr_icon;
                        } ?>
            <?php echo $itemprice - $mypdiscount; ?>
            <?php if ($currency->position == 2) {
              echo $currency->curr_icon;
            } ?></td>
          <td width=""><?php if ($currency->position == 1) {
                          echo $currency->curr_icon;
                        } ?>
            <?php echo round($itemprice - $mypdiscount + ($itemprice * ($iteminfo->productvat / 100)), 2); ?>
            <?php if ($currency->position == 2) {
              echo $currency->curr_icon;
            } ?></td>
          <td width:"80"=""><a class="btn btn-danger btn-sm btnrightalign" onclick="removecart('<?php echo $item['rowid']; ?>')"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
        </tr>
        <?php if ($item['itemnote'] != '') { ?>
          <tr>
            <td colspan="7">
              <?php echo $item['itemnote']; ?>
            </td>
          </tr>
        <?php } ?>
      <?php }
      $itemtotal = $subtotal;
      /*check $taxsetting info*/
      if (empty($taxinfos)) {
        if ($settinginfo->vat > 0) {
          $calvat = ($itemtotal - $ptdiscount) * $settinginfo->vat / 100;
        } else {
          $calvat = $pvat;
        }
      } else {
        $calvat = $pvat;
      }
      $grtotal = $itemtotal;
      $totalitem = $i;
      ?>
    </tbody>
  </table>
<?php $pdiscount = $ptdiscount;
}

$multiplletaxvalue = htmlentities(serialize($multiplletax));
?>
<input name="subtotal" id="subtotal" type="hidden" value="<?php echo $subtotal; ?>" />

<input name="multiplletaxvalue" id="multiplletaxvalue" type="hidden" value="<?php echo $multiplletaxvalue; ?>" />
<?php
if (!empty($this->cart->contents())) {
  if ($settinginfo->service_chargeType == 1) {
    $totalsercharge = $subtotal - $pdiscount;
    $servicetotal = $settinginfo->servicecharge * $totalsercharge / 100;
  } else {
    $servicetotal = $settinginfo->servicecharge;
  }
  $servicecharge = $settinginfo->servicecharge;
} else {
  $servicetotal = 0;
  $servicecharge = 0;
}
?>

<input name="subtotal" id="subtotal" type="hidden" value="<?php echo $subtotal; ?>" />
<input name="totalitem" id="totalitem" type="hidden" value="<?php echo $totalitem; ?>" />
<input name="multiplletaxvalue" id="multiplletaxvalue" type="hidden" value="<?php echo $multiplletaxvalue; ?>" />
<input name="tvat" type="hidden" value="<?php echo $calvat; ?>" id="tvat" />
<input name="sc" type="hidden" value="<?php echo $servicecharge; ?>" id="sc" />
<input name="tdiscount" type="hidden" value="<?php echo $pdiscount; ?>" placeholder="0.00" id="tdiscount" />
<input name="tgtotal" type="hidden" value="<?php echo $calvat + $servicetotal + $itemtotal - $pdiscount; ?>" id="tgtotal" />