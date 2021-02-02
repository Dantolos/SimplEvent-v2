<?php  

class People{
 
    public $output;
    public $people;
 
    public function __construct() {
        $post_args = array(
            'post_type' => 'peoples', 
            'orderby' => 'name', 
            'order' => 'ASC',
        );
        $this->people = new WP_Query( $post_args );
    }

    public function call_People_Wall( $taxonomy = 0 ) {
        foreach($this->people->posts as $person){
            $this->output .= '<div class="se2-people-box">';
            $this->output .= '<div class="se2-people-portrait" style="background-image:url(' . esc_url( get_field('foto', $person->ID) ) . ')"></div>';
            $this->output .= '<div class="se2-people-content">';
            $this->output .= '<h2>' . get_the_title($person->ID) . '</h2>';
            $firma = ( get_field('firma', $person->ID) ) ? ', ' . get_field('firma', $person->ID) : '';
            $this->output .= '<p>' . esc_attr( get_field('funktion', $person->ID) ) . $firma . '</p>';

            //Banchen
            $this->output .= '<p class="se2-people-branche">';
            if(get_the_terms($person->ID, 'branche')){
               foreach(get_the_terms($person->ID, 'branche') as $key => $branche ) {
                    $spanstyle = ($key%2 == 0) ? 'opacity:1;' : 'opacity:.6;';
                    $this->output .= ($key != 0) ? ' | ' : ' ';
                    $this->output .= '<span style="' . $spanstyle . '">' . esc_attr($branche->name) . ' </span>';
                }
            }
            $this->output .= '</p>';

            //Social Media
            $socialmedia = new SocialMedia;
            
            if( get_field( 'social_media', $person->ID )["social_media"]  ){
               $this->output .= $socialmedia->castSocialMediaItem( get_field( 'social_media', $person->ID ) );
            }
         
            

            $this->output .= '</div>';
            $this->output .= '</div>';
        }
        
        return $this->output;
    }

}