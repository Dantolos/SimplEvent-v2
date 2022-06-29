<?php 

class Sessions {

     public $sessionLightbox;
     public $speakerFunctions;
     public $dateFormat;
     public $lineup;

     public function __construct() {
          $this->dateFormat = new Date_Format;
          $this->speakerFunctions = new LineUp;
          
     }

     public function cast_session_grid($pageID){
          $sessionGrid = '';
         
          $sessionSlots = get_field( 'slots', $pageID );
          $sessionJahr = get_field( 'jahr', $pageID );
          $sessionsPerSlot = [];
          
          foreach($sessionSlots['slot'] as $sessionSlot ){
               
               
               $sessionsArgs = array(
                    'numberposts'	=> -1,
                    'post_type'	=> 'sessions',
                    'meta_query'	=> array(
                         'relation' => 'AND',
                         array(
                              'key'	 	=> 'slot',
                              'value'	  	=> $sessionSlot['value'],
                              'compare' 	=> 'LIKE',
                         ), 
                         array(
                              'taxonomy' => 'jahr',
                              'field'    => 'slug',
                              'terms'    => $sessionJahr->slug,
                         ), 
                    )
               );
               $sessions = new WP_Query( $sessionsArgs );

               $sessionsPerSlot[$sessionSlot['value']] = [
                    'slot' => $sessionSlot['label'],
                    'sessions' => $sessions->posts,
               ];
          }
          
          $sessionGrid .= '<div class="session-grid-container">';
          if( $sessionsPerSlot > 0 ){
               $sessionGrid .= '<div class="session-slot-container">';
               foreach( $sessionsPerSlot as $key => $Slot ){
                    
                    if( count($Slot['sessions']) > 0 ){

                         $sessionGrid .= '<h3 class="session-slot-title ">'.$Slot['slot'].'</h3>';

                         if(get_option('sessions_slots')){
                              foreach (get_option('sessions_slots') as $key => $slotInfo ) {

                                   $sessionGrid .= '<div class="session-slot-facts">';
                                   
                                   if( $Slot['slot'] === $slotInfo['value'] ){
                                        $sessionGrid .= '<h6><b style="text-transform:uppercase;">' . $slotInfo['label'] . '</b> | ' ;
                                        $sessionGrid .= $this->dateFormat->formating_Date_Language( $slotInfo['date'], 'date' );
                                        
                                        if( strlen( $this->dateFormat->formating_Date_Language( $slotInfo['start'], 'time' ) ) > 0 ){
                                             $sessionGrid .= ' | ';
                                             $sessionGrid .= str_replace( 'Uhr', '', $this->dateFormat->formating_Date_Language( $slotInfo['start'], 'time' ) );
                                             $sessionGrid .= ' ' . __( 'bis', 'SimplEvent') . ' ';
                                             $sessionGrid .= $this->dateFormat->formating_Date_Language( $slotInfo['ende'], 'time' );
                                        }
                                        $sessionGrid .= '</h6>';
                                   }
                                   $sessionGrid .= '</div>';
                              }
                         }

                         $sessionGrid .= '<div class="session-blocks-container">';   
                         
                         foreach( $Slot['sessions'] as $session ){

                              //check year
                              if( get_the_terms( $session->ID, 'jahr' )[0]->slug !== $sessionJahr->slug) { 
                                   continue;   
                              } 

                              $sessionGrid .= $this->cast_session_block( $session->ID );
                         }
                         $sessionGrid .= '</div>';
                    }
               };
               $sessionGrid .= '</div>';
          }
          $sessionGrid .= '</div>';

          return $sessionGrid;
     }

