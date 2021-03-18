<?php 
class Posts {
    

     public function call_Post_Data( $post_type, $order = 'ASC', $orderby = 'date', $acfField = false, $subField = false, $dateFormat = false )
     {
          $post_args = array(
               'post_type' => $post_type, 
               'order'	  => $order,
               'orderby'   => $orderby,              
          );

          $postdatas = new WP_Query( $post_args );

          if( $acfField ){
               if( $postdatas->posts  ){
                    foreach( $postdatas->posts as $key => $post ){
                         if($subField) {
                              $postdatas->posts[$key]->date = get_field( $acfField, $post->ID )[$subField];
                         } else {
                              $postdatas->posts[$key]->date = get_field( $acfField, $post->ID );
                         }
                         if($dateFormat){
                              $postdatas->posts[$key]->date = intval(date( 'Ymd', strtotime($postdatas->posts[$key]->date))); 
                         }
                         
                    }
               }
               
               $this->sortbyacf( $postdatas->posts );
               
               
          } 

          return $postdatas;
          
     }

     public function sortbyacf( $postarray ){
          $myCmpFunc = function ( $a, $b )
          {
              if ( $a->date == $b->date )
                  return 0;
              return ( $a->date > $b->date ) ? -1 : 1;
          };
          
          // Sort our multidimensional array by sub array value
          usort( $postarray, $myCmpFunc ); 
          return $postarray;
     }


}