<?php

/*

  ==================

  SimplEvent: ADMIN PAGE

  ==================

*/



ini_set('display_errors', 'On');

error_reporting(E_ALL);



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

     //----------------------------------GENERAL ---------------------------------------//

     //****Settings

     register_setting( 'simplevent-settings-group', 'event_logo' );
     register_setting( 'simplevent-settings-group', 'event_logo_neg' );
     register_setting( 'simplevent-settings-group', 'event_icon' );
     register_setting( 'simplevent-settings-group', 'event_icon_neg' );

     register_setting( 'simplevent-settings-group', 'social_media' );

     register_setting( 'simplevent-settings-group', 'primary_color_picker' );
     register_setting( 'simplevent-settings-group', 'secondary_color_picker' );
     register_setting( 'simplevent-settings-group', 'light_mode_picker' );
     register_setting( 'simplevent-settings-group', 'dark_mode_picker' );

     register_setting( 'simplevent-settings-group', 'font_name' );
     register_setting( 'simplevent-settings-group', 'font_link' );

     register_setting( 'simplevent-settings-group', 'title_font' );
     register_setting( 'simplevent-settings-group', 'title_font_name' );
     register_setting( 'simplevent-settings-group', 'title_font_link' );


     register_setting( 'simplevent-settings-group', 'google_analytics_ua' );
     register_setting( 'simplevent-settings-group', 'anonymize_ip' );
     register_setting( 'simplevent-settings-group', 'footer_snippets' );

     register_setting( 'simplevent-settings-group', 'meta_tags' );


     //****SECTIONS
     add_settings_section( 'simplevent-general-options', 'General Options', 'simplevent_general_options', 'aagi_simplevent');
     add_settings_section( 'simplevent-color-options', 'Colors', 'simplevent_color_options', 'aagi_simplevent');
     add_settings_section( 'simplevent-fonts', 'Fonts', 'simplevent_fonts', 'aagi_simplevent');
     add_settings_section( 'simplevent-analytics', 'Analytics', 'simplevent_analytics', 'aagi_simplevent');
     add_settings_section( 'simplevent-meta', 'Meta', 'simplevent_meta', 'aagi_simplevent');




     //****fields
     add_settings_field( 'event_logo', 'Logo', 'simplevent_event_logo', 'aagi_simplevent', 'simplevent-general-options' );
     add_settings_field( 'event_logo_neg', 'Logo Negativ', 'simplevent_event_logo_neg', 'aagi_simplevent', 'simplevent-general-options' );
     add_settings_field( 'event_icon', 'Icon', 'simplevent_event_icon', 'aagi_simplevent', 'simplevent-general-options' );
     add_settings_field( 'event_icon_neg', 'Icon Negativ', 'simplevent_event_icon_neg', 'aagi_simplevent', 'simplevent-general-options' );

     add_settings_field( 'social-media', 'Social Media', 'simplevent_social_media', 'aagi_simplevent', 'simplevent-general-options' );
    
     add_settings_field( 'primary-color-picker', 'Primary Color', 'simplevent_primary_color_picker', 'aagi_simplevent', 'simplevent-color-options' );
     add_settings_field( 'secondary-color-picker', 'Secondary Color', 'simplevent_secondary_color_picker', 'aagi_simplevent', 'simplevent-color-options' );
     add_settings_field( 'light-mode-picker', 'Light Mode', 'simplevent_light_mode_picker', 'aagi_simplevent', 'simplevent-color-options' );
     add_settings_field( 'dark-mode-picker', 'Dark Mode', 'simplevent_dark_mode_picker', 'aagi_simplevent', 'simplevent-color-options' );

     add_settings_field( 'font-name', 'Font Name', 'simplevent_font_name', 'aagi_simplevent', 'simplevent-fonts' );
     add_settings_field( 'font-link', 'Font Link', 'simplevent_font_link', 'aagi_simplevent', 'simplevent-fonts' );

     add_settings_field( 'title-font', 'Title Font', 'simplevent_title_font', 'aagi_simplevent', 'simplevent-fonts' );
     add_settings_field( 'title-font-name', 'Title Font Name', 'simplevent_title_font_name', 'aagi_simplevent', 'simplevent-fonts' );
     add_settings_field( 'title-font-link', 'Title Font Link', 'simplevent_title_font_link', 'aagi_simplevent', 'simplevent-fonts' );


     add_settings_field( 'google-analytics-ua', 'Google Analytics', 'simplevent_google_analytics_ua', 'aagi_simplevent', 'simplevent-analytics' );
     add_settings_field( 'anonymize-ip', 'Anonymize IP', 'simplevent_anonymize_ip', 'aagi_simplevent', 'simplevent-analytics' );

     add_settings_field( 'footer-snippets', 'Footer Snippets', 'simplevent_footer_snippets', 'aagi_simplevent', 'simplevent-analytics' );

     add_settings_field( 'meta_tags', 'Meta Tags', 'simplevent_meta_tags', 'aagi_simplevent', 'simplevent-meta' );



  //----------------------------------Header ---------------------------------------//

  //****Settings

  register_setting( 'simplevent-header-group', 'se_anmeldung' );
  register_setting( 'simplevent-header-group', 'se_anmeldelink' );
  register_setting( 'simplevent-header-group', 'se_anmeldetext' );

  register_setting( 'simplevent-header-group', 'se_header_mode' );
  register_setting( 'simplevent-header-group', 'se_header_logowidth' );

  register_setting( 'simplevent-header-group', 'se_header_language' );
  register_setting( 'simplevent-header-group', 'se_header_mode_menu' );

  register_setting( 'simplevent-header-group', 'se_videoslider_activ' );
  register_setting( 'simplevent-header-group', 'se_source' );
  register_setting( 'simplevent-header-group', 'se_videosliderbuttontext' );
  register_setting( 'simplevent-header-group', 'se_videosliderbuttonlink' );

  register_setting( 'simplevent-header-group', 'se_cta_activ' );
  register_setting( 'simplevent-header-group', 'se_cta' );


  //****Section

  add_settings_section( 'simplevent-header-options', 'Header', 'simplevent_header_options', 'simplevent_header');
  add_settings_section( 'simplevent-header-style', 'Header Style', 'simplevent_header_style', 'simplevent_header');
  add_settings_section( 'simplevent-header-language', 'Header Language Menu', 'simplevent_header_language', 'simplevent_header');
  add_settings_section( 'simplevent-videoslider', 'Video Slider', 'simplevent_videoslider', 'simplevent_header');
  add_settings_section( 'simplevent-cta', 'Call to Action', 'simplevent_cta', 'simplevent_header');



  //****Fields

  add_settings_field( 'se-anmeldung', 'Anmeldung Aktiv', 'simplevent_se_anmeldung', 'simplevent_header', 'simplevent-header-options' );
  add_settings_field( 'se-anmeldelink', 'Anmeldung Link', 'simplevent_se_anmeldelink', 'simplevent_header', 'simplevent-header-options' );
  add_settings_field( 'se-anmeldetext', 'Anmeldung Text', 'simplevent_se_anmeldetext', 'simplevent_header', 'simplevent-header-options' );

  add_settings_field( 'se-header-mode', 'Header Style Mode', 'simplevent_se_header_mode', 'simplevent_header', 'simplevent-header-style' );
  add_settings_field( 'se-header-logowidth', 'Logo Width', 'simplevent_se_header_logowidth', 'simplevent_header', 'simplevent-header-style' );

  add_settings_field( 'se-header-language-menu', 'Show Language Menu', 'simplevent_se_header_language_menu', 'simplevent_header', 'simplevent-header-language' );
  add_settings_field( 'se-header-mode-menu', 'Show Mode', 'simplevent_se_header_mode_menu', 'simplevent_header', 'simplevent-header-language' );

  add_settings_field( 'se-videoslider_activ', 'Activate', 'simplevent_se_videoslider_activ', 'simplevent_header', 'simplevent-videoslider' );
  add_settings_field( 'se-source', 'Attention Text', 'simplevent_se_source', 'simplevent_header', 'simplevent-videoslider' );
  add_settings_field( 'se-videosliderbuttontext', 'Button Text', 'simplevent_se_videosliderbuttontext', 'simplevent_header', 'simplevent-videoslider' );
  add_settings_field( 'se-videosliderbuttonlink', 'Button Link', 'simplevent_se_videosliderbuttonlink', 'simplevent_header', 'simplevent-videoslider' );

  add_settings_field( 'se-cta_activ', 'Call to Action aktivieren', 'simplevent_se_cta_activ', 'simplevent_header', 'simplevent-cta' );
  add_settings_field( 'se-cta', 'CTA Content', 'simplevent_se_cta', 'simplevent_header', 'simplevent-cta' );



  //----------------------------------FOOTER ---------------------------------------//

  //****Settings

  register_setting( 'simplevent-footer-group', 'se_c_text' );

  register_setting( 'simplevent-footer-group', 'se_contact_name' );
  register_setting( 'simplevent-footer-group', 'se_contact_address' );

  register_setting( 'simplevent-footer-group', 'se_contact_phone' );
  register_setting( 'simplevent-footer-group', 'se_contact_email' );


  register_setting( 'simplevent-footer-group', 'se_footer_categories' );
  

  //****Section
  add_settings_section( 'simplevent-footer-options', 'Footer', 'simplevent_footer_options', 'simplevent_footer');
  add_settings_section( 'simplevent-footer-contact', 'Contact', 'simplevent_footer_contact', 'simplevent_footer');
  add_settings_section( 'simplevent-footer-partner', 'Partner', 'simplevent_footer_partner', 'simplevent_footer');

  //****Fields
  add_settings_field( 'ctext', 'Copyright Text', 'simplevent_se_c_text', 'simplevent_footer', 'simplevent-footer-options' );

  add_settings_field( 'contact-name', 'Name', 'simplevent_se_contact_name', 'simplevent_footer', 'simplevent-footer-contact' );
  add_settings_field( 'contact-address', 'Adresse', 'simplevent_se_contact_address', 'simplevent_footer', 'simplevent-footer-contact' );
  add_settings_field( 'contact-phone', 'Telefon Nummer', 'simplevent_se_contact_phone', 'simplevent_footer', 'simplevent-footer-contact' );
  add_settings_field( 'contact-email', 'E-Mail', 'simplevent_se_contact_email', 'simplevent_footer', 'simplevent-footer-contact' );

  add_settings_field( 'footer-categories', 'Kategorien', 'simplevent_se_footer_categories', 'simplevent_footer', 'simplevent-footer-partner' );





  //----------------------------------Event--------------------------------------//

  //****Settings
  register_setting( 'simplevent-event-group', 'facts_active' );
  register_setting( 'simplevent-event-group', 'facts_date' );
  register_setting( 'simplevent-event-group', 'facts_location' );
  register_setting( 'simplevent-event-group', 'facts_participants' );
  register_setting( 'simplevent-event-group', 'facts_languages' );
  register_setting( 'simplevent-event-group', 'facts_pricing' );

  register_setting( 'simplevent-event-group', 'sessions_active' );
  register_setting( 'simplevent-event-group', 'sessions_slots' );

  register_setting( 'simplevent-event-group', 'award_active' );
  register_setting( 'simplevent-event-group', 'award_categories' );
  register_setting( 'simplevent-event-group', 'awards' );


  //****Section
  add_settings_section( 'simplevent-event-facts', 'Facts', 'simplevent_event_facts', 'simplevent_event');
  add_settings_section( 'simplevent-event-sessions', 'Sessions', 'simplevent_event_sessions', 'simplevent_event');
  add_settings_section( 'simplevent-event-award', 'Award', 'simplevent_event_award', 'simplevent_event');


  //****Fields
  add_settings_field( 'facts-active', 'Facts Aktiv', 'simplevent_facts_active', 'simplevent_event', 'simplevent-event-facts' );
  add_settings_field( 'facts-date', 'Date', 'simplevent_facts_date', 'simplevent_event', 'simplevent-event-facts' );
  add_settings_field( 'facts-location', 'Location', 'simplevent_facts_location', 'simplevent_event', 'simplevent-event-facts' );
  add_settings_field( 'facts-participants', 'Participants', 'simplevent_facts_participants', 'simplevent_event', 'simplevent-event-facts' );
  add_settings_field( 'facts-languages', 'Languages', 'simplevent_facts_languages', 'simplevent_event', 'simplevent-event-facts' );
  add_settings_field( 'facts-pricing', 'Pricing', 'simplevent_facts_pricing', 'simplevent_event', 'simplevent-event-facts' );

  add_settings_field( 'sessions-active', 'Sessions', 'simplevent_sessions_active', 'simplevent_event', 'simplevent-event-sessions' );
  add_settings_field( 'sessions-slots', 'Slots', 'simplevent_sessions_slots', 'simplevent_event', 'simplevent-event-sessions' );

  add_settings_field( 'award-active', 'Award', 'simplevent_award_active', 'simplevent_event', 'simplevent-event-award' );
  add_settings_field( 'awards', 'Awards', 'simplevent_awards', 'simplevent_event', 'simplevent-event-award' );
  add_settings_field( 'award-categories', 'Kategorien', 'simplevent_award_categories', 'simplevent_event', 'simplevent-event-award' );





  //----------------------------------Live--------------------------------------//



  //****Settings
  register_setting( 'simplevent-live-group', 'se_livestream' );
  register_setting( 'simplevent-live-group', 'se_iframe' );
  register_setting( 'simplevent-live-group', 'se_programm' );

  //****Section
  add_settings_section( 'simplevent-live-options', 'Live', 'simplevent_live_options', 'simplevent_live');

  //****Fields
  add_settings_field( 'se-livestream', 'Livestream Aktiv', 'simplevent_se_livestream', 'simplevent_live', 'simplevent-live-options' );
  add_settings_field( 'se-iframe', 'iFrame', 'simplevent_se_iframe', 'simplevent_live', 'simplevent-live-options' );
  add_settings_field( 'se-programm', 'Programm Link', 'simplevent_se_programm', 'simplevent_live', 'simplevent-live-options' );




   //----------------------------------Settings ---------------------------------------//



  //****Settings

  register_setting( 'simplevent-settingspage-group', 'post_visibility' );





  //****Section

  add_settings_section( 'simplevent-capabilities-options', 'Capabilities', 'simplevent_settings_options', 'simplevent_settings');



  //****Fields

  add_settings_field( 'se-post_visibility', 'Post Visibility', 'simplevent_post_visibility', 'simplevent_settings', 'simplevent-capabilities-options', array( 'class' => 'full-width' ) );





}



