<?php
/*
 *Template Name: Events
 */
get_header();
$Events = new Events;

//CONTENT OUTPUT
the_content();

//CATEGORIES
echo '<div class="se2-post-wall-categories container categorie-container" type="event">' . $Events->call_Events_Categories('year') . '</div>';
 
//EVENT OUTPUT
echo '<div class="se2-post-wall se2-events-wall container se-wall">' . $Events->call_Events_Wall( false, 'ASC','meta_value', 'date' ) . '</div>';

get_footer(); 
?>