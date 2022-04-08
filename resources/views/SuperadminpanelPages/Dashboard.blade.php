@extends('layouts.superadminpanelLayouts.superadminpanelApp')
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
    <a href="{{ route('superadmin.newadmin') }}" class="btn btn-link btn--sm radius-5">Add new admin</a>
    <div class="table--responsive--md mt-3">
        <table class="table" id="dataTable">
            <thead>
            <tr>
                <th>Type</th>
                <th>Name</th>
                <th>Number</th>
                <th>Email</th>
                <th>Date</th>
                <th>Options</th>
            </tr>
            </thead>
            <tbody>
            @foreach( \AdminAuth::getallAdmin() as $admin)
                <tr>
                    <td class="admin-type" data-label="Admin Type">{{ ucwords($admin->admin_type) }}</td>
                    <td class="admin-name" data-label="Admin Name">{{ ucwords($admin->admin_name) }}</td>
                    <td class="admin-number" data-label="Admin Number">{{ $admin->admin_phone }}</td>
                    <td class="admin-email" data-label="Admin Email">{{ $admin->admin_email }}</td>
                    <td class="date" data-label="Date">{{ ucwords($admin->created_at) }}</td>
                    <td class="option" data-label="Option">
                        <a href="{{ route('superadmin.delete',\Crypt::encryptString($admin->admin_id)) }}" title="Delete"><i class="la la-trash"></i></a>
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