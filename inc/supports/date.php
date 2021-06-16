<?php

class Date_Format {



     public function formating_Date_Language( $value, $type ){

          if( $type == 'time' ){

               //TIME
               $time = '';
               $value = strtotime( str_replace( '/', '-',  $value) );

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

          } else if( $type == 'date' ) {

               //DATE
               $date = '';
               $value = strtotime( str_replace( '/', '-',  $value) );

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

     // Get Daterange between start and end date in steps
     // Example: date_range("2014-01-01", "2014-01-20", "+1 day", "m/d/Y");
     public function date_range($first, $last, $step = '+1 day', $output_format = 'd/m/Y' ) {

          $dates = array();
          $current = strtotime($first);
          $last = strtotime($last);
      
          while( $current <= $last ) {
      
              $dates[] =  $current;
              $current = strtotime($step, $current);
          }
      
          return $dates;
      }

}