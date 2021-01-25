<?php
/**
 * Testimonial Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$id = 'reference-' . $block['id'];
if( !empty($block['anchor']) ) {
   $id = $block['anchor'];
}

$className = 'reference';
if( !empty($block['className']) ) {
   $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
   $className .= ' align' . $block['align'];
}

$countLogos = 0;
?>


<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    
     <?php foreach(get_field('companies') as $key => $companyID ) {
               $display = ($countLogos < 5) ? 'block' : 'none';
               echo '<div class="se-reference" style="display:'.$display.';">';
               echo '<img src="' . esc_url( get_field('media', $companyID)['logo_positiv'] ) . '" title="' . get_the_title($companyID) . '" alt="' . get_the_title($companyID) . '" />';
               echo '</div>';
               $countLogos++;
     } ?>
   
</div>