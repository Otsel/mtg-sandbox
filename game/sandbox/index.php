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
    <title>MTG:Sandbox - Sandbox</title>
    <link rel="stylesheet" href="../../src/styles/main.css">
    <script src="https://kit.fontawesome.com/af7942068a.js" crossorigin="anonymous"></script>
</head>
<body style="background-image: linear-gradient(to left bottom, #d17be9, #c967e9, #bf51ea, #b538ea, #a912eb);">
    <div class="sidemenu">
        <p>Controls:</p>
        <p>R to tap a card</p>
        <p>F to flip a card</p>
    </div>
    <div class="topMenu">
        <div class="left">
            <div class="menuItemContainer">
                <a href="/" class="menuItem" id="menuItem1"><i class="fa-solid fa-left-to-line "></i></a>
                <div class="tooltip" aria-controls="menuItem1">Go Back</div>
            </div>
            <!-- <div class="menuItemContainer">
                <a href="#" class="menuItem" id="menuItem2"><i class="fa-solid fa-cards-blank"></i></a>
                <div class="tooltip" aria-controls="menuItem2">Draw 7</div>
            </div> -->
            <div class="menuItemContainer">
                <a href="#" class="menuItem" id="menuItem3"><i class="fa-solid fa-cards-blank"></i></a>
                <div class="tooltip" aria-controls="menuItem3">Draw 1</div>
            </div>
            <div class="menuItemContainer">
                <a href="#" class="menuItem" id="menuItem4"><i class="fa-solid fa-gear"></i></a>
                <div class="tooltip" aria-controls="menuItem4">Settings</div>
            </div>
        </div>
        <div class="center">
            <form onsubmit="return false;">
                <div><input id="cardSearchBox" type="text" placeholder="type a card name"></div>
                <div><input type="submit" onclick="cardSearch();"></div>
        </div>
        <div class="right">
            <div class="statusContainer">
                <div class="status" id="defaultStatus">status</div>
            </div>
            
        </div>
    </div>

    <div class="playArea">
    </div>
   

    <!-- <div class="playerHand">
        <img class="playingCard in-hand" src="../../src/img/default.jpg" alt="">
        <img class="playingCard in-hand" src="../../src/img/default.jpg" alt="">
        <img class="playingCard in-hand" src="../../src/img/default.jpg" alt="">
        <img class="playingCard in-hand" src="../../src/img/default.jpg" alt="">
        <img class="playingCard in-hand" src="../../src/img/default.jpg" alt="">
        <img class="playingCard in-hand" src="../../src/img/default.jpg" alt="">
        <img class="playingCard in-hand" src="../../src/img/default.jpg" alt="">
    </div> -->

    <div class="deck unselectable">  
        <img class="" src="../../src/img/default.jpg" alt="">
        <img class="" src="../../src/img/default.jpg" alt="">
        <img class="" src="../../src/img/default.jpg" alt="">
        <img class="" src="../../src/img/default.jpg" alt="">
        <img class="" src="../../src/img/default.jpg" alt="">
        <div class="cardCounter">100</div>
    </div>

    <!-- scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.min.js" integrity="sha256-sw0iNNXmOJbQhYFuC9OF2kOlD5KQKe1y5lfBn4C9Sjg=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.4/howler.min.js" integrity="sha512-xi/RZRIF/S0hJ+yJJYuZ5yk6/8pCiRlEXZzoguSMl+vk2i3m6UjUO/WcZ11blRL/O+rnj94JRGwt/CHbc9+6EA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- <script src="../../src/js/main.js" type="text/javascript"></script> -->
    <script type="text/javascript">
        function cardSearch() {
            var cardName = document.getElementById("cardSearchBox").value;
            console.log(cardName);
            getCard("https://api.scryfall.com/cards/named?fuzzy=" + cardName);
        }

        //API
        let cardID = "null";
        let cardImageURI = "null";
        let cardImageSmall = "null";
        let cardName = "xantcha"

        let cardBackID = "null";
        let cardBackURL = "null";
        let cardBackImageURI = "null";
        let cardBackImageURL = "null";


        async function getCard(url) {
            const res = await fetch(url) ;
            const result = await res.json();
            cardID = result['id'];
            cardImageURI = result['image_uris'];
            cardImageSmall = cardImageURI.large;
            cardBackID = result['card_back_id'];
            cardBackURL = "https://api.scryfall.com/cards/"+cardBackID;
            console.log(cardBackURL);
        

            // getCardBack();

            console.log(cardID); // or use the result variable
            console.log(cardImageSmall);

        }
        getCard("https://api.scryfall.com/cards/named?fuzzy=" + cardName);

        //begin jquery
        (function($) {
            // console.log("why isn't this fuckin workin");
        


            //Initialize sounds
            var rollover = new Howl({
                src: ['../../src/audio/cardswipe2.wav'],
                volume: 0.15
            });
            var scoop = new Howl({
                src: ['../../src/audio/cardswipe1.wav'],
                volume: 0.15
            });
            var slap = new Howl({
                src: ['../../src/audio/snap.mp3'],
                volume: 0.15
            });

            function refreshSounds(){
                $('.playingCard').on("mouseenter", function(){
                    rollover.play();
                });
                $('.playingCard').on("click", function(){
                    scoop.play();
                });
                $('.playingCard').on("mouseup", function(){
                    slap.play();
                });
                $(".card").on("mouseenter", function(){
                    rollover.play();
                });
            }
            refreshSounds();
            //Game functions

            var cardCount = 60;
            $('.cardCounter').html(cardCount);


            //UI actions

            // tooltips
            $('.menuItem').hover(function(){
                var menuItemID = $(this).attr("id");
                var tooltipID = "[aria-controls='" + menuItemID + "']";
                $(tooltipID).css("opacity", "1");
                $(this).on("mouseleave", function(){
                    $('.tooltip').css("opacity", "0");
                });
            });

            //count number of status messages
            var statusCounter = 1;

            //draw 7
            $('#menuItem2').on('click', function(){
                $('#defaultStatus').remove();
                var statusID = "status"+statusCounter;
                var statusTarget ="#status"+(statusCounter-1);
                var statusMessage = "<div class='status' "+"id='"+statusID+"'>you drew 7 cards</div>";
                console.log(statusMessage);
                console.log(statusTarget);
                cardCount-=7;
                $('.cardCounter').html(cardCount);
                if (statusCounter == 5) {
                    $(".status").remove();
                    $('.statusContainer').prepend(statusMessage);
                    statusCounter = 1;
                } else {
                    $('.statusContainer').prepend(statusMessage);
                    statusCounter++;
                }
                
            });

            //draw 1
            $('#menuItem3').on('click', function(){
                $('#defaultStatus').remove();
                var statusID = "status"+statusCounter;
                var statusTarget ="#status"+(statusCounter-1);
                var statusMessage = "<div class='status' "+"id='"+statusID+"'>you drew 1 card</div>";
                //count cards and change deck visuals/status messages to match
                //please dear god make this more efficient in the future
                if (cardCount == 5) {
                    $('.deck img:nth-child(5)').hide();
                } else if (cardCount == 4) {
                    $('.deck img:nth-child(4)').hide();
                } else if (cardCount == 3) {
                    $('.deck img:nth-child(3)').hide();
                } else if (cardCount == 2) {
                    $('.deck img:nth-child(2)').hide();
                } else if (cardCount == 1) {
                    $('.deck img:nth-child(1)').hide();
                    $('.cardCounter').hide();
                } else if (cardCount == 0) {
                    if (statusCounter == 5) {
                        $(".status").remove();
                        $('.statusContainer').prepend("<div class='status' "+"id='"+statusID+"'>you are out of cards</div>");
                        statusCounter = 1;
                    } else {
                        $('.statusContainer').prepend("<div class='status' "+"id='"+statusID+"'>you are out of cards</div>");
                        statusCounter++;
                    }
                    return;
                }
                cardCount--;
                $('.playArea').prepend("<img class='playingCard ui-draggable ui-draggable-handle drawCard' src='" + cardImageSmall + "' alt=''>");
                $('.drawCard').removeClass('drawCard');
                $('.cardCounter').html(cardCount);
                refreshCards();
                refreshSounds();
                if (statusCounter == 5) {
                    $(".status").remove();
                    $('.statusContainer').prepend(statusMessage);
                    statusCounter = 1;
                } else {
                    $('.statusContainer').prepend(statusMessage);
                    statusCounter++;
                }

            });

            //tap cards
            $('.playingCard').hover(function(){
                var $this = $(this);
                $(document).keydown(function(keyPressed) {
                    if (keyPressed.keyCode == 82) {
                        $this.toggleClass('tapped');
                    }
                });
            });

            //rotate cards
            $('.playingCard').hover(function(){
                var $this = $(this);
                $(document).keydown(function(keyPressed) {
                    if (keyPressed.keyCode == 70) {
                        $this.toggleClass('flipping');
                        setTimeout(function() { 
                            $this.removeClass('flipping');
                        }, 500);
                    }
                });
            });    

            //deck functions
            $('.deck').mouseenter(function(){
                $('.cardCounter').css("opacity", "1");
            })

            $('.deck').mouseleave(function(){
                $('.cardCounter').css("opacity", "0");
            })

            //make cards draggable

            //drop the card on release
            // $('.playingCard').on("mouseup", function(){
            //     $(this).css("height", "200px");
            // });

            $('.playingCard').draggable({
                containment:"body", 
                scroll: false,
                drag: function (event, ui) {
                    // $(this).toggleClass( "dragging" );
                    // $(this).css("z-index", "1000");
                }
            });

            function refreshCards(){
                $('.playingCard').draggable({
                    containment:"body", 
                    scroll: false,
                    drag: function (event, ui) {
                        // $(this).toggleClass( "dragging" );
                        // $(this).css("z-index", "1000");
                    }
                });
                //tap cards
                $('.playingCard').hover(function(){
                    var $this = $(this);
                    $(document).keydown(function(keyPressed) {
                        if (keyPressed.keyCode == 82) {
                            $this.toggleClass('tapped');
                        }
                    });
                });

                //rotate cards
                $('.playingCard').hover(function(){
                    var $this = $(this);
                    $(document).keydown(function(keyPressed) {
                        if (keyPressed.keyCode == 70) {
                            $this.toggleClass('flipping');
                            setTimeout(function() { 
                                $this.removeClass('flipping');
                            }, 500);
                        }
                    });
                });
            }

            $('.playerHand').droppable({
                // accept: ".playingCard"
                drop: function( event, ui ) {
                    // $(this).toggleClass( "in-hand" );
                    console.log("plopped in hand");
                }
            });
        })(jQuery);
    </script>

</body>
</html>