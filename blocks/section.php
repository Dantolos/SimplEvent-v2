<?php
add_action('init', function() {
   
     wp_register_script('se2-section-js', get_template_directory_uri() . '/blocks/build/dynamic_blocks/section/section-reg.js');
	register_block_type('se2/section', [
		'editor_script' => 'se2-section-js',
		'render_callback' => 'se2_section_render',
		'attributes' => [
               'containerstyle' => [ 
                    'type' => 'object',
                    'default' => [
                         'position'               => 'relative',
                         'height'                 => 'auto',
                         'width'                  => 'auto', 
                         'minHeight'              => 'auto',                        
                         'margin'                 => '0',
                         'padding'                => '0',
                         'backgroundColor'        => '#f1f1f1',
                         'backgroundImage'        => 'none',
                         'backgroundSize'         => 'cover',
                         'backgroundRepeat'       => 'no-repeat',
                         'backgroundAttachment'   => 'scroll',
                         'backgroundPosition'     => 'center',
                         'borderWidth'            =>  'unset',
                         'borderStyle'            => 'solid',
                         'borderColor'            => '#ffffff',
                         'borderRadius'           => 'unset',
                         'clipPath'               => 'unset',
                         'video'                  => 'false'
                    ]
               ],
               'style' => [
                    'type' => 'object',
                    'default' => []
               ],
           
              
          ],
	]);
});
 
function se2_section_render($attr, $content) {
     $style;
     $video = '';

     if( is_array( $attr['style'])  ){
          $style = '';
          foreach( $attr['style'] as $tagKey => $styleTag ){
               $tagKey = preg_replace('/([A-Z])/', '-$1', $tagKey);
               if( $tagKey !== 'video'){
                    
                    $style .= strtolower($tagKey) . ':' . $styleTag . '; ';   
               } else {
                     if($attr['style']['video'] !== 'false'){
                         $videoStyle = 'position: absolute; right: 0; bottom: 0; min-width: 100%; min-height: 100%;';
                         $video = '<video class="background-video" style="'.$videoStyle.'" autoplay loop muted playsinline><source src="' . $attr['style']['video']['url']. '" type="'.$attr['style']['video']['mime'].'" ></video>';
                    } 
               }
          }
     }
     
   
	return '<div style="position:relative; ' . $style . '">'.$video.$content.'</div>';
}