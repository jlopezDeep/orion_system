//all js 
function itemlist() {
    var geturl = $("#url").val();
    var id = $("#catid").val();
    var csrf = $('#csrfhashresarvation').val();
    var myurl = geturl;
    var dataString = "id=" + id + '&csrf_test_name=' + csrf;

    $.ajax({
        type: "POST",
        url: myurl,
        data: dataString,
        success: function(data) {
            $('.iteminfo').html(data);
            $('#items').modal('show');
        }
    });
}




function addfoodtocart(pid, id) {
    var geturl = $("#carturl").val();
    var itemname = $("#itemname_" + id).val();
    var sizeid = $("#sizeid_" + id).val();
    var varientname = $("#size_" + id).val();
    var qty = $("#itemqty_" + id).val();
    var price = $("#itemprice_" + id).val();
    var catid = $("#catid").val();
    var updateid = $("#updateid").val();
    var csrf = $('#csrfhashresarvation').val();
    var myurl = geturl;
    if (updateid == '') {
        var dataString = "pid=" + pid + '&itemname=' + itemname + '&varientname=' + varientname + '&qty=' + qty + '&price=' + price + '&catid=' + catid + '&sizeid=' + sizeid + '&csrf_test_name=' + csrf;
    } else {
        var updateid = $("#uidupdateid").val();
        var dataString = "pid=" + pid + '&itemname=' + itemname + '&varientname=' + varientname + '&qty=' + qty + '&price=' + price + '&catid=' + catid + '&sizeid=' + sizeid + '&orderid=' + updateid + '&csrf_test_name=' + csrf;
    }
    $.ajax({
        type: "POST",
        url: myurl,
        data: dataString,
        success: function(data) {
            if (updateid == '') {
                $('#cartlist').html(data);
                var tax = $('#tvat').val();
                var discount = $('#tdiscount').val();
                var tgtotal = $('#tgtotal').val();
                $('#calvat').text(tax);
                $('#invoice_discount').val(discount);
                var sc = $('#sc').val();
                $('#service_charge').val(sc);
                //$('#caltotal').text(tgtotal);
                var tasa = $('#caltotal_tasa').val();
                $('#caltotal').text((tgtotal * 1).toFixed(2));
                $('#caltotal_total').text((tgtotal * tasa).toFixed(2));
                $('#grandtotal').val(tgtotal);
                $('#orggrandTotal').val(tgtotal);
            } else {
                $('#updatetlist').html(data);
                var tax = $('#tvat').val();
                var discount = $('#tdiscount').val();
                var tgtotal = $('#tgtotal').val();
                $('#calvat').text(tax);
                $('#invoice_discount').val(discount);
                var sc = $('#sc').val();
                $('#service_charge').val(sc);
                //$('#caltotal').text(tgtotal);
                var tasa = $('#caltotal_tasa').val();
                $('#caltotal').text((tgtotal * 1).toFixed(2));
                $('#caltotal_total').text((tgtotal * tasa).toFixed(2));
                $('#grandtotal').val(tgtotal);
                $('#orggrandTotal').val(tgtotal);
            }
        }
    });
}


function updatecart(id, qty, status) {
    if (status == "del" && qty == 0) {
        return false;
    } else {
        var geturl = $("#cartupdateturl").val();
        var csrf = $('#csrfhashresarvation').val();
        var dataString = "CartID=" + id + "&qty=" + qty + "&Udstatus=" + status + '&csrf_test_name=' + csrf;
        $.ajax({
            type: "POST",
            url: geturl,
            data: dataString,
            success: function(data) {
                $('#cartlist').html(data);
                var tax = $('#tvat').val();
                var discount = $('#tdiscount').val();
                var tgtotal = $('#tgtotal').val();
                $('#calvat').text(tax);
                $('#invoice_discount').val(discount);
                var sc = $('#sc').val();
                $('#service_charge').val(sc);
                $('#caltotal').text((tgtotal * 1).toFixed(2));
                $('#grandtotal').val(tgtotal);
                $('#orggrandTotal').val(tgtotal);
            }
        });
    }
}



