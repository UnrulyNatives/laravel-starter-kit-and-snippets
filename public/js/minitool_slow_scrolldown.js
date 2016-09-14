
( function( $ ) {
    'use strict';
    // Check if scroll-behavior is supported and only then attaching the script 
    // if ( ! ( 'scroll-behavior' in getComputedStyle( document.documentElement ) ) ) {
        // return;
    // }
    
    $( '.scrollTo' ).on( 'click', function(e) {
        e.preventDefault();
        var href = $( this ).attr( 'href' );
        $( 'html, body' ).animate( { 
            scrollTop: $( href ).offset().top + 'px'
        }, 1500, function() {
            // adding hash to the address
            location.hash = href;
        } ); 
    } );
    
} ( jQuery ) );