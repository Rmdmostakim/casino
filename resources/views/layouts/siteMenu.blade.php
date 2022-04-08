<nav class="navbar navbar-expand-md navbar-light p-3 fixed-top" style="background-color:#ffda0096">
    <a class="navbar-brand" href="{{url('/')}}"><img class="menu-icon" src="{{asset('icon/mainicon.png')}}" width="20" height="20"><span class="text-white"> gpro99.com</span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse ml-5" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link text-white" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{url('/user/withdraw')}}">Withdraw</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{url('/user')}}">Deposit</a>
            </li>
            @if($LoginStatus == true)
            <li class="nav-item">
                <a class="nav-link text-danger font-weight-bold" href="{{url('/user')}}">Balance: {{$balance}} <span>&#2547; </span></a>
            </li>
            @endif
        </ul>
        <ul class="navbar-nav">
            <li class="navbar-item">
                @if($LoginStatus == true)
                    <a href="{{url('/user')}}" class="" title="Login Now" ><img class="default-profile" src="{{ asset('icon/' . $profile) }}" /></a> 
                @else
                    <a href="{{url('/login')}}" class="btn btn-light btn-log login" title="Login Now" >Login</a>
                @endif
            </li>
        </ul>
    </div>
</nav>


