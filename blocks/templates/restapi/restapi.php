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

$api = array(
     'URL' => get_field('restapi_url'),
     'Function' => get_field('function')
);

wp_localize_script( 'block-restapi-script', 'api', $api );

?>
<?php
//for visualization in backend
if( is_user_logged_in() && is_admin() ){ echo '<style>#api_target{ background-color:rgba(255,255,255,.8);padding:20px;}</style>'; }
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div id="api_target">
     <?php
     //for visualization in backend
     if( is_user_logged_in() && is_admin() ){ echo '<h2>RestAPI Block</h2><p>'.$api['URL'].'</p>'; }
     ?>
     
    </div>
</div>