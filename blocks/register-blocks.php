<?php 
// ACF Custom Blocks **************************************************************************************
function register_acf_block_types() {

     // strips
     acf_register_block_type(array(
          'name'              => 'strips',
          'title'             => __('Strip'),
          'description'       => __('Create strips in different Versions to organise layout vertical.'),
          'render_template'   => 'blocks/templates/strips/strips.php',
          'category'          => 'formatting',
          'icon'              => 'align-wide',
          'keywords'          => array( 'strip', 'strips' ),
          'supports'          => array( 'jsx' => true ),
     ));

     // restapi
     acf_register_block_type(array(
          'name'              => 'restapi',
          'title'             => __('restAPI'),
          'description'       => __('Create strips in different Versions to organise layout vertical.'),
          'render_template'   => 'blocks/templates/restapi/restapi.php',
          'category'          => 'formatting',
          'icon'              => 'share',
          'keywords'          => array( 'restapi', 'api', 'rest' ),
          'supports'          => array( 'jsx' => true ),
     ));

    // testimonial
    acf_register_block_type(array(
        'name'              => 'testimonial',
        'title'             => __('Testimonial'),
        'description'       => __('A custom testimonial block.'),
        'render_template'   => 'blocks/templates/testimonials/testimonials.php',
        'category'          => 'formatting',
        'icon'              => 'admin-comments',
        'editor_script'     => 'block-testimonial-script',
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



//JS Blocks
function se2_register_custom_blocks(){
     wp_register_script( 'se2block-speaker-js', get_template_directory_uri(  ) . '/blocks/templates/speakers/block_speakers.js', array( 'wp-blocks' ) );

     register_block_type( 'se2block/speaker', array(
          'editor_script' => 'se2block-speaker-js',
     ) );
}
add_action( 'init', 'se2_register_custom_blocks');
