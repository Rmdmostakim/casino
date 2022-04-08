@extends('layouts.siteLayout')
@section('title','Roulette Table')
@section('content')
<div class="container-fluid jumbotron homeBody" >           
    <div class="gameBox mt-5">
        <div class="stats btn btn-primary">
            <p><span class="float-left"><i class="fas fa-coins"></i></span><span id="game-result"></span></p>
        </div>
        <div class="stats btn btn-primary mt-2">
            <p> <span class="float-left"><i class="fas fa-trophy"></i></span><span id="win-lost"></span></p>
        </div>
        <div class="coin" id="coin">
            <span class="spin-arrow"><i class="fas fa-arrow-down"></i></span>
            <div class="heads">
                <img id="myImageId" src="{{asset('icon/roulette.png')}}">
            </div>
        </div>
        <div class="game-form text-center">
            <p class="text-danger">Betting Rate {{$rate}}% </p>
            <input type="hidden" id="rate" value="{{$rate}}">  
            <form class="pb-3">
                <div class="form-row align-items-center">
                    <div class="col-auto ml-4">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-coins"></i></div>
                            </div>
                            <input type="text" class="form-control" id="playAmount" placeholder="Amount greater than 10">  
                        </div>
                        <p id="error-msg" class="text-danger"></p>
                        <p id="win-rate" class="text-danger"></p>
                        <div class="col-auto my-1">
                            <label class="mr-sm-2 text-primary font-weight-bold" for="selectedCard">Select Color</label>
                            <select class="custom-select mr-sm-2" id="selectedCard">
                                <option selected>Choose...</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="21">31</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="buttons">
            <button id="flip-button">
                Spin
            </button>
            <button id="reset-button">
                Reset
            </button>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    document.getElementById("flip-button").disabled = true;
    
    document.getElementById("flip-button").addEventListener("click", function() {
        var amount   = $('#playAmount').val();
        var gamecard = $('#selectedCard').val();
        if(parseInt(amount)>10 && gamecard !=""){
            document.getElementById("myImageId").src="{{asset('icon/spinningroulette.gif')}}";
            GameStatus(amount,gamecard);
        }
    });
    //color selection
    document.getElementById("selectedCard").addEventListener("change",function(){
        var card   = $('#selectedCard').val();
        if(parseInt(card)>0 && parseInt(card)<32){
            document.getElementById("flip-button").disabled = false;
        }else{
            document.getElementById("flip-button").disabled = true;
        }
    });
    //amount cheack
    document.getElementById("playAmount").addEventListener("keyup", function() {
        var amount = $('#playAmount').val();
        var winrate= $('#rate').val();
        var total = parseInt(amount)+parseInt(winrate)*parseInt(amount)/100;
        if(amount !="" && parseInt(amount)>10){
            CheckBalance(amount);
        }
        if(parseInt(amount)>10){
            $('#win-rate').text("You can win "+total);
        }else{
            $('#win-rate').text("");
        }
    });
    function CheckBalance(amount){
        let data   = {amount:amount};
        let url    = 'check-playable-balance';
        var config = {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        };
        axios.post(url,data,config)
            .then(function (response){
                if(response.status == 200 && response.data == true){
                    $('#error-msg').text("");
                }else if(response.status == 200 && response.data == false){
                    $('#error-msg').text("Not enough balace");
                    document.getElementById("flip-button").disabled = true;
                }
            })
            .catch(function (error){
                console.log(error);
            })
    }
    //game result
    function GameStatus(amount,gamecard){
        let data   = {amount:amount,card:gamecard};
        let url    = 'rouletteresult';
        var config = {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        };
        axios.post(url,data,config)
            .then(function (response){
                if(response.status==200 && response.data['status']==true){
                   CardFlip(response.data['card'],response.data['result'],response.data['spin'],gamecard);
                }
            })
            .catch(function (error){
                console.log(error);
            });
    }
    //card flip after result
    function CardFlip(resultcard,result,spin,gamecard){
        setTimeout(function(){
            document.getElementById("myImageId").src="{{asset('icon/roulette.png')}}";
            document.querySelector("#game-result").textContent = resultcard;
            document.querySelector("#win-lost").textContent = result;
            document.getElementById("myImageId").style.transform = spin;
        }, 1500);
    }
    //reset btn
    document.getElementById("reset-button").addEventListener("click", () => {
        document.querySelector("#game-result").textContent = "";
        document.querySelector("#win-lost").textContent = "";
        $('#playAmount').val("");
    });
</script>
@endsection