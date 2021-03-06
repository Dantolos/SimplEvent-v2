<?php



class se2_Schedule {

     public $output;
     public $dateFormat;
     public $scheduleGrid;
     public $dateArray = array();
     public $activeDay;
     public $year = '2021';

     function __construct( $pageID ) {
       
          
          $this->year = get_field('jahr', $pageID)->slug;

          $this->dateFormat = new Date_Format;


          //set Date-Menu to change programm date
          $this->dateArray = $this->dateFormat->date_range(get_option( 'facts_date' )['from'], get_option( 'facts_date' )['to'], "+1 day" );
          $this->activeDay = $this->dateArray[0];
          

          if(count($this->dateArray) > 1){
               $this->scheduleGrid .= '<div id="daytabs" class="schedule-days-tabs">';
               foreach($this->dateArray as $day){

                    //change activeDay if the current reallife date matches programm date
                    if( $day === strtotime(date('Y/m/d')) ){
                         $this->activeDay = $day;
                    }

                    $beautyDay = date( 'l | j. F. Y', $day  );      
                    $checkclass = ($this->activeDay === $day ) ? 'day-tab-activ' : 'day-tab-passiv';
                    $this->scheduleGrid .= '<button class="'.$checkclass.'" value="'.$day.'" day="'.$day.'">'.$beautyDay.'</button>';
               }
               $this->scheduleGrid .= '</div>';
          }

          

          //build up schedule Grid
          $this->scheduleGrid .= '<div class="schedule-grid" id="schedule-timeline">';

          for ($i=5; $i < 20; $i++) { 

               $hour = '1000-01-30-' . ($i + 1);
               $timestamp = date( 'Hi', strtotime( str_replace( '/', '-',  $hour) ) );
               $this->scheduleGrid .= '<div class="schedule-hour">';           
               $this->scheduleGrid .= '<h5>'.$this->dateFormat->formating_Date_Language( $hour, 'time' ).'</h5>';

               for ($e=0; $e < 12; $e++) { 
                    $addtime = $e * 5;
                    $currstamp = date('Hi',strtotime($timestamp." +".$addtime." minutes"));
                    $this->scheduleGrid .= '<div class="schedule-5min" timestamp="' . $currstamp . '"></div>';
               }
               $this->scheduleGrid .= '</div>';
          }         

          $this->scheduleGrid .= '<div class="schedule-program">';
          //implement needed programm slots
          foreach($this->dateArray as $day){
               $checkclass = ($this->activeDay === $day ) ? 'day-schedule-activ' : 'day-schedule-passiv';

               $this->scheduleGrid .= '<div class="schedule-program-day '.$checkclass.'" day="'.$day.'">';
               $this->scheduleGrid .= $this->get_speaker($day);
               $this->scheduleGrid .= $this->get_sessions($day);
               $this->scheduleGrid .= $this->get_separators( $pageID, $day );
               $this->scheduleGrid .= '</div>';
               
          }
          $this->scheduleGrid .= '</div>';
          $this->scheduleGrid .= '</div>';
     }



     public function programm_slots(){



     }

