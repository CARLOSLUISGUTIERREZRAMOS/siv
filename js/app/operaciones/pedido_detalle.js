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
            var numcuenta = button.data('numcuenta');
            var codigopedido = button.data('codigopedido'); 
            var titular = button.data('titular'); 
            var montoPen = button.data('montopen'); 
            var montoUsd = button.data('montousd'); 
            var moneda = button.data('moneda'); 
            var numcuenta = button.data('numcuenta');
            var cuenta_bancaria_id = button.data('cuenta_bancaria_id');
            
            var modal = $(this)
            modal.find('.modal-title').text('Detalle de Abono N° '+numeroabono)
            modal.find('.modal-body #montoAbonado').val((moneda === 'USD') ? montoUsd : montoPen);
          })
    $("body").on("click", ".ico_edit_abono", function () {


        var codigoPedido =  $(this).attr("data-pedido");
        var numAbono =  $(this).attr("id");
        $('#exampleModal').modal({
            show: true
        });
        
        return false;
        
        $.post("/siv/operaciones/Pedidos/ObtenerAbono", { numAbono: numAbono,codigoPedido: codigoPedido })
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