<?php


class se2_Slider {

    /* 
        QUOTE SLIDER
        ---------------------------------------
        needs an array of slider content
        require : ['quote'], ['author']['name'] and ['author']['desc'] 
        optional: ['image']
    */
    public function QuoteSlider( $quotesArray ) {
        if( is_array(  $quotesArray  ) ){
            $QuoteSlider = '';
            $QuoteSlider .= '<div class="signle-page-quotes quote-splide splide" style="width:100%;">';
            $QuoteSlider .= '<div class="splide__track"><ul class="splide__list">';
            
            foreach ( $quotesArray as $quote ) {
                $QuoteSlider .= $this->Quote( $quote );
            }

            $QuoteSlider .= '</ul></div>'; 
            $QuoteSlider .= '</div>';
            return $QuoteSlider;
        }
    }
    public function Quote( $quote ){
        $Quote = '';
        $Quote .= '<li class="splide__slide">';
        $Quote .= '<div class="signle-page-quote">';
        $Quote .= '<h3>'.$quote['quote'].'</h3>';
        $Quote .= '<p><b>'.$quote['author']['name'].'</b><br />'.$quote['author']['desc'].'</p>';
        $Quote .= '</div>';
        $Quote .= '</li>';
        return $Quote;
    }
    // QUOTE SLIDER END


    /*
        SPEAKER SLIDER
        ---------------------------------------
        needs an array of speaker id's
        options: carouselCount (int) = speaker amount per slidepage
    */
    public function LineUpSlider( $SpeakerArray, $carouselCount = 3 ) {            
            $LineUpSlider = '';
            if( is_array(  $SpeakerArray  ) ){
                $LineUpSlider .= '<div class="speaker-splide splide" style="width:100%;" perpage="'.$carouselCount.'">';
                    $LineUpSlider .= '<div class="splide__track"><ul class="splide__list">';
                    foreach ( $SpeakerArray as $speakerID) {
                        $LineUpSlider .= $this->Speaker( $speakerID );
                    }
                    $LineUpSlider .= '</ul></div>';
                $LineUpSlider .= '</div>';
               
            }
            return $LineUpSlider;
    }

    public function Speaker( $speakerID ){
        $LineUp = new LineUp;
        $Speaker = '';
        $Speaker .= '<li class="splide__slide">';
        $Speaker .= $LineUp->cast_speaker_grid( $speakerID );
        $Speaker .= '</li>';
        return $Speaker;
    }
    // SPEAKERSLIDER END
}