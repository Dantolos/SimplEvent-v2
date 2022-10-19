<?php

namespace se2\components;

function Speaker_ListElement( $speakerID, $showCV = false, $hideDate = false, $showKategorie = false ){

        $dateFormat = new \se2\support\Date_Format();
        $tags = new \se2\assets\Tags();
        $speakerCardStyle = ($showCV) ? 'cursor: unset !important;' : '';
        $speakerID = apply_filters( 'wpml_object_id', $speakerID, 'speakers' );
        $name = ( get_field('speaker_vorname', $speakerID) ) 
        ? 
             get_field('speaker_degree', $speakerID) 
             . ' ' . get_field('speaker_vorname', $speakerID) 
             . ' <b>' . get_field('speaker_nachname', $speakerID) . '</b>'
        : 
             the_title();


        //HTML
        $speakerCard = '<div class="se2-speaker-list-profile speaker-profile" data-speakerid="'.$speakerID.'" style="'.$speakerCardStyle.'">'; 

             $speakerCard .= '<div class="se2-speaker-profile-image" style="background-image:url('.get_field('speaker_bild', $speakerID ).');"></div>';
                $speakerCard .= '<div class="se2-speaker-list-profil-info">';

                  $timeDates = get_field( 'speaker_zeit', $speakerID );

                  if( $timeDates  ){
                       if(!$hideDate){
                            $speakerCard .= '<h6>'.$dateFormat->formating_Date_Language( $timeDates['datum'], 'date' );
                            
                            if( strlen( $dateFormat->formating_Date_Language( $timeDates['start'], 'time' ) ) > 0 ){
                                 $speakerCard .= ' | ';
                                 $speakerCard .= str_replace( 'Uhr', '', $dateFormat->formating_Date_Language( $timeDates['start'], 'time' ) );
                                 $speakerCard .= ' ' . __( 'bis', 'SimplEvent') . ' ';
                                 $speakerCard .= $dateFormat->formating_Date_Language( $timeDates['ende'], 'time' );
                            }
                            $speakerCard .= '</h6>';
                       }
                        
                       $speakerCard .= '<h4>'.$name.'</h4>';
                       $speakerFirma = (get_field( 'speaker_firma', $speakerID )) ? ', '.get_field( 'speaker_firma', $speakerID ) : '';

                       $speakerCard .= '<p>'.get_field( 'speaker_funktion', $speakerID ).$speakerFirma.'</p>';

                       $speakerCard .= $tags->tag_cloud( get_field( 'speaker_kategorie', $speakerID ) );

                       if( $showCV ){
                            $speakerCard .= '<p>'.get_field( 'speaker_cv', $speakerID ).'</p>';
                       }
                  }

             $speakerCard .= '</div>';

        $speakerCard .= '</div>';

        return $speakerCard;

}