jQuery(document).ready(function() {

    jQuery('.mobile-menu-opener, .close-mobile-menu, .close-mobile-menu-links').click(function(event) {
        event.preventDefault();
        jQuery('.mobile-menu-container').fadeToggle();
    });
});
