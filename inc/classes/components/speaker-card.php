<?php 

namespace se2\components;

require_once(__DIR__.'/../../assets/tags.php');

function Speaker_Card( $speakerID ){

    $name = ( get_field('speaker_vorname', $speakerID) ) 
            ? 
                get_field('speaker_degree', $speakerID) 
                . ' ' . get_field('speaker_vorname', $speakerID) 
                . ' <b>' . get_field('speaker_nachname', $speakerID) . '</b>'
            : 
                the_title();
    $portraitImage = esc_url( get_field('speaker_bild', $speakerID ));
    $speakerFirma = (get_field( 'speaker_firma', $speakerID )) ? ', '.get_field( 'speaker_firma', $speakerID ) : '';
    $tags = new \se2\assets\Tags();

    //HTML OUTPUT
    $speakerCard = '<div class="se2-speaker-grid-profile speaker-profile" data-speakerid="'.$speakerID.'">'; 
        $speakerCard .= '<div class="se2-speaker-grid-image" style="background-image:url('.$portraitImage.');"></div>';
        $speakerCard .= '<div class="se2-speaker-grid-content">';
            $speakerCard .= '<h5>'.$name.'</h5>';
            $speakerCard .= '<p>'.get_field( 'speaker_funktion', $speakerID ).$speakerFirma.'</p>';
            $speakerCard .= $tags->tag_cloud( get_field( 'speaker_kategorie', $speakerID ) );
        $speakerCard .= '</div>';
    $speakerCard .= '</div>';

    return $speakerCard;

}