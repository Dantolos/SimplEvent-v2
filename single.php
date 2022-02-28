<?php
global $post;
$post_type = $post->post_type;
$url = home_url();
switch ($post_type) {
    case 'event':
        $page_details = get_pages( array(
            'post_type' => 'page',
            'meta_key' => '_wp_page_template',
            'hierarchical' => 0,
            'meta_value' => 'Templates/events.php'
        ));

        $url = get_permalink($page_details[0]->ID).'?type='.$post_type.'&id='.$post->ID;
        break;
    case 'company':
        $page_details = get_pages( array(
            'post_type' => 'page',
            'meta_key' => '_wp_page_template',
            'hierarchical' => 0,
            'meta_value' => 'Templates/company.php'
        ));

        $url = get_permalink($page_details[0]->ID).'?type='.$post_type.'&id='.$post->ID;
        break;
    case 'speakers':
        $page_details = get_pages( array(
            'post_type' => 'page',
            'meta_key' => '_wp_page_template',
            'hierarchical' => 0,
            'meta_value' => 'Templates/lineup.php'
        ));

        $url = get_permalink($page_details[0]->ID).'?type='.$post_type.'&id='.$post->ID;
        break;
    default:
        $url = home_url();
        break;
}



echo '<pre style="color:red; line-height:1em;">';
var_dump( $post_type );
echo '</pre>';


wp_redirect( $url );
exit; 