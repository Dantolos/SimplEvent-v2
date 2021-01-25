<?php
/*
 *Template Name: Homepage
 */
get_header();

echo the_title();
echo '<pre style="color:green; line-height:1em;">';
var_dump(get_the_content());
echo '</pre>'; 


get_footer();
?>