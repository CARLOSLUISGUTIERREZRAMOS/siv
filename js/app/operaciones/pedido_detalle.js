$(function () {

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
        var numeroabono = button.data('numeroabono'); // Extraer la información de atributos de datos
        var montoPen = button.data('montopen');
        var montoUsd = button.data('montousd');
        var tipoCambio = button.data('tipocambio');
        var moneda = button.data('moneda');
        var codigoPedido = button.data('codigopedido');
        var cuenta_bancaria_id = button.data('cuentabancaria');
        var modal = $(this)
        modal.find('.modal-title').text('Detalle de Abono N° ' + numeroabono)
        modal.find('.modal-body #montoAbonado').val((moneda === 'USD') ? montoUsd : montoPen);
        modal.find('.modal-body #numeroAbono').val(numeroabono);
        modal.find('.modal-body #pedidoCodigo').val(codigoPedido);
        modal.find('.modal-body #cuentaBancaria').val(cuenta_bancaria_id);
        $('#select_cuentas').val(cuenta_bancaria_id).prop('selecsted', true);
    })

    $("#actualidarDatos").submit(function (event) {
        
        var parametros = $(this).serialize();
        console.log(parametros);


        $.ajax({
            type: "POST",
            url: "/siv/operaciones/Pedidos/ModificarAbono",
            data: parametros,
            beforeSend: function (objeto) {
                $("#datos_ajax").html("Guardando cambios...");
            },
            success: function (datos) {
                console.log(datos);
                // $("#datos_ajax").html(datos);

                load(1);
            }
        });
        event.preventDefault();
    });

    $("body").on("click", ".ico_edit_abono", function () {


        var codigoPedido = $(this).attr("data-pedido");
        var numAbono = $(this).attr("id");
        $('#exampleModal').modal({
            show: true
        });

        return false;

        $.post("/siv/operaciones/Pedidos/ObtenerAbono", { numAbono: numAbono, codigoPedido: codigoPedido })
            .done(function (data) {
                console.log(data);
                $('#exampleModal').modal('show');
            });


    });
});



function redireccionar() {
    location.reload();
}




function eliminarProductoPedido(id) {

    console.log(id);
}

function calcularPresupuestoEnvio(stockProducto, shippingUnitario) {


    return presupuestoEnvio;
}

function useReturnData(data) {
    result = data;

};

function load(page){
    var parametros = {"action":"ajax","page":page};
    $("#loader").fadeIn('slow');
    $.ajax({
        url:'/siv/operaciones/Pedidos/VerDetallePedido',
        data: parametros,
         beforeSend: function(objeto){
        $("#loader").html("<img src='loader.gif'>");
        },
        success:function(data){
            $(".outer_div").html(data).fadeIn('slow');
            $("#loader").html("");
        }
    })
}