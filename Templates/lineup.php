<?php

/*

 *Template Name: Line Up

 */

get_header();



wp_enqueue_script( 'JS-lineup', get_template_directory_uri() . '/scripts/specifics/lineup.js', array('jquery'), '1.0.03', true );



$LineUp = new LineUp;



//CONTENT OUTPUT

the_content();



//LINE UP OVERVIEW

echo $LineUp->cast_line_up_filter_section();

$year = get_field( 'jahr', get_the_ID() );
if($_GET["j"]){
     $yearTax = get_term_by( 'name', htmlspecialchars( $_GET["j"] ), 'jahr' );
}

$args = array(
     'view' => 'grid',
     'sort' => 'ASC', 
     'cat' => 'all',
     'year' => $year
);

echo $LineUp->cast_line_up_overview( $args );



//EVENT OUTPUT



get_footer(); 

?>