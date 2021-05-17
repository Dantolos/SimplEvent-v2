<?php
/**
 * Testimonial Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$id = 'testimonial-' . $block['id'];
if( !empty($block['anchor']) ) {
   $id = $block['anchor'];
}

$className = 'testimonial';
if( !empty($block['className']) ) {
   $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
   $className .= ' align' . $block['align'];
}

?> 


<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    
    <?php foreach(get_field('companies') as $key => $companyID ) {
        if( have_rows( 'testimonials', $companyID ) ):
            
            while( have_rows( 'testimonials', $companyID ) ) : the_row();
            ?>
                <div class="testimonial-container" slide="<?php echo $key; ?>">
                    <div class="testimonial-portrait-container"><div class="testimonial-portrait" style="background-image:url(<?php echo esc_url(get_sub_field('portrait')); ?>);"></div></div>
                    <div class="testimonial-text">
                        <blockquote><i><?php echo get_sub_field('quote'); ?></i></blockquote>
                        <p><b><?php echo esc_attr( get_sub_field('reference')['name'] ); ?></b> <?php echo esc_attr( (get_sub_field('reference')['position']) ); ?></p>
                    </div>      
                </div>
            <?php 
            endwhile;
        endif;
    } ?>
   
</div>