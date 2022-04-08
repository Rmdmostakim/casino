@extends('layouts.AdminApp')
@section('title','Withdraw Request')
@section('content')
<div class="card shadow mb-4 card-width">
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
                    @foreach($pendingWithdraws as $withdraw)
                    <tr>
                        <td>{{$withdraw->id}}</td>
                        <td>{{$withdraw->user_phone}}</td>
                        <td>{{$withdraw->amount}}</td>
                        <td>{{$withdraw->withdraw_number}}</td>
                        <td>{{$withdraw->trxid}}</td>
                        <td>{{$withdraw->paymentmethod}}</td>
                        <td>{{$withdraw->time}}</td>
                        <td>{{$withdraw->date}}</td>
                        <td class="text-info">Pending</td>
                        <td><button type="button" class="btn btn-danger mr-1 false"><i class="fas fa-times"></i></button><button type="button" class="btn btn-success true"><i class="fas fa-check"></i></button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!---modal-->
<div class="withdraw-modal bg-primary text-center rounded p-5 d-none">
    <h5 class="text-white">Confirm Withdraw</h5>
    <diiv class="withdraw-modal-card">
        <div class="modal-card-input">
            <div class="col-auto">
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-money-check-alt"></i></div>
                    </div>
                    <input type="text" class="form-control trxid" placeholder="Enter payment trxid">
                    <input type="hidden" class="form-control dataId" >
                </div>
            </div>
        </div>
        <div class="modal-card-button mt-3">
            <button type="button" class="btn btn-warning modal-colse">Close</button>
            <button type="button" class="btn btn-success modal-submit">Confirm</button>
        </div>
    </diiv>
</div>
<!---modal-->
@endsection
@section('script')
<script type="text/javascript">
    $(".false").click(function() {
        var data = $(this).parents("tr").children("td")[0].innerText;
        WithdrawReject(data);
        location.reload();
    });
    $(".true").click(function() {
        var data = $(this).parents("tr").children("td")[0].innerText;
        $('.card').addClass('blur-effect');
        $('.withdraw-modal').removeClass('d-none');
        var width = document.querySelector('.card-width').offsetWidth;
        width = (20*width)/100;
        $('.withdraw-modal').css({marginLeft:width+'px'});
        $('.dataId').val(data);
    });
    $(".modal-colse").click(function(){
        $('.card').removeClass('blur-effect');
        $('.withdraw-modal').addClass('d-none');
    });
    $(".modal-submit").click(function(){
        var trxid = $('.trxid').val();
        var id    = $('.dataId').val();
        if(trxid.length>8){
            WithdrawAccept(id,trxid);
            location.reload();
        }
        
    });

    function WithdrawReject(dataId){
        let data   = {dataId:dataId};
        let url    = '/withdraw-reject';
        var config = {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        };

        axios.post(url,data,config)
            .then(function (response){
                if(response.status == 200 && response.data==true){
                    alert("Withdraw Rejected");
                }else{
                    alert("Withdraw Failed");
                }
            })
            .catch(function (error){
                console.log(error);
            })
    }
    function WithdrawAccept(dataId,trxId){
        let data   = {dataId:dataId,trxId:trxId};
        let url    = '/withdraw-accept';
        var config = {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        };

        axios.post(url,data,config)
            .then(function (response){
                if(response.status == 200 && response.data==true){
                    alert("Withdraw Accepted");
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