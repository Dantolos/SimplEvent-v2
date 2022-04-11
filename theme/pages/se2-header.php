<?php

class se2_page_Header extends se2_page_builder {

     public function build_settings(){
          
          //****Settings

          register_setting( 'simplevent-header-group', 'se_anmeldung' );
          register_setting( 'simplevent-header-group', 'se_anmeldelink' );
          register_setting( 'simplevent-header-group', 'se_anmeldetext' );

          register_setting( 'simplevent-header-group', 'se_header_mode' );
          register_setting( 'simplevent-header-group', 'se_header_logowidth' );
          register_setting( 'simplevent-header-group', 'se_header_homepage' );
          register_setting( 'simplevent-header-group', 'se_header_video' );

          register_setting( 'simplevent-header-group', 'se_header_language' );
          register_setting( 'simplevent-header-group', 'se_header_mode_menu' );

          register_setting( 'simplevent-header-group', 'se_cta_activ' );
          register_setting( 'simplevent-header-group', 'se_cta' );


          //****Section

          add_settings_section( 'simplevent-header-options', 'Header', 'simplevent_header_options', 'simplevent_header');
          add_settings_section( 'simplevent-header-style', 'Header Style', 'simplevent_header_style', 'simplevent_header');
          add_settings_section( 'simplevent-header-language', 'Header Language Menu', 'simplevent_header_language', 'simplevent_header');
          add_settings_section( 'simplevent-cta', 'Call to Action', 'simplevent_cta', 'simplevent_header');


          //****Fields

          add_settings_field( 'se-anmeldung', 'Anmeldung Aktiv', 'simplevent_se_anmeldung', 'simplevent_header', 'simplevent-header-options' );
          add_settings_field( 'se-anmeldelink', 'Anmeldung Link', 'simplevent_se_anmeldelink', 'simplevent_header', 'simplevent-header-options' );
          add_settings_field( 'se-anmeldetext', 'Anmeldung Text', 'simplevent_se_anmeldetext', 'simplevent_header', 'simplevent-header-options' );

          add_settings_field( 'se-header-mode', 'Header Style Mode', 'simplevent_se_header_mode', 'simplevent_header', 'simplevent-header-style' );
          add_settings_field( 'se-header-logowidth', 'Logo Width', 'simplevent_se_header_logowidth', 'simplevent_header', 'simplevent-header-style' );
          add_settings_field( 'se-header-homepage', 'Homepage Style', 'simplevent_se_header_homepage', 'simplevent_header', 'simplevent-header-style' );
          add_settings_field( 'se-header-video', 'Homepage Style', 'simplevent_se_header_video', 'simplevent_header', 'simplevent-header-style', array( 'class' => 'full-width' ) );

          add_settings_field( 'se-header-language-menu', 'Show Language Menu', 'simplevent_se_header_language_menu', 'simplevent_header', 'simplevent-header-language' );
          add_settings_field( 'se-header-mode-menu', 'Show Mode', 'simplevent_se_header_mode_menu', 'simplevent_header', 'simplevent-header-language' );

          add_settings_field( 'se-cta_activ', 'Call to Action aktivieren', 'simplevent_se_cta_activ', 'simplevent_header', 'simplevent-cta' );
          add_settings_field( 'se-cta', 'CTA Content', 'simplevent_se_cta', 'simplevent_header', 'simplevent-cta' );

          // Section Functions
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

          $this->build_fields();
          
          // Call Template File
          function simplevent_theme_header_page(){
               require_once( get_template_directory() . '/theme/templates/simplevent-header.php' );
          }

     }

     public function build_fields(){

          // GENERAL
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
          
                 
          // HEADER STYLE
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
          
          function simplevent_se_header_homepage() {
               $headerHomegape = get_option( 'se_header_homepage' );
               $check = ( isset($headerHomegape) ) ? 'checked' : '';
               echo '<input type="checkbox" id="'.$headerHomegape.'" name="se_header_homepage" value="'.$headerHomegape.'" '.$check.'>';
          }

          function simplevent_se_header_video(){

               echo '<div class="se2_trennlinie" style="border-top:solid 1px #808080; width:100%; padding-top: 20px;">';
               $se_header_video_std = [
                    'activ'     => '',
                    'negativ'   => '',      
               ];
               $se_header_video_settings = (get_option( 'se_header_video' )) ? get_option('se_header_video') : $se_header_video_std;

               if($se_header_video_settings['activ'] == 'on'){
                    $se_header_video_settings['activ'] = 'checked';
               }
               echo '<p><b>Header transparent</b></p>';
               echo '<input type="checkbox" name="se_header_video[activ]" ' .$se_header_video_settings['activ']. '/>';

               if($se_header_video_settings['negativ'] == 'on'){
                    $se_header_video_settings['negativ'] = 'checked';
               } 
               echo '<p><b>Negativer Content</b></p>';
               echo '<i>Bei dunklem Hintergrund</i><br />';
               echo '<input type="checkbox" name="se_header_video[negativ]" ' .$se_header_video_settings['negativ']. '/>';

          }
          

          // LANGUAGE MENU
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

          
          // CALL TO ACTION
          // Button & Lightbox
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
                    'type'         => 'link',
                    'api'          => '',
                    
               ]; 
               $se_cta_content = (get_option( 'se_cta' )) ? get_option('se_cta') : $se_cta_std;

               echo '<p><b>Icon</b></p>';
               echo '<div class="image-preview image-neg"><img src="'. $se_cta_content['icon'].'" /></div>';
               echo '<input type="button" style="width:25%;" value="Icon" class="button button-secondary upload-button" data-target="cta-icon"/><input type="" style="width:73%;" id="cta-icon" name="se_cta[icon]" value="' .$se_cta_content['icon']. '"/>';
               
               echo '<p style="margin-top:20px;"><b>Button Text</b></p>';
               echo '<input type="text" name="se_cta[buttontext]" value="' .$se_cta_content['buttontext']. '" placeholder="Button Text"/>';

               echo '<p style="margin-top:20px;"><b>Button-Color</b></p>';
               echo '<input class="se-color-picker" type="text" name="se_cta[buttoncolor]" value="' .$se_cta_content['buttoncolor']. '" data-default-color="'.$se_cta_std['buttoncolor'].'" />';

               $cta_types = array(
                    'link'    => 'Link',
                    'api'     => 'API',
                    'post'    => 'Post',
               );
               
               echo '<p style="margin-top:20px;"><b>Type</b></p>';
               
               echo '<select name="se_cta[type]" style="width:100%;" id="se_cta">';
               foreach( $cta_types as $cta_type_value => $cta_type ){
                    $selected ='';
                    ;
                    
                    if( isset(get_option( 'se_cta' )['type']) ){
                         $selected = (get_option( 'se_cta' )['type'] == $cta_type_value ) ? 'selected' : '';
                    }
                    echo '<option value="'.$cta_type_value.'" '.$selected.'>'.$cta_type.'</option>';
               }
               echo '</select>';

               echo '<p style="margin-top:20px;"><b>API URL</b></p>';
               echo '<input type="text" name="se_cta[api]" value="' .$se_cta_content['api']. '" placeholder="API URL"/>';

               
          }
          
     }

}