function updatecartqty(id) {
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
                //var dataString = "CartID=" + id + "&qty=" + qty + "&Udstatus=" + status + '&csrf_test_name=' + csrf;
                $.ajax({
                    type: "GET",
                    url: "cartupdateQty/" + id + "/" + qty,
                    //data: dataString,
                    success: function(data) {
                        $('#addfoodlist').html(data);
                        var total = $('#grtotal').val();
                        var totalitem = $('#totalitem').val();
                        $('#item-number').text(totalitem);
                        $("#getitemp").val(totalitem);
                        var tax = $('#tvat').val();
                        var discount = $('#tdiscount').val();
                        var tgtotal = $('#tgtotal').val();
                        $('#calvat').text((tax * 1).toFixed(2));
                        $('#vat').val(tax);
                        $('#invoice_discount').val(discount);
                        var sc = $('#sc').val();
                        $('#service_charge').val(sc);
                        var tasa = $('#caltotal_tasa').val();
                        $('#caltotal').text((tgtotal * 1).toFixed(2));
                        $('#caltotal_total').text((tgtotal * tasa).toFixed(2));
                        //$('#caltotal').text(tgtotal);
                        $('#grandtotal').val(tgtotal);
                        $('#orggrandTotal').val(tgtotal);
                        postupdateorder_ajax(1);
                    }
                });
            }
        });
}

