<?php



//FAVICON
function favicon4admin() {
     echo '<link rel="Shortcut Icon" type="image/x-icon" href="' . get_option( 'event_icon_neg' ) . '" />';
}

add_action( 'admin_head', 'favicon4admin' );




//CUSTOM THEME
function slate_files() {
     wp_enqueue_style( 'admin-theme', get_stylesheet_directory_uri()  . '/theme/plugins/se2-custom-admin/se2-custom-admin.css', array(), '1.2.3' );
}

add_action( 'admin_enqueue_scripts', 'slate_files' );
add_action( 'login_enqueue_scripts', 'slate_files' );


//CUSTOM ADMIN COLOR SCHEME
require get_template_directory() . '/theme/plugins/se2-custom-admin/se2-admin-color-scheme/se2-admin-color-scheme.php';


//DASHBOARD ICON

function wpb_custom_logo() {
     echo '
     <style type="text/css">
          #wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before {
               background-image: url(' . get_option( 'event_icon_neg' ) . ') !important;
               background-position: 50% 50%;
               color:rgba(0, 0, 0, 0);
               background-repeat: no-repeat;
          }

          #wpadminbar #wp-admin-bar-wp-logo.hover > .ab-item .ab-icon {
               background-position: 0 0;
          }
     </style>
     ';
}

     

//hook into the administrative header output
add_action('wp_before_admin_bar_render', 'wpb_custom_logo');



//MENU ORDER


/* 
'index.php', // Dashboard
'edit.php?post_type=page', // Pages
'edit.php', // Posts
'upload.php', // Media
'themes.php', // Appearance
'separator1', // --Space--
'edit-comments.php', // Comments
'users.php', // Users
'separator2', // --Space--
'plugins.php', // Plugins
'tools.php', // Tools
'options-general.php', // Settings 
*/

add_filter('custom_menu_order', function() { return true; });
add_filter('menu_order', 'my_new_admin_menu_order');

function my_new_admin_menu_order( $menu_order ) {

     // define your new desired menu positions here
     // for example, move 'upload.php' to position #9 and built-in pages to position #1
     $new_positions = array(
          'upload.php' => 12, // Media
          'edit.php?post_type=page' => 3,  // Pages
          'plugins.php' => 17,
          'options-general.php' => 15,
          'complianz-gpdr' => 80
     );

     function move_element(&$array, $a, $b) {
          $out = array_splice($array, $a, 1);
          array_splice($array, $b, 0, $out);
     }

     // traverse through the new positions and move 
     // the items if found in the original menu_positions
     foreach( $new_positions as $value => $new_index ) {
          if( $current_index = array_search( $value, $menu_order ) ) {
               move_element($menu_order, $current_index, $new_index);
          }
     }

     return $menu_order;

};


   

function se2_add_separators() {
     
     add_admin_menu_separator(2); // after SimplEvent
     add_admin_menu_separator(5); // after Pages
     //add_admin_menu_separator(61); // after Media
     add_admin_menu_separator(91); // after Plugins
     add_admin_menu_separator(120); // after ACF
}

add_action('admin_menu', 'se2_add_separators');



function add_admin_menu_separator($position) {

     global $menu;
     static $uid = 0;

     if ( !is_int($position) ) {

          //Find the position of the menu that matches
          //the specified file name or URL.
          $menuPosition = 0;

          foreach($menu as $menuPosition => $item) {
               if ( $item[2] === $position ) {
                    break;
               }
          }

          //We'll insert the separator just after the target menu.
          $position = $menuPosition + 1;
     }

     $menuFile = 'separator-custom-' . $uid++;
     $menu[$position] = array(
          '',                  //Menu title (ignored)
          'read',              //Required capability
          $menuFile,           //URL or file (ignored, but must be unique)
          '',                  //Page title (ignored)
          'wp-menu-separator', //CSS class. Identifies this item as a separator.
     );

     ksort($menu);

}

