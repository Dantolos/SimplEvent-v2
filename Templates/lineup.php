<?php
/*
 *Template Name: Line Up
 */
get_header();

wp_enqueue_script( 'JS-lineup', get_template_directory_uri() . '/scripts/specifics/lineup.js', array('jquery'), '1.0.01', true );

$LineUp = new LineUp;

//CONTENT OUTPUT
the_content();

//LINE UP OVERVIEW
echo $LineUp->cast_line_up_filter_section();

$args = array(
     'view' => 'grid',
     'order' => 'ASC',
     'cat' => 'all'
);
echo $LineUp->cast_line_up_overview( $args );

//EVENT OUTPUT

get_footer(); 
?>