function simplevent_general_options() {

  echo 'Allgemeine Anpassungen | Logo – Social Media';

}

function simplevent_color_options() {

  echo 'Farben anpassen';

}

function simplevent_fonts() {

  echo 'Google-Font einbinden';

}

function simplevent_analytics() {

  echo 'Google-Analytics einbinnden';

}

function simplevent_meta() {

     echo 'HTML Header - Meta Tags';
}


function simplevent_header_options() {
  echo '';
}

 

function simplevent_header_style() {
     echo '';
}

function simplevent_header_language(){
     echo '';
}

function simplevent_videoslider() {
  echo '';
}

function simplevent_cta(){
     echo '';
}


function simplevent_footer_options() {
  echo '';
}



function simplevent_footer_contact() {
     echo 'Kontakt Informationen';
}





function simplevent_footer_partner() {
     echo 'Mainpartner Kategorie auswählen, welche im Footer erscheinen sollen.';
}




function simplevent_event_facts() {

     echo 'Facts De/aktivieren';

}



function simplevent_event_sessions(){

     echo 'Session Settings';

}



function simplevent_event_award(){

     echo 'Award Settings';

}



function simplevent_live_options() {

     echo 'Livestream De/aktivieren';

}





function simplevent_settings_options() {

     echo 'Anzeige von Post-Admin-Menu in den verschiedenen Roles';

     echo '<i>(bearbeitung erlaubt für Grafik und Komm)</i>';

}

   



