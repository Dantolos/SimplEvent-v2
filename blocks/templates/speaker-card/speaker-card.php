<?php
/**
 * Speaker Card Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$id = 'speaker-card-' . $block['id'];
if( !empty($block['anchor']) ) {
   $id = $block['anchor'];
}

$className = 'speaker-card';
if( !empty($block['className']) ) {
   $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
   $className .= ' align' . $block['align'];
}

$LineUp = new LineUp;
$speakerID = get_field('speaker');

?> 


<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" style="width:100%;height:300px;">
     
     <?php
     echo $LineUp->cast_speaker_card_block( $speakerID );
     ?>
     
   
</div>