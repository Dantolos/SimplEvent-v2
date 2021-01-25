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
  add_menu_page( 'SimplEvent Theme Options', 'SimplEvent', 'manage_options', 'aagi_simplevent', 'simplevent_theme_create_page', get_template_directory_uri() . '/theme/simplevent-icon.svg', 110 );

  //Generate SimplEvent Sub Pages
  add_submenu_page( 'aagi_simplevent', 'SimplEvent Theme Options', 'General', 'manage_options', 'aagi_simplevent', 'simplevent_theme_create_page' );
  add_submenu_page( 'aagi_simplevent', 'SimplEvent Header Options', 'Header', 'manage_options', 'simplevent_header', 'simplevent_theme_header_page' );
  add_submenu_page( 'aagi_simplevent', 'SimplEvent Footer Options', 'Footer', 'manage_options', 'simplevent_footer', 'simplevent_theme_footer_page' );
  add_submenu_page( 'aagi_simplevent', 'SimplEvent Live Options', 'Live', 'manage_options', 'simplevent_live', 'simplevent_theme_live_page' );

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

  register_setting( 'simplevent-settings-group', 'twitter_link' );
  register_setting( 'simplevent-settings-group', 'youtube_link' );
  register_setting( 'simplevent-settings-group', 'facebook_link' );
  register_setting( 'simplevent-settings-group', 'linkedin_link' );
  register_setting( 'simplevent-settings-group', 'insta_link' );

  register_setting( 'simplevent-settings-group', 'primary_color_picker' );
  register_setting( 'simplevent-settings-group', 'secondary_color_picker' );
  register_setting( 'simplevent-settings-group', 'light_color_picker' );

  register_setting( 'simplevent-settings-group', 'bg_img' );

  //****SECTIONS
  add_settings_section( 'simplevent-general-options', 'General Options', 'simplevent_general_options', 'aagi_simplevent');
  add_settings_section( 'simplevent-color-options', 'Colors', 'simplevent_color_options', 'aagi_simplevent');
  add_settings_section( 'simplevent-bg', 'Background', 'simplevent_bg', 'aagi_simplevent');


  //****fields
  add_settings_field( 'event_logo', 'Logo', 'simplevent_event_logo', 'aagi_simplevent', 'simplevent-general-options' );
  add_settings_field( 'event_logo_neg', 'Logo Negativ', 'simplevent_event_logo_neg', 'aagi_simplevent', 'simplevent-general-options' );
  add_settings_field( 'event_icon', 'Icon', 'simplevent_event_icon', 'aagi_simplevent', 'simplevent-general-options' );

  add_settings_field( 'twitter-link', 'Twitter', 'simplevent_twitter_link', 'aagi_simplevent', 'simplevent-general-options' );
  add_settings_field( 'youtube-link', 'Youtube', 'simplevent_youtube_link', 'aagi_simplevent', 'simplevent-general-options' );
  add_settings_field( 'facebook-link', 'Facebook', 'simplevent_facebook_link', 'aagi_simplevent', 'simplevent-general-options' );
  add_settings_field( 'linkedin-link', 'LinkedIn', 'simplevent_linkedin_link', 'aagi_simplevent', 'simplevent-general-options' );
  add_settings_field( 'insta-link', 'Instagramm', 'simplevent_insta_link', 'aagi_simplevent', 'simplevent-general-options' );

  add_settings_field( 'primary-color-picker', 'Primary Color', 'simplevent_primary_color_picker', 'aagi_simplevent', 'simplevent-color-options' );
  add_settings_field( 'secondary-color-picker', 'Secondary Color', 'simplevent_secondary_color_picker', 'aagi_simplevent', 'simplevent-color-options' );
  add_settings_field( 'light-color-picker', 'Light Color', 'simplevent_light_color_picker', 'aagi_simplevent', 'simplevent-color-options' );

  add_settings_field( 'background-image', 'Hintergrundbild', 'simplevent_bg_img', 'aagi_simplevent', 'simplevent-bg' );


  //----------------------------------Header ---------------------------------------//
  //****Settings
  register_setting( 'simplevent-header-group', 'se_anmeldung' );
  register_setting( 'simplevent-header-group', 'se_anmeldelink' );
  register_setting( 'simplevent-header-group', 'se_anmeldetext' );

  register_setting( 'simplevent-header-group', 'se_attention' );
  register_setting( 'simplevent-header-group', 'se_attentionbuttontext' );
  register_setting( 'simplevent-header-group', 'se_attentiontitle' );
  register_setting( 'simplevent-header-group', 'se_attentiontext' );
  register_setting( 'simplevent-header-group', 'se_attentiondownload' );

  register_setting( 'simplevent-header-group', 'se_videoslider_activ' );
  register_setting( 'simplevent-header-group', 'se_source' );
  register_setting( 'simplevent-header-group', 'se_videosliderbuttontext' );
  register_setting( 'simplevent-header-group', 'se_videosliderbuttonlink' );

  //****Section
  add_settings_section( 'simplevent-header-options', 'Header', 'simplevent_header_options', 'simplevent_header');
  add_settings_section( 'simplevent-videoslider', 'Video Slider', 'simplevent_videoslider', 'simplevent_header');

  //****Fields
  add_settings_field( 'se-anmeldung', 'Anmeldung Aktiv', 'simplevent_se_anmeldung', 'simplevent_header', 'simplevent-header-options' );
  add_settings_field( 'se-anmeldelink', 'Anmeldung Link', 'simplevent_se_anmeldelink', 'simplevent_header', 'simplevent-header-options' );
  add_settings_field( 'se-anmeldetext', 'Anmeldung Text', 'simplevent_se_anmeldetext', 'simplevent_header', 'simplevent-header-options' );

  add_settings_field( 'se-attention', 'Attention Aktiv', 'simplevent_se_attention', 'simplevent_header', 'simplevent-header-options' );
  add_settings_field( 'se-attentionbuttontext', 'Attention Buttontext', 'simplevent_se_attentionbuttontext', 'simplevent_header', 'simplevent-header-options' );
  add_settings_field( 'se-attentiontitle', 'Attention Title', 'simplevent_se_attentiontitle', 'simplevent_header', 'simplevent-header-options' );
  add_settings_field( 'se-attentiontext', 'Attention Text', 'simplevent_se_attentiontext', 'simplevent_header', 'simplevent-header-options' );
  add_settings_field( 'se-attentiondownload', 'Attention Download', 'simplevent_se_attentiondownload', 'simplevent_header', 'simplevent-header-options' );

  add_settings_field( 'se-videoslider_activ', 'Activate', 'simplevent_se_videoslider_activ', 'simplevent_header', 'simplevent-videoslider' );
  add_settings_field( 'se-source', 'Attention Text', 'simplevent_se_source', 'simplevent_header', 'simplevent-videoslider' );
  add_settings_field( 'se-videosliderbuttontext', 'Button Text', 'simplevent_se_videosliderbuttontext', 'simplevent_header', 'simplevent-videoslider' );
  add_settings_field( 'se-videosliderbuttonlink', 'Button Link', 'simplevent_se_videosliderbuttonlink', 'simplevent_header', 'simplevent-videoslider' );


  //----------------------------------FOOTER ---------------------------------------//
  //****Settings
  register_setting( 'simplevent-footer-group', 'se_c_text' );

  register_setting( 'simplevent-footer-group', 'se_contact_name' );
  register_setting( 'simplevent-footer-group', 'se_contact_address' );
  register_setting( 'simplevent-footer-group', 'se_contact_phone' );
  register_setting( 'simplevent-footer-group', 'se_contact_email' );
  

  //****Section
  add_settings_section( 'simplevent-footer-options', 'Footer', 'simplevent_footer_options', 'simplevent_footer');
  add_settings_section( 'simplevent-footer-contact', 'Contact', 'simplevent_footer_contact', 'simplevent_footer');


  //****Fields
  add_settings_field( 'ctext', 'Copyright Text', 'simplevent_se_c_text', 'simplevent_footer', 'simplevent-footer-options' );

  add_settings_field( 'contact-name', 'Name', 'simplevent_se_contact_name', 'simplevent_footer', 'simplevent-footer-contact' );
  add_settings_field( 'contact-address', 'Adresse', 'simplevent_se_contact_address', 'simplevent_footer', 'simplevent-footer-contact' );
  add_settings_field( 'contact-phone', 'Telefon Nummer', 'simplevent_se_contact_phone', 'simplevent_footer', 'simplevent-footer-contact' );
  add_settings_field( 'contact-email', 'E-Mail', 'simplevent_se_contact_email', 'simplevent_footer', 'simplevent-footer-contact' );

  //----------------------------------Live ---------------------------------------//

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


}

