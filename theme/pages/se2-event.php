<?php

class se2_page_Event extends se2_page_builder {



     public function build_settings(){
          
          
          //****Settings
          register_setting( 'simplevent-event-group', 'facts_active' );
          register_setting( 'simplevent-event-group', 'facts_date' );
          register_setting( 'simplevent-event-group', 'facts_location' );
          register_setting( 'simplevent-event-group', 'facts_participants' );
          register_setting( 'simplevent-event-group', 'facts_languages' );
          register_setting( 'simplevent-event-group', 'facts_pricing' );

          register_setting( 'simplevent-event-group', 'sessions_active' );
          register_setting( 'simplevent-event-group', 'sessions_slots' );

          register_setting( 'simplevent-event-group', 'award_active' );
          register_setting( 'simplevent-event-group', 'award_categories' );
          register_setting( 'simplevent-event-group', 'awards' );


          //****Section
          add_settings_section( 'simplevent-event-facts', 'Facts', 'simplevent_event_facts', 'simplevent_event');
          add_settings_section( 'simplevent-event-sessions', 'Sessions', 'simplevent_event_sessions', 'simplevent_event');
          add_settings_section( 'simplevent-event-award', 'Award', 'simplevent_event_award', 'simplevent_event');


          //****Fields
          add_settings_field( 'facts-active', 'Facts Aktiv', 'simplevent_facts_active', 'simplevent_event', 'simplevent-event-facts' );
          add_settings_field( 'facts-date', 'Date', 'simplevent_facts_date', 'simplevent_event', 'simplevent-event-facts' );
          add_settings_field( 'facts-location', 'Location', 'simplevent_facts_location', 'simplevent_event', 'simplevent-event-facts' );
          add_settings_field( 'facts-participants', 'Participants', 'simplevent_facts_participants', 'simplevent_event', 'simplevent-event-facts' );
          add_settings_field( 'facts-languages', 'Languages', 'simplevent_facts_languages', 'simplevent_event', 'simplevent-event-facts' );
          add_settings_field( 'facts-pricing', 'Pricing', 'simplevent_facts_pricing', 'simplevent_event', 'simplevent-event-facts' );

          add_settings_field( 'sessions-active', 'Sessions', 'simplevent_sessions_active', 'simplevent_event', 'simplevent-event-sessions' );
          add_settings_field( 'sessions-slots', 'Slots', 'simplevent_sessions_slots', 'simplevent_event', 'simplevent-event-sessions' );

          add_settings_field( 'award-active', 'Award', 'simplevent_award_active', 'simplevent_event', 'simplevent-event-award' );
          add_settings_field( 'awards', 'Awards', 'simplevent_awards', 'simplevent_event', 'simplevent-event-award' );
          add_settings_field( 'award-categories', 'Kategorien', 'simplevent_award_categories', 'simplevent_event', 'simplevent-event-award' );

          // Section Functions
          function simplevent_event_facts() {
               echo 'Facts De/aktivieren';
          }
            
          function simplevent_event_sessions(){     
               echo 'Session Settings';
          }
                   
          function simplevent_event_award(){
               echo 'Award Settings';
          }

          // Call Template File
          function simplevent_theme_event_page(){
               require_once( get_template_directory() . '/theme/templates/simplevent-event.php' );
          }

          $this->build_fields();
          
     }
     
