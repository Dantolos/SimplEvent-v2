<?php 
class Award {
     public $output;

     public function cast_finalists( $finalistenJahr ) {
          $finalists_args = array( 
                                   'post_status' => array( 'publish' ), 'post_type' => 'company',
                                   array(
                                        'taxonomy' => 'jahr', 'field' => 'term_id', 'terms' => $finalistenJahr,
                                   ),
                              );
               
          $finalists = new WP_Query( $finalists_args );
           
          
          $this->output .= '<div class="finalist-container">';
          foreach($finalists->posts as $finalist){
               $finalistID = $finalist->ID;
               if( !get_field( 'award', $finalistID )['award_candidate'] ){continue;}
               $this->output .= $this->cast_finalist_box($finalistID);
          }
          $this->output .= '</div>';
          return $this->output;
     }

     public function cast_hall_of_fame() {
          $this->output = '<h1>HALL OF FAME</h1>';
          return $this->output;
     }

     public function cast_finalist_box($finalistID){
          $finalistBox;
          $finalistMedia = get_field( 'media', $finalistID );

          $teaserText = get_field( 'description', $finalistID );
          $teaserText = str_replace( '<h3>', '<b>', $teaserText ); 
          $teaserText = str_replace( '</h3>', '</b><br />', $teaserText ); 
          $tagEliminations = array("<p>", "</p>", '<div>', '</div>');
          $teaserText = str_replace( $tagEliminations, '', $teaserText ); 

          $teaserText_length = strpos( $teaserText , '.', 80 ) + 1;
          $winnerClass = (get_field( 'award', $finalistID )['gewinner']) ? 'finalist-winner-class': '';

          $finalistBox = '<div class="finalist-box">';
               $finalistBox .= '<div class="finalist-box-logo '.$winnerClass.'">';
                    $finalistBox .= '<img src="'. $finalistMedia['logo_positiv'] .'" alt="'.get_the_title( $finalistID ).'" title="'.get_the_title( $finalistID ).'" />';
                    if(get_field( 'award', $finalistID )['gewinner']){
                         $finalistBox .= '<div class="finalist-box-winner-flag">';
                         $finalistBox .= __( 'Gewinner', 'SimplEvent' );
                         $finalistBox .= '</div>';
                    }
               $finalistBox .= '</div>';
               
               $finalistBox .= '<h4>'.get_the_title( $finalistID ).'</h4>';
               $finalistBox .= '<p>' . substr( $teaserText, 0, $teaserText_length ) . ' <span class="secondary-txt">' . __(' ... mehr', 'SimplEvent') . '</span></p>';
          $finalistBox .= '</div>';
          return $finalistBox;
     }
}