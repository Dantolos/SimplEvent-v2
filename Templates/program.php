<?php

/*

 *Template Name: Programm

 */

get_header(); 

wp_enqueue_script( 'JS-schedule', get_template_directory_uri() . '/scripts/specifics/schedule.js', array('jquery'), '1.0.04', true );



the_content();

$Schedule = new se2_Schedule(get_the_ID());
$speakerClass = new LineUp();
echo '<div class=" se2-schedule-container">';

if( get_field('moderation', get_the_ID()) ){
     echo '<div class="se2-schedule-hosts">';
     echo '<h5>'.__('Moderation', 'SimplEvent').'</h5>';
     foreach( get_field('moderation', get_the_ID()) as $host ){
          echo '<div class="se2-schedule-host">';
          echo $speakerClass->cast_host( $host );
          echo '</div>';
     }
     echo '</div>';
}

echo $Schedule->cast_Schedule();
echo '</div>';


 
get_footer();

?>