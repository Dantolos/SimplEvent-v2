<?php

add_filter('acf/load_field/name=event', 'acf_load_sideevent_field_choices');
function acf_load_sideevent_field_choices( $field ) {
     $field['choices'] = array();

     if(get_option( 'main_event' )){
        $value = get_option( 'main_event' );
        $label = 'main';
        $field['choices'][ $label ] = $value;
     } else {
        $value = get_bloginfo('name');
        $label = 'main';
        $field['choices'][ $label ] = $value;
     }
     
     if( is_array(get_option('side_events')) ) {
          
          // while has rows
          foreach( get_option('side_events') as $sideevent ) {
              
              // vars
              $value = $sideevent['value'];
              $label = $sideevent['label'];
  
              if( strlen( $value ) < 1 || strlen( $label ) < 1 ){ continue; }
              // append to choices
              $field['choices'][ $label ] = $value;
              
          }
          
     }

     return $field;
}

//SPEAKER
add_filter('acf/load_field/name=speaker_kategorie', 'acf_load_speaker_kategorie_field_choices');
function acf_load_speaker_kategorie_field_choices( $field ) {
     $field['choices'] = array(
            'keynote' => 'Keynote',
            'panel' => 'Panel',
            'interview' => 'Interview',
            'entertainment' => 'Entertainment',
            'music' => 'Music',
            'session' => 'Session'
        );
     
     if( is_array(get_option('speaker_categories')) ) {
          
          // while has rows
          foreach( get_option('speaker_categories') as $speakerCategorie ) {
              
              // vars
              $value = $speakerCategorie['value'];
              $label = $speakerCategorie['label'];
  
              if( strlen( $value ) < 1 || strlen( $label ) < 1 ){ continue; }
              // append to choices
              $field['choices'][ $label ] = $value;
              
          }
          
     }

     return $field;
}

add_filter('acf/load_field/name=slot', 'acf_load_slot_field_choices');
function acf_load_slot_field_choices( $field ) {
     $field['choices'] = array();
     
     if( is_array(get_option('sessions_slots')) ) {
          
          // while has rows
          foreach( get_option('sessions_slots') as $slot ) {
              
              // vars
              $value = $slot['value'];
              $label = $slot['label'];
  
              if( strlen( $value ) < 1 || strlen( $label ) < 1 ){ continue; }
              // append to choices
              $field['choices'][ $label ] = $value;
              
          }
          
     }

     return $field;
}

add_filter('acf/load_field/name=awardtype', 'acf_load_awards_choices');

function acf_load_awards_choices( $field ) {
    $field['choices'] = array();
    
    if( is_array(get_option('awards')) ) {
         
         // while has rows
         foreach( get_option('awards') as $award ) {
             
             // vars
             $value = $award['value'];
             $label = $award['label'];
 
             if( strlen( $value ) < 1 || strlen( $label ) < 1 ){ continue; }
             // append to choices
             $field['choices'][ $label ] = $value;
             
         }
         
    }

    return $field;
}

add_filter('acf/load_field/name=kategorie', 'acf_load_award_categorie_choices');

function acf_load_award_categorie_choices( $field ) {
     $field['choices'] = array();
     
     if( is_array(get_option('award_categories')) ) {
          
          // while has rows
          foreach( get_option('award_categories') as $slot ) {
              
              // vars
              $value = $slot['value'];
              $label = $slot['label'];
              
              if( strlen( $value ) < 1 || strlen( $label ) < 1 ){ continue; }
              // append to choices
              $field['choices'][ $label ] = $value;
              
          }
          
     }

     return $field;
}

add_filter('acf/load_field/name=kategorie', 'acf_load_award_categorie_choices');
