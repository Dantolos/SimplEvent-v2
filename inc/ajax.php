<?php
/* header('Content-Type: text/js; charset=UTF-8');
error_reporting(E_ALL);
ini_set('display_errors', 0); */

/*
  ==================
  AJAX Functions
  ==================
*/
require_once('classes/post.class.php');
require_once('classes/partner.class.php');
require_once('classes/company.class.php');
require_once('classes/events.class.php');

/*-------------PARTNER---------------*/
add_action('wp_ajax_nopriv_partner_infos', 'partner_infos');
add_action('wp_ajax_partner_infos', 'partner_infos'); //nur für angemeldete (admins)

function partner_infos() 
{
    $Partner = new Partner;
    $postID = $_POST['pid'];
    
    wp_send_json( $Partner->call_Partner_Infos( $postID ) ); 
   

    die();
}

/*-------------EVENTS---------------*/
add_action('wp_ajax_nopriv_event_lightbox', 'event_lightbox');
add_action('wp_ajax_event_lightbox', 'event_lightbox'); //nur für angemeldete (admins)

function event_lightbox() 
{
    $Events = new Events;
    $postID = $_POST['lbid'];
    
    wp_send_json( $Events->call_Event_Lightbox( $postID ) ); 
   

    die();
}

add_action('wp_ajax_nopriv_categorie', 'categorie');
add_action('wp_ajax_categorie', 'categorie'); //nur für angemeldete (admins)

function categorie() 
{
     $result = '';
     $Events = new Events;
     $Company = new Company;
    $year = $_POST['year'];
    $type = $_POST['type'];

    switch ($type) {
         case 'event':    
               $result = $Events->call_Events_Wall( $year ); 
               break;
          
          case 'company':
               $result = $Company->call_Post_Wall( $year ); 
               break;
          
         default:
               
              break;
    }
    wp_send_json($result);
   

    die();
}