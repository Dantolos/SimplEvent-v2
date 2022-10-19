<?php


class se2_Schedule {

     public $output;
     public $dateFormat;
     public $scheduleGrid;
     public $dateArray = array();
     public $activeDay;
     public $view;
     public $viewClass = 'schedule-slot';
     public $year = '2021';

     function __construct( $pageID ) {
          $this->view = get_field( 'ansicht', $pageID );
          switch ( $this->view ) {
               case 'kalender':
                    $this->viewClass = '-kalender';
                    break;
               case 'liste':
                    $this->viewClass = '-liste';
                    break;
               default:
                    $this->viewClass = '';
                    break;
          }

          $this->year = get_field('jahr', $pageID)->slug;

          $this->dateFormat = new \se2\support\Date_Format;
           
          $this->dateArray = array();

          //set Date-Menu to change programm date
          if( !get_field('side_programm', $pageID)){
               $this->dateArray = $this->dateFormat->date_range(get_option( 'facts_date' )['from'], get_option( 'facts_date' )['to'], "+1 day" );
               $this->activeDay = $this->dateArray[0];
          } else {
               foreach( get_field( 'event_tag', $pageID ) as $key => $programmday ){
                    $this->dateArray[$key] = strtotime(str_replace( '/', '-', $programmday['datum'] ));
               }
          }

          if(count($this->dateArray) > 1){
               
               $this->scheduleGrid .= '<div id="daytabs" class="schedule-days-tabs">';
               foreach($this->dateArray as $day){

                    //change activeDay if the current reallife date matches programm date
                    if( $day === strtotime(date('Y/m/d')) ){
                         $this->activeDay = $day;
                    }
                    $beautyDay = date( 'l | j. F. Y', $day  );      
                    $checkclass = ( $this->activeDay === $day ) ? 'day-tab-activ' : 'day-tab-passiv';
                    $this->scheduleGrid .= '<button class="'.$checkclass.'" value="'.$day.'" day="'.$day.'">'.$beautyDay.'</button>';
               }
               $this->scheduleGrid .= '</div>';
          }

          //build up schedule Grid
          if( get_field( 'ansicht', $pageID ) === 'kalender' ){
               $this->scheduleGrid .= $this->schedule_Grid();
          }

          //implement needed programm slots
          $this->scheduleGrid .= '<div class="schedule-program'.$this->viewClass.'">';

          foreach($this->dateArray as $day){
               $checkclass = ($this->activeDay === $day ) ? 'day-schedule-activ' : 'day-schedule-passiv';
               $this->scheduleGrid .= '<div class="schedule-program-day '.$checkclass.'" day="'.$day.'">';
              
               $this->scheduleGrid .= $this->get_speaker($day);
               $this->scheduleGrid .= $this->get_sessions($day);
               $this->scheduleGrid .= $this->get_separators( $pageID, $day);
               $this->scheduleGrid .= '</div>';
               
          }
          $this->scheduleGrid .= '</div>';
          
     }