//---------------------------------------------OUTPUTS------------------------------------//



//----------------------------------GENERAL ---------------------------------------//

//social media

function simplevent_event_logo() {

  $logo = esc_attr( get_option( 'event_logo' ) );
  echo '<div class="image-preview"><img src="'.get_option( 'event_logo' ).'" /></div>';

  echo '<input type="button" style="width:25%;" value="Logo" class="button button-secondary upload-button" data-target="event-logo"/><input type="" style="width:73%;" id="event-logo" name="event_logo" value="' .$logo. '"/>';

}

function simplevent_event_logo_neg() {
     $logoNeg = esc_attr( get_option( 'event_logo_neg' ) );
     echo '<div class="image-preview image-neg"><img src="'.get_option( 'event_logo_neg' ).'" /></div>';

     echo '<input type="button" style="width:25%;" value="Logo Negativ" class="button button-secondary upload-button" data-target="event-logo-neg"/><input type="" style="width:73%;" id="event-logo-neg" name="event_logo_neg" value="' .$logoNeg. '"/>';
   }

function simplevent_event_icon() {

  $icon = esc_attr( get_option( 'event_icon' ) );

  echo '<div class="image-preview"><img src="'.get_option( 'event_icon' ).'" /></div>';
  echo '<input type="button" style="width:25%;" value="Icon" class="button button-secondary upload-button" data-target="event-icon"/><input type="" style="width:73%;" id="event-icon" name="event_icon" value="' .$icon. '"/>';

}

