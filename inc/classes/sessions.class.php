<?php 

class Sessions {

     public $sessionLightbox;
     public $speakerFunctions;

     public function __construct() {
          $this->speakerFunctions = new LineUp;
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