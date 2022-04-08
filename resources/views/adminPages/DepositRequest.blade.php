@extends('layouts.AdminApp')
@section('title','Deposit Request')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Deposit Table</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-dark text-light">
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Amount</th>
                        <th>Transection Number</th>
                        <th>Trxid</th>
                        <th>Payment Method</th>
                        <th>Time</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendingDeposits as $deposit)
                    <tr>
                        <td>{{$deposit->id}}</td>
                        <td>{{$deposit->user_phone}}</td>
                        <td>{{$deposit->amount}}</td>
                        <td>{{$deposit->deposit_number}}</td>
                        <td>{{$deposit->trxid}}</td>
                        <td>{{$deposit->paymentmethod}}</td>
                        <td>{{$deposit->time}}</td>
                        <td>{{$deposit->date}}</td>
                        <td class="text-info">Pending</td>
                        <td><button type="button" class="btn btn-danger mr-1 false"><i class="fas fa-times"></i></button><button type="button" class="btn btn-success true"><i class="fas fa-check"></i></button></td>
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
    $(".false").click(function() {
        var data = $(this).parents("tr").children("td")[0].innerText;
        DepositReject(data);
        location.reload();
    });
    $(".true").click(function() {
        var data = $(this).parents("tr").children("td")[0].innerText;
        DepositAccept(data);
        location.reload();
    });

    function DepositReject(dataId){

        let data   = {dataId:dataId};
        let url    = '/deposit-reject';
        var config = {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        };

        axios.post(url,data,config)
            .then(function (response){
                if(response.status == 200 && response.data==true){
                    alert("Deposit Rejected");
                }else{
                    alert("Deposit Failed");
                }
            })
            .catch(function (error){
                console.log(error);
            })

    }
    function DepositAccept(dataId){

        let data   = {dataId:dataId};
        let url    = '/deposit-accept';
        var config = {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        };

        axios.post(url,data,config)
            .then(function (response){
                if(response.status == 200 && response.data==true){
                    alert("Deposit Accepted");
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