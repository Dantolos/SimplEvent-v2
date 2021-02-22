<?php

//HIDE 
if(current_user_can( 'hide_post_section' )){
     
     //hide Post Section
     function remove_posts_menu() {
          remove_menu_page('edit.php');
     }
     add_action('admin_menu', 'remove_posts_menu');


}

if(current_user_can( 'hide_default_terms' )){
     
     //hide Post Section
     function remove_my_post_metaboxes() {
          remove_submenu_page( 'edit-tags.php?taxonomy=category', 'edit-tags.php?taxonomy=post_tag' );
          remove_submenu_page( 'edit-tags.php?taxonomy=category', 'edit-tags.php?taxonomy=category' );
     }
     add_action('admin_menu','remove_my_post_metaboxes');
}