function simplevent_event_icon_neg() {

  $iconNeg = esc_attr( get_option( 'event_icon_neg' ) );

  echo '<div class="image-preview image-neg"><img src="'.get_option( 'event_icon_neg' ).'" /></div>';
  echo '<input type="button" style="width:25%;" value="Icon Negativ" class="button button-secondary upload-button" data-target="event-icon-neg"/><input type="" style="width:73%;" id="event-icon-neg" name="event_icon_neg" value="' .$iconNeg. '"/>';

}


//********* SOCIAL MEDIA ***********/
function simplevent_social_media() {
     $socialMediaSTD = [
          'twitter'  => '',
          'youtube'  => '',
          'facebook' => '',
          'linkedin' => '',
          'insta'    => ''
     ];
     $socialMedia = (get_option( 'social_media' ) ) ? get_option( 'social_media' ) : $socialMediaSTD;

     echo '<p style="margin-top:20px;"><b>Twitter</b></p>';
     echo '<input type="text" name="social_media[twitter]" value="' .$socialMedia['twitter']. '" placeholder="Channel URL" />';

     echo '<p style="margin-top:20px;"><b>Youtube</b></p>';
     echo '<input type="text" name="social_media[youtube]" value="' .$socialMedia['youtube']. '" placeholder="Channel URL" />';

     echo '<p style="margin-top:20px;"><b>Facebook</b></p>';
     echo '<input type="text" name="social_media[facebook]" value="' .$socialMedia['facebook']. '" placeholder="Channel URL" />';

     echo '<p style="margin-top:20px;"><b>Linked In</b></p>';
     echo '<input type="text" name="social_media[linkedin]" value="' .$socialMedia['linkedin']. '" placeholder="Channel URL" />';
     
     echo '<p style="margin-top:20px;"><b>Instagramm</b></p>';
     echo '<input type="text" name="social_media[insta]" value="' .$socialMedia['insta']. '" placeholder="Channel URL" />';

}


//Colors output

function simplevent_primary_color_picker() {

  $primarycolor = get_option( 'primary_color_picker' );

  echo '<input class="se-color-picker" type="text" name="primary_color_picker" value="' .$primarycolor. '" data-default-color="#effeff" />';

}

function simplevent_secondary_color_picker() {

  $secondarycolor = get_option( 'secondary_color_picker' );

  echo '<input class="se-color-picker" type="text" name="secondary_color_picker" value="' .$secondarycolor. '" data-default-color="#282828" />';

}

function simplevent_light_mode_picker() {

     $lightmode = get_option( 'light_mode_picker' );

     $stdLight = array( '#FFFFFF', '#f1f1f1');

     $lightColors = (!is_array($lightmode)) ? $stdLight : $lightmode;

     $fieldName = array('Color', 'Shading');

     $cKey = 0;

     foreach($lightColors as $key => $color ){

          echo '<p>'.$fieldName[$cKey].'</p>';

          echo '<input class="se-color-picker" type="text" name="light_mode_picker['.$cKey.']" value="' .$color. '" data-default-color="'.$stdLight[$cKey].'" />';

          $cKey++;

     }

}

function simplevent_dark_mode_picker() {

     $darkmode = get_option( 'dark_mode_picker' );

     $stdDark = array( '#1c1c1c', '#141414');

     $darkColors = (!is_array($darkmode)) ? $stdDark : $darkmode;

     $fieldName = array('Color', 'Shading');

     $cKey = 0;

     foreach($darkColors as $key => $color ){

          echo '<p>'.$fieldName[$cKey].'</p>';

          echo '<input class="se-color-picker" type="text" name="dark_mode_picker['.$cKey.']" value="' .$color. '" data-default-color="'.$stdDark[$cKey].'" />';

          $cKey++;

     }

}



//Fonts

function simplevent_font_name() {
     $fontName = esc_attr( get_option( 'font_name' ) );
     echo '<input type="text" name="font_name" value="' .$fontName. '" placeholder="font-family: \'Roboto\', sans-serif;" />';
}

function simplevent_font_link() {
     $fontLink= esc_attr( get_option( 'font_link' ) );
     echo '<input type="text" name="font_link" value="' .$fontLink. '" placeholder="Google-Font Link-Tag" />';
}

function simplevent_title_font() {

     $titleFont = esc_attr( get_option( 'title_font' ) );

     if($titleFont == 'on'){ 
       $titleFont = 'checked';
     }
   
     echo '<input type="checkbox" name="title_font" ' .$titleFont. '/>';
     echo 'anwählen um eine Schriftart für Titel (h1-h3) zu ändern';

}

function simplevent_title_font_name() {

     $titleFontName = esc_attr( get_option( 'title_font_name' ) );

     echo '<input type="text" name="title_font_name" value="' .$titleFontName. '" placeholder="font-family: \'Roboto\', sans-serif;" />';

}

function simplevent_title_font_link() {

     $titleFontLink= esc_attr( get_option( 'title_font_link' ) );

     echo '<input type="text" name="title_font_link" value="' .$titleFontLink. '" placeholder="Google-Font Link-Tag" />';

}


//Analytics

function simplevent_google_analytics_ua() {

  $google_analytics_ua = get_option( 'google_analytics_ua' );

  echo '<input type="text" name="google_analytics_ua" value="' .$google_analytics_ua. '" placeholder="UA-xxxxxxxx-x"/>';

}

