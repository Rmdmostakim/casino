@extends('layouts.AdminApp')
@section('title','Game Results')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Game Summary</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-dark text-light">
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Game Name</th>
                        <th>Balance</th>
                        <th>Time</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($gameResults as $gameResult)
                    <tr>
                        <td>{{$gameResult->id}}</td>
                        <td>{{$gameResult->user_phone}}</td>
                        <td>{{$gameResult->gamename}}</td>
                        <td>{{$gameResult->amount}}</td>
                        <td>{{$gameResult->time}}</td>
                        <td>{{$gameResult->date}}</td>
                        @if($gameResult->status == 0)
                        <td class="text-danger">Lost</td>
                        @else
                        <td class="text-success">Won</td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection