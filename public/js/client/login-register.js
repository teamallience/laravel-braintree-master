/*
 *
 * login-register modal
 * Autor: Creative Tim
 * Web-autor: creative.tim
 * Web script: #
 * 
 */
 
function showRegisterForm(){
    $('.loginBox').fadeOut('fast',function(){
        $('.registerBox').fadeIn('fast');
        $('.login-footer').fadeOut('fast',function(){
            $('.register-footer').fadeIn('fast');
        });
        $('.modal-title').html('Register with');
    }); 
    $('.error').removeClass('alert alert-danger').html('');
       
}
function showLoginForm(){
    $('#loginModal .registerBox').fadeOut('fast',function(){
        $('.loginBox').fadeIn('fast');
        $('.register-footer').fadeOut('fast',function(){
            $('.login-footer').fadeIn('fast');    
        });
        
        $('.modal-title').html('Login with');
    });       
     $('.error').removeClass('alert alert-danger').html(''); 
}

function openLoginModal(){
    showLoginForm();
    setTimeout(function(){
        $('#loginModal').modal('show');    
    }, 230);
    
}
function openRegisterModal(){
    showRegisterForm();
    setTimeout(function(){
        $('#loginModal').modal('show');    
    }, 230);
    
}

function loginAjax(){
    /*   Remove this comments when moving to server
    $.post( "/login", function( data ) {
            if(data == 1){
                window.location.replace("/home");            
            } else {
                 shakeModal(); 
            }
        });
    */
    //alert("dsaf");
/*   Simulate error message from the server   */
     shakeModal();
}

function shakeModal(){
    $('#loginModal .modal-dialog').addClass('shake');
             $('.error').addClass('alert alert-danger').html("Invalid email/password combination");
             $('input[type="password"]').val('');
             setTimeout( function(){ 
             $('#loginModal .modal-dialog').removeClass('shake'); 
    }, 1000 ); 
}
/*function verify_my(){
    
   
    var emaill = $('#remail').val();
  
    //alert (emaill);
   
   $.ajax({  
                url : "./verify_my",  
                type : "POST",    
                beforeSend: function (xhr) {
                     var token = $('meta[name="csrf_token"]').attr('content');

                     if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                          }
                     },
                data :  {myString: 'emaill' },  
                success : function(stats) {  
                   
                        alert("ok");  
                      //   window.location.href="/yc"  
                   
                },  
                error : function(stats) {  
                    alert('false');  
                }  
            });  
}*/

   