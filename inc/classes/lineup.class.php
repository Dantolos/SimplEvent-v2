<?php

class LineUp {


     public $output = '';
     public $speakerCard, $speakerLightbox, $speakerCardBlock;
     public $speakerIDs = array();
     public $forms;
     public $dateFormat;
     public $files;

     public function __construct() {
          $this->forms = new se2_Forms;
          $this->dateFormat = new Date_Format;
          $this->files = new se2_Files;
     }


     public function call_speaker_data( $cat = 'all', $order = false, $year = 'all' ) {
          $speaker_args = array(
               'post_status' => array( 'publish' ),
               'post_type'   => 'speakers', 
          );

          $speakerData = new WP_Query( $speaker_args ); 

          foreach( $speakerData->posts as $speaker ){

               if( $cat != 'all' && !in_array( $cat, get_field('speaker_kategorie', $speaker->ID) ) ){
                    continue;
               }
               
               $speakeryears = wp_get_post_terms( $speaker->ID, 'jahr' );
               if($year != 'all'){
                    $isInYear = false;
                    
                    foreach ( $speakeryears as $speakeryear ) {
                         if( $speakeryear->term_id == $year) { 
                              $isInYear = true;
                         }
                    }
                    if( !$isInYear ){ continue; }
               }

               array_push( $this->speakerIDs, $speaker->ID );

          }


          if( $order === 'asc' ){

               function sortASC($a, $b) {
                    if ( get_field('speaker_nachname', $a) == get_field('speaker_nachname', $b) ) {
                        return 0;
                    }

                    return ( get_field('speaker_nachname', $a) < get_field('speaker_nachname', $b) ) ? -1 : 1;

                }

               uasort($this->speakerIDs, 'sortASC');

          }



          if( $order === 'dsc' ){

               function sortDSC($a, $b) {

                    if ( get_field('speaker_nachname', $a) == get_field('speaker_nachname', $b) ) {
                        return 0;
                    }

                    return ( get_field('speaker_nachname', $a) < get_field('speaker_nachname', $b) ) ? 1 : -1;

               }

               uasort($this->speakerIDs, 'sortDSC');

          }

          return $this->speakerIDs;

     }



     public function cast_line_up_filter_section() {

          $this->output = '<div  class="se2-lineup-filter-section container">';


          //filter categorie

          $this->output .= '<div class="se2-lineup-filter-categories">';

          //search for possible categoriese to choice

          $checkSpeakerIDs = get_posts( ['post_type' => 'speakers', 'fields' => 'ids'] );

          $speechCategorie = [];

          foreach($checkSpeakerIDs as $speakid) {
               foreach( get_field('speaker_kategorie', $speakid ) as $categorie ){
                    if(!in_array( $categorie, $speechCategorie )){
                         array_push( $speechCategorie, $categorie ); 
                    }
               }
          }

          //cast dropdown
          $this->output .= $this->forms->castDropdown( 'speechcat', $speechCategorie, true );
          $this->output .= '</div>';


          //sort direction
          $this->output .= '<div class="se2-lineup-filter-sort">';
          $this->output .= file_get_contents( get_template_directory_uri() . '/images/icons/sort-alpha-down.svg' ) . '<p>' . __( 'sortieren', 'SimplEvent' ) .'<p>';
          $this->output .= '</div>';


          //view options
          $this->output .= '<div class="se2-lineup-filter-view">';
          $this->output .= '<div class="viewbutton active-icon" view="grid">' . file_get_contents( get_template_directory_uri() . '/images/icons/grid.svg' ) . '</div>';
          $this->output .= '<div class="viewbutton" view="list">' . file_get_contents( get_template_directory_uri() . '/images/icons/view-list.svg' ) . '</div>';
          $this->output .= '</div>';


          $this->output .= '</div>';

          return $this->output;

     }



