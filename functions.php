<?php


/*-------------------------------------------------------------*/
/*------------------------THEME SETTINGS------------------------*/
/*-------------------------------------------------------------*/

require get_template_directory() . '/theme/function-admin.php';
require get_template_directory() . '/theme/enqeue.php';

add_theme_support('editor-styles');
add_editor_style( get_template_directory_uri() . '/style/dist/style.min.css' );

/*-------------------------------------------------------------*/
/*------------------------ENABLE AJAX--------------------------*/
/*-------------------------------------------------------------*/
require get_template_directory() . '/inc/ajax.php';

function hook_ajax_script(){

    wp_enqueue_script( 'ajax-js', get_bloginfo('template_url')."/scripts/inc/ajax.js" );
    
}
add_action( 'wp_enqueue_scripts', 'hook_ajax_script' );
add_action( 'admin_enqueue_scripts', 'hook_ajax_script' );

/*-------------------------------------------------------------*/
/*-------------------SAVE & LOAD ACF JSON----------------------*/
/*-------------------------------------------------------------*/
add_filter('acf/settings/save_json', 'my_acf_json_save_point');
 
function my_acf_json_save_point( $path ) {
    $path = get_stylesheet_directory() . '/acf';
    return $path;
}

add_filter('acf/settings/load_json', 'my_acf_json_load_point');

function my_acf_json_load_point( $paths ) {
    unset($paths[0]);
    $paths[] = get_stylesheet_directory() . '/acf';
    return $paths;
}

/*-------------------------------------------------------------*/
/*------------------------LOAD SCRIPTS-------------------------*/
/*-------------------------------------------------------------*/
function theme_add_scripts() 
{
    
     $JsIncList = array(
          array('anchor-js', 'anchor.js' ),
          array('visibility-js', 'visibility.js'),
          array('detects-js', 'detects.js' ),
          array('lightbox-js', 'lightbox.js'),
          array('restapi-js', 'restapi.js'),
          array('cookies-js', 'cookies.js'),
          array('galery-js', 'galery.js' )
     );

     foreach ($JsIncList as $JsInc) 
     {
          wp_enqueue_script( $JsInc[0], get_template_directory_uri() . '/scripts/inc/' . $JsInc[1], array('jquery'), '1.0.01', true );
     }
     
     /*------------------------------Send Global Variables---------------------------*/
     $cookieAccepted = 'N';
     if ( function_exists('cn_cookies_accepted') && cn_cookies_accepted() ) {
          $cookieAccepted = 'Y';
     }
     $currpageVar = (is_front_page()) ? 'home' : 'n';
     //$quickInfoAktiv = ($_GET['info']) ? $_GET['info'] : 'aa';
     $wnm_custom = array( 
          'templateUrl' => get_template_directory_uri(), 
          'lang' => ICL_LANGUAGE_CODE,
          'ajaxurl' => admin_url('admin-ajax.php'),
          'cookieAcc' =>  $cookieAccepted,
          'page' => $currpageVar,
          //'info' => $quickInfoAktiv
     );
     $scriptToAdGlobal = array('ajax-js', 'script-js',   );
     foreach( $scriptToAdGlobal as $script ){
          wp_localize_script( $script, 'globalURL', $wnm_custom );
     }

}
add_action( 'wp_enqueue_scripts', 'theme_add_scripts' );

/*-------------------------------------------------------------*/
/*------------------------ACF BLOCKS---------------------------*/
/*-------------------------------------------------------------*/


require get_template_directory() . '/blocks/register-blocks.php'; 

//enqueue Styles & Scripts
add_action( 'enqueue_block_editor_assets', 'se2_enqueue_styles_scripts_block', 1, 1 ); //add style to BackEnd
add_action( 'wp_enqueue_scripts', 'se2_enqueue_styles_scripts_block' ); //add style to FrontEnd

function se2_enqueue_styles_scripts_block() 
{
    $fileversion = '1.0.07'; 
    wp_enqueue_style( 'additional-block-styles', get_stylesheet_directory_uri() . '/blocks/templates/additional-styles/add-block-styles.css', '', $fileversion);

    wp_enqueue_style( 'block-testimonial', get_stylesheet_directory_uri() . '/blocks/templates/testimonials/testimonials.css', '', $fileversion );
    wp_enqueue_script( 'block-testimonial-script', get_stylesheet_directory_uri() . '/blocks/templates/testimonials/testimonials.js', array('jquery'), $fileversion, true);

    wp_enqueue_style( 'block-infobox', get_stylesheet_directory_uri() . '/blocks/templates/infobox/infobox.css', '', $fileversion );
    wp_enqueue_script( 'block-infobox-script', get_stylesheet_directory_uri() . '/blocks/templates/infobox/infobox.js', array('jquery'), $fileversion, true);

    wp_enqueue_style( 'block-counter', get_stylesheet_directory_uri() . '/blocks/templates/counter/counter.css', '', $fileversion );
    wp_enqueue_script( 'block-counter-script', get_stylesheet_directory_uri() . '/blocks/templates/counter/counter.js', array('jquery'), $fileversion, true);

    wp_enqueue_style( 'block-header-image', get_stylesheet_directory_uri() . '/blocks/templates/header/header-img.css', $fileversion );

    wp_enqueue_style( 'block-reference-slider', get_stylesheet_directory_uri() . '/blocks/templates/reference-slider/reference-slider.css', '', $fileversion );
    wp_enqueue_script( 'block-reference-slider-script', get_stylesheet_directory_uri() . '/blocks/templates/reference-slider/reference-slider.js', array('jquery'), $fileversion, true);

}