function simplevent_anonymize_ip() {

  $anonymize_ip = esc_attr( get_option( 'anonymize_ip' ) );

  if($anonymize_ip == 'on'){

    $anonymize_ip = 'checked';

  }

  echo '<input type="checkbox" name="anonymize_ip" ' .$anonymize_ip. '/>';

  echo 'anwählen um Besucher IP anonym zu halten (empfohlen)';

}


function simplevent_footer_snippets() {

     echo 'Snippets got placed directly over closing <b>body</b>-tag';

     $footer_snippets = get_option('footer_snippets');

     $fillerSnippets = array(
          'LinkedIn' => [
               'snippet' => '', 
               'active' => ''
          ], 
          'facebook' => [
               'snippet' => '', 
               'active' => ''
          ], 
     );
     if( is_array($footer_snippets) ){
          if( count($footer_snippets) < count($fillerSnippets) || array_diff_key( $fillerSnippets, $footer_snippets ) ){
               $footer_snippets = $fillerSnippets + $footer_snippets;
          } 
     }else {
          $footer_snippets = $fillerSnippets;
     } 
     

     foreach( $footer_snippets as $key => $snippet ){
          echo '<div style="display:flex; flex-wrap:wrap; justify-content: space-between; width:100%;">';
          echo '<p style="width:100% !important;"><b>'.$key.'</b></p>';
          if( isset($snippet['active']) ){
               if($snippet['active'] == 'on'){
                    $snippet['active'] = 'checked';
               }
          } else {
               $snippet['active'] = '';
          }
          echo '<input style="margin-top:5px; width:20px !important;" type="checkbox" name="footer_snippets['.$key.'][active]" ' .$snippet['active']. '/>';
          echo '<textarea style="margin: 5px 0 0px; width: calc( 100% - 25px ) !important;" type="textarea" rows="6" name="footer_snippets['.$key.'][snippet]"  style="width: 100%;">' . $footer_snippets[$key]['snippet'] . '</textarea>';
          echo '</div>';
     }
  
}


//Meta

function simplevent_meta_tags() {
     $tags = [
          'Keywords' => '',
          'SocialMedia' => [
               'Title' => '', 
               'Image' => '', 
               'URL' => '',
               'Description' => '',
          ]
     ];
     $meta_tags = is_array( get_option('meta_tags') ) ? get_option('meta_tags') : $tags;

     echo '<p style="margin-top:20px;"><b>Keywords</b></p>';
     echo '<p><i>Keywords</b>Mit Komma (,) trennen. (SEO, Keyword, ...)</i></p>';
     echo '<textarea type="textarea" rows="4" name="meta_tags[Keywords]"  style="width: 100%;">' . $meta_tags['Keywords'] . '</textarea>';

     echo '<p style="margin-top:20px;"><b>Title</b></p>';
     echo '<input type="text" name="meta_tags[SocialMedia][Title]" value="'.$meta_tags['SocialMedia']['Title'].'" placeholder="Title"/>';

     echo '<p style="margin-top:20px;"><b>Image</b></p>';
     echo '<div class="image-preview image-neg"><img src="'. $meta_tags['SocialMedia']['Image'].'" /></div>';
     echo '<input type="button" style="width:25%;" value="Image" class="button button-secondary upload-button" data-target="meta-tags-image"/><input type="" style="width:73%;" id="meta-tags-image" name="meta_tags[SocialMedia][Image]" value="' .$meta_tags['SocialMedia']['Image']. '"/>';

     echo '<p style="margin-top:20px;"><b>URL</b></p>';
     echo '<input type="text" name="meta_tags[SocialMedia][URL]" value="'.$meta_tags['SocialMedia']['URL'].'" placeholder="URL"/>';

     echo '<p style="margin-top:20px;"><b>Description</b></p>';
     echo '<textarea type="textarea" rows="4" name="meta_tags[SocialMedia][Description]"  style="width: 100%;">' . $meta_tags['SocialMedia']['Description'] . '</textarea>';


}


//----------------------------------HEADER ---------------------------------------//



function simplevent_se_anmeldung() {

  $seanmeldung = esc_attr( get_option( 'se_anmeldung' ) );

  if($seanmeldung == 'on'){

    $seanmeldung = 'checked';

  }

  echo '<input type="checkbox" name="se_anmeldung" ' .$seanmeldung. '/>';

}

function simplevent_se_anmeldetext() {

  $anmeldetext = get_option( 'se_anmeldetext' );

  echo '<input type="text" name="se_anmeldetext" value="' .$anmeldetext. '" placeholder="Jetzt Anmelden"/>';

}

function simplevent_se_anmeldelink() {

  $anmeldelink = get_option( 'se_anmeldelink' );

  echo '<input type="text" name="se_anmeldelink" value="' .$anmeldelink. '" placeholder="URL"/>';

}



//header style

function simplevent_se_header_mode() {
     $modesSaved = get_option( 'se_header_mode' );
     $modes= array('Light', 'Dark', 'Colorful');
     foreach($modes as $key => $mode){
          $check = ( isset($modesSaved[$key]) ) ? 'checked' : '';
          echo '<input type="checkbox" id="'.$mode.'" name="se_header_mode['.$key.']" value="'.$mode.'" '.$check.'>';
          echo '<label for="'.$mode.'">'.$mode.'</label><br>';
     }
}

