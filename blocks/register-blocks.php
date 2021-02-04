<?php 
// ACF Custom Blocks **************************************************************************************
function register_acf_block_types() {

    // testimonial
    acf_register_block_type(array(
        'name'              => 'testimonial',
        'title'             => __('Testimonial'),
        'description'       => __('A custom testimonial block.'),
        'render_template'   => 'blocks/templates/testimonials/testimonials.php',
        'category'          => 'formatting',
        'icon'              => 'admin-comments',
        'keywords'          => array( 'testimonial', 'quote' ),
    ));

    // infobox
    acf_register_block_type(array(
        'name'              => 'infobox',
        'title'             => __('Infobox'),
        'description'       => __('Infoboxes with short content description'),
        'render_template'   => 'blocks/templates/infobox/infobox.php',
        'category'          => 'formatting',
        'icon'              => 'info',
        'keywords'          => array( 'infobox', 'box' ),
    ));

    // infobox
    acf_register_block_type(array(
        'name'              => 'counter',
        'title'             => __('Counter'),
        'description'       => __('Create a counter'),
        'render_template'   => 'blocks/templates/counter/counter.php',
        'category'          => 'formatting',
        'icon'              => 'performance',
        'keywords'          => array( 'counter', 'count' ),
    ));

     // header image
     acf_register_block_type(array(
          'name'              => 'header-image',
          'title'             => __('Header Image'),
          'description'       => __('Set a Header Image'),
          'render_template'   => 'blocks/templates/header/header-img.php',
          'category'          => 'formatting',
          'icon'              => 'format-image',
          'keywords'          => array( 'header', 'image' ),
          'supports'          => array( 'jsx' => true ),
     ));
     // header image
     acf_register_block_type(array(
          'name'              => 'reference-slider',
          'title'             => __('Reference Slider'),
          'description'       => __('Present reference logos in a slider'),
          'render_template'   => 'blocks/templates/reference-slider/reference-slider.php',
          'category'          => 'formatting',
          'icon'              => 'heart',
          'keywords'          => array( 'reference', 'slider' ),
     ));
     // word cloud
     acf_register_block_type(array(
          'name'              => 'word-cloud',
          'title'             => __('Word Cloud'),
          'description'       => __('List a selection of tags, taxonomies or posts as word-cloud.'),
          'render_template'   => 'blocks/templates/word-cloud/word-cloud.php',
          'category'          => 'formatting',
          'icon'              => 'cloud',
          'keywords'          => array( 'word', 'cloud', 'wordcloud', 'word-cloud' ),
     ));
}
// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
   add_action('acf/init', 'register_acf_block_types');
}