     public function build_fields(){


          // GENERAL INFORMATIONS
          function simplevent_facts_active() {
               $factsactiv = esc_attr( get_option( 'facts_active' ) );
               if($factsactiv == 'on'){
                 $factsactiv = 'checked';
               }
               echo '<input type="checkbox" name="facts_active" ' . $factsactiv . '/>';
          }
          
          function simplevent_facts_date() {
               $facts_date = get_option( 'facts_date' );
               $EventDate = ['from' => false, 'to' => false ];
               $dates =  ( !is_array($facts_date) ) ? $EventDate : $facts_date;
               foreach($dates as $key => $date ){
                    echo '<p>'.$key.'</p>';
                    echo '<input class="se-datepicker" type="text" name="facts_date['.$key.']" value="' .$date. '"  />';
               }
          }
            
          function simplevent_facts_location() { 
               $facts_location = get_option( 'facts_location' );
               $facts_location = ( !is_array($facts_location) ) ? array('google' => '', 'location' => '', 'adress' => '', 'vue' => '') : $facts_location;
               foreach( $facts_location as $key => $des ){
                    echo '<p>'.$key.'</p>';
                    echo '<input type="text" name="facts_location['.$key.']" value="' .$facts_location[$key]. '" placeholder="'.$key.'" />';
               }
          }
          
          function simplevent_facts_participants(){
               $facts_participants = get_option( 'facts_participants' );
               echo '<textarea type="textarea" rows="10" name="facts_participants"  style="width: 100%;">' . $facts_participants . '</textarea>';
          }
          
          function simplevent_facts_languages(){
          
               $facts_languages = get_option('facts_languages');
          
               $languages = [ 
                    'de' => __('Deutsch', 'SimplEvent'), 
                    'en' => __('Englisch', 'SimplEvent'), 
                    'it' => __('Italienisch', 'SimplEvent'), 
                    'fr' => __('Französisch', 'SimplEvent')
               ];
          
               $facts_languages = ( !is_array($facts_languages) ) ? array( 'main' => 'fr', 'translation' => 'en' ) : $facts_languages;
          
               echo '<div style="width: calc(100% + 60px)">';
          
                    //mainlanguage
                    echo '<div style="width:48%;float:left;"><p><b>Main Language</b></p>';
                    echo '<select name="facts_languages[main]" >';    
                    foreach( $languages as $key => $lang ){
                         $select = ( $key === $facts_languages['main'] ) ? 'selected' : '';
                         echo '<option value="'.$key.'" '.$select.'>'.$lang.'</option>';
                    }
                    echo '</select>';
                    echo '</div>';
          
                    //translation
                    echo '<div style="width:48%;float:right;"><p><b>Translations</b></p>';
                    foreach( $languages as $key => $lang ){
                         $check = ( isset($facts_languages['translation'][$key]) ) ? 'checked' : '';
                         echo '<input type="checkbox" id="translation_'.$key.'" name="facts_languages[translation]['.$key.']" value="'.$key.'" '.$check.'>';
                         echo '<label for="translation_'.$key.'">'.$lang.'</label><br>';
                    }
                    echo '</div>';
               echo '</div>';      
          }
          
          
          
          function simplevent_facts_pricing(){     
               $facts_pricing = get_option('facts_pricing'); 
               $fillerPricing = array(
                    ['group' => '', 'price' => '', 'benefits' => ''], 
                    ['group' => '', 'price' => '', 'benefits' => ''], 
                    ['group' => '', 'price' => '', 'benefits' => ''] 
               );
          
               $facts_pricing = ( !is_array($facts_pricing) ) ? $fillerPricing : $facts_pricing;     
               foreach( $facts_pricing as $key => $grp ){
                    echo '<div style="display:flex; flex-wrap:wrap; justify-content: space-between; width:100%;">';
                    echo '<input style="width:50%;" type="text" name="facts_pricing['.$key.'][group]" value="' .$facts_pricing[$key]['group']. '" placeholder="Tagungsticket" />';
                    echo '<input style="width:30%;" type="number" name="facts_pricing['.$key.'][price]" value="' .$facts_pricing[$key]['price']. '" placeholder="100" />';
                    echo '<textarea style="margin: 5px 0 15px; width: 100% !important;" type="textarea" rows="4" name="facts_pricing['.$key.'][benefits]"  style="width: 100%;">' . $facts_pricing[$key]['benefits'] . '</textarea>';
                    echo '</div>';
               }   
          }

          
          // SESSIONS
          function simplevent_sessions_active(){
               $sessions_active = get_option('sessions_active');
               if($sessions_active == 'on'){
                    $sessions_active = 'checked';
               }
               echo '<input type="checkbox" name="sessions_active" ' . $sessions_active . '/>';
          }

          function simplevent_sessions_slots(){
               $sessions_slots = get_option('sessions_slots'); 
               $sessionSlotBase = [
                         'label' => '',
                         'value' => '',
                         'date'  => false,
                         'start' => '',
                         'ende'  => ''
                    ];
               $sessions_slots = ( !is_array( $sessions_slots ) ) ? $sessionSlotBase : $sessions_slots;

               echo '<div class="Session_Slots">';
                    for ($i=0; $i < 4; $i++) { 
                         $sessions_slots[$i] = ( !is_array( $sessions_slots ) ) ? $sessionSlotBase : $sessions_slots[$i]; 

                         echo '<div style="margin-bottom:20px; border-top:3px lightgrey solid;"><p style="width:100%;">Session Slot '.($i+1).'</p>';
                         echo '<input style="width:20%;" type="text" name="sessions_slots['.$i.'][label]" value="' .$sessions_slots[$i]['label']. '" placeholder="label"/>';
                         echo '<input style="width:70%;" type="text" name="sessions_slots['.$i.'][value]" value="' .$sessions_slots[$i]['value']. '" placeholder="value"/>';
                         
                         echo '<input style="width:40%;" class="se-datepicker " type="text" name="sessions_slots['.$i.'][date]" value="' .$sessions_slots[$i]['date']. '"  />';
                         echo '<input style="width:20%;" type="number" name="sessions_slots['.$i.'][start]" value="' .$sessions_slots[$i]['start']. '" placeholder="1430" />';
                         echo ' -';
                         echo '<input style="width:20%;" type="number" name="sessions_slots['.$i.'][ende]" value="' .$sessions_slots[$i]['ende']. '" placeholder="1530" />';

                         echo '</div>';
                    }    
               echo '</div>';
          }

          

          // AWARDS
          function simplevent_award_active(){
               $award_active = get_option('award_active');
               if($award_active == 'on'){

                    $award_active = 'checked';

               }
               echo '<input type="checkbox" name="award_active" ' . $award_active . '/>';
          }

          function simplevent_awards(){
               $awards = get_option('awards');
               $awardsBase = [
                         'label' => '',
                         'value' => ''
                    ];
               $awards = ( !is_array( $awards ) ) ? $awardsBase : $awards;
     
               echo '<div class="Session_Slots">';
                    for ($i=0; $i < 3; $i++) { 

                         $awards[$i] = ( !is_array( $awards ) ) ? $awardsBase : $awards[$i]; 

                         echo '<div style="width:100%;">';
                              echo '<input style="width:20%;" type="text" name="awards['.$i.'][label]" value="' .$awards[$i]['label']. '" placeholder="label"/>';
                              echo '<input style="width:50%;" type="text" name="awards['.$i.'][value]" value="' .$awards[$i]['value']. '" placeholder="value"/>';
                         echo '</div>';
                    }    
               echo '</div>';
          }

          function simplevent_award_categories(){
               $award_categories = get_option('award_categories');
               $awardKategorieBase = [
                         'label' => '',
                         'value' => ''
                    ];

               $award_categories = ( !is_array( $award_categories ) ) ? $awardKategorieBase : $award_categories;
               for ($in=1; $in < (count( get_option('awards') )+1); $in++) { 
                    $ind = $in -1;
                    if( empty(get_option('awards')[$ind]['value']) ){ continue; }
                    echo '<div class="Session_Slots">';
                    echo '<h4>'. get_option('awards')[$ind]['value'] .'</h4>';
                    for ($i=($in * 3); $i < ($in * 3 + 3); $i++) { 
                         $award_categories[$i] = ( !is_array( $award_categories ) ) ? $awardKategorieBase : $award_categories[$i]; 
                         echo '<div style="width:100%;">';
                         echo '<input style="width:20%;" type="text" name="award_categories['.$i.'][label]" value="' .$award_categories[$i]['label']. '" placeholder="label"/>';
                         echo '<input style="width:50%;" type="text" name="award_categories['.$i.'][value]" value="' .$award_categories[$i]['value']. '" placeholder="value"/>';
                         echo '</div>';
                    }    
                    echo '</div>';        
               }
          }

     }

     

}
