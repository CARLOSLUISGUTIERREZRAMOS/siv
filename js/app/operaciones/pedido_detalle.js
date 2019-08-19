$(function () {

    $("body").on("click", "#btn_agregar_abono", function () {
        $('#entradaAddAbono').focus();
    });

    $("body").on("click", ".del_prodpedido", function () {
        
        id = $(this).attr('id');
        codigo_pedido = $('#codigo_pedido').val();
        nombreProducto = $(this).parents("tr").find("td")[1].innerHTML;
        Swal.fire({
            title: '¿Seguro de eliminar?',
            text: "Eliminarás " + nombreProducto + ' del Pedido',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, estoy seguro.',
        }).then((result) => {
            if (result.value) {
                $.post("/siv/operaciones/Pedidos/EliminarPedido", { pedido_detalle_id: id, codigo_pedido: codigo_pedido })
                    .done(function (data) {
                        $('#bloque_pedido_detalle').html(data);
                        MostrarAvisoProceso('Producto eliminado de pedido.', 'success');        
                    });
            }
        })
    });
    $('#editaAbonoModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Botón que activó el modal
        var idabono = button.data('idabono'); // Extraer la información de atributos de datos
        var montoPen = button.data('montopen');
        var montoUsd = button.data('montousd');
        var tipoCambio = button.data('tipocambio');
        var moneda = button.data('moneda');
        var codigoPedido = button.data('codigopedido');
        var cuenta_bancaria_id = button.data('cuentabancaria');
        var modal = $(this)
        modal.find('.modal-title').text('Detalles de abono N° ' + idabono)
        modal.find('.modal-body #montoAbonado').val((moneda === 'USD') ? montoUsd : montoPen);
        modal.find('.modal-body #idabono').val(idabono);
        modal.find('.modal-body #pedidoCodigo').val(codigoPedido);
        modal.find('.modal-body #cuentaBancaria').val(cuenta_bancaria_id);
        modal.find('.modal-body #tipoCambio').val(tipoCambio);
        $('.select_cuentas_modal').val(cuenta_bancaria_id).prop('selected', true);
    })

    $("#actualidarDatos").submit(function (event) {

        var parametros = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "/siv/operaciones/Pedidos/ModificarAbono",
            data: parametros,
            beforeSend: function (objeto) {
                $("#datos_ajax").html("Guardando cambios...");
            },
            success: function (datos) {
                location.reload();
            }
        });
        event.preventDefault();
    });

    $("body").on("submit", "#agregarAbono", function () {
    // $("#agregarAbono").on('submit', function (event) {
        var parametros = $(this).serialize();
        $.post("/siv/operaciones/Pedidos/AgregarAbono", parametros)
            .done(function (data) {
                $('#bloque_pedido_detalle').html(data);
                MostrarAvisoProceso('Abono agregado', 'success');
            });
        event.preventDefault();
    });

});


function eliminarAbono(elemento) {

    var codigoPedido = $(elemento).data('codigopedido');
    var idAbono = $(elemento).data('idabono');

    Swal.fire({
        title: '¿Seguro de eliminar?',
        text: "Eliminarás el abono N° " + idAbono + ' del Pedido',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, estoy seguro.',

    }).then((result) => {
        if (result.value) {
            $.post("/siv/operaciones/Pedidos/EliminarAbono", { codigopedido: codigoPedido, idabono: idAbono })
                .done(function (data) {
                    $('#bloque_pedido_detalle').html(data);
                    MostrarAvisoProceso('Abono eliminado', 'success');
                });
        }
    })

}

function MostrarAvisoProceso(title, tipo) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    })

    Toast.fire({
        type: tipo,
        title: title
    })
}

function MensajeSweetAlert(tipo, mensaje) {
    var color;
    if (tipo == "success") {
        color = "rgba(165, 220, 134, 0.45)";
    }
    else if (tipo == "warning") {
        color = "rgba(255, 193, 7, 0.54)";
    }
    else if (tipo == "error") {
        color = "rgba(242, 116, 116, 0.45)";
    }
    swal({
        title: mensaje,
        type: tipo,
        button: "Cerrar",
        timer: "4000",
        backdrop: color
    });
}

function agregarAbono() {

    document.getElementById("entradaAddAbono").focus();
    

    if ($("#fila_add_abono").css("display") == 'none') {
        $('#fila_add_abono').show();
        $("#btnAbonoAdd").attr("class", "fa fa-minus");
        $('#btn_agregar_abono').attr('title', 'Quitar bloque para agregar abono.')
    } else {
        $("#btnAbonoAdd").attr("class", "fa fa-plus");
        $('#fila_add_abono').hide();
        $('#btn_agregar_abono').attr('title', 'Agregar abono.')
    }
}

function RecargaPagina(mensaje) {

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    })

    Toast.fire({
        type: 'success',
        title: mensaje
    })

}
function calcularPresupuestoEnvio(stockProducto, shippingUnitario) {
    return presupuestoEnvio;
}

function useReturnData(data) {
    result = data;

}




