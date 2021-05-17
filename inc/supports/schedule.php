<?php

class se2_Schedule {
     public $output;
     public $dateFormat;

     public $scheduleGrid;
     public $year = '2020';

     function __construct( $pageID ) {
          $this->dateFormat = new Date_Format;
          $this->scheduleGrid = '<div class="schedule-grid">';
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
          $this->scheduleGrid .= $this->get_speaker();
          $this->scheduleGrid .= $this->get_sessions();
          $this->scheduleGrid .= $this->get_separators( $pageID );
          $this->scheduleGrid .= '</div>';
          $this->scheduleGrid .= '</div>';
     }

     public function programm_slots(){

     }

     public function get_speaker(){
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
               $start = date( 'Hi', strtotime(get_field('speaker_zeit', $speakerID)['start']));
               $ende = date( 'Hi', strtotime(get_field('speaker_zeit', $speakerID)['ende']));
               $durationH = date( 'H', strtotime(get_field('speaker_zeit', $speakerID)['ende'])) - date( 'H', strtotime(get_field('speaker_zeit', $speakerID)['start']));
               $durationM = date( 'i', strtotime(get_field('speaker_zeit', $speakerID)['ende'])) - date( 'i', strtotime(get_field('speaker_zeit', $speakerID)['start']));
               $duration = ($durationH * 60) + $durationM;


               $speaker_slots .= '<div class="schedule-slot schedule-speaker" start="'.$start.'" dur="'.$duration.'" ende="'.$ende.'">';
                    $speaker_slots .= '<div class="schedule-container">';
                    $speaker_slots .= '<div class="schedule-slot-time">' . $start . ' - ' . $ende . '</div>';
                    $speaker_slots .= '<div class="schedule-slot-speaker-image" style="background-image:url('.get_field('speaker_bild', $speakerID ).');"></div>';

                    $name = ( get_field('speaker_vorname', $speakerID) ) 
                         ? 
                              get_field('speaker_degree', $speakerID) 
                              . ' ' . get_field('speaker_vorname', $speakerID) 
                              . ' <b>' . get_field('speaker_nachname', $speakerID) . '</b>'
                         : 
                              the_title();
                    $speaker_slots .= '<h4>'.$name.'</h4>';

                    $speaker_slots .= '<div class="schedule-slot-info">';
                         $speaker_slots .= '<p>'.get_field( 'speaker_funktion', $speakerID ).'</p>';
                    $speaker_slots .= '</div>';

                    $speaker_slots .= '</div>';
               $speaker_slots .= '</div>';
          }
          return $speaker_slots;
     }

     public function get_sessions(){
          $sessions_slots = '';
          $sessionSlots = get_option('sessions_slots');

          foreach($sessionSlots as $sessionSlot ){
               
               $timestamps = $this->set_start_duration_end_timestampts( $sessionSlot['start'], $sessionSlot['ende'] );

               $sessions_slots .= '<div class="schedule-slot schedule-session" start="'.$timestamps['start'].'" dur="'.$timestamps['duration'].'" ende="'.$timestamps['ende'].'">';
                    $sessions_slots .= '<div class="schedule-container">';
                    $sessions_slots .= '<div class="schedule-slot-time">' . $timestamps['start'] . ' - ' . $timestamps['ende'] . '</div>';

                    $sessions_slots .= '<h4>'.$sessionSlot['value'].'</h4>';
                    $sessions_slots .= '</div>';
               $sessions_slots .= '</div>';
          }
          return $sessions_slots;
     }


     public function get_separators( $pageID ){
          $separators_slots = '';
          $separators = get_field( 'event_tag', $pageID )[0]['programm_slots'];
     
          foreach( $separators as $sep ){
               $timestamps = $this->set_start_duration_end_timestampts( $sep['start'], $sep['ende'] );
               $separators_slots .= '<div class="schedule-slot schedule-separator" start="'.$timestamps['start'].'" dur="'.$timestamps['duration'].'" ende="'.$timestamps['ende'].'">';
                    $separators_slots .= '<div class="schedule-container">';
                    $separators_slots .= '<div class="schedule-slot-time">' . $timestamps['start'] . ' - ' . $timestamps['ende'] . '</div>';

                    $separators_slots .= '<h4>'.$sep['bezeichnung'].'</h4>';
                    
                    $separators_slots .= '</div>';
               $separators_slots .= '</div>';
               

          }
          return $separators_slots;
     }

     public function cast_Schedule(  ) {
          ;
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
}