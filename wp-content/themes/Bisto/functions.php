<?php
function remove_wp_logo() {
   echo '
   <style>
   .login h1 a {
       display: none!important;
   }
   </style>
   ';
}
add_action( 'login_enqueue_scripts', 'remove_wp_logo' );


add_action( 'admin_menu', 'remove_admin_menu_items' );
function remove_admin_menu_items() {
   //remove_menu_page('index.php');
   //remove_menu_page('edit.php');
   // remove_menu_page('edit.php?post_type=page');
   // remove_menu_page('link-manager.php');

   // remove_menu_page('upload.php');
   // remove_menu_page('edit-comments.php');
   // remove_menu_page('themes.php');
   // remove_menu_page('plugins.php');
   // remove_menu_page('tools.php');
  
   //remove_menu_page('users.php');
   //remove_menu_page('options-general.php');
}

function style_backend() {
   // echo '
   // <style>
   //     #toplevel_page_edit-post_type-acf {
   //         display: none;
   //     }
   // </style>
   // ';
}
add_action( 'admin_head', 'style_backend' );
?>
