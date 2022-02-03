<link href="<?php echo base_url('application/modules/report/assets/css/ajaxsalereport.css'); ?>" rel="stylesheet" type="text/css" />

<div class="table-responsive">
	<table class="table table-bordered table-striped table-hover" id="respritbl">
		<thead>
			<tr>
				<th><?php echo "Fecha"; ?></th>
				<th><?php echo "Orden"; ?></th>
				<th><?php echo "Cliente"; ?></th>
				<th><?php echo "Mesa"; ?></th>
				<th><?php echo "Comentario"; ?></th>
				<th><?php echo display('paymd'); ?></th>
				<th><?php echo display('order_total'); ?></th>
				<th><?php echo display('vat_tax1') ?></th>
				<th><?php echo display('service_chrg') ?></th>
				<th><?php echo display('discount') ?></th>

				<th><?php echo "PAGO"; ?></th>
				<th><?php echo "Cambio"; ?></th>
				<th><?php echo "TOTAL"; ?></th>
			</tr>
		</thead>
		<tbody class="ajaxsalereport">
			<?php
			$totalprice = 0;
			$totalprice_raw = 0;
			$total_vat = 0;
			$subtotal = 0;
			$total_service = 0;
			$total_change = 0;
			if ($preport) {
				$order_id_aux = 0;

				foreach ($preport as $pitem) {
					$change = 0;
					$vat = 0;
					$subtotal_item = 0;
					$service = 0;
					$change_item = 0;
					$totalprice_item = 0;
					if ($pitem->order_id != $order_id_aux) {
						$order_id_aux = $pitem->order_id;
						$change = $pitem->change;
						$vat = $pitem->VAT;
						$subtotal_item  = $pitem->total_amount;
						$service = $pitem->service_charge;
						$change_item = $pitem->change;
						$totalprice_item = $pitem->amount;
					}
					$totalprice = ($totalprice + $pitem->amount) - $change;
					$total_vat = ($total_vat + $vat); //bill_amount
					$subtotal = ($subtotal + $subtotal_item);
					$total_service = ($total_service + $service);
					$total_change = ($total_change + $change_item);
					$totalprice_raw = ($totalprice_raw + $pitem->amount);
			?>
					<tr>
						<td><?php $originalDate = $pitem->order_date;
							echo $pitem->order_date . " " . $pitem->order_time;
							?></td>
						<td><a href="<?php echo base_url("ordermanage/order/orderdetails/" . $pitem->order_id) ?>" target="_blank">
								<?php echo $pitem->saleinvoice; ?>
							</a></td>
						<td><?php echo $pitem->customer_name; ?></td>
						<td><?php echo $pitem->tablename; ?></td>
						<td><?php echo $pitem->comentario; ?></td>
						<td><?php echo $pitem->payment_method; ?></td>
						<td class="order_total"><?php if ($currency->position == 1) {
													echo $currency->curr_icon;
												} ?> <?php echo $pitem->total_amount; ?> <?php if ($currency->position == 2) {
																								echo $currency->curr_icon;
																							} ?></td>
						<td class="total_ammount"><?php echo round($pitem->VAT, 2); ?></td>
						<td class="total_ammount"><?php echo round($pitem->service_charge, 2); ?></td>
						<td class="total_ammount"><?php echo round($pitem->discount, 2); ?></td>

						<td class="total_ammount"><?php if ($currency->position == 1) {
														echo $currency->curr_icon;
													} ?> <?php echo $pitem->amount; ?> <?php if ($currency->position == 2) {
																							echo $currency->curr_icon;
																						} ?></td>
						<td class="total_ammount"><?php echo $pitem->change; ?></td>
						<td class="total_ammount"><?php if ($currency->position == 1) {
														echo $currency->curr_icon;
													} ?> <?php echo $pitem->bill_amount; ?> <?php if ($currency->position == 2) {
																								echo $currency->curr_icon;
																							} ?></td>
					</tr>
					</tr>
			<?php }
			}
			?>
		</tbody>



		<!--<tfoot class="ajaxsalereport-footer">
			<tr>
				<td class="ajaxsalereport-fo-total-sale" colspan="12" align="right">&nbsp; <b><?php echo "TOTAL CON CAMBIO" ?> </b></td>
				<td class="fo-total-sale"><b><?php if ($currency->position == 1) {
													echo $currency->curr_icon;
												} ?> <?php echo round($totalprice_raw, 2); ?> <?php if ($currency->position == 2) {
																									echo $currency->curr_icon;
																								} ?></b></td>
			</tr>
		</tfoot>-->
		<tfoot class="ajaxsalereport-footer">
			<tr>
				<td class="ajaxsalereport-fo-total-sale" colspan="12" align="right">&nbsp; <b><?php echo "CAMBIO" ?> </b></td>
				<td class="fo-total-sale"><b><?php if ($currency->position == 1) {
													echo $currency->curr_icon;
												} ?> <?php echo round($total_change, 2); ?> <?php if ($currency->position == 2) {
																								echo $currency->curr_icon;
																							} ?></b></td>
			</tr>
		</tfoot>
		<tfoot class="ajaxsalereport-footer" style="background-color: #DCF3DE;">
			<tr>
				<td class="ajaxsalereport-fo-total-sale" colspan="12" align="right">&nbsp; <b><?php echo "SUBTOTAL" ?> </b></td>
				<td class="fo-total-sale"><b><?php if ($currency->position == 1) {
													echo $currency->curr_icon;
												} ?> <?php echo round($subtotal, 2); ?> <?php if ($currency->position == 2) {
																							echo $currency->curr_icon;
																						} ?></b></td>
			</tr>
		</tfoot>
		<tfoot class="ajaxsalereport-footer" style="background-color: #DCF3DE;">
			<tr>
				<td class="ajaxsalereport-fo-total-sale" colspan="12" align="right">&nbsp; <b><?php echo "SERVICIO" ?> </b></td>
				<td class="fo-total-sale"><b><?php if ($currency->position == 1) {
													echo $currency->curr_icon;
												} ?> <?php echo round($total_service, 2); ?> <?php if ($currency->position == 2) {
																									echo $currency->curr_icon;
																								} ?></b></td>
			</tr>
		</tfoot>
		<tfoot class="ajaxsalereport-footer" style="background-color: #DCF3DE;">
			<tr>
				<td class="ajaxsalereport-fo-total-sale" colspan="12" align="right">&nbsp; <b><?php echo "IMPUESTO"; ?> </b></td>
				<td class="fo-total-sale"><b><?php if ($currency->position == 1) {
													echo $currency->curr_icon;
												} ?> <?php echo round($total_vat, 2); ?> <?php if ($currency->position == 2) {
																								echo $currency->curr_icon;
																							} ?></b></td>
			</tr>
		</tfoot>
		<tfoot class="ajaxsalereport-footer" style="background-color: #37A000;color:white;">
			<tr>
				<td class="ajaxsalereport-fo-total-sale" colspan="12" align="right">&nbsp; <b><?php echo "VENTA TOTAL" ?> </b></td>
				<td class="fo-total-sale"><b><?php if ($currency->position == 1) {
													echo $currency->curr_icon;
												} ?> <?php echo $totalprice; ?> <?php if ($currency->position == 2) {
																					echo $currency->curr_icon;
																				} ?></b></td>
			</tr>
		</tfoot>





	</table>
</div>