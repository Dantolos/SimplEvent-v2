<?php


class LineUp {

     public $output = '';
     public $speakerCard;
     public $speakerIDs = array();
     
     public $forms;
     public $dateFormat;


     public function __construct() {
          $this->forms = new se2_Forms;
          $this->dateFormat = new Date_Format;
     }

     public function call_speaker_data( $cat = 'all' ) {
          $speaker_args = array(
               'post_type' => 'speakers', 
               'order'	  => 'ASC',
          );
          $speakerData = new WP_Query( $speaker_args );

          foreach( $speakerData->posts as $speaker ){
               if( $cat != 'all' && in_array( $cat, get_field('speaker_kategorie', $speaker->ID) ) ){
                    continue;
               }
               array_push( $this->speakerIDs, $speaker->ID );
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
          $this->output .= file_get_contents( get_template_directory_uri() . '/images/icons/sort-alpha-down.svg' ) . '<p>' . __( 'absteigend', 'SimplEvent' ) .'<p>';
          $this->output .= '</div>';

          //view options
          $this->output .= '<div class="se2-lineup-filter-view">';
          $this->output .= '<div class="viewbutton active-icon" view="grid">' . file_get_contents( get_template_directory_uri() . '/images/icons/grid.svg' ) . '</div>';
          $this->output .= '<div class="viewbutton" view="list">' . file_get_contents( get_template_directory_uri() . '/images/icons/view-list.svg' ) . '</div>';
          $this->output .= '</div>';

          $this->output .= '</div>';
          return $this->output;
     }

     public function cast_speaker_list( $speakerID ){
          $this->speakerCard = '<div class="se2-speaker-list-profile">'; 

               $this->speakerCard .= '<div class="se2-speaker-profile-image" style="background-image:url('.get_field('speaker_bild', $speakerID ).');"></div>';
               
               $this->speakerCard .= '<div class="se2-speaker-list-profil-info">';
     
                    $this->speakerCard .= '<h6>'.$this->dateFormat->formating_Date_Language( get_field( 'speaker_zeit', $speakerID )['datum'] , 'date' );
                    $this->speakerCard .= ' | ';
                    $this->speakerCard .= str_replace( 'Uhr', '', $this->dateFormat->formating_Date_Language( get_field( 'speaker_zeit', $speakerID )['start'] , 'time' ) );
                    $this->speakerCard .= ' ' . __( 'bis', 'SimplEvent') . ' ';
                    $this->speakerCard .= $this->dateFormat->formating_Date_Language( get_field( 'speaker_zeit', $speakerID )['ende'] , 'time' );
                    $this->speakerCard .= '</h6>';

                    $name = ( get_field('speaker_vorname', $speakerID) ) 
                         ? 
                              get_field('speaker_degree', $speakerID) 
                              . ' ' . get_field('speaker_vorname', $speakerID) 
                              . ' <b>' . get_field('speaker_nachname', $speakerID) . '</b>'
                         : 
                              the_title();
                    $this->speakerCard .= '<h3>'.$name.'</h3>';
                    $this->speakerCard .= '<p>'.get_field( 'speaker_funktion', $speakerID ).'</p>';

               $this->speakerCard .= '</div>';

          $this->speakerCard .= '</div>';
          return $this->speakerCard;
     }
     
     public function cast_speaker_grid( $speakerID ){
          $this->speakerCard = '<div class="se2-speaker-grid-profile">'; 

               $this->speakerCard .= '<div class="se2-speaker-grid-image" style="background-image:url('.get_field('speaker_bild', $speakerID ).');"></div>';
               $this->speakerCard .= '<div class="se2-speaker-grid-content">';
               $name = ( get_field('speaker_vorname', $speakerID) ) 
                    ? 
                         get_field('speaker_degree', $speakerID) 
                         . ' ' . get_field('speaker_vorname', $speakerID) 
                         . ' <b>' . get_field('speaker_nachname', $speakerID) . '</b>'
                    : 
                         the_title();
               $this->speakerCard .= '<h3>'.$name.'</h3>';
               $this->speakerCard .= '<p>'.get_field( 'speaker_funktion', $speakerID ).'</p>';
               $this->speakerCard .= '</div>';
             
          $this->speakerCard .= '</div>';
          return $this->speakerCard;
     }

     public function cast_line_up_overview( $args = array() ) {
          $this->output = '<div id="lineup-container" class="se2-lineup-container container">';
          //query IDs
          $speakerIDs = $this->call_speaker_data( $args['cat'] );
          //cast view        
          foreach( $speakerIDs as $speakerID ){
               if( empty($args) || $args['view'] == 'grid' ){
                    $this->output .= $this->cast_speaker_grid($speakerID);
               }else if( $args['view'] == 'list' ){
                    $this->output .= $this->cast_speaker_list($speakerID);
               }
          }
          $this->output .= '</div>';
          return $this->output;
     }

     //SET CARD CASTER FRONTPAGE


}