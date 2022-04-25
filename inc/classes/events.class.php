<?php 
class Events extends Posts {

     public $output;
     public $eventData;
     public $dateFormat;

     
     //POST WALL
     public function __construct(){
          $this->dateFormat = new Date_Format;
          $this->speakerFunctions = new LineUp;
     }

     public function call_Events_Wall( $year = false, $order = 'ASC', $orderby = 'date', $acfField = false, $subField = false, $dateFormat = false ) {

          $this->eventData = parent::call_Post_Data('event', $order, $orderby, $acfField, $subField, $dateFormat );
     
          foreach ( $this->eventData->posts as $key => $event ) {
               
               $date = strtotime( str_replace( '/', '-', get_field('eckdaten', $event->ID )['date'] ));
               $time = strtotime( get_field('eckdaten', $event->ID )['time'] );

               if( $year && date( 'Y', $date) != $year ) {
                    continue;
               }
               if(date( 'Y', $date) < 2017){
                    continue;
               }

               $this->output .= '<div class="se2-post" postid="' . $event->ID . '" lb="event_lightbox">';
               if(get_field('keyvisual', $event->ID)){
                    $this->output .= '<div class="se2-post-image"><div style="background-image:url(' . esc_url( get_field('keyvisual', $event->ID) ) . ')"></div></div>';
               } else {
                    $this->output .= '<div class="se2-post-image"><div style="background-image:url(' . esc_url( get_field('media', $event->ID)['gallery'][0] ) . ')"></div></div>';
               }
               $this->output .= '<div class="se2-post-content">';
               $this->output .= '<h3>' . esc_attr( get_field( 'titel', $event->ID ) ) . '</h3>';

               $this->output .= '<p class="secondary-txt">'; 
              
               if( $date || $time ){
                    $date = ($date) ?  $this->dateFormat->formating_Date_Language( get_field('eckdaten', $event->ID )['date'], 'date' ) : '';
                    $time = ($time) ? ' | ' . $this->dateFormat->formating_Date_Language( get_field('eckdaten', $event->ID )['time'], 'time' ) : '';
                    $this->output .= '<p class="secondary-txt">' . esc_attr( $date ) . esc_attr( $time ) . '</p>';

               }
               

               $introtext = get_field( 'content', $event->ID );
               
               $introtext = str_replace( '<h3>', '<b>', $introtext ); 
               $introtext = str_replace( '</h3>', '</b><br />', $introtext ); 
               $introtext = str_replace( '<i>', '', $introtext ); 
               $introtext = str_replace( '</i>', '', $introtext ); 
               $tagEliminations = array("<p>", "</p>", '<div>', '</div>');
               $introtext = str_replace( $tagEliminations, '', $introtext ); 
               $introtext_length = strpos( $introtext , '.', 200 ) + 1;
               $this->output .= '<p>' . substr( $introtext, 0, $introtext_length ) . ' <span class="secondary-txt">' . __(' ... mehr', 'SimplEvent') . '</span></p>';

               $this->output .= '</div>';
               $this->output .= '</div>';
          }

          return $this->output;
     }