     // Speaker SLOTS
     // Read Slots out the speakers-posts in the selected year 
     public function get_speaker( $day ){

          $speaker_slots = '';

          $args = array(
               'post_type' => 'speakers', 
               'tax_query' => array(
                   array(
                       'taxonomy' => 'jahr',
                       'field'    => 'slug',
                       'terms'    => $this->year,
                   ),
               ),
          );

          $speakers = new WP_Query( $args );


          foreach( $speakers->posts as $speaker ){

               $speakerID = $speaker->ID;
               $speakerDate = strtotime( str_replace( '/', '-',  get_field('speaker_zeit', $speakerID)['datum'] ) );
               if( get_field('speaker_zeit', $speakerID)['hide'] ){
                    continue;
               }
               if( $speakerDate != intval($day) ){
                    continue;
               }

               $start = date( 'Hi', strtotime(get_field('speaker_zeit', $speakerID)['start']));
               $ende = date( 'Hi', strtotime(get_field('speaker_zeit', $speakerID)['ende']));
               $durationH = date( 'H', strtotime(get_field('speaker_zeit', $speakerID)['ende'])) - date( 'H', strtotime(get_field('speaker_zeit', $speakerID)['start']));
               $durationM = date( 'i', strtotime(get_field('speaker_zeit', $speakerID)['ende'])) - date( 'i', strtotime(get_field('speaker_zeit', $speakerID)['start']));
               $duration = ($durationH * 60) + $durationM;

               $speaker_slots .= '<div class="schedule-slot schedule-speaker" start="'.$start.'" dur="'.$duration.'" ende="'.$ende.'" date="'.$speakerDate.'" speakerid="'.$speakerID.'">';

                    $speaker_slots .= '<div class="schedule-container">';
                         //slot time
                         $speaker_slots .= $this->slot_time( get_field('speaker_zeit', $speakerID)['start'], get_field('speaker_zeit', $speakerID)['ende'] );
                         //slot content
                         $speaker_slots .= '<div class="schedule-slot-speaker-content">';
                              $speaker_slots .= '<div class="schedule-slot-speaker-image" style="background-image:url('.get_field('speaker_bild', $speakerID ).');"></div>';

                              $name = ( get_field('speaker_vorname', $speakerID) ) 
                                   ? 
                                        get_field('speaker_degree', $speakerID) 
                                        . ' ' . get_field('speaker_vorname', $speakerID) 
                                        . ' <b>' . get_field('speaker_nachname', $speakerID) . '</b>'
                                   : 
                                        the_title();

                                   $speaker_slots .= '<div class="schedule-slot-speaker-name">'; 
                                        $speaker_slots .= '<h5>'.$name.'</h5>';
                                        $speaker_slots .= '<div class="schedule-slot-info">';
                                             $speaker_slots .= '<h6>'.get_field( 'speaker_funktion', $speakerID ).'</h6>';
                                        $speaker_slots .= '</div>';
                                   $speaker_slots .= '</div>';

                                   
                                   
                                   
                         $speaker_slots .= '</div>';
                    $speaker_slots .= '</div>';
               $speaker_slots .= '</div>';
          }
          return $speaker_slots;
     }


     // SESSION SLOTS
     // Read Slots out the session-posts in the selected year 
     // Date & Time from SimplEvent -> Event -> Sessions Slots
     public function get_sessions( $day ){

          $sessions_slots = '';
          $sessionSlots = get_option('sessions_slots');
          
        
          foreach($sessionSlots as $sessionSlot ){

               $sessionsArgs = array(
                    'numberposts'	=> -1,
                    'post_type'	=> 'sessions',
                    'meta_query'	=> array(
                         array(
                              'key'	 	=> 'slot',
                              'value'	  	=> sprintf('"%s"', $sessionSlot['label']),
                              'compare' 	=> 'LIKE',
                         ),
                    )
                    
               );
               $sessions = new WP_Query( $sessionsArgs );

               $slotDate = strtotime( str_replace( '/', '-', $sessionSlot['date'] ) );
               if( $slotDate !== $day ){
                    continue;
               }
     
               $timestamps = $this->set_start_duration_end_timestampts( $sessionSlot['start'], $sessionSlot['ende'] );

               $sessions_slots .= '<div class="schedule-slot schedule-session-slot" start="'.$timestamps['start'].'" dur="'.$timestamps['duration'].'" ende="'.$timestamps['ende'].'" date="'.$slotDate.'">';
                    $sessions_slots .= '<div class="schedule-container">';
                         
                         $sessions_slots .= $this->slot_time( $sessionSlot['start'], $sessionSlot['ende'] );
                         $sessions_slots .= '<h5>'.$sessionSlot['value'].'</h5>';

                         //SESSIONS
                         $sessions_slots .= '<div class="schedule-slot-info">';
                         $sessions_slots .= '<div class="schedule-sessions ">';
                         foreach($sessions->posts as $session){
                              $sessionID = $session->ID;
                              $sessions_slots .= '<div class="schedule-session" sessionid="'.$sessionID.'">';
                              $sessions_slots .= '<div class="schedule-session-image" style="background-image:url('.get_field('session_bild', $sessionID ).');"></div>';
                              $sessions_slots .= '<h6>'.get_field('titel', $sessionID).'</h6>';
                              $sessions_slots .= '</div>';
                         }
                         $sessions_slots .= '</div>';
                         $sessions_slots .= '</div>';

                    $sessions_slots .= '</div>';
               $sessions_slots .= '</div>';

          }
 
          return $sessions_slots;

     }

