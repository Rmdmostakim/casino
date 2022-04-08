@extends('layouts.siteLayout')
@section('title','Login')
@section('content')
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
							<h4 class="card-title text-center">Login</h4>
                            <p class="card-title text-center text-danger user-error"></p>
							<form class="my-login-validation">
								<div class="form-group">
									<label for="phone"><i class="fas fa-phone text-danger" aria-hidden="true"></i> Phone</label>
									<input id="phone" type="text" class="form-control"  required autofocus>
                                    <p class="card-title text-center text-danger p-1 empty-phone"></p>
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
								<div class="mt-4 text-center">
									Don't have an account? <a href="{{url('/registration')}}">Create One</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection
@section('script')
<script type="text/javascript">
document.getElementById("login-confirm").addEventListener("click", function() {
    EmailPasswordValidation();
  });

function EmailPasswordValidation(){
    
    var phone      = $('#phone').val();
    var pass       = $('#password').val();
    
    if(phone.length==11){
        $('.empty-phone').text('');
    }else{
        $('.empty-phone').text('Enter Valid phone');
    }
    if(pass !='' && pass.length>=6){
        $('.empty-pass').text('');
    }else{
        $('.empty-pass').text(' Enter Password.');
    }

    if( phone.length==11 && pass.length>=6 ){
        loginConfirm(phone,pass);
    }
}

function loginConfirm(phone,pass){

    let data   = {UserPhone:phone,UserPass:pass};
    let url    = 'OnuserLogin';
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

</script>
@endsection

