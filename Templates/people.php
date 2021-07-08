<?php
/*
 *Template Name: People
 */
get_header();

the_content();

$People = new People;
$Group = get_field('gruppe');

echo '<div class=" se2-people-wall">' . $People->call_People_Wall($Group) . '</div>';

get_footer();
?>