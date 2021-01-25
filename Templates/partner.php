<?php
/*
 *Template Name: Partner
 */
get_header();

the_content();

$categories = get_terms( array('taxonomy' => 'partner_categories') );

echo '<div class="container se2-partner-wall" style="margin-bottom:50px;">';

if( $categories ){
    foreach ($categories as $category) {
        $Partner = new Partner;
        echo $Partner->call_Partner_in_Categorie( $category->term_id, true );
    }
}
 
echo '</div>';

get_footer();
?>