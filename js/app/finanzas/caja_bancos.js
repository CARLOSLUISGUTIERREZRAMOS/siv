$(function () {


    $('#rango_fechas').daterangepicker();

    $('#elmento_pen').click(function () {
        $('#modal-detalle_cajabancos').modal('show');
    });

    $(document).ready(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_minimal',
            increaseArea: '20%' // optional
        });
    });
    
    $('#btn_busqueda').click(function(){
       var fecha = $('#rango_fechas').val(); 
       console.log(fecha);
    });
    
    
    
    
});