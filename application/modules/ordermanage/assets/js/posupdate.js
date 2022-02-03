// JavaScript Document
$(window).load(function() {
    // Run code
    "use strict";
    $(".sidebar-mini").addClass('sidebar-collapse');
});
$(document).ready(function() {
    "use strict";
    // select 2 dropdown
    $("select.form-control:not(.dont-select-me)").select2({
        placeholder: "Select option",
        allowClear: true
    });
    //form validate
    $("#validate").validate();
    $("#add_category").validate();
    $("#customer_name").validate();
    $('.productclist').slimScroll({
        size: '3px',
        height: '345px',
        allowPageScroll: true,
        railVisible: true
    });
    $('.product-grid').slimScroll({
        size: '3px',
        height: '720px',
        allowPageScroll: true,
        railVisible: true
    });
});
$('body').on('keyup', '#update_product_name', function() {
    var product_name = $(this).val();
    var category_id = $('#category_id').val();
    var myurl = $('#posurl_update').val();
    var csrf = $('#csrfhashresarvation').val();
    $.ajax({
        type: "post",
        async: false,
        url: myurl,
        data: { product_name: product_name, category_id: category_id, csrf_test_name: csrf },
        success: function(data) {
            if (data == '420') {
                $("#product_search_update").html('NO HAY PRODUCTOS!');
            } else {
                $("#product_search_update").html(data);
            }
        },
        error: function() {
            alert(lang.req_failed);
        }
    });
});

function getslcategory_update(carid, category_name, color = null) {
    var product_name = $('#update_product_name').val();
    var category_id = carid;
    var myurl = $('#posurl_update').val();
    var csrf = $('#csrfhashresarvation').val();
    $.ajax({
        type: "post",
        async: false,
        url: myurl,
        data: { product_name: product_name, category_id: category_id, isuptade: 1, csrf_test_name: csrf },
        success: function(data) {
            if (data == '420') {
                $("#product_search_update").html('NO HAY PRODUCTOS!');
            } else {
                $("#product_search_update").html(data);
            }
            document.getElementById("category_active_update").innerHTML = category_name;
            if (color != null && color != "" && color != undefined) {
                document.getElementById("category_active_update").style.backgroundColor = color;
                document.getElementById("category_active_update").style.color = "white";
            } else {
                document.getElementById("category_active_update").style.backgroundColor = "white";
                document.getElementById("category_active_update").style.color = "#374767";
            }
        },
        error: function() {
            alert(lang.req_failed);
        }
    });
}
//Product search button js
$('body').on('click', '#search_button', function() {
    var product_name = $('#update_product_name').val();
    var category_id = $('#category_id').val();
    var myurl = $('#posurl_update').val();
    var csrf = $('#csrfhashresarvation').val();
    $.ajax({
        type: "post",
        async: false,
        url: myurl,
        data: { product_name: product_name, category_id: category_id, csrf_test_name: csrf },
        success: function(data) {
            if (data == '420') {
                $("#product_search_update").html('NO HAY PRODUCTOS!');
            } else {
                $("#product_search_update").html(data);
            }
        },
        error: function() {
            alert(lang.req_failed);
        }
    });
});

//Payment method toggle
$(document).ready(function() {
    if (orderinfo.isthirdparty > 0) {
        $("#nonthirdparty_update").hide();
        $("#thirdparty_update").show();
        $("#delivercom_update").prop('disabled', false);
        $("#waiter_update").prop('disabled', true);
        $("#tableid_update").prop('disabled', true);
        $("#cardarea_update").show();
    } else {
        if (orderinfo.cutomertype == 4) {
            $("#nonthirdparty_update").show();
            $("#thirdparty_update").hide();
            $("#tblsec_update").hide();
            $("#delivercom_update").prop('disabled', true);
            $("#waiter_update").prop('disabled', false);
            $("#tableid_update").prop('disabled', true);
            $("#cardarea_update").hide();
        } else if (orderinfo.cutomertype == 2) {
            $("#nonthirdparty_update").show();
            $("#thirdparty_update").hide();
            $("#tblsec_update").hide();
            $("#delivercom_update").prop('disabled', true);
            $("#waiter_update").prop('disabled', false);
            $("#tableid_update").prop('disabled', true);
            $("#cardarea_update").hide();
        } else {
            $("#nonthirdparty_update").show();
            $("#tblsec_update").show();
            $("#thirdparty_update").hide();
            $("#delivercom_update").prop('disabled', true);
            $("#waiter_update").prop('disabled', false);
            $("#tableid_update").prop('disabled', false);
            $("#cardarea_update").hide();
        }
    }

    $(".payment_button").click(function() {
        $(".payment_method").toggle();
        //Select Option
        $("select.form-control:not(.dont-select-me)").select2({
            placeholder: "Select option",
            allowClear: true
        });
    });

    $("#card_typesl").on('change', function() {
        var cardtype = $("#card_typesl").val();

        $("#card_type").val(cardtype);
        if (cardtype == 4) {
            $("#isonline").val(0);
            $("#cardarea").hide();
            $("#assigncard_terminal").val('');
            $("#assignbank").val('');
            $("#assignlastdigit").val('');
        } else if (cardtype == 1) {
            $("#isonline").val(0);
            $("#cardarea").show();
        } else {
            $("#isonline").val(1);
            $("#cardarea").hide();
            $("#assigncard_terminal").val('');
            $("#assignbank").val('');
            $("#assignlastdigit").val('');
        }

    });
    $("#ctypeid_update").on('change', function() {
        var customertype = $("#ctypeid_update").val();
        if (customertype == 3) {
            $("#delivercom_update").prop('disabled', false);
            $("#waiter_update").prop('disabled', true);
            $("#tableid_update").prop('disabled', true);
            $("#nonthirdparty_update").hide();
            $("#thirdparty_update").show();
        } else if (customertype == 4) {
            $("#nonthirdparty_update").show();
            $("#thirdparty_update").hide();
            $("#tblsec_update").hide();
            $("#delivercom_update").prop('disabled', true);
            $("#waiter_update").prop('disabled', false);
            $("#tableid_update").prop('disabled', true);
        } else if (customertype == 2) {
            $("#nonthirdparty_update").show();
            $("#tblsec_update").hide();
            $("#thirdparty_update").hide();
            $("#waiter_update").prop('disabled', false);
            $("#tableid_update").prop('disabled', false);
            $("#cookingtime_update").prop('disabled', false);
            $("#delivercom_update").prop('disabled', true);
        } else {
            $("#nonthirdparty_update").show();
            $("#tblsec_update").show();
            $("#thirdparty_update").hide();
            $("#delivercom_update").prop('disabled', true);
            $("#waiter_update").prop('disabled', false);
            $("#tableid_update").prop('disabled', false);
        }
    });
    $('.update_search-field').select2({
        placeholder: 'Select Product',
        minimumInputLength: 1,
        ajax: {
            url: 'getitemlistdroup',
            dataType: 'json',
            delay: 250,
            //data:{csrf_test_name:basicinfo.csrftokeng},
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {
                        return {
                            text: item.text + '-' + item.variantName,
                            id: item.id + '-' + item.variantid
                        }
                    })
                };
            },
            cache: true
        }
    });
});