     //LIGHTBOX
     public function call_Event_Lightbox( $ID ){
          intval($ID);
          $this->output = '<div class="se2-post-lightbox">'; 
          

          //HEADER
          if(get_field('keyvisual', $ID )){
               $this->output .= '<div class="se2-post-lb-header" style="background-image:url('. esc_url( get_field('keyvisual', $ID ) ) .');"></div>';
          } else {
               $this->output .= '<div class="se2-post-lb-header" style="background-image:url('. esc_url( get_field('media', $ID)['gallery'][0] ) .');"></div>';
          }
          

          //GALLERY
          /* if( count(get_field('media', $ID)['gallery']) > 0 ) {
               $this->output .= '<div class="se2-post-lb-gallery">';
               foreach( get_field('media', $ID)['gallery'] as $key => $galleryIMG ) {
                    $this->output .= '<img src="' . esc_url($galleryIMG) . '" alt="' . esc_attr( get_field( 'titel', $ID ) ) . '_' . $key . '">';
               }
               $this->output .= '</div>';
          } */
          
          $this->output .= '<div class="se2-post-lb-content">';

          $this->output .= '<div class="se2-post-lb-info">';

               $this->output .= '<div class="se2-post-lb-info-left">';
                    $this->output .= '<h2>'.esc_attr(get_field('titel', $ID)).'</h2>';

                   
                    $this->output .= get_field('content', $ID);
               $this->output .= '</div>';

               $this->output .= '<div class="se2-post-lb-info-right">';
                    $this->output .= '<table class="se2-post-lb-fact-table">';
                    $facts = get_field('eckdaten', $ID);
                    if($facts['date']){ 
                         $this->output .= '<tr>';
                         $this->output .= '<td>' . __( 'Datum', 'SimplEvent' ) . '</td>';
                         $this->output .= '<td>';
                         $this->output .=  $this->dateFormat->formating_Date_Language( $facts['date'], 'date' ) ; 
                         $this->output .= '</td>';
                         $this->output .= '</tr>';
                    }
                    if($facts['time']){ 
                         $this->output .= '<tr>';
                         $this->output .= '<td>' . __( 'Zeit', 'SimplEvent' ) . '</td>';
                         $this->output .= '<td>';
                         $this->output .=  $this->dateFormat->formating_Date_Language( $facts['time'], 'time' ) ; 
                         $this->output .= '</td>';
                         $this->output .= '</tr>';
                    }
                    if($facts['location']){ 
                         $this->output .= '<tr>';
                         $this->output .= '<td>' . __( 'Ort', 'SimplEvent' ) . '</td>';
                         $this->output .= '<td>';
                         $this->output .= esc_html__( $facts['location'] ); 
                         $this->output .= '</td>';
                         $this->output .= '</tr>';
                    }
                    if($facts['price']){ 
                         $this->output .= '<tr>';
                         $this->output .= '<td>' . __( 'Preis', 'SimplEvent' ) . '</td>';
                         $this->output .= '<td>';
                         $this->output .= esc_html__( $facts['price'] ); 
                         $this->output .= '</td>';
                         $this->output .= '</tr>';
                    }
                    if($facts['anmeldelink']){ 
                         $this->output .= '<tr>';
                         $this->output .= '<td>' . __( 'Anmeldung', 'SimplEvent' ) . '</td>';
                         $this->output .= '<td class="se2-post-lb-register">';
                         $this->output .= '<a href="'.esc_url( $facts['anmeldelink']['url'] ).'" target="_blank"><div>'.esc_attr( $facts['anmeldelink']['title'] ).'</div></a>'; 
                         $this->output .= '</td>';
                         $this->output .= '</tr>';
                    }
                    $this->output .= '</table>';
               $this->output .= '</div>';

          $this->output .= '</div>';

          if(get_field('speaker', $ID)){
                  
               $this->output .= '<div class="session-lb-speakers session-stagger">';

               foreach(get_field('speaker', $ID) as $eventspeaker){
                
                         $this->output .= $this->speakerFunctions->cast_speaker_list($eventspeaker, true);
                    
               }
               $this->output .= '</div>';
          }

          if( is_array( get_field('media', $ID)['gallery'] ) ) {
               $this->output .= '<div class="gallery-splide">';
               $this->output .= '<h3>'.__('Fotos', 'SimplEvent').'</h3>';
               $this->output .= '<div class="gallery-splide-main splide" >';
               $this->output .= '<div class="splide__track"><ul class="splide__list">';
                    foreach (get_field('media', $ID)['gallery'] as $key => $foto) {
                         $this->output .= '<li class="splide__slide">';
                         $this->output .= '<div style="background-image: url('.esc_url($foto).')"></div>';
                         $this->output .= '</li>';
                    }
               $this->output .= '</ul></div>';
               $this->output .= '</div>';

               $this->output .= '<div class="gallery-splide-thumb splide" >';
               $this->output .= '<div class="splide__track"><ul class="splide__list">';
                    foreach (get_field('media', $ID)['gallery'] as $key => $foto) {
                         $this->output .= '<li class="splide__slide">';
                         $this->output .= '<img src="'.esc_url($foto).'" />';
                         $this->output .= '</li>';
                    }
                    $this->output .= '</ul></div>';
               $this->output .= '</div>';
               $this->output .= '</div>';
          }

          $this->output .= '</div>';
          
          $this->output .= '</div>';
          return $this->output;
     }

     //CATEGORIE: YEARS
     function call_Events_Categories( $type = false ){
          $result = '';
          $this->eventData = parent::call_Post_Data('event');

          //YEAR
          if($type === 'year'){
               
               $years = array();
               foreach( $this->eventData->posts as $event ){
                    
                    $year = date( 'Y', strtotime( get_field('eckdaten', $event->ID )['date'] ) );
                    
                    if(intval($year) < 2017){
                         continue;
                    }
                    if( !in_array( $year, $years ) ) {
                         array_push( $years, $year);
                         arsort($years);
                    }
               }
               
               foreach($years as $y){
                    $result .= '<span year="' . $y . '">' . $y . '</span>';
               }
         
          }

          return $result;
         
     }

     function formating_Date_Language( $value, $type ){

          if( $type === 'time' ){
               //TIME
               $time = '';
               switch (ICL_LANGUAGE_CODE) {
                    case 'de':
                         $time = date( 'H:i', $value ) . ' Uhr';
                         break;
                    case 'en':
                         $time = date( 'h:i a', $value );
                         break;
                    case 'fr':
                         $time = date( 'h\hi a', $value );
                         break;
                    default:
                         $time = date( 'h:i a', $value );
                         break;
               }   
               return $time;
          } else if( $type === 'date' ) {
               //DATE
               $date = '';
               switch (ICL_LANGUAGE_CODE) {
                    case 'de':
                         $date = date( 'j. n. y', $value );
                         break;
                    case 'en':
                         $date = date( 'j M Y', $value );
                         break;
                    case 'fr':
                         $date = date( 'j m Y', $value );
                         break;
                    default:
                         $date = date( 'j M Y', $value );
                         break;
               }   
               return $date;
          }
     }

}