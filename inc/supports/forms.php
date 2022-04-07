<?php



class se2_Forms {

     public $output;



     public function castDropdown( $name, $options, $all = false, $selected = false ) {

          

          $this->output = '<select name="'.$name.'" id="'.$name.'" class="se2-dropdown">';

          if( $all ){
               $this->output .= '<option value="all">'.__('Alle', 'SimplEvent').'</option>';
          }

          // placeholder for multiple selected options
          if(is_array($selected)){
               $selected = (count($selected) > 1) ? 'placeholder' : reset($selected);
          }
          if( $selected === 'placeholder' ){
               $this->output .= '<option value="" disabled selected>'.__('Filter', 'SimplEvent').'</option>';
          }
          foreach( $options as $option ){
               
               if( is_array($option) ){
                    $preSelected = ($selected === $option['key'] ) ? 'selected': '';
                    $this->output .= '<option value="'.$option['key'].'" '.$preSelected.'>'.$option['name'].'</option>';
               } else {
                    $preSelected = ($selected === $option ) ? 'selected': '';
                    $this->output .= '<option value="'.$option.'" '.$preSelected.'>'.$option.'</option>';
               }
               
          }

          $this->output .= '</select>';

          return $this->output;

     }

}