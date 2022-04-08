@extends('layouts.adminpanelLayouts.adminpanelApp')
@section('title','Withdraw Summary')
@section('content')
    <div class="col-lg-9">
        <div class="table--responsive--md">
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
                </tr>
                </thead>
                <tbody>
                @foreach( \AdminAuth::allWithdraw() as $balance)
                    <tr>
                        <td class="user-name" data-label="Username">{{ ucwords($balance->username) }}</td>
                        <td class="trx-type" data-label="Transection Type">{{ ucwords($balance->balance_type) }}</td>
                        <td class="trx-method" data-label="Transection Method">{{ ucwords($balance->transfer_method) }}</td>
                        <td class="trx-number" data-label="Transfer Number">{{ $balance->transfer_number }}</td>
                        <td class="trx-id" data-label="Transection ID">{{ $balance->transection_id }}</td>
                        <td class="amount" data-label="Amount">{{ $balance->balance_amount }}<i class='la la-bitcoin'></i></td>
                        <td class="amount" data-label="Uc-Amount">{{ $balance->uc_amount }}<i class='la la-bitcoin'></i></td>
                        @if( $balance->status == 0 )
                            <td class="status" data-label="status"> <button class="btn btn--primary btn--sm">Pending</button> </td>
                        @elseif( $balance->status == 1 )
                            <td class="status" data-label="status"> <button class="btn btn--success btn--sm">Confirmed</button> </td>
                        @else
                            <td class="status" data-label="status"> <button class="btn btn--danger btn--sm">Rejected</button> </td>
                        @endif
                        <td class="date" data-label="Date">{{ ucwords($balance->created_at) }}</td>
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
                "pageLength": 4,
                "bLengthChange": false,
                "language": {"paginate": {"previous": "<i class='la la-angle-double-left'></i>","next": "<i class='la la-angle-double-right'></i>"}}
            });
        });
    </script>
@endsection
