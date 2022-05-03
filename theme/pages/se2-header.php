<?php

class se2_page_Header  {

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
               $se_cta_std = array();
               $se_cta_content = (get_option( 'se_cta' )) ? get_option('se_cta') : $se_cta_std;

         
               // CTA Posts
               // Generatet as Features posttype with Template "Call to Action" chooced
               $cta_posts = get_posts( array(
                    'post_type' => 'features',
                    'meta_key' => '_wp_page_template',
                    'hierarchical' => 0,
                    'meta_value' => 'Templates/features-cta.php'
               ));
                  
               echo '<p style="margin-top:20px;"><b>Posts</b><br>Generatet as Features-Post with "Call to Action" as Template selected.</p>';
               
               if($cta_posts){
                    foreach($cta_posts as $key => $cta_post){
                         $check = ( isset($se_cta_content[$cta_post->ID]) ) ? 'checked' : '';
                         echo '<input type="checkbox" id="'.$cta_post->ID.'" name="se_cta['.$cta_post->ID.']" value="'.$cta_post->ID.'" '.$check.'>';
                         echo '<label for="'.$cta_post->ID.'">'.$cta_post->post_title.'</label><br>';
                    }  
               }
          }
          
     }

}
