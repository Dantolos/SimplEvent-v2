<?php

class se2_page_builder{
     public function build_settings(){

     }


     // IMAGE INPUT
     // label: displayed name, 
     // id: unique id -> settingregistration
     // slug: reference to data, 
     // currData: current data saved in db
     // neg: if true, casts a background behind negative images
     public static function input_images( $label,  $id, $slug, $currData, $neg = false ){
          $negClass = ($neg) ? 'image-neg' : '';
          $imageInput = '';
          $imageInput .= '<div class="image-preview '.$negClass.'"><img src="'. $currData .'" /></div>';
          $imageInput .= '<input type="button" style="width:25%;" value="'.$label.'" class="button button-secondary upload-button" data-target="'. $id .'"/>';
          $imageInput .= '<input type="" style="width:73%;" id="'. $id .'" name="'.$slug.'" value="' . $currData . '"/>';
          return $imageInput;
     }

     

}
