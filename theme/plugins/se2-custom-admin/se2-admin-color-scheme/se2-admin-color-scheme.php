<?php



	

define( 'PATH', plugins_url( '', __FILE__ ) );





function add_custom_admin_themes() {

     wp_enqueue_style( 'admin-scheme-colors', get_stylesheet_directory_uri()  . '/theme/plugins/se2-custom-admin/se2-admin-color-scheme/colors.php', array(), '1.2.3' );



     wp_admin_css_color(

          'se2',

          __( 'SimplEvent' ),

          get_stylesheet_directory_uri() . '/style/dist/colors.min.css',

          array(
               esc_attr( get_option( 'dark_mode_picker' )[1]), 
               esc_attr( get_option( 'dark_mode_picker' )[0]), 
               esc_attr( get_option( 'light_mode_picker' )[1]), 
               esc_attr( get_option( 'light_mode_picker' )[0]), 
               esc_attr( get_option( 'primary_color_picker' ) ), 
               esc_attr( get_option( 'secondary_color_picker' ) )
          ),

          array( 'base' => '#e5f8ff', 'focus' => '#fff', 'current' => '#fff' )

      );

}

add_action( 'admin_init', 'add_custom_admin_themes' );



