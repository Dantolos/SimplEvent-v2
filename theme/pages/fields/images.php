<?php

namespace SE2\ThemeSettings\Fields\Images;

function input_images( $label,  $id, $slug, $currData, $neg = false ){
     $negClass = ($neg) ? 'image-neg' : '';
     $imageInput = '';
     $imageInput .= '<div class="image-preview '.$negClass.'"><img src="'. $currData .'" /></div>';
     $imageInput .= '<input type="button" style="width:25%;" value="'.$label.'" class="button button-secondary upload-button" data-target="'. $id .'"/>';
     $imageInput .= '<input type="" style="width:73%;" id="'. $id .'" name="'.$slug.'" value="' . $currData . '"/>';
     return $imageInput;
}