function positemupdate(itemid, existqty, orderid, varientid, isgroup, auid, status) {
    if (status == 'add') {
        /*check production*/
        var productionsetting = $('#production_setting').val();
        if (productionsetting == 1) {
            var checkqty = existqty + 1;
            var checkvalue = checkproduction(itemid, varientid, checkqty);
            if (checkvalue == false) {
                return false;
            }

        }
        /*end checking*/
    }
    var csrf = $('#csrfhashresarvation').val();
    var dataString = "itemid=" + itemid + "&existqty=" + existqty + "&orderid=" + orderid + "&varientid=" + varientid + "&auid=" + auid + "&status=" + status + "&isgroup=" + isgroup + '&csrf_test_name=' + csrf;
    var myurl = basicinfo.baseurl + "ordermanage/order/itemqtyupdate";
    $.ajax({
        type: "POST",
        url: myurl,
        data: dataString,
        success: function(data) {
            $('#updatefoodlist').html(data);
            var total = $('#grtotal').val();
            var totalitem = $('#totalitem').val();
            $('#item-number').text(totalitem);
            $('#getitemp').val(totalitem);
            var tax = $('#tvat').val();

            var discount = $('#tdiscount').val();
            var tgtotal = $('#tgtotal').val();
            $('#calvat').text(tax);
            $('#invoice_discount').val(discount);
            var sc = $('#sc').val();
            $('#service_charge').val(sc);
            var tasa = $('#caltotal_tasa').val();
            $('#caltotal').text((tgtotal * 1).toFixed(2));
            $('#caltotal_total').text((tgtotal * tasa).toFixed(2));
            $('#grandtotal').val(tgtotal);
            $('#orggrandTotal').val(tgtotal);
            $('#orginattotal').val(tgtotal);
        }
    });
}

function updateProductQty(itemid, orderid) {
    var qty = null;
    swal({
            title: "INGRESE LA CANTIDAD",
            text: "",
            type: "input",
            inputType: "text",
            //showCancelButton: true,
            closeOnConfirm: true,
            animation: "slide-from-top",
            inputPlaceholder: "Cantidad"
        },
        function(inputValue) {
            if (inputValue === null) return false;
            /*if (inputValue === "") {
              swal.showInputError("");
              return false
            }*/
            qty = inputValue;
            if (qty != "" && qty != '0' && qty != undefined) {
                var csrf = $('#csrfhashresarvation').val();
                //var dataString = "itemid=" + itemid + "&existqty=" + existqty + "&orderid=" + orderid + "&varientid=" + varientid + "&auid=" + auid + "&status=" + status + "&isgroup=" + isgroup + '&csrf_test_name=' + csrf;
                var myurl = basicinfo.baseurl + "ordermanage/order/updateProductQty/" + itemid + "/" + qty + "/" + orderid;
                $.ajax({
                    type: "GET",
                    url: myurl,
                    //data: dataString,
                    success: function(data) {
                        //alert("Deleted Successfully!!!");
                        //swal("Anulacion", "Elemento eliminado. Anulacion enviada", "success");
                        $('#updatefoodlist').html(data);
                        //$('#addfoodlist').html(data);
                        var total = $('#grtotal').val();
                        var totalitem = $('#totalitem').val();
                        $('#item-number').text(totalitem);
                        $("#getitemp").val(totalitem);
                        var tax = $('#vat_update').val();
                        var discount = $('#tdiscount').val();
                        var tgtotal = $('#tgtotal').val();
                        $('#vat_update').text((tax));
                        $('#calvat_update').text((tax * 1).toFixed(2));
                        $('#vat').val(tax);
                        $('#invoice_discount').val(discount);
                        var sc = $('#sc').val();
                        $('#service_charge').val(sc);
                        var tasa = $('#caltotal_tasa').val();
                        $('#caltotal_update').text((tgtotal * 1).toFixed(2));
                        $('#caltotal_total_update').text((tgtotal * tasa).toFixed(2));
                        //$('#caltotal').text(tgtotal);
                        $('#grandtotal').val(tgtotal);
                        $('#orggrandTotal').val(tgtotal);
                        //$('#orginattotal').val(tgtotal);
                        $('#orginattotal_jose_ajuste').val(tgtotal);
                    }
                });
            }
        });
}