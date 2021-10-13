<?php

/*

 *Template Name: Review

 */

get_header();

wp_enqueue_script( 'JS-review', get_template_directory_uri() . '/scripts/specifics/review.js', array('jquery'), '1.0.03', true );
wp_enqueue_script( 'JS-lineup', get_template_directory_uri() . '/scripts/specifics/lineup.js', array('jquery'), '1.0.04', true );

$reviewClass = new Review;

$pageID = get_the_ID();
$reviews = get_field( 'review_sites', $pageID );

if( is_array( $reviews ) ){
    if( count( $reviews ) > 1 ){
        echo $reviewClass->cast_overview_review( $pageID );
    } else {
        echo $reviewClass->cast_single_review( $pageID, 0 );
    }
}

get_footer();

?>