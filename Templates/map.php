<?php

/*

 *Template Name: Map

 */

get_header();

wp_enqueue_script( 'JS-map', get_template_directory_uri() . '/scripts/specifics/map.js', array('jquery'), '1.0.02', true );

//CONTENT OUTPUT 
the_content();

$mapClass = new \se2\map\se2_Map(  get_the_ID() );

echo $mapClass->cast_map();

get_footer(); 

?>