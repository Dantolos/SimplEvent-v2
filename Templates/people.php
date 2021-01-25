<?php
/*
 *Template Name: People
 */
get_header();

the_content();

$People = new People;
echo '<div class=" se2-people-wall">' . $People->call_People_Wall() . '</div>';

get_footer();
?>