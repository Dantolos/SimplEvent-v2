<?php
/*
 *Template Name: Award
 */
get_header();

the_content();

$award = new Award;

echo '<div class="container se2-award-container">';

     switch (get_field('pagetype')) {
          case 'finalists':
               echo $award->cast_finalists(get_field('finalists')['jahr']);
               break;
          case 'winner':
               echo $award->cast_hall_of_fame();
               break;
          default:
               echo '<h4 style="text-align:center;">bitte einen Pagetype auswählen.</h4>';
               break;
     }
     
    
echo '</div>';

get_footer();
?>