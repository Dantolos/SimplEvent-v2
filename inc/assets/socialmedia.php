<?php 
class SocialMedia {
     public $output;
     public $icon;
     public function castSocialMediaItem( $datas ){
          $this->output = '<div class="socialmedia-container">';
          foreach($datas as $key => $sms){
               foreach ($sms as $sm) {
                    
                    $this->output .= '<a href="'.$sm['sm_link'].'" target="_blank" title="'.$sm['acf_fc_layout'].'">';
                    switch ($sm['acf_fc_layout']) {
                         case 'linkedin':
                              $this->output .= file_get_contents(get_template_directory_uri() . '/images/icons/social-media/linkedin.svg');
                              break;
                         case 'instagramm':
                              $this->output .= file_get_contents(get_template_directory_uri() . '/images/icons/social-media/instagram.svg');
                              break;
                         case 'facebook':
                              $this->output .= file_get_contents(get_template_directory_uri() . '/images/icons/social-media/facebook.svg');
                              break;
                         case 'youtube':
                              $this->output .= file_get_contents(get_template_directory_uri() . '/images/icons/social-media/youtube.svg');
                              break;
                    }                    
                    $this->output .= '</a>';
               }
          }
          $this->output .= '</div>';
          return $this->output;

     }
}