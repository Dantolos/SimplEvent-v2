<?php 

class se2_CTA{
    public $cta;
 

     public function __construct(){
          if(get_option( 'se_cta_activ' ) === 'on'){
               wp_enqueue_script( 'se2_cta_script', get_template_directory_uri() . '/scripts/specifics/features/cta.js', array('jquery'), '1.0.10', true );
          }
     }

    
     public function cast_cta_button( $postID ){
          $postID = intval($postID);
          if(ICL_LANGUAGE_CODE){
               $postID = icl_object_id($postID , 'features', true, ICL_LANGUAGE_CODE);
          }
          $cta_settings = get_field('cta_settings', $postID );


          $this->cta = '<div class="cta-button" data-postid="'.$postID.'" style="background-color:'.$cta_settings['button_color'].';" >';
               $this->cta .= '<div class="cta-butto-icon" >';
               $this->cta .= '<img src="'.$cta_settings['icon'].'" />';
               $this->cta .= '</div>';
          $this->cta .= '<div class="cta-tooltip" style=""><b>'.$cta_settings['button_tooltip'].'</b></div>';
          
          $this->cta .= '</div>';

          return $this->cta;
     }

     public function cast_cta_lightbox( $postID ) {
          $ctaLightbox = '';
          
          $ctaLightbox .= '<div class="cta-lightbox">';
          $content_post = get_post($postID);
          $ctaLightbox .= apply_filters( 'the_content', $content_post->post_content );
          $ctaLightbox .= '</div>';

          return $ctaLightbox;
     }

   
}