<?php 
class Company extends Posts {

    public $output;
    public $company;
    public $posts = array();
 

    public function call_Post_Wall( $labelyear = false, $order = 'ASC', $orderby = 'date', $acfField = false, $subField = false, $dateFormat = false ) {
     
        $this->company = parent::call_Post_Data('company', $order, $orderby, $acfField, $subField, $dateFormat );

        
        foreach( $this->company->posts as $company ){
          $date = strtotime( get_field('Key data', $company->ID )['label'] );
          if( $labelyear && date( 'Y', $date) != $labelyear ) {
               continue;
          }
            if( get_field('erfolgsgeschicht', $company->ID)['public'] ){

                $post = array();
                $post['ID'] = $company->ID;
                $post['title'] = esc_attr(get_field('erfolgsgeschicht', $company->ID)['title']) ?: '';
                $post['content'] = get_field('erfolgsgeschicht', $company->ID)['content'] ?: '';
                $post['thumbnail'] = esc_url(get_field('erfolgsgeschicht', $company->ID)['thumbnail']) ?: '';
                $post['date'] = date( 'd. M. Y', $date);

                $this->posts[$company->ID] = $post;
            }
        }

       //reverse the array
        

        foreach( $this->posts as $post ) {

            $this->output .= '<div class="se2-post" postid="' . $post['ID'] . '">';
            if($post['thumbnail']){
               $this->output .= '<div class="se2-post-image" style="background-image:url(' . $post['thumbnail'] . ')"></div>';
            }
            
            if( get_field('media', $post['ID'])['logo_positiv'] ){
               $this->output .= '<div class="se2-post-logo"><img src="' . esc_url(get_field('media', $post['ID'])['logo_positiv'] ) . '"/></div>';
            }
            
            $this->output .= '<div class="se2-post-content">';
            $this->output .= '<h2>' . $post['title'] . '</h2>';
            $this->output .= '<p>' . $post['content'] . '</p>';
            $this->output .= '</div>';
            $this->output .= '</div>';
            
        }

        return $this->output;
    }

    //CATEGORIE: YEARS
    function call_Companies_Categories( $type = false ){
     $result = '';
     $this->companyData = parent::call_Post_Data('company');

     //YEAR
     if($type = 'year'){
          $years = array();
          foreach( $this->companyData->posts as $company ){
               if( get_field('Key data', $company->ID ) ){
                    if( get_field('Key data', $company->ID )['label'] ){
                         $year = date( 'Y', strtotime( get_field('Key data', $company->ID )['label'] ) );
                         if( !in_array( $year, $years ) ) {
                              array_push( $years, $year);
                              arsort($years);
                         }
                    }
               }
          }
          
          foreach($years as $y){
               $result .= '<span year="' . $y . '">' . $y . '</span>';
          }
    
     }

     return $result;
    
}

}