$(function () {

//    var viewportHeight = $(window).height();
//    $('.bloque_pedidos').slimScroll({
//        height: viewportHeight + 'px',
//        color: '#455A64',
//        distance: '0',
//        allowPageScroll: true,
//        alwaysVisible: true
//    });


    $(".decimal").inputmask('decimal', {
        rightAlign: true
    });
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

    $("body").on("blur", "#costo_pasaje", function () {
        CalcularCostoTotalViaje();
    });
    $("body").on("blur", "#comision_viajero", function () {
        CalcularCostoTotalViaje();
    });
    $("body").on("blur", "#comision_adn", function () {
        CalcularCostoTotalViaje();
    });
    $("body").on("blur", "#comision_elvira", function () {
        CalcularCostoTotalViaje();
    });
    $("body").on("blur", "#impuesto_aduanas", function () {
        CalcularCostoTotalViaje();
    });
    $("body").on("blur", "#costo_recojo", function () {
        CalcularCostoTotalViaje();
    });
    $("body").on("blur", "#gastos_extras", function () {
        CalcularCostoTotalViaje();
    });

    var CalcularCostoTotalViaje = function () {

        var costo_pasaje = parseFloat($('#costo_pasaje').val());
        var comision_viajero = parseFloat($('#comision_viajero').val());
        var comision_adn = parseFloat($('#comision_adn').val());
        var comision_elvira = parseFloat($('#comision_elvira').val());
        var impuesto_aduanas = parseFloat($('#impuesto_aduanas').val());
        var costo_recojo = parseFloat($('#costo_recojo').val());
        var gastos_extras = parseFloat($('#gastos_extras').val());

        var CostoTotalViaje = costo_pasaje + comision_viajero + comision_adn + comision_elvira + impuesto_aduanas + costo_recojo + gastos_extras;
        $('#costo_total_viaje').text(parseFloat(CostoTotalViaje).toFixed(2));
    }




    var CalcularMaletasObservadas = function (maletas_envidas, maletas_recepcionadas) {
        maletas_observadas = parseInt(maletas_envidas) - parseInt(maletas_recepcionadas);
        return maletas_observadas;
    }

    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    })

    $('.pedido_detalle').on('ifChecked', function (event) {
        console.log(1)
    });
});