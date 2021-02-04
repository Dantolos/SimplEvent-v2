<?php
/**
 * Word Cloud Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$id = 'word-cloud-' . $block['id'];
if( !empty($block['anchor']) ) {
   $id = $block['anchor'];
}

$className = 'word-cloud';
if( !empty($block['className']) ) {
   $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
   $className .= ' align' . $block['align'];
}

$posts = get_field('type')
?>


<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
 
    <?php
          $countLoop = 1;
         foreach($posts as $post){
              $style = ( $countLoop%2 == 0 ) ? 'sec' : '';
              $degree = !empty(get_field('speaker_degree', $post )) ? get_field('speaker_degree', $post ) . ' ' : '';
              echo '<span wordid="'.$post.'">'.$degree.esc_attr(get_field('speaker_vorname', $post )).' '.esc_attr(get_field('speaker_nachname', $post )).'</span>';
         }          
    ?>
   
</div>