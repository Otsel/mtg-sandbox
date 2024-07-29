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
    console.log(statusMessage);
    console.log(statusTarget);
    cardCount--;
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

$('.playerHand').droppable({
    // accept: ".playingCard"
    drop: function( event, ui ) {
        // $(this).toggleClass( "in-hand" );
        console.log("plopped in hand");
    }
});





})(jQuery);