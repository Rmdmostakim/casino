@extends('layouts.userApp')
@section('title','Withdraw')
@section('content')
    <!-- Content Row -->
<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">How To Withdraw</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body" style="overflow: hidden;">
                <div class="chart-pie text-justify" style="overflow: auto;">
                    <ol>
                        <li>অ্যাকাউন্টে পর্যাপ্ত টাকা থাকতে হবে এবং সর্বনিম্ন ৫০০ টাকা উত্তোলন করা যাবে।</li>
                        <li>নিচের ফর্মে আপনার টাকার পরিমাণ, যে বিকাশ/রকেট নাম্বারে টাকা নিতে চান তা বসিয়ে কনফার্ম বক্সে ক্লিক করুন।</li>
                        <li>আপনার টাকা পেতে অপেক্ষা করুন।</li>
                        <li>পেন্ডিং রিকোয়েস্ট সফল না হওয়ার আগে নতুন ভাবে টাকা উত্তোলন করা যাবে না।</li>
                    </ol>
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
                <h6 class="m-0 font-weight-bold text-primary">Withdraw Form</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-pie">
                    <div class="form-row align-items-center">
                        <div class="col-auto">
                            <label class="sr-only" for="bkash">Phone</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-phone" aria-hidden="true"></i></div>
                                </div>
                                <input type="text" class="form-control" id="withdraw-number" placeholder="Enter payment number">
                            </div>
                        </div>
                        <div class="col-auto">
                            <label class="sr-only" for="amount">Amount</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-briefcase" aria-hidden="true"></i></div>
                                </div>
                                <input type="text" class="form-control" id="withdraw-amount" placeholder="Enter amount">
                            </div>
                        </div>
                    </div>
                    <select class="custom-select mr-sm-2 mb-2" id="paymentMethod" style="max-width: 250px;">
                        <option selected>Choose Payment Method</option>
                        <option value="Bkash">Bkash</option>
                        <option value="Rocket">Rocket</option>
                        <option value="Nagad">Nagad</option>
                    </select><br>
                    <button type="submit" class="btn btn-primary ml-5" id="withdraw-confirm" class="p">Confirm</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
            document.getElementById("withdraw-confirm").addEventListener("click", function() {
                var number = $('#withdraw-number').val();
                var amount = $('#withdraw-amount').val();
                var method = $('#paymentMethod').val();
                if(number.length>=11 && parseInt(amount)>=500 && (method=="Bkash" || method=="Rocket" || method=="Nagad")){
                    withdraw(number,amount,method);
                }

            });
            
            function withdraw(number,amount,method){
                let data   = {phone:number,amount:amount,method:method};
                let url    = '/withdraw-confirm';
                var config = {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                };
                axios.post(url,data,config)
                    .then(function (response){
                        if(response.status == 200 && response.data == true){
                            $('#withdraw-number').val("");
                            $('#withdraw-amount').val("");
                            alert("Withdraw Success");
                            location.reload();
                        }else{
                            alert("Withdraw Failed");
                        }
                    })
                    .catch(function (error){
                        console.log(error);
                    })
            }
</script>
@endsection