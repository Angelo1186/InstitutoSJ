$(document).ready(function(){
    acceder_login();
    $('#log_username').focus();
});


function acceder_login()
{
    $('#login_form').on('submit',function(e){
        e.preventDefault();

        var input = $('#log_username');
        var pass = $('#log_pass');
        var resp = true;

        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                resp = false;
            }
        }
        if($(pass).val().trim() == ''){
            resp = false;
        }
        if(resp != true)
        {
            $("#response").slideDown('fast');
            setTimeout(function (){
                $("#response").slideUp('fast');
            },4000);         	
        }
        else
        {
            var form = $('#login_form');
            var url = form.attr('action');
            var type = form.attr('method');
            var formData = form.serialize();
            $.ajax({
                url:url,
                type:type,
                data:formData,
                traditional:true,
                success:function(result){
                    var result = $.parseJSON(result);

                    if(result.status == 'error')
                    {
                        $('#main_msj_login').html('<i class="fa fa-ban white"></i> '+result.mensaje.toUpperCase());
                        $("#response").slideDown('fast');
                        setTimeout(function (){
                            $("#response").slideUp('fast');
                        },4000);          					
                    }
                    else
                    {
                        location.href = $('#base-url').val()+'/fabricacion/listOrdenFabricacion';
                    }
        			
                }
            });
        }

     	
    });	
}

function verificar_alert()
{
    if($('#main_alert').val()==1)
    {
        $("#response").slideDown('fast');
        //$('.login100-form validate-form')[0].reset();
        setTimeout(function (){
            $("#response").slideUp('fast');
        },4000);        
    }
}