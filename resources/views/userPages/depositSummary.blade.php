@extends('layouts.userApp')
@section('title','Deposit Summary')
@section('content')
<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">How To Deposit</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body" style="overflow: hidden;">
                <div class="chart-pie text-justify" style="overflow: auto;">
                    <ol>
                        <li>বিকাশ নাম্বার <span class="text-danger"> {{$bkash}}</span>  রকেট নাম্বার<span class="text-danger"> {{$rocket}}</span>, নগদ  নাম্বার<span class="text-danger"> {{$nagad}}</span></li>
                        <li>আপনার মোবাইল নাম্বার থেকে আমাদের পেমেন্ট মোবাইল নাম্বারে সর্বনিম্ন <span class="text-danger">300</span> টাকা সেন্ড মানি করুন।</li>
                        <li>বিকাশ/রকেট ট্রানজেকশন আইডিটি সংরক্ষণ করুন।</li>
                        <li>নিচের ফর্মে আপনার টাকার পরিমাণ, যে নাম্বার থেকে বিকাশ/রকেট করেছেন তার ট্রানজেকশন আইডিটি বসিয়ে কনফার্ম বক্সে ক্লিক করুন</li>
                        <li>আপনার ডিপোজিট যোগ হতে অপেক্ষা করুন।</li>
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
                <h6 class="m-0 font-weight-bold text-primary">Deposit Form</h6>
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
                                <input type="text" class="form-control" id="deposit-number" placeholder="Payment number">
                            </div>
                        </div>
                        <div class="col-auto">
                            <label class="sr-only" for="trxid">Phone</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-key" aria-hidden="true"></i></div>
                                </div>
                                <input type="text" class="form-control" id="payment-trxid" placeholder="Enter TrxId">
                            </div>
                        </div>
                        <div class="col-auto">
                            <label class="sr-only" for="amount">Amount</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-briefcase" aria-hidden="true"></i></div>
                                </div>
                                <input type="text" class="form-control" id="deposit-amount" placeholder="Enter amount">
                            </div>
                        </div>
                    </div>
                    <select class="custom-select mr-sm-2 mb-2" id="paymentMethod" style="max-width: 250px;">
                        <option selected>Choose Payment Method</option>
                        <option value="Bkash">Bkash</option>
                        <option value="Rocket">Rocket</option>
                        <option value="Nagad">Nagad</option>
                    </select><br>
                    <button type="submit" class="btn btn-primary ml-5" id="deposit-confirm">Confirm</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Deposit Table</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-dark text-light">
                    <tr>
                        <th>Amount</th>
                        <th>Phone</th>
                        <th>Trxid</th>
                        <th>Payment Method</th>
                        <th>Time</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($deposit as $deposit)
                    <tr>
                        <td>{{$deposit->amount}}</td>
                        <td>{{$deposit->deposit_number}}</td>
                        <td>{{$deposit->trxid}}</td>
                        <td>{{$deposit->paymentmethod}}</td>
                        <td>{{$deposit->time}}</td>
                        <td>{{$deposit->date}}</td>
                        @if($deposit->status == 0)
                        <td class="text-info">Pending</td>
                        @elseif($deposit->status == 1)
                        <td class="text-success">Success</td>
                        @else
                        <td class="text-danger">Rejected</td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
            document.getElementById("deposit-confirm").addEventListener("click", function() {
                var number = $('#deposit-number').val();
                var trxid  = $('#payment-trxid').val();
                var amount = $('#deposit-amount').val();
                var method = $('#paymentMethod').val();

                if(number.length>=11 && trxid.length>=8 && parseInt(amount)>=300 && (method=="Bkash" || method=="Rocket" || method=="Nagad")){
                    deposit(number,trxid,amount,method);
                }
            });
            
            function deposit(number,trxid,amount,method){
                let data   = {phone:number,trxid:trxid,amount:amount,method:method};
                let url    = '/deposit-confirm';
                var config = {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                };
                axios.post(url,data,config)
                    .then(function (response){
                        if(response.status == 200 && response.data == true){
                            $('#deposit-number').val("");
                            $('#payment-trxid').val("");
                            $('#deposit-amount').val("");
                            alert("Deposit Success");
                            location.reload();
                        }else{
                            alert("Deposit Failed");
                        }
                    })
                    .catch(function (error){
                        console.log(error);
                    })
            }
</script>
@endsection