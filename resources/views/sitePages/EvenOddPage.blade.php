@extends('layouts.siteLayout')
@section('title','Even and Odd')
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
            <div class="heads">
                <img src="{{asset('icon/even.png')}}">
            </div>
            <div class="tails">
                <img src="{{asset('icon/odd.png')}}">
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
                            <label class="mr-sm-2 text-primary font-weight-bold" for="selectedCard">Select Even / Odd</label>
                            <select class="custom-select mr-sm-2" id="selectedCard">
                                <option selected>Choose...</option>
                                <option value="even">Even</option>
                                <option value="odd">Odd</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="buttons">
            <button id="flip-button">
                Play
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

    document.getElementById("selectedCard").addEventListener("change",function(){
        var card   = $('#selectedCard').val();
        if(card=="even" || card=="odd"){
            document.getElementById("flip-button").disabled = false;
        }else{
            document.getElementById("flip-button").disabled = true;
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


    function GameStatus(amount,gamecard){
        let data   = {amount:amount,card:gamecard,gamename:"Even&Odd"};
        let url    = 'even&oddresult';
        var config = {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        };
        axios.post(url,data,config)
            .then(function (response){
                if(response.status==200 && response.data['status']==true){
                   CardFlip(response.data['data'],gamecard);
                }
            })
            .catch(function (error){
                console.log(error);
            });
    }
    //variables for coin flip
    let stat;
    let tails;
    let gameText;
    let coin = document.querySelector(".coin");
    let flipBtn = document.querySelector("#flip-button");
    let resetBtn = document.querySelector("#reset-button");

    flipBtn.addEventListener("click", () => {
        var amount   = $('#playAmount').val();
        var gamecard = $('#selectedCard').val();
        if(parseInt(amount)>10 && gamecard !=""){
           GameStatus(amount,gamecard);
        }
    });
    //coin flip functions
    function CardFlip(CardValue,UserCard){
        let i = CardValue;
        coin.style.animation = "none";
        if(i == "even"){
            setTimeout(function(){
                coin.style.animation = "spin-heads 3s forwards";
            }, 100);
            stat ="Even";
        }
        else{
            setTimeout(function(){
                coin.style.animation = "spin-tails 3s forwards";
            }, 100);
            stat ="Odd";
        }
        if(i == UserCard){
            gameText = "You Won";
        }else{
            gameText = "You Lost";
        }
        setTimeout(updateStats, 3000);
        disableButton();
    }
    function updateStats(){
        document.querySelector("#game-result").textContent = `${stat}`;
        document.querySelector("#win-lost").textContent = `${gameText}`;
    }
    function disableButton(){
        flipBtn.disabled = true;
        setTimeout(function(){
            flipBtn.disabled = false;
        },3000);
    }
    resetBtn.addEventListener("click",() => {
        coin.style.animation = "none";
        stat = "";
        gameText="";
        updateStats();
        $('#playAmount').val("");
    });
</script>
@endsection