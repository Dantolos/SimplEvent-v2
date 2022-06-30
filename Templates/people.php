<?php
/*
 *Template Name: People
 */
get_header();

the_content();

$People = new People;
$Groups = get_field('gruppe');

foreach( $Groups as $Group){
     
     
     echo '<h2 class="se2-people-group-title">'.get_term( $Group )->name.'</h2>';
     echo '<div class=" se2-people-wall">' . $People->call_People_Wall($Group) . '</div>';
}
 

get_footer();
?>