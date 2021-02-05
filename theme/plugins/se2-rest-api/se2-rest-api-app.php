<?php


function se2_partner_rest( WP_REST_Request $request ){
     $args = array(
          'post_type' => 'partners',
     );

     $partners = get_posts( $args );

     $result = [];

     if(!empty($partners)){
          for ($i=0; $i < count($partners); $i++) { 

               $postID = $partners[$i]->ID;
               $lang = apply_filters( 'wpml_post_language_details', NULL, intval($postID) );
               $categories = wp_get_post_terms($postID, 'partner_categories');

               //FILTERS
               //language (param l=*language-code*)
               if(isset($_GET['l']) && $_GET['l'] != $lang['language_code']){
                    continue;
               }  
               //categore (param c=*term-slug*)
               if( isset($_GET['c']) ){
                    $issame = false;
                    foreach( $categories as $category ){
                         if( $category->slug == $_GET['c']){
                              $issame = true;
                         }
                    }
                    if( !$issame ){ continue; }
               }  

               //RESULT
               //$result[$i]['ID'] = $postID;
               $result[$i]['company'] = $partners[$i]->post_title;
               $result[$i]['language'] = $lang['language_code'];
               $result[$i]['logos']['positiv'] = !empty (get_field('partner-logo', $postID)) ? get_field('partner-logo', $postID) : '';
               $result[$i]['logos']['negativ'] = !empty (get_field('partner-logo-neg', $postID)) ? get_field('partner-logo', $postID) : '';
               $result[$i]['webseite'] = get_field('partner-link', $postID);

               //PARTNER CATEGORIES
               if( !empty($categories) ){
                    foreach( $categories as $category ){
                         $result[$i]['partner_categories'][$category->slug] = $category->name;
                    }
               }
               
               $result[$i]['text'] = get_field('partner-text', $postID);


               //SOCIAL MEDIA
               $socialmedialinks = get_field('social_media', $postID);
               if( $socialmedialinks['social_media'] ){
                    foreach($socialmedialinks['social_media'] as $sm)
                    $result[$i]['social_media'][$sm['acf_fc_layout']] = $sm['sm_link'];
               } else {
                    $result[$i]['social_media'] = false;
               }
               
          }
     }
     array_values($result);
     return $result;
}



add_action('rest_api_init', function() {
     register_rest_route('se2/app', 'partner', [
          'method' => 'GET',
          'callback' => 'se2_partner_rest'
     ]);
});