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
     <meta property="og:url" content="<?php echo get_permalink(); ?>">
     <meta property="og:site_name" content="<?php bloginfo('name'); ?>">

     <meta property="twitter:title" content="<?php echo get_option('meta_tags')['SocialMedia']['Title']; ?>">
     <meta property="twitter:description" content="<?php echo get_option('meta_tags')['SocialMedia']['Description']; ?>">
     <meta property="twitter:image" content="<?php echo get_option('meta_tags')['SocialMedia']['Image']; ?>">
     <meta name="twitter:card" content="<?php echo get_option('meta_tags')['SocialMedia']['Image']; ?>">
     <meta name="twitter:image:alt" content="<?php echo get_option('meta_tags')['SocialMedia']['Title']; ?>">

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
     $scriptversion = '1.0.83'; 
     wp_enqueue_style( 'wp-style-css', get_template_directory_uri() . '/style.css', '', '1.1.51' );
     wp_enqueue_style( 'style-css', get_template_directory_uri() . '/style/build/style.css', '', $scriptversion );
     
     //3rd libraries

     //fontawesome
     //wp_enqueue_script( 'fontawesome', 'https://kit.fontawesome.com/a1283e1be4.js', true );

     //jszip
     
     wp_enqueue_script( 'jszip', get_template_directory_uri() . '/scripts/libraries/JSZip/jszip.min.js', true );
     wp_enqueue_script( 'jsziputils', get_template_directory_uri() . '/scripts/libraries/JSZip/jszip-utils.min.js', true );
     wp_enqueue_script( 'filesaver', get_template_directory_uri() . '/scripts/libraries/JSZip/FileSaver.min.js', true );
     //splidejs
     wp_enqueue_script( 'slidejs', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@3.0.3/dist/js/splide.min.js', true );
     wp_enqueue_style( 'slidejs-style', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@3.0.3/dist/css/splide.min.css', '', '1.0.27' );

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
require_once('inc/supports/social-media.php');
require_once('inc/supports/slider.php');

//including assets
require_once('inc/assets/button.php');
require_once('inc/assets/socialmedia.php');
require_once('inc/assets/tags.php');

//including classes

require_once('inc/classes/company.class.php');
require_once('inc/classes/events.class.php');
require_once('inc/classes/people.class.php');
require_once('inc/classes/partner.class.php');
require_once('inc/classes/lineup.class.php');
require_once('inc/classes/sessions.class.php');
require_once('inc/classes/mediacorner.class.php');
require_once('inc/classes/review.class.php');
require_once('inc/classes/award.class.php');

wp_head();
?>
</head>


<body  lang="<?php echo ICL_LANGUAGE_CODE; ?>">
    <!----------------
    -----MAIN MENU----
    ------------------>
     <?php
     $videoHeaderClass = '';
     if( isset( get_option('se_header_video')['activ'] ) && is_front_page() ){
          $videoHeaderClass = 'video-header';
     } 
     $negativeHeaderContent = '';
     if( isset(get_option('se_header_video')['negativ']) && is_front_page() ){
          $negativeHeaderContent = 'se-header-negative';
     }
     ?>
     

    <header class="clearfix <?php echo $videoHeaderClass . ' ' . $negativeHeaderContent; ?>">

          <div class="header-logo">
               <?php
               $url = ( get_option('event_logo_link') ) ? get_option('event_logo_link') : home_url();
               ?>
               
               <a href="<?php echo esc_url( $url ); ?>">
                    <?php $logo = ( isset(get_option( 'se_header_mode' )[0]) ) ? get_option( 'event_logo' ) : get_option( 'event_logo_neg' ); 
                    if($negativeHeaderContent === 'se-header-negative' ){
                         $logo = get_option( 'event_logo_neg' );
                    }
                    ?>
                    
                    <img src="<?php echo $logo; ?>" 
                         alt="<?php echo bloginfo('name'); ?> Logo" 
                         title="<?php echo bloginfo('name'); ?>">
               </a>
          </div>

          <?php
               
               $menuArgs = array(
                    'menu'              => "Hauptmenu", 
                    'menu_class'        => "menu",
                    'container'         => "nav", 
                    'container_class'   => "se2-navigation menu-content ", 
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


                    if( get_option( 'se_header_mode_menu' ) == 'on' ){
                         echo '<button id="modebutton">Darkmode</button>';
                    }


                    //SOCIAL MEDIA
                    $socialMedias = get_option( 'social_media' );
                    $socialMediaIcons = new se2_SocialMedia(esc_attr( get_option( 'dark_mode_picker' )[0] ));
                    echo '<div id="header_socialmedia">';
                    if(get_option( 'social_media' )){
                         foreach( $socialMedias as $key => $smIcon ){
                              echo $socialMediaIcons->cast_icon($key, $smIcon );
                         }
                    }
                    echo '</div>';
                
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
     if(get_option( 'se_cta_activ' ) === 'on' && get_option( 'se_cta' )){
          echo '<div class="cta-container">';
          foreach( get_option( 'se_cta' ) as $ctaID ){
               echo $cta->cast_cta_button( $ctaID );
          }
          echo '</div>';
     }
     
     ?>


     <div id="master-container" class=" <?php echo $videoHeaderClass; ?>">
          <div id="content-container">
         