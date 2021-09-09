<!DOCTYPE html>
<html>
<head>
     <meta charset="<?php bloginfo('charset'); ?>">
     <meta name="viewport" content="width=device-width">
     <title><?php bloginfo('name'); ?></title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="description" content="<?php echo get_option('meta_tags')['SocialMedia']['Description']; ?>">
     <meta name="copyright" content="<?php echo bloginfo('name'); ?> 2020-2021" />

     <meta name="keywords" content="<?php echo get_option('meta_tags')['Keywords']; ?>" />

     <meta property="og:title" content="<?php echo get_option('meta_tags')['SocialMedia']['Title']; ?>">
     <meta property="og:description" content="<?php echo get_option('meta_tags')['SocialMedia']['Description']; ?>">
     <meta property="og:image" content="<?php echo get_option('meta_tags')['SocialMedia']['Image']; ?>">
     <meta property="og:url" content="<?php echo get_option('meta_tags')['SocialMedia']['URL']; ?>">

     <?php 
     //Google Analytics
     if(get_option( 'google_analytics_ua' )){
          $anonym = ( get_option( 'anonymize_ip' ) == 'on' ) ? '{ \'anonymize_ip\': true }' : '';
          ?>
          <!-- Global site tag (gtag.js) - Google Analytics -->
          <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr(get_option( 'google_analytics_ua' )); ?>"></script>
          <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
          gtag('config', '<?php echo esc_attr(get_option( 'google_analytics_ua' )); ?>', <?php echo $anonym; ?> );
          </script>
               
     <?php } ?>

     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
     
     <?php 
          //FAVICON
          if( get_option( 'event_icon' ) || get_option( 'event_icon_neg' ) ){
               if(isset($_COOKIE["mode"])){
                    $favicon = ($_COOKIE["mode"]) ? get_option( 'event_icon_neg' ) : get_option( 'event_icon' );
               } else {
                    $favicon = get_option( 'event_icon' );
               }
               echo '<link rel="icon" type="image/svg+xml" href="'.$favicon.'">';
               echo '<link rel="alternate icon" href="'.$favicon.'">';
               echo '<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#ff8a01">';
          }
     ?>
     
     <!-- LOAD GOOGLE FONT -->
     <?php
     if( get_option( 'font_name' ) && get_option( 'font_link' ) ) {
          echo '<link rel="preconnect" href="https://fonts.gstatic.com">';
          echo '<link href="'.get_option( 'font_link' ).'" rel="stylesheet">';
     }

     if( get_option( 'title_font' ) && get_option( 'title_font_name' ) && get_option( 'title_font_link' ) ) {
          echo '<link rel="preconnect" href="https://fonts.gstatic.com">';
          echo '<link href="'.get_option( 'title_font_link' ).'" rel="stylesheet">';
     }
     ?>

     <style>
          /*FONT*/
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

          body {
               /*COLORS*/
               --primary: <?php echo esc_attr( get_option( 'primary_color_picker' ) ); ?>;
               --secondary: <?php echo esc_attr( get_option( 'secondary_color_picker' ) ); ?>; 
    
               --dark: <?php echo esc_attr( get_option( 'dark_mode_picker' )[0] ); ?>;
               --darkshade: <?php echo esc_attr( get_option( 'dark_mode_picker' )[1] ); ?>;
               
               --light: <?php echo esc_attr( get_option( 'light_mode_picker' )[0] ); ?>;
               --lightshade: <?php echo esc_attr( get_option( 'light_mode_picker' )[1] ); ?>;

               /*HEADER*/
               --headerLogoWidth: <?php echo esc_attr( get_option('se_header_logowidth') ) . 'vw'; ?>
          }
          header {
               <?php 
               if( isset(get_option( 'se_header_mode' )[0])  ){
                    echo 'color: var(--dark); background-color: var(--light);';
               } else if( isset(get_option( 'se_header_mode' )[1]) == 'Dark' ){ 
                    echo 'color: var(--light); background-color: var(--dark);';
               } else {
                    echo 'color: #ffffff; background-color: var(--primary);';
               } 
               ?>
          }
     </style>



<?php

