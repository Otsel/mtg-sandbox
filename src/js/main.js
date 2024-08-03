(function($) {
console.log("loading javascript [SUCCESS]");

//API
let cardID = "null";
let cardImageURI = "null";
let cardImageSmall = "null";

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

    // getCardBack();
    console.log(cardID); // or use the result variable
    console.log(cardImageSmall);

}
getCard("https://api.scryfall.com/cards/named?fuzzy=xantcha sleeper agent");

async function getCardBack(cardBackURL) {
    const res = await fetch(cardBackURL) ;
    const result = await res.json();
    cardBackImageURI = result['image_uris'];
    cardBackImageURL = cardBackImageURI.large;
    
    console.log(cardBackID);
    console.log(cardBackImageURI);
    console.log(cardBackImageURL);
}



//main menu animations
$('.card').each(function(){
    var $this = $(this);
    $this.css("opacity", "0");
    setTimeout(
        function() 
        {
            $this.css("opacity", "1");
    }, 1500);
});

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