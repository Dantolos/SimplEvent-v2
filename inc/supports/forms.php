<?php



class se2_Forms {

     public $output;



     public function castDropdown( $name, $options, $all = false ) {

          $this->output = '<select name="'.$name.'" id="'.$name.'" class="se2-dropdown">';

          if( $all ){

               $this->output .= '<option value="all">'.__('Alle', 'SimplEvent').'</option>';

          }

          foreach( $options as $option ){

               if( is_array($option) ){
                    $this->output .= '<option value="'.$option['key'].'">'.$option['name'].'</option>';
               } else {
                    $this->output .= '<option value="'.$option.'">'.$option.'</option>';
               }
               

          }

          $this->output .= '</select>';

          return $this->output;

     }

}