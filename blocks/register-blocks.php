<?php 
function se2_block_category( $categories, $post ) {
     if ( $post->post_type !== 'page' ) {
          return $categories;
     }
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'se2',
				'title' => __( 'SimplEvent', 'se2-blocks' ),
                    'icon' => get_template_directory_uri().'/theme/simplevent-icon.svg'
			),
		)
	);
     array_unshift( $categories, $custom_category_one, $custom_category_two, $custom_category_three );
     return $categories;
}
add_filter( 'block_categories', 'se2_block_category', 10, 2);

// ACF Custom Blocks **************************************************************************************
function register_acf_block_types() {

     // strips
     acf_register_block_type(array(
          'name'              => 'strips',
          'title'             => __('Strip'),
          'description'       => __('Create strips in different Versions to organise layout vertical.'),
          'render_template'   => 'blocks/templates/strips/strips.php',
          'category'          => 'se2',
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
          'category'          => 'se2',
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
        'category'          => 'se2',
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
        'category'          => 'se2',
        'icon'              => 'info',
        'keywords'          => array( 'infobox', 'box' ),
    ));

    // infobox
    acf_register_block_type(array(
        'name'              => 'counter',
        'title'             => __('Counter'),
        'description'       => __('Create a counter'),
        'render_template'   => 'blocks/templates/counter/counter.php',
        'category'          => 'se2',
        'icon'              => 'performance',
        'keywords'          => array( 'counter', 'count' ),
    ));

     // header image
     acf_register_block_type(array(
          'name'              => 'header-image',
          'title'             => __('Header Image'),
          'description'       => __('Set a Header Image'),
          'render_template'   => 'blocks/templates/header/header-img.php',
          'category'          => 'se2',
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
          'category'          => 'se2',
          'icon'              => 'heart',
          'keywords'          => array( 'reference', 'slider' ),
     ));
     // word cloud
     acf_register_block_type(array(
          'name'              => 'word-cloud',
          'title'             => __('Word Cloud'),
          'description'       => __('List a selection of tags, taxonomies or posts as word-cloud.'),
          'render_template'   => 'blocks/templates/word-cloud/word-cloud.php',
          'category'          => 'se2',
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
     wp_register_script( 'se2block-section-js', get_template_directory_uri(  ) . '/blocks/build/section/section.js', array( 'wp-blocks', 'wp-editor' ) );
     register_block_type( 'se2block/section', array(
          'editor_script' => 'se2block-section-js',
     ) );

     wp_register_script( 'se2block-speaker-card-js', get_template_directory_uri(  ) . '/blocks/build/speaker-card/speaker-card.js', array( 'wp-blocks', 'wp-editor' ) );
     register_block_type( 'se2block/speaker-card', array(
          'editor_script' => 'se2block-speaker-card-js',
     ) );
}
add_action( 'init', 'se2_register_custom_blocks'); 


