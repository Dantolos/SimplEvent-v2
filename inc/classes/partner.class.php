<?php 
class Partner {

    public $output;
    public $button;
    public $lbTheme;

    public function call_Partner_in_Categorie( $catID, $catTitle = false, $formatet = true )
    {
          $partner_args = array(
               'post_type' => 'partners', 'orderby' => 'title', 'order' => 'ASC', 'tax_query' => array(
                    array(
                         'taxonomy' => 'partner_categories', 'field' => 'term_id', 'terms' => $catID, 
                    ),
               ),
          );
          
          $partners = new WP_Query($partner_args);

          $this->output = '';
 
          //formatierte rückgabe
          if($formatet){

               if( $catTitle ) {
                    $this->output .= $this->call_Categorie_Title( $catID );
               }

               if( $partners->posts ) 
               {
                    
                    foreach( $partners->posts as $partner )
                    { 
                         $tepartnerID = $partner->ID; 
                         $this->output .= '<div class="partner-logo-box" pid="' . $tepartnerID . '" >';
                         $this->output .= '<img src="'. get_field('partner-logo', $tepartnerID ) .'" alt="' . $partner->post_name . '">';              
                         $this->output .= '</div>';
                    } 
               }
          //reine daten
          } else {
               if( $partners->posts ) 
               {
                    $this->output = array();
                    foreach( $partners->posts as $partner )
                    { 
                         $partnerArray = array();
                         $partnerArray['name'] = get_the_title( $partner->ID );;
                         $partnerArray['logo-pos'] = get_field('partner-logo', $partner->ID );
                         $partnerArray['logo-neg'] = get_field('partner-logo-neg', $partner->ID );
                         $partnerArray['link'] = get_field('partner-link', $partner->ID );
                         array_push( $this->output, $partnerArray );
                    }
               }

          }

          return $this->output;
     }

    public function call_Categorie_Title( $catID ) {
        $catTitle = get_term($catID);    
        return '<div class="partner-cat-title" catid="' . $catID . '"><h3>' . $catTitle->name . '</h3></div>';
    }

    public function call_Partner_Infos( $partnerID ) {
        $this->output = '<div class="partner-info" pid="' . $partnerID . '" >';
        $this->output .= '<img src="'. get_field('partner-logo', $partnerID ) .'" alt="' . the_title($partnerID) . '">';              
        $this->output .= '<h3>' . the_title($partnerID) . '</h3>';
        $this->output .= '<p>' . get_field('partner-text', $partnerID ) . '</p>';
        $this->output .= '<a class="secondary-txt" href="' . get_field( 'partner-link', $partnerID ) . '" target="_blank">' . __( 'Webseite', 'SimplEvent' ) . '</a>';
        $this->output .= '</div>';
        return $this->output;
    }
}