     public function cast_speaker_list( $speakerID, $showCV = false  ){
          $speakerCardStyle = ($showCV) ? 'cursor: unset !important;' : '';

          $this->speakerCard = '<div class="se2-speaker-list-profile speaker-profile" speakerid="'.$speakerID.'" style="'.$speakerCardStyle.'">'; 
              /*  $portraitImage = wp_get_attachment_image_src($this->files->se2_get_attachment_id_by_url(get_field('speaker_bild', $speakerID )), 'medium'); */
               $this->speakerCard .= '<div class="se2-speaker-profile-image" style="background-image:url('.get_field('speaker_bild', $speakerID ).');"></div>';
   
               $this->speakerCard .= '<div class="se2-speaker-list-profil-info">';
 
                    $timeDates = get_field( 'speaker_zeit', $speakerID );

                    if( $timeDates ){
                         $this->speakerCard .= '<h6>'.$this->dateFormat->formating_Date_Language( $timeDates['datum'], 'date' );
                         $this->speakerCard .= ' | ';
                         $this->speakerCard .= str_replace( 'Uhr', '', $this->dateFormat->formating_Date_Language( $timeDates['start'], 'time' ) );
                         $this->speakerCard .= ' ' . __( 'bis', 'SimplEvent') . ' ';
                         $this->speakerCard .= $this->dateFormat->formating_Date_Language( $timeDates['ende'], 'time' );
                         $this->speakerCard .= '</h6>';

                         $name = ( get_field('speaker_vorname', $speakerID) ) 
                              ? 
                                   get_field('speaker_degree', $speakerID) 
                                   . ' ' . get_field('speaker_vorname', $speakerID) 
                                   . ' <b>' . get_field('speaker_nachname', $speakerID) . '</b>'
                              : 
                                   the_title();

                         $this->speakerCard .= '<h4>'.$name.'</h4>';
                         $speakerFirma = (get_field( 'speaker_firma', $speakerID )) ? ', '.get_field( 'speaker_firma', $speakerID ) : '';

                         $this->speakerCard .= '<p>'.get_field( 'speaker_funktion', $speakerID ).$speakerFirma.'</p>';

                         if( $showCV ){
                              $this->speakerCard .= '<p>'.get_field( 'speaker_cv', $speakerID ).'</p>';
                         }
                    }



               $this->speakerCard .= '</div>';

          $this->speakerCard .= '</div>';

          return $this->speakerCard;

     }

     

     public function cast_speaker_grid( $speakerID ){

          $this->speakerCard = '<div class="se2-speaker-grid-profile speaker-profile" speakerid="'.$speakerID.'">'; 
/*                $portraitImage = wp_get_attachment_image_src($this->files->se2_get_attachment_id_by_url(get_field('speaker_bild', $speakerID )), 'medium');
 */
               $portraitImage = esc_url( get_field('speaker_bild', $speakerID ));
         
               
               $this->speakerCard .= '<div class="se2-speaker-grid-image" style="background-image:url('.$portraitImage.');"></div>';
               $this->speakerCard .= '<div class="se2-speaker-grid-content">';

               $name = ( get_field('speaker_vorname', $speakerID) ) 
                    ? 
                         get_field('speaker_degree', $speakerID) 
                         . ' ' . get_field('speaker_vorname', $speakerID) 
                         . ' <b>' . get_field('speaker_nachname', $speakerID) . '</b>'
                    : 
                         the_title();

               $this->speakerCard .= '<h4>'.$name.'</h4>';
               $speakerFirma = (get_field( 'speaker_firma', $speakerID )) ? ', '.get_field( 'speaker_firma', $speakerID ) : '';
               $this->speakerCard .= '<p>'.get_field( 'speaker_funktion', $speakerID ).$speakerFirma.'</p>';
               $this->speakerCard .= '</div>';

          $this->speakerCard .= '</div>';
          return $this->speakerCard;
     }



