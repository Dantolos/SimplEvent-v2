<?php
/**
 * Testimonial Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$id = 'infobox-' . $block['id'];
if( !empty($block['anchor']) ) {
   $id = $block['anchor'];
}

$className = 'infobox';
if( !empty($block['className']) ) {
   $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
   $className .= ' align' . $block['align'];
}

$titel = get_field('titel') ?: 'TITEL';
$icon = get_field('icon');
$content = 'Add Content in List';
if( have_rows('content') ) {
    $content = array();
    while( have_rows('content') ) : the_row();
        array_push( $content, get_sub_field('list_item') );
    endwhile;
}
$link = get_field('link');
$colorFront = get_field('color_front') ?: '#FFFFFF';
$colorFrontFont = get_field('font_color_front') ?: '#000000';
$colorBack = get_field('color_back') ?: '#FFFFFF';
$colorBackFont = get_field('font_color_back') ?: '#000000';

?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> dropShadow">
    <div class="infobox-front" style="background-color: <?php echo  esc_attr($colorFront); ?>; color:  <?php echo  esc_attr($colorFrontFont); ?>;">
        <img src="<?php echo esc_url($icon); ?>" alt="<?php echo esc_attr($titel); ?>" />
        <h3><?php echo esc_attr($titel) ?></h3>
    </div>

     <?php if( ! empty($link) ) { echo '<a href="' . $link . '">'; } ?>
          <div class="infobox-back" style="background-color: <?php echo esc_attr($colorBack); ?>; color:  <?php echo  esc_attr($colorBackFont); ?>;">
               <h3><?php echo esc_attr($titel) ?></h3>
               <ul class="infobox-content">
               <?php foreach( $content as $listItem ) {
                    echo '<li>' . esc_attr($listItem) . '</li>';
               } ?>
               </ul>
          </div>
     <?php if( ! empty($link) ) { echo '</a>'; } ?>

</div>
