@extends('layouts.AdminApp')
@section('title','Withdraw Summary')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Withdraw Table</h6>
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
                    </tr>
                </thead>
                <tbody>
                    @foreach($withdraws as $withdraw)
                    <tr>
                        <td>{{$withdraw->id}}</td>
                        <td>{{$withdraw->user_phone}}</td>
                        <td>{{$withdraw->amount}}</td>
                        <td>{{$withdraw->withdraw_number}}</td>
                        <td>{{$withdraw->trxid}}</td>
                        <td>{{$withdraw->paymentmethod}}</td>
                        <td>{{$withdraw->time}}</td>
                        <td>{{$withdraw->date}}</td>
                        @if($withdraw->status == 0)
                        <td class="text-info">Pending</td>
                        @elseif($withdraw->status == 1)
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