     public function cast_line_up_overview( $args = array() ) {

          //std year
          $currYear = false;
          $cY = date('Y');
          if( get_term_by('slug', $cY , 'jahr') ){
               $currYear = get_term_by('slug', $cY, 'jahr')->term_id;
          } else {
               $minus = 1;
               while( $currYear === false ){
                    $YearDate = date('Y', strtotime($cY.' -'.$minus.' year'));
                    if(get_term_by('slug', $YearDate, 'jahr')){
                         $currYear = get_term_by('slug', $YearDate, 'jahr')->term_id;
                    }
                    $minus++;
               }
          }

          $this->output = '<div id="lineup-container" class="se2-lineup-container container" year="'.$currYear.'">';

          //query IDs
          $speakerIDs = $this->call_speaker_data( $args['cat'], $args['sort'],  $args['year'] );

          //cast view        
          foreach( $speakerIDs as $speakerID ){
               if( empty($args) || $args['view'] === 'grid' ){
                    $this->output .= $this->cast_speaker_grid($speakerID);
               }else if( $args['view'] === 'list' ){
                    $this->output .= $this->cast_speaker_list($speakerID);
               }
          }

          $this->output .= '</div>';
          return $this->output;

     }



     //SPEAKER LIGHTBOX 

     public function cast_speaker_lightbox( $speakerID ){
          $this->speakerLightbox = '<div class="speaker-lb-container">';

          $this->speakerLightbox .= '<div class="speaker-lb-head">';

               
               
               $this->speakerLightbox .= '<div class="speaker-lb-image speaker-stagger" style="background-image:url('.get_field('speaker_bild', $speakerID ).');"></div>';

               $this->speakerLightbox .= '<div class="speaker-lb-headinfo speaker-stagger">';
            
                    $speakername = ( get_field('speaker_vorname', $speakerID) ) 
                    ? 
                         get_field('speaker_degree', $speakerID) 
                         . ' ' . get_field('speaker_vorname', $speakerID) 
                         . ' <b>' . get_field('speaker_nachname', $speakerID) . '</b>'
                    : 
                         get_the_title( $speakerID );

                    $this->speakerLightbox .= '<h2 class="speaker-stagger">'.$speakername.'</h2>';
                    $speakerFirma = (get_field( 'speaker_firma', $speakerID )) ? ', '.get_field( 'speaker_firma', $speakerID ) : '';
                    $this->speakerLightbox .= '<p class="speaker-stagger primary-txt">'.get_field( 'speaker_funktion', $speakerID ).$speakerFirma.'</p>';
                    $speakerCV = get_field( 'speaker_cv', $speakerID );
                    $this->speakerLightbox .=  $speakerCV;
                    

                    if( have_rows('review_jahr',  $speakerID ) ){
                         foreach( get_field( 'review_jahr', $speakerID ) as $review ){
                              if( $review['review_public'] ){
                          
                                   $this->speakerLightbox .= '<h6>REVIEW <b>'. $review['jahr']->slug .'</b></h6>';
                                   $this->speakerLightbox .= '<h3><b>'.$review['review_titel'].'</b></h3>';

                                   if( $review['review_video'] ){
                                        $this->speakerLightbox .= '<div class="review-video"><iframe  width="100%" height="100%" src="https://media10.simplex.tv/content/'. $review['review_video'] .'/index.html?embed=1" frameborder="0" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true" scrolling="no"></iframe></div>';
                                   }
                                   $this->speakerLightbox .= '<p>'.$review['review_text'].'</p>';

                                   if( $review['review_galerie'] ){
                                        $this->speakerLightbox .= '<div class="speaker-lb-review-gallery">';
                                        foreach($review['review_galerie'] as $image){
                                             $this->speakerLightbox .= '<div class="se-review-img" open="0"><img src="'.$image.'"></div>';
                                        }
                                        $this->speakerLightbox .= '</div>';
                                   }

                              }

                         }                          

                    }

                    $this->speakerLightbox .= get_field( 'review_text', $speakerID );

               $this->speakerLightbox .= '</div>';

          $this->speakerLightbox .= '</div>';

          $this->speakerLightbox .= '</div>';

          return $this->speakerLightbox;

     }

