<?php
/*
 *Template Name: Company Posts
 */
get_header();

$Company = new Company;

the_content();

//CATEGORIES
echo '<div class="se2-post-wall-categories container categorie-container" type="company">' . $Company->call_Companies_Categories('year') . '</div>';

echo '<div class="se2-company-wall  se2-post-wall container se-wall">' . $Company->call_Post_Wall(false, 'DSC', 'meta_value', 'Key data', 'label', true ) . '</div>'; 

echo '<div class="container" style="height:150px;"></div>';
get_footer();
?>