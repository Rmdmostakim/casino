<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Login</title>

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
        <!-- Google Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
        <link href='https://fonts.googleapis.com/css?family=Sofia' rel='stylesheet'>
        <link href="{{asset('css/app.css')}}" rel="stylesheet" >
        <link href="{{asset('css/mainSite.css')}}" rel="stylesheet" >
    </head>

    <body class="homeBody">
        <div class="my-login-page homeBody jumbotron container-fluid">
            <section class="h-100">
                <div class="container h-100">
                    <div class="row justify-content-md-center h-100">
                        <div class="card-wrapper">
                            <div class="brand">
                                <img src="{{asset('icon/homeicon.png')}}" alt="logo">
                            </div>
                            <div class="card fat">
                                <div class="card-body">
                                    <h4 class="card-title text-center">Admin Login</h4>
                                    <p class="card-title text-center text-danger user-error"></p>
                                    <form class="my-login-validation">
                                        <div class="form-group">
                                            <label for="email"><i class="fas fa-envelope text-danger" aria-hidden="true"></i> Email</label>
                                            <input id="email" type="email" class="form-control"  required autofocus>
                                            <p class="card-title text-center text-danger p-1 empty-email"></p>
                                        </div>

                                        <div class="form-group">
                                            <label for="password"><i class="fas fa-unlock text-danger"></i> Password
                                                <a href="forgot.html" class="float-right">
                                                    Forgot Password?
                                                </a>
                                            </label>
                                            <input id="password" type="password" class="form-control" required data-eye>
                                            <p class="card-title text-center text-danger p-1 empty-pass"></p>
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox" name="remember" id="remember" class="custom-control-input">
                                                <label for="remember" class="custom-control-label">Remember Me</label>
                                            </div>
                                        </div>

                                        <div class="form-group m-0">
                                            <button type="button" class="btn btn-primary btn-block" id="login-confirm">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </body>
    <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
    <script type="text/javascript">
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
            if(pass !='' && pass.length>=6){
                $('.empty-pass').text('');
            }else{
                $('.empty-pass').text(' Enter Password.');
            }

            if( ValidEmail == true && pass.length>=6 ){
                loginConfirm(email,pass);
            }
        }

        function loginConfirm(email,pass){

            let data   = {AdminEmail:email,AdminPass:pass};
            let url    = '/OnadminLogin';
            var config = {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            };
            axios.post(url,data,config)
                .then(function (response){
                    if(response.status == 200 && response.data == true){
                        window.location.href = "/admin";
                    }else{
                        $('.user-error').text('Admin not found');
                    }
                })
                .catch(function (error){
                    console.log(error);
                })
        }

    </script>
</html>