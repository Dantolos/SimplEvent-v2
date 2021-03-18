<?php



add_action('init', 'se3_custom_user_role_capabilities' );


function se3_custom_user_role_capabilities() {

     $PostTypesSettings = get_option( 'post_visibility' );

     $allPostTypes = array(
          [ 
               'singular' => 'company', 
               'plural'   => 'companies',
               'terms'    => array( 'branche', 'tags', 'topics', 'group' )
          ],[ 
               'singular' => 'partner', 
               'plural'   => 'partners',
               'terms'    => array( 'partner_categories' )
          ],[ 
               'singular' => 'person', 
               'plural'   => 'people',
               'terms'    => array( 'branche', 'group' )
          ],[ 
               'singular' => 'event', 
               'plural'   => 'events',
               'terms'    => array( 'branche', 'tags', 'topics' )
          ],[ 
               'singular' => 'speaker', 
               'plural'   => 'speakers',
               'terms'    => array( 'jahr' )
          ],[ 
               'singular' => 'session', 
               'plural'   => 'sessions',
               'terms'    => array( 'jahr' )
          ],
     );
     
     $allTaxonomies = array(
          'branche',
          'tags',
          'topics',
          'partner_categories',
          'group',
          'jahr',
     );

     //******************************************************
     //---ADMIN----------------------------------------------

     $admin = get_role('administrator');
     $adminPostTypes = $allPostTypes;

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

     foreach($allTaxonomies as $tax){
          $admin->add_cap('manage_'.$tax);
          $admin->add_cap('edit_'.$tax);
          $admin->add_cap('delete_'.$tax);
          $admin->add_cap('assign_'.$tax);
     }

     $admin->add_cap('se2_options');
     $admin->add_cap('se2_options_header');
     $admin->add_cap('se2_options_footer');
     $admin->add_cap('se2_options_live');
     $admin->add_cap('se2_options_settings');
    
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
     
     filter_visible_posttypes( $komm, $allPostTypes, $PostTypesSettings['kommunikation']);
     
   
   
     //SE2
     $komm->add_cap('manage_options');
     $komm->add_cap('se2_options');
     $komm->add_cap('se2_options_header');
     $komm->add_cap('se2_options_footer');
     $komm->add_cap('se2_options_settings');
     
     
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

     //******************************************************
     //---HOTI---------------------------------------------

     
     //---HOTI-END-----------------------------------------
     //******************************************************


  
}

   //filter post type visibility (from se2->settings->capabilities)
   function filter_visible_posttypes( $role, $wholeCollection, $filter ){
     reset_post_permissions( $role, $wholeCollection );
     if( isset( $filter ) ){
          foreach( $wholeCollection as $posttype ){
               if( isset( $filter[$posttype['plural']] ) ){
                    $role->add_cap('edit_'.$posttype['singular']);
                    $role->add_cap('read_'.$posttype['singular']);
               
                    $role->add_cap('create_'.$posttype['plural']);
               
                    $role->add_cap('edit_'.$posttype['plural']);
                    $role->add_cap('read_'.$posttype['plural']);
                    $role->add_cap('edit_others_'.$posttype['plural']);
                    $role->add_cap('publish_'.$posttype['plural']);
                    $role->add_cap('read_private_'.$posttype['plural']);
                    $role->add_cap('edit_private_'.$posttype['plural']);
                    $role->add_cap('edit_published_'.$posttype['plural']);

                    // exclude roles from delete capability
                    if(  current_user_can('kommunikation') 
                         || current_user_can('projektleiter') 
                         ){ 
                              continue;
                         }

                         $role->add_cap('delete_others_'.$posttype['plural']);
                         $role->add_cap('delete_'.$posttype['plural']);
                         $role->add_cap('delete_private_'.$posttype['plural']);
                         $role->add_cap('delete_published_'.$posttype['plural']);
                         $role->add_cap('delete_private_'.$posttype['plural']);
               }
          }
     }
}


//reset post typer
function reset_post_permissions( $toResetRole, $wholeCollection ){
     if( isset( $toResetRole ) ){
          foreach( $wholeCollection as $allPT ){
               $toResetRole->remove_cap('edit_'.$allPT['singular']);
               $toResetRole->remove_cap('read_'.$allPT['singular']);
          
               $toResetRole->remove_cap('create_'.$allPT['plural']);
          
               $toResetRole->remove_cap('edit_'.$allPT['plural']);
               $toResetRole->remove_cap('read_'.$allPT['plural']);
               $toResetRole->remove_cap('edit_others_'.$allPT['plural']);
               $toResetRole->remove_cap('publish_'.$allPT['plural']);
               $toResetRole->remove_cap('read_private_'.$allPT['plural']);
               $toResetRole->remove_cap('edit_private_'.$allPT['plural']);
               $toResetRole->remove_cap('edit_published_'.$allPT['plural']);

               //if( current_user_can('kommunikation') ){ }
               $toResetRole->remove_cap('delete_others_'.$allPT['plural']);
               $toResetRole->remove_cap('delete_'.$allPT['plural']);
               $toResetRole->remove_cap('delete_private_'.$allPT['plural']);
               $toResetRole->remove_cap('delete_published_'.$allPT['plural']);
               $toResetRole->remove_cap('delete_private_'.$allPT['plural']);
          }
     }
}