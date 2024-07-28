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

// tooltips
$('.menuItem').hover(function(){
    console.log("menu item hovered");
    var menuItemID = $(this).attr("id");
    console.log(menuItemID)
    var tooltipID = "[aria-controls='" + menuItemID + "']";
    console.log(tooltipID);
    $(tooltipID).css("opacity", "1");
    $(this).on("mouseleave", function(){
        $('.tooltip').css("opacity", "0");
    });
});



})(jQuery);