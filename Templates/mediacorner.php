<?php
/*
 *Template Name: Mediacorner
 */
get_header();

wp_enqueue_script( 'JS-mediacorner', get_template_directory_uri() . '/scripts/specifics/mediacorner.js', array('jquery'), '1.0.08', true );

//the_content();

$mediaCorner = new Mediacorner;
$pageID = get_the_ID();

http://simplevent-v2.local/mediacorner/?m=fotos

$startpage = 'info';
if( isset( $_GET["m"] ) ){
     $startpage = $_GET["m"];
}

echo '<div class="se2-mediacorner" >';

     echo '<div class="mediacorner-nav">';
     echo $mediaCorner->cast_mediacorner_nav($pageID);
     echo '</div>';

     echo '<div class="mediacorner-content">';
     switch ($startpage) {
          case 'info':
               echo $mediaCorner->cast_media_info($pageID);
               break;
          case 'mm':
               echo $mediaCorner->cast_press_realese($pageID);
               break;
          case 'logo':
               echo $mediaCorner->cast_logo_downlaods($pageID);
               break;
          case 'fotos':
               echo $mediaCorner->cast_photo_archive($pageID);
               break;
          case 'audio':
               echo $mediaCorner->cast_audio_archive($pageID);
               break;
          case 'video':
               echo $mediaCorner->cast_video_archive($pageID);
               break;
          default:
               echo $mediaCorner->cast_media_info($pageID);
               break;
     }
          
     echo '</div>';     
echo '</div>';

get_footer();
?>