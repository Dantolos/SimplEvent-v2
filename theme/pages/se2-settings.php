<?php

class se2_page_Settings {

     public function build_settings(){
          
          //****Settings
          register_setting( 'simplevent-settingspage-group', 'post_visibility' );

          //****Section
          add_settings_section( 'simplevent-capabilities-options', 'Capabilities', 'simplevent_settings_options', 'simplevent_settings');

          //****Fields
          add_settings_field( 'se-post_visibility', 'Post Visibility', 'simplevent_post_visibility', 'simplevent_settings', 'simplevent-capabilities-options', array( 'class' => 'full-width' ) );

          // Section Functions
          function simplevent_settings_options() {
               echo 'Verteilung der Berechtigungen';
          }

          // Call Template File
          function simplevent_theme_settings_page(){
               require_once( get_template_directory() . '/theme/templates/simplevent-settings.php' );
          }

          $this->build_fields();
     }
     
     public function build_fields(){
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
     }



}
