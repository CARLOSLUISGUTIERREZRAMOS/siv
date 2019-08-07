$(function () {
    $('#tbl_clientes').DataTable();

    $('.btn_comprar').click(function () {

        valor = $(this).attr('id');
        if (valor == 'false') {
            $('#form_ingreso_compras').show();
            $(this).attr("id", "true");

        } else {

            $(this).attr("id", "false");
            $('#form_ingreso_compras').hide();
        }
//        $('#form_ingreso_gastos').css( "display", "block" );
    })

    $("#btn_envio_form").click(function () {

        $.ajax({
            url: 'CargarCompra',
            type: 'post',
//            dataType: 'json',
            data: $('#form_ingreso_compras').serialize(),
            success: function (data) {
                console.log(data);
            }
        });

//        $("#myForm").submit(); // Submit the form
    });


});