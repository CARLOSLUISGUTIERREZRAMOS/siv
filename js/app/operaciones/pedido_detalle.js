$(function () {

    //AQUI UN CAMBIO

    $("body").on("click", ".del_prodpedido", function () {
        id = $(this).attr('id');
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
            console.log(result);
            if (result.value) {
                $.post("/siv/operaciones/Pedidos/EliminarPedido", { pedido_detalle_id: id })
                    .done(function (data) {
                        location.reload();
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

    $("#agregarAbono").submit(function (event) {
        var parametros = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "/siv/operaciones/Pedidos/AgregarAbono",
            data: parametros,
            beforeSend: function (objeto) {
                setTimeout(function () {
                    RecargaPagina('Abono agregado');
                }, 4000);
            },
            success: function (data) {
                setTimeout(function () {
                    RecargaPagina('Abono agregado');
                }, 4000);
            },
            complete: function () {
                location.reload();
            }
        });

        event.preventDefault();
    });

    //     $("body").on("click", ".ico_edit_abono", function () {


    //         var codigoPedido = $(this).attr("data-pedido");
    //         var numAbono = $(this).attr("id");
    //         $('#exampleModal').modal({
    //             show: true
    //         });

    //         return false;

    //         $.post("/siv/operaciones/Pedidos/ObtenerAbono", { numAbono: numAbono, codigoPedido: codigoPedido })
    //             .done(function (data) {
    //                 console.log(data);
    //                 $('#exampleModal').modal('show');
    //             });


    //     });
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

                    /*  setTimeout(function () {
                         RecargaPagina('Abono eliminado');
                     }, 2000); */
                    location.reload();
                });
        }
    })

}

function agregarAbono() {

    //  PantallaBloqueada();
    

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
// function GuardarNuevoAbono() {

//     $("#form_agregarabono").submit(function (event) {

//         var parametros = $(this).serialize();

//         event.preventDefault();
//     });
// }

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

function PantallaBloqueada(){
    $.blockUI({ css: { 
        border: 'none', 
        padding: '15px', 
        backgroundColor: '#000', 
        '-webkit-border-radius': '10px', 
        '-moz-border-radius': '10px', 
        opacity: .5, 
        color: '#fff' 
    } }); 

    setTimeout($.unblockUI, 2000); 
}


