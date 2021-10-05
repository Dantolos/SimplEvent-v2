<?php
/*
 *Template Name: Mediacorner
 */
get_header();

wp_enqueue_script( 'JS-mediacorner', get_template_directory_uri() . '/scripts/specifics/mediacorner.js', array('jquery'), '1.0.02', true );

//the_content();

$mediaCorner = new Mediacorner;
$pageID = get_the_ID();



echo '<div class="se2-mediacorner" >';

     echo '<div class="mediacorner-nav">';
     echo $mediaCorner->cast_mediacorner_nav($pageID);
     echo '</div>';

     echo '<div class="mediacorner-content">';
          //echo $mediaCorner->cast_logo_downlaods($pageID);
          echo $mediaCorner->cast_media_info($pageID);
          //echo $mediaCorner->cast_photo_archive($pageID);
          //echo $mediaCorner->cast_audio_archive($pageID);
     echo '</div>';     
echo '</div>';

get_footer();
?>