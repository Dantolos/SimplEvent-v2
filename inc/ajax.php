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
require_once('classes/lineup.class.php');
require_once('classes/sessions.class.php');
require_once('classes/mediacorner.class.php');
require_once('classes/award.class.php');

require_once('classes/features/features-cta.class.php');

//including supports
require_once('supports/date.php');
require_once('supports/forms.php');
require_once('supports/files.php');
require_once('supports/social-media.php');

require_once('assets/tags.php');
require_once('assets/app-promotion.php');

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

/*-------------Companies---------------*/
add_action('wp_ajax_nopriv_company_lightbox', 'company_lightbox');
add_action('wp_ajax_company_lightbox', 'company_lightbox'); //nur für angemeldete (admins)

function company_lightbox() 
{
     $Company = new Company;
    $postID = $_POST['lbid'];
    
    wp_send_json( $Company->call_Company_Lightbox( $postID ) ); 
    die();
}

/*-------------LINE UP---------------*/
add_action('wp_ajax_nopriv_lineup', 'lineup');
add_action('wp_ajax_lineup', 'lineup'); //nur für angemeldete (admins)

function lineup() 
{
     $ARGS = json_decode(json_encode($_POST['details']));
   
     $arguments = array( 
          'view' => $ARGS->view,
          'cat' => $ARGS->cat,
          'sort' => $ARGS->sort,
          'year' => $ARGS->year,
          'event' => $ARGS->event,
     );
     
    $LineUp = new LineUp;
    //$postID = $_POST['pid'];
    wp_send_json( $LineUp->cast_line_up_overview( $arguments ) ); 
   
    die();
}

/*-------------SPEAKER LIGHTBOX---------------*/
//speaker-lightbox
add_action('wp_ajax_nopriv_speaker_lightbox', 'speaker_lightbox');
add_action('wp_ajax_speaker_lightbox', 'speaker_lightbox'); //nur für angemeldete (admins)

function speaker_lightbox() 
{ 
     $speakerID = $_POST['speakerid'];
     $LineUp = new LineUp;
     
     wp_send_json( $LineUp->cast_speaker_lightbox( $speakerID ) ); 
     
     die();
}


/*-------------SESSION LIGHTBOX---------------*/
//session-lightbox
add_action('wp_ajax_nopriv_session_lightbox', 'session_lightbox');
add_action('wp_ajax_session_lightbox', 'session_lightbox'); //nur für angemeldete (admins)

function session_lightbox() 
{
     $sessionID = $_POST['sessionid'];
     $Sessions = new Sessions;
     
     wp_send_json( $Sessions->cast_session_lightbox( $sessionID ) ); 
     
     die();
}




/*-------------AWARD---------------*/
//candidate-lightbox
add_action('wp_ajax_nopriv_candidate_lightbox', 'candidate_lightbox');
add_action('wp_ajax_candidate_lightbox', 'candidate_lightbox'); //nur für angemeldete (admins)

function candidate_lightbox() 
{
     $candidateID = $_POST['candidate'];
     $Award = new Award;
     
     wp_send_json( $Award->cast_candidate_lightbox( $candidateID ) ); 
     
     die();
}


/*-------------MEDIACORNER---------------*/

add_action('wp_ajax_nopriv_mediacorner', 'mediacorner');
add_action('wp_ajax_mediacorner', 'mediacorner'); //nur für angemeldete (admins)

function mediacorner()  
{
     $mediacornerID = $_POST['id'];
     $mediacornerType = $_POST['type'];
     $mediaCorner = new Mediacorner;
     switch ($mediacornerType) {
          case 'info':
               wp_send_json( $mediaCorner->cast_media_info( $mediacornerID ) ); 
               break;
          case 'mm':
               wp_send_json( $mediaCorner->cast_press_realese( $mediacornerID ) ); 
               break;
          case 'logo':
               wp_send_json( $mediaCorner->cast_logo_downlaods( $mediacornerID ) ); 
               break;
          case 'fotos':
               wp_send_json( $mediaCorner->cast_photo_archive( $mediacornerID ) ); 
               break;
          case 'audio':
               wp_send_json( $mediaCorner->cast_audio_archive( $mediacornerID ) ); 
               break;
          case 'video':
               wp_send_json( $mediaCorner->cast_video_archive( $mediacornerID ) ); 
               break;    
          default:
               wp_send_json( $mediaCorner->cast_media_info( $mediacornerID ) );
               break;
     }
     
    
     
     die();
}

/*-------------PHOTO GALLERY FOLDER---------------*/
//photo-gallerie
add_action('wp_ajax_nopriv_photo_folder', 'photo_folder');
add_action('wp_ajax_photo_folder', 'photo_folder'); //nur für angemeldete (admins)

function photo_folder() 
{
     $pageID = $_POST['pageid'];
     $folder = $_POST['folder'];
     $MediaCorner = new Mediacorner;
     
     wp_send_json( $MediaCorner->cast_folder_content( $pageID, $folder ) ); 
     
     die();
}

/*------------- VIDEOS ---------------*/
//photo-gallerie
add_action('wp_ajax_nopriv_videos', 'videos');
add_action('wp_ajax_videos', 'videos'); //nur für angemeldete (admins)

function videos() 
{
     $pageID = $_POST['pageid'];
     if(isset($_POST['filter'])){
          $filter = ['tags' => $_POST['filter']];
     } else {
          $filter = ['tags' => []];
     }
     $MediaCorner = new Mediacorner;
     
     wp_send_json( $MediaCorner->se2_cast_video_matrix( $pageID, $filter ) ); 
     
     die();
}

/*------------- CTA ---------------*/
add_action('wp_ajax_nopriv_cta', 'cta');
add_action('wp_ajax_cta', 'cta'); //nur für angemeldete (admins)

function cta() 
{
     $postID = $_POST['postid'];
     $CTA = new se2_CTA;
     
     wp_send_json( $CTA->cast_cta_lightbox( $postID ) ); 
     
     die();
 
}

/*------------- APP Promotion ---------------*/
add_action('wp_ajax_nopriv_app_promotion', 'app_promotion');
add_action('wp_ajax_app_promotion', 'app_promotion'); //nur für angemeldete (admins)

function app_promotion() 
{
     $restdata = $_POST['restdata'];
     $APP_LIGHTBOX = new se2_APP_PROMOTION;
     
     wp_send_json( $APP_LIGHTBOX->cast_app_lightbox( $restdata ) ); 
     
     die();
 
}