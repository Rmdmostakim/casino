@extends('layouts.siteLayout')
@section('title','Choose a Card')
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
                <img id="myImageId" src="{{asset('icon/joker.svg')}}">
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
                            <label class="mr-sm-2 text-primary font-weight-bold" for="selectedCard">Select a Card</label>
                            <select class="custom-select mr-sm-2" id="selectedCard">
                                <option selected>Choose...</option>
                                <option value="two">Two</option>
                                <option value="three">Three</option>
                                <option value="four">Four</option>
                                <option value="five">Five</option>
                                <option value="six">Six</option>
                                <option value="seven">Seven</option>
                                <option value="eight">Eight</option>
                                <option value="nine">Nine</option>
                                <option value="ten">Ten</option>
                                <option value="jack">Jack</option>
                                <option value="queen">Queen</option>
                                <option value="king">King</option>
                                <option value="ace">Ace</option>
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
    let flipBtn = document.querySelector("#flip-button");
    let resetBtn = document.querySelector("#reset-button");
    document.getElementById("flip-button").disabled = true;
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
    //card flip
    flipBtn.addEventListener("click", () => {
        var amount   = $('#playAmount').val();
        var gamecard = $('#selectedCard').val();
        if(parseInt(amount)>10 && gamecard !=""){
            document.getElementById("myImageId").src="{{asset('icon/cards.gif')}}";
            GameStatus(amount,gamecard);
        }
        
    });
    //card selection
    document.getElementById("selectedCard").addEventListener("change",function(){
        var card   = $('#selectedCard').val();
        if(card=="ace" || card=="two" || card=="three" || card=="four" || card=="five" || card=="six" || card=="seven" || card=="eight" || card=="nine" 
        || card=="ten" || card=="jack" || card=="queen" || card=="king"){
            document.getElementById("flip-button").disabled = false;
        }else{
            document.getElementById("flip-button").disabled = true;
        }
    });
    //game result
    function GameStatus(amount,gamecard){
        let data   = {amount:amount,card:gamecard};
        let url    = 'chosecardresult';
        var config = {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        };
        axios.post(url,data,config)
            .then(function (response){
                if(response.status==200 && response.data['status']==true){
                    CardFlip(response.data['card'],response.data['result'],gamecard);
                }
            })
            .catch(function (error){
                console.log(error);
            });
    }
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
    //card flip after result
    function CardFlip(resultcard,result,gamecard){
        setTimeout(function(){
            document.getElementById("myImageId").src="icon/choosecard/"+resultcard+".svg";
            document.querySelector("#game-result").textContent = resultcard.toUpperCase();
            document.querySelector("#win-lost").textContent = result;
        }, 1000);
    }

    resetBtn.addEventListener("click", () => {
        document.querySelector("#game-result").textContent = "";
        document.querySelector("#win-lost").textContent = "";
        document.getElementById("myImageId").src="{{asset('icon/joker.svg')}}";
        $('#playAmount').val("");
    });
    
</script>
@endsection


