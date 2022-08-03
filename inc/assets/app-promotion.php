<?php

class se2_APP_PROMOTION {
     
     public function cast_header_promo( $restURL ){
          $headerPromo = '';
          
          $headerPromo .= '<div class="se2-app-promo-header app-promo-button" data-resturl="'.$restURL.'">';
          $headerPromo .= '<span>APP</span>';
          $headerPromo .= '</div>';
          return $headerPromo;
     }

     //LIGHTBOX
     public function cast_app_lightbox( $rawData ){
          $rawData = stripslashes($rawData);
          $data = json_decode($rawData, true);
 
          $app_lightbox = '';

          $app_lightbox .= '<div class="se2-app-lightbox-container">';
               $app_lightbox .= '<div class="se2-app-lightbox-info">';
                    $app_lightbox .= '<img src="'.$data['acf']['app_icon'].'" height="100px" width="100px" />';
                    $app_lightbox .= '<h1><b>'.$data['acf']['app_name'].'</b></h1>';
                    $app_lightbox .= '<p>'.$data['acf']['description_de'].'</p>';
                    $app_lightbox .= '<div class="se2-app-lightbox-buttons">';
                         $app_lightbox .= '<a href="'.$data['acf']['google_play'].'" target="_blank"><div class="se2-app-button android"><b>Google Play</b></div></a>';
                         $app_lightbox .= '<a href="'.$data['acf']['apple_store'].'" target="_blank"><div class="se2-app-button apple"><b>Apple Store</b></div></a>';
                    $app_lightbox .= '</div>';
               $app_lightbox .= '</div>';
               $app_lightbox .= '<div class="se2-app-lightbox-mockup">';
                    $app_lightbox .= '<img src="'.$data['acf']['mockup_de'].'" height="auto" width="auto" />';
               $app_lightbox .= '</div>';
          $app_lightbox .= '</div>'; 

          return $app_lightbox;
     }

}
