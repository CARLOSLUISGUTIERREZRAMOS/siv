$(function () {

    $(document).ready(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_minimal',
            radioClass: 'iradio_minimal',
            increaseArea: '20%' // optional
            
        });
    });
    
    $('#btn').click(function(){
        $('.p').iCheck('uncheck');
    })
    
    

});