     //SET CARD CASTER FRONTPAGE
     public function cast_speaker_card_block( $speakerID ){
          $this->speakerCardBlock = '<div class="speaker-card-block-container" style="width:100%; height:100%;">';
          $this->speakerCardBlock .= '<div class="se2-speaker-grid-image" style="background-image:url('.get_field('speaker_bild', $speakerID ).');"></div>';

          $this->speakerCardBlock .= '</div>';

          return $this->speakerCardBlock;
     }

     public function gg_cast_speaker_lightbox($speakerID){
          $this->speakerLightbox = '<div class="speaker-lb-container">';

          $this->speakerLightbox .= '<div class="speaker-lb-head">';
          $args = array( 'p' => $speakerID );
          $myPosts = new WP_Query( $args );
          $this->speakerLightbox .= '<pre style="color:green;">';
          $this->speakerLightbox .= $myPosts;
          $this->speakerLightbox .= '</pre>';
          
               $this->speakerLightbox .= '<div class="speaker-lb-image speaker-stagger" style="background-image:url('.get_field('speaker_bild', $speakerID ).');"></div>';

               $this->speakerLightbox .= '<div class="speaker-lb-headinfo speaker-stagger">';
            
                    $speakername = ( get_field('speaker_vorname', $speakerID) ) 
                    ? 
                         get_field('speaker_degree', $speakerID) 
                         . ' ' . get_field('speaker_vorname', $speakerID) 
                         . ' <b>' . get_field('speaker_nachname', $speakerID) . '</b>'
                    : 
                         get_the_title( $speakerID );

                    $this->speakerLightbox .= '<h2 class="speaker-stagger">'.$speakername.' - '.$speakerID.'</h2>';
                    $speakerFirma = (get_field( 'speaker_firma', $speakerID )) ? ', '.get_field( 'speaker_firma', $speakerID ) : '';
                    $this->speakerLightbox .= '<p class="speaker-stagger primary-txt">'.get_field( 'speaker_funktion', $speakerID ).$speakerFirma.'</p>';

                    
                    
                    if( $myPosts->have_posts() ) {
                         while( $myPosts->have_posts() ) {
                              $myPosts->the_post();
                              $this->speakerLightbox .= 'THIS POST';
                              $this->speakerLightbox .= the_title();
                         }
                    }
                    wp_reset_postdata();

                    $speakerCV = get_field( 'speaker_cv', $speakerID );
                    $this->speakerLightbox .=  $speakerCV;
                    

                    if( have_rows('review_jahr',  $speakerID ) ){
                         foreach( get_field( 'review_jahr', $speakerID ) as $review ){
                              if( $review['review_public'] ){
                          
                                   $this->speakerLightbox .= '<h6>REVIEW <b>'. $review['jahr']->slug .'</b></h6>';
                                   $this->speakerLightbox .= '<h3><b>'.$review['review_titel'].'</b></h3>';

                                   if( $review['review_video'] ){
                                        $this->speakerLightbox .= '<div class="review-video"><iframe  width="100%" height="100%" src="https://media10.simplex.tv/content/'. $review['review_video'] .'/index.html?embed=1" frameborder="0" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true" scrolling="no"></iframe></div>';
                                   }
                                   $this->speakerLightbox .= '<p>'.$review['review_text'].'</p>';

                                   if( $review['review_galerie'] ){
                                        $this->speakerLightbox .= '<div class="speaker-lb-review-gallery">';
                                        foreach($review['review_galerie'] as $image){
                                             $this->speakerLightbox .= '<div class="se-review-img" open="0"><img src="'.$image.'"></div>';
                                        }
                                        $this->speakerLightbox .= '</div>';
                                   }

                              }

                         }                          

                    }

                    $this->speakerLightbox .= get_field( 'review_text', $speakerID );

               $this->speakerLightbox .= '</div>';

          $this->speakerLightbox .= '</div>';

          $this->speakerLightbox .= '</div>';

          return $this->speakerLightbox;
          
     }

} 