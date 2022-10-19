<?php

/*

 *Template Name: Map

 */

get_header();

wp_enqueue_script( 'JS-map', get_template_directory_uri() . '/scripts/specifics/map.js', array('jquery'), null, true );
   
$listData = [];
foreach( get_field( 'exhibitors', get_the_ID() ) as $exhibitorID ){
    $exhibitorData = [
        'id' => $exhibitorID['exhibitor'],
        'label' => $exhibitorID['label'],
        'name' => get_the_title( $exhibitorID['exhibitor'] ),
        'logo' => get_field( 'media', $exhibitorID['exhibitor'] )['logo_positiv']
    ];
    array_push( $listData, $exhibitorData );
}

wp_localize_script('JS-map', 'listData', $listData);


//CONTENT OUTPUT 
the_content();

$mapClass = new \se2\map\se2_Map(  get_the_ID() );

echo $mapClass->cast_map();

get_footer(); 

?>