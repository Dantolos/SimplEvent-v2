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

     <?php 
     $lightmode = true;
     if($lightmode){ ?>
          --light: <?php echo esc_attr( get_option( 'light_mode_picker' )[0] ); ?>;
          --lightshade: <?php echo esc_attr( get_option( 'light_mode_picker' )[1] ); ?>;
    
          --dark: <?php echo esc_attr( get_option( 'dark_mode_picker' )[1] ); ?>;
          --darkshade: <?php echo esc_attr( get_option( 'dark_mode_picker' )[0] ); ?>;
          --containerBorder: 2px;
     <?php } else {?>
          --light: #121212; 
          --lightshade:  #222626;

          --dark: #6e6d6e;
          --darkshade:#cdd1cc;

          --containerBorder: 0px;
     <?php } ?>
     

     

     

     

     

     



     /*HEADER*/

     --headerLogoWidth: <?php echo esc_attr( get_option('se_header_logowidth') ) . 'vw'; ?>

     <?php if( !get_option( 'font_name' ) && !get_option( 'font_link' ) ) { 
               echo '@font-face {';
                    echo 'font-family: "PTSansPro";';
                    echo 'src: url("' . get_template_directory_uri() . '/fonts/PTSansPro-Light.eot");';
                    echo 'src: url("' . get_template_directory_uri() . '/fonts/PTSansPro-Light.eot?#iefix") format("embedded-opentype"),';
                         echo 'url("' . get_template_directory_uri() . '/fonts/PTSansPro-Light.woff2") format("woff2"),';
                         echo 'url("' . get_template_directory_uri() . '/fonts/PTSansPro-Light.woff") format("woff"),';
                         echo 'url("' . get_template_directory_uri() . '/fonts/PTSansPro-Light.ttf")  format("truetype"),';
                         echo 'url("' . get_template_directory_uri() . '/fonts/PT_Sans_Pro-Light.otf")  format("opentype")';
               echo '}';
               echo '@font-face {';
                    echo 'font-family: "PTSansPro";';
                    echo 'font-weight: bold;';
                    echo 'src: url("' . get_template_directory_uri() . '/fonts/PTSansPro-ExtraBold.eot");';
                    echo 'src: url("' . get_template_directory_uri() . '/fonts/PTSansPro-ExtraBold.eot?#iefix") format("embedded-opentype"),';
                         echo 'url("' . get_template_directory_uri() . '/fonts/PTSansPro-ExtraBold.woff2") format("woff2"),';
                         echo 'url("' . get_template_directory_uri() . '/fonts/PTSansPro-ExtraBold.woff") format("woff"),';
                         echo 'url("' . get_template_directory_uri() . '/fonts/PTSansPro-ExtraBold.ttf")  format("truetype"),';
                         echo 'url("' . get_template_directory_uri() . '/fonts/PT_Sans_Pro-Extra_Bold.otf")  format("opentype")';
               echo '}';
               echo 'body { font-family: "PTSansPro", Fallback, sans-serif; }';
          } else {
               echo 'body { ' . get_option( 'font_name' ) . ' }';
          } 
          if( get_option( 'title_font' ) && get_option( 'title_font_name' ) && get_option( 'title_font_link' ) ) {
               echo 'h1, h2, h3 { ' . get_option( 'title_font_name' ) . ' font-weight:800 !important; text-transform: none !important; }';
          }
          
          ?>

}