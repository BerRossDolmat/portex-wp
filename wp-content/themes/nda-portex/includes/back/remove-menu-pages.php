<?php
// List of functions that hide menu items from main menu in dashboard
function nda_remove_menu_pages() {

    // Remove standart menu items
    remove_menu_page( 'edit.php' );
    remove_menu_page( 'edit-comments.php' );
    remove_menu_page( 'themes.php' );
    remove_menu_page( 'users.php' );
    remove_menu_page( 'tools.php' );

    // Remove SEO friendly image button 
    remove_menu_page( 'sfi_settings' );
    remove_menu_page( 'wpfastestcacheoptions' );  
}