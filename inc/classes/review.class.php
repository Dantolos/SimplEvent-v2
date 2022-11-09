<?php
class Review {
    
    public $dateFormat;
    public $fileSize;
    public $mediacorner;
    public $LineUpPage;
    public $LineUp; 
    public $Slider;

    public function __construct(){
        $this->dateFormat = new \se2\support\Date_Format;
        
        $this->fileSize = new se2_Files;
        $this->Slider = new se2_Slider;

        $MediaCornerArgs = [
            'post_type' => 'page',
            'nopaging' => true,
            'meta_key' => '_wp_page_template',
            'meta_value' => 'Templates/mediacorner.php'
        ];
        $this->mediacorner = get_posts( $MediaCornerArgs );
        if(is_array($this->mediacorner)){
            $this->mediacorner = ( count($this->mediacorner) >= 1 ) ? $this->mediacorner[0]->ID : false;
        } else {
            $this->mediacorner = false;
        }

        $LineUpArgs = [
            'post_type' => 'page',
            'nopaging' => true,
            'meta_key' => '_wp_page_template',
            'meta_value' => 'Templates/lineup.php'
        ];
        $this->LineUpPage = get_posts( $LineUpArgs );
        $this->LineUpPage = (is_array($this->LineUpPage)) ? $this->LineUpPage[0]->ID : false;
    }

    public function cast_overview_review( $pageID ){
        $overview = '<div class="review-overview container">';
        $overview .= '<h2>REVIEWS</h2>';
        $reviews = get_field( 'review_sites', $pageID );
        if( $reviews ){
            $overview .= '<div class="review-overview-grid">';
            foreach($reviews as $review ){
                $overview .= $this->cast_overview_box( $review );
            }
            $overview .= '</div>';
        }
        $overview .= '</div>';
        return $overview;
    }

    public function cast_overview_box( $review ){
        global $wp;
        $current_url = home_url( add_query_arg( array(), $wp->request ) ); 
        $reviewYear = $review['infos']['jahr']->name;

        $overviewBox = '';
        
        $overviewBox .= '<div class="review-overview-box">';
        $overviewBox .= '<a href="'.$current_url.'/?j='.$reviewYear.'">';
            $overviewBox .= '<div class="review-overview-box-image" style="background-image:url('.$review['content']['visual'].');">';
            $overviewBox .= '<h3>'.$reviewYear.'</h3>';
            $overviewBox .= '</div>';
            $overviewBox .= '<div class="review-overview-box-content">';
            $overviewBox .= '<p>'.$review['infos']['date'].'</p>';
            $overviewBox .= '<h3>'.$review['infos']['motto'].'</h3>'; 
                        
            
            $overviewBox .= '</div>';
            $overviewBox .= '</a>';
        $overviewBox .= '</div>';
       
        
        return $overviewBox;
    }

