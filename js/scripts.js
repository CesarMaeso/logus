(function($) {

    'use strict';
  
    window.logus = window.logus || {};  


    logus.init = function() {
        
        window.$ = window.jQuery;

        // foundation
        if (window.Foundation) { 
		  $(document).foundation();
        }

        // owl-carousel init         
        window.setTimeout( function(){
            if ( $().owlCarousel ) {
        	    var $owl = $('.owl-carousel');
                if ($owl.length){
                    $owl.owlCarousel({
                        animateOut: 'slideOutDown',
                        animateIn: 'flipInX',
                        items:1, 
                        loop: true,
                        smartSpeed:450
                    });
                }
            }
        }, 500)

    }	

    logus.testJquery = function() {
        window.jQuery?logus.init():window.setTimeout( logus.testJquery, 100 );
    }
    
    logus.testJquery();

})(jQuery);