function simplevent_general_options() {
  echo 'Allgemeine Anpassungen | Logo – Social Media';
}
function simplevent_color_options() {
  echo 'Farben anpassen';
}
function simplevent_bg() {
  echo 'Das Hindergrundbild wechseln';
}

function simplevent_header_options() {
  echo '';
}

function simplevent_videoslider() {
  echo '';
}

function simplevent_footer_options() {
  echo '';
}

function simplevent_footer_contact() {
     echo 'Kontakt Informationen';
}

function simplevent_live_options() {
  echo 'Livestream De/aktivieren';
}


//---------------------------------------------OUTPUTS------------------------------------//

//----------------------------------GENERAL ---------------------------------------//
//social media
function simplevent_event_logo() {
  $logo = esc_attr( get_option( 'event_logo' ) );
  echo '<input type="button" style="width:25%;" value="Logo" class="button button-secondary upload-button" data-target="event-logo"/><input type="" style="width:73%;" id="event-logo" name="event_logo" value="' .$logo. '"/>';
}
function simplevent_event_logo_neg() {
     $logoNeg = esc_attr( get_option( 'event_logo_neg' ) );
     echo '<input type="button" style="width:25%;" value="Logo Negativ" class="button button-secondary upload-button" data-target="event-logo-neg"/><input type="" style="width:73%;" id="event-logo-neg" name="event_logo_neg" value="' .$logoNeg. '"/>';
   }
