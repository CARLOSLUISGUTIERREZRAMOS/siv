$(function () {
    
     $.ajax({
            type: "POST",
            url: '/siv/finanzas/Tax/ValidarExistenciaTipoCambio',
            success: function (data)
            {
                if(data=='EXISTE_TIPOCAMBIO'){
                }else if(data == 'NOEXISTE_TIPOCAMBIO'){
                    $('#modal_tipo_cambio').modal('show');
                    
                }
            }
        });
    
        
    
    
});