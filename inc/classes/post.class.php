<?php 
class Posts {
    

     public function call_Post_Data( $post_type, $order = 'ASC', $orderby = 'date', $meta_key = false )
     {
          $post_args = array(
               'post_type' => $post_type, 
               'order'	  => $order,
               'orderby'   => $orderby, 
             
          );
          if( $meta_key ){
               array_push( $post_args, $meta_key );
          }

          return new WP_Query( $post_args );
          
     }


}