$(function () {

    //Date picker
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true
    })
    $('#tbl_list_viajes').DataTable()

    $('.btn_agregar_viaje').click(function () {

        valor = $(this).attr('id');
        if (valor == 'false') {
            $('#form_ingreso_viaje').show();
            $(this).attr("id", "true");

        } else {

            $(this).attr("id", "false");
            $('#form_ingreso_viaje').hide();
        }
//        $('#form_ingreso_gastos').css( "display", "block" );
    })

    $("body").on("click", ".btn_verDetalle", function () {
        var id = $(this).attr('id');
        var nombres_viajero = $(this).parents("tr").find("td").eq(2).text();
        var apellidos_viajero = $(this).parents("tr").find("td").eq(3).text();
        var aerolinea = $(this).parents("tr").find("td").eq(4).text();
        var nombre_apellido_concatenado = nombres_viajero + ' ' + apellidos_viajero;
        var nombre_apellido_concatenado = nombres_viajero + ' ' + apellidos_viajero;
        $('#id_viaje').text(id);
        $('#nombres_viajero').text(nombre_apellido_concatenado);
        $('#aerolinea').text(aerolinea);
//        $.ajax({
//            type: "POST",
//            url: '/siv/index.php/operaciones/Viaje/VerDetalle',
//            data: 'id=' + id,
//            success: function (data)
//            {
////                window.location.href = "/siststar/refund/prog_refund";
//            }
//        });
    });


    $("body").on("blur", ".maletas_recepcionadas", function () {
        posicion = $(this).attr('id');
        data_indice_array = posicion.split('_')
        indice = data_indice_array[2];
        maletas_envidas = $('#maleta_num_' + indice).text();
        maletas_recepcionadas = $(this).val();
        if (maletas_recepcionadas != '') {
            calculo_maletas_observadas = CalcularMaletasObservadas(maletas_envidas, maletas_recepcionadas);
            $('#maletas_observadas_' + indice).text(calculo_maletas_observadas);
            $('#maletas_observadas_post_' + posicion).val(calculo_maletas_observadas);
        }
    });




    var CalcularMaletasObservadas = function (maletas_envidas, maletas_recepcionadas) {
        maletas_observadas = parseInt(maletas_envidas) - parseInt(maletas_recepcionadas);
        return maletas_observadas;
    }


    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    })

});