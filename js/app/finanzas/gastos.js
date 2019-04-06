$(function () {
    $('.btn_agregar_gastos').click(function(){
        
        valor = $(this).attr('id');
        if(valor =='false'){
            $('#form_ingreso_gastos').show();
            $(this).attr("id","true");  
            
        }else{
            
            $(this).attr("id","false");  
            $('#form_ingreso_gastos').hide();
        }
//        $('#form_ingreso_gastos').css( "display", "block" );
    })
    $('.datepicker').datepicker({
        autoclose: true
    })

    $('#tbl_gastos').DataTable({
        'paging': true,
        'lengthChange': false,
        'ordering': true,
        'info': true,
        'autoWidth': false
    })
});