function simplevent_se_header_logowidth() {

     $logowidth = get_option( 'se_header_logowidth' );
     echo '<div class="range-input">';
          echo '<label>Definierung der maximalen Breite des Logos im Header im Verhätniss zur Browserbreite. (Maximal 50%)</label><br />';
          echo '<input type="range" name="se_header_logowidth" value="' .$logowidth. '" min="5" max="50" onchange="changeVaule(event);" />';
          echo '<input type="number" name="se_header_logowidth" value="' .$logowidth. '" min="5" max="50" onchange="changeVaule(event);" />';
     echo '</div>';

}

//------- Language Menu
function simplevent_se_header_language_menu() {
     $selangmenu = esc_attr( get_option( 'se_header_language' ) );
     if($selangmenu == 'on'){
       $selangmenu = 'checked';
     }
     echo '<input type="checkbox" name="se_header_language" ' .$selangmenu. '/>';
}

function simplevent_se_header_mode_menu() {
     $seMode = esc_attr( get_option( 'se_header_mode_menu' ) );
     if($seMode == 'on'){
       $seMode = 'checked';
     }
     echo '<input type="checkbox" name="se_header_mode_menu" ' .$seMode. '/>';
}

//-------Slidervideo simplevent_se_videosliderbuttonlink

function simplevent_se_videoslider_activ() {

  $videoslider = get_option( 'se_videoslider_activ' );
  if($videoslider == 'on'){
    $videoslider = 'checked';
  }

  echo '<input type="checkbox" name="se_videoslider_activ" ' .$videoslider. '/>';

}

function simplevent_se_source() {
  $source = get_option( 'se_source' );
  echo '<input type="text" name="se_source" value="' .$source. '" placeholder="Source Link"/>';
}

function simplevent_se_videosliderbuttontext() {
  $videosliderbuttontext = get_option( 'se_videosliderbuttontext' );
  echo '<input type="text" name="se_videosliderbuttontext" value="' .$videosliderbuttontext. '" placeholder=""/>';
}

function simplevent_se_videosliderbuttonlink() {
  $videosliderbuttonlink = get_option( 'se_videosliderbuttonlink' );
  echo '<input type="text" name="se_videosliderbuttonlink" value="' .$videosliderbuttonlink. '" placeholder="https://..."/>';
}

//                                                     *******
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> CTA <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
//                                                     *******

function simplevent_se_cta_activ() {
     $se_cta_activ = esc_attr( get_option( 'se_cta_activ' ) );
     if($se_cta_activ == 'on'){
       $se_cta_activ = 'checked';
     }
     echo '<input type="checkbox" name="se_cta_activ" ' .$se_cta_activ. '/>';
}

function simplevent_se_cta() {
     $se_cta_std = [
          'icon'         => '',
          'buttontext'   => '',
          'buttoncolor'  => '#ffffff',
          'api'          => ''
     ];
     $se_cta_content = (get_option( 'se_cta' )) ? get_option('se_cta') : $se_cta_std;

     echo '<p><b>Icon</b></p>';
     echo '<div class="image-preview image-neg"><img src="'. $se_cta_content['icon'].'" /></div>';
     echo '<input type="button" style="width:25%;" value="Icon" class="button button-secondary upload-button" data-target="cta-icon"/><input type="" style="width:73%;" id="cta-icon" name="se_cta[icon]" value="' .$se_cta_content['icon']. '"/>';
     
     echo '<p style="margin-top:20px;"><b>Button Text</b></p>';
     echo '<input type="text" name="se_cta[buttontext]" value="' .$se_cta_content['buttontext']. '" placeholder="Button Text"/>';

     echo '<p style="margin-top:20px;"><b>Button-Color</b></p>';
     echo '<input class="se-color-picker" type="text" name="se_cta[buttoncolor]" value="' .$se_cta_content['buttoncolor']. '" data-default-color="'.$se_cta_std['buttoncolor'].'" />';

     echo '<p style="margin-top:20px;"><b>API URL</b></p>';
     echo '<input type="text" name="se_cta[api]" value="' .$se_cta_content['api']. '" placeholder="API URL"/>';
}



//----------------------------------FOOTER ---------------------------------------//



function simplevent_se_c_text() {
  $se_c_text = get_option( 'se_c_text' );
  echo '<input type="text" name="se_c_text" value="' .$se_c_text. '" placeholder="Swiss Economic Forum | 2017"/>';
}

function simplevent_se_contact_name() {
     $se_contact_name = get_option( 'se_contact_name' );
     echo '<input type="text" name="se_contact_name" value="' .$se_contact_name. '" placeholder="Name"/>';
}

function simplevent_se_contact_address() {
     $contact_address = get_option( 'se_contact_address' );
     echo '<textarea type="textarea" rows="3" name="se_contact_address"  style="width: 100%;">' . $contact_address . '</textarea>';
}

function simplevent_se_contact_phone() {
     $se_contact_phone = get_option( 'se_contact_phone' );
     echo '<input type="text" name="se_contact_phone" value="' .$se_contact_phone. '" placeholder="+00 000 00 00"/>';
}

function simplevent_se_contact_email() {
     $se_contact_email = get_option( 'se_contact_email' );
     echo '<input type="text" name="se_contact_email" value="' .$se_contact_email. '" placeholder="aaa@bb.c"/>';
}



function simplevent_se_footer_categories($args) {
     $categiories = get_option( 'se_footer_categories' );
     $partnerCategories = get_terms( array('taxonomy' => 'partner_categories') );
     foreach($partnerCategories as $key => $partnerCategory){
          $check = ( isset($categiories[$key]) ) ? 'checked' : '';
          echo '<input type="checkbox" id="'.$partnerCategory->term_id.'" name="se_footer_categories['.$key.']" value="'.$partnerCategory->term_id.'" '.$check.'>';
          echo '<label for="'.$partnerCategory->term_id.'">'.$partnerCategory->name.'</label><br>';
     }    
}





//----------------------------------EVENT ---------------------------------------//



