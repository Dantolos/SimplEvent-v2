<?php

function register_my_session() {

    //just fpr local dev on xampp
    if(get_site_url() === 'http://localhost:8074/SimplEvent_v2'){
        session_save_path(__DIR__."./temp");
    }
 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
}

add_action('init', 'register_my_session');

/*-------------------------------------------------------------*/
/*------------------------THEME SETTINGS-----------------------*/
/*-------------------------------------------------------------*/

require get_template_directory() . '/theme/function-admin.php';
require get_template_directory() . '/theme/enqeue.php';

add_theme_support('editor-styles');
add_editor_style( get_template_directory_uri() . '/style/dist/style.min.css' );

/*-------------------------------------------------------------*/
/*--------------------IMPLEMENT CUSTOM API---------------------*/
/*-------------------------------------------------------------*/
function add_cors_http_header(){
    header("Access-Control-Allow-Origin: *");
}
add_action('init','add_cors_http_header');

function my_customize_rest_cors() {
    remove_filter( 'rest_pre_serve_request', 'rest_send_cors_headers' );
    add_filter( 'rest_pre_serve_request', function( $value ) {
        header( 'Access-Control-Allow-Origin: *' );
        header( 'Access-Control-Allow-Methods: GET' );
        header( 'Access-Control-Allow-Credentials: true' );
        header( 'Access-Control-Expose-Headers: Link', false );
        return $value;
    } );
}
add_action( 'rest_api_init', 'my_customize_rest_cors', 15 );

require get_template_directory() . '/theme/plugins/se2-rest-api/se2-rest-api-app.php';

/*-------------------------------------------------------------*/
/*----------------------------CTA------------------------------*/
/*-------------------------------------------------------------*/
//require get_template_directory() . '/inc/classes/features/features-cta.class.php';

/*-------------------------------------------------------------*/
if(is_user_logged_in()){
    
    /*-------------------------------------------------------------*/
    /*---------------------CUSTOM USER ROLES-----------------------*/
    /*-------------------------------------------------------------*/
    if(!isset($_COOKIE['capabilities'])){
        require get_template_directory() . '/theme/userroles/userroles.php';
        require get_template_directory() . '/theme/userroles/capabilities.php';
    }

    /*-------------------------------------------------------------*/
    /*---------------------ADMIN CUSTOMIZE------------------------*/
    /*-------------------------------------------------------------*/
    require get_template_directory() . '/theme/plugins/se2-custom-admin/se2-custom-admin.php';

     
    /*-------------------------------------------------------------*/
    /*---------------------CUSTOM COLUMNS------------------------*/
    /*-------------------------------------------------------------*/
    require get_template_directory() . '/theme/plugins/se2-custom-columns/se2-custom-columns.php';


    /*-------------------------------------------------------------*/
    /*---------------------CUSTOM DASHBOARD------------------------*/
    /*-------------------------------------------------------------*/
    require get_template_directory() . '/theme/plugins/se2-custom-dashboard/se2-custom-dashboard.php';

    add_post_type_support( 'features', 'post-attributes' );
 

}
/*-------------------------------------------------------------*/
/*------------------------ENABLE AJAX--------------------------*/
/*-------------------------------------------------------------*/
require get_template_directory() . '/inc/ajax.php';

function hook_ajax_script(){
     wp_enqueue_script( 'loader-js', get_bloginfo('template_url')."/scripts/inc/loader.js" );
     wp_enqueue_script( 'ajax-js', get_bloginfo('template_url')."/scripts/inc/ajax.js" );
    
}
add_action( 'wp_enqueue_scripts', 'hook_ajax_script' );
add_action( 'admin_enqueue_scripts', 'hook_ajax_script' );


/*-------------------------------------------------------------*/
/*--------------------------- ACF -----------------------------*/
/*-------------------------------------------------------------*/

/*-------------------LOAD FIELDS VIA PHP-----------------------*/

require get_template_directory() . '/theme/acf/acf-field-groups.php';


/*----------------------ACF ADD CHOICES------------------------*/
require get_template_directory() . '/theme/acf/acf-field-choice-settings.php';

