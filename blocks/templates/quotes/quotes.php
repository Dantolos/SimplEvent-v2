<?php
/**
 * Quotes Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

//splidejs
//wp_enqueue_style( 'slidejs-style-backend', '', '', '1.0.27' );
$upOne = dirname(__DIR__, 3);
require_once( $upOne . '/inc/supports/slider.php' );

$Slider = new se2_Slider;

$id = 'quotes-' . $block['id'];
$className = 'quotes';
if( !empty($block['className']) ) {
   $className .= ' ' . $block['className'];
}

$Quotes = get_field('quotes');

?> 


<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" style="width:100%;">

   
    <?php 
    if($Quotes){
        //FRONTEND
        if(!is_admin()){
            echo $Slider->QuoteSlider( $Quotes );
        }
        //Backend
        else {
            echo '<div class="signle-page-quotes">';
            echo $Slider->Quote( $Quotes[0] );
            echo '<div>';
        }
     
       
    } else {
        echo '<div style="background-color:#bebebe;color:#515151;padding:100px;"><h2>Keine Quotes hinterlegt.</h2></div>';
    }
    ?>

   
</div>