<?php
/**
 * Counter Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$id = 'counter-' . $block['id'];
if( !empty($block['anchor']) ) {
   $id = $block['anchor'];
}

$className = 'counter';
if( !empty($block['className']) ) {
   $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
   $className .= ' align' . $block['align'];
}

$num = get_field('number') ?: 'Your count target number here...';
$duration = get_field('duration') ?: '500';
?>


<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <?php if( get_field('extensions')['position'] == 'befor' ) { echo '<span class="counter-extension counter-extension-before">' . esc_attr(get_field('extensions')['extension']) . ' </span>'; } ?>
    <span class="counter-number" duration="<?php echo esc_attr($duration); ?>"><?php echo esc_attr($num); ?></span>
    <?php if( get_field('extensions')['position'] == 'after' ) { echo '<span class="counter-extension counter-extension-after"><br>' . esc_attr(get_field('extensions')['extension']) . '</span>'; } ?>
</div>