$(function () {

    $("body").on("click", "#btn_agregar_abono", function () {
        $('#entradaAddAbono').focus();
    });
    $("body").on("change", ".select_productos", function () {
        var data                            =       this.value;
        var cantLibras                      =       $('#cantLibras').val();
        var shpUnit                         =       $('#shippingUnitario').val();
        var cantidadProducto                =       $('#cantidadProducto').val();
        val                                 =       data.split('|');
        var id                              =       val[0];
        var precio                          =       val[1];
        var cut                             =       calcularCostoUnitarioTotal(precio,shpUnit,cantLibras,false);
        calcularCostoTotalProducto(cut,cantidadProducto,true)

        $('#cup').val(precio);
        
        $('#cut').val(cut);

    });

    // $("body").on("change", "#cantLibras", function () {
    //     var cant_libras = parseFloat(this.value);
    //     var costo_x_libra = parseFloat($('#costo_x_libra').text());
    //     var resShippingUnit = calcularShippingUnitario(cant_libras,costo_x_libra);
    //     $('#shippingUnitario').val(resShippingUnit.toFixed(2));
    // });

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
            success: function (data) {
                // location.reload();
                $('#bloque_pedido_detalle').html(data);
                MostrarAvisoProceso('Abono modificado', 'success');   
            }
        });
        event.preventDefault();
    });

    /*
    @Author: Carlos Gutierrez
    @Version: 24/08/2019
    Este metodo sirve para enviar el formulario
    */
    $("#formAddProducto").submit(function (event) {

        var parametros = $(this).serialize();
        
        $.ajax({
            type: 'POST',
            url: '/siv/operaciones/Pedidos/AgregarProductoPedido',
            data: parametros,
            success: function (data) {
                $('#bloque_pedido_detalle').html(data);
                MostrarAvisoProceso('Producto agregado', 'success');   
            },
           
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

function agregar(elemento) {

    if ($("#fila_add_"+elemento).css("display") == 'none') {
        $('#fila_add_'+elemento).show();
        $("#btn_add_"+elemento).attr("class", "fa fa-minus");
        $('#btn_agregar_'+elemento).attr('title', 'Quitar bloque para agregar '+elemento)
    } else {
        $("#btn_add_"+elemento).attr("class", "fa fa-plus");
        $('#fila_add_'+elemento).hide();
        $('#btn_agregar_'+elemento).attr('title', 'Agregar '+elemento)
    }
}

function CambiarValorSelectProducto(elemento){
    data = elemento.value;

    data_pre = elemento.data-precio;
    console.log(data_pre);
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

/*
@Author: Carlos Gutierrez
@Version: 24/08/2019
Se agrega método para calcular el Costo Unitario Total del producto
*/

function calcularCostoUnitarioTotal(costoUnitarioProducto,shippingUnitario,cantLibras,set=null)
{

    var cantLibras                  =       parseFloat(cantLibras);
    var costoUnitarioProducto       =       parseFloat(costoUnitarioProducto);
    var shippingUnitario            =       parseFloat(shippingUnitario);
    var recalculoShipUnit           =       cantLibras * shippingUnitario;
    var costoUnitarioTotal          =       costoUnitarioProducto + recalculoShipUnit;
    var cantidadProducto            =       parseFloat($('#cantidadProducto').val()).toFixed(2);
    costoUnitarioTotal.toFixed(2);

    if(set)
    {
        $('#cut').val(costoUnitarioTotal.toFixed(2));
        //Se reacalcula tambien el Costo total del Producto
        calcularCostoTotalProducto(costoUnitarioTotal,cantidadProducto,true);
    }else{

        return costoUnitarioTotal.toFixed(2);
    }
}

/*
@Author: Carlos Gutierrez
@Version: 24/08/2019
Se agrega método para calcular el Costo total del producto
*/
function calcularCostoTotalProducto(costoUnitarioTotal,cantidadProducto,set=false)
{
    var costoUnitarioTotal              =               parseFloat(costoUnitarioTotal);
    var cantidadProducto                =               parseInt(cantidadProducto);
    var costoTotalProducto              =               (costoUnitarioTotal * cantidadProducto).toFixed(2);
    if(set)
    {
        $('#costoTotalProducto').val(costoTotalProducto);
    }else
    {
        return costoTotalProducto;
    }
}
/*
@Author: Carlos Gutierrez
@Version: 24/08/2019
Se agrega método para calcular el Shipping Unitario
*/
function calcularShippingUnitario(cantLibras,costoPorLibra,establecer)
{
    var cantLibras              =               parseFloat(cantLibras);
    var costoPorLibra           =               parseFloat(costoPorLibra);
    var shippingUnitario =  (cantLibras * costoPorLibra).toFixed(2);
    if(establecer)
    {
        $('#shippingUnitario').val(shippingUnitario);
    }
    else
    {
        return shippingUnitario;
    }
}
/*
@Author: Carlos Gutierrez
@Version: 24/08/2019
Se agrega método para calcular el precio total
*/
function calcularPrecioTotal(cantidadProducto,precioUnitarioDeVenta,establecer=false)
{
   
    var cantidadProducto                =               parseInt(cantidadProducto);
    var precioUnitarioDeVenta           =               parseFloat(precioUnitarioDeVenta);
    var precioTotal                     =               (cantidadProducto * precioUnitarioDeVenta).toFixed(2);
    if(!isNaN(precioUnitarioDeVenta)){
        if(establecer){
            $('#precioTotal').val(precioTotal);
        }else{
            return precioTotal;
        }
    }
}
/*
@Author: Carlos Gutierrez
@Version: 25/08/2019
Se agrega método para calcular la Ganancia Unitaria
*/
function calcularGananciaUnitaria(costoUnitario,precioUnitarioVenta,establecer)
{
   var costoUnitario                    =               parseFloat(costoUnitario);
   var precioUnitarioVenta              =               parseFloat(precioUnitarioVenta);
   var gananciaUnitaria                 =               (precioUnitarioVenta - costoUnitario).toFixed(2);
   if(establecer){
        $('#gananciaUnitaria').val(gananciaUnitaria);
   }else{
       return gananciaUnitaria;
   }
}

$(document).on('dblclick','.modificarCantidadProd',function (arg) {
    var valor=$(this).attr('name');
    var id = this.id;
    var padre=this.parentElement;
    $(this).addClass('hide');
    var form=   '<div>'+
                    '<div class="row">'+
                        '<input type="text" value="'+valor+'" style="width: 90px;margin: 0 -10px 5px -10px;" class="form-control input-linea input-sm cantidad'+id+'">'+
                    '</div>'+
                    '<div class="row">'+
                        '<button class="btn btn-success btn-sm btn-asignar" style="padding: 3px;" id="'+id+'">Asignar</button> '+
                        '<button class="btn btn-danger btn-sm btn-cancelar" style="padding: 3px;" id="'+id+'">Cancelar</button> '+
                    '</div>'+
                '</div>';
    $(padre).append(form);
});
$(document).on('click','.btn-cancelar',function (arg) {
    var span=$(this.parentElement.parentElement.previousElementSibling);
    var padre=$(this.parentElement.parentElement);
    padre.remove();
    span.removeClass('hide');
});

$(document).on('click','.btn-asignar',function (arg) {
    var pedido_codigo = $('#codigo_pedido').val();
	var idPedidoDetalle=this.id;
	var span=$(this.parentElement.parentElement.previousElementSibling);
	var padre=$(this.parentElement.parentElement);
	var value=$(".cantidad"+idPedidoDetalle).val();
	$.ajax({
        type: 'POST',
        url: '/siv/operaciones/Pedidos/ModificarCantidadDeProducto',
        data: 'idPedidoDetalle='+idPedidoDetalle+'&cantidad='+value+'&pedido_codigo='+pedido_codigo,
        success: function (data) {
            $('#bloque_pedido_detalle').html(data);
                    MostrarAvisoProceso('Cantidad modificada', 'success');
        }
        
    });
});







