<?php

 $absolute_path = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);

 $wp_load = $absolute_path[0] . 'wp-load.php';

 require_once($wp_load);



  /**

  Do stuff like connect to WP database and grab user set values

  */



  header('Content-type: text/css');

  header('Cache-control: must-revalidate');

?>



:root {

     /*COLORS*/

     --primary: <?php echo esc_attr( get_option( 'primary_color_picker' ) ); ?>;

     --secondary: <?php echo esc_attr( get_option( 'secondary_color_picker' ) ); ?>; 



     --dark: <?php echo esc_attr( get_option( 'dark_mode_picker' )[1] ); ?>;

     --darkshade: <?php echo esc_attr( get_option( 'dark_mode_picker' )[0] ); ?>;

     

     --light: <?php echo esc_attr( get_option( 'light_mode_picker' )[0] ); ?>;

     --lightshade: <?php echo esc_attr( get_option( 'light_mode_picker' )[1] ); ?>;



     /*HEADER*/

     --headerLogoWidth: <?php echo esc_attr( get_option('se_header_logowidth') ) . 'vw'; ?>

}