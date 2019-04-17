$(function () {
    var contador_viaje = 0;
    var CostoTotalViaje = 0;
    var productos_list = [];
    var sum_off_shipping = 0;
    var sum_off_pesolibras = 0;


    $(".producto_hidden").each(function () {
        var dd = $(this).attr('id');
        productos_list[dd] = parseInt($(this).val());
    });


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
        costo_total_viaje = CalcularCostoTotalViaje();
        saldo_para_gastos = CalcularSaldoParaGastos(sum_off_shipping, costo_total_viaje);
        $('#saldo_para_gastos').html(saldo_para_gastos);
    });
    $("body").on("blur", "#comision_viajero", function () {
        costo_total_viaje = CalcularCostoTotalViaje();
        saldo_para_gastos = CalcularSaldoParaGastos(sum_off_shipping, costo_total_viaje);
        $('#saldo_para_gastos').html(saldo_para_gastos);
    });
    $("body").on("blur", "#comision_adn", function () {
        costo_total_viaje = CalcularCostoTotalViaje();
        saldo_para_gastos = CalcularSaldoParaGastos(sum_off_shipping, costo_total_viaje);
        $('#saldo_para_gastos').html(saldo_para_gastos);
    });
    $("body").on("blur", "#comision_elvira", function () {
        costo_total_viaje = CalcularCostoTotalViaje();
        saldo_para_gastos = CalcularSaldoParaGastos(sum_off_shipping, costo_total_viaje);
        $('#saldo_para_gastos').html(saldo_para_gastos);
    });
    $("body").on("blur", "#impuesto_aduanas", function () {
        costo_total_viaje = CalcularCostoTotalViaje();
        saldo_para_gastos = CalcularSaldoParaGastos(sum_off_shipping, costo_total_viaje);
        $('#saldo_para_gastos').html(saldo_para_gastos);
    });
    $("body").on("blur", "#costo_recojo", function () {
        costo_total_viaje = CalcularCostoTotalViaje();
        saldo_para_gastos = CalcularSaldoParaGastos(sum_off_shipping, costo_total_viaje);
        $('#saldo_para_gastos').html(saldo_para_gastos);
    });
    $("body").on("blur", "#gastos_extras", function () {
        costo_total_viaje = CalcularCostoTotalViaje();
        saldo_para_gastos = CalcularSaldoParaGastos(sum_off_shipping, costo_total_viaje);
        $('#saldo_para_gastos').html(saldo_para_gastos);
    });

    var CalcularCostoTotalViaje = function () {

        var costo_pasaje = parseFloat($('#costo_pasaje').val());
        var comision_viajero = parseFloat($('#comision_viajero').val());
        var comision_adn = parseFloat($('#comision_adn').val());
        var comision_elvira = parseFloat($('#comision_elvira').val());
        var impuesto_aduanas = parseFloat($('#impuesto_aduanas').val());
        var costo_recojo = parseFloat($('#costo_recojo').val());
        var gastos_extras = parseFloat($('#gastos_extras').val());

        CostoTotalViaje = costo_pasaje + comision_viajero + comision_adn + comision_elvira + impuesto_aduanas + costo_recojo + gastos_extras;
        $('#costo_total_viaje').text(parseFloat(CostoTotalViaje).toFixed(2));
        return CostoTotalViaje;
    }




    var CalcularMaletasObservadas = function (maletas_envidas, maletas_recepcionadas) {
        maletas_observadas = parseInt(maletas_envidas) - parseInt(maletas_recepcionadas);
        return maletas_observadas;
    }

    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    })

    var RecorrerInputsIngresadosProductos = function (codigo_producto) {
        var sum = 0;
        $("#" + codigo_producto + ".cantidad_envio").each(function () {
            ingresado = $(this).val();
            if (ingresado != '' && !isNaN(ingresado)) {
                sum = parseInt(ingresado) + sum;
            }
        });
        return sum;
    }