function posupdatecart(id, pid, vid, qty, status) {
    if (status == "del" && qty == 0) {
        return false;
    } else {
        if (status == 'add') {
            /*check production*/
            var productionsetting = $('#production_setting').val();
            if (productionsetting == 1) {
                var checkqty = qty + 1;
                var checkvalue = checkproduction(pid, vid, checkqty);

                if (checkvalue == false) {
                    return false;
                }

            }
            /*end checking*/
        }
        var csrf = $('#csrfhashresarvation').val();
        //var mysound = baseurl + "assets/";
        //var audio = ["beep-08b.mp3"];
        //new Audio(mysound + audio[0]).play();
        var geturl = $("#cartupdateturl").val();
        var dataString = "CartID=" + id + "&qty=" + qty + "&Udstatus=" + status + '&csrf_test_name=' + csrf;
        $.ajax({
            type: "POST",
            url: geturl,
            data: dataString,
            success: function(data) {
                $('#addfoodlist').html(data);
                var total = $('#grtotal').val();
                var totalitem = $('#totalitem').val();
                $('#item-number').text(totalitem);
                $("#getitemp").val(totalitem);
                var tax = $('#tvat').val();
                var discount = $('#tdiscount').val();
                var tgtotal = $('#tgtotal').val();
                $('#calvat').text(tax);
                $('#vat').val(tax);
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
}

function removecart(rid) {
    /*swal({
            title: "Esta seguro que desea eliminar este elemento?",
            text: "Al eliminarlo no podra recuperarlo a menos que lo vuelva a enviar",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            confirmButtonText: "SI, Borralo",
            cancelButtonText: "NO",
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) {*/
    var geturl = $("#removeurl").val();
    var csrf = $('#csrfhashresarvation').val();
    var dataString = "rowid=" + rid + '&csrf_test_name=' + csrf;
    var mysound = baseurl + "assets/";
    //var audio =["beep-08b.mp3"];
    //new Audio(mysound + audio[0]).play();
    $.ajax({
        type: "POST",
        url: geturl,
        data: dataString,
        success: function(data) {
            $('#addfoodlist').html(data);
            var total = $('#grtotal').val();
            var totalitem = $('#totalitem').val();
            $('#item-number').text(totalitem);
            $("#getitemp").val(totalitem);
            var tax = $('#tvat').val();
            var discount = $('#tdiscount').val();
            var tgtotal = $('#tgtotal').val();
            $('#calvat').text((tax * 1).toFixed(2));
            $('#vat').val(tax);
            $('#invoice_discount').val(discount);
            var sc = $('#sc').val();
            $('#service_charge').val(sc);
            var tasa = $('#caltotal_tasa').val();
            $('#caltotal').text((tgtotal * 1).toFixed(2));
            $('#caltotal_total').text((tgtotal * tasa).toFixed(2));
            //$('#caltotal').text(tgtotal);
            $('#grandtotal').val(tgtotal);
            $('#orggrandTotal').val(tgtotal);
            postupdateorder_ajax(1);
        }
    });

    /* } else {
         //swal("Cancelled", "Your module file is safe :)", "success");
     }
 });*/


}

function addonsitem(id, sid) {
    var geturl = $("#addonsurl").val();
    var csrf = $('#csrfhashresarvation').val();
    var myurl = geturl + '/' + id;
    var dataString = "pid=" + id + "&sid=" + sid + '&csrf_test_name=' + csrf;
    $.ajax({
        type: "POST",
        url: myurl,
        data: dataString,
        success: function(data) {
            $('.addonsinfo').html(data);
            $('#edit').modal('show');
        }
    });
}

function posaddonsitem(id, sid) {
    var geturl = $("#addonsurl").val();
    var csrf = $('#csrfhashresarvation').val();
    var myurl = geturl + '/' + id;
    var dataString = "pid=" + id + "&sid=" + sid + '&csrf_test_name=' + csrf;
    $.ajax({
        type: "POST",
        url: myurl,
        data: dataString,
        success: function(data) {
            $('.addonsinfo').html(data);
            $('#edit').modal('show');
        }
    });
}

function addonsfoodtocart(pid, id) {
    var addons = [];
    var adonsqty = [];
    var allprice = 0;
    var adonsprice = [];
    var adonsname = [];
    $('input[name="addons"]:checked').each(function() {
        var adnsid = $(this).val();
        var adsqty = $('#addonqty_' + adnsid).val();
        adonsqty.push(adsqty);
        addons.push($(this).val());

        allprice += parseFloat($(this).attr('role')) * parseInt(adsqty);
        adonsprice.push($(this).attr('role'));
        adonsname.push($(this).attr('title'));
    });
    var catid = $("#catid").val();
    var csrf = $('#csrfhashresarvation').val();
    var itemname = $("#itemname_" + id).val();
    var sizeid = $("#sizeid_" + id).val();
    var varientname = $("#size_" + id).val();
    var qty = $("#itemqty_" + id).val();
    var price = $("#itemprice_" + id).val();
    var updateid = $("#updateid").val();
    if (updateid == '') {
        var geturl = $("#carturl").val();
        var myurl = geturl;
        var dataString = "pid=" + pid + '&itemname=' + itemname + '&varientname=' + varientname + '&qty=' + qty + '&price=' + price + '&catid=' + catid + '&sizeid=' + sizeid + '&addonsid=' + addons + '&allprice=' + allprice + '&adonsunitprice=' + adonsprice + '&adonsqty=' + adonsqty + '&adonsname=' + adonsname + '&csrf_test_name=' + csrf;
    } else {
        var updateid = $("#uidupdateid").val();
        var geturl = $("#updatecarturl").val();
        var myurl = geturl;
        var dataString = "pid=" + pid + '&itemname=' + itemname + '&varientname=' + varientname + '&qty=' + qty + '&price=' + price + '&catid=' + catid + '&sizeid=' + sizeid + '&addonsid=' + addons + '&allprice=' + allprice + '&adonsunitprice=' + adonsprice + '&adonsqty=' + adonsqty + '&adonsname=' + adonsname + '&orderid=' + updateid + '&csrf_test_name=' + csrf;
    }
    $.ajax({
        type: "POST",
        url: myurl,
        data: dataString,
        success: function(data) {
            if (updateid == '') {
                $('#cartlist').html(data);
                $('#edit').modal('hide');
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
            } else {
                $('#updatetlist').html(data);
                $('#edit').modal('hide');
                var tax = $('#tvat').val();
                var discount = $('#tdiscount').val();
                var sc = $('#sc').val();
                $('#service_charge').val(sc);
                var tgtotal = $('#tgtotal').val();
                $('#calvat').text(tax);
                $('#invoice_discount').val(discount);
                $('#caltotal').text((tgtotal * 1).toFixed(2));
                $('#grandtotal').val(tgtotal);
                $('#orggrandTotal').val(tgtotal);
                $('#orginattotal').val(tgtotal);
            }
        }
    });

}
$(document).on('change', '#varientinfo', function() {
    var id = $("#varientinfo").val();
    var name = $('#varientinfo option:selected').data('title');
    var price = $('#varientinfo option:selected').data('price');
    $("#sizeid_1").val(id);
    $("#size_1").val(name);
    $("#itemprice_1").val(price);
    $("#vprice").text(price);

});

function posaddonsfoodtocart(pid, id, more = null) {

    var addons = [];
    var adonsqty = [];
    var allprice = 0;
    var adonsprice = [];
    var adonsname = [];
    var csrf = $('#csrfhashresarvation').val();
    $('input[name="addons"]:checked').each(function() {
        var adnsid = $(this).val();
        var adsqty = $('#addonqty_' + adnsid).val();
        adonsqty.push(adsqty);
        addons.push($(this).val());

        allprice += parseFloat($(this).attr('role')) * parseInt(adsqty);
        adonsprice.push($(this).attr('role'));
        adonsname.push($(this).attr('title'));
    });
    var geturl = $("#carturl").val();
    var catid = $("#catid").val();
    var totalvarient = $("#totalvarient").val();
    var customqty = $("#customqty").val();
    var itemname = $("#itemname_" + id).val();
    var sizeid = $("#sizeid_" + id).val();
    var varientname = $("#size_" + id).val();
    var qty = $("#itemqty_" + id).val();
    var price = $("#itemprice_" + id).val();
    var isgroup = $("#isgroup").val();
    var updateid = $("#uidupdateid").val();
    var myurl = geturl;
    //var mysound = baseurl + "assets/";
    //var audio = ["beep-08b.mp3"];
    //new Audio(mysound + audio[0]).play();
    if (typeof updateid == "undefined") {
        /*check production*/
        var productionsetting = $('#production_setting').val();
        if (productionsetting == 1) {

            var isselected = $('#productionsetting-' + pid + '-' + sizeid).length;

            if (isselected == 1) {

                var checkqty = parseInt($('#productionsetting-' + pid + '-' + sizeid).text()) + qty;


            } else {
                var checkqty = qty;
            }

            var checkvalue = checkproduction(pid, sizeid, checkqty);

            if (checkvalue == false) {
                return false;
            }

        }
        /*end checking*/
        var geturl = $("#carturl").val();
        var myurl = geturl;
        var dataString = "pid=" + pid + '&itemname=' + itemname + '&varientname=' + varientname + '&qty=' + qty + '&price=' + price + '&catid=' + catid + '&sizeid=' + sizeid + '&addonsid=' + addons + '&allprice=' + allprice + '&adonsunitprice=' + adonsprice + '&adonsqty=' + adonsqty + '&adonsname=' + adonsname + '&isgroup=' + isgroup + '&totalvarient=' + totalvarient + '&customqty=' + customqty + '&csrf_test_name=' + csrf;
    } else {
        /*check production*/
        var productionsetting = $('#production_setting').val();
        if (productionsetting == 1) {

            var isselected = $('#productionsetting-update-' + pid + '-' + sizeid).length;

            if (isselected == 1) {
                var checkqty = parseInt($('#productionsetting-update-' + pid + '-' + sizeid).text()) + qty;
            } else {
                var checkqty = qty;
            }

            var checkvalue = checkproduction(pid, sizeid, checkqty);
            if (checkvalue == false) {
                return false;
            }

        }
        /*end checking*/
        var geturl = $("#updatecarturl").val();
        var myurl = geturl;
        var dataString = "pid=" + pid + '&itemname=' + itemname + '&varientname=' + varientname + '&qty=' + qty + '&price=' + price + '&catid=' + catid + '&sizeid=' + sizeid + '&addonsid=' + addons + '&allprice=' + allprice + '&adonsunitprice=' + adonsprice + '&adonsqty=' + adonsqty + '&adonsname=' + adonsname + '&orderid=' + updateid + '&isgroup=' + isgroup + '&totalvarient=' + totalvarient + '&customqty=' + customqty + '&csrf_test_name=' + csrf;
    }
    $.ajax({
        type: "POST",
        url: myurl,
        data: dataString,
        success: function(data) {
            if (typeof updateid == "undefined") {
                $('#addfoodlist').html(data);
            } else {
                $('#updatefoodlist').html(data);
            }

            var total = $('#grtotal').val();
            var totalitem = $('#totalitem').val();
            $('#item-number').text(totalitem);

            var tax = $('#tvat').val();
            if (tax == undefined) {
                tax = $('#vat_update').val();
            }
            var discount = $('#tdiscount').val();
            var tgtotal = $('#tgtotal').val();
            if ($('#calvat') != null)
                $('#calvat').text((tax * 1).toFixed(2));
            $('#vat').val(tax);
            $('#invoice_discount').val(discount);
            var sc = $('#sc').val();
            $('#service_charge').val(sc);
            var tasa = $('#caltotal_tasa').val();
            $('#caltotal').text((tgtotal * 1).toFixed(2));
            $('#caltotal_total').text((tgtotal * tasa).toFixed(2));

            $('#grandtotal').val(tgtotal);
            $('#orggrandTotal').val(tgtotal);
            $('#orginattotal').val(tgtotal);

            //if ($('#calvat_update') != null) {
            $('#calvat_update').text((tax * 1).toFixed(2));
            $('#caltotal_update').text((tgtotal * 1).toFixed(2));
            $('#caltotal_total_update').text((tgtotal * tasa).toFixed(2));
            //}
            if (more != 1) {
                $('#edit').modal('hide');
            }
            if (document.getElementById('product-list') != null)
                document.getElementById('product-list').scrollTop = document.getElementById('product-list').scrollHeight;
            if (document.getElementById('product-list-update'))
                document.getElementById('product-list-update').scrollTop = document.getElementById('product-list-update').scrollHeight;
        }
    });
}

function deletecart(id, orderid, pid, vid, qty, isupdate) {

    var password = null;
    if (isupdate == 0 || isupdate == '' || isupdate == undefined) {
        swal({
                title: "INGRESE LA CLAVE DE GERENTE",
                text: "Esta operacion requiere permisos especiales que solo un gerente con clave puede hacer.",
                type: "input",
                inputType: "password",
                //showCancelButton: true,
                closeOnConfirm: true,
                animation: "slide-from-top",
                inputPlaceholder: "Ingrese su Clave de Gerente"
            },
            function(inputValue) {
                if (inputValue === null) return false;
                /*if (inputValue === "") {
                  swal.showInputError("");
                  return false
                }*/
                password = inputValue;
                var url = 'validatePasswordMain/' + password;
                var csrf = $('#csrfhashresarvation').val();
                $.ajax({
                    type: "GET",
                    url: url,
                    data: { csrf_test_name: csrf },
                    success: function(data) {
                        //alert(data); //
                        if (password == data) {
                            var geturl = $("#delurl").val();
                            var csrf = $('#csrfhashresarvation').val();
                            var dataString = "mid=" + id + "&orderid=" + orderid + "&pid=" + pid + "&vid=" + vid + "&qty=" + qty + '&csrf_test_name=' + csrf + '&isupdate=' + 0;
                            $.ajax({
                                type: "POST",
                                url: geturl,
                                data: dataString,
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

                                    $.ajax({
                                        type: "GET",
                                        url: "validateProductNoSend/" + orderid,
                                        data: { csrf_test_name: csrf },
                                        success: function(data) {
                                            console.log("Data validada!!!");
                                            //alert(data.length);
                                            if (data.length == 0) {

                                                //postupdateorder_ajax(1);
                                            }
                                        }
                                    });

                                    //postupdateorder_ajax(1);
                                    //$('#caltotal').text((tgtotal * 1).toFixed(2));
                                    //$('#caltotal_total').text((tgtotal * tasa).toFixed(2));
                                }
                            });
                        } else {
                            //swal("Error de Clave", "La clave ingresada es incorrecta", "error");
                        }
                    }
                });
                //swal("Nice!", "You wrote: " + inputValue, "success");
            });
    } else {
        var url = 'validatePasswordMain/' + password;
        var csrf = $('#csrfhashresarvation').val();

        var geturl = $("#delurl").val();
        var csrf = $('#csrfhashresarvation').val();
        var dataString = "mid=" + id + "&orderid=" + orderid + "&pid=" + pid + "&vid=" + vid + "&qty=" + qty + '&csrf_test_name=' + csrf + '&isupdate=' + 1;
        $.ajax({
            type: "POST",
            url: geturl,
            data: dataString,
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
                //$('#caltotal').text((tgtotal * 1).toFixed(2));
                //$('#caltotal_total').text((tgtotal * tasa).toFixed(2));
            }
        });
    }
    //===================================================================
}

function expand(id) {
    var classes = $("#expandcol_" + id).attr('class').split(' ')[1];
    if ($("#expandcol_" + id).hasClass("hasaddons")) {
        $("." + classes).removeClass("hasaddons");
    } else {
        $("." + classes).addClass("hasaddons");
    }

}

function calculatetotal() {
    var total_price = 0;
    var inv_dis = 0;
    var ser_chg = 0;
    var subtotal = 0;
    var vat = 0;

    total_price = $("#orggrandTotal").val();
    subtotal = $("#subtotal").val();
    inv_dis = $("#invoice_discount").val();
    if (inv_dis == '') {
        inv_dis = 0;
    }
    ser_chg = $("#service_charge").val();
    if (ser_chg == '') {
        ser_chg = 0;
    }
    vat = $("#vat").val();
    if (vat == '') {
        vat = 0;
    }

    distype = $("#distype").val();
    if (distype == 1) {
        inv_dis = parseFloat(subtotal) * parseFloat(inv_dis) / 100;
    }
    sdtype = $("#sdtype").val();
    if (sdtype == 1) {
        ser_chg = parseFloat(subtotal) * parseFloat(ser_chg) / 100;
    }

    var totalamount = parseFloat(subtotal) + parseFloat(vat);
    var sum = parseFloat(totalamount) + parseFloat(ser_chg) - parseFloat(inv_dis);
    var sum = sum.toFixed(2);
    $("#grandtotal").val(sum);
    //$("#orginattotal").val(sum);
    $('#orginattotal_jose_ajuste').val(sum);
    var tasa = $('#caltotal_tasa').val();
    $('#caltotal').text(sum);
    $('#caltotal_total').text((sum * tasa).toFixed(2));
    //alert(sum);
    if (sum == undefined || sum == NaN) {
        $('#caltotal').text(0);
        $('#caltotal_total').text((0 * tasa).toFixed(2));
    }
    /*var csrf = $('#csrfhashresarvation').val();
    $.ajax({
        type: "GET",
        url: "validateProductNoSend/" + id,
        data: { csrf_test_name: csrf },
        success: function(data) {
            console.log("Data validada!!!");
            //alert(data.length);
            if (data.length == 0) {

                postupdateorder_ajax(1);
            }
        }
    });*/

}

function sumcalculation(id = null) {
    var total_price = 0;
    var inv_dis = 0;
    var ser_chg = 0;
    var subtotal = 0;
    var vat = 0;
    var totalamount = 0;
    if (id != '') {
        total_price = $("#orginattotal_update").val();
        inv_dis = $("#invoice_discount_update").val();
    } else {
        total_price = $("#orginattotal").val();
        inv_dis = $("#discount").val();
    }
    if (inv_dis == '') {
        inv_dis = 0;
    }
    if (id != '') {
        ser_chg = $("#service_charge_update").val();
    } else {
        ser_chg = $("#scharge").val();
    }
    if (ser_chg == '') {
        ser_chg = 0;
    }
    if (id != '') {
        subtotal = $("#subtotal_update").val();
    } else {
        subtotal = $("#subtotal").val();
    }
    if (subtotal == '') {
        subtotal = 0;
    }
    if (id != '') {
        vat = $("#vat_update").val();
    } else {
        vat = $("#vat").val();
    }

    if (vat == '') {
        vat = 0;
    }
    if (id != '') {
        distype = $("#distype_update").val();
    } else {
        distype = $("#distype").val();
    }
    if (distype == 1) {
        inv_dis = parseFloat(subtotal) * parseFloat(inv_dis) / 100;
    }
    if (id != '') {
        sdtype = $("#sdtype_update").val();
    } else {
        sdtype = $("#sdtype").val();
    }
    if (sdtype == 1) {
        ser_chg = parseFloat(subtotal) * parseFloat(ser_chg) / 100;
    }
    var totalamount = parseFloat(subtotal) + parseFloat(vat);
    var sum = parseFloat(totalamount) + parseFloat(ser_chg) - parseFloat(inv_dis);
    var sum = sum.toFixed(2);
    if (id != '') {
        /*$("#grandtotal_update").val(sum);
        $("#orginattotal_update").val(sum);
        $("#gtotal_update").text(sum);*/
        //===============================
        var tasa = $('#caltotal_tasa').val();
        $('#caltotal_update').text((sum * 1).toFixed(2));
        $('#caltotal_total_update').text((sum * tasa).toFixed(2));
        $('#orginattotal_jose_ajuste').val(sum);
        //--------------------------------------------
        var csrf = $('#csrfhashresarvation').val();
        $.ajax({
            type: "GET",
            url: "validateProductNoSend/" + id,
            data: { csrf_test_name: csrf },
            success: function(data) {
                console.log("Data validada!!!");
                //alert(data.length);
                if (data.length == 0) {
                    postupdateorder_ajax(1);
                }
            }
        });
    } else {
        $("#grandtotal").val(sum);
        //$("#orginattotal").val(sum);
        $('#orginattotal_jose_ajuste').val(sum);
        $("#gtotal").text(sum);
    }


}




function getAjaxModal(url, callback = false, ajaxclass = '#modal-ajaxview', modalclass = '#payprint_marge', data = '', method = 'get') {
    var csrf = $('#csrfhashresarvation').val();
    var fulldata = data + '&csrf_test_name=' + csrf;
    $.ajax({
        url: url,
        type: method,
        data: fulldata,
        beforeSend: function(xhr) {

        },
        success: function(result) {

            $(modalclass).modal('show');
            if (callback) {
                callback(result);
                return;
            }
            $(ajaxclass).html(result);
            $('#add_new_payment').empty();


        }
    });
}

function checkproduction(foodid, vid, servingqty) {
    var myurl = $('#production_url').val();
    var csrf = $('#csrfhashresarvation').val();
    var dataString = "foodid=" + foodid + '&vid=' + vid + '&qty=' + servingqty + '&csrf_test_name=' + csrf;

    var check = true;
    $.ajax({
        type: "POST",
        url: myurl,
        async: false,
        global: false,
        data: dataString,
        success: function(data) {

            if (data != 1) {
                swal("Receta", data, "success");
                //alert(data);
                check = false;
            }


        }
    });
    return check;
}

//Product search button js
$('body').on('click', '.update_select_product', function(e) {
    $('#addfoodlist').empty();
    $("#getitemp").val('0');
    $('#calvat').text('0');
    $('#vat').val('0');
    $('#invoice_discount').val('0');
    $('#caltotal').text('');
    $('#caltotal_total').text('');
    $('#grandtotal').val('');
    $('#thirdinvoiceid').val('');
    $('#orggrandTotal').val('');
    $('#waiter').select2('data', null);
    $('#tableid').select2('data', null);
    $('#waiter').val('');

    $('#table_member').val('');
    $('#table_person').val(lang.person);
    $('#table_member_multi').val(0);
    $('#table_member_multi_person').val(0);
    //========================================
    e.preventDefault();
    var panel = $(this);
    var pid = panel.find('.panel-body input[name=update_select_product_id]').val();
    var totalvarient = panel.find('.panel-body input[name=update_select_totalvarient]').val();
    var customqty = panel.find('.panel-body input[name=update_select_iscustomeqty]').val();
    var sizeid = panel.find('.panel-body input[name=update_select_product_size]').val();
    var isgroup = panel.find('.panel-body input[name=update_select_product_isgroup]').val();
    var catid = panel.find('.panel-body input[name=update_select_product_cat]').val();
    var itemname = panel.find('.panel-body input[name=update_select_product_name]').val();
    var varientname = panel.find('.panel-body input[name=update_select_varient_name]').val();
    var qty = 1;
    var price = panel.find('.panel-body input[name=update_select_product_price]').val();
    var hasaddons = panel.find('.panel-body input[name=update_select_addons]').val();
    var existqty = $('#select_qty_' + pid + '_' + sizeid).val();
    var csrf = $('#csrfhashresarvation').val();
    if (existqty === undefined) {
        var existqty = 0;
    } else {
        var existqty = $('#select_qty_' + pid + '_' + sizeid).val();
    }
    var qty = parseInt(qty);
    var updateid = $("#saleinvoice").val();
    if (hasaddons == 0 && totalvarient == 1 && customqty == 0) {
        /*check production*/
        var productionsetting = $('#production_setting').val();
        if (productionsetting == 1) {

            var isselected = $('#productionsetting-update-' + pid + '-' + sizeid).length;

            if (isselected == 1) {

                var checkqty = parseInt($('#productionsetting-update-' + pid + '-' + sizeid).text()) + qty;


            } else {
                var checkqty = qty;
            }

            var checkvalue = checkproduction(pid, sizeid, checkqty);

            if (checkvalue == false) {
                return false;
            }

        }
        /*end checking*/
        //var mysound = baseurl + "assets/";
        //var audio = ["beep-08b.mp3"];
        //new Audio(mysound + audio[0]).play();
        //alert("Chao");
        var myurl = $('#updatecarturl').val();
        var dataString = "pid=" + pid + '&itemname=' + itemname + '&varientname=' + varientname + '&qty=' + qty + '&price=' + price + '&catid=' + catid + '&sizeid=' + sizeid + '&isgroup=' + isgroup + '&orderid=' + updateid + '&totalvarient=' + totalvarient + '&customqty=' + customqty + '&csrf_test_name=' + csrf;
        $.ajax({
            type: "POST",
            url: myurl,
            data: dataString,
            success: function(data) {
                $('#updatefoodlist').html(data);
                var total = $('#grtotal').val();
                var totalitem = $('#totalitem').val();
                $('#item-number').text(totalitem);
                //$('#getitemp').val(totalitem);
                var tax = $('#vat_update').val();

                var discount = $('#tdiscount').val();
                var tgtotal = $('#tgtotal').val();
                //$('#calvat').text(tax);
                $('#calvat_update').text((tax * 1).toFixed(2));
                $('#invoice_discount').val(discount);
                var sc = $('#sc').val();
                $('#service_charge').val(sc);
                var tasa = $('#caltotal_tasa').val();
                $('#caltotal_update').text((tgtotal * 1).toFixed(2));
                $('#caltotal_total_update').text((tgtotal * tasa).toFixed(2));
                $('#grandtotal').val(tgtotal);
                $('#orggrandTotal').val(tgtotal);
                $('#orginattotal_jose_ajuste').val(tgtotal);
                //$('#orginattotal_jose_ajuste').type = "text";
                //alert(tgtotal);
                //postupdateorder_ajax(1);
                document.getElementById('product-list-update').scrollTop = document.getElementById('product-list-update').scrollHeight;
            }
        });
    } else {
        //alert("Hola");
        var geturl = $("#addonexsurl").val();
        var myurl = geturl + '/' + pid;
        var dataString = "pid=" + pid + "&sid=" + sizeid + "&id=" + catid + "&totalvarient=" + totalvarient + "&customqty=" + customqty + '&csrf_test_name=' + csrf;
        $.ajax({
            type: "POST",
            url: geturl,
            data: dataString,
            success: function(data) {
                $('.addonsinfo').html(data);
                $('#edit').modal('show');
                var tax = $('#vat_update').val();
                var discount = $('#tdiscount').val();
                var tgtotal = $('#tgtotal').val();
                $('#vat').val(tax);
                //$('#calvat').text(tax);
                $('#calvat_update').text((tax * 1).toFixed(2));
                $('#invoice_discount').val(discount);
                var tasa = $('#caltotal_tasa').val();
                $('#caltotal_update').text((tgtotal * 1).toFixed(2));
                $('#caltotal_total_update').text((tgtotal * tasa).toFixed(2));
                $('#grandtotal').val(tgtotal);
                $('#orggrandTotal').val(tgtotal);
                //$('#orginattotal').val(tgtotal);
                $('#orginattotal_jose_ajuste').val(tgtotal);
                document.getElementById('product-list-update').scrollTop = document.getElementById('product-list-update').scrollHeight;
            }
        });
    }
});