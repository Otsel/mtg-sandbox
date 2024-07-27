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

$('.playingCard').draggable({containment:"body", scroll: false});
// $('.playingCard').draggable();
$('.playerHand').droppable({
    // accept: ".playingCard"
    drop: function( event, ui ) {
        $(this).toggleClass( "in-hand" );
        console.log("plop");
    }
});

})(jQuery);