//Guardando item valido para envio
    var item_pedido_memory = [];
    $("body").on("blur", ".cantidad_envio", function () {
//        var cantidad_envio = 0;
//        cantidad_envio = parseInt($(this).val());
        var resultado;
        var codigo_producto = $(this).attr('id');
        var item_pedido_detalle = $(this).attr('name');
        cantidad_envio_total = RecorrerInputsIngresadosProductos(codigo_producto);
        stock_producto = productos_list[codigo_producto];
        stock_producto = parseInt(stock_producto);
        procede_resta_stock_producto = (cantidad_envio_total <= stock_producto) ? true : false;
        if (procede_resta_stock_producto) {
            item_pedido_memory[item_pedido_detalle] = true;
            $("#" + item_pedido_detalle + '.pedido_detalle').prop("disabled", false);
            resultado = stock_producto - cantidad_envio_total;
            $('#' + codigo_producto + '.stock_actual').text(resultado);
            $('#'+codigo_producto+'.cantidad_envio').prop("disabled", false);

        } else {
            $('#texto').text('Estas intentando mandar ' + cantidad_envio_total + " productos y solo se dispone de " + stock_producto + ' en almacen.');
            $(this).prop("disabled", true);
            $("#" + item_pedido_detalle + '.pedido_detalle').prop("disabled", true);
//              $("#" + item_pedido_detalle + '.pedido_detalle').removeAttr('checked').checkboxradio("refresh");
            $('#modal-danger').modal('show');
            $(this).val(0);
            cantidad_envio_total = RecorrerInputsIngresadosProductos(codigo_producto);
            resultado = stock_producto - cantidad_envio_total;
            $('#' + codigo_producto + '.stock_actual').text(resultado);
            $("#" + item_pedido_detalle + '.pedido_detalle').iCheck('uncheck');
        }
    });
    $("body").on("ifClicked", ".pedido_detalle", function () {

        id = $(this).attr('id');
        var item_id_pedido_detalle = $(this).parents('tr').attr('id');

        var pedido_codigo = $(this).parents('tr').find('td')[8].innerHTML;
        var cantidad = $('[name="' + id + '"].cantidad_envio').val();
        var producto_codigo = $('[name="' + id + '"].cantidad_envio').attr('id');
        var nombre = $(this).parents('tr').find('td')[1].innerHTML;
        var stock = $(this).parents('tr').find('td')[3].innerHTML;
        var cantidad_requerida = $(this).parents('tr').find('td')[2].innerHTML;
        var shipping = $(this).parents('tr').find('td')[5].innerHTML;
        var res_shipping_x_cant_env = parseFloat(shipping) * parseInt(cantidad)
        var peso_libras = $(this).parents('tr').find('td')[6].innerHTML;
        var cliente_codigo = $(this).parents('tr').find('td')[7].innerHTML;
        var res_pesolibras_x_cant_env = parseFloat(peso_libras) * parseInt(cantidad)
        var ACTIVO_CHECKED = $(this).iCheck('update')[0].checked;
        procede_resta_stock_producto = (cantidad <= stock) ? true : false;
        if (procede_resta_stock_producto === false && item_pedido_memory[item_id_pedido_detalle] != true) {
            item_pedido_memory[item_id_pedido_detalle] = false;
            $(this).prop("disabled", true);
        }
        if ((cantidad != '' && cantidad > 0) || item_pedido_memory[item_id_pedido_detalle] === true) {
            if (procede_resta_stock_producto === true || item_pedido_memory[item_id_pedido_detalle] === true) {
                //            val_repet.push(item_id_pedido_detalle);
//            console.log(val_repet);
                $('input[name="' + id + '"]').prop("disabled", true);
                var nueva_fila_tblTuPedido = '<tr id="' + item_id_pedido_detalle + '">' +
                        '<td id="' + contador_viaje + '" class="pedido_codigo">' + pedido_codigo + '</td>' +
                        '<td>' + nombre + '</td>' +
                        '<td id="' + contador_viaje + '" class="cantidad">' + cantidad + '</td>' +
//                    '<td id="' + item_id_pedido_detalle + '" class="tulist_shipping" name="'+contador_viaje+'">' + res_shipping_x_cant_env.toFixed(2) + '</td>' +
                        '<td id="' + contador_viaje + '" class="tulist_shipping">' + res_shipping_x_cant_env.toFixed(2) + '</td>' +
//                    '<td id="' + item_id_pedido_detalle + '" class="tulist_pesolibras" name="'+contador_viaje+'">' + res_pesolibras_x_cant_env + '</td>' +
                        '<td id="' + contador_viaje + '" class="tulist_pesolibras">' + res_pesolibras_x_cant_env + '</td>' +
                        '<td  style="display: none" id="' + contador_viaje + '" class="pedido_detalle_id">' + item_id_pedido_detalle + '</td>' +
                        '<td  style="display: none" id="' + contador_viaje + '" class="cliente_codigo">' + cliente_codigo + '</td>' +
                        '<td  style="display: none" id="' + contador_viaje + '" class="producto_codigo">' + producto_codigo + '</td>' +
                        '<td  style="display: none" id="' + contador_viaje + '" class="cantidad_requerida">' + cantidad_requerida + '</td>' +
                        '</tr>';
//            SumarShippingTuLista();
//            delete item_pedido_memory[item_id_pedido_detalle];
                $('#tbl_tupedido tbody').append(nueva_fila_tblTuPedido);


                if (ACTIVO_CHECKED === false) {
                    sum_off_shipping = res_shipping_x_cant_env + sum_off_shipping;
                    $('#sumatoria_shipping').html(sum_off_shipping.toFixed(2));
                    sum_off_pesolibras = res_pesolibras_x_cant_env + sum_off_pesolibras;
                    $('#sumatoria_peso_libras').html(sum_off_pesolibras.toFixed(2));
                    costo_total_viaje = CalcularCostoTotalViaje();
                    saldo_para_gastos = CalcularSaldoParaGastos(sum_off_shipping, costo_total_viaje);
                    $('#saldo_para_gastos').html(saldo_para_gastos);
                }
//                item_pedido_memory[item_id_pedido_detalle] = false;
            } else {
                $('#texto').text('Ya no dispones de este producto');
                $('#modal-danger').modal('show');
                    if(stock == 0){
                    $("#" + id + '.pedido_detalle').removeAttr('checked').checkboxradio("refresh");
                    }
            }
        } else if (procede_resta_stock_producto === false) {
            $('#texto').text('Ya no dispones de este producto');
            $('#modal-danger').modal('show');
            $("#" + id + '.pedido_detalle').removeAttr('checked').checkboxradio("refresh");
        } else {
            $('#texto').text('Debes establecer una cantidad de envio antes de agregar');
            $('#modal-danger').modal('show');
            $("#" + id + '.pedido_detalle').removeAttr('checked').checkboxradio("refresh");
        }


    });

    $("body").on("click", "#btn_guardar_detalle_viaje", function () {
        var ViajeObj = [];
        var ViajeDetalleObj = [];
        var viaje_id = $('#viaje_id').val();
        for (var i = 0; i < contador_viaje; i++) {
            //------ DATA PARA LA TABLA 'viaje_has_pedido_detalle'  --------
            var cap_pedido_codigo = $('#' + i + '.pedido_codigo').text();
            var pedido_detalle_id = $('#' + i + '.pedido_detalle_id').text();
            var cliente_codigo = $('#' + i + '.cliente_codigo').text();
            var producto_codigo = $('#' + i + '.producto_codigo').text();
            var shipping = $('#' + i + '.tulist_shipping').text();
            var pesolibras = $('#' + i + '.tulist_pesolibras').text();
            var cantidad = $('#' + i + '.cantidad').text();
            var cantidad_requerida = $('#' + i + '.cantidad_requerida').text();
            item = {}
            item ["pedido_codigo"] = cap_pedido_codigo;
            item ["pedido_detalle_id"] = pedido_detalle_id;
            item ["cliente_codigo"] = cliente_codigo;
            item ["producto_codigo"] = producto_codigo;
            item ["shipping"] = shipping;
            item ["pesolibra"] = pesolibras;
            item ["cantidad"] = cantidad;
            item ["cantidad_requerida"] = cantidad_requerida;
            ViajeObj.push(item);
            //------ FIN DATA PARA LA TABLA 'viaje_has_pedido_detalle'  -------
        }

        //------ DATA PARA LA TABLA 'viaje_detalle'  --------
        var costo_pasaje = $('#costo_pasaje').val();
        var comision_viajero = $('#comision_viajero').val();
        var comision_adn = $('#comision_adn').val();
        var comision_persona_encargada = $('#comision_elvira').val();
        var impuesto_aduanas = $('#impuesto_aduanas').val();
        var costo_recojo = $('#costo_recojo').val();
        var gastos_extras = $('#gastos_extras').val();
        var costo_total_viaje = $('#costo_total_viaje').text();
        var saldo_para_gastos = $('#saldo_para_gastos').text();
        var sumatoria_shipping = $('#sumatoria_shipping').text();
        var sumatoria_peso_libras = $('#sumatoria_peso_libras').text();
        item_viaje_detalle = {}
        item_viaje_detalle ["costo_pasaje"] = costo_pasaje;
        item_viaje_detalle ["comision_viajero"] = comision_viajero;
        item_viaje_detalle ["comision_adn"] = comision_adn;
        item_viaje_detalle ["comision_persona_encargada"] = comision_persona_encargada;
        item_viaje_detalle ["impuesto_aduanas"] = impuesto_aduanas;
        item_viaje_detalle ["costo_recojo"] = costo_recojo;
        item_viaje_detalle ["gastos_extras"] = gastos_extras;
        item_viaje_detalle ["costo_total_viaje"] = costo_total_viaje;
        item_viaje_detalle ["saldo_para_gastos"] = saldo_para_gastos;
        item_viaje_detalle ["sumatoria_shipping"] = sumatoria_shipping;
        item_viaje_detalle ["sumatoria_peso_libras"] = sumatoria_peso_libras;

        ViajeDetalleObj.push(item_viaje_detalle);

        $.ajax({
            type: 'POST',
            url: 'http://35.238.63.231/siv/operaciones/Viaje/RecibirData',
            data: 'json_viaje_has_pedido_detalle=' + JSON.stringify(ViajeObj) + '&json_viaje_detalle=' + JSON.stringify(ViajeDetalleObj) + '&viaje_id=' + viaje_id,
            success: function (respuesta) {
                console.log(respuesta);
//                window.location.href = "http://35.238.63.231/siv/operaciones/Viaje";
            },
            error: function () {
                console.log(respuesta);
//                console.log('error');
//                 window.location.href = "http://35.238.63.231/siv/operaciones/Viaje?error=1";
            }
        });

//        console.log(ViajeObj);

    });

    $("body").on("ifChecked", ".pedido_detalle", function () {
        contador_viaje++;
//        console.log(contador_viaje);
    });
    $("body").on("ifUnchecked", ".pedido_detalle", function () {
        contador_viaje--;
//        console.log(contador_viaje);

        id = $(this).attr('id');
        var item_id_pedido_detalle = $(this).parents('tr').attr('id');
        $('input[name="' + id + '"]').prop("disabled", false);
        var cantidad = $('[name="' + id + '"].cantidad_envio').val();
        var shipping = $(this).parents('tr').find('td')[5].innerHTML;
        var res_shipping_x_cant_env = parseFloat(shipping) * parseInt(cantidad)
        var peso_libras = $(this).parents('tr').find('td')[6].innerHTML;
        var res_pesolibras_x_cant_env = parseFloat(peso_libras) * parseInt(cantidad)


        sum_off_shipping = sum_off_shipping - res_shipping_x_cant_env;
        sum_off_pesolibras = sum_off_pesolibras - res_pesolibras_x_cant_env;

        costo_total_viaje = CalcularCostoTotalViaje();
        saldo_para_gastos = CalcularSaldoParaGastos(sum_off_shipping, costo_total_viaje);
        $('#saldo_para_gastos').html(saldo_para_gastos);


        $('#sumatoria_shipping').html(sum_off_shipping.toFixed(2));
        $('#sumatoria_peso_libras').html(sum_off_pesolibras.toFixed(2));

        $('#tbl_tupedido tbody #' + item_id_pedido_detalle).closest('tr').remove();

    });


    var CalcularSaldoParaGastos = function (sum_shipping, costo_total_viaje) {
        if (costo_total_viaje != '') {
            res_saldoparagastos = parseFloat(sum_shipping) - parseFloat(costo_total_viaje);
            return res_saldoparagastos.toFixed(2);
        } else {
            return 0.00;
        }

    }

});