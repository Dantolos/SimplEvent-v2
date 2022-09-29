<?php 
class Award {
     public $output;


     // ******************************************
     // FINALISTS
     // ******************************************

     public function cast_finalists( $finalistenJahr ) {
          $finalists_args = array( 
                                   'post_status' => array( 'publish' ), 'post_type' => 'company',
                              );  
          $finalists = new WP_Query( $finalists_args );
           
          
          $this->output .= '<div class="finalist-container">';
          foreach($finalists->posts as $finalist){
               $finalistID = $finalist->ID;
               if( !get_field( 'award', $finalistID )['award_candidate'] ){continue;}
               if( !get_field( 'award', $finalistID )['jahr'] || get_field( 'award', $finalistID )['jahr'][0] !== $finalistenJahr ){ continue; }
               $this->output .= $this->cast_finalist_box($finalistID);
          }
          $this->output .= '</div>';
          return $this->output;
     } 
     

     // ******************************************
     // HALL OF FAME
     // ******************************************

     public function cast_hall_of_fame( $finalistenJahre ) {

          $finalists_args = array( 
               'post_status' => array( 'publish' ), 'post_type' => 'company',
          );
          $finalists = new WP_Query( $finalists_args );

          usort($finalistenJahre,function($first,$second){
               return $first->name < $second->name;
          });

          foreach( $finalistenJahre as $finalistenJahr ){

               $this->output .= '<div class="hall-of-fame-jahr"><h3>'. $finalistenJahr->name.'</h3></div>';
               $this->output .= '<div class="finalist-container">';
               foreach($finalists->posts as $finalist){
                    $finalistID = $finalist->ID; 
                    if( !get_field( 'award', $finalistID )['award_candidate'] ){ continue; }
                    if( !get_field( 'award', $finalistID )['jahr'] || get_field( 'award', $finalistID )['jahr'][0] !== $finalistenJahr->term_id ){ continue; }
                    $this->output .= $this->cast_finalist_box($finalistID);
               }
               $this->output .= '</div>';
          }
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

          $finalistBox = '<div class="finalist-box candidate-box" candidate="'.$finalistID.'">';

               if( $finalistMedia['logo_positiv'] ){
                    $finalistBox .= '<div class="finalist-box-logo '.$winnerClass.'">';
                         $finalistBox .= '<img src="'. $finalistMedia['logo_positiv'] .'" alt="'.get_the_title( $finalistID ).'" title="'.get_the_title( $finalistID ).'" />';
                         if(get_field( 'award', $finalistID )['gewinner']){
                              $finalistBox .= '<div class="finalist-box-winner-flag">';
                              $finalistBox .= __( 'Gewinner', 'SimplEvent' );
                              $finalistBox .= '</div>';
                         }
                    $finalistBox .= '</div>';
               }
               
               $finalistBox .= '<h4>'.get_the_title( $finalistID ).'</h4>';
               $finalistBox .= '<p>' . substr( $teaserText, 0, $teaserText_length ) . ' <span class="secondary-txt">' . __(' ... mehr', 'SimplEvent') . '</span></p>';
          $finalistBox .= '</div>';
          return $finalistBox;
     }

     public function cast_candidate_lightbox( $candidateID ){
          $finalistMedia = get_field( 'media', $candidateID );
          $winnerClass = (get_field( 'award', $candidateID )['gewinner']) ? 'candidate-winner-class': '';
          
          $moodimageClass = ($finalistMedia['mood_image']) ? 'has-mood' : '';
          $moodimage = false;
          if(get_option( 'award_default_img' ) || $finalistMedia['mood_image'] ){
               $moodimageClass = (get_option( 'award_default_img' )) ? 'has-mood' : '';
               if($finalistMedia['mood_image']){
                    $moodimage = $finalistMedia['mood_image'];
               } else {
                    $moodimage = esc_attr( get_option( 'award_default_img' ) );
               }
          }
          
          $candidateLB = '<div class="candidate-lb-container">';
               $candidateLB .= '<div class="candidate-lb-head">';
                    if($moodimage){
                         $candidateLB .= '<div class="candidate-lb-image candidate-stagger" style="background-image:url('.$moodimage.');"></div>';
                    }

                    if( $finalistMedia['logo_positiv'] ){
                         $candidateLB .= '<div class="candidate-logo '.$winnerClass.' '.$moodimage.'">';
                              $candidateLB .= '<img src="'. $finalistMedia['logo_positiv'] .'" alt="'.get_the_title( $candidateID ).'" title="'.get_the_title( $candidateID ).'" />';
                              if(get_field( 'award', $candidateID )['gewinner']){
                                   $candidateLB .= '<div class="candidate-winner-flag">';
                                   $candidateLB .= __( 'Gewinner', 'SimplEvent' );
                                   $candidateLB .= '</div>';
                              }
                         $candidateLB .= '</div>';
                    }

                    
                    $candidateLB .= '<div class="candidate-lb-content candidate-stagger">';
                         $candidateLB .= '<h3>'.get_the_title( $candidateID ).'</h3>';
                         if( get_field( 'award', $candidateID )['finalistenbild'] ){
                              $candidateLB .= '<div class="candidate-finalist-image" style="background-image:url('.get_field( 'award', $candidateID )['finalistenbild'].');"></div>';
                         }
                         if( get_field('Key data', $candidateID ) ){
                              $candidateLB .= '<table class="candidate-keydata-table">';
                             
                              $keyData = get_field('Key data', $candidateID );
                              if( $keyData['Founding year'] ) {
                                   $candidateLB .= '<tr>';
                                   $candidateLB .= '<td>'.__( 'Founding Year', 'SimplEvent' ).'</td>';
                                   $candidateLB .= '<td>'.$keyData['Founding year'].'</td>';
                                   $candidateLB .= '</tr>';
                              }
                              if( $keyData['lead'] ) {
                                   $candidateLB .= '<tr>';
                                   $candidateLB .= '<td>'.__( 'Lead', 'SimplEvent' ).'</td>';
                                   $candidateLB .= '<td>';
                                   if( count($keyData['lead']) > 0 ){
                                        foreach ($keyData['lead'] as $key => $leadperson) {
                                             $candidateLB .= $leadperson['name'] . ' ' . $leadperson['position'];
                                        }
                                   }
                                   $candidateLB .= '</td>';
                                   $candidateLB .= '</tr>';
                              }
                              if( $keyData['employee'] ) {
                                   $candidateLB .= '<tr>';
                                   $candidateLB .= '<td>'.__( 'Employee', 'SimplEvent' ).'</td>';
                                   $candidateLB .= '<td>'.$keyData['employee'].'</td>';
                                   $candidateLB .= '</tr>';
                              }

                              $candidateLB .= '</table>';
                         }
     
                         
                         $candidateLB .= '<p>'.get_field( 'description', $candidateID ).'</p>';

                         if(get_field('Key data', $candidateID )['website']){
                              $candidateLB .= '<a href="'.get_field('Key data', $candidateID )['website'].'" target="_blank"><div class="candidate-website-button">'.__( 'Website', 'SimplEvent' ).'</div></a>';
                         }
                    $candidateLB .= '</div>';
               $candidateLB .= '</div>';
          $candidateLB .= '</div>';
          return $candidateLB;
     }
}