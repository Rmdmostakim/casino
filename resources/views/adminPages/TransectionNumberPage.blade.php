@extends('layouts.AdminApp')
@section('title','Payment Number')
@section('content')
 <!-- Content Row -->
<div class="row">
    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Payment Number</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body" style="overflow: hidden;">
                <div class="chart-pie text-justify" style="overflow: auto;">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-dark text-light">
                    <tr>
                        <th>Payment Number</th>
                        <th>Payment Method</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$bkash}}</td>
                        <td>Bkash</td>
                    </tr>
                    <tr>
                        <td>{{$rocket}}</td>
                        <td>Rocket</td>
                    </tr>
                    <tr>
                        <td>{{$nagad}}</td>
                        <td>Nagad</td>
                    </tr>
                </tbody>
            </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Change Payment Number</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-pie">
                    <div class="form-row align-items-center">
                        <div class="col-auto">
                            <label class="sr-only" for="bkash-deposit">Phone</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-phone" aria-hidden="true"></i></div>
                                </div>
                                <input type="text" class="form-control" id="payment-number" placeholder="Payment number">
                            </div>
                            <p class="text-center text-danger" id="error-msg"></p>
                        </div>
                    </div>
                    <select class="custom-select mr-sm-2 mb-2" id="paymentMethod" style="max-width: 250px;">
                        <option selected>Choose Payment Method</option>
                        <option value="Bkash">Bkash</option>
                        <option value="Rocket">Rocket</option>
                        <option value="Nagad">Nagad</option>
                    </select><br>
                    <button type="submit" class="btn btn-primary ml-5" id="change-payment-number">Confirm</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    document.getElementById("change-payment-number").addEventListener("click",function(){
        let number = document.getElementById("payment-number").value;
        let method = document.getElementById("paymentMethod").value;
        if(number.length<=10){
            document.getElementById("error-msg").innerHTML="Wrong Number";
        }else{
            document.getElementById("error-msg").innerHTML="";
        }

        if(number.length>10 && method=="Bkash" || method=="Rocket" ||method=="Nagad"){
            ChangePaymentNumber(number,method);
        }
    });

    function ChangePaymentNumber(number,method){
                let data   = {payment_number:number,method:method};
                let url    = '/onpaymentnumberchange';
                var config = {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                };
                axios.post(url,data,config)
                    .then(function (response){
                        if(response.status == 200 && response.data == true){
                            alert("Payment Number Changed Successfully");
                            location.reload();
                        }else{
                            alert("Payment Number Changed Failed");
                        }
                    })
                    .catch(function (error){
                        console.log(error);
                    })
            }
</script>
@endsection