<?php

header("Access-Control-Allow-Origin: *");

//------------------------------------------------------
// PARTNER
//------------------------------------------------------

function se2_partner_rest( WP_REST_Request $request ){

     $args = array(
          'post_type' => 'partners',
          'numberposts' => -1
     );

     $partners = get_posts( $args );

     $result = [];

     if(!empty($partners)){

          for ($i=0; $i < count($partners); $i++) { 

               $postID = $partners[$i]->ID;

               $lang = apply_filters( 'wpml_post_language_details', NULL, intval($postID) );
               $langFilter = false; 

               global $sitepress;

               $trid = $sitepress->get_element_trid($postID);
               $translations = $sitepress->get_element_translations($trid);
               $translationsArray = [];

               foreach( $translations as $trans){
                    $translationsArray[$trans->language_code] = $trans->element_id;
               }
               $categories = wp_get_post_terms($postID, 'partner_categories');


               //FILTERS

               //language (param l=*language-code*)
               if(isset($_GET['l']) && $_GET['l'] != $lang['language_code']){
                    $langFilter = true;
                    continue;
               }  
               if($lang['language_code']) {
                    if( $translations[$lang['language_code']]->source_language_code ){
                         continue;
                    } 
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
               $result[$i]['ID'] = $postID;

               //$result[$i]['trans-language_code'] =  $translations;

               $result[$i]['translations'] = $translationsArray;

               if( !$langFilter ) {
                    foreach($translationsArray as $key => $langID){
                         $translate_postID = icl_object_id( $langID, 'post', false, $key );
                         $result[$i]['company'][$key] = get_the_title($translate_postID);
                    }
               } else {
                    $result[$i]['company'] = $partners[$i]->post_title;
               }



               //$result[$i]['language'] = $lang['language_code'];
               if( !$langFilter ) {
                    foreach($translationsArray as $key => $langID){
                         $translate_postID = icl_object_id( $langID, 'post', false, $key );
                         $result[$i]['logos'][$key] = [
                              'positiv' => !empty (get_field('partner-logo', $translate_postID)) ? cast_array_url_base64( get_field('partner-logo', $translate_postID) ) : '',
                              'negativ' => !empty (get_field('partner-logo-neg', $translate_postID)) ? cast_array_url_base64( get_field('partner-logo', $translate_postID) ): ''
                         ];
                    }
               } else {
                    $result[$i]['logos']['positiv'] = !empty (get_field('partner-logo', $postID)) ? cast_array_url_base64( get_field('partner-logo', $postID) ) : '';
                    $result[$i]['logos']['negativ'] = !empty (get_field('partner-logo-neg', $postID)) ? cast_array_url_base64( get_field('partner-logo', $postID) ) : '';
               }



               $result[$i]['webseite'] = get_field('partner-link', $postID);


               //PARTNER CATEGORIES

               if( !empty($categories) ){
                    foreach( $categories as $category ){
                         $result[$i]['partner_categories'][$category->slug] = [$category->term_id, $category->name];
                    }
               }


               if( !$langFilter ) {
                    foreach($translationsArray as $key => $langID){
                         $translate_postID = icl_object_id( $langID, 'post', false, $key );
                         $result[$i]['text'][$key] = get_field('partner-text', $translate_postID );
                    }
               }else {
                    $result[$i]['text'] = get_field('partner-text', $postID);
               }

               //SOCIAL MEDIA
               $socialmedialinks = get_field('social_media', $postID);
               if( $socialmedialinks['social_media'] ){
                    foreach($socialmedialinks['social_media'] as $sm){      
                         if( strlen($sm[$sm['acf_fc_layout']]) > 2 ){
                              $result[$i]['social_media'][$sm['acf_fc_layout']] = $sm[$sm['acf_fc_layout']];
                         }
                    }
               } else {
                    $result[$i]['social_media'] = false;
               }
          }
     }

     array_values($result);
     return $result;
}

// KATEGORIERN
function se2_partner_categories_rest( WP_REST_Request $request ){

     

     $partnerCategories = get_terms(  array( 'taxonomy' => 'partner_categories', 'hide_empty' => false, ) );
     $count = count($partnerCategories);
     $result = [];
     if ( $count > 0 ){
          global $sitepress;
          $current_lang = $sitepress->get_current_language();
          foreach ( $partnerCategories as $category ) {
               $languages = ['de', 'en', 'fr'];
               
               foreach($languages as $lang){
                    $partnerCategorieID =  apply_filters( 'wpml_object_id', $category->term_id, 'partner_categories', FALSE, $lang); 
                    if($partnerCategorieID){
                         $sitepress->switch_lang($lang);
                         $translate_postID = icl_object_id( $partnerCategorieID, 'partner_categories', false, $lang );
                         
                         $result[$category->term_id][$lang]['ID'] = $partnerCategorieID;
                         $result[$category->term_id][$lang]['Bezeichnung'] = get_term( $partnerCategorieID, 'partner_categories', $lang )->name;

                    }
               }
               $sitepress->switch_lang($current_lang);

          }
          
     }

     

     array_values($result);
     return $result;
}
//------------------------------------------------------

//------------------------------------------------------
// SPEAKER
//------------------------------------------------------

function se2_speakers_rest( WP_REST_Request $request ){

     $args = array(
          'post_type' => 'speakers',
          'numberposts' => -1
     );
     $speakers = get_posts( $args );
     $result = [];

     if(!empty($speakers)){
          for ($i=0; $i < count($speakers); $i++) { 
               $postID = $speakers[$i]->ID;

               $lang = apply_filters( 'wpml_post_language_details', NULL, intval($postID) );
               $langFilter = false; 

               global $sitepress;

               $trid = $sitepress->get_element_trid($postID);
               $translations = $sitepress->get_element_translations($trid);
               $translationsArray = [];

               foreach( $translations as $trans){
                    $translationsArray[$trans->language_code] = $trans->element_id;
               }
               $jahre = wp_get_post_terms($postID, 'jahr');

               //FILTERS
               //language (param l=*language-code*)
               if(isset($_GET['l']) && $_GET['l'] != $lang['language_code']){
                    $langFilter = true;
                    continue;
               }  

               if($lang['language_code']) {
                    if( $translations[$lang['language_code']]->source_language_code ){
                         continue;
                    } 
               } 

               //jahr (param j=*2021*)
               if( isset($_GET['j']) ){

                    $issame = false;

                    foreach( $jahre as $jahr ){
                         if( $jahr->slug == $_GET['j']){
                              $issame = true;
                         }
                    }
                    if( !$issame ){ continue; }
               }  


               //----- RESULT
           
               $result[$i]['ID'] = $postID;

               $result[$i]['portrait'] = cast_array_url_base64(get_field('speaker_bild', $postID));

               if( !$langFilter ) {
                    foreach($translationsArray as $key => $langID){
                         $translate_postID = icl_object_id( $langID, 'post', false, $key );
                         $result[$i]['degree'][$key] = get_field('speaker_degree', $translate_postID);
                    }
               }else {
                    $result[$i]['degree'] = get_field('speaker_degree', $postID);
               }
               $result[$i]['prename'] = get_field('speaker_vorname', $postID);
               $result[$i]['name'] = get_field('speaker_nachname', $postID);

               
               if( !$langFilter ) {
                    foreach($translationsArray as $key => $langID){
                         $translate_postID = icl_object_id( $langID, 'post', false, $key ); 
                         $result[$i]['function'][$key] = get_field('speaker_funktion', $translate_postID);
                    }
               }else {
                    $result[$i]['function'] = get_field('speaker_funktion', $postID);
               }
               $result[$i]['company'] = get_field('speaker_firma', $postID);

               if( !$langFilter ) {
                    foreach($translationsArray as $key => $langID){
                         $translate_postID = icl_object_id( $langID, 'post', false, $key ); 
                         $result[$i]['cv'][$key] = get_field('speaker_cv', $translate_postID);
                    }
               }else {
                    $result[$i]['cv'] = get_field('speaker_cv', $postID);
               }

               //GIG
               $result[$i]['gig']['date'] = get_field('speaker_zeit', $postID)['datum'];
               $result[$i]['gig']['start'] = get_field('speaker_zeit', $postID)['start'];
               $result[$i]['gig']['ende'] = get_field('speaker_zeit', $postID)['ende'];

               //SOCIAL MEDIA
               $socialmedialinks = get_field('speaker_social_media', $postID);
               if( $socialmedialinks['social_media'] ){
                    foreach($socialmedialinks['social_media'] as $sm){
                         $result[$i]['social_media'][$sm['acf_fc_layout']] = $sm[$sm['acf_fc_layout']];
                    }
               } 
               if( !isset( $result[$i]['social_media'] ) ) {
                    $result[$i]['social_media'] = false;
               }

          }
     }
     array_values($result);
     return $result;
}



function cast_array_url_base64($path){

     $image = file_get_contents($path);
     $base64 = base64_encode($image);

     return array(
          'url' => $path,
          'base64' => $base64
     );
}


function langcode_post_id($post_id){
     global $wpdb;

     $query = $wpdb->prepare('SELECT language_code FROM ' . $wpdb->prefix . 'icl_translations WHERE element_id="%d"', $post_id);
     $query_exec = $wpdb->get_row($query);

     return $query_exec->language_code;
}

add_action('rest_api_init', function() {
     register_rest_route('se2/app', 'partner', [
          'method' => 'GET',
          'callback' => 'se2_partner_rest',
          'permission_callback' => '__return_true',
          'show_in_rest' => true
     ]);
     register_rest_route('se2/app', 'partner-kategorie', [
          'method' => 'GET',
          'callback' => 'se2_partner_categories_rest',
          'permission_callback' => '__return_true',
          'show_in_rest' => true
     ]);
     register_rest_route('se2/app', 'speaker', [
          'method' => 'GET',
          'callback' => 'se2_speakers_rest',
          'permission_callback' => '__return_true',
          'show_in_rest' => true
     ]);

});

