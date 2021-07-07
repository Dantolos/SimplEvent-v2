<?php
$current_url = home_url( add_query_arg( array(), $wp->request ) );


var_dump($current_url )

$SpslugFull = explode('/', $current_url);

die();
/* 
$SpslugFull = array_filter($SpslugFull);

$SeSlug = $SpslugFull[count($SpslugFull)]; 

if ( function_exists('icl_object_id') ) {
    $url = home_url() . '/' . ICL_LANGUAGE_CODE . '/session/?sl='. $slot .'&se=' . $SeSlug;
}else{
    $url = home_url() . '/session/?sl='. $slot .'&se=' . $SeSlug;
}

wp_redirect( $url );
*/

exit;
