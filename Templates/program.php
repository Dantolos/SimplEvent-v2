<?php

/*

 *Template Name: Programm

 */


get_header(); 

wp_enqueue_script( 'JS-schedule', get_template_directory_uri() . '/scripts/specifics/schedule.js', array('jquery'), '1.0.04', true );


the_content();


$Schedule = new se2_Schedule(get_the_ID());
$speakerClass = new LineUp();
echo '<div class=" se2-schedule-container">';

     // MODERATION
     if( get_field('moderation', get_the_ID()) ){
          echo '<div class="schedule-hosts">';
          echo '<h5>'.__('Moderation', 'SimplEvent').'</h5>';
          foreach( get_field('moderation', get_the_ID()) as $host ){
               echo '<div class="schedule-host">';
               echo $speakerClass->cast_host( $host );
               echo '</div>';
          }
          echo '</div>';
     }

     // PROGRAMM TABELLE
     echo $Schedule->cast_Schedule();

     // PDF DOWNLOAD
     echo $Schedule->pdf_download(get_the_ID());

echo '</div>';



/* PDF GENERATE JS Version
echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
wp_enqueue_script( 'JS-pdf', get_template_directory_uri() . '/scripts/inc/pdf-generator.js', array('jquery'), '1.0.04', true );
 */
 
get_footer(); 

?>