     //*************************************************/
     //***********GRID********** */
     public function schedule_Grid(){
          $ScheduleGrid = '<div class="schedule-grid" id="schedule-timeline">';

          for ($i=5; $i < 20; $i++) { 
               
               $hour = '1000-01-30-' . ($i + 1);
               $timestamp = date( 'Hi', strtotime( str_replace( '/', '-',  $hour) ) );
               $ScheduleGrid .= '<div class="schedule-hour">';           
               $ScheduleGrid .= '<h5>'.$this->dateFormat->formating_Date_Language( $hour, 'time' ).'</h5>';

               for ($e=0; $e < 12; $e++) { 
                    $addtime = $e * 5;
                    $currstamp = date('Hi',strtotime($timestamp." +".$addtime." minutes"));
                    $ScheduleGrid .= '<div class="schedule-5min" timestamp="' . $currstamp . '"></div>';
               }
               $ScheduleGrid .= '</div>';
          }       

          $ScheduleGrid .= '</div>';
          return $ScheduleGrid;
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

               $speaker_slots .= '<div class="schedule-slot'.$this->viewClass.' schedule-speaker" start="'.$start.'" dur="'.$duration.'" ende="'.$ende.'" date="'.$speakerDate.'" data-speakerid="'.$speakerID.'">';

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
                              $progtitel = get_field('programm_titel', $speakerID) ? get_field('programm_titel', $speakerID) : false;
                                   $speaker_slots .= '<div class="schedule-slot-speaker-name">';
                                        if($progtitel){
                                             $speaker_slots .= '<h5 class="schedule-slot-title"><b>'.$progtitel.'</b></h5>'; 
                                        }
                                        $speaker_slots .= '<h4>'.$name.'</h4>';
                                        $speakerFirma = (get_field( 'speaker_firma', $speakerID )) ? ', '.get_field( 'speaker_firma', $speakerID ) : '';
                                        $speaker_slots .= '<h6>'.get_field( 'speaker_funktion', $speakerID ).$speakerFirma.'</h6>';

                                        //on hover
                                        $speaker_slots .= '<div class="schedule-slot-info">';
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

               if(isset($sessionSlot['date'])){
                    $slotDate = strtotime( str_replace( '/', '-', $sessionSlot['date'] ) );
                    if( $slotDate !== $day ){
                         continue; 
                    }
               }
          
               $timestamps = $this->set_start_duration_end_timestampts( $sessionSlot['start'], $sessionSlot['ende'] );

               $sessions_slots .= '<div class="schedule-slot'.$this->viewClass.' schedule-session-slot" start="'.$timestamps['start'].'" dur="'.$timestamps['duration'].'" ende="'.$timestamps['ende'].'" date="'.$slotDate.'">';
                    $sessions_slots .= '<div class="schedule-container">';
                         
                         $sessions_slots .= $this->slot_time( $sessionSlot['start'], $sessionSlot['ende'] );
                         $sessions_slots .= '<h5>'.$sessionSlot['value'].'</h5>';

                         //SESSIONS
                         $sessions_slots .= '<div class="schedule-sessions ">';
                         foreach($sessions->posts as $session){

                              if( get_the_terms( $session->ID, 'jahr' )[0]->slug !== $this->year ) { 
                                   continue;   
                              } 

                              $sessionID = $session->ID;
                              $sessions_slots .= '<div class="schedule-session" sessionid="'.$sessionID.'">';
                              $sessions_slots .= '<div class="schedule-session-image" style="background-image:url('.get_field('session_bild', $sessionID ).');"></div>';
                              $sessions_slots .= '<h6>'.get_field('titel', $sessionID).'</h6>';
                              $sessions_slots .= '</div>';
                         }
                         $sessions_slots .= '</div>';

                         //hidden
                         $sessions_slots .= '<div class="schedule-slot-info">';
                         $sessions_slots .= '</div>';

                    $sessions_slots .= '</div>';

                    //more overflow
                    /* $sessions_slots .= '<div class="schedule-slot-overflow">';
                    $sessions_slots .= '<p><b>more</b></p>';
                    $sessions_slots .= '</div>'; */

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
              
                    if( empty((string) $sep['start']) || empty((string) $sep['ende']) ){
                         continue;
                    }

                    $linkedSep = false;
                    $is_linked = '';
                    if( array_key_exists( 'link', $sep ) ){
                         if( is_array( $sep['link'] ) ){
                              $linkedSep = true;
                              $is_linked = 'is-linked';
                         }
                    }

                    if( $linkedSep ){ $separators_slots .= '<a href="'.$sep['link']['url'].'" target="_blank" title="'.$sep['link']['title'].'">'; }

                         // STANDARD LAYOUT
                         if($sep['acf_fc_layout'] === 'standard'){
                              $timestamps = $this->set_start_duration_end_timestampts( $sep['start'], $sep['ende'] );
                              $separators_slots .= '<div class="schedule-slot'.$this->viewClass.' '.$is_linked.' schedule-separator-standard" start="'.$timestamps['start'].'" dur="'.$timestamps['duration'].'" ende="'.$timestamps['ende'].'" date="'.$separatorDate.'">';
                                   $separators_slots .= '<div class="schedule-container">';
                                   $separators_slots .= $this->slot_time( $sep['start'], $sep['ende'] );
                                   $separators_slots .= '<div class="schedule-std-content">';
                                   $separators_slots .= '<h5>'.$sep['bezeichnung'].'</h5>';
                                   if($sep['lead']){
                                        $separators_slots .= '<p>'.$sep['lead'].'</p>';
                                   }
                                   $separators_slots .= '</div>';
                                   $separators_slots .= '</div>';
                              $separators_slots .= '</div>'; 
                         }

                         // STANDARD FILLER
                         if($sep['acf_fc_layout'] === 'filler'){
                              $timestamps = $this->set_start_duration_end_timestampts( $sep['start'], $sep['ende'] );
                              $separators_slots .= '<div class="schedule-slot'.$this->viewClass.' '.$is_linked.' schedule-separator-filler" start="'.$timestamps['start'].'" dur="'.$timestamps['duration'].'" ende="'.$timestamps['ende'].'" date="'.$separatorDate.'">';
                                   $separators_slots .= '<div class="schedule-container">';
                                   $separators_slots .= $this->slot_time( $sep['start'], $sep['ende'] );
                                   $separators_slots .= '<div class="schedule-std-content">';
                                        $separators_slots .= '<h5>'.$sep['bezeichnung'].'</h5>';
                                        if($sep['lead']){
                                             $separators_slots .= '<p>'.$sep['lead'].'</p>';
                                        }
                                        $separators_slots .= '</div>';
                                   $separators_slots .= '</div>';
                              $separators_slots .= '</div>';
                         }

                         // STANDARD PLACEHOLDER
                         if($sep['acf_fc_layout'] === 'placeholder'){
                              $timestamps = $this->set_start_duration_end_timestampts( $sep['start'], $sep['ende'] );
                              $separators_slots .= '<div class="schedule-slot'.$this->viewClass.' '.$is_linked.' schedule-separator-placeholder" start="'.$timestamps['start'].'" dur="'.$timestamps['duration'].'" ende="'.$timestamps['ende'].'" date="'.$separatorDate.'">';
                                   $separators_slots .= '<div class="schedule-container">';
                                   $separators_slots .= $this->slot_time( $sep['start'], $sep['ende'] );
                                   $separators_slots .= '<div class="schedule-std-content">';
                                        $separators_slots .= '<h5>'.$sep['bezeichnung'].'</h5>';
                                        if($sep['lead']){
                                             $separators_slots .= '<p>'.$sep['lead'].'</p>';
                                        }
                                        $separators_slots .= '</div>';
                                   $separators_slots .= '</div>';
                              $separators_slots .= '</div>';
                         }

                         // SHOW
                         if($sep['acf_fc_layout'] === 'show'){
                              $timestamps = $this->set_start_duration_end_timestampts( $sep['start'], $sep['ende'] );
                              $separators_slots .= '<div class="schedule-slot'.$this->viewClass.' '.$is_linked.' schedule-separator-show" start="'.$timestamps['start'].'" dur="'.$timestamps['duration'].'" ende="'.$timestamps['ende'].'" date="'.$separatorDate.'">';
                                   $separators_slots .= '<div class="schedule-container">';
                                   $separators_slots .= $this->slot_time( $sep['start'], $sep['ende'] );
                                   $separators_slots .= '<div class="schedule-std-content">';
                                        $separators_slots .= '<h5>'.$sep['bezeichnung'].'</h5>';
                                        if($sep['lead']){
                                             $separators_slots .= '<p>'.$sep['lead'].'</p>';
                                        }
                                        $separators_slots .= '</div>';
                                   $separators_slots .= '</div>';
                              $separators_slots .= '</div>';
                         }

                         // STANDARD PANEL
                         if($sep['acf_fc_layout'] === 'panel'){
                              $timestamps = $this->set_start_duration_end_timestampts( $sep['start'], $sep['ende'] );
                              $separators_slots .= '<div class="schedule-slot'.$this->viewClass.' '.$is_linked.' schedule-separator-panel" start="'.$timestamps['start'].'" dur="'.$timestamps['duration'].'" ende="'.$timestamps['ende'].'" date="'.$separatorDate.'">';
                                   $separators_slots .= '<div class="schedule-container">';
                                   $separators_slots .= $this->slot_time( $sep['start'], $sep['ende'] );
                                   $separators_slots .= '<h5>'.$sep['bezeichnung'].'</h5>';
                                   if($sep['lead']){
                                        $separators_slots .= '<p>'.$sep['lead'].'</p>';
                                   }
                                        $separators_slots .= '<div class="schedule-slot-panel-speakers">';
                                        if($sep['speaker'] > 0){
                                             foreach((array) $sep['speaker'] as $panelSpeaker ){
                                             
                                                  $separators_slots .= '<div class="schedule-slot-panel-speaker" data-speakerid="'. $panelSpeaker .'">';
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
                                                            $speakerFirma = (get_field( 'speaker_firma', $panelSpeaker )) ? ', '.get_field( 'speaker_firma', $panelSpeaker ) : '';
                                                                 $separators_slots .= '<h6>'.get_field( 'speaker_funktion', $panelSpeaker ).$speakerFirma.'</h6>';
                                                            $separators_slots .= '<div class="schedule-slot-info">';
                                                                 
                                                            $separators_slots .= '</div>';
                                                       $separators_slots .= '</div>';
                                                  $separators_slots .= '</div>';
                                             } 
                                        }
                                        $separators_slots .= '</div>';
                                   $separators_slots .= '<div class="schedule-slot-info">';       
                                   $separators_slots .= '</div>';

                                   $separators_slots .= '</div>';
                              $separators_slots .= '</div>';
                         }

                    if( $linkedSep ){ $separators_slots .= '</a>'; }

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

          switch ($this->view) {
               case 'kalender':
                    $slotTime .= date( 'H:i', strtotime($start) );
                    $slotTime .= ' - ';
                    $slotTime .= date( 'H:i', strtotime($ende) );
                    break;
               case 'liste':
                    $slotTime .= '<p class="hour">'.date( 'H', strtotime($start) ).'</p>';
                    $slotTime .= '<p class="minute">'.date( 'i', strtotime($start) ).'</p>';
                    $slotTime .= '<p class="till">'.date( 'H:i', strtotime($ende) ).'</p>';
                    break;
               default:
                    $slotTime .= date( 'H:i', strtotime($start) );
                    $slotTime .= ' - ';
                    $slotTime .= date( 'H:i', strtotime($ende) );
                    break;
          }

          $slotTime .= '</div>';
          return $slotTime;
     }

