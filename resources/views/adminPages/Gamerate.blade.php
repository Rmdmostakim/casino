@extends('layouts.AdminApp')
@section('title','Game Rate')
@section('content')
<div class="card shadow mb-4 card-width">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Game Rate Table</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-dark text-light">
                    <tr>
                        <th>#</th>
                        <th>Game Name</th>
                        <th>Betting Rate</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($gamerates as $gamerate)
                    <tr>
                        <td>{{$gamerate->id}}</td>
                        <td>{{$gamerate->gamename}}</td>
                        <td>{{$gamerate->betrate}} %</td>
                        <td><button type="button" class="btn btn-success bet-change">Change</i></button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!---modal-->
<div class="withdraw-modal bg-primary text-center rounded d-none">
    <diiv class="withdraw-modal-card p-5">
        <h5 class="text-white">Game Rate</h5>
        <div class="modal-card-input">
            <div class="col-auto">
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-money-check-alt"></i></div>
                    </div>
                    <input type="text" class="form-control game-rate" placeholder="Enter in percentage value(%)">
                    <input type="hidden" class="form-control game-id" >
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
    $(".bet-change").click(function(){
        $('.card').addClass('blur-effect');
        $('.withdraw-modal').removeClass('d-none');

        var data = $(this).parents("tr").children("td")[0].innerText;
        var width = document.querySelector('.card-width').offsetWidth;
        width = (20*width)/100;
        $('.withdraw-modal').css({marginLeft:width+'px'});
        $('.game-id').val(data);
    });
    $(".modal-colse").click(function(){
        $('.card').removeClass('blur-effect');
        $('.withdraw-modal').addClass('d-none');
    });
    $(".modal-submit").click(function(){
        var gameId = $('.game-id').val();
        var rate   = $('.game-rate').val();
        GamerateChange(gameId,rate);
        location.reload();
    });

    function GamerateChange(GameId,BetRate){
        let data   = {GameId:GameId,BetRate:BetRate};
        let url    = '/gamerate-change';
        var config = {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        };

        axios.post(url,data,config)
            .then(function (response){
                if(response.status == 200 && response.data==true){
                    alert("Game rate changed");
                }else{
                    alert("Change Failed");
                }
            })
            .catch(function (error){
                console.log(error);
            })
    }
</script>
@endsection