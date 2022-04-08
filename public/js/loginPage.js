document.getElementById("login-confirm").addEventListener("click", function() {
    EmailPasswordValidation();
  });

function EmailPasswordValidation(){
    
    var email      = $('#email').val();
    var pass       = $('#password').val();
    var EmailType  = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:		[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    var ValidEmail = EmailType.test(email);
    
    if(ValidEmail == true){
        $('.empty-email').text('');
    }else{
        $('.empty-email').text('Enter Valid Email');
    }
    if(pass !=''){
        $('.empty-pass').text('');
    }else{
        $('.empty-pass').text(' Enter Password.');
    }

    if( ValidEmail == true && pass !='' ){
        loginConfirm(email,pass);
    }
}

function loginConfirm(email,pass){

    let data   = {UserEmail:email,UserPass:pass};
    let url    = 'OnLogin';
    var config = {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    };
    axios.post(url,data,config)
        .then(function (response){
            if(response.status == 200 && response.data == true){
                window.location.href = "/user";
            }else{
                $('.user-error').text('User not found');
            }
        })
        .catch(function (error){
            console.log(error);
        })
}
