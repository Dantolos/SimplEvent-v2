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



     $allItems = [];

     $allItems['posttypes'] = $allPostTypes;
     $allItems['taxonomies'] = $allTaxonomies;



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

     $admin->add_cap('upload_files');


     $admin->add_cap('se2_options');
     $admin->add_cap('se2_options_header');
     $admin->add_cap('se2_options_footer');
     $admin->add_cap('se2_options_event');
     $admin->add_cap('se2_options_live');
     $admin->add_cap('se2_options_settings');

    

     //---ADMIN-END------------------------------------------

     //******************************************************



     //******************************************************

     //---GRAFIK---------------------------------------------

     add_role( 'grafik', 'Grafik' );
     $grafik = get_role('grafik');

     $grafik->add_cap('read');
     $grafik->add_cap('upload_files');



     filter_visible_posttypes( $grafik, $allItems, $PostTypesSettings['grafik']);
   

     $grafik->add_cap('manage_links' );

     $grafik->add_cap('unfiltered_html');
     $grafik->add_cap('assign_terms');

     $grafik->add_cap('hide_post_section'); 
     $grafik->add_cap('hide_default_terms'); 



     //PAGE CAPABILITIES
     $grafik->add_cap('edit_others_pages' );
     $grafik->add_cap('edit_pages' );
     $grafik->add_cap('edit_page' );
     $grafik->add_cap('edit_private_pages' );
     $grafik->add_cap('edit_published_pages' );
     $grafik->add_cap('publish_pages' );
     $grafik->add_cap('read_private_pages' );

     $grafik->add_cap('create Reusable Blocks' );
     $grafik->add_cap('edit Reusable Blocks' );
     $grafik->add_cap('read Reusable Blocks' );
     $grafik->add_cap('delete Reusable Blocks' );



     $grafik->add_cap('se2_options');
     $grafik->add_cap('se2_options_header');
     $grafik->add_cap('se2_options_footer');
     $grafik->add_cap('se2_options_live');
     $grafik->add_cap('se2_options_settings');


     

     //---GRAFIK-END-----------------------------------------
     //******************************************************



     //******************************************************

     //---KOMM-----------------------------------------------



     add_role( 'kommunikation', 'Kommunikation' );

     $komm = get_role('kommunikation');
     $komm->add_cap('read');
     $komm->add_cap('upload_files');


     //POST TYPE CAPABILITIES
     filter_visible_posttypes( $komm, $allItems, $PostTypesSettings['kommunikation']);

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

     
     foreach($allTaxonomies as $tax){
          $admin->add_cap('manage_'.$tax);
          $admin->add_cap('edit_'.$tax);
          $admin->add_cap('delete_'.$tax);
          $admin->add_cap('assign_'.$tax);
     }
       

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

     add_role( 'projektleiter', 'Projektleiter' );


     $pl = get_role('projektleiter');
     $pl->add_cap('read');

     $pl->add_cap('manage_links' );
     $pl->add_cap('unfiltered_html');
     $pl->add_cap('assign_terms');

     $pl->add_cap('hide_post_section'); 
     $pl->add_cap('hide_default_terms'); 
 

     filter_visible_posttypes( $pl, $allItems, $PostTypesSettings['projektleiter']);


     $pl->add_cap('se2_options');
     $pl->add_cap('se2_options_header');



     //---PL-END---------------------------------------------

     //******************************************************



     //******************************************************

     //---HOTI---------------------------------------------
     add_role( 'hoti', 'HOTI' );

     $hoti = get_role('hoti');
     $hoti->add_cap('read');

     $hoti->add_cap('manage_links' );
     $hoti->add_cap('unfiltered_html');
     $hoti->add_cap('assign_terms');


     $hoti->add_cap('hide_post_section'); 
     $hoti->add_cap('hide_default_terms'); 


     filter_visible_posttypes( $hoti, $allItems, $PostTypesSettings['projektleiter']);

     $hoti->add_cap('se2_options');
     $hoti->add_cap('se2_options_header');


     //---HOTI-END-----------------------------------------

     //******************************************************





  

}



   //filter post type visibility (from se2->settings->capabilities)

   function filter_visible_posttypes( $role, $wholeCollection, $filter ){

     reset_post_permissions( $role, $wholeCollection );

     if( isset( $filter ) ){

          foreach( $wholeCollection['posttypes'] as $posttype ){

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
                         )
                         { 
                              continue;
                         }

                         $role->add_cap('delete_others_'.$posttype['plural']);
                         $role->add_cap('delete_'.$posttype['plural']);
                         $role->add_cap('delete_private_'.$posttype['plural']);
                         $role->add_cap('delete_published_'.$posttype['plural']);
                         $role->add_cap('delete_private_'.$posttype['plural']);
               }

               //add needed taxonomies

               foreach( $wholeCollection['taxonomies'] as $tax ){
                    $role->add_cap('assign_'.$tax);
                    $role->add_cap('manage_'.$tax);
                    $role->add_cap('edit_'.$tax);
                    $role->add_cap('delete_'.$tax);
                    
     
               }

               

          }

     }

}





//reset post typer

function reset_post_permissions( $toResetRole, $wholeCollection ){

     if( isset( $toResetRole ) ){

          foreach( $wholeCollection['posttypes'] as $allPT ){

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

          //reset taxonomies 

          foreach( $wholeCollection['taxonomies'] as $tax ){

               $toResetRole->remove_cap('manage_'.$tax);
               $toResetRole->remove_cap('edit_'.$tax);
               $toResetRole->remove_cap('delete_'.$tax);
               $toResetRole->remove_cap('assign_'.$tax);

          }

     }

}



//SET COOKIE
setcookie( 'capabilities' , 'set' , time() + (86400 * 30) , '/' );