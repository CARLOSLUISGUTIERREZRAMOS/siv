$(function () {

    $(document).ready(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_minimal',
            increaseArea: '20%' // optional
        });
    });

    var contador_viaje = 0;
    var CostoTotalViaje = 0;
    var productos_list = [];
    var sum_off_shipping = 0;
    var sum_off_pesolibras = 0;


    $(".producto_hidden").each(function () {
        var dd = $(this).attr('id');
        productos_list[dd] = parseInt($(this).val());
    });
    console.log(productos_list);
    $(".decimal").inputmask('decimal', {
        rightAlign: true
    });
    $(".cantidad_envio").inputmask('integer', {min: 0, max: 255});
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


    var SetearProductoAlmacenEnCero = function (producto_codigo) {
        $('#' + producto_codigo + '.stock_actual').text(0);
    }
    var DesactivarCheckboxProductoSinStock = function (producto_codigo, id_pedido_detalle_checked) {

        $('.pedido_detalle.' + producto_codigo).each(function () {
            id_pedido_detalle = $(this).attr('id');
            if (!$('#' + id_pedido_detalle + '.pedido_detalle').is(':checked')) { // Si este elemento no esta checkeado
//                console.log('El id_pedidod detalle '+id_pedido_detalle + ' esta checkedd!');
                if (id_pedido_detalle != id_pedido_detalle_checked) {
                    $('#' + id_pedido_detalle + '.pedido_detalle').iCheck('disable');
                    $('[name="' + id_pedido_detalle + '"].cantidad_envio').prop('disabled', true);
                }
            }
        });
    }
    var ActivarChekboxInputProducto = function (producto_codigo) {

        $('.pedido_detalle.' + producto_codigo).each(function () {
            id_pedido_detalle = $(this).attr('id');
            $('#' + id_pedido_detalle + '.pedido_detalle').iCheck('enable');
            $('[name="' + id_pedido_detalle + '"].cantidad_envio').prop('disabled', false);
        });
    }

    $("body").on("ifChecked", ".pedido_detalle", function () {

        id = $(this).attr('id');
        var item_id_pedido_detalle = $(this).parents('tr').attr('id');
        var item_id_pedido_detalle = parseInt(item_id_pedido_detalle);


        var pedido_codigo = $(this).parents('tr').find('td')[8].innerHTML;
        var cantidad_envio = parseInt($('[name="' + id + '"].cantidad_envio').val());

        var producto_codigo = $('[name="' + id + '"].cantidad_envio').attr('id');
        var nombre = $(this).parents('tr').find('td')[1].innerHTML;
        var stock = parseInt($(this).parents('tr').find('td')[3].innerHTML);
        var cantidad_requerida = $(this).parents('tr').find('td')[2].innerHTML;
        var shipping = $(this).parents('tr').find('td')[5].innerHTML;
        var stock_real_almacen = parseInt($('#' + producto_codigo + '.producto_hidden').val());
        var res_shipping_x_cant_env = parseFloat(shipping) * parseInt(cantidad_envio)
        var peso_libras = $(this).parents('tr').find('td')[6].innerHTML;
        var cliente_codigo = $(this).parents('tr').find('td')[7].innerHTML;
        var res_pesolibras_x_cant_env = parseFloat(peso_libras) * parseInt(cantidad_envio)
        // MI NUEVA LOGICA PARA RESTAR O SUMAR PRODUCTOS DE LA LISTA 

        flag_calculo_productos_recal = cantidad_envio + stock;
        var add = (flag_calculo_productos_recal > stock_real_almacen) ? false : true;

        if (cantidad_envio > stock_real_almacen && add) {
//            $('#texto').text('La cantidad de envio no puede exceder el stock del almacen');
            $('#texto').text("Cantidad inválida. Revisa el stock de tus productos.");
            $('#modal-danger').modal('show');
            $('[name="' + id + '"].cantidad_envio').val(0);
            return false;
        }


        //SI TODO ES CORRECTO ENTRA AQUI
        if ((cantidad_envio <= stock && cantidad_envio <= stock_real_almacen) && cantidad_envio != 0) {

            productos_list[producto_codigo] = productos_list[producto_codigo] - cantidad_envio;
            $('#' + producto_codigo + '.stock_actual').text(productos_list[producto_codigo]);
            $('[name="' + id + '"].cantidad_envio').prop('disabled', true);
            if (productos_list[producto_codigo] === 0) {
                SetearProductoAlmacenEnCero(producto_codigo);
                DesactivarCheckboxProductoSinStock(producto_codigo, id);
            }

            nueva_fila_tblTuPedido = GenerarTblTuPedido(contador_viaje, item_id_pedido_detalle, pedido_codigo, nombre, cantidad_envio, res_shipping_x_cant_env, res_pesolibras_x_cant_env, cliente_codigo, producto_codigo, cantidad_requerida);
            $('#tbl_tupedido tbody').append(nueva_fila_tblTuPedido);

            sum_off_shipping = res_shipping_x_cant_env + sum_off_shipping;
            $('#sumatoria_shipping').html(sum_off_shipping.toFixed(2));
            sum_off_pesolibras = res_pesolibras_x_cant_env + sum_off_pesolibras;
            $('#sumatoria_peso_libras').html(sum_off_pesolibras.toFixed(2));
            costo_total_viaje = CalcularCostoTotalViaje();
            saldo_para_gastos = CalcularSaldoParaGastos(sum_off_shipping, costo_total_viaje);
            $('#saldo_para_gastos').html(saldo_para_gastos);
            contador_viaje++;
        }

    });



    $("body").on("ifUnchecked", ".pedido_detalle", function () {

        contador_viaje--;
//        console.log(contador_viaje);

        id = $(this).attr('id');
        var item_id_pedido_detalle = $(this).parents('tr').attr('id');
        var producto_codigo = $('[name="' + id + '"].cantidad_envio').attr('id');
//        $("#"+id+'.pedido_detalle').iCheck('uncheck'); 
        var stock = parseInt($(this).parents('tr').find('td')[3].innerHTML);
//        $('input[name="' + id + '"]').prop("disabled", false);
        var cantidad_envio = parseInt($('[name="' + id + '"].cantidad_envio').val());
        var stock_real_almacen = parseInt($('#' + producto_codigo + '.producto_hidden').val());
        if (cantidad_envio > stock_real_almacen) {
            $('#texto').text("Cantidad inválida. Revisa el stock de tus productos.");
            $('#modal-danger').modal('show');
            return false;
        }
        var shipping = $(this).parents('tr').find('td')[5].innerHTML;
        var peso_libras = $(this).parents('tr').find('td')[6].innerHTML;
        // si el elemento desactivado tiene todo el stock
        $('[name="' + id + '"].cantidad_envio').val(0);
        if (cantidad_envio === stock_real_almacen) {
             flag_calculo_productos_recal = cantidad_envio + stock;
              if (flag_calculo_productos_recal > stock_real_almacen) {
                $('#texto').text('Inconsistencia. Devuelves algo que aún no has enviado.');
                $('#modal-danger').modal('show');
                $('[name="' + id + '"].cantidad_envio').val(0);
                return false;
            }else{
                var res_shipping_x_cant_env = parseFloat(shipping) * parseInt(cantidad_envio)
                var res_pesolibras_x_cant_env = parseFloat(peso_libras) * parseInt(cantidad_envio)
                productos_list[producto_codigo] = stock_real_almacen;
                $('#' + producto_codigo + '.stock_actual').text(productos_list[producto_codigo]);
                ActivarChekboxInputProducto(producto_codigo);
            }
            
        } else {
            //Si el elemento desactivado solo tiene parte del stock total
            flag_calculo_productos_recal = cantidad_envio + stock;
            if (flag_calculo_productos_recal > stock_real_almacen) {
                $('#texto').text('Inconsistencia. Devuelves algo que aún no has enviado.');
                $('#modal-danger').modal('show');
                $('[name="' + id + '"].cantidad_envio').val(0);
                return false;
            } else {

                productos_list[producto_codigo] = cantidad_envio + stock;
                $('#' + producto_codigo + '.stock_actual').text(productos_list[producto_codigo]);
                var res_shipping_x_cant_env = parseFloat(shipping) * parseInt(cantidad_envio)
                var res_pesolibras_x_cant_env = parseFloat(peso_libras) * parseInt(cantidad_envio)
                $('[name="' + id + '"].cantidad_envio').prop('disabled', false);
            }
        }
        sum_off_shipping = sum_off_shipping - res_shipping_x_cant_env;
        sum_off_pesolibras = sum_off_pesolibras - res_pesolibras_x_cant_env;

        costo_total_viaje = CalcularCostoTotalViaje();
        saldo_para_gastos = CalcularSaldoParaGastos(sum_off_shipping, costo_total_viaje);
        $('#saldo_para_gastos').html(saldo_para_gastos);


        $('#sumatoria_shipping').html(sum_off_shipping.toFixed(2));
        $('#sumatoria_peso_libras').html(sum_off_pesolibras.toFixed(2));
        $('#tbl_tupedido tbody #' + item_id_pedido_detalle).closest('tr').remove();

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
            url: '/siv/operaciones/Viaje/RecibirData',
            data: 'json_viaje_has_pedido_detalle=' + JSON.stringify(ViajeObj) + '&json_viaje_detalle=' + JSON.stringify(ViajeDetalleObj) + '&viaje_id=' + viaje_id,
            success: function () {
//                console.log(respuesta);
                window.location.href = "/siv/operaciones/Viaje/";
            },
            error: function () {
//                console.log(respuesta);
                console.log('error');
            }
        });


    });




    var CalcularSaldoParaGastos = function (sum_shipping, costo_total_viaje) {
        if (costo_total_viaje != '') {
            res_saldoparagastos = parseFloat(sum_shipping) - parseFloat(costo_total_viaje);
            return res_saldoparagastos.toFixed(2);
        } else {
            return 0.00;
        }

    }

    var GenerarTblTuPedido = function (contador_viaje, item_id_pedido_detalle, pedido_codigo, nombre, cantidad_envio, res_shipping_x_cant_env, res_pesolibras_x_cant_env, cliente_codigo, producto_codigo, cantidad_requerida) {
        var nueva_fila_tblTuPedido = '<tr id="' + item_id_pedido_detalle + '">' +
                '<td id="' + contador_viaje + '" class="pedido_codigo">' + pedido_codigo + '</td>' +
                '<td>' + nombre + '</td>' +
                '<td id="' + contador_viaje + '" class="cantidad">' + cantidad_envio + '</td>' +
                '<td id="' + contador_viaje + '" class="tulist_shipping">' + res_shipping_x_cant_env.toFixed(2) + '</td>' +
                '<td id="' + contador_viaje + '" class="tulist_pesolibras">' + res_pesolibras_x_cant_env.toFixed(2) + '</td>' +
                '<td  style="display: none" id="' + contador_viaje + '" class="pedido_detalle_id">' + item_id_pedido_detalle + '</td>' +
                '<td  style="display: none" id="' + contador_viaje + '" class="cliente_codigo">' + cliente_codigo + '</td>' +
                '<td  style="display: none" id="' + contador_viaje + '" class="producto_codigo">' + producto_codigo + '</td>' +
                '<td  style="display: none" id="' + contador_viaje + '" class="cantidad_requerida">' + cantidad_requerida + '</td>' +
                '</tr>';
        return nueva_fila_tblTuPedido;
    }

});