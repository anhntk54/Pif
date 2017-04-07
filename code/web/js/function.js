jQuery(document).ready(function() {
var aboveHeight = jQuery('#stickymenu').offset();
var adsHeight = jQuery('#noidung').offset();
    jQuery(window).scroll(function(){
        if (jQuery(window).scrollTop() > aboveHeight.top){
            jQuery('#stickymenu').addClass('fixed').fadeIn();
        } 
        else {
            jQuery('#stickymenu').removeClass('fixed');
        }
    });
});