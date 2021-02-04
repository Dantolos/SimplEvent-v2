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
                             strtotime($postdatas->posts[$key]->date); 
                         }
                         
                    }
               }
               
               function subval_sort( $a, $b )
               {
                   if ( $a->label == $b->label )
                       return 0;
                   return $a->label > $b->label ? -1 : 1;
               }
               
               // Sort our multidimensional array by sub array value
               usort( $postdatas->posts, 'subval_sort' ); 
              
               
          } 

          return $postdatas;
          
     }


}