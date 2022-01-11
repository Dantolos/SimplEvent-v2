<?php

class se2_page_Footer extends se2_page_builder {



     public function build_settings(){
          
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

          // Section Functions
          function simplevent_footer_options() {
               echo '';
          }
          
          function simplevent_footer_contact() {
               echo 'Kontakt Informationen';
          }
          
          function simplevent_footer_partner() {
               echo 'Mainpartner Kategorie auswählen, welche im Footer erscheinen sollen.';
          }

          // Call Template File
          function simplevent_theme_footer_page(){
               require_once( get_template_directory() . '/theme/templates/simplevent-footer.php' );
          }
          
             
          $this->build_fields();
          
     }
     
     public function build_fields(){


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
             
             

     }

     

}
