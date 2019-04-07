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

});