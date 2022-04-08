@extends('layouts.userApp')
@section('title','Pending Request')
@section('content')
<div class="card shadow mb-4 card-width">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Pending Request Table</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-dark text-light">
                    <tr>
                        <th>Request Type</th>
                        <th>Amount</th>
                        <th>Transection Number</th>
                        <th>Time</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($deposit as $deposit)
                    <tr>
                        <td>Deposit</td>
                        <td>{{$deposit->amount}}</td>
                        <td>{{$deposit->deposit_number}}</td>
                        <td>{{$deposit->time}}</td>
                        <td>{{$deposit->date}}</td>
                        <td><a href="{{url('user/depositsummary')}}" title="View Request" style="text-decoration:none">View</a></td>
                    </tr>
                    @endforeach
                    @foreach($withdraw as $withdraw)
                    <tr>
                        <td>Withdraw</td>
                        <td>{{$withdraw->amount}}</td>
                        <td>{{$withdraw->withdraw_number}}</td>
                        <td>{{$withdraw->time}}</td>
                        <td>{{$withdraw->date}}</td>
                        <td><a href="{{url('user/withdrawsummary')}}" title="View Request" style="text-decoration:none">View</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection