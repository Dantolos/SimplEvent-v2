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

            $this->output .= '<div class="se2-post" postid="' . $post['ID'] . '" lb="company_lightbox">';
            if($post['thumbnail']){
               $this->output .= '<div class="se2-post-image" ><div style="background-image:url(' . $post['thumbnail'] . ')"></div></div>';
            }
            
            if( get_field('media', $post['ID'])['logo_positiv'] ){
               $this->output .= '<div class="se2-post-logo"><img src="' . esc_url(get_field('media', $post['ID'])['logo_positiv'] ) . '"/></div>';
            }
            
            $this->output .= '<div class="se2-post-content">';
            $this->output .= '<h2>' . $post['title'] . '</h2>';

            $introtext = $post['content'];
            $introtext = str_replace( '<h3>', '<b>', $introtext ); 
            $introtext = str_replace( '</h3>', '</b><br />', $introtext ); 
            $introtext = str_replace( '<i>', '', $introtext ); 
            $introtext = str_replace( '</i>', '', $introtext ); 
            $tagEliminations = array("<p>", "</p>", '<div>', '</div>');
            $introtext = str_replace( $tagEliminations, '', $introtext ); 
            $introtext_length = strpos( $introtext , '.', 200 ) + 1;
            $this->output .= '<p>' . substr( $introtext, 0, $introtext_length ) . ' <span class="secondary-txt">' . __(' ... mehr', 'SimplEvent') . '</span></p>';
            $this->output .= '</div>';
            $this->output .= '</div>';
            
        }

        return $this->output;
    }

    //CATEGORIE: YEARS
    function call_Companies_Categories( $type = false ){
     $result = '';
     $this->companyData = parent::call_Post_Data('company',  'DSC', 'meta_value', 'Key data', 'label', true );

          //YEAR
          if($type === 'year'){
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
               return $result;
          }
     }

     public function call_Company_Lightbox( $ID ){
          intval($ID);
          $this->output = '<div class="se2-post-lightbox">'; 
                  
          $this->output .= '<div class="se2-post-header " style="background-image:url('.esc_url(get_field('erfolgsgeschicht', $ID)['thumbnail']).');"></div>';

          $this->output .= '<div class="se2-post-lb-company-content">';
               $this->output .= '<div class="se2-post-lb-company-post">';
               $this->output .= '<h2>'. esc_attr(get_field('erfolgsgeschicht',$ID)['title']) .'</h2>';
               $this->output .= get_field('erfolgsgeschicht',$ID)['content'];
               $this->output .= '</div>';

               //COMPANY
               $this->output .= '<div class="se2-post-lb-company-info">';
                    //logo
                    if( get_field('media', $ID)['logo_positiv'] ){
                         $this->output .= '<div class="se2-post-logo"><img src="' . esc_url(get_field('media', $ID)['logo_positiv'] ) . '"/></div>';
                    }

                    //INFO
                    $this->output .= '<h3>'.get_the_title($ID).'</h3>';

                    if(get_field('Key data', $ID)['Founding year']){
                         $this->output .= '<p class="since">since '.get_field('Key data', $ID)['Founding year'].'</p>';
                    }

                    if(get_field('Key data', $ID)['website']){
                         $this->output .= '<a href="'.get_field('Key data', $ID)['website'].'" target="_blank">';
                         $this->output .= '<div class="se2-post-lb-company-button">'.__('Website', 'SimplEvent').'</div>';
                    }

                    if(get_field('description', $ID)){
                         $this->output .= '<p style="margin-top:20px; max-width:95%;">'.get_field('description', $ID).'</p>';
                    }
                    
               $this->output .= '</div>';
          $this->output .= '</div>';
          
          $this->output .= '</div>';
          return $this->output;
     }

    
}

