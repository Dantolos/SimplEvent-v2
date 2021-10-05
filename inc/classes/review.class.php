<?php
class Review {

    public function __construct(){
    }

    public function cast_overview_review( $pageID ){
        $overview = '<div>';
        $overview .= 'OVERVIEW';
        $overview .= '</div>';
        return $overview;
    }

    public function cast_single_review( $pageID, $index ){
        $review = get_field( 'review_sites', $pageID )[$index];
        $single = '<div class="review-single">';
            $single .= '<div class="review-single-header" style="background-image:url('.$review['content']['visual'].');"></div>';
            
            $single .= '<div class="review-single-content container">';
  
                $single .= '<h2>'.$review['infos']['motto'].'</h2>';
                $single .= '<h6>'.$review['infos']['date'].'</h6>';

                $single .= '<div class="review-single-sidebar">';
                    $single .= '<div class="review-single-video">';
                        $single .= '<iframe width="100%" height="100%" src="https://www.youtube.com/embed/EWnwVseQZHg?controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                    $single .= '</div>';
                $single .= '</div>';
            $single .= '</div>';

        $single .= '</div>';
        return $single;
    }

}