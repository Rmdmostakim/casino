@extends('layouts.adminpanelLayouts.adminpanelApp')
@section('title','Winning Games')
@section('content')
    <div class="col-lg-9">
        <div class="table--responsive--md">
            <table class="table" id="dataTable">
                <thead>
                <tr>
                    <th>Game Name</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Player</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach( \AdminAuth::lostGames() as $game)
                    <tr>
                        <td class="game-name" data-label="Game Name">{{ ucwords($game->game_name) }}</td>
                        <td class="amount" data-label="Amount">{{ $game->balance_amount }}<i class='la la-bitcoin'></i></td>
                        <td class="status" data-label="status"> <button class="btn btn--danger btn--sm">Lost</button> </td>
                        <td class="player" data-label="Date">{{ $game->username }}</td>
                        <td class="date" data-label="Date">{{ $game->created_at }}</td>
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
