<?php
function wpsh_remove_dashboard_widgets() {

remove_meta_box( 'dashboard_primary','dashboard','side' ); // WordPress.com Blog
remove_meta_box( 'dashboard_plugins','dashboard','normal' ); // Plugins
remove_meta_box( 'dashboard_right_now','dashboard', 'normal' ); // Right Now
remove_action( 'welcome_panel','wp_welcome_panel' ); // Welcome Panel
remove_action( 'try_gutenberg_panel', 'wp_try_gutenberg_panel'); // Try Gutenberg
remove_meta_box('dashboard_quick_press','dashboard','side'); // Quick Press widget
remove_meta_box('dashboard_recent_drafts','dashboard','side'); // Recent Drafts
remove_meta_box('dashboard_secondary','dashboard','side'); // Other WordPress News
remove_meta_box('dashboard_incoming_links','dashboard','normal'); //Incoming Links
remove_meta_box('rg_forms_dashboard','dashboard','normal'); // Gravity Forms
remove_meta_box('dashboard_recent_comments','dashboard','normal'); // Recent Comments
remove_meta_box('icl_dashboard_widget','dashboard','normal'); // Multi Language Plugin
remove_meta_box('dashboard_activity','dashboard', 'normal'); // Activity
}
add_action( 'wp_dashboard_setup', 'wpsh_remove_dashboard_widgets' );

// Remove Elementor Overview widget
function disable_elementor_dashboard_overview_widget() {
remove_meta_box( 'e-dashboard-overview', 'dashboard', 'normal');
}
add_action('wp_dashboard_setup', 'disable_elementor_dashboard_overview_widget', 40);

// remove WooCommerce Dashboard Status widgets
function remove_dashboard_widgets(){
remove_meta_box( 'woocommerce_dashboard_status', 'dashboard', 'normal');    
}
add_action('wp_user_dashboard_setup', 'remove_dashboard_widgets', 20);
add_action('wp_dashboard_setup', 'remove_dashboard_widgets', 20);

// Remove Site Health from the Dashboard
add_action(
'wp_dashboard_setup',
function () {
   global $wp_meta_boxes;
   unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_site_health'] );
}
);