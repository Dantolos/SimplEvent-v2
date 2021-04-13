<?php
/**
 * RestAPI Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$id = 'restapi-' . $block['id'];
if( !empty($block['anchor']) ) {
   $id = $block['anchor'];
}

$className = 'restapi';
if( !empty($block['className']) ) {
   $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
   $className .= ' align' . $block['align'];
}

$api = new stdClass();
$api->URL = get_field('restapi_url');
$api->Function = get_field('function');

wp_localize_script( 'block-restapi-script', 'api', json_encode( $api ) );

?>


<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div id="api_target">

    </div>
</div>