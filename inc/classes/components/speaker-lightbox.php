<?php

namespace se2\components\lightbox;

function speaker_lightbox($speakerID){

    $dateFormat = new \se2\support\Date_Format();
    $files = new \se2_Files;
    $socialMedia = new \se2_SocialMedia( esc_attr( get_option( 'dark_mode_picker' )[1] ) );
    $MediaCorner = new \Mediacorner();

    $speakerID = apply_filters( 'wpml_object_id', $speakerID, 'speakers' );
    $speakername = ( get_field('speaker_vorname', $speakerID)  ) 
    ? 
        get_field('speaker_degree', $speakerID) 
        . ' ' . get_field('speaker_vorname', $speakerID) 
        . ' <b>' . get_field('speaker_nachname', $speakerID) . '</b>'
    : 
        get_the_title( $speakerID );

    $speakerFirma = ( get_field( 'speaker_firma', $speakerID ) ) ? ', ' . get_field( 'speaker_firma', $speakerID ) : '';

    $speakerLightbox = '<div class="speaker-lb-container">';
 
    $speakerLightbox .= '<div class="speaker-lb-body">';

              //INFOS
              $speakerLightbox .= '<div class="speaker-lb-informations">';

                   //Auftritt infos
                   $speakerDate = strtotime( str_replace( '/', '-',  get_field('speaker_zeit', $speakerID)['datum'] ) );
                   $start = date( 'Hi', strtotime(get_field('speaker_zeit', $speakerID)['start']));
                   $ende = date( 'Hi', strtotime(get_field('speaker_zeit', $speakerID)['ende']));


                   if($speakerDate){
                        $speakerLightbox .= '<div class="speaker-lb-informations-gig">';

                             $speakerLightbox .= '<h6>';
                             $speakerLightbox .= $dateFormat->formating_Date_Language( get_field('speaker_zeit', $speakerID)['datum'], 'date' ) . '<br />';
                             $speakerLightbox .= '</h6>';

                             if( $start !== '0000' && $ende !== '0000' ){
                             
                                  $speakerLightbox .= '<h4>';
                                  $speakerLightbox .= $dateFormat->formating_Date_Language( $start, 'time' );
                                 
                                  $speakerLightbox .= '<span> &ndash; ' . $dateFormat->formating_Date_Language( $ende, 'time' ) . '</span>';
                                  $speakerLightbox .= '</h4>';
                             }
                       
                        $speakerLightbox .= '</div>';
                   }

                   //SOZIALMEDIA

                   //SHARE BUTTONS // TODO <----------------------------------------------------------------
                   $shareurl = get_permalink( $speakerID );
                   $sharetitle = (get_field('speaker_vorname', $speakerID)) ? get_field('speaker_vorname', $speakerID) . ' ' . get_field('speaker_nachname', $speakerID) : get_the_title( $speakerID );
                   $sharedescription = (get_field('programm_titel', $speakerID)) ? get_field('programm_titel', $speakerID) : get_field('speaker_funktion', $speakerID) . $speakerFirma;
                   
                   $sharecontent = array(
                        'url' => $shareurl,
                        'title' => $sharetitle,
                        'description' => $sharedescription,
                        'image' => get_field('speaker_bild', $speakerID ),
                   );
                     
                   $speakerLightbox .= '<div class="speaker-lb-share">';
                   $speakerLightbox .= $socialMedia->shareButton( $sharecontent  );
                   $speakerLightbox .= '</div>'; 
                   


                   //SOCIAL LINKS
                   if(is_array(get_field('speaker_social_media', $speakerID)['social_media'])){
                        $speakerLightbox .= '<div class="speaker_socialmedia">';
                   
                        $socialMEdias = get_field( 'speaker_social_media', $speakerID )['social_media'];
                        foreach( $socialMEdias  as $key => $smIcon ){
                             $speakerLightbox .= '<div class="speaker_socialmedia-icon">'.$socialMedia->cast_icon( $smIcon['acf_fc_layout'], $smIcon[$smIcon['acf_fc_layout']] ).'</div>';
                        }
                        $speakerLightbox .= '</div>';
                   } 

              $speakerLightbox .= '</div>';

                    
              //CONTENT
              $speakerLightbox .= '<div class="speaker-lb-content">';
                    //FOTO
                    $speakerLightbox .= '<div class="speaker-lb-image speaker-stagger" style="background-image:url('.get_field('speaker_bild', $speakerID ).');">';    
                    $speakerLightbox .= '</div>';

                    //SPEAKER
                    $speakerLightbox .= '<div class="speaker-lb-headinfo speaker-stagger">';

                        $speakerLightbox .= '<div class="se2-tag-element">' . \se2\support\LANGUAGE\formating_Language( get_field('speaker_sprache', $speakerID) ) . '</div>'; //------------------------------------------
                   
                        $speakerLightbox .= '<h2 class="speaker-stagger">'.$speakername.'</h2>';
                        
                        $speakerLightbox .= '<p class="speaker-stagger primary-txt">'.get_field( 'speaker_funktion', $speakerID ).$speakerFirma.'</p>';

                       
                        $speakerCV = get_field( 'speaker_cv', $speakerID );
                        $speakerLightbox .=  $speakerCV;

                        $speakerLightbox .= '<div class="review-videos">';
                   
                        $videoArgs = array(
                             'numberposts'	=> -1,
                             'post_type'	=> 'video',
                             'meta_query'	=> array(
                        
                                  array(
                                       'key'	 	=> 'corr-speakers',
                                       'value'	  	=> $speakerID,
                                       'compare' 	=> 'LIKE',
                                  ), 
                                  
                             )
                        );
                        $videos = new \WP_Query( $videoArgs );

                        if($videos->posts){
                             foreach( $videos->posts as $video ){
                                  $speakerLightbox .= '<div class="review-video">';
                                  
                                  $speakerLightbox .= $MediaCorner->se2_video( $video->ID );
                                  $speakerLightbox .= '<h5>'.get_the_title( $video->ID).'</h5>';
                                  $speakerLightbox .= '</div>';
                             }
                        }
                        
                   $speakerLightbox .= '</div>';

                   //REVIEW
                  
                   if( have_rows('review_jahr',  $speakerID ) ){
                        foreach( get_field( 'review_jahr', $speakerID ) as $review ){
                             if( $review['review_public'] ){
                        
                                  $speakerLightbox .= '<h6>REVIEW <b>'. $review['jahr']->slug .'</b></h6>';
                                  $speakerLightbox .= '<h4><b>'.$review['review_titel'].'</b></h4>';

                                  //PRESENTATION
                                  if( $review['presentation'] ){ 
                                       $speakerLightbox .= '<a href="'.$review['presentation']['url'].'" target="_blank">';
                                       $speakerLightbox .= '<div class="speaker-presi-btn se2-btn-s se2-btn-light se2-btn-rnd-20">';
                                       $speakerLightbox .= '<span>'.__('Präsentation', 'SimplEvent').' <i>'.$files->getRemoteFilesize( $review['presentation']['url'] ).'</i></span>';
                                       $speakerLightbox .= '</div>';
                                       $speakerLightbox .= '</a>';
                                  }

                                  $speakerLightbox .= '<div class="review-videos">';
                                  if( $review['review_video'] ){
                                       $speakerLightbox .= '<div class="review-video">';
                                       $speakerLightbox .= '<div class="video-wrapper"><iframe  width="100%" height="100%" src="https://media10.simplex.tv/content/'. $review['review_video'] .'/index.html?embed=1" frameborder="0" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true" scrolling="no"></iframe></div>';
                                       $speakerLightbox .= '<h5>'.__('Auftritt', 'SimplEvent').'</h5>';
                                       $speakerLightbox .= '</div>';
                                       
                                  }
                                  $speakerLightbox .= '</div>';
                                
                                  $speakerLightbox .= '<p>' . $review['review_text'] . '</p>';
                                  
                             
                                  if( is_array($review['review_galerie'])) {
                                       $speakerLightbox .= '<div class="gallery-splide">';
                                       $speakerLightbox .= '<h4>'.__('Fotos', 'SimplEvent').'</h4>';
                                       $speakerLightbox .= '<div class="gallery-splide-main splide" >';
                                       $speakerLightbox .= '<div class="splide__track"><ul class="splide__list">';
                                            foreach ($review['review_galerie'] as $key => $foto) {
                                                 $speakerLightbox .= '<li class="splide__slide">';
                                                 $speakerLightbox .= '<div style="background-image: url('.esc_url($foto).')"></div>';
                                                 $speakerLightbox .= '</li>';
                                            }
                                       $speakerLightbox .= '</ul></div>';
                                       $speakerLightbox .= '</div>';
              
                                       $speakerLightbox .= '<div class="gallery-splide-thumb splide" >';
                                       $speakerLightbox .= '<div class="splide__track"><ul class="splide__list">';
                                            foreach ($review['review_galerie'] as $key => $foto) {
                                                 $speakerLightbox .= '<li class="splide__slide">';
                                                 $speakerLightbox .= '<img src="'.esc_url($foto).'" />';
                                                 $speakerLightbox .= '</li>';
                                            }
                                            $speakerLightbox .= '</ul></div>';
                                       $speakerLightbox .= '</div>';
                                       $speakerLightbox .= '</div>';
                                  }

                             }

                        }                          

                   }

                   $speakerLightbox .= get_field( 'review_text', $speakerID );

              $speakerLightbox .= '</div>';

         $speakerLightbox .= '</div>';

    $speakerLightbox .= '</div>';

    return $speakerLightbox;
}