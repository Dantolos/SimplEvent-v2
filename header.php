<!DOCTYPE html>
<html>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width">
  <title><?php bloginfo('name'); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="keywords" content="<?php echo esc_attr( get_option( 'se_keywords' ) ); ?>">
  <meta name="description" content="<?php echo __('Jedes Jahr treffen sich 1350 Führungspersönlichkeiten aus Wirtschaft, Wissenschaft, Politik und Medien zum aktiven Meinungsaustausch und branchenübergreifenden Dialog.'); ?>">
  <meta name="copyright" content="<?php bloginfo('name'); ?> 2020-2021" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

     <style>
          body {
               --primary: <?php echo esc_attr( get_option( 'primary_color_picker' ) ); ?>;
               --secondary: <?php echo esc_attr( get_option( 'secondary_color_picker' ) ); ?>;
          }
     </style>

<?php



function theme_add_files() 
{

    wp_enqueue_style( 'wp-style-css', get_template_directory_uri() . '/style.css', '', '1.0.01' );
    wp_enqueue_style( 'style-css', get_template_directory_uri() . '/style/dist/style.min.css', '', '1.0.06' );
    
    //3rd lybraris
    wp_enqueue_script( 'gsap-js', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js', true );

    wp_enqueue_script( 'script-js', get_template_directory_uri() . '/scripts/script.js', array('jquery'), '1.0.06', true );
    
 
    //include Mobile Scripts
    if ( wp_is_mobile() ) {
     wp_enqueue_script( 'mobile-script-js', get_template_directory_uri() . '/scripts/mobile-script.js', array('jquery'), '1.0.05', true );        // wp_enqueue_script( 'mobile-script-js', get_template_directory_uri() . '/js/mobile.script.js', array('jquery'), '1.0.10', true );
    } else {
        /* Include/display resources targeted to laptops/desktops here */
    }
     
}
add_action( 'wp_enqueue_scripts', 'theme_add_files' );

//including classes
require_once('inc/classes/post.class.php');

require_once('inc/classes/company.class.php');
require_once('inc/classes/events.class.php');
require_once('inc/classes/people.class.php');
require_once('inc/classes/partner.class.php');

//including assets
require_once('inc/assets/button.php');

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
                    <img src="<?php echo get_option( 'event_logo_neg' ); ?>" 
                         alt="SEF.Growth" 
                         title="<?php echo bloginfo('name'); ?>">
               </a>
          </div>

          <?php
     
          //mobile menu wrapper + burgermenu
          if(wp_is_mobile()){ 
               echo '<div id="burger-menu"><svg version="1.1" id="se_burger_menu" x="0px" y="0px" viewBox="0 0 17.5 10.5" style="enable-background:new 0 0 17.5 10.5;" xml:space="preserve">
               <style media="screen">#se_burger_menu {stroke:#d9d9d9;} </style>
               <g>
                    <line LID="0" class="se_BMstroke" x1="0" y1="1" x2="17.5" y2="1"/>
                    <line LID="1" class="se_BMstroke" x1="0" y1="5.2" x2="17.5" y2="5.2"/>
                    <line LID="2" class="se_BMstroke" x1="0" y1="9.5" x2="17.5" y2="9.5"/>
                 <line LID="3" class="se_BMstroke" x1="0" y1="5.2" x2="17.5" y2="5.2"/>
               </g>
             </svg></div>';
               echo '<div id="mobile-menu-wrapper">';
          }
               
               $menuArgs = array(
                    'menu'              => "18", 
                    'menu_class'        => "menu",
                    'container'         => "nav", 
                    'container_class'   => "se2-navigation", 
                    'walker'            => new Walker_Nav_Primary()
               );
               wp_nav_menu( $menuArgs );
               ?>

               <div id="extramenu">
                    <div id="languagebutton">
                    <?php  
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
                    ?>
                    </div>

                    <button id="modebutton">Darkmode</button>

                    <?php
                    //ANMELDEBUTTON
                    $regBtnText = esc_attr( get_option( 'se_anmeldetext' ));

              
                         $seanmeldung = esc_attr( get_option( 'se_anmeldung' ) );
                         if( $seanmeldung == 'on') { ?>
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
          //mobile menu wrapper closer
          if(wp_is_mobile()){ echo '</div>'; }
          ?>
          

    </header>
     <!----------------
    -----MAIN MENU--END
    ------------------>

    <div id="master-container">