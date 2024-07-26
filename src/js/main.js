(function($) {
console.log("loading jquery [SUCCESS]");

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

      

    
})(jQuery);