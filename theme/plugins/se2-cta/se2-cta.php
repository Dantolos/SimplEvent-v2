<?php 

class se2_CTA{
    public $cta;

    public function __construct(){
        if(get_option( 'se_cta_activ' ) === 'on'){
            wp_enqueue_script( 'se2_cta_script', get_template_directory_uri() . '/theme/plugins/se2-cta/se2-cta.js', array('jquery'), '1.0.09', true );
        }
    }

    
    function cast_cta_button(){

        $this->cta = '<div id="cta-button"  data-api="'.get_option( 'se_cta' )['api'].'">';
        $this->cta .= '<div class="cta-butto-icon" style="background-color:'.get_option( 'se_cta' )['buttoncolor'].';">';
        $this->cta .= '<img src="'.get_option( 'se_cta' )['icon'].'" />';
        $this->cta .= '</div>';
        $this->cta .= '<div class="cta-tooltip" style="display:none;"><b>'.get_option( 'se_cta' )['buttontext'].'</b></div>';

        $this->cta .= '</div>';

        return $this->cta;
    }

   
}