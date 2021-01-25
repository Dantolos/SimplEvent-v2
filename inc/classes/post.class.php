<?php 
class Posts {
    

     public function call_Post_Data( $post_type, $order = 'ASC' )
     {
          $post_args = array(
               'post_type' => $post_type, 
               'orderby' => 'term_order', 
               'order' => $order
          );
          return new WP_Query( $post_args );
          
     }


}