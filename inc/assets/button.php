<?php

class Button {
    
    public $buttonOutput;
    public $target;
    public $colorclass;
    public $paramLink;

    public function cast_Button( $text, $link, $target = 0, $color = 'std' ) {

        if( $target != 0 ){
            $this->target = $target;
        } else {
            $siteLink = site_url();
            $linkCheck = strpos($link, $siteLink);
            if( $linkCheck !== false ) {
                $this->target = '_self';
            } else {
                $this->target = '_blank';
            }
        }
        
        switch($color)
        {
            case 'std':
                    $this->colorclass = 'se-color-txt-g2';
                    break; 
            case 'blue':
                    $this->colorclass = 'se-color-txt-b';
                    break;
            default:
                    $this->colorclass = $color;
                    break;
        }

        $this->buttonOutput = '';
        if( intval($link) )
        {
            $this->paramLink = 'paramlink="' . $link . '"';
        } else if( $link[0] === '_' ) {
            $this->paramLink = 'trigger="' . $link . '"';
        } else {
            $this->buttonOutput .= '<a class="' . $this->colorclass . '" href="' . $link . '" target="' . $this->target . '">';
        }
        $this->buttonOutput .= '<div class="se-button" ' . $this->paramLink . '>';
        $this->buttonOutput .= $text;
        $this->buttonOutput .= '</div>';
        if( !intval($link) && $link[0] != '_' )
        {
            $this->buttonOutput .= '</a>';
        }
        
          
        return $this->buttonOutput; 
    }
}