     public function pdf_download($pageID){
          $this->create_session($pageID);
          
          $pdfDownload = '';

          $pdfDownload .= '<div  class="pdf-download">';
          $pdfDownload .= '<div class="pdf-download-desc">'.__('Download the Programm as PDF', 'SimplEvent').'</div>';
  
          $pdf_link = '';
          if(get_field('programm_pdf', $pageID)){
               $pdf_link = get_field('programm_pdf', $pageID);
          }else{ 
               $pdf_link = get_template_directory_uri() .'/inc/addons/tcpdf/programm_download.php';
          }
          $pdfDownload .= '<a href="'. $pdf_link .'" ><div class="pdf-button">DOWNLOAD</div></a>';
          $pdfDownload .= '</div>';
        
          return $pdfDownload;
     }

     private function create_session($pageID){

          $clean_data = array();

          //split schedule in days
          if( get_field('event_tag', $pageID)){
               foreach( get_field( 'event_tag', $pageID ) as $key => $programmday ){
                    $clean_data[$programmday['datum']] = array();
                    
                    //add speakers
                    $speakers = array();
                    $speakers = $this->session_speaker_data( $pageID, $programmday['datum'] );
                    if( count($speakers) > 0 ){
                         foreach( $speakers as $start => $speaker ){
                              $clean_data[$programmday['datum']][$start] = $speaker;
                         }
                    }

                    //add sessions
                    $sessions = array(); 
                    $sessions = $this->session_session_data($pageID, $programmday['datum']);
                    if(isset($sessions)){
                         if( count($sessions) > 0 ){
                              foreach( $sessions as $start => $session ){
                                   $clean_data[$programmday['datum']][$start] = $session;
                              }
                         }
                    }
                    //get programm slots
                    if( isset( $programmday['programm_slots'] ) && count( $programmday['programm_slots'] ) > 0 ){
                         foreach( $programmday['programm_slots'] as $key => $slot ){
                              $clean_data[$programmday['datum']][$slot['start']] = $slot;

                              
                              //add panel speaker data
                              if( $slot['acf_fc_layout'] === 'panel' ){
                                   foreach( $slot['speaker'] as $speaker_ID ){
                                        
                                        $speaker_name = '';
                                        if(get_field('speaker_degree', $speaker_ID)){ $speaker_name .= get_field('speaker_degree', $speaker_ID) . ' '; }
                                        if(get_field('speaker_vorname', $speaker_ID)){ $speaker_name .= get_field('speaker_vorname', $speaker_ID); }
                                        if(get_field('speaker_nachname', $speaker_ID)){ $speaker_name .= ' ' . get_field('speaker_nachname', $speaker_ID); }

                                        $speaker_funktion = '';
                                        if(get_field('speaker_funktion', $speaker_ID) && get_field('speaker_firma', $speaker_ID)){ 
                                             $speaker_funktion .= get_field('speaker_funktion', $speaker_ID) . ', ' . get_field('speaker_firma', $speaker_ID); 
                                        } else {
                                             $speaker_funktion .= get_field('speaker_firma', $speaker_ID);
                                        }
                                        
                                        $speaker_image = get_field('speaker_bild', $speaker_ID);

                                        $speaker_data = array(
                                             'name' =>  $speaker_name,
                                             'funktion' => $speaker_funktion,
                                             'image' => $speaker_image
                                        );
                                        $clean_data[$programmday['datum']][$slot['start']]['speakers'][$speaker_ID] = $speaker_data;
                                   }
                              }
                         }
                    }
               }
          }

          foreach($clean_data as $key => $day_data){
               ksort( $day_data );
               $clean_data[$key] = $day_data;
          } 
          $_SESSION['programm'] = $clean_data;

          $_SESSION['general'] = $this->session_general_infos($pageID);

     }