//STANDARD COLORS
function mytheme_setup_theme_supported_features() {
    add_theme_support( 'editor-color-palette', array(
        array(
            'name' => esc_attr__( 'primary color', 'themeLangDomain' ),
            'slug' => 'primary-color',
            'color' => esc_attr( get_option( 'primary_color_picker' ) ),
        ),
        array(
            'name' => esc_attr__( 'secondary color', 'themeLangDomain' ),
            'slug' => 'secondary-color',
            'color' => esc_attr( get_option( 'secondary_color_picker' ) ),
        ),
        
    ) );
}
 
add_action( 'after_setup_theme', 'mytheme_setup_theme_supported_features' );


/*-------------------------------------------------------------*/
/*------------------------SVG Erlauben-------------------------*/
/*-------------------------------------------------------------*/

function cc_mime_types($mimes) 
{
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');


/*-------------------------------------------------------------*/
/*-------------JPEG-Komprimierung deaktivieren-----------------*/
/*-------------------------------------------------------------*/   

add_filter('jpeg_quality', 'wp_bibel_de_custom_jpeg_quality');
add_filter('wp_editor_set_quality', 'wp_bibel_de_custom_jpeg_quality');

function wp_bibel_de_custom_jpeg_quality($quality) 
{
	$quality = 100;
	return $quality;
}
add_filter('intermediate_image_sizes', 'turn_off_default_sizes');

function turn_off_default_sizes( $default_image_sizes) {
    unset( $default_image_sizes['thumbnail']);
    unset( $default_image_sizes['medium']);
    unset( $default_image_sizes['large']);
    unset( $default_image_sizes['medium_large']);
    return $default_image_sizes;
}

// Add support for full and wide align images.
add_theme_support( 'align-wide' );

// Add support for responsive embeds.
add_theme_support( 'responsive-embeds' );


/*-------------------------------------------------------------*/
/*----------------------------MENU-----------------------------*/
/*-------------------------------------------------------------*/

//Menu einstellung
function wpb_custom_new_menu() 
{
    register_nav_menus(
        array(
            'main-menu' => __( 'Hauptmenu' ),
            'sprachen' => __( 'Sprachen' ),
            'footer-menu' => __( 'Footermenu' )
        )
    );
}
add_action( 'init', 'wpb_custom_new_menu' );

add_filter( 'wp_nav_menu_objects', 'submenu_limit', 10, 2 );

function submenu_limit( $items, $args ) {
    if ( empty( $args->submenu ) ) 
    {
        return $items;
    }

    $ids       = wp_filter_object_list( $items, array( 'title' => $args->submenu ), 'and', 'ID' );
    $parent_id = array_pop( $ids );
    $children  = submenu_get_children_ids( $parent_id, $items );

    foreach ( $items as $key => $item ) 
    {
        if ( ! in_array( $item->ID, $children ) ) 
        {
            unset( $items[$key] );
        }
    }
    return $items;
}
/*------------------------MENU WALKER--------------------------*/
require get_template_directory() . '/inc/walker.php';


/*-------------------------------------------------------------*/
/*------------------------User Show Media----------------------*/
/*-------------------------------------------------------------*/

add_filter('ure_attachments_show_full_list', 'show_full_list_of_attachments', 10, 1);
function show_full_list_of_attachments($show_all) 
{
   return true;
}



/*-------------------------------------------------------------*/
/*--------------------------Sitemap----------------------------*/
/*-------------------------------------------------------------*/
add_action("publish_post", "create_sitemap"); 
add_action("publish_page", "create_sitemap"); 
function create_sitemap() 
{ 
    $postsForSitemap = get_posts( array( 'numberposts' => -1, 'orderby' => 'modified', 'post_type' => array( 'post', 'page' ), 'order' => 'DESC' ) ); 
    $sitemap = '<?xml version="1.0" encoding="UTF-8"?>'; 
    $sitemap .= "\n" . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n"; foreach( $postsForSitemap as $post ) { setup_postdata( $post ); 
    $postdate = explode( " ", $post->post_modified ); 
    $sitemap .= "\t" . '<url>' . "\n" . "\t\t" . '<loc>' . get_permalink( $post->ID ) . '</loc>' . "\n\t\t" . '<lastmod>' . $postdate[0] . '</lastmod>' . "\n\t\t" . '<changefreq>monthly</changefreq>' . "\n\t" . '</url>' . "\n"; } 
    $sitemap .= '</urlset>'; $fp = fopen( ABSPATH . "sitemap.xml", 'w' ); 
    fwrite( $fp, $sitemap ); 
    fclose( $fp ); 
}


/*-------------------------------------------------------------*/
/*--------------------WP Date Localised------------------------*/
/*-------------------------------------------------------------*/

function wp_date_localised($format, $timestamp = null) {
    // This function behaves a bit like PHP's Date() function, but taking into account the Wordpress site's timezone
    // CAUTION: It will throw an exception when it receives invalid input - please catch it accordingly
    // From https://mediarealm.com.au/
    
    $tz_string = get_option('timezone_string');
    $tz_offset = get_option('gmt_offset', 0);
    
    if (!empty($tz_string)) {
        // If site timezone option string exists, use it
        $timezone = $tz_string;
    
    } elseif ($tz_offset == 0) {
        // get UTC offset, if it isn’t set then return UTC
        $timezone = 'UTC';
    
    } else {
        $timezone = $tz_offset;
        
        if(substr($tz_offset, 0, 1) != "-" && substr($tz_offset, 0, 1) != "+" && substr($tz_offset, 0, 1) != "U") {
            $timezone = "+" . $tz_offset;
        }
    }
    
    if($timestamp === null) {
      $timestamp = time();
    }
    
    $datetime = new DateTime();
    $datetime->setTimestamp($timestamp);
    $datetime->setTimezone(new DateTimeZone($timezone));
    return $datetime->format($format);
  }

