<?php
wp_footer(); 
$Partner = new Partner;

$footerColors = (get_option( 'se_footer_color' )) ? 
     'background-color: '.esc_attr(get_option( 'se_footer_color' )[0]).'; color: '.esc_attr(get_option( 'se_footer_color' )[1]).' !important;' : '';

?>
     </div>
        

          <footer style="<?php echo $footerColors; ?>">
               <div class="footer-contact-container">
                    <a href="<?php $url = home_url(); echo esc_url( $url ); ?>">
                         <img class="footer-logo-negativ"
                              src="<?php echo get_option( 'event_logo_neg' ); ?>" 
                              alt="SEF.Growth" 
                              title="<?php echo bloginfo('name'); ?>" />
                    </a>
                    <p><?php echo get_option( 'se_contact_address' ); ?></p>
                    
                    <p><?php echo __('Tel. ', 'SimplEvent') . get_option( 'se_contact_phone' ); ?></p>

                    <a class="secondary-txt" href="<?php echo 'mailto:' . get_option( 'se_contact_email' ); ?>"><?php echo str_replace( '@', '(at)', get_option( 'se_contact_email' )); ?></a>
                    <p class="copyright"><?php echo esc_attr( get_option( 'se_c_text' ) ); ?></p>

               </div>
               
               <div class="footer-partner-container">   
                    <?php 
                    $PartnerCategories = (get_option( 'se_footer_categories' )) ? get_option( 'se_footer_categories' ) : '';
				   
                    if( isset($PartnerCategories)){
                         if (is_array($PartnerCategories) || is_object($PartnerCategories)){
                              foreach($PartnerCategories as $PartnerCategorie){
                                   $catTitle = get_term($PartnerCategorie);    
                                   echo '<div class="footer-partner-categorie">';
                                        echo '<p class="footer-partner-categorie-title">'.$catTitle->name .'</p>';
                                        $PartnerData = $Partner->call_Partner_in_Categorie( $PartnerCategorie, false, false );
                                        echo '<div class="footer-partner-logo-container">';
                                        foreach( $PartnerData as $SinglePartner ){
                                             echo '<a href="'.$SinglePartner['link'].'" title="'.$SinglePartner['name'].' Website" target="_blank">';
                                             echo '<img src="'.$SinglePartner['logo-neg'].'" alt="'.$SinglePartner['name'].'"/>';
                                             echo '</a>';
                                        }
                                        echo '</div>';
                                   echo '</div>';
                              }
                         }
                    }
                    ?>
               </div>

               <div class="footer-menu-container">
                    <?php 
                    $socialMedias = get_option( 'social_media' );
                    $socialMediaIcons = new se2_SocialMedia(esc_attr( get_option( 'dark_mode_picker' )[0] ));
                    echo '<div id="footer_socialmedia">';
                    if(get_option( 'social_media' )){
                         foreach( $socialMedias as $key => $smIcon ){
                              echo $socialMediaIcons->cast_icon($key, $smIcon );
                         }
                    }
                    echo '</div>';
                    ?>

                    <?php
                    $array_footermenu = wp_get_nav_menu_items('Footer Menu');
                    if($array_footermenu) 
                    {
                        $cf = 1;
                        echo '<div class="footer-menu">';
                     
                        //APP
                         if( null !== get_option( 'app_promotion' ) ){
                              if( get_option( 'app_promotion' ) === 'on' && isset( get_option( 'app_promotion_display' )[1] ) ){
                                   $trenner = '  |  ';
                                   $restURL = 'https://connect.nzz.ch/wp-json/wp/v2/posts/'.esc_attr( get_option( 'app_promotion_id' ) );
                                   echo '<div class="se2-app-promo-footer app-promo-button" data-resturl="'.$restURL.'">NZZ Connect App</div>';
                              }
                         }
                              
                      
                         foreach ($array_footermenu as $footermenu) 
                         {
                              $trenner = ($cf >= count($array_footermenu)) ? '' : '  |  ';
                              echo '<a href="' . $footermenu->url . '"><p>' . $footermenu->title . '</p></a><p>' . $trenner . '</p>';
                              $cf++;
                         }

                        echo '</div>';
                    }
                    ?>
                    
               </div>

              
          </footer>
          </div>


          <?php 
          /********FOOTER SNIPPETS********/
          if( is_array(get_option('footer_snippets')) ){
               $footerSnippets = get_option('footer_snippets');
               foreach($footerSnippets as $footerSnippet){
                    if( !isset($footerSnippet['active']) ){ continue; }
                    if( $footerSnippet['active'] != 'on' ){ continue; }
                    echo $footerSnippet['snippet'];
               }
          }
          
          ?>

     </body>
</html>