     private function session_speaker_data($pageID, $date){

          $speaker_data_output = array();
          $args = array(
               'post_type' => 'speakers', 
               'tax_query' => array(
                   array(
                       'taxonomy' => 'jahr',
                       'field'    => 'slug',
                       'terms'    => get_field('jahr', $pageID)->slug,
                   ),
               ),
          );

          $speakers = new WP_Query( $args );

          foreach( $speakers->posts as $key => $speaker ){

               $speaker_ID = $speaker->ID;
               $speakerDate = strtotime( str_replace( '/', '-',  get_field('speaker_zeit', $speaker_ID)['datum'] ) );
               if( get_field('speaker_zeit', $speaker_ID)['hide'] ){
                    continue;
               }
               if( get_field('speaker_zeit', $speaker_ID)['datum'] != intval($date) ){
                    continue;
               }
               
               $start_time = str_split( get_field('speaker_zeit', $speaker_ID)['start'], 5 )[0];
               $end_time = str_split( get_field('speaker_zeit', $speaker_ID)['ende'], 5 )[0];

               $speaker_name = '';
               if(get_field('speaker_degree', $speaker_ID)){ $speaker_name .= get_field('speaker_degree', $speaker_ID) . ' '; }
               if(get_field('speaker_vorname', $speaker_ID)){ $speaker_name .= get_field('speaker_vorname', $speaker_ID); }
               if(get_field('speaker_nachname', $speaker_ID)){ $speaker_name .= ' ' . get_field('speaker_nachname', $speaker_ID); }


               $speaker_funktion = '';
               if(get_field('speaker_funktion', $speaker_ID) && get_field('speaker_firma', $speaker_ID)){ 
                    $speaker_funktion .= get_field('speaker_funktion', $speaker_ID) . ', ' . get_field('speaker_firma', $speaker_ID); 
               } else {
                    $speaker_funktion .= get_field('speaker_firma', $speaker_ID);
               }

               $speaker_image = get_field('speaker_bild', $speaker_ID);

               $speaker_lead = get_field('programm_titel', $speaker_ID);

               $speaker_data_output[$start_time] = array(
                    'acf_fc_layout' => 'speaker',
                    'start' => $start_time,
                    'ende' => $end_time,
                    'name' => $speaker_name,
                    'funktion' => $speaker_funktion,
                    'image' => $speaker_image,
                    'lead' => $speaker_lead
               );

          }

          return $speaker_data_output;

         
     }