     // SEPARATORS
     // Direct from the Programm-Page addable
     public function get_separators( $pageID, $day ){

          $separators_slots = '';
         
          foreach( get_field( 'event_tag', $pageID ) as  $separatorDay ){
               $separatorDate = strtotime( str_replace( '/', '-', $separatorDay['datum'] ) );
               if( $separatorDate !== $day ){
                    continue;
               }

               $separators = $separatorDay['programm_slots'];
               foreach( $separators as $sep ){
                

                    // STANDARD LAYOUT
                    if($sep['acf_fc_layout'] === 'standard'){
                         $timestamps = $this->set_start_duration_end_timestampts( $sep['start'], $sep['ende'] );
                         $separators_slots .= '<div class="schedule-slot schedule-separator-standard" start="'.$timestamps['start'].'" dur="'.$timestamps['duration'].'" ende="'.$timestamps['ende'].'" date="'.$separatorDate.'">';
                              $separators_slots .= '<div class="schedule-container">';
                              $separators_slots .= $this->slot_time( $sep['start'], $sep['ende'] );
                              $separators_slots .= '<h5>'.$sep['bezeichnung'].'</h5>';
                              $separators_slots .= '</div>';
                         $separators_slots .= '</div>';
                    }

               
                    // STANDARD FILLER
                    if($sep['acf_fc_layout'] === 'filler'){
                         $timestamps = $this->set_start_duration_end_timestampts( $sep['start'], $sep['ende'] );
                         $separators_slots .= '<div class="schedule-slot schedule-separator-filler" start="'.$timestamps['start'].'" dur="'.$timestamps['duration'].'" ende="'.$timestamps['ende'].'" date="'.$separatorDate.'">';
                              $separators_slots .= '<div class="schedule-container">';
                              $separators_slots .= $this->slot_time( $sep['start'], $sep['ende'] );
                              $separators_slots .= '<h5>'.$sep['bezeichnung'].'</h5>';
                              $separators_slots .= '</div>';
                         $separators_slots .= '</div>';
                    }


                    // STANDARD PLACEHOLDER
                    if($sep['acf_fc_layout'] === 'placeholder'){
                         $timestamps = $this->set_start_duration_end_timestampts( $sep['start'], $sep['ende'] );
                         $separators_slots .= '<div class="schedule-slot schedule-separator-placeholder" start="'.$timestamps['start'].'" dur="'.$timestamps['duration'].'" ende="'.$timestamps['ende'].'" date="'.$separatorDate.'">';
                              $separators_slots .= '<div class="schedule-container">';
                              $separators_slots .= $this->slot_time( $sep['start'], $sep['ende'] );
                              $separators_slots .= '<h5>'.$sep['bezeichnung'].'</h5>';
                              $separators_slots .= '</div>';
                         $separators_slots .= '</div>';
                    }

                    // STANDARD SHOW
                    if($sep['acf_fc_layout'] === 'show'){
                         $timestamps = $this->set_start_duration_end_timestampts( $sep['start'], $sep['ende'] );
                         $separators_slots .= '<div class="schedule-slot schedule-separator-show" start="'.$timestamps['start'].'" dur="'.$timestamps['duration'].'" ende="'.$timestamps['ende'].'" date="'.$separatorDate.'">';
                              $separators_slots .= '<div class="schedule-container">';
                              $separators_slots .= $this->slot_time( $sep['start'], $sep['ende'] );
                              $separators_slots .= '<h5>'.$sep['bezeichnung'].'</h5>';
                              $separators_slots .= '</div>';
                         $separators_slots .= '</div>';
                    }

                    // STANDARD PANEL
                    if($sep['acf_fc_layout'] === 'panel'){
                         $timestamps = $this->set_start_duration_end_timestampts( $sep['start'], $sep['ende'] );
                         $separators_slots .= '<div class="schedule-slot schedule-separator-panel" start="'.$timestamps['start'].'" dur="'.$timestamps['duration'].'" ende="'.$timestamps['ende'].'" date="'.$separatorDate.'">';
                              $separators_slots .= '<div class="schedule-container">';
                              $separators_slots .= $this->slot_time( $sep['start'], $sep['ende'] );
                              $separators_slots .= '<h5>'.$sep['bezeichnung'].'</h5>';

                              $separators_slots .= '<div class="schedule-slot-info">';
                                   $separators_slots .= '<div class="schedule-slot-panel-speakers">';
                                   foreach( $sep['speaker'] as $panelSpeaker ){
                                   
                                        $separators_slots .= '<div class="schedule-slot-panel-speaker" speakerid="'. $panelSpeaker .'">';
                                             $separators_slots .= '<div class="schedule-slot-panel-speaker-image" style="background-image:url('.get_field('speaker_bild', $panelSpeaker ).');"></div>';

                                             $name = ( get_field('speaker_vorname', $panelSpeaker) ) 
                                             ? 
                                                  get_field('speaker_degree', $panelSpeaker) 
                                                  . ' ' . get_field('speaker_vorname', $panelSpeaker) 
                                                  . ' <b>' . get_field('speaker_nachname', $panelSpeaker) . '</b>'
                                             : 
                                                  the_title();

                                             $separators_slots .= '<div class="schedule-slot-speaker-name">'; 
                                                  $separators_slots .= '<h5>'.$name.'</h5>';
                                                  $separators_slots .= '<div class="schedule-slot-info">';
                                                       $separators_slots .= '<h6>'.get_field( 'speaker_funktion', $panelSpeaker ).'</h6>';
                                                  $separators_slots .= '</div>';
                                             $separators_slots .= '</div>';
                                        $separators_slots .= '</div>';
                                   } 
                                   $separators_slots .= '</div>';       
                              $separators_slots .= '</div>';

                              $separators_slots .= '</div>';
                         $separators_slots .= '</div>';
                    }


               }
          }
          return $separators_slots;
     }



     public function cast_Schedule(  ) {
          $theOutput = $this->scheduleGrid;
          return $theOutput;
     }


     public function set_start_duration_end_timestampts( $start, $ende ){

          $Tstart = date( 'Hi', strtotime( $start ));
          $Tende = date( 'Hi', strtotime( $ende ));
          $durationH = date( 'H', strtotime($ende)) - date( 'H', strtotime($start));
          $durationM = date( 'i', strtotime($ende)) - date( 'i', strtotime($start));

          $duration = ($durationH * 60) + $durationM;

          $timestamp = [
               'start' => $Tstart,
               'ende'  => $Tende,
               'duration' => $duration
          ];

          return $timestamp;

     }

     public function slot_time( $start, $ende ){
          $slotTime = '<div class="schedule-slot-time">';
               $slotTime .= date( 'H:i', strtotime($start) );
               $slotTime .= ' - ';
               $slotTime .= date( 'H:i', strtotime($ende) );
          $slotTime .= '</div>';
          return $slotTime;
     }

     

}