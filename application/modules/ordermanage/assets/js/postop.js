// JavaScript Document
"use strict";

function calcNumbers(result) {
    if (result == "C") {
        calc.displayResult.value = '';
    } else {
        calc.displayResult.value = calc.displayResult.value + result;
    }

}

function inputNumbers(result) {
    if (result == "C") {
        var totalpaid = 0;
        $("#paidamount").val('');
        $("#change").val('');
    } else {
        var paidamount = $("#paidamount").val();
        var totalpaid = paidamount + result;
        $("#paidamount").val(totalpaid);
        var maintotalamount = $("#maintotalamount").val();
        var restamount = (parseFloat(totalpaid)) - (parseFloat(maintotalamount));
        var changes = restamount.toFixed(2);
        $("#change").val(changes);
    }


}

function givefocus(element) {
    window.prevFocus = $(element);
}

function giveselecttab(element) {
    $("#uidupdateid").val('');
    $('#onprocesslist').empty();
    window.prevsltab = $(element);
    if (element.id == "ongoingorder") {
        localStorage.setItem('update_view', '1');
    } else {
        localStorage.setItem('update_view', null);
    }
    //window.history.forward(1);
    $('#addfoodlist').empty();
    $("#getitemp").val('0');
    $('#calvat').text('0');
    $('#vat').val('0');
    $('#invoice_discount').val('0');
    $('#caltotal').text('0');
    $('#caltotal_total').text('0');
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
    //======================================
    //--------------------------------------
    var csrf = $('#csrfhashresarvation').val();
    $.ajax({
        type: "GET",
        url: "posclear",
        data: { csrf_test_name: csrf },
        success: function(data) {
            console.log("Data limpiada!!!");
        }
    });
}

function inputNumbersfocus(result) {
    if (result == "C") {
        var totalpaid = 0;
        prevFocus.val(0);
        changedueamount()
    } else {
        if (prevFocus.val() == 0) {
            prevFocus.val("")
        }
        var paidamount = prevFocus.val();
        var totalpaid = paidamount + result;
        prevFocus.val(totalpaid);
        changedueamount()
    }
}