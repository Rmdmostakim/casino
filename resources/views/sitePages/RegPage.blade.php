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
							<h4 class="card-title text-center">Registration</h4>
                            <p class="card-title text-center text-danger user-error"></p>
							<form class="my-login-validation">
                                <div class="form-group">
									<label for="name"><i class="fas fa-user text-danger" aria-hidden="true"></i> Name</label>
									<input id="name" type="text" class="form-control"  required autofocus>
                                    <p class="card-title text-center text-danger p-1 empty-name"></p>
								</div>
                                <div class="form-group">
									<label for="phone"><i class="fas fa-phone text-danger" aria-hidden="true"></i> Mobile</label>
									<input id="phone" type="text" class="form-control"  required autofocus>
                                    <p class="card-title text-center text-danger p-1 empty-phone"></p>
								</div>
								<div class="form-group">
									<label for="email"><i class="fas fa-envelope text-danger" aria-hidden="true"></i> Email</label>
									<input id="email" type="email" class="form-control"  required autofocus>
                                    <p class="card-title text-center text-danger p-1 empty-email"></p>
								</div>
								<div class="form-group">
									<label for="password"><i class="fas fa-unlock text-danger"></i> Password</label>
									<input id="password" type="password" class="form-control" required data-eye>
                                    <p class="card-title text-center text-danger p-1 empty-pass"></p>
								</div>
								<div class="form-group m-0">
									<button type="button" class="btn btn-primary btn-block" id="reg-confirm">Registration</button>
								</div>
								<div class="mt-4 text-center">
                                    Already a member? <a href="{{url('/login')}}">Login</a>
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
document.getElementById("reg-confirm").addEventListener("click", function() {
    EmailPasswordValidation();
  });

function EmailPasswordValidation(){
    var name       = $('#name').val();
    var phone       = $('#phone').val();
    var email      = $('#email').val();
    var pass       = $('#password').val();

    if(pass!='' && pass.length>=6){
        $('.empty-pass').text('');
    }else{
        $('.empty-pass').text(' Enter 6 character password.');
    }
    if(phone!='' && phone.length==11){
        $('.empty-phone').text('');
    }else{
        $('.empty-phone').text(' Enter valid mobile number.');
    }
    if(name!=''){
        $('.empty-name').text('');
    }else{
        $('.empty-name').text(' Enter name.');
    }

    if( pass !='' && phone.length==11 && name!='' && pass.length>=6){
        RegConfirm(name,phone,email,pass);
    }
}

function RegConfirm(name,phone,email,pass){

    let data   = {name:name,phone:phone,email:email,password:pass};
    let url    = 'OnuserReg';
    var config = {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    };
    axios.post(url,data,config)
        .then(function (response){
            if(response.status == 200 && response.data == true){
                $('.user-error').text('Registration successful');
                $('#name').val("");
                $('#phone').val("");
                $('#email').val("");
                $('#password').val("");
                window.location.href = "/user";
            }else{
                $('.user-error').text('User already exist');
            }
        })
        .catch(function (error){
            console.log(error);
        })
}

</script>
@endsection
