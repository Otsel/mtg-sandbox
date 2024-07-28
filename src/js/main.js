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
            console.log("you pressed the R key");
            $this.toggleClass('tapped');
        }
    });
});

//make cards draggable

//drop the card on release
// $('.playingCard').on("mouseup", function(){
//     $(this).css("height", "200px");
// });

$('.playingCard').draggable({
    containment:"body", 
    scroll: false,
    drag: function (event, ui) {
        $(this).toggleClass( "in-hand" );
        $(this).css("z-index", "1");
    }
});
// $('.playingCard').draggable();
$('.playerHand').droppable({
    // accept: ".playingCard"
    drop: function( event, ui ) {
        // $(this).toggleClass( "in-hand" );
        console.log("plopped in hand");
    }
});





})(jQuery);