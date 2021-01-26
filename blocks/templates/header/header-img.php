<?php
/**
 * Header Image Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$id = 'header-image-' . $block['id'];
if( !empty($block['anchor']) ) {
   $id = $block['anchor'];
}

$className = 'header-image';
if( !empty($block['className']) ) {
   $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
   $className .= ' align' . $block['align'];
}



$image = get_field('image');
$titel = get_field('titel');
$datum = get_field('datuim');
$fontColor = get_field('font_color');

?>


<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" style="background-image:url(<?php echo esc_url($image); ?>);">

     <InnerBlocks />
 
</div>
