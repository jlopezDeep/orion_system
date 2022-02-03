<div class="row kitchen-tab">
    <?php
    $row = count($tableinfo);
    $numOfCols = 3;
    $rowCount = 0;
    $bootstrapColWidth = $row / $numOfCols;
    foreach ($tableinfo as $table) { ?>

        <div class="col-md-4">
            <div class="info_part <?php if ($table['sum'] >= $table['person_capicity']) {
                                        echo 'booked';
                                    } ?>">
                <div class="table-topper">
                    <div class="">
                        <!--<input id="chkboxmap-<?php echo
                                                    $table['tableid'] ?>" type="checkbox" name="add_table[]" value="<?php
                                                                                                                    echo $table['tableid'] ?>">-->
                        <!--<label for="chkboxmap-<?php echo
                                                    $table['tableid']; ?>">
                            <span class="radio-shape">
                                <i class="fa fa-check"></i>
                            </span>
                            <div>
                                <span class="display-block"><?php
                                                            echo display('select_this_table'); ?></span>
                            </div>
                        </label>-->
                        <table class="table table-modal table-title">
                            <tbody>
                                <tr>
                                    <!--<td><?php echo display('table'); ?></td>-->
                                    <?php
                                    $color_table = "green";
                                    if (!empty($table['table_details'])) {
                                        $color_table = "darkred";
                                    }
                                    ?>
                                    <td onclick="checktable(<?php echo $table['tableid']; ?>, <?php echo $table['user_view']; ?>)" style="font-weight:bold;font-size:25px;background-color: <?php echo $color_table; ?>;color:white;padding:10px;cursor:pointer;border-radius: 5px;cursor:pointer;"><?php echo $table['tablename'] ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        <hr />
                                    </td>
                                </tr>
                                <tr>

                                    <!--<td><?php echo display('table'); ?></td>-->
                                    <td onclick="checktabletransfer(<?php echo $table['tableid']; ?>)" style="font-weight:bold;font-size:12px;background-color: blue;color:white;padding:10px;cursor:pointer;border-radius: 5px;cursor:pointer;">TRASFERIR AQUI</td>
                                </tr>

                                <!--<tr>
                                                        <td><?php echo display('seat'); ?></td>
                                                        <td><?php echo $table['person_capicity'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo display('available'); ?></td>
                                                        <td><?php echo $table['person_capicity'] - $table['sum'] ?></td>
                                                    </tr>-->
                            </tbody>
                        </table>
                    </div>
                    <img src="<?php echo base_url(); ?>/assets/img/006-terrace.png" class="table-img" alt="">
                </div>
                <table class="table table-bordered table-modal table-info text-center">
                    <?php $table_count = count($table['table_details']); ?>
                    <?php
                    $style = "";
                    if (!empty($table['table_details'])) {
                        $style = "background-color: darkred;color:white !important;";
                    }
                    ?>
                    <thead <?php if ($table_count > 3) { ?> class="ws" <?php } ?> style="<?php echo $style; ?>">
                        <tr style="<?php echo $style; ?>">
                            <th style="<?php echo $style; ?>"></th>
                            <th style="<?php echo $style; ?>"><?php echo display('ord'); ?></th>
                            <!--<th><?php echo display('seat_time'); ?></th>      -->
                            <!--<th><?php echo display('person'); ?></th>-->
                            <th style="<?php echo $style; ?>"><?php echo display('action'); ?></th>

                        </tr>
                    </thead>
                    <tbody id="table-tbody-<?php echo $table['tableid']; ?>">
                        <?php if (!empty($table['table_details'])) {
                            foreach ($table['table_details'] as $table_details) {
                        ?>
                                <tr id="table-tr-<?php echo $table_details->id; ?>">
                                    <td>
                                        <button class="btn btn-success btn-large cusbtn" style="font-size: 14px;font-weight: bold;" onclick="editposorder(<?php echo $table_details->order_id; ?>, 1, <?php echo $table_details->user_view; ?>)">VER</button>
                                    </td>

                                    <td scope="row">
                                        <div style="color: white; background-color:blue;padding:5px;font-weight:bold;border-radius: 5px;font-size:18px;padding-left: 10px;padding-right: 10px;margin-left: 10px;">
                                            <?php echo $table_details->order_id; ?>

                                        </div>
                                    </td>
                                    <!-- <td><?php echo $table_details->time_enter; ?></td>-->
                                    <!--<td><?php echo $table_details->total_people; ?></td>-->

                                    <td>
                                        <button class="btn btn-error btn-large cusbtn" style="background-color: red;color:white;font-size: 14px;font-weight: bold;" onClick="deleterow_table(<?php echo $table_details->id; ?>)">LIBERAR</button>

                                    </td>

                                </tr>
                            <?php
                            } //end foreach
                        } //end if
                        else {
                            ?>
                            <tr>
                                <td>
                                    <h6><?php echo display('no_customer'); ?></h6>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>


                    </tbody>
                </table>
                <div class="extra_elem">

                    <form class="add_form">
                        <input type="number" style="display: hidden;" min="1" value="<?php echo $table['person_capicity'] - $table['sum']; ?>" class="form-control add_input" placeholder="<?php echo display('person') ?>" name="person-<?php echo $table['tableid']; ?>" id="person-<?php echo $table['tableid']; ?>">

                        <!-- <button type="button" onclick="checktable(<?php echo $table['tableid']; ?>)" class="btn add_btn">SELECCIONAR MESA <?php echo  $table['tablename']; ?></button>
                                        -->
                    </form>

                    <?php if (!empty($table['table_details'])) { ?>
                        <!--<button class="btn btn-clear" onClick="deleterow_table('9999',<?php echo $table['tableid']; ?>)"><?php echo display('clear') ?></button>-->
                    <?php } ?>
                    <hr />
                </div>
            </div>
        </div>

    <?php
        $rowCount++;
        if ($rowCount % $numOfCols == 0) echo '</div><div class="row kitchen-tab">';
    } ?>
</div>