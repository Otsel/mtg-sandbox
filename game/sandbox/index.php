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
        <p>T to tap a card</p>
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
            <form onsubmit="return false;" autocomplete="off">
                <div><input id="cardSearchBox" type="text" placeholder="type a card name"></div>
                <div><input id="searchButton" class="hide" type="submit" value="search" onclick=""></div>
            </form>
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
        var rndInt = "null";
        //math
        function randomIntFromInterval(min, max) { // min and max included 
            return Math.floor(Math.random() * (max - min + 1) + min);
        }

        var rndInt = randomIntFromInterval(0, 3);
        console.log(rndInt);

        // function cardSearch() {
        //     var cardName = document.getElementById("cardSearchBox").value;
        //     console.log(cardName);
        //     getCard("https://api.scryfall.com/cards/named?fuzzy=" + cardName);
        // }
        
        //init global variables

        //this is the unique ID for the card on Scryfall
        let cardID = "null";
        //array of image URLs
        let cardImageURI = "null";
        //large size card image
        let cardImageSmall = "null";
        //the general name of the card, used in fuzzy search
        let cardName = "xantcha"

        //experimental double-face card parameters, will finish these later
        let cardBackID = "null";
        let cardBackURL = "null";
        let cardBackImageURI = "null";
        let cardBackImageURL = "null";

        //API Call to Scryfall API using GET method, this gets the card using search parameters and stores the extraneous card info in existing variables
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
            //function to reapply sound related event listeners to entities created after page load
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

            //prevent default context menu when right clicking
            $(this).on("contextmenu",function(e){
                console.log("no clicky");
                return false;   
            }); 


            //tooltips
            $('.menuItem').hover(function(){
                var menuItemID = $(this).attr("id");
                var tooltipID = "[aria-controls='" + menuItemID + "']";
                $(tooltipID).css("opacity", "1");
                $(this).on("mouseleave", function(){
                    $('.tooltip').css("opacity", "0");
                });
            });

            //goofy search button messages
            const searchButtonValues = [
                "gimme one",
                "this please",
                "i take",
                "give now"
            ];
            //choose random goofy search button message for this session
            var searchButtonText = "null";
            var rndNum = "null";
            rndNum = randomIntFromInterval(0, 3);
            searchButtonText = searchButtonValues[rndNum];
            $("#searchButton").val(searchButtonText);
            //show/hide search button depending on whether there are any characters in the search bar
            $(document).on("keydown", function() {
                if ($("#cardSearchBox").val()) {
                    //show search button if search box has text
                    $("#searchButton").removeClass("hide");
                    $("#searchButton").addClass("show");
                } else {
                    //hide if box is empty
                    $("#searchButton").addClass("hide");
                    $("#searchButton").removeClass("show");
                }
            });


            //count number of status messagesm this is used to delete messages older than 5 in the status log
            var statusCounter = 1;

            //draw 7 -- deprecated
            // $('#menuItem2').on('click', function(){
            //     $('#defaultStatus').remove();
            //     var statusID = "status"+statusCounter;
            //     var statusTarget ="#status"+(statusCounter-1);
            //     var statusMessage = "<div class='status' "+"id='"+statusID+"'>you drew 7 cards</div>";
            //     console.log(statusMessage);
            //     console.log(statusTarget);
            //     cardCount-=7;
            //     $('.cardCounter').html(cardCount);
            //     if (statusCounter == 5) {
            //         $(".status").remove();
            //         $('.statusContainer').prepend(statusMessage);
            //         statusCounter = 1;
            //     } else {
            //         $('.statusContainer').prepend(statusMessage);
            //         statusCounter++;
            //     }
                
            // });

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

            $("#searchButton").on('click', function(){
                cardName = document.getElementById("cardSearchBox").value;
                console.log(cardName);
                getCard("https://api.scryfall.com/cards/named?fuzzy=" + cardName);

                setTimeout (function(){
                    $('.playArea').prepend("<img class='playingCard ui-draggable ui-draggable-handle drawCard' src='" + cardImageSmall + "' alt=''>");
                    $('.drawCard').removeClass('drawCard');
                    refreshCards();
                    refreshSounds();
                    $("#cardSearchBox").val("");
                    $("#searchButton").addClass("hide");
                    $("#searchButton").removeClass("show");
                }, 200);
                
            });

            //tap cards by hovering the card and pressing R
            $('.playingCard').hover(function(){
                var $this = $(this);
                $(document).keydown(function(keyPressed) {
                    if (keyPressed.keyCode == 84) {
                        $this.toggleClass('tapped');
                    }
                });
            });

            //flip cards by hovering the card and pressing F
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
                        if (keyPressed.keyCode == 84) {
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