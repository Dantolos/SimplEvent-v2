<?php

/*

 *Template Name: Line Up

 */

get_header();

wp_enqueue_script( 'JS-lineup', get_template_directory_uri() . '/scripts/specifics/lineup.js', array('jquery'), '1.0.05', true );

$LineUp = new LineUp;



//CONTENT OUTPUT 
the_content();


//LINE UP OVERVIEW
$newestYear = get_field( 'visibility', get_the_ID() )['jahr-visibility'][0];
foreach( get_field( 'visibility', get_the_ID() )['jahr-visibility'] as $yearCat ){
     if( intval($yearCat->slug) > $newestYear->slug ){
          $newestYear = $yearCat;
     }
}
$year = $newestYear->term_id;

if( isset( $_GET["j"] ) ){
     $yearTax = get_term_by( 'name', htmlspecialchars( $_GET["j"] ), 'jahr' );
     $year = $yearTax->term_id;
}

$event = 'main';
if(get_field( 'visibility', get_the_ID() )['event']) {
     $event = array();
     foreach(get_field( 'visibility', get_the_ID() )['event'] as $selevent){
          $event[$selevent['value']] = $selevent['value'];
     }    
}


$cat = 'all';
if(get_field( 'visibility', get_the_ID() )['speaker_kategorie'] ) {
     $cat = get_field( 'visibility', get_the_ID() )['speaker_kategorie'];
}


$args = array(
     'view' => 'grid',
     'sort' => 'ASC',  
     'cat' => $cat,
     'year' => $year, 
     'event' => $event,
);


// FILTER MENU
echo $LineUp->cast_line_up_filter_section( get_the_ID(), $args );

// LINE UP LIST
echo $LineUp->cast_line_up_overview( $args );





get_footer(); 

?>