<?php
/*
 *Template Name: Award
 */
get_header();

wp_enqueue_script( 'JS-award', get_template_directory_uri() . '/scripts/specifics/award.js', array('jquery'), '1.0.10', true );

the_content();

$award = new Award;

echo '<div class="container se2-award-container">';

     switch (get_field('pagetype')) {
          case 'finalists':
               echo $award->cast_finalists(get_field('finalists')['jahr']);
               break;
          case 'winner':
               echo $award->cast_hall_of_fame(get_field('hall_of_fame')['jahre']);
               break;
          default:
               echo '<h4 style="text-align:center;">bitte einen Pagetype auswählen.</h4>';
               break;
     }
      
    
echo '</div>';

get_footer();
?>