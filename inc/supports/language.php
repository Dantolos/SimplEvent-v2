<?php
namespace se2\support\LANGUAGE;

function formating_Language( $short ){
     $label = __( 'Sprache', 'Simplevent' );
     $languageDes = '';
     switch ($short) {
          case 'de':
               $languageDes = $label . ': <b>' . __( 'Deutsch', 'Simplevent' ) . '</b>';
               break;
          case 'en':
               $languageDes = $label . ': <b>' . __( 'Englisch', 'Simplevent' ) . '</b>';
               break;
          case 'fr':
               $languageDes = $label . ': <b>' . __( 'Französisch', 'Simplevent' ) . '</b>';
               break;
          case 'it':
               $languageDes = $label . ': <b>' . __( 'Italienisch', 'Simplevent' ) . '</b>';
               break;
          default:
               # code...
               break;
     }
     return $languageDes;
}

