<?php

class se2_page_General extends se2_page_builder {

     public function build_settings(){
          

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

          // Section Functions
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
          
          // Call Template File
          function simplevent_theme_create_page() {
               require_once( get_template_directory() . '/theme/templates/simplevent-admin.php' );
          }

          $this->build_fields();
     }

     public function build_fields(){
          

          // LOGOS & ICONS (Favicon)
          function simplevent_event_logo() {
               $logo = esc_attr( get_option( 'event_logo' ) );
               echo se2_page_builder::input_images( 'Logo', 'event-logo', 'event_logo', $logo );    
          }
          
          function simplevent_event_logo_neg() {
               $logoNeg = esc_attr( get_option( 'event_logo_neg' ) );
               echo se2_page_builder::input_images( 'Logo Negativ', 'event-logo-neg', 'event_logo_neg', $logoNeg, true );
          }
          
          function simplevent_event_icon() {
               $icon = esc_attr( get_option( 'event_icon' ) );
               echo se2_page_builder::input_images( 'Icon', 'event-icon', 'event_icon', $icon );
          }
          
          function simplevent_event_icon_neg() {
               $iconNeg = esc_attr( get_option( 'event_icon_neg' ) );
               echo se2_page_builder::input_images( 'Icon Negativ', 'event-icon-neg', 'event_icon_neg', $iconNeg );
          }
          
          
          // SOCIAL MEDIA
          function simplevent_social_media() {
               $socialMediaSTD = [
                    'linkedin' => '',
                    'insta'    => '',
                    'twitter'  => '',
                    'facebook' => '',
                    'youtube'  => '',
               ];
               $socialMedia = (get_option( 'social_media' ) ) ? get_option( 'social_media' ) : $socialMediaSTD;
          
               echo '<p style="margin-top:20px;"><b>Linked In</b></p>';
               echo '<input type="text" name="social_media[linkedin]" value="' .$socialMedia['linkedin']. '" placeholder="Channel URL" />';
               
               echo '<p style="margin-top:20px;"><b>Instagramm</b></p>';
               echo '<input type="text" name="social_media[insta]" value="' .$socialMedia['insta']. '" placeholder="Channel URL" />';

               echo '<p style="margin-top:20px;"><b>Twitter</b></p>';
               echo '<input type="text" name="social_media[twitter]" value="' .$socialMedia['twitter']. '" placeholder="Channel URL" />';
          
               echo '<p style="margin-top:20px;"><b>Facebook</b></p>';
               echo '<input type="text" name="social_media[facebook]" value="' .$socialMedia['facebook']. '" placeholder="Channel URL" />';

               echo '<p style="margin-top:20px;"><b>Youtube</b></p>';
               echo '<input type="text" name="social_media[youtube]" value="' .$socialMedia['youtube']. '" placeholder="Channel URL" />';
          }
          
          
          // THEME COLORS
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
          
          
          // FONTS
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
          
          
          // ANALYTICS
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
          
     
          // META TAGS
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
     }

}
