(function($) {
console.log("loading javascript [SUCCESS]");

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
    src: ['../../src/audio/rollover1.ogg'],
    volume: 0.15
});
var click = new Howl({
    src: ['../../src/audio/click.ogg'],
    volume: 0.5
});
var scoop = new Howl({
    src: ['../../src/audio/scoop.ogg'],
    volume: 0.5
});
var slap = new Howl({
    src: ['../../src/audio/slap.ogg'],
    volume: 0.25
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
    $('.playArea').prepend('<img class="playingCard ui-draggable ui-draggable-handle drawCard" src="../../src/img/default.jpg" alt="">');
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
}

$('.playerHand').droppable({
    // accept: ".playingCard"
    drop: function( event, ui ) {
        // $(this).toggleClass( "in-hand" );
        console.log("plopped in hand");
    }
});





})(jQuery);