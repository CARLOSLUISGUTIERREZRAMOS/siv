$(function () {
    var numero_pedido;
    var peso_producto;
    var nombre_cliente;
    var nombre_producto;
    var codigo_cliente;
    var codigo_producto;
    var costo_unitario_producto;
    var cantidad;
    var shipping_unitario = 0;
    var costo_unit_total = 0;
    var costo_total_unitario = 0;
    var costo_x_libra_del_dia;
    var peso_libras_input;
    var cantidad_venta;
    var total_all_pedido = 0;
    var contador_productos = 0;
    var PRECIO_TOTAL = 0;
    var SHIPPING_TOTAL = 0;
    var COSTO_TOTALES_PRODUCTO = 0;
    var PRESUPUESTO_X_COMPRA = 0;
    var total_producto_precio_registrado = 0;
    var PRESUPUESTO_CALCULADO = 0;
    var costo_unitario_total_fila_capturado = 0;
    var sumatoria_costo_unitario_total = 0;
    var tc_compra = parseFloat($('#tc_compra').text());
    $("body").on("change", "#producto", function () {

//        codigo_producto = $(this).val();
        data_total_producto = $(this).val();
        item_array = data_total_producto.split('|');
        cantidad_pedido = $('#cantidad_pedido').val();
        codigo_producto = item_array[0]
        costo_unitario_producto = item_array[1]
        peso_producto = item_array[2]

    });
    var CalcularPresupuestoPorCompra = function (costo_unitario_producto, cantidad_pedido) {
        total_producto_precio_registrado = parseFloat(costo_unitario_producto) * parseInt(cantidad_pedido);
        return total_producto_precio_registrado;
    }

    $("body").on("click", "#anadir", function () {
        $('#codigo_cliente').prop("disabled", true);
        $(".bloque_pedido").css("display", "block");
        codigo_cliente = $('#codigo_cliente').val();
        //CALCULANDO SUMATORIA DEL COSTO UNITARIO TOTAL
        var valor_costo_unitario_total = $('.costo_unitario_total').text();
//        if (!isNaN(valor_costo_unitario_total)) {
        if (valor_costo_unitario_total != '') {
            var costo_unitario_total_fila_capturado = +parseFloat($('.costo_unitario_total').text());
//            costo_unitario_total_fila_capturado = parseFloat(costo_unitario_total) + parseFloat(costo_unitario_total_fila_capturado);
            $('.costo_unitario_total_sumatoria').text(costo_unitario_total_fila_capturado.toFixed(2));
        }

//FINCALCULANDO SUMATORIA DEL COSTO UNITARIO TOTAL


        if ($('#codigo_cliente').val() && $('#producto').val()) {


            numero_pedido = $('#nro_pedido').val();
            $('#span_nro_pedido').text(numero_pedido);
            nombre_cliente = $('select[name="codigo_cliente"] option:selected').text()
            nombre_producto = $('select[name="producto"] option:selected').text()
            $('#span_nombre_cliente').text(nombre_cliente);
            $('#span_codigo_cliente').text(codigo_cliente);
            cantidad = $('#cantidad_pedido').val();
//            costo_total_unitario = CalcularCostoTotalUnitario(costo_unitario_producto, cantidad);
            agregarFila(codigo_producto, nombre_producto, cantidad, costo_unitario_producto, peso_producto, contador_productos)
//            resultado_fila = CalcularPresupuestoPorCompra(costo_unitario_producto, cantidad);

//            PRESUPUESTO_CALCULADO = resultado_fila + PRESUPUESTO_CALCULADO;
//            $('#presupuesto_x_compra').text(PRESUPUESTO_CALCULADO.toFixed(2));

        } else {
            $('#TxtMsg').html('Debe establecer todos los campos');
            $('#v_modal_error').modal({
                show: true,
                keyboard: false
            });
        }
    })

//    var ObtenerCostoPorLibraDelDia = function () {
    $.ajax({
        type: "POST",
        url: '/siv/finanzas/Tax/ObtenerCostoPorLibraDelDia',
        success: function (data)
        {
//                console.log(data);
            costo_x_libra_del_dia = data;
        }
    });
//    }

    var CalcularCostoTotalUnitario = function (costo_unitario_producto, cantidad) {
        resultado = parseFloat(costo_unitario_producto) * parseFloat(cantidad);
        return resultado;
    }
    var CalcularPresupuestoParaEnvio = function (costo_unitario_producto, cantidad) {
        resultado = parseFloat(costo_unitario_producto) * parseFloat(cantidad);
        return resultado;
    }


    $("body").on("blur", "#abono", function () {
        total_all_pedido = $('#total_all_pedido').text();
        abono = $(this).val();
        saldo = CalcularSaldo(total_all_pedido, abono);
        if (isNaN(saldo)) {
            $('#saldo').text(0.00);
        } else {
            $('#saldo').text(saldo.toFixed(2));
        }
        if ($(this).val() != 0) {
            $(this).prop("disabled", true);
        }
//          $('#anadir').prop("disabled",true);

    });
    var CalcularSaldo = function (total_all_pedido, abono) {
        return  parseFloat(total_all_pedido) - parseFloat(abono)

    }


    $("body").on("blur", ".peso_libras", function () {

//        var ganancia_unitaria_fila = 0.00;
        fila_numero = $(this).attr('id');
        peso_libras = $(this).val();
        shipping_unitario = parseFloat(peso_libras) * parseFloat(costo_x_libra_del_dia);
        costo_unitario_producto_fila = $('#' + fila_numero + '.costo_unitario').val();
        costo_unit_total = parseFloat(costo_unitario_producto_fila) + shipping_unitario;
        $('#costo_unitario_total_' + fila_numero).text(costo_unit_total.toFixed(2));
        $('#shipping_unitario_' + fila_numero).text(shipping_unitario.toFixed(2));
        var cantidad_fila = $('#' + fila_numero + '.cantidad').val();
        costo_total_producto_fila = parseInt(cantidad_fila) * parseFloat(costo_unit_total);
        $('#costo_total_producto_' + fila_numero).text(costo_total_producto_fila.toFixed(2));
        //RECALCULANDO LA GANANCIA UNITARIA
        var ganancia_unitaria_fila = $('#ganancia_unitaria_' + fila_numero).text();
        if (ganancia_unitaria_fila != '') {
            var costo_unitario_total_fila = $('#costo_unitario_total_' + fila_numero).text();
            var precio_unitario_venta_fila = $('#' + fila_numero + '.precio_unitario_venta').val();
            var ganancia_unitaria_fila_recalculo = parseFloat(precio_unitario_venta_fila) - parseFloat(costo_unitario_total_fila);
            $('#ganancia_unitaria_' + fila_numero).text(ganancia_unitaria_fila_recalculo.toFixed(2));
        }
//FIN RECALCULANDO LA GANANCIA UNITARIA

        var sumatoria = 0;
        for (var i = 0; i < contador_productos; i++) {

            costo_unitario_total_suma_fila = $('#costo_unitario_total_' + i).text();
            sumatoria = parseFloat(costo_unitario_total_suma_fila) + sumatoria;
        }
        $('.costo_unitario_total_sumatoria').text(sumatoria.toFixed(2));
        //FIN RECALCULANDO SUMATORIA COSTO UNITARIO 

        //BLOQUE CALCULO SUMATORIA SHIPPING TOTAL
        var sumatoria = 0;
        for (var i = 0; i < contador_productos; i++) {
            var cantidad = parseInt($('#' + i + '.cantidad').val());
            var shipping_unitario = parseFloat($('#shipping_unitario_' + i).text());
            var operacion_calculo_shipping = cantidad * shipping_unitario;
            sumatoria = operacion_calculo_shipping + sumatoria;
        }
        $('#shipping_all_pedido').text(sumatoria.toFixed(2));
        $('#presupuesto_x_envio').text(sumatoria.toFixed(2));
        //FIN BLOQUE CALCULO SUMATORIA SHIPPING TOTAL

        //BLOQUE CALCULO SUMATORIA COSTOS TOTALES

        var sumatoria = 0;
        for (var i = 0; i < contador_productos; i++) {

            costo_total_producto_fila = $('#costo_total_producto_' + i).text();
            if (costo_total_producto_fila != '') {

                sumatoria = parseFloat(costo_total_producto_fila) + sumatoria;
            }
        }
        $('#costos_totales_all').text(sumatoria.toFixed(2));
        //FINBLOQUE CALCULO SUMATORIA  COSTOS TOTALES
        //BLOQUE CALCULO SUMATORIA GANANCIA TOTAL
        var sumatoria = 0;
        for (var i = 0; i < contador_productos; i++) {
            var ganancia_unitaria_fila = parseFloat($('#ganancia_unitaria_' + i).text());
            var cantidad_fila = parseInt($('#' + i + '.cantidad').val());
            var ganancia_total_all = cantidad_fila * ganancia_unitaria_fila;
            sumatoria = ganancia_total_all + sumatoria;
        }
        $('#ganancia_total_all').text(sumatoria.toFixed(2));
        //FIN BLOQUE CALCULO SUMATORIA GANANCIA TOTAL

    });
    var CalcularCostoTotalProducto = function (costo_unitario_total, cantidad) {
        costo_total_producto = parseFloat(costo_unitario_total) * parseInt(cantidad);
        return costo_total_producto.toFixed(2);
    }

    $("body").on("blur", ".cantidad", function () {
        var fila_numero = $(this).attr('id');
        var cantidad_fila = $(this).val();
        var costo_unitario_total_fila = $('#costo_unitario_total_' + fila_numero).text();
        costo_total_producto_fila = parseFloat(costo_unitario_total_fila) * parseFloat(cantidad_fila);
        $('#costo_total_producto_' + fila_numero).text(costo_total_producto_fila.toFixed(2));
        //RECALCULANDO EL PRECIO TOTAL
        var precio_unitario_venta_fila = $('#' + fila_numero + '.precio_unitario_venta').val();
        if (precio_unitario_venta_fila != '') {

            var precio_total_fila = parseFloat(precio_unitario_venta_fila) * parseFloat(cantidad_fila);
            $('#precio_total_' + fila_numero).text(precio_total_fila.toFixed(2));
        }
//BLOQUE CALCULO SUMATORIA SHIPPING TOTAL
        var sumatoria = 0;
        for (var i = 0; i < contador_productos; i++) {
            var cantidad = parseInt($('#' + i + '.cantidad').val());
            var shipping_unitario = parseFloat($('#shipping_unitario_' + i).text());
            var operacion_calculo_shipping = cantidad * shipping_unitario;
            sumatoria = operacion_calculo_shipping + sumatoria;
        }
        $('#shipping_all_pedido').text(sumatoria.toFixed(2));
        $('#presupuesto_x_envio').text(sumatoria.toFixed(2));
        //FIN BLOQUE CALCULO SUMATORIA SHIPPING TOTAL
        //FIN RECALCULANDO EL PRECIO TOTAL

        //BLOQUE CALCULO SUMATORIA PRECIO TOTAL

        var sumatoria = 0;
        for (var i = 0; i < contador_productos; i++) {

            precio_total_fila = $('#precio_total_' + i).text();
            if (precio_total_fila != '') {

                sumatoria = parseFloat(precio_total_fila) + sumatoria;
            }
        }
        $('.precio_total_sumatoria').text(sumatoria);
        $('#total_all_pedido').text(sumatoria);
        //FINBLOQUE CALCULO SUMATORIA PRECIO TOTAL

        //BLOQUE CALCULO SUMATORIA COSTOS TOTALES

        var sumatoria = 0;
        for (var i = 0; i < contador_productos; i++) {

            costo_total_producto_fila = $('#costo_total_producto_' + i).text();
            if (costo_total_producto_fila != '') {

                sumatoria = parseFloat(costo_total_producto_fila) + sumatoria;
            }
        }
        $('#costos_totales_all').text(sumatoria.toFixed(2));
        //FINBLOQUE CALCULO SUMATORIA  COSTOS TOTALES

        //BLOQUE CALCULO SUMATORIA GANANCIA TOTAL
        var sumatoria = 0;
        for (var i = 0; i < contador_productos; i++) {
            var ganancia_unitaria_fila = parseFloat($('#ganancia_unitaria_' + i).text());
            var cantidad_fila = parseInt($('#' + i + '.cantidad').val());
            var ganancia_total_all = cantidad_fila * ganancia_unitaria_fila;
            sumatoria = ganancia_total_all + sumatoria;
        }
        $('#ganancia_total_all').text(sumatoria.toFixed(2));
        //FIN BLOQUE CALCULO SUMATORIA GANANCIA TOTAL

        //BLOQUE CALCULO SUMATORIA PRESUPUESTO X COMPRA

        var sumatoria = 0;
        for (var i = 0; i < contador_productos; i++) {

            var cantidad_fila = parseInt($('#' + i + '.cantidad').val());
            var costo_unitario_fila = parseFloat($('#' + i + '.costo_unitario').val());
            var obteniendo_presupuesto = cantidad_fila * costo_unitario_fila;
            sumatoria = parseFloat(obteniendo_presupuesto) + sumatoria;
        }
        $('#presupuesto_x_compra').text(sumatoria.toFixed(2));
        //FINBLOQUE CALCULO SUMATORIA  PRESUPUESTO X COMPRA

    });
    $("body").on("blur", ".costo_unitario", function () {
        var numero_fila = $(this).attr('id');
        var costo_unitario = $(this).val();
        var shipping_unitario_fila = $('#shipping_unitario_' + numero_fila).text();
        costo_unitario_total_fila = parseFloat(costo_unitario) + parseFloat(shipping_unitario_fila);
        costo_unitario_total_fila = costo_unitario_total_fila.toFixed(2);
        $('#costo_unitario_total_' + numero_fila).text(costo_unitario_total_fila);
        var cantidad_fila = $('#' + numero_fila + '.cantidad').val();
        costo_total_producto_fila = parseFloat(costo_unitario_total_fila) * parseFloat(cantidad_fila);
        $('#costo_total_producto_' + numero_fila).text(costo_total_producto_fila.toFixed(2));
        //RECALCULANDO LA GANANCIA UNITARIA
        var ganancia_unitaria_fila = $('#ganancia_unitaria_' + numero_fila).text();
        if (ganancia_unitaria_fila != '') {
            var costo_unitario_total_fila = $('#costo_unitario_total_' + numero_fila).text();
            var precio_unitario_venta_fila = $('#' + numero_fila + '.precio_unitario_venta').val();
            var ganancia_unitaria_fila_recalculo = parseFloat(precio_unitario_venta_fila) - parseFloat(costo_unitario_total_fila);
            $('#ganancia_unitaria_' + numero_fila).text(ganancia_unitaria_fila_recalculo.toFixed(2));
        }
//FIN RECALCULANDO LA GANANCIA UNITARIA

//RECALCULANDO SUMATORIA COSTO UNITARIO 

//        sumatoria_costo_unitario_total =  parseFloat(costo_unitario_total_fila) + sumatoria_costo_unitario_total;
        var sumatoria = 0;
        for (var i = 0; i < contador_productos; i++) {

            costo_unitario_total_suma_fila = $('#costo_unitario_total_' + i).text();
            sumatoria = parseFloat(costo_unitario_total_suma_fila) + sumatoria;
        }
        $('.costo_unitario_total_sumatoria').text(sumatoria.toFixed(2));
        //FIN RECALCULANDO SUMATORIA COSTO UNITARIO 
        //BLOQUE CALCULO SUMATORIA COSTOS TOTALES

        var sumatoria = 0;
        for (var i = 0; i < contador_productos; i++) {

            costo_total_producto_fila = $('#costo_total_producto_' + i).text();
            if (costo_total_producto_fila != '') {

                sumatoria = parseFloat(costo_total_producto_fila) + sumatoria;
            }
        }
        $('#costos_totales_all').text(sumatoria.toFixed(2));
        //FINBLOQUE CALCULO SUMATORIA  COSTOS TOTALES
        //BLOQUE CALCULO SUMATORIA GANANCIA TOTAL
        var sumatoria = 0;
        for (var i = 0; i < contador_productos; i++) {
            var ganancia_unitaria_fila = parseFloat($('#ganancia_unitaria_' + i).text());
            var cantidad_fila = parseInt($('#' + i + '.cantidad').val());
            var ganancia_total_all = cantidad_fila * ganancia_unitaria_fila;
            sumatoria = ganancia_total_all + sumatoria;
        }
        $('#ganancia_total_all').text(sumatoria.toFixed(2));
        //FIN BLOQUE CALCULO SUMATORIA GANANCIA TOTAL
        //BLOQUE CALCULO SUMATORIA PRESUPUESTO X COMPRA

        var sumatoria = 0;
        for (var i = 0; i < contador_productos; i++) {

            var cantidad_fila = parseInt($('#' + i + '.cantidad').val());
            var costo_unitario_fila = parseFloat($('#' + i + '.costo_unitario').val());
            var obteniendo_presupuesto = cantidad_fila * costo_unitario_fila;
            sumatoria = parseFloat(obteniendo_presupuesto) + sumatoria;
        }
        $('#presupuesto_x_compra').text(sumatoria.toFixed(2));
        //FINBLOQUE CALCULO SUMATORIA  PRESUPUESTO X COMPRA
    });
    $("body").on("blur", ".precio_unitario_venta", function () { // USD
        var numero_fila = $(this).attr('id');
        $('#' + numero_fila + '.precio_unitario_venta_soles').val(0);
        var precio_unitario_venta_fila = $(this).val();
        var costo_unitario_total_fila = $('#costo_unitario_total_' + numero_fila).text();
        var ganancia_unitaria_fila = parseFloat(precio_unitario_venta_fila) - parseFloat(costo_unitario_total_fila);
        $('#ganancia_unitaria_' + numero_fila).text(ganancia_unitaria_fila.toFixed(2));
        var cantidad_fila = $('#' + numero_fila + '.cantidad').val();
        var precio_total_fila = parseFloat(precio_unitario_venta_fila) * parseFloat(cantidad_fila);
        $('#precio_total_' + numero_fila).text(precio_total_fila.toFixed(2));
        //BLOQUE CALCULO SUMATORIA PRECIO TOTAL

        var sumatoria = 0;
        for (var i = 0; i < contador_productos; i++) {

            precio_total_fila = $('#precio_total_' + i).text();
            if (precio_total_fila != '') {

                sumatoria = parseFloat(precio_total_fila) + sumatoria;
            }
        }
        $('.precio_total_sumatoria').text(sumatoria);
        $('#total_all_pedido').text(sumatoria.toFixed(2));
        //FINBLOQUE CALCULO SUMATORIA PRECIO TOTAL

        //BLOQUE CALCULO SUMATORIA GANANCIA TOTAL
        var sumatoria = 0;
        for (var i = 0; i < contador_productos; i++) {
            var ganancia_unitaria_fila = parseFloat($('#ganancia_unitaria_' + i).text());
            var cantidad_fila = parseInt($('#' + i + '.cantidad').val());
            var ganancia_total_all = cantidad_fila * ganancia_unitaria_fila;
            sumatoria = ganancia_total_all + sumatoria;
        }
        $('#ganancia_total_all').text(sumatoria.toFixed(2));
        //FIN BLOQUE CALCULO SUMATORIA GANANCIA TOTAL


    });
    $("body").on("blur", ".precio_unitario_venta_soles", function () {
        var calculo_cambio = false;
        var numero_fila = $(this).attr('id');
        if ($('#' + numero_fila + '.precio_unitario_venta').val() == '' || calculo_cambio == true) {

//BLOQUE OPERACION PARA LA CONVERSION
            var precio_unitario_venta_soles = $(this).val();
            //OPERANDO 
            var precio_unitario_conversion_dolares = parseFloat(precio_unitario_venta_soles) / tc_compra;
            $('#' + numero_fila + '.precio_unitario_venta').val(precio_unitario_conversion_dolares.toFixed(2));
            var costo_unitario_total = $('#costo_unitario_total_' + numero_fila).text();
            var ganancia_unitaria = parseFloat(precio_unitario_conversion_dolares) - parseFloat(costo_unitario_total);
            $('#ganancia_unitaria_' + numero_fila).text(ganancia_unitaria.toFixed(2));
            //FIN BLOQUE OPERACION PARA LA CONVERSION
            //-----OPERACION PARA OBTENER EL PRECIO TOTAL
            var cantidad_fila = $('#' + numero_fila + '.cantidad').val();
            var precio_total_fila = precio_unitario_conversion_dolares * parseFloat(cantidad_fila);
            $('#precio_total_' + numero_fila).text(precio_total_fila.toFixed(2));
            calculo_cambio = true;
            //----- FIN OPERACION PARA OBTENER EL PRECIO TOTAL

            //BLOQUE CALCULO SUMATORIA PRECIO TOTAL

            var sumatoria = 0;
            for (var i = 0; i < contador_productos; i++) {

                precio_total_fila = $('#precio_total_' + i).text();
                if (precio_total_fila != '') {

                    sumatoria = parseFloat(precio_total_fila) + sumatoria;
                }
            }
            $('.precio_total_sumatoria').text(sumatoria.toFixed(2));
            $('#total_all_pedido').text(sumatoria.toFixed(2));
            //FINBLOQUE CALCULO SUMATORIA PRECIO TOTAL

            //BLOQUE CALCULO SUMATORIA GANANCIA TOTAL
            var sumatoria = 0;
            for (var i = 0; i < contador_productos; i++) {
                var ganancia_unitaria_fila = parseFloat($('#ganancia_unitaria_' + i).text());
                var cantidad_fila = parseInt($('#' + i + '.cantidad').val());
                var ganancia_total_all = cantidad_fila * ganancia_unitaria_fila;
                sumatoria = ganancia_total_all + sumatoria;
            }
            $('#ganancia_total_all').text(sumatoria.toFixed(2));
            //FIN BLOQUE CALCULO SUMATORIA GANANCIA TOTAL
        }


    });
    var agregarFila = function (codigo_producto, nombre_producto, cantidad_requerida, costo_total_unitario, peso_producto) {
        shipping_unitario = peso_producto * costo_x_libra_del_dia;
        costo_unit_total = parseFloat(costo_unitario_producto) + shipping_unitario;
        costo_unit_total = costo_unit_total.toFixed(2);
        CalcularCostoTotalProducto();
        var htmlTags = '<tr>' +
                '<td id="td_cod_producto_' + contador_productos + '">' + codigo_producto + '</td>' +
                '<td>' + nombre_producto + '</td>' +
                '<td id="td_cantidad_producto_' + contador_productos + '"><input type="text" size="3" id="' + contador_productos + '" class="cantidad" value="' + cantidad_requerida + '"></td>' +
                '<td> <input type="text" size="3" value="' + costo_unitario_producto + '" id="' + contador_productos + '" class="costo_unitario"></td>' +
                '<td><input type="text" id="' + contador_productos + '" class="peso_libras" size="3" value="' + peso_producto + '" placeholder="Libras"></td>' +
                '<td id="shipping_unitario_' + contador_productos + '">' + shipping_unitario.toFixed(2) + '</td>' +
                '<td id="costo_unitario_total_' + contador_productos + '" class="costo_unitario_total">' + costo_unit_total + '</td>' +
                '<td id="costo_total_producto_' + contador_productos + '">' + costo_unit_total + '</td>' +
                '<td class="ganancia_unitaria" id="ganancia_unitaria_' + contador_productos + '"></td>' +
                '<td><input type="text" size="3" id="' + contador_productos + '" class="precio_unitario_venta"></td>' +
                '<td><input type="text" size="3" id="' + contador_productos + '" class="precio_unitario_venta_soles"></td>' +
                '<td id="precio_total_' + contador_productos + '"></td>' +
                '</tr>';
        $('#tablapedido tbody').append(htmlTags);
        //BLOQUE CALCULO SUMATORIA COSTO UNITARIO TOTAL
        var sumatoria = 0;
        for (var i = 0; i <= contador_productos; i++) {

            costo_unitario_total_fila = $('#costo_unitario_total_' + i).text();
            if (costo_unitario_total_fila != '') {
                sumatoria = parseFloat(costo_unitario_total_fila) + sumatoria;
                $('.costo_unitario_total_sumatoria').text(sumatoria.toFixed(2));
            }
        }

        //FIN BLOQUE CALCULO SUMATORIA COSTO UNITARIO TOTAL

        //BLOQUE CALCULO SUMATORIA PRECIO TOTAL

        var sumatoria = 0;
        for (var i = 0; i < contador_productos; i++) {

            precio_total_fila = $('#precio_total_' + i).text();
            if (precio_total_fila != '') {

                sumatoria = parseFloat(precio_total_fila) + sumatoria;
            }
        }
        $('.precio_total_sumatoria').text(sumatoria);
        $('#total_all_pedido').text(sumatoria.toFixed(2));
        //FINBLOQUE CALCULO SUMATORIA PRECIO TOTAL

        //BLOQUE CALCULO SUMATORIA SHIPPING TOTAL
        var sumatoria = 0;
        for (var i = 0; i <= contador_productos; i++) {
            var cantidad = parseInt($('#' + i + '.cantidad').val());
            var shipping_unitario = parseFloat($('#shipping_unitario_' + i).text());
            var operacion_calculo_shipping = cantidad * shipping_unitario;
            sumatoria = operacion_calculo_shipping + sumatoria;
        }
        $('#shipping_all_pedido').text(sumatoria);
        $('#presupuesto_x_envio').text(sumatoria);
        //FIN BLOQUE CALCULO SUMATORIA SHIPPING TOTAL
        //==========================================
        //BLOQUE CALCULO SUMATORIA GANANCIA TOTAL
        var sumatoria = 0;
        for (var i = 0; i < contador_productos; i++) {
            var cantidad = parseInt($('#' + i + '.cantidad').val());
            var ganancia_unitaria = parseFloat($('#ganancia_unitaria_' + i).text());
            var ganancia_total_all = cantidad * ganancia_unitaria;
            sumatoria = ganancia_total_all + sumatoria;
        }
        $('#ganancia_total_all').text(sumatoria);
        //FIN BLOQUE CALCULO SUMATORIA GANANCIA TOTAL
        //BLOQUE CALCULO SUMATORIA COSTOS TOTALES

        var sumatoria = 0;
        for (var i = 0; i <= contador_productos; i++) {

            costo_total_producto_fila = $('#costo_total_producto_' + i).text();
            if (costo_total_producto_fila != '') {

                sumatoria = parseFloat(costo_total_producto_fila) + sumatoria;
            }
        }
        $('#costos_totales_all').text(sumatoria.toFixed(2));
        //FINBLOQUE CALCULO SUMATORIA  COSTOS TOTALES

        //BLOQUE CALCULO SUMATORIA PRESUPUESTO X COMPRA
        var sumatoria = 0;
        for (var i = 0; i <= contador_productos; i++) {

            var cantidad_fila = parseInt($('#' + i + '.cantidad').val());
            var costo_unitario_fila = parseFloat($('#' + i + '.costo_unitario').val());
            var obteniendo_presupuesto = cantidad_fila * costo_unitario_fila;
            sumatoria = parseFloat(obteniendo_presupuesto) + sumatoria;
        }
        $('#presupuesto_x_compra').text(sumatoria.toFixed(2));
        //FINBLOQUE CALCULO SUMATORIA  PRESUPUESTO X COMPRA


        contador_productos++;
    }

    $("body").on("click", ".btn_crear_pedido", function () {
        codigo_cliente_tbl_pedido = $('#span_codigo_cliente').text();
        shipping_all_pedido_tbl_pedido = $('#shipping_all_pedido').text();
        costos_totales_all_tbl_pedido = $('#costos_totales_all').text();
        total_all_pedido_tbl_pedido = $('#total_all_pedido').text(); //PRECIO TOTAL
        abono_tbl_pedido = $('#abono').val();
        saldo_tbl_pedido = $('#saldo').text();
        costo_por_libra = costo_x_libra_del_dia
        presupuesto_x_compra_tbl_pedido = $('#presupuesto_x_compra').text();
        presupuesto_x_envio_tbl_pedido = $('#presupuesto_x_envio').text();

        var ProductosObj = [];
        myObjPedidoDetalle = {};
        for (var i = 0; i < contador_productos; i++) {
            nombrekey = 'detalle_pedido_' + i;
            var codigo_producto = $('#td_cod_producto_' + i).text();
            var cantidad = $('#' + i + '.cantidad').val();
            var costo_unitario = $('#' + i + '.costo_unitario').val();
            var pesolibras = $('#' + i + '.peso_libras').val();
            var shipping_unitario_ = $('#shipping_unitario_' + i).text();
            var costo_unitario_total = $('#costo_unitario_total_' + i).text();
            var ganancia_unitaria = $('#ganancia_unitaria_' + i).text();
            var precio_unitario_venta = $('#' + i + '.precio_unitario_venta').val();
            var precio_unitario_venta_soles = $('#' + i + '.precio_unitario_venta_soles').val();
            var precio_total = $('#precio_total_' + i).text();
//            myObjPedidoDetalle = {};

            item = {}
            item ["codigo_producto"] = codigo_producto;
            item ["cantidad"] = cantidad;
            item ["costo_unitario_producto"] = costo_unitario;
            item ["peso_libras"] = pesolibras;
            item ["shipping_unitario"] = shipping_unitario_;
//            item ["costo_unitario_total"] = costo_unitario_total;
            item ["ganancia_unitaria"] = ganancia_unitaria;
            item ["precio_unitario_usd"] = precio_unitario_venta;
            item ["precio_unitario_pen"] = precio_unitario_venta_soles;
            item ["precio_total"] = precio_total;
            ProductosObj.push(item);
        }

        codigo_pedido = $('#span_nro_pedido').text();
        var myObjPedido;
        myObjPedido = {
            "codigo": codigo_pedido,
            "cliente_codigo": codigo_cliente_tbl_pedido,
            "shipping_total": shipping_all_pedido_tbl_pedido,
            "costos_totales": costos_totales_all_tbl_pedido,
            "precio_total": total_all_pedido_tbl_pedido,
            "abono": abono_tbl_pedido,
            "saldo": saldo_tbl_pedido,
            "costo_x_libra": costo_por_libra,
            "presupuesto_x_compra": presupuesto_x_compra_tbl_pedido,
            "presupuesto_x_envio": presupuesto_x_envio_tbl_pedido,
            "detalle_pedido": ProductosObj
        };
        $.ajax({
            type: 'POST',
            url: 'http://35.238.63.231/siv/operaciones/Pedidos/CrearPedido',
            data: 'json=' + JSON.stringify(myObjPedido),
            success: function (respuesta) {
//                console.log(respuesta);
                window.location.href = "Pedidos/ListarPedidos";
            },
            error: function () {
//                console.log(respuesta);
                console.log("No se ha podido obtener la información");
            }
        });
    });

    var i_abono = parseInt($('#last_abono').val()) + 1;
    $("body").on("click", "#btn_agregar_abono", function () {
        var select_body = '';
        select_body = "<select class='form-control select_cuentas' id=" + i_abono + ">";
        select_body += $('.select_cuentas').html();
        select_body += "</select>";

        var tbl_abonos = '<tr>' +
                '<td></td>' +
                '<td>' + i_abono + '</td>' +
                '<td><input type="text" class="form-control input-sm monto_abono" id="' + i_abono + '"></td>' +
                '<td>' + select_body + '</td>' +
                '<td><input type="hidden" id="' + i_abono + '" class="monto_usd"></td>'
        '</tr>';

//        console.log(select_body);
//        return false;
        $('#tbl_lista_pedido_detalle tbody').append(tbl_abonos);

        i_abono++;
    });
    $('#saldo_por_cobrar').text($('#saldo').text());
    $("body").on("change", ".select_cuentas", function () {
        var fila_select = $(this).attr('id');
        $('#' + fila_select + '.monto_abono').val(0);
        $('#' + fila_select + '.monto_usd').val(0);
        var sumatoria_monto_total = 0;
        for (var i = 1; i < i_abono; i++) {
            var monto_usd_hidden = $('#' + i + '.monto_usd').val();
            var monto_usd = parseFloat(monto_usd_hidden);
            var sumatoria_monto_total = monto_usd + sumatoria_monto_total;
        }
        $('#monto_total_cal').text(sumatoria_monto_total.toFixed(2));
        var precio_total_sumatoria = parseFloat($('#precio_total_sumatoria').text());
        var res_saldo = precio_total_sumatoria - sumatoria_monto_total;
        $('#saldo').text(res_saldo.toFixed(2));
        $('#saldo_por_cobrar').text(res_saldo.toFixed(2));

    });
    $("body").on("blur", ".monto_abono", function () {
        var fila_abono = $(this).attr('id');

        monto_abono_establecido = $(this).val();
        monto_abono_establecido = (monto_abono_establecido == '') ? 0 : parseFloat(monto_abono_establecido);
        var tipo_moneda_establecida = $("#" + fila_abono + '.select_cuentas').val();

        //si es soles entra a la condicion para la conversion de la moneda
        if (tipo_moneda_establecida === 'PEN') {
            var tc_cambio = $('#tc_today').val();
            var monto_abono_convertido = monto_abono_establecido / parseFloat(tc_cambio);
            $('#' + fila_abono + '.monto_usd').val(monto_abono_convertido.toFixed(2));
        } else {
            $('#' + fila_abono + '.monto_usd').val(monto_abono_establecido);
        }

        var sumatoria_monto_total = 0;
        for (var i = 1; i < i_abono; i++) {
            var monto_usd_hidden = $('#' + i + '.monto_usd').val();
            if (monto_usd_hidden != '') {
                var monto_usd = parseFloat(monto_usd_hidden);
                var sumatoria_monto_total = monto_usd + sumatoria_monto_total;
            }
        }
        $('#monto_total_cal').text(sumatoria_monto_total.toFixed(2));
        var precio_total_sumatoria = parseFloat($('#precio_total_sumatoria').text());
        var res_saldo = precio_total_sumatoria - sumatoria_monto_total;
        $('#saldo').text(res_saldo.toFixed(2));
        $('#saldo_por_cobrar').text(res_saldo.toFixed(2));

    });

    $("body").on("click", ".btn_guardar", function () {
        var MontosObj = [];

        for (var i = 1; i < i_abono; i++) {
            var cuenta_id = $('#' + i + '.select_cuentas option:selected').attr('id');
            var moneda = $('#' + i + '.select_cuentas').val();
            var monto_ingresado = $('#' + i + '.monto_abono').val();
            var monto_usd = $('#' + i + '.monto_usd').val();
//            return false;
            item = {}
            item ["numero_abono"] = i;
            item ["monto"] = monto_ingresado;
            item ["monto_usd"] = monto_usd;
            item ["cuenta_id"] = cuenta_id;
            item ["moneda"] = moneda;
            MontosObj.push(item);
        }
//        return false;
        var codigo_pedido = $('#codigo_pedido').val();
        var cliente_codigo = $('#cliente_codigo').val();
        var saldo_por_cobrar = $('#saldo_por_cobrar').text();

        $.ajax({
            type: 'POST',
            url: 'http://35.238.63.231/siv/operaciones/Pedidos/GuardarAbonos',
            data: 'json=' + JSON.stringify(MontosObj) + '&codigo_pedido=' + codigo_pedido + '&pedido_cliente_codigo=' + cliente_codigo + '&saldo_por_cobrar=' + saldo_por_cobrar,
            success: function (respuesta) {
                console.log(respuesta);
                window.location.href = "http://35.238.63.231/siv/operaciones/Pedidos/VerDetallePedido?codigo_pedido=" + codigo_pedido;
            },
            error: function () {
//                console.log(respuesta);
                console.log("No se ha podido obtener la información");
            }
        });
    });
    $('#tbl_list_pedidos').DataTable();
});