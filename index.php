<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!--
     __  __ _______ _____    _____         _   _ _____  ____   ______   __
    |  \/  |__   __/ ____|_ / ____|  /\   | \ | |  __ \|  _ \ / __ \ \ / /
    | \  / |  | | | |  __(_) (___   /  \  |  \| | |  | | |_) | |  | \ V / 
    | |\/| |  | | | | |_ |  \___ \ / /\ \ | . ` | |  | |  _ <| |  | |> <  
    | |  | |  | | | |__| |_ ____) / ____ \| |\  | |__| | |_) | |__| / . \ 
    |_|  |_|  |_|  \_____(_)_____/_/    \_\_| \_|_____/|____/ \____/_/ \_\ 

    -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MTG:Sandbox</title>
    <link rel="stylesheet" href="/src/styles/main.css">
    <script src="https://kit.fontawesome.com/af7942068a.js" crossorigin="anonymous"></script>
</head>
<body style="background-image: linear-gradient(to right top, #d17be9, #c967e9, #bf51ea, #b538ea, #a912eb);">
    <div class="mainMenu">
        <h1>MTG:SANDBOX <i class="fa-regular fa-cards-blank"></i></h1>
        <div class="menuContainer">
            <a href="game/sandbox">
                <div class="card unselectable" id="card1">
                    <div class="manaCost">•</div>
                    <div class="title">Sandbox</div>
                    <i class="fa-solid fa-fort cardArt" id="cardArt1"></i>
                    <div class="description">No rules, do whatever</div>
                </div>
            </a>
            <a href="game/playtest">
                <div class="card unselectable" id="card2">
                    <div class="manaCost">••</div>
                    <div class="title">Play Test</div>
                    <i class="fa-solid fa-wand-sparkles cardArt" id="cardArt2"></i>
                    <div class="description">Import your deck and sling some spells</div>
                </div>
            </a>
            <div class="card unselectable" id="card3">
                <div class="manaCost">•••</div>
                <div class="title">Settings</div>
                <i class="fa-solid fa-flask-gear cardArt" id="cardArt3"></i>
                <div class="description">Tweak some stuff and things</div>
            </div>
        </div>
    </div>

    <!-- scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.min.js" integrity="sha256-sw0iNNXmOJbQhYFuC9OF2kOlD5KQKe1y5lfBn4C9Sjg=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.4/howler.min.js" integrity="sha512-xi/RZRIF/S0hJ+yJJYuZ5yk6/8pCiRlEXZzoguSMl+vk2i3m6UjUO/WcZ11blRL/O+rnj94JRGwt/CHbc9+6EA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="src/js/main.js" type="text/javascript"></script>
    <script type="text/javascript">
        //audio
        $(document).ready(function() {
            // var rollover = new Howl({
            //     src: ["../src/audio/cardswipe1.wav"],
            //     volume: 0.5
            // });
            // var click = new Howl({
            //     src: ["../src/audio/click.ogg"],
            //     volume: 0.5
            // });
            // var scoop = new Howl({
            //     src: ["../src/audio/cardswipe1.wav"],

            // });
            // var slap = new Howl({
            //     src: ["../src/audio/snap.mp3"],
            // });


        });
    </script>   
</body>
</html>