     private function session_session_data($padeID, $date) {

          $session_data_output = array();

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
                            
               if(isset($sessionSlot['date'])){
                    $slotDate = str_replace( '-', '/', $sessionSlot['date']  );
                    if( $slotDate !== $date ){
                         continue; 
                    }
               }
               $session_name = $sessionSlot['value'];

               $insertstr = ':';
               $start_time = substr($sessionSlot['start'], 0, 2) . $insertstr . substr($sessionSlot['start'], 2);
               $end_time = substr($sessionSlot['ende'], 0, 2) . $insertstr . substr($sessionSlot['ende'], 2);

               $session_data_output[$start_time] = array(
                    'acf_fc_layout' => 'session',
                    'start' => $start_time,
                    'ende' => $end_time,
                    'slot' => $session_name
               );

               foreach( $sessions->posts as $session ){
                    $session_ID = $session->ID;

                    $session_titel = get_field('titel', $session_ID );
                    $session_image = get_field('session_bild', $session_ID );
                    
                    $session_data = array(
                         'titel' => $session_titel,
                         'image' => $session_image,
                    );
                    $session_data_output[$start_time]['sessions'][$session_ID] = $session_data;
               }
          }

          return $session_data_output;
     }
    
     private function session_general_infos($pageID){
          
          $datum = date( 'l | j F Y' );
          $event = get_bloginfo('name');

          $logo = get_option( 'event_logo' );
          $mediacorner_pages = get_pages(array(
               'meta_key' => '_wp_page_template',
               'meta_value' => 'Templates/mediacorner.php'
          ));

          if(array_key_exists(0, $mediacorner_pages)){
               if(get_field('logos', $mediacorner_pages[0]->ID)){          
                    $logo = get_field('logos', $mediacorner_pages[0]->ID)[0]["logo"]['files_rgb']['png'];
               }
          }
     
          $general_infos = array(
               'datum' => $datum,
               'event' => $event,
               'logo'  => $logo
          );

          return $general_infos;
     }

}