<?php

/*

  ==================

  SimplEvent: ADMIN PAGE

  ==================

*/

ini_set('display_errors', 'On');

error_reporting(E_ALL);

require_once('pages/page-builder.php');

require_once('pages/se2-general.php');
require_once('pages/se2-header.php');
require_once('pages/se2-footer.php');
require_once('pages/se2-event.php');
require_once('pages/se2-live.php');
require_once('pages/se2-settings.php');


function SimplEvent_add_admin_page() {

  //Generate Simplevent Page
  add_menu_page( 'SimplEvent Theme Options', 'SimplEvent', 'se2_options', 'aagi_simplevent', 'simplevent_theme_create_page', get_template_directory_uri() . '/theme/Signum-neg.svg', 1 );

  //Generate SimplEvent Sub Pages
  add_submenu_page( 'aagi_simplevent', 'SimplEvent Theme Options', 'General', 'se2_options', 'aagi_simplevent', 'simplevent_theme_create_page' );
  add_submenu_page( 'aagi_simplevent', 'SimplEvent Header Options', 'Header', 'se2_options_header', 'simplevent_header', 'simplevent_theme_header_page' );
  add_submenu_page( 'aagi_simplevent', 'SimplEvent Footer Options', 'Footer', 'se2_options_footer', 'simplevent_footer', 'simplevent_theme_footer_page' );
  add_submenu_page( 'aagi_simplevent', 'SimplEvent Event Options', 'Event', 'se2_options_event', 'simplevent_event', 'simplevent_theme_event_page' );
  add_submenu_page( 'aagi_simplevent', 'SimplEvent Live Options', 'Live', 'se2_options_live', 'simplevent_live', 'simplevent_theme_live_page' );
  add_submenu_page( 'aagi_simplevent', 'SimplEvent Settings Options', 'Settings', 'se2_options_settings', 'simplevent_settings', 'simplevent_theme_settings_page' );

  //activieren custom settings
  add_action( 'admin_init', 'simplevent_custom_settings' );

}

add_action( 'admin_menu', 'SimplEvent_add_admin_page'); 


//save settings and seessions

function simplevent_custom_settings() {

     //----------------------------------GENERAL --------------------------------------//
     $generalPage = new se2_page_General;
     $generalPage->build_settings();

     //----------------------------------Header --------------------------------------//
     $headerPage = new se2_page_Header;
     $headerPage->build_settings();

     //----------------------------------Footer --------------------------------------//
     $footerPage = new se2_page_Footer;
     $footerPage->build_settings();

     //----------------------------------Event----------------------------------------//
     $eventPage = new se2_page_Event;
     $eventPage->build_settings();

     //----------------------------------Live-----------------------------------------//
     $livePage = new se2_page_Live;
     $livePage->build_settings();

     //--------------------------------Settings --------------------------------------//
     $settingsPage = new se2_page_Settings;
     $settingsPage->build_settings();

}








