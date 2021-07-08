<?php
/*-------------------------------------------------------------*/
//PARTNER
/*-------------------------------------------------------------*/

function partners_custom_columns_list( $columns ) {
    return array(
        'cb' => '<input type="checkbox" />',
        'logo' => __('Logo'),
        'title' => __('Title'),
        'categorie' => __('Kategorie')
    );
}
add_filter( 'manage_partners_posts_columns', 'partners_custom_columns_list' );


function partners_custom_column ( $column, $post_id ) {
    switch ( $column ) {
      case 'logo':
        echo '<img src="'.get_field( 'partner-logo', $post_id ).'" width="auto" height="30px"/>';
        break;
      case 'categorie':
        if(get_the_terms( $post_id, 'partner_categories' )){
            foreach(get_the_terms( $post_id, 'partner_categories' ) as $cat){
                echo '<p>'. $cat->name .'</p>';
            }
        }
        break;
    }
}
add_action ( 'manage_partners_posts_custom_column', 'partners_custom_column', 10, 2 );



/*-------------------------------------------------------------*/
//COMPANIE
/*-------------------------------------------------------------*/

function company_custom_columns_list( $columns ) {
    return array(
        'cb' => '<input type="checkbox" />',
        'title' => __('Title'),
        'logo' => __('Logo'),
        'type' => __('Type'),
    );
}
add_filter( 'manage_company_posts_columns', 'company_custom_columns_list' );


function company_custom_column ( $column, $post_id ) {
    switch ( $column ) {
      case 'logo':
        echo '<img src="'.get_field( 'media', $post_id )['logo_positiv'].'" width="auto" height="30px"/>';
        break;
      case 'type':
        if(get_field( 'award', $post_id )['award_candidate']){
             echo '<span class="dashicons dashicons-awards"></span>';
        }
        break;
    }
}
add_action ( 'manage_company_posts_custom_column', 'company_custom_column', 10, 2 );



/*-------------------------------------------------------------*/
//SPEAKER
/*-------------------------------------------------------------*/

function speakers_custom_columns_list( $columns ) {
    return array(
        'cb' => '<input type="checkbox" />',
        'foto' => __('Foto'),
        'title' => __('Title'),
        'jahr' => __('Jahr'),
    );
}
add_filter( 'manage_speakers_posts_columns', 'speakers_custom_columns_list' );


function speakers_custom_column ( $column, $post_id ) {
    switch ( $column ) {
          case 'foto':
               echo '<img src="'.get_field( 'speaker_bild', $post_id ).'" width="auto" height="70px"/>';
               break;
          case 'jahr':
               if(get_the_terms( $post_id, 'jahr' )){
                    foreach(get_the_terms( $post_id, 'jahr' ) as $cat){
                    echo '<p><b>'. $cat->name .'</b></p>';
                    }
               }
               break;
     }
}
add_action ( 'manage_speakers_posts_custom_column', 'speakers_custom_column', 10, 2 );




/*-------------------------------------------------------------*/
//SESSIONS
/*-------------------------------------------------------------*/

function sessions_custom_columns_list( $columns ) {
    return array(
        'cb' => '<input type="checkbox" />',
        'image' => __('Bild'),
        'title' => __('Title'),
        'slot' => __('Slot'),
        'jahr' => __('Jahr'),
    );
}
add_filter( 'manage_sessions_posts_columns', 'sessions_custom_columns_list' );


function sessions_custom_column ( $column, $post_id ) {
    switch ( $column ) {
        case 'image':
            echo '<img src="'.get_field( 'session_bild', $post_id ).'" width="auto" height="60px"/>';
            break;
        case 'slot':
            if(get_field( 'slot', $post_id )){
                foreach(get_field( 'slot', $post_id ) as $slot){
                    echo '<p><b>'. $slot .'</b></p>';
                }
            }
            break;
        case 'jahr':
            if(get_the_terms( $post_id, 'jahr' )){
                    foreach(get_the_terms( $post_id, 'jahr' ) as $cat){
                        echo '<p><b>'. $cat->name .'</b></p>';
                    }
            }
            break;
    }
}
add_action ( 'manage_sessions_posts_custom_column', 'sessions_custom_column', 10, 2 );


/*-------------------------------------------------------------*/
//PEOPLE
/*-------------------------------------------------------------*/

function peoples_custom_columns_list( $columns ) {
    return array(
        'cb' => '<input type="checkbox" />',
        'foto' => __('Foto'),
        'title' => __('Title'),
        'gruppe' => __('Gruppe'),
    );
}
add_filter( 'manage_peoples_posts_columns', 'peoples_custom_columns_list' );


function peoples_custom_column ( $column, $post_id ) {
    switch ( $column ) {
        case 'foto':
            echo '<img src="'.get_field( 'foto', $post_id ).'" width="auto" height="70px"/>';
            break;
        case 'gruppe':
            if(get_the_terms( $post_id, 'group' )){
                foreach(get_the_terms( $post_id, 'group' ) as $group){
                echo '<p><b>'. $group->name .'</b></p>';
                }
            }
            break;
    }
}
add_action ( 'manage_peoples_posts_custom_column', 'peoples_custom_column', 10, 2 );

