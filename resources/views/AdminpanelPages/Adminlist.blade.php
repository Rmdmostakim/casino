@extends('layouts.adminpanelLayouts.adminpanelApp')
@section('title','Admin List')
@section('content')
<div class="col-lg-9">
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
    <div class="table--responsive--md mt-3">
        <table class="table" id="dataTable">
            <thead>
            <tr>
                <th>Name</th>
                <th>Number</th>
                <th>Email</th>
                <th>Date</th>
                <th>Options</th>
            </tr>
            </thead>
            <tbody>
            @foreach( \AdminAuth::staffList() as $admin)
                <tr>
                    <td class="admin-name" data-label="Admin Name">{{ ucwords($admin->admin_name) }}</td>
                    <td class="admin-number" data-label="Admin Number">{{ $admin->admin_phone }}</td>
                    <td class="admin-email" data-label="Admin Email">{{ $admin->admin_email }}</td>
                    <td class="date" data-label="Date">{{ ucwords($admin->created_at) }}</td>
                    <td class="option text-center" data-label="Option">
                        <a class="btn btn--danger btn--sm" href="{{ route('admin.staffdelete',\Crypt::encryptString($admin->admin_id)) }}" title="Delete"><i class="las la-trash"></i></a>
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
                "pageLength": 5,
                "bLengthChange": false,
                "language": {"paginate": {"previous": "<i class='la la-angle-double-left'></i>","next": "<i class='la la-angle-double-right'></i>"}}
            });
        });
    </script>
@endsection