     public function cast_session_block($sessionID){
          $sessionBlock = '';
          
         
         
          $sessionBlock .= '<section class="session-block schedule-session" sessionid="'.$sessionID.'">';
               //HEADER
               $sessionBlock .= '<div class="session-block-header">';
               $sessionBlock .= '<div class="session-block-header-image"><div style="background-image:url('.get_field('session_bild', $sessionID).');"></div></div>';
                    //SPONSOR
                    $sponsored = get_field('sponsored', $sessionID) ?: false;
                    if( is_array( $sponsored['sponsors'] ) ){
                         $sponsorWidth = count($sponsored['sponsors'])*100;
                         $sessionBlock .= '<div class="session-block-sponsors" style="width:'.$sponsorWidth.'px;" >';
                         $sessionBlock .= '<h6>'.$sponsored['sponsor_titel'].'</h6>';
                         foreach ($sponsored['sponsors'] as $key => $sponsor) {
                              $sessionBlock .= '<div class="session-block-sponsor" >';
                              switch ($sponsor['type']) {
                                   case 'Partner':
                                        $partnerID = $sponsor['partner'];
                                        $sessionBlock .= '<img src="'.get_field('partner-logo', $partnerID).'" title="'.get_the_title($partnerID).'" />';
                                        break;
                                   case 'Specific':
                                        $sessionBlock .= '<img src="'.$sponsor['logo'].'" title="'.$sponsor['sponsor_name'].'" />';
                                        break;
                                   default:
                                        $sessionBlock .= 'please select sponsor type';
                                        break;
                              }
                              $sessionBlock .= '</div>';
                         }
                         $sessionBlock .= '</div>';
                    }
                    
               $sessionBlock .= '</div>';

               //CONTENT
               $sessionBlock .= '<div class="session-block-content">';
              


               $sessionBlock .= '<h4>'.get_field('titel', $sessionID).'</h4>';

               $sessionText = get_field('session_text', $sessionID);
               $sessionEx = str_replace( '<h3>', '<b>', $sessionText ); 
               $sessionEx = str_replace( '</h3>', '</b><br />', $sessionEx ); 
               $sessionEx = str_replace( '<i>', '', $sessionEx ); 
               $sessionEx = str_replace( '</i>', '', $sessionEx ); 
               $tagEliminations = array("<p>", "</p>", '<div>', '</div>');
               $sessionEx = str_replace( $tagEliminations, '', $sessionEx ); 
               $sessionEx_length = (str_contains( $sessionEx , '.' )) ? strpos( $sessionEx , '.', 150 ) + 1 : 1;
               $sessionBlock .= '<p>'.substr( $sessionEx, 0, $sessionEx_length ).' <span class="primary-txt"> ...more</span></p>';

               //SPEAKERS
               if(get_field('referenten', $sessionID)){

                    $this->lineup = new LineUp;
                    $speakers = get_field('referenten', $sessionID);
                    $sessionBlock .= $this->lineup->cast_speaker_tag_cloud( $speakers );

               }
               

               $sessionBlock .= '</div>';

          $sessionBlock .= '</section>';
          return $sessionBlock;
     }

     public function cast_session_lightbox( $sessionID ){
          $this->sessionLightbox = '<div class="session-lb-container">';

               $this->sessionLightbox .= '<div class="session-lb-head">';
                    $this->sessionLightbox .= '<div class="session-lb-image session-stagger" style="background-image:url('.get_field('session_bild', $sessionID ).');"></div>';

                    $this->sessionLightbox .= '<div class="session-lb-content session-stagger">';
                         $this->sessionLightbox .= '<h3>'.get_field('titel', $sessionID).'</h3>';
                         $this->sessionLightbox .= '<p>'.get_field('session_text', $sessionID).'</p>';

                         //SPEAKERS
                         if(get_field('referenten', $sessionID)){
                  
                              $this->sessionLightbox .= '<div class="session-lb-speakers session-stagger">';

                              foreach(get_field('referenten', $sessionID) as $sessionSpeaker){
                                   if($sessionSpeaker['type'] === 'Speaker'){
                                        $this->sessionLightbox .= $this->speakerFunctions->cast_speaker_list($sessionSpeaker['speaker'], true);
                                   }
                              }
                              $this->sessionLightbox .= '</div>';
                         }

                         //SPEAKERS
                         if(get_field('sponsored', $sessionID)['sponsors']){
                  
                              $this->sessionLightbox .= '<div class="session-lb-sponsors session-stagger">';
                              $this->sessionLightbox .= '<h6>'.get_field('sponsored', $sessionID)['sponsor_titel'].'</h6>';
                              foreach(get_field('sponsored', $sessionID)['sponsors'] as $sessionSponsor){
                                   if($sessionSponsor['type'] === 'Partner'){
                                        $this->sessionLightbox .= '<div class="session-lb-sponsor session-stagger">';
                                        $this->sessionLightbox .= '<img src="'. get_field('partner-logo', $sessionSponsor['partner'] ) .'" alt="">'; 
                                        $this->sessionLightbox .= '</div>';             
                                   }
                                   if($sessionSponsor['type'] === 'Specific'){
                                        $this->sessionLightbox .= '<div class="session-lb-sponsor session-stagger">';
                                        $this->sessionLightbox .= '<img src="'. $sessionSponsor['logo'].'" alt="">'; 
                                        $this->sessionLightbox .= '</div>';             
                                   }
                              }
                              $this->sessionLightbox .= '</div>';
                         }


                    $this->sessionLightbox .= '</div>';

               $this->sessionLightbox .= '</div>';

          $this->sessionLightbox .= '</div>';

          return $this->sessionLightbox;
     }

}

?>