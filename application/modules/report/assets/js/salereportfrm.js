"use strict";

function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    document.body.style.marginTop = "0px";
    window.print();
    document.body.innerHTML = originalContents;
}

function getreport() {
    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();
    var paytype = $('#paytype').val();
    var invoie_no = $('#invoie_no').val();
    var journal = $('#journal').val();
    var is_gif = $('#is_gif').prop("checked");
    if (is_gif) {
        is_gif = 1;
    } else {
        is_gif = 0;
    }
    //alert(is_gif);
    if (is_gif == 1) {
        var password = null;
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
                        if (password == data) {
                            if (from_date == '') {
                                alert("Please select from date");
                                return false;
                            }
                            if (to_date == '') {
                                alert("Please select To date");
                                return false;
                            }
                            var myurl = baseurl + 'report/reports/salereport';
                            var csrf = $('#csrfhashresarvation').val();
                            var dataString = "is_gif=" + is_gif + "&journal=" + journal + "&from_date=" + from_date + '&to_date=' + to_date + '&paytype=' + paytype + '&invoie_no=' + invoie_no + '&csrf_test_name=' + csrf;
                            $.ajax({
                                type: "POST",
                                url: myurl,
                                data: dataString,
                                success: function(data) {
                                    $('#getresult2').html(data);
                                    $('#respritbl').DataTable({
                                        responsive: true,
                                        paging: true,
                                        dom: 'Bfrtip',
                                        "lengthMenu": [
                                            [25, 50, 100, 150, 200, 500, -1],
                                            [25, 50, 100, 150, 200, 500, "All"]
                                        ],
                                        buttons: [
                                            { extend: 'copy', className: 'btn-sm', footer: true },
                                            { extend: 'csv', title: 'Report', className: 'btn-sm', footer: true },
                                            { extend: 'excel', title: 'Report', className: 'btn-sm', title: 'exportTitle', footer: true },
                                            { extend: 'pdf', title: 'Report', className: 'btn-sm', footer: true },
                                            { extend: 'print', className: 'btn-sm', footer: true },
                                            { extend: 'colvis', className: 'btn-sm', footer: true }
                                        ],
                                        "searching": true,
                                        "processing": true,

                                    });
                                }
                            });
                        }
                    }
                });
            });
    } else {
        if (from_date == '') {
            alert("Please select from date");
            return false;
        }
        if (to_date == '') {
            alert("Please select To date");
            return false;
        }
        var myurl = baseurl + 'report/reports/salereport';
        var csrf = $('#csrfhashresarvation').val();
        var dataString = "is_gif=" + is_gif + "&journal=" + journal + "&from_date=" + from_date + '&to_date=' + to_date + '&paytype=' + paytype + '&invoie_no=' + invoie_no + '&csrf_test_name=' + csrf;
        $.ajax({
            type: "POST",
            url: myurl,
            data: dataString,
            success: function(data) {
                $('#getresult2').html(data);
                $('#respritbl').DataTable({
                    responsive: true,
                    paging: true,
                    dom: 'Bfrtip',
                    "lengthMenu": [
                        [25, 50, 100, 150, 200, 500, -1],
                        [25, 50, 100, 150, 200, 500, "All"]
                    ],
                    buttons: [
                        { extend: 'copy', className: 'btn-sm', footer: true },
                        { extend: 'csv', title: 'Report', className: 'btn-sm', footer: true },
                        { extend: 'excel', title: 'Report', className: 'btn-sm', title: 'exportTitle', footer: true },
                        { extend: 'pdf', title: 'Report', className: 'btn-sm', footer: true },
                        { extend: 'print', className: 'btn-sm', footer: true },
                        { extend: 'colvis', className: 'btn-sm', footer: true }
                    ],
                    "searching": true,
                    "processing": true,

                });
            }
        });
    }
}

function generatereport() {
    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();
    var csrf = $('#csrfhashresarvation').val();
    if (from_date == '') {
        alert("Please select from date");
        return false;
    }
    if (to_date == '') {
        alert("Please select To date");
        return false;
    }
    var myurl = baseurl + 'report/reports/generaterpt';
    var dataString = "from_date=" + from_date + '&to_date=' + to_date + '&csrf_test_name=' + csrf;
    $.ajax({
        type: "POST",
        url: myurl,
        data: dataString,
        success: function(data) {

        }
    });
}