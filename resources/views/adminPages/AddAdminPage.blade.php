@extends('layouts.AdminApp')
@section('title','Add Admin')
@section('content')
<div class="card shadow mb-4">
    <form class="p-5">
        <div class="form-group row">
            <label for="adminname" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="adminname" placeholder="Admin name">
            </div>
        </div>
        <div class="form-group row">
            <label for="adminemail" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
            <input type="email" class="form-control" id="adminemail" placeholder="Admin email">
            </div>
        </div>
        <div class="form-group row">
            <label for="adminphone" class="col-sm-2 col-form-label">Phone</label>
            <div class="col-sm-10">
            <input type="email" class="form-control" id="adminphone" placeholder="Admin phone">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
            <input type="password" class="form-control" id="password" placeholder="Password">
            </div>
        </div>
    </form>
    <button type="submit" class="btn btn-primary text-center" id="add-admin">Confirm</button>
</div>
@endsection
@section('script')
<script type="text/javascript">
    document.getElementById("add-admin").disabled = true;

    document.getElementById("adminname").addEventListener("keyup",function(){
        fieldCheck();
    });
    document.getElementById("adminemail").addEventListener("keyup",function(){
        fieldCheck();
    });
    document.getElementById("adminphone").addEventListener("keyup",function(){
        fieldCheck();
    });
    document.getElementById("password").addEventListener("keyup",function(){
        fieldCheck();
    });

    document.getElementById("add-admin").addEventListener("click",function(){
        var name     = document.getElementById("adminname").value;
        var email    = document.getElementById("adminemail").value;
        var phone    = document.getElementById("adminphone").value;
        var password = document.getElementById("password").value;
        AddAdmin(name,email,phone,password);
    });

    function fieldCheck(){
        var name     = document.getElementById("adminname").value;
        var email    = document.getElementById("adminemail").value;
        var phone    = document.getElementById("adminphone").value;
        var password = document.getElementById("password").value;
        if(name.length>3 && email.length>10 && phone.length>10 && password.length>5){
            document.getElementById("add-admin").disabled = false;
        }else{
            document.getElementById("add-admin").disabled = true;
        }
    }

    function AddAdmin(name,email,phone,password){
        let data   = {name:name,email:email,phone:phone,password:password};
        let url    = '/addadmin';
        var config = {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        };

        axios.post(url,data,config)
            .then(function (response){
                if(response.status == 200 && response.data==true){
                    alert("Admin added successfully");
                    document.getElementById("adminname").value="";
                    document.getElementById("adminemail").value="";
                    document.getElementById("adminphone").value="";
                    document.getElementById("password").value="";
                    self.location = "/admin/add-admin";
                }else{
                    alert("Admin added failed");
                }
            })
            .catch(function (error){
                console.log(error);
            })
    }
</script>
@endsection