function simplevent_facts_active() {
     $factsactiv = esc_attr( get_option( 'facts_active' ) );
     if($factsactiv == 'on'){
       $factsactiv = 'checked';
     }

     echo '<input type="checkbox" name="facts_active" ' . $factsactiv . '/>';
}

   

function simplevent_facts_date() {
     $facts_date = get_option( 'facts_date' );
     $EventDate = ['from' => false, 'to' => false ];
     $dates =  ( !is_array($facts_date) ) ? $EventDate : $facts_date;
     foreach($dates as $key => $date ){
          echo '<p>'.$key.'</p>';
          echo '<input class="se-datepicker" type="text" name="facts_date['.$key.']" value="' .$date. '"  />';
     }
}



function simplevent_facts_location() {

     $facts_location = get_option( 'facts_location' );
     $facts_location = ( !is_array($facts_location) ) ? array('google' => '', 'location' => '', 'adress' => '', 'vue' => '') : $facts_location;
     foreach( $facts_location as $key => $des ){
          echo '<p>'.$key.'</p>';
          echo '<input type="text" name="facts_location['.$key.']" value="' .$facts_location[$key]. '" placeholder="'.$key.'" />';
     }
}



function simplevent_facts_participants(){
     $facts_participants = get_option( 'facts_participants' );
     echo '<textarea type="textarea" rows="10" name="facts_participants"  style="width: 100%;">' . $facts_participants . '</textarea>';
}



function simplevent_facts_languages(){

     $facts_languages = get_option('facts_languages');

     $languages = [ 
          'de' => __('Deutsch', 'SimplEvent'), 
          'en' => __('Englisch', 'SimplEvent'), 
          'it' => __('Italienisch', 'SimplEvent'), 
          'fr' => __('Französisch', 'SimplEvent')
     ];

     $facts_languages = ( !is_array($facts_languages) ) ? array( 'main' => 'fr', 'translation' => 'en' ) : $facts_languages;

     echo '<div style="width: calc(100% + 60px)">';

          //mainlanguage
          echo '<div style="width:48%;float:left;"><p><b>Main Language</b></p>';
          echo '<select name="facts_languages[main]" >';

          foreach( $languages as $key => $lang ){
               $select = ( $key === $facts_languages['main'] ) ? 'selected' : '';
               echo '<option value="'.$key.'" '.$select.'>'.$lang.'</option>';
          }

          echo '</select>';
          echo '</div>';

          //translation
          echo '<div style="width:48%;float:right;"><p><b>Translations</b></p>';
          foreach( $languages as $key => $lang ){
               $check = ( isset($facts_languages['translation'][$key]) ) ? 'checked' : '';
               echo '<input type="checkbox" id="translation_'.$key.'" name="facts_languages[translation]['.$key.']" value="'.$key.'" '.$check.'>';
               echo '<label for="translation_'.$key.'">'.$lang.'</label><br>';
          }
          echo '</div>';

     echo '</div>';

}



function simplevent_facts_pricing(){

     $facts_pricing = get_option('facts_pricing');

     $fillerPricing = array(
          ['group' => '', 'price' => '', 'benefits' => ''], 
          ['group' => '', 'price' => '', 'benefits' => ''], 
          ['group' => '', 'price' => '', 'benefits' => ''] 
     );

     $facts_pricing = ( !is_array($facts_pricing) ) ? $fillerPricing : $facts_pricing;

     foreach( $facts_pricing as $key => $grp ){
          echo '<div style="display:flex; flex-wrap:wrap; justify-content: space-between; width:100%;">';
          echo '<input style="width:50%;" type="text" name="facts_pricing['.$key.'][group]" value="' .$facts_pricing[$key]['group']. '" placeholder="Tagungsticket" />';
          echo '<input style="width:30%;" type="number" name="facts_pricing['.$key.'][price]" value="' .$facts_pricing[$key]['price']. '" placeholder="100" />';
          echo '<textarea style="margin: 5px 0 15px; width: 100% !important;" type="textarea" rows="4" name="facts_pricing['.$key.'][benefits]"  style="width: 100%;">' . $facts_pricing[$key]['benefits'] . '</textarea>';
          echo '</div>';
     }

}



//SESSIONS

function simplevent_sessions_active(){

     $sessions_active = get_option('sessions_active');
     if($sessions_active == 'on'){
          $sessions_active = 'checked';
     }
     echo '<input type="checkbox" name="sessions_active" ' . $sessions_active . '/>';

}



function simplevent_sessions_slots(){

     $sessions_slots = get_option('sessions_slots');

     $sessionSlotBase = [
               'label' => '',
               'value' => '',
               'date'  => false,
               'start' => '',
               'ende'  => ''
          ];

     $sessions_slots = ( !is_array( $sessions_slots ) ) ? $sessionSlotBase : $sessions_slots;


     echo '<div class="Session_Slots">';

          for ($i=0; $i < 4; $i++) { 

               $sessions_slots[$i] = ( !is_array( $sessions_slots ) ) ? $sessionSlotBase : $sessions_slots[$i]; 

               echo '<div style="margin-bottom:20px; border-top:3px lightgrey solid;"><p style="width:100%;">Session Slot '.($i+1).'</p>';
               echo '<input style="width:20%;" type="text" name="sessions_slots['.$i.'][label]" value="' .$sessions_slots[$i]['label']. '" placeholder="label"/>';
               echo '<input style="width:70%;" type="text" name="sessions_slots['.$i.'][value]" value="' .$sessions_slots[$i]['value']. '" placeholder="value"/>';
               
               echo '<input style="width:40%;" class="se-datepicker " type="text" name="sessions_slots['.$i.'][date]" value="' .$sessions_slots[$i]['date']. '"  />';
               echo '<input style="width:20%;" type="number" name="sessions_slots['.$i.'][start]" value="' .$sessions_slots[$i]['start']. '" placeholder="1430" />';
               echo ' -';
               echo '<input style="width:20%;" type="number" name="sessions_slots['.$i.'][ende]" value="' .$sessions_slots[$i]['ende']. '" placeholder="1530" />';

               echo '</div>';

          }    

     echo '</div>';

}

 

