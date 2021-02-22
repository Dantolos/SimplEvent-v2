<?php

add_action('init', function() {

     //******************************************************
     //---ADMIN----------------------------------------------

     $admin = get_role('administrator');
     $adminPostTypes = array(
          [ 
               'singular' => 'company', 
               'plural'   => 'companies'
          ],[ 
               'singular' => 'partner', 
               'plural'   => 'companies'
          ],[ 
               'singular' => 'person', 
               'plural'   => 'people'
          ],[ 
               'singular' => 'event', 
               'plural'   => 'events'
          ],[ 
               'singular' => 'speaker', 
               'plural'   => 'speakers'
          ],[ 
               'singular' => 'session', 
               'plural'   => 'sessions'
          ],
     );

     foreach( $adminPostTypes as $PTadmin ){
          $admin->add_cap('edit_'.$PTadmin['singular']);
          $admin->add_cap('read_'.$PTadmin['singular']);
     
          $admin->add_cap('create_'.$PTadmin['plural']);
     
          $admin->add_cap('edit_'.$PTadmin['plural']);
          $admin->add_cap('read_'.$PTadmin['plural']);
          $admin->add_cap('edit_others_'.$PTadmin['plural']);
          $admin->add_cap('publish_'.$PTadmin['plural']);
          $admin->add_cap('read_private_'.$PTadmin['plural']);
          $admin->add_cap('edit_private_'.$PTadmin['plural']);
          $admin->add_cap('edit_published_'.$PTadmin['plural']);

          $admin->add_cap('delete_others_'.$PTadmin['plural']);
          $admin->add_cap('delete_'.$PTadmin['plural']);
          $admin->add_cap('delete_private_'.$PTadmin['plural']);
          $admin->add_cap('delete_published_'.$PTadmin['plural']);
          $admin->add_cap('delete_private_'.$PTadmin['plural']);
     }

     
     //---ADMIN-END------------------------------------------
     //******************************************************

     //******************************************************
     //---GRAFIK---------------------------------------------

     
     //---GRAFIK-END-----------------------------------------
     //******************************************************

     //******************************************************
     //---KOMM-----------------------------------------------

     add_role( 'kommunikation', 'Kommunikation', );

     $komm = get_role('kommunikation');
     $komm->add_cap('read');
     $komm->add_cap('upload_files');

     $komm->add_cap('manage_categories' );
     $komm->add_cap('manage_links' );
     $komm->add_cap('unfiltered_html');
     $komm->add_cap('assign_terms');

     $komm->add_cap('hide_post_section'); 
     $komm->add_cap('hide_default_terms'); 

     //PAGE CAPABILITIES
     $komm->add_cap('edit_others_pages' );
     $komm->add_cap('edit_pages' );
     $komm->add_cap('edit_page' );
     $komm->add_cap('edit_private_pages' );
     $komm->add_cap('edit_published_pages' );
     $komm->add_cap('publish_pages' );
     $komm->add_cap('read_private_pages' );

     $komm->add_cap('create Reusable Blocks' );
     $komm->add_cap('edit Reusable Blocks' );
     $komm->add_cap('read Reusable Blocks' );
     $komm->add_cap('delete Reusable Blocks' );

     //POST TYPE CAPABILITIES
     $kommPostTypes = array(
          [ 
               'singular' => 'company', 
               'plural'   => 'companies'
          ],[ 
               'singular' => 'partner', 
               'plural'   => 'companies'
          ],[ 
               'singular' => 'person', 
               'plural'   => 'people'
          ],[ 
               'singular' => 'event', 
               'plural'   => 'events'
          ],[ 
               'singular' => 'speaker', 
               'plural'   => 'speakers'
          ],[ 
               'singular' => 'session', 
               'plural'   => 'sessions'
          ],
     );

     foreach( $kommPostTypes as $PTkomm ){
          $komm->add_cap('edit_'.$PTkomm['singular']);
          $komm->add_cap('read_'.$PTkomm['singular']);
     
          $komm->add_cap('create_'.$PTkomm['plural']);
     
          $komm->add_cap('edit_'.$PTkomm['plural']);
          $komm->add_cap('read_'.$PTkomm['plural']);
          $komm->add_cap('edit_others_'.$PTkomm['plural']);
          $komm->add_cap('publish_'.$PTkomm['plural']);
          $komm->add_cap('read_private_'.$PTkomm['plural']);
          $komm->add_cap('edit_private_'.$PTkomm['plural']);
          $komm->add_cap('edit_published_'.$PTkomm['plural']);
     }
     

     
     
     //---KOMM-END-------------------------------------------
     //******************************************************

     //******************************************************
     //---PL-------------------------------------------------
     add_role( 'projektleiter', 'Projektleiter', );

     $pl = get_role('projektleiter');
     $pl->add_cap('read');

     $pl->add_cap('manage_links' );
     $pl->add_cap('unfiltered_html');
     $pl->add_cap('assign_terms');

     $pl->add_cap('hide_post_section'); 
     $pl->add_cap('hide_default_terms'); 

     //POST TYPE CAPABILITIES
     $plPostTypes = array(
          [ 
               'singular' => 'company', 
               'plural'   => 'companies'
          ],[ 
               'singular' => 'partner', 
               'plural'   => 'companies'
          ],[ 
               'singular' => 'person', 
               'plural'   => 'people'
          ],[ 
               'singular' => 'event', 
               'plural'   => 'events'
          ],[ 
               'singular' => 'speaker', 
               'plural'   => 'speakers'
          ],[ 
               'singular' => 'session', 
               'plural'   => 'sessions'
          ],
     );

     foreach( $plPostTypes as $PTpl ){
          $pl->add_cap('edit_'.$PTpl['singular']);
          $pl->add_cap('read_'.$PTpl['singular']);
     
          $pl->add_cap('create_'.$PTpl['plural']);
     
          $pl->add_cap('edit_'.$PTpl['plural']);
          $pl->add_cap('read_'.$PTpl['plural']);
          $pl->add_cap('edit_others_'.$PTpl['plural']);
          $pl->add_cap('publish_'.$PTpl['plural']);
          $pl->add_cap('read_private_'.$PTpl['plural']);
          $pl->add_cap('edit_private_'.$PTpl['plural']);
          $pl->add_cap('edit_published_'.$PTpl['plural']);
     }
     
     //---PL-END---------------------------------------------
     //******************************************************

});


