<?php

get_header();

echo '<div class="se2-404-page">';
$url = home_url();
     echo '<div class="se2-404-logo">';
     echo '<a href="' . esc_url( $url ) . '">';
     echo '<img src="'.get_option( 'event_logo' ).'" />';
     echo '</a>';
     echo '</div>';
     

     echo '<div class="se2-404-content">';
     echo '<h2><b>Ooops...</b><br/>sorry we can\'t find that page!</h2>';
     echo '<a href="' . esc_url( $url ) . '">';
     echo '<button>Zurück zur Startseite</button>';
     echo '</a>';
     echo '</div>';

     echo '<div class="se2-404-content">';
          $socialMedias = get_option( 'social_media' );
          $socialMediaIcons = new se2_SocialMedia(esc_attr( get_option( 'dark_mode_picker' )[0] ));
          echo '<div id="footer_socialmedia">';
          if(get_option( 'social_media' )){
               foreach( $socialMedias as $key => $smIcon ){
                    echo $socialMediaIcons->cast_icon($key, $smIcon );
               }
          }
          echo '</div>';
          $array_footermenu = wp_get_nav_menu_items('Footer Menu');
          if($array_footermenu) 
          {
               $cf = 1;
               echo '<div class="se2-404-footer-menu">';
               foreach ($array_footermenu as $footermenu) 
               {
                    $trenner = ($cf >= count($array_footermenu)) ? '' : '  |  ';
                    echo '<a href="' . $footermenu->url . '"><p>' . $footermenu->title . '</p></a><p>' . $trenner . '</p>';
                    $cf++;
               }
               echo '</div>';
          }
                    
     echo '</div>';
          

     echo '<h1>404</h1>';
echo '</div>';


get_footer();