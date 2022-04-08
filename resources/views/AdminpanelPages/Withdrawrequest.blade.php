@extends('layouts.adminpanelLayouts.adminpanelApp')
@section('title','Withdraw Request')
@section('content')
    <div class="col-lg-9">
        <div class="table--responsive--md">
            @if (session('success'))
                <div class="alert badge--success text-center">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert badge--danger text-center">
                    {{ session('error') }}
                </div>
            @endif
            <table class="table" id="dataTable">
                <thead>
                <tr>
                    <th>User Name</th>
                    <th>Type</th>
                    <th>Method</th>
                    <th>Number</th>
                    <th>Trx ID</th>
                    <th>Amount</th>
                    <th>UC Amount</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Option</th>
                </tr>
                </thead>
                <tbody>
                @foreach( \AdminAuth::pendingWithdraw() as $balance)
                    <tr>
                        <td class="user-name" data-label="Username">{{ ucwords($balance->username) }}</td>
                        <td class="trx-type" data-label="Transection Type">{{ ucwords($balance->balance_type) }}</td>
                        <td class="trx-method" data-label="Transection Method">{{ ucwords($balance->transfer_method) }}</td>
                        <td class="trx-number" data-label="Transfer Number">{{ $balance->transfer_number }}</td>
                        <td class="trx-id" data-label="Transection ID">{{ $balance->transection_id }}</td>
                        <td class="amount" data-label="Amount">{{ $balance->balance_amount }}<i class='la la-bitcoin'></i></td>
                        <td class="amount" data-label="Uc-Amount">{{ $balance->uc_amount }}<i class='la la-bitcoin'></i></td>
                        <td class="status" data-label="status"> <button class="btn btn--primary btn--sm">Pending</button> </td>
                        <td class="date" data-label="Date">{{ ucwords($balance->created_at) }}</td>
                        <td>
                            <a class="btn btn--success btn--sm mb-1" href="{{ route('admin.pullwithdraw',\Crypt::encryptString($balance->id)) }}" title="Confirm"><i class="las la-check-square"></i></a>
                            <a class="btn btn--danger btn--sm" href="{{ route('admin.withdrawRejection',\Crypt::encryptString($balance->id)) }}" title="Reject"><i class="las la-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                searching: false,
                info: true,
                scrollX:500,
                deferRender:true,
                scroller:true,
                "pageLength": 5,
                "bLengthChange": false,
                "language": {"paginate": {"previous": "<i class='la la-angle-double-left'></i>","next": "<i class='la la-angle-double-right'></i>"}}
            });
        });
    </script>
@endsection