function theme_add_files() 
{
     $scriptversion = '1.0.56'; 
     wp_enqueue_style( 'wp-style-css', get_template_directory_uri() . '/style.css', '', '1.0.19' );
     wp_enqueue_style( 'style-css', get_template_directory_uri() . '/style/build/style.css', '', $scriptversion );
     
     //3rd libraries
     //wp_enqueue_script( 'smooth-scrollbar', get_template_directory_uri() . '/scripts/libraries/smooth-scrollbar/smooth-scrollbar.js', true );

     //gsap
     wp_enqueue_script( 'gsap-js', get_template_directory_uri() . '/scripts/libraries/gsap/gsap.min.js', true );
     wp_enqueue_script( 'gsap-morph-svg', get_template_directory_uri() . '/scripts/libraries/gsap/MorphSVGPlugin.min.js', true );
     wp_enqueue_script( 'gsap-scrollto', get_template_directory_uri() . '/scripts/libraries/gsap/ScrollToPlugin.min.js', true );
     wp_enqueue_script( 'gsap-scrolltrigger', get_template_directory_uri() . '/scripts/libraries/gsap/ScrollTrigger.min.js', true );
     

     wp_enqueue_script( 'script-js', get_template_directory_uri() . '/scripts/script.js', array('jquery'), $scriptversion, true );

     
    
          
}
add_action( 'wp_enqueue_scripts', 'theme_add_files' );

//including supports
require_once('inc/supports/date.php');
require_once('inc/supports/forms.php');
require_once('inc/supports/schedule.php');
require_once('inc/supports/files.php');

//including assets
require_once('inc/assets/button.php');
require_once('inc/assets/socialmedia.php');

//including classes
require_once('inc/classes/post.class.php');

require_once('inc/classes/company.class.php');
require_once('inc/classes/events.class.php');
require_once('inc/classes/people.class.php');
require_once('inc/classes/partner.class.php');
require_once('inc/classes/lineup.class.php');
require_once('inc/classes/sessions.class.php');
require_once('inc/classes/mediacorner.class.php');
require_once('inc/classes/award.class.php');



wp_head();
?>



<style>
    
</style>
<body>
    <!----------------
    -----MAIN MENU----
    ------------------>
    <header class="clearfix">

          <div class="header-logo">
               <a href="<?php $url = home_url(); echo esc_url( $url ); ?>">
                    <?php $logo = ( isset(get_option( 'se_header_mode' )[0]) ) ? get_option( 'event_logo' ) : get_option( 'event_logo_neg' ); 
                    ?>
                    
                    <img src="<?php echo $logo; ?>" 
                         alt="SEF.Growth" 
                         title="<?php echo bloginfo('name'); ?>">
               </a>
          </div>

          <?php
     
        
         
               
               $menuArgs = array(
                    'menu'              => "Hauptmenu", 
                    'menu_class'        => "menu",
                    'container'         => "nav", 
                    'container_class'   => "se2-navigation menu-content", 
                    'walker'            => new Walker_Nav_Primary()
               );
               wp_nav_menu( $menuArgs );
               ?>

               <div id="extramenu" class="menu-content">
               <?php
               //SPRACHMENU
               $langMenu = esc_attr( get_option( 'se_header_language' ));
                    if( $langMenu === 'on') { 
                         echo '<div id="languagebutton">';
                              //display language menu
                              $languages = icl_get_languages('');
                              if(1 < count($languages))
                              {
                                   foreach($languages as $l)
                                   {
                                   if(!$l['active']) $langs[] = '<a href="' . $l['url'] . '"><button>' . $l['language_code'] . '</button></a>';
                                   }
                                   echo join( $langs );
                              }
                         echo '</div>'; 
                    }
                    if( get_option( 'se_header_mode_menu' ) == 'on' ){
                         echo '<button id="modebutton">Darkmode</button>';
                    }
                    ?>
                    <?php
                    //ANMELDEBUTTON
                    $regBtnText = esc_attr( get_option( 'se_anmeldetext' ));
                         $seanmeldung = esc_attr( get_option( 'se_anmeldung' ) );
                         if( $seanmeldung === 'on') { ?>
                              <a href="<?php echo esc_attr( get_option( 'se_anmeldelink' ) ) ; ?>" target="_blank" style="padding:0;">
                              <div id="header_anmeldebutton">
                                   <?php
                                   echo __($regBtnText, 'SimplEvent');
                                   ?>
                              </div>
                              </a>
                         <?php } 
                     ?>

               </div>

          <?php
          

          ?>
          

    </header>
     <!----------------
    -----MAIN MENU--END
    ------------------>


     <?php 
     // ------CTA------
     $cta = new se2_CTA;
     if(get_option( 'se_cta_activ' ) === 'on'){
          echo $cta->cast_cta_button();
     }
     
     ?>


    <div id="master-container">
          <div id="content-container">
           
               