@extends('layouts.adminpanelLayouts.adminpanelApp')
@section('title','User List')
@section('content')
<div class="col-lg-9">
    <div class="table--responsive--md">
        <table class="table" id="dataTable">
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Country</th>
                <th>Date</th>
            </tr>
            </thead>
            <tbody>
            @foreach( \AdminAuth::allUsers() as $user)
                <tr>
                    <td class="fname" data-label="Full Name">{{ ucwords($user->fname) }}</td>
                    <td class="username" data-label="Username">{{ ucwords($user->username) }}</td>
                    <td class="email" data-label="Email">{{ $user->email }}</td>
                    <td class="phone" data-label="Phone">{{ $user->phone }}</td>
                    <td class="county" data-label="Country">{{ $user->country }}</td>
                    <td class="date" data-label="Date">{{ $user->created_at }}</td>
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
        "pageLength": 11,
        "bLengthChange": false,
        "language": {"paginate": {"previous": "<i class='la la-angle-double-left'></i>","next": "<i class='la la-angle-double-right'></i>"}}
        });
    });
</script>
@endsection