/*-------------------------------------------------------------*/
/*------------------------LOAD SCRIPTS-------------------------*/
/*-------------------------------------------------------------*/
function theme_add_scripts() 
{
    $JsIncList = array(
        array('anchor-js', 'anchor.js' ),
        array('visibility-js', 'visibility.js'),
        array('detects-js', 'detects.js' ),
        array('restapi-js', 'restapi.js'),
        array('lightbox-js', 'lightbox.js'),     
        array('cookies-js', 'cookies.js'),
        array('galery-js', 'galery.js' ),
        array('socialshare-js', 'social-share.js' ),
        array('lightbox-speaker-js', 'lightbox/lb-speaker.js' ),
        array('lightbox-session-js', 'lightbox/lb-session.js' ),
        array('lightbox-candidate-js', 'lightbox/lb-candidate.js' ),
        array('lightbox-exhibitor-js', 'lightbox/lb-exhibitor.js' )
    );

    if( get_option( 'se_header_mode_menu' ) == 'on' ){
        array_push( $JsIncList, array( 'mode-js', 'mode.js' ) );
    }

    //ADD APP PROMOTION SCRIPT
    if( get_option( 'app_promotion' ) == 'on' ){
        array_push( $JsIncList, array( 'app-promo-js', 'assets/app-promotion.js' ) );
    }

    foreach ($JsIncList as $JsInc) 
    {
        wp_enqueue_script( $JsInc[0], get_template_directory_uri() . '/scripts/inc/' . $JsInc[1], array('jquery'), '1.0.38', true );
    }


     
    /*------------------------------Send Global Variables---------------------------*/
    $cookieAccepted = 'N';
    if ( function_exists('cn_cookies_accepted') && cn_cookies_accepted() ) {
        $cookieAccepted = 'Y';
    }
    $currpageVar = (is_front_page()) ? 'home' : 'n';
    //$quickInfoAktiv = ($_GET['info']) ? $_GET['info'] : 'aa';
    $language =  '';
    if( null !== ICL_LANGUAGE_CODE ){
        $language =  ICL_LANGUAGE_CODE;
    }

    $negIcon = '';
    if( get_option( 'event_icon_neg' ) ){
        $negIcon = file_get_contents( get_option( 'event_icon_neg' ) );
    }

    $wnm_custom = array( 
        'templateUrl' => get_template_directory_uri(), 
        'lang' => $language,
        'ajaxurl' => admin_url('admin-ajax.php'),
        'cookieAcc' =>  $cookieAccepted,
        'page' => $currpageVar,
        'sitename' => get_bloginfo('name'),
        'icon' =>  $negIcon,
        //'info' => $quickInfoAktiv
    );
    
    
    $scriptToAdGlobal = array('ajax-js', 'script-js', 'loader-js'  );
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
    $fileversion = '1.0.22'; 
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
    
    wp_enqueue_style( 'block-word-cloud', get_stylesheet_directory_uri() . '/blocks/templates/word-cloud/word-cloud.css', '', $fileversion );
    wp_enqueue_script( 'block-word-cloud-script', get_stylesheet_directory_uri() . '/blocks/templates/word-cloud/word-cloud.js', array('jquery'), $fileversion, true);

    wp_enqueue_style( 'block-strip', get_stylesheet_directory_uri() . '/blocks/templates/strips/strips.css', '', $fileversion );
    wp_enqueue_script( 'block-strip-script', get_stylesheet_directory_uri() . '/blocks/templates/strips/strips.js', array('jquery'), $fileversion, true);
    
    wp_enqueue_style( 'block-restapi', get_stylesheet_directory_uri() . '/blocks/templates/restapi/restapi.css', '', $fileversion );
    wp_enqueue_script( 'block-restapi-script', get_stylesheet_directory_uri() . '/blocks/templates/restapi/restapi.js', array('jquery'), $fileversion, true);
   
    wp_enqueue_style( 'block-speaker-card', get_stylesheet_directory_uri() . '/blocks/templates/speaker-card/speaker-card.css', '', $fileversion );
    wp_enqueue_script( 'block-speaker-card-script', get_stylesheet_directory_uri() . '/blocks/templates/speaker-card/speaker-card.js', array('jquery'), $fileversion, true);

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
        array(
            'name' => esc_attr__( 'dark', 'themeLangDomain' ),
            'slug' => 'dark-color',
            'color' => esc_attr( get_option( 'dark_mode_picker' )[0] ),
        ),
        array(
            'name' => esc_attr__( 'darkshade', 'themeLangDomain' ),
            'slug' => 'darkshade-color',
            'color' => esc_attr( get_option( 'dark_mode_picker' )[1] ),
        ),
        array(
            'name' => esc_attr__( 'light', 'themeLangDomain' ),
            'slug' => 'light-color',
            'color' => esc_attr( get_option( 'light_mode_picker' )[0] ),
        ),
        array(
            'name' => esc_attr__( 'lightshade', 'themeLangDomain' ),
            'slug' => 'lightshade-color',
            'color' => esc_attr( get_option( 'light_mode_picker' )[1] ),
        ),
        
    ) );
}
 
add_action( 'after_setup_theme', 'mytheme_setup_theme_supported_features' );





