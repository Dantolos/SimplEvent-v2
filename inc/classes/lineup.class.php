<?php
require_once(__DIR__.'/../supports/language.php');

class LineUp {


     public $output = '';
     public $speakerCard, $speakerLightbox, $speakerCardBlock;
     public $speakerIDs = array();
     public $forms;
     public $dateFormat;
     public $files; 
     public $socialMedia;
     public $tags;
     public $MediaCorner;
     public $speakerCloud;
     

     public function __construct() {
          $this->forms = new se2_Forms;
          $this->dateFormat = new Date_Format;
          $this->files = new se2_Files;
          $this->tags = new Tags;
          $this->socialMedia = new se2_SocialMedia( esc_attr( get_option( 'dark_mode_picker' )[1] ) );
          $this->MediaCorner = new Mediacorner();
     }


     public function call_speaker_data( $cat = 'all', $order = false, $year = 'all', $event = '' ) {
          $speaker_args = array(
               'post_status' => array( 'publish' ),
               'post_type'   => 'speakers', 
               'posts_per_page' => -1

          );
          
          $speakerData = new WP_Query( $speaker_args ); 
          $this->speakerIDs = array();
          foreach( $speakerData->posts as $speaker ){
              
               

               if( $cat != 'all' ){
                    $isInCat = false;
                    if( !is_array($cat) ){
                         if( !in_array( $cat, get_field('speaker_kategorie', $speaker->ID) ) ){
                           
                              continue;
                         } else {
                              
                              $isInCat = true;
                         }
                    } else {                  
                         foreach( $cat as $c ){
                              if( in_array( $c, get_field('speaker_kategorie', $speaker->ID) ) ){
                                   $isInCat = true;
                              }
                         }
                         if( !$isInCat ){ continue; }
                    }
               }
               
               
               if($event != ''){
                    $isInEvent = false;
                    if( !is_array($event)  ){
                         if( is_array(get_field('event', $speaker->ID))){
                              
                              foreach( get_field('event', $speaker->ID) as $sE ){    
                                   if( strval($event) === strval($sE['value']) ){
                                        $isInEvent = true;
                                   } else {
                                        continue;
                                   }
                              }
                         } else {
                              continue;
                         }
                         if( !$isInEvent ){ continue; }
                         /* foreach( get_field('event', $speaker->ID) as $sE2 ){
                              if( strval($event) === strval(get_field('event', $speaker->ID)['value']) ){
                                   $isInEvent = true;
                              }
                         } */
                         
                    } else {              
                            
                         foreach( $event as $eValue => $e ){     
                              if( is_array(get_field('event', $speaker->ID))){
                                   foreach( get_field('event', $speaker->ID) as $sE ){    
                                        if( strval($eValue) === strval($sE['value']) ){
                                               
                                             $isInEvent = true;
                                        }
                                   }
                              }
                         }
                         
                         if( !$isInEvent ){ continue; }
                    }
                    
               }
               
               

               $speakeryears = wp_get_post_terms( $speaker->ID, 'jahr' );
               if($year != 'all'){
                    $isInYear = false;
                    
                    foreach ( $speakeryears as $speakeryear ) {        
                        
                               
                         if( !is_array($year) && $speakeryear->term_id == $year) { 
                              
                              $isInYear = true;      
                              
                         } elseif ( is_array($year) ) {         
                              
                              foreach( $year as $y ){
                                   if( intval($y) === $speakeryear->term_id ){
                                        $isInYear = true;
                                   }
                              }
                         } else {
                              continue;
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
 


     public function cast_line_up_filter_section( $pageID, $args ) {

          $this->output = '<div  class="se2-lineup-filter-section container">';

          $filters = get_field('filters', $pageID );
          $visibility = get_field('visibility', $pageID);

          //sort direction
          if( is_array($filters) ){
               if( in_array( 'jahr', $filters ) ){
                    $checkSpeakerIDs = get_posts( ['numberposts' => -1, 'post_type' => 'speakers', 'fields' => 'id'] );
               
                    $yearOptions = [];
                    
                    foreach($checkSpeakerIDs as $speakid) {
                         $yearTaxs = get_the_terms( $speakid, 'jahr' );
                         if (is_array($yearTaxs) || is_object($yearTaxs)) {
                              foreach( $yearTaxs as $year ){                        
                                   if( !in_array( $year->term_id, array_column( $yearOptions, 'key' ) )  ){
                                        foreach( $visibility['jahr-visibility'] as $key => $visibleYear) {
                                             if( $year->term_id === $visibleYear->term_id){
                                                  $yearARRAY = [ 'key' => $year->term_id, 'name' => $year->name];
                                                  array_push( $yearOptions, $yearARRAY ); 
                                             }
                                        } 
                                   }
                              }
                         }
                    }
           
                    //asort($yearOptions);
                    $this->output .= '<div class="se2-lineup-filter-jahr filter-option">';
                    $this->output .= $this->forms->castDropdown( 'speakeryear', $yearOptions, false );
                    $this->output .= '</div>';
               }

               //filter event
               if( in_array( 'event', $filters ) ){
                    $this->output .= '<div class="se2-lineup-filter-events filter-option">';

                    //search for possible events to choice
                    $checkSpeakerIDs = get_posts( ['numberposts' => -1, 'post_type' => 'speakers', 'fields' => 'ids'] );
                    $speechEvents = [];
                    if (is_array($checkSpeakerIDs) || is_object($checkSpeakerIDs)) {
                         foreach($checkSpeakerIDs as $speakid) {
                              if(get_field('event', $speakid )){
                                   foreach( get_field('event', $speakid ) as $event ){
                                        if(!in_array( $event['label'], $speechEvents )){
                                             array_push( $speechEvents, $event['label'] ); 
                                        }
                                   }
                              }
                         }
                    }

                    //cast dropdown
                   
                    $this->output .= $this->forms->castDropdown( 'speechevent', $speechEvents, false, $args['event'] );
                    $this->output .= '</div>';
               }
          
               //filter categorie
               if( in_array( 'cat', $filters ) ){
                    $this->output .= '<div class="se2-lineup-filter-categories filter-option">';

                    //search for possible categoriese to choice
                    $checkSpeakerIDs = get_posts( ['numberposts' => -1, 'post_type' => 'speakers', 'fields' => 'ids'] );
                    $speechCategorie = [];
                    if (is_array($checkSpeakerIDs) || is_object($checkSpeakerIDs)) {
                         foreach($checkSpeakerIDs as $speakid) {
                              if(get_field('speaker_kategorie', $speakid )){
                                   foreach( get_field('speaker_kategorie', $speakid ) as $categorie ){
                                        if(!in_array( $categorie, $speechCategorie )){
                                             array_push( $speechCategorie, $categorie ); 
                                        }
                                   }
                              }
                         }
                    }

                    //cast dropdown
                    $this->output .= $this->forms->castDropdown( 'speechcat', $speechCategorie, true, $args['cat'] );
                    $this->output .= '</div>';
               }

               //sort direction
               if( in_array( 'sort', $filters ) ){
                    $this->output .= '<div class="se2-lineup-filter-sort filter-option">';
                    $this->output .= file_get_contents( get_template_directory_uri() . '/images/icons/sort-alpha-down.svg' ) . '<p>' . __( 'sortieren', 'SimplEvent' ) .'<p>';
                    $this->output .= '</div>';
               }
          }

          //view options
          $this->output .= '<div class="se2-lineup-filter-view">';
          $this->output .= '<div class="viewbutton active-icon" view="grid">' . file_get_contents( get_template_directory_uri() . '/images/icons/grid.svg' ) . '</div>';
          $this->output .= '<div class="viewbutton" view="list">' . file_get_contents( get_template_directory_uri() . '/images/icons/view-list.svg' ) . '</div>';
          $this->output .= '</div>';
          

          $this->output .= '</div>';

          return $this->output;

     }

     public function cast_speaker_list( $speakerID, $showCV = false, $hideDate = false, $showKategorie = false ){
          $speakerCardStyle = ($showCV) ? 'cursor: unset !important;' : '';
          $speakerID = apply_filters( 'wpml_object_id', $speakerID, 'speakers' );
          $this->speakerCard = '<div class="se2-speaker-list-profile speaker-profile" data-speakerid="'.$speakerID.'" style="'.$speakerCardStyle.'">'; 
              /*  $portraitImage = wp_get_attachment_image_src($this->files->se2_get_attachment_id_by_url(get_field('speaker_bild', $speakerID )), 'medium'); */
               $this->speakerCard .= '<div class="se2-speaker-profile-image" style="background-image:url('.get_field('speaker_bild', $speakerID ).');"></div>';
   
               $this->speakerCard .= '<div class="se2-speaker-list-profil-info">';
 
                    $timeDates = get_field( 'speaker_zeit', $speakerID );

                    if( $timeDates  ){
                         if(!$hideDate){
                              $this->speakerCard .= '<h6>'.$this->dateFormat->formating_Date_Language( $timeDates['datum'], 'date' );
                              
                              if( strlen( $this->dateFormat->formating_Date_Language( $timeDates['start'], 'time' ) ) > 0 ){
                                   $this->speakerCard .= ' | ';
                                   $this->speakerCard .= str_replace( 'Uhr', '', $this->dateFormat->formating_Date_Language( $timeDates['start'], 'time' ) );
                                   $this->speakerCard .= ' ' . __( 'bis', 'SimplEvent') . ' ';
                                   $this->speakerCard .= $this->dateFormat->formating_Date_Language( $timeDates['ende'], 'time' );
                              }
                              $this->speakerCard .= '</h6>';
                         }
                         

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

                         $this->speakerCard .= $this->tags->tag_cloud( get_field( 'speaker_kategorie', $speakerID ) );

                         if( $showCV ){
                              $this->speakerCard .= '<p>'.get_field( 'speaker_cv', $speakerID ).'</p>';
                         }
                    }



               $this->speakerCard .= '</div>';

          $this->speakerCard .= '</div>';

          return $this->speakerCard;

     }

     public function cast_speaker_grid( $speakerID ){

          $this->speakerCard = '<div class="se2-speaker-grid-profile speaker-profile" data-speakerid="'.$speakerID.'">'; 
               /*$portraitImage = wp_get_attachment_image_src($this->files->se2_get_attachment_id_by_url(get_field('speaker_bild', $speakerID )), 'medium');*/
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

               $this->speakerCard .= '<h5>'.$name.'</h5>';
               $speakerFirma = (get_field( 'speaker_firma', $speakerID )) ? ', '.get_field( 'speaker_firma', $speakerID ) : '';
               $this->speakerCard .= '<p>'.get_field( 'speaker_funktion', $speakerID ).$speakerFirma.'</p>';

               $this->speakerCard .= $this->tags->tag_cloud( get_field( 'speaker_kategorie', $speakerID ) );
               $this->speakerCard .= '</div>';

          $this->speakerCard .= '</div>';
          return $this->speakerCard;
     }

     public function cast_host( $speakerID  ){
  
          $this->speakerCard = '<div class="se2-speaker-host speaker-profile" data-speakerid="'.$speakerID.'" style="">'; 
              /*  $portraitImage = wp_get_attachment_image_src($this->files->se2_get_attachment_id_by_url(get_field('speaker_bild', $speakerID )), 'medium'); */
               $this->speakerCard .= '<div class="se2-host-profil-image" style="background-image:url('.get_field('speaker_bild', $speakerID ).');"></div>';
   
               $this->speakerCard .= '<div class="se2-host-profil-info">';

                         $name = ( get_field('speaker_vorname', $speakerID) ) 
                              ? 
                                   get_field('speaker_degree', $speakerID) 
                                   . ' ' . get_field('speaker_vorname', $speakerID) 
                                   . ' <b>' . get_field('speaker_nachname', $speakerID) . '</b>'
                              : 
                                   the_title();

                         $this->speakerCard .= '<h5>'.$name.'</h5>';
                         $speakerFirma = (get_field( 'speaker_firma', $speakerID )) ? ', '.get_field( 'speaker_firma', $speakerID ) : '';

                         //$this->speakerCard .= '<h6>'.get_field( 'speaker_funktion', $speakerID ).$speakerFirma.'</h6>';

               $this->speakerCard .= '</div>';

          $this->speakerCard .= '</div>';

          return $this->speakerCard;

     }


     public function cast_line_up_overview( $args = array() ) {
        
          //std year
          $currYear = '';
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

          //event
          $currEvent = $args['event'];
          if(is_array($currEvent )){
               $currEvent = array_keys($currEvent)[0];
          }
         
          $this->output = '<div id="lineup-container" class="se2-lineup-container container" year="'.$currYear.'" data-event="'.$currEvent.'">';
          
          //query IDs
          $speakerIDs = $this->call_speaker_data( $args['cat'], $args['sort'], $args['year'], $args['event'] );

          //cast view       
          if( $speakerIDs ){
               foreach( $speakerIDs as $speakerID ){
                    if( empty($args) || $args['view'] === 'grid' ){
                         $this->output .= $this->cast_speaker_grid($speakerID);
                    }else if( $args['view'] === 'list' ){
                         $this->output .= $this->cast_speaker_list($speakerID);
                    }
               }
          } else {
               $this->output .= '<h4>'.__('No speakers found!', 'SimplEvent').'</h4>'; 
          }

          $this->output .= '</div>';
          return $this->output;

     }



     //SPEAKER LIGHTBOX 

     public function cast_speaker_lightbox( $speakerID ){
          $speakerID = apply_filters( 'wpml_object_id', $speakerID, 'speakers' );
          $speakername = ( get_field('speaker_vorname', $speakerID)  ) 
          ? 
               get_field('speaker_degree', $speakerID) 
               . ' ' . get_field('speaker_vorname', $speakerID) 
               . ' <b>' . get_field('speaker_nachname', $speakerID) . '</b>'
          : 
               get_the_title( $speakerID );

          $speakerFirma = (get_field( 'speaker_firma', $speakerID )) ? ', '.get_field( 'speaker_firma', $speakerID ) : '';

          $this->speakerLightbox = '<div class="speaker-lb-container">';

          $this->speakerLightbox .= '<div class="speaker-lb-body">';

              

               

                    //INFOS
                    $this->speakerLightbox .= '<div class="speaker-lb-informations">';

                         //Auftritt infos
                         $speakerDate = strtotime( str_replace( '/', '-',  get_field('speaker_zeit', $speakerID)['datum'] ) );
                         $start = date( 'Hi', strtotime(get_field('speaker_zeit', $speakerID)['start']));
                         $ende = date( 'Hi', strtotime(get_field('speaker_zeit', $speakerID)['ende']));


                         if($speakerDate){
                              $this->speakerLightbox .= '<div class="speaker-lb-informations-gig">';

                                   $this->speakerLightbox .= '<h6>';
                                   $this->speakerLightbox .= $this->dateFormat->formating_Date_Language( get_field('speaker_zeit', $speakerID)['datum'], 'date' ) . '<br />';
                                   $this->speakerLightbox .= '</h6>';

                                   if( $start !== '0000' && $ende !== '0000' ){
                                   
                                        $this->speakerLightbox .= '<h4>';
                                        $this->speakerLightbox .= $this->dateFormat->formating_Date_Language( $start, 'time' );
                                        //$this->speakerLightbox .= ' &ndash; ';
                                        $this->speakerLightbox .= '<span> &ndash; ' . $this->dateFormat->formating_Date_Language( $ende, 'time' ) . '</span>';
                                        $this->speakerLightbox .= '</h4>';
                                   }
                             
                              $this->speakerLightbox .= '</div>';
                         }

                         //SOZIALMEDIA

                         //SHARE BUTTONS // TODO <----------------------------------------------------------------
                         $shareurl = get_permalink( $speakerID );
                         $sharetitle = (get_field('speaker_vorname', $speakerID)) ? get_field('speaker_vorname', $speakerID) . ' ' . get_field('speaker_nachname', $speakerID) : get_the_title( $speakerID );
                         $sharedescription = (get_field('programm_titel', $speakerID)) ? get_field('programm_titel', $speakerID) : get_field('speaker_funktion', $speakerID) . $speakerFirma;
                         
                         $sharecontent = array(
                              'url' => $shareurl,
                              'title' => $sharetitle,
                              'description' => $sharedescription,
                              'image' => get_field('speaker_bild', $speakerID ),
                         );
                           
                         $this->speakerLightbox .= '<div class="speaker-lb-share">';
                         $this->speakerLightbox .= $this->socialMedia->shareButton( $sharecontent  );
                         $this->speakerLightbox .= '</div>'; 
                         


                         //SOCIAL LINKS
                         if(is_array(get_field('speaker_social_media', $speakerID)['social_media'])){
                              $this->speakerLightbox .= '<div class="speaker_socialmedia">';
                         
                              $socialMEdias = get_field('speaker_social_media', $speakerID)['social_media'];
                              //$this->speakerLightbox .= var_dump($socialMEdias);
                              foreach( $socialMEdias  as $key => $smIcon ){
                                   $this->speakerLightbox .= '<div class="speaker_socialmedia-icon">'.$this->socialMedia->cast_icon( $smIcon['acf_fc_layout'], $smIcon[$smIcon['acf_fc_layout']] ).'</div>';
                              }
                              $this->speakerLightbox .= '</div>';
                         } 

                    $this->speakerLightbox .= '</div>';

                          
                    //CONTENT
                    $this->speakerLightbox .= '<div class="speaker-lb-content">';
                    //FOTO
                    $this->speakerLightbox .= '<div class="speaker-lb-image speaker-stagger" style="background-image:url('.get_field('speaker_bild', $speakerID ).');">';    
                    $this->speakerLightbox .= '</div>';

                         //SPEAKER
                         $this->speakerLightbox .= '<div class="speaker-lb-headinfo speaker-stagger">';

                              $this->speakerLightbox .= '<div class="se2-tag-element">' . \se2\support\LANGUAGE\formating_Language( get_field('speaker_sprache', $speakerID) ) . '</div>'; //------------------------------------------
                         
                              $this->speakerLightbox .= '<h2 class="speaker-stagger">'.$speakername.'</h2>';
                              
                              $this->speakerLightbox .= '<p class="speaker-stagger primary-txt">'.get_field( 'speaker_funktion', $speakerID ).$speakerFirma.'</p>';

                             
                              $speakerCV = get_field( 'speaker_cv', $speakerID );
                              $this->speakerLightbox .=  $speakerCV;

                              $this->speakerLightbox .= '<div class="review-videos">';
                         
                              $videoArgs = array(
                                   'numberposts'	=> -1,
                                   'post_type'	=> 'video',
                                   'meta_query'	=> array(
                              
                                        array(
                                             'key'	 	=> 'corr-speakers',
                                             'value'	  	=> $speakerID,
                                             'compare' 	=> 'LIKE',
                                        ), 
                                        
                                   )
                              );
                              $videos = new WP_Query( $videoArgs );

                              if($videos->posts){
                                   foreach( $videos->posts as $video ){
                                        $this->speakerLightbox .= '<div class="review-video">';
                                        
                                        $this->speakerLightbox .= $this->MediaCorner->se2_video( $video->ID );
                                        $this->speakerLightbox .= '<h5>'.get_the_title( $video->ID).'</h5>';
                                        $this->speakerLightbox .= '</div>';
                                   }
                              }
                              
                         $this->speakerLightbox .= '</div>';

                         //REVIEW
                        
                         if( have_rows('review_jahr',  $speakerID ) ){
                              foreach( get_field( 'review_jahr', $speakerID ) as $review ){
                                   if( $review['review_public'] ){
                              
                                        $this->speakerLightbox .= '<h6>REVIEW <b>'. $review['jahr']->slug .'</b></h6>';
                                        $this->speakerLightbox .= '<h4><b>'.$review['review_titel'].'</b></h4>';

                                        //PRESENTATION
                                        if( $review['presentation'] ){ 
                                             $this->speakerLightbox .= '<a href="'.$review['presentation']['url'].'" target="_blank">';
                                             $this->speakerLightbox .= '<div class="speaker-presi-btn se2-btn-s se2-btn-light se2-btn-rnd-20">';
                                             $this->speakerLightbox .= '<span>'.__('Präsentation', 'SimplEvent').' <i>'.$this->files->getRemoteFilesize( $review['presentation']['url'] ).'</i></span>';
                                             $this->speakerLightbox .= '</div>';
                                             $this->speakerLightbox .= '</a>';
                                        }
     
                                        $this->speakerLightbox .= '<div class="review-videos">';
                                        if( $review['review_video'] ){
                                             $this->speakerLightbox .= '<div class="review-video">';
                                             $this->speakerLightbox .= '<div class="video-wrapper"><iframe  width="100%" height="100%" src="https://media10.simplex.tv/content/'. $review['review_video'] .'/index.html?embed=1" frameborder="0" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true" scrolling="no"></iframe></div>';
                                             $this->speakerLightbox .= '<h5>'.__('Auftritt', 'SimplEvent').'</h5>';
                                             $this->speakerLightbox .= '</div>';
                                             
                                        }
                                        $this->speakerLightbox .= '</div>';
                                        
                                        $this->speakerLightbox .= '<p>' . $review['review_text'] . '</p>';
                                        
                                   
                                        if( is_array($review['review_galerie'])) {
                                             $this->speakerLightbox .= '<div class="gallery-splide">';
                                             $this->speakerLightbox .= '<h4>'.__('Fotos', 'SimplEvent').'</h4>';
                                             $this->speakerLightbox .= '<div class="gallery-splide-main splide" >';
                                             $this->speakerLightbox .= '<div class="splide__track"><ul class="splide__list">';
                                                  foreach ($review['review_galerie'] as $key => $foto) {
                                                       $this->speakerLightbox .= '<li class="splide__slide">';
                                                       $this->speakerLightbox .= '<div style="background-image: url('.esc_url($foto).')"></div>';
                                                       $this->speakerLightbox .= '</li>';
                                                  }
                                             $this->speakerLightbox .= '</ul></div>';
                                             $this->speakerLightbox .= '</div>';
                    
                                             $this->speakerLightbox .= '<div class="gallery-splide-thumb splide" >';
                                             $this->speakerLightbox .= '<div class="splide__track"><ul class="splide__list">';
                                                  foreach ($review['review_galerie'] as $key => $foto) {
                                                       $this->speakerLightbox .= '<li class="splide__slide">';
                                                       $this->speakerLightbox .= '<img src="'.esc_url($foto).'" />';
                                                       $this->speakerLightbox .= '</li>';
                                                  }
                                                  $this->speakerLightbox .= '</ul></div>';
                                             $this->speakerLightbox .= '</div>';
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
          $speakerID = apply_filters( 'wpml_object_id', $speakerID, 'speakers' );
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
                          
                                   $this->speakerLightbox .= '<h6>REVIEW asdfasdf <b>'. $review['jahr']->slug .'</b></h6>';
                                   $this->speakerLightbox .= '<h3><b>'.$review['review_titel'].'</b></h3>';
                                   $this->speakerLightbox .= '<h3>FASFASF</h3>';

                                  
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

     public function cast_speaker_tag_cloud( $speakers ){
          
          $this->speakerCloud = '<div class="speaker-tag-cloud">';

          $this->speakerCloud .= '<h6 style="width:100%;">'.__('Mit:', 'SimplEvent').'</h6>';
      
          foreach( (array)$speakers as $speaker ){
               $speakerData = [
                    'image' => '',
                    'name' => '',
                    'firma' => '',
                    'cv' => '',
               ];
               $speakerID = isset($speaker['type']) ? $speaker['speaker'] : $speaker;
               if( !isset($speaker['type']) || $speaker['type'] === 'Speaker' ){
                    
                    $speakerID = isset($speaker['type']) ? $speaker['speaker'] : $speaker;
                    $speakerData['name'] = ( get_field('speaker_vorname', $speakerID) ) 
                    ? 
                         get_field('speaker_degree', $speakerID) 
                         . ' ' . get_field('speaker_vorname', $speakerID) . ' '
                         . '' . get_field('speaker_nachname', $speakerID) . ''
                    : 
                         the_title();
                          
                    $speakerData['image'] = get_field('speaker_bild', $speakerID);
                    $speakerFirma = (get_field( 'speaker_firma', $speakerID )) ? ', '.get_field( 'speaker_firma', $speakerID ) : '';
                    $speakerData['firma'] = get_field( 'speaker_funktion', $speakerID ).$speakerFirma;
                    $speakerData['cv'] = get_field( 'speaker_cv', $speakerID );
               } elseif ( $speaker['type'] === 'Specific' ){
                    $speakerData['name'] = $speaker['vorname']. ' ' .$speaker['nachname'];
               }
               $this->speakerCloud .= '<div class="speaker-tag">';
               $this->speakerCloud .= '<h5>'; 
               $this->speakerCloud .= $speakerData['name'];
               $this->speakerCloud .= '</h5>';
                    //tooltips
                    $this->speakerCloud .= '<div class="speaker-tag-tooltips">';
                    $this->speakerCloud .= '<div class="speaker-tag-tooltips-image" style="background-image:url('.$speakerData['image'].');"></div>';
                    $this->speakerCloud .= '<h4>' . $speakerData['name'] . '</h4>';
                    $this->speakerCloud .= '<h6>' . $speakerData['firma'] . '</h6>';
                    $this->speakerCloud .= '<div class="speaker-tag-tooltips-button speaker-lb-trigger" data-speakerid="'.$speakerID.'">'.__('more', 'SimplEvent').'</div>';
                    //$this->speakerCloud .= $speakerData['cv'];
                    $this->speakerCloud .= '</div>';

               $this->speakerCloud .= '</div>';
          }
          $this->speakerCloud .= '</div>';
          return $this->speakerCloud;
     }

} 