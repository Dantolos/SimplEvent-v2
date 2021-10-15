<?php

/*

 *Template Name: Sessions

 */

get_header();

//wp_enqueue_script( 'JS-schedule', get_template_directory_uri() . '/scripts/specifics/schedule.js', array('jquery'), '1.0.01', true );

the_content();

$pageID = get_the_ID();

$Session = new Sessions();

echo '<div class="container">';
    echo '<h1>SESSIONS</h1>';
    echo $Session->cast_session_grid($pageID);
echo '</div>';

get_footer();

?> 