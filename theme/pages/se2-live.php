<?php

class se2_page_Live extends se2_page_builder {



     public function build_settings(){
          
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

          // Section Functions
          function simplevent_live_options() {
               echo 'Livestream De/aktivieren';
          }

          // Call Template File
          function simplevent_theme_live_page(){
               require_once( get_template_directory() . '/theme/templates/simplevent-live.php' );
          }          

          $this->build_fields();
          
     }
     
     public function build_fields(){
          
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

     }

     

}
