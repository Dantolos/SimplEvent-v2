<?php

/*

 *Template Name: Sessions

 */

get_header();

//wp_enqueue_script( 'JS-schedule', get_template_directory_uri() . '/scripts/specifics/schedule.js', array('jquery'), '1.0.01', true );

the_content();

//$Schedule = new se2_Schedule(get_the_ID());

//echo '<div class=" se2-schedule-container">' . $Schedule->cast_Schedule() . '</div>';

get_footer();

?>