//Award simplevent_award_categories  simplevent_award_active

function simplevent_award_active(){

     $award_active = get_option('award_active');

     if($award_active == 'on'){

          $award_active = 'checked';

     }

     echo '<input type="checkbox" name="award_active" ' . $award_active . '/>';

}

function simplevent_awards(){

     $awards = get_option('awards');

     $awardsBase = [
               'label' => '',
               'value' => ''
          ];

     $awards = ( !is_array( $awards ) ) ? $awardsBase : $awards;
    
     echo '<div class="Session_Slots">';
          for ($i=0; $i < 3; $i++) { 

               $awards[$i] = ( !is_array( $awards ) ) ? $awardsBase : $awards[$i]; 

               echo '<div style="width:100%;">';
                    echo '<input style="width:20%;" type="text" name="awards['.$i.'][label]" value="' .$awards[$i]['label']. '" placeholder="label"/>';
                    echo '<input style="width:50%;" type="text" name="awards['.$i.'][value]" value="' .$awards[$i]['value']. '" placeholder="value"/>';
               echo '</div>';
          }    

     echo '</div>';

}

function simplevent_award_categories(){

     $award_categories = get_option('award_categories');

     $awardKategorieBase = [
               'label' => '',
               'value' => ''
          ];

     $award_categories = ( !is_array( $award_categories ) ) ? $awardKategorieBase : $award_categories;

     for ($in=1; $in < (count( get_option('awards') )+1); $in++) { 
          $ind = $in -1;
          if( empty(get_option('awards')[$ind]['value']) ){ continue; }
          echo '<div class="Session_Slots">';
          echo '<h4>'. get_option('awards')[$ind]['value'] .'</h4>';

          for ($i=($in * 3); $i < ($in * 3 + 3); $i++) { 
               $award_categories[$i] = ( !is_array( $award_categories ) ) ? $awardKategorieBase : $award_categories[$i]; 

               echo '<div style="width:100%;">';
               echo '<input style="width:20%;" type="text" name="award_categories['.$i.'][label]" value="' .$award_categories[$i]['label']. '" placeholder="label"/>';
               echo '<input style="width:50%;" type="text" name="award_categories['.$i.'][value]" value="' .$award_categories[$i]['value']. '" placeholder="value"/>';
               echo '</div>';
          }    

          echo '</div>';
          
     }

}





//----------------------------------LIVE ---------------------------------------//



function simplevent_se_livestream() {

  $livestream = esc_attr( get_option( 'se_livestream' ) );

  if($livestream == 'on'){

    $livestream = 'checked';

  }

  echo '<input type="checkbox" name="se_livestream" ' . $livestream . '/>';

}



function simplevent_se_iframe() {

  $iframe = get_option( 'se_iframe' );

  echo '<textarea type="textarea" rows="10" name="se_iframe"  style="width: 100%;">' . $iframe . '</textarea>';

}



function simplevent_se_programm() {

  $se_programm = get_option( 'se_programm' );

  echo '<input type="text" name="se_programm" value="' .$se_programm. '" placeholder="/programm"/>';

}





//----------------------------------Settings ---------------------------------------//

function simplevent_post_visibility($args) {

     $vibilityArray = get_option( 'post_visibility' );

     $roles = [

          'grafik' => 'Grafik',

          'kommunikation' => 'Kommunikation', 

          'projektleiter' => 'Projektleiter',

          'hoti' => 'HOTI'

     ];

     $capas = [

          'companies' => 'Companies',

          'partners' => 'Partners',

          'people' => 'People',

          'events' => 'Events',

          'speakers' => 'Speaker',

          'sessions' => 'sessions'

     ];



     foreach($roles as $k => $role ){

          $currentRole = current_user_can($k) ? 'se2-current-user-role' : '';

          echo '<div class="se2-setting-rows '.$currentRole.'">';

          echo '<b>'.$role.'</b>';

          foreach($capas as $val => $capa ){

               $checked = ( isset($vibilityArray[$k][$val]) ) ? 'checked' : '';

               echo '<div style="width:100%;margin-top:10px;">';

               echo '<input type="checkbox" id="'.$val.'" name="post_visibility['.$k.']['.$val.']" value="'.$val.'" '.$checked.'>';

               echo '<label for="'.$val.'">'.$capa.'</label><br>';

               echo '</div>';

          }

          if($currentRole){

               echo '<p style="margin-top:10px; font-size:.8em; opacity:.6;"><i ><b>Ansicht deiner Rolle</b><br />Respektiere die der anderen!</i><p>';

          }

          

          echo '</div>';

     }

}





//---------------------------------------------TEMPLATES------------------------------------//

function simplevent_theme_create_page() {

  require_once( get_template_directory() . '/theme/templates/simplevent-admin.php' );

}



function simplevent_theme_header_page(){

  require_once( get_template_directory() . '/theme/templates/simplevent-header.php' );

}



function simplevent_theme_footer_page(){

     require_once( get_template_directory() . '/theme/templates/simplevent-footer.php' );

}



function simplevent_theme_event_page(){

     require_once( get_template_directory() . '/theme/templates/simplevent-event.php' );

}



function simplevent_theme_live_page(){

  require_once( get_template_directory() . '/theme/templates/simplevent-live.php' );

}



function simplevent_theme_settings_page(){

     require_once( get_template_directory() . '/theme/templates/simplevent-settings.php' );

}