/*-------------------------------------------------------------*/
/*------------------------SVG Erlauben-------------------------*/
/*-------------------------------------------------------------*/
add_filter( 'wp_check_filetype_and_ext', 'my_svgs_disable_real_mime_check', 10, 4 );
function my_svgs_disable_real_mime_check( $data, $file, $filename, $mimes ) {
  $wp_filetype = wp_check_filetype( $filename, $mimes );	
  $ext = $wp_filetype['ext'];
  $type = $wp_filetype['type'];
  $proper_filename = $data['proper_filename'];
  return compact( 'ext', 'type', 'proper_filename' );
}
add_filter( 'upload_mimes', function ( $mime_types ) {
    $mime_types['svg'] = 'image/svg+xml';
    $mime_types[ 'eps' ] = 'application/postscript';
    $mime_types['json'] = 'application/json'; 
    $mime_types['obj'] = 'model/obj'; 
    $mime_types['fbx'] = 'model/fbx'; 
    return $mime_types;
} );

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


  
/*-------------------------------------------------------------*/
/*---------------------DISABLE COMMENTS------------------------*/
/*-------------------------------------------------------------*/


add_action('admin_init', function () {
     // Redirect any user trying to access comments page
     global $pagenow;
     
     if ($pagenow === 'edit-comments.php') {
         wp_redirect(admin_url());
         exit;
     }
 
     // Remove comments metabox from dashboard
     remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
 
     // Disable support for comments and trackbacks in post types
     foreach (get_post_types() as $post_type) {
         if (post_type_supports($post_type, 'comments')) {
             remove_post_type_support($post_type, 'comments');
             remove_post_type_support($post_type, 'trackbacks');
         }
     }
 });
 
 // Close comments on the front-end
 add_filter('comments_open', '__return_false', 20, 2);
 add_filter('pings_open', '__return_false', 20, 2);
 
 // Hide existing comments
 add_filter('comments_array', '__return_empty_array', 10, 2);
 
 // Remove comments page in menu
 add_action('admin_menu', function () {
     remove_menu_page('edit-comments.php');
 });
 
// Remove comments links from admin bar
add_action('init', function () {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
});



/* function kb_template_redirect() {
    global $post;
    $post_slug = $post->ID;
    if(is_singular('speakers')) {
        $lineup = get_pages( array(
            'post_type' => 'page',
            'meta_key' => '_wp_page_template',
            'hierarchical' => 0,
            'meta_value' => 'Templates/lineup.php'
        ));
        var_dump( get_permalink( $lineup[0]->ID ) );
        $url =  get_permalink( $lineup[0]->ID ) . '?s=' . $post_slug;
        wp_redirect( $url );
        exit();
    }
}
add_action('template_redirect', 'kb_template_redirect'); */



//Enqueue the Dashicons script
add_action( 'wp_enqueue_scripts', 'load_dashicons_front_end' );
function load_dashicons_front_end() {
    wp_enqueue_style( 'dashicons' );
}


  
/*-------------------------------------------------------------*/
/*------------------------LOGIN FORM---------------------------*/
/*-------------------------------------------------------------*/

function my_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/theme/login/login-style.css' );
    //wp_enqueue_script( 'custom-login', get_stylesheet_directory_uri() . '/style-login.js' );
}
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );

function my_login_logo() { 
    ?>
    <style type="text/css">
        body.login {
            background-color: <?php echo get_option( 'primary_color_picker' ); ?>;
        }
        body.login  div#login:after {
            display:block;
            content: '';
            position: absolute;
            right: -100px;
            border-left: 100px solid #ffffff;
            border-right: 0px solid transparent;
            border-bottom: 0 solid transparent;
            border-top: 100vh solid transparent;
        }
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_option( 'event_icon' ); ?>);
            height:65px;
            width:320px;
            background-size: 320px 65px;
            background-repeat: no-repeat;
        	padding-bottom: 30px;
        }
        body.login div#login form#loginform p.submit input#wp-submit {
            background-color: <?php echo get_option( 'primary_color_picker' ); ?>;
        }
    
<?php 
    if( isset(get_option('meta_tags')['SocialMedia']['Image']) ){
        ?>
            body.login  {
                
                background-image: url(<?php echo get_option('meta_tags')['SocialMedia']['Image']; ?>);
                background-size: cover;
                -ms-background-size: cover;
                -o-background-size: cover;
                -moz-background-size: cover;
                -webkit-background-size: cover;
                background-repeat: no-repeat;
                background-position: center center;
            }
            </style>
        <?php 
    }
    ?></style><?php
}
add_action( 'login_enqueue_scripts', 'my_login_logo' );


function the_url( $url ) {
    return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'the_url' );



