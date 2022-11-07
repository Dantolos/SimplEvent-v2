<?php
/*
* Template Name: Call to Action
* Template Post Type: page, post, features
*/

get_header(); 
the_content();

$page_details = get_posts( array(
     'post_type' => 'features',
     'meta_key' => '_wp_page_template',
     'hierarchical' => 0,
     'meta_value' => 'Templates/features-cta.php'
));


get_footer(); 

?>