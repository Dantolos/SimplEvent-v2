<?php

/**

 * Header Image Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */



$id = 'strip-' . $block['id'];

if( !empty($block['anchor']) ) {
   $id = $block['anchor'];
}


$className = 'strip';

if( !empty($block['className']) ) {
   $className .= ' ' . $block['className'];
}

if( !empty($block['align']) ) {
   $className .= ' align' . $block['align'];
}


$fontColor = get_field('text_color') ?  get_field('text_color').' !important': 'unset';
$height = get_field('height') ?: 'auto';
$fullpage = get_field('fullpage') ?: false;


//background-color
$backgroundColor = false;

$type = 'empty';

$backgroundColor = false;
$backgroundImage = false;
$backgroundVideo = false;

switch ( get_field('type')) {
     case 'color':
          if( null !== get_field('background_color') ){
               $backgroundColor = get_field('background_color')['background_color_code'] ?: false;
          }
          break;
     case 'image':
          $backgroundImage = get_field('background_image_group')['image'] ?: false;
          break;
     case 'video':
          $backgroundVideo = get_field('background_video_group')['video'] ?: false;
          break;
     default:
          # code...
          break;
}


$animation = array();

if( get_field('animatieren') ){

     $animationsSettings = get_field('animation_settings_group')['animation'];

     $animation = [
          'duration' => $animationsSettings['duration'],
          'stagger'  => $animationsSettings['stagger'],
     ];

     foreach ( $animationsSettings['properties_from'] as $key => $from ) {
          $animation['from'][$key] = $from;
     }

     foreach ( $animationsSettings['properties_to'] as $key => $to ) {
          $animation['to'][$key] = $to;
     }

     wp_localize_script( 'block-strip-script', 'StripAnimation', json_encode( $animation ) );

}

?>

<style>
     .strip { position:relative; overflow:hidden; }
     .background-video  {
          position: absolute;
          left: 50%; /* % of surrounding element */
          top: 50%;
          transform: translate(-50%, -50%);
          height: 100%;
          width: 177.77777778vh; /* 100 * 16 / 9 */
          min-width: 100%;
          min-height: 56.25vw;
     }
     .background-video video {  

     }
</style>





<div id="<?php echo esc_attr($id); ?>" 

     class="
          <?php 
          echo esc_attr($className); 

          if($fullpage){ echo ' focus-target fullpage'; }
          if($animation){ echo ' animation'; }
     ?>"

     style="
          color:<?php echo esc_attr($fontColor); ?> ;
          
          height: <?php if(!$animation) { echo esc_attr( $height ) . 'vh'; } else { echo 'auto'; } ?>;


          <?php 
          if($backgroundColor){ 
               echo 'background-color:'.esc_attr($backgroundColor).';';
          } 

          if($backgroundImage){ 
               echo 'background-image:url('.esc_url($backgroundImage).');';
               echo ' background-size: cover;';
               echo ' background-position: center center;';
          } ?>
     "

     >

     <?php

     if($backgroundVideo){
          echo '<video class="background-video" autoplay loop muted playsinline><source src="' . esc_url($backgroundVideo) . '" type="video/mp4"></video>';
     } ?>

     <div class="strip-inner-blocks">
          <InnerBlocks />
     </div>

</div>