    public function cast_single_review( $pageID, $index ){
        $review = get_field( 'review_sites', $pageID )[$index];
        $single = '<div class="review-single">';
            $single .= '<div class="review-single-header" style="background-image:url('.$review['content']['visual'].');"></div>';
            
            $single .= '<div class="review-single-content container">';
  
                $single .= '<div class="review-single-page">';
                    $single .= '<h2>'.$review['infos']['motto'].'</h2>';
                    $single .= '<h4>'.$review['infos']['date'].'</h4>';
                    $single .= '<p>'.$review['infos']['desc'].'</p>';

                    //QUOTES
                    $single .= $this->Slider->QuoteSlider( $review['infos']['quotes'] );
                   
                    //SPEAKER
                    $speakerIDs = []; 
                    if( isset($review['content']['speaker selection']) ){
                        foreach ($review['content']['speaker selection'] as $speaker ) {
                            array_push($speakerIDs, $speaker );
                        }
                    } else {
                        $speaker_args = array(
                            'post_status' => array( 'publish' ), 'post_type' => 'speakers', 'tax_query' => array(
                                array(
                                    'taxonomy' => 'jahr', 'field' => 'term_id', 'terms' => $review['infos']['jahr']->term_id,
                                ),
                            ),
                        );
                        $speakerData = new WP_Query( $speaker_args );
                        //$single .= var_dump($speakerData);
                        foreach ($speakerData->posts as $speaker  ) {
                            array_push($speakerIDs, $speaker->ID );
                        }
                    }
                    
                    if( count($speakerIDs) > 0 ){
                        $single .= '<div class="review-single-speaker">';
                        $single .= '<h3>'.__('Speakers', 'SimplEvent').'</h3>';

                            $single .= '<div id="lineup-container" year="'.$review['infos']['jahr']->name.'" >';
                            $single .= $this->Slider->LineUpSlider($speakerIDs, 3);
                            $single .= '</div>';

                            $single .= '<a href="'.get_permalink($this->LineUpPage).'/?j='.$review['infos']['jahr']->name.'">';
                            $single .= '<div class="review-single-speaker-allspeaker">';
                            $single .= '<p>'.__( 'Alle Speaker', 'SimplEvent' ).'</p>';
                            $single .= '</div>';
                            $single .= '</a>';
                        $single .= '</div>';
                    }

                    //FOTOS
                    if( is_array($review['content']['fotos'])) {
                        $single .= '<div class="gallery-splide">';
                        $single .= '<h3>'.__('Fotos', 'SimplEvent').'</h3>';
                        $single .= '<div class="gallery-splide-main splide" >';
                            $single .= '<div class="splide__track"><ul class="splide__list">';
                            foreach ($review['content']['fotos'] as $key => $foto) {
                                $single .= '<li class="splide__slide">';
                                $single .= '<div style="background-image: url('.esc_url($foto).')"></div>';
                                $single .= '</li>';
                            }
                            $single .= '</ul></div>';
                        $single .= '</div>';

                        $single .= '<div class="gallery-splide-thumb splide" >';
                            $single .= '<div class="splide__track"><ul class="splide__list">';
                            foreach ($review['content']['fotos'] as $key => $foto) {
                                $single .= '<li class="splide__slide">';
                                $single .= '<img src="'.esc_url($foto).'"  title="-'.$review['infos']['jahr']->name.'-'.$key.'" />';
                                $single .= '</li>';
                            }
                            $single .= '</ul></div>';
                        $single .= '</div>';
                        $single .= '</div>';
                    }

                $single .= '</div>';



                //SIDEBAR
                $single .= '<div class="review-single-sidebar">';

                    //Video Report
                    $single .= '<div class="review-single-video">';
                        $single .= '<iframe width="100%" height="100%" src="'.$review['content']['video'].'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                    $single .= '</div>';
                    
                    //PRESS REALESES
                    
                    if($this->mediacorner){
                        $pressRealeses = get_field('medienmitteilungen', $this->mediacorner);
                        if( is_array($pressRealeses) ){
                            $pressOutput = false;
                            foreach($pressRealeses as $realese){
                                
                                if( intval( date( 'Y', strtotime( str_replace( '/', '-',  $realese['public']) ) ) ) != intval( $review['infos']['jahr']->slug ) ){ 
                                    continue; 
                                }
                                if( date( 'YmdHi', strtotime( str_replace( '/', '-',  $realese['public']) )) > date( 'YmdHi' ) ){
                                    continue;
                                }
                                $pressOutput .= '<a class="a-link" href="'.$realese['file'].'" download>';
                                $pressOutput .= '<div class="data-table-row">';
                                
                                $pressOutput .= '<p class="data-table-link">'.$realese['titel'].' <i>('.$this->fileSize->getRemoteFilesize( $realese['file'] ).')</i></p>';
                                $pressOutput .= '<p class="data-table-date"><b>'.$this->dateFormat->formating_Date_Language( $realese['public'], 'date' ).'</b></p>';
                            
                                $pressOutput .= '</div>';
                                $pressOutput .= '</a>';
                            }

                            if($pressOutput){
                                $single .= '<div class="review-single-medienmitteilungen data-table">';
                                $single .= '<h4>'.__( 'Medienmitteilungen', 'SimplEvent' ).'</h4>';
                                $single .= $pressOutput;
                                $single .= '</div>';
                            }
                        }
                       
                    }
                    


                    //MEDIENSPIEGEL
                    $medienspiegel = $review['content']['medienspiegel'];
                    if( is_array( $medienspiegel ) ){
                        $single .= '<div class="review-single-medienspiegel data-table">';
                        $single .= '<h4>'.__( 'Medienspiegel', 'SimplEvent' ).'</h4>';
                        foreach( $medienspiegel as $medienlink ){
                            $single .= '<a class="a-link" href="'.$medienlink['link']['title'].'" target="_blank">';
                            $single .= '<div class="data-table-row">';
                            $single .= '<p class="data-table-link">'.$medienlink['link']['title'].'</p>';
                            $single .= '<p class="data-table-date"><b>'.$this->dateFormat->formating_Date_Language( $medienlink['datum'], 'date' ).'</b></p>';
                            $single .= '</div>';
                            $single .= '</a>';
                        }
                        $single .= '</div>';
                    }

                    //MEDIACORNER HINWEIS
                    if($this->mediacorner){
                        $single .= '<div class="review-single-sidebar-mediacorner">';
                        $mediacornerText = 'Weiteres Material für Ihre medialen Kommunikationen wie Fotos, Videos, Audio finden Sie in unserem Mediacorner.';
                        $mediacornerText = str_replace( 'Mediacorner', '<a href="'.get_permalink($this->mediacorner).'">Mediacorner</a>', $mediacornerText );
                        $single .= '<p style="line-height:1.4em;">'.$mediacornerText.'</p>';
                        $single .= '</div>';
                    }

                    

                $single .= '</div>';
            $single .= '</div>';

        $single .= '</div>';
        return $single;
    }

}