function simplevent_event_icon() {
  $icon = esc_attr( get_option( 'event_icon' ) );
  echo '<input type="button" style="width:25%;" value="Icon" class="button button-secondary upload-button" data-target="event-icon"/><input type="" style="width:73%;" id="event-icon" name="event_icon" value="' .$icon. '"/>';
}
function simplevent_twitter_link() {
  $twitter = esc_attr( get_option( 'twitter_link' ) );
  echo '<input type="text" name="twitter_link" value="' .$twitter. '" placeholder="URL" />';
}
function simplevent_youtube_link() {
  $youtube = esc_attr( get_option( 'youtube_link' ) );
  echo '<input type="text" name="youtube_link" value="' .$youtube. '" placeholder="URL" />';
}
function simplevent_facebook_link() {
  $facebook = esc_attr( get_option( 'facebook_link' ) );
  echo '<input type="text" name="facebook_link" value="' .$facebook. '" placeholder="URL" />';
}
function simplevent_linkedin_link() {
  $linkedin = esc_attr( get_option( 'linkedin_link' ) );
  echo '<input type="text" name="linkedin_link" value="' .$linkedin. '" placeholder="URL" />';
}
function simplevent_insta_link() {
  $insta = esc_attr( get_option( 'insta_link' ) );
  echo '<input type="text" name="insta_link" value="' .$insta. '" placeholder="URL" />';
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
function simplevent_light_color_picker() {
  $lightcolor = get_option( 'light_color_picker' );
  echo '<input class="se-color-picker" type="text" name="light_color_picker" value="' .$lightcolor. '" data-default-color="#dedede" />';
}

//BG
function simplevent_bg_img() {
  $bg = esc_attr( get_option( 'bg_img' ) );
  echo '<input type="button" style="width:25%;" value="Bg" class="button button-secondary upload-button" data-target="bg-img"/><input type="" style="width:73%;" id="bg-img" name="bg_img" value="' .$bg. '"/>';
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
//--------Attention
function simplevent_se_attention() {
  $attention = get_option( 'se_attention' );
  if($attention == 'on'){
    $attention = 'checked';
  }
  echo '<input type="checkbox" name="se_attention" ' .$attention. '/>';
}
function simplevent_se_attentionbuttontext() {
  $attentionbuttontext = get_option( 'se_attentionbuttontext' );
  echo '<input type="text" name="se_attentionbuttontext" value="' .$attentionbuttontext. '" placeholder="Buttontext"/>';
}
function simplevent_se_attentiontitle() {
  $attentiontitle = get_option( 'se_attentiontitle' );
  echo '<input type="text" name="se_attentiontitle" value="' .$attentiontitle. '" placeholder="Titel"/>';
}
function simplevent_se_attentiontext() {
  $attentiontext = get_option( 'se_attentiontext' );
  echo '<textarea type="textarea" rows="10" name="se_attentiontext"  style="width: 100%;">' . $attentiontext . '</textarea>';
}
function simplevent_se_attentiondownload() {
  $attentiondownload = esc_attr( get_option( 'se_attentiondownload' ) );
  echo '<input type="button" style="width:25%;" value="Download" class="button button-secondary upload-button" data-target="se-attentiondownload"/><input type="" style="width:73%;" id="se-attentiondownload" name="se_attentiondownload" value="' .$attentiondownload. '"/>';
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
     echo '<textarea type="textarea" rows="2" name="se_contact_address"  style="width: 100%;">' . $contact_address . '</textarea>';
}
function simplevent_se_contact_phone() {
     $se_contact_phone = get_option( 'se_contact_phone' );
     echo '<input type="text" name="se_contact_phone" value="' .$se_contact_phone. '" placeholder="+00 000 00 00"/>';
}
function simplevent_se_contact_email() {
     $se_contact_email = get_option( 'se_contact_email' );
     echo '<input type="text" name="se_contact_email" value="' .$se_contact_email. '" placeholder="aaa@bb.c"/>';
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

function simplevent_theme_live_page(){
  require_once( get_template_directory() . '/theme/templates/simplevent-live.php' );
}
