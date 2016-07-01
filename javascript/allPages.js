document.getElementById("home").onclick= function() {
   if (document.getElementById("homepage").style.display=="none"){
       document.getElementById("homepage").style.display=="inline-block";
       document.getElementById("billing").style.display=="none";       
   }
}
document.getElementById("bill").onclick= function() {
   if (document.getElementById("billing").style.display=="none"){
       document.getElementById("homepage").style.display=="inline-block";
       document.getElementById("billing").style.display=="none";       
   }
 
}

// JQUERY CODE

$(document).ready(function(){
    
    
    // height of the content
    $("#content").height( $( window ).height() );
    
    // position and set the size of the header 
    $("#header").width( $( window ).width()-80 ); // set the size at starting (80 is the menu width)
    $(window).on('resize', function(){  // position on resizing the window
        var windowWidth = $( window ).width();
        $("#header").width( windowWidth-80 );
    });
    
    
    
});