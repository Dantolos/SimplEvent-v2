
<?php

class se2_SocialMedia {
     public $icons;

     function __construct( $color = '#000000' ) {
          $iconStyle = '.st0{fill:none;stroke:'. $color .';stroke-width:0;stroke-miterlimit:10;}.st1{fill:'. $color .';}';
          $this->icons = [
               'youtube' => '<svg version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
                              <style type="text/css">' . $iconStyle . '</style>
                              <g>
                                   <g>
                                        <path id="XMLID_6_" class="st0" d="M25,49L25,49C11.7,49,1,38.3,1,25l0,0C1,11.7,11.7,1,25,1l0,0c13.3,0,24,10.7,24,24l0,0 C49,38.3,38.3,49,25,49z"/>
                                   </g>
                                   <path class="st1" d="M37.8,18.6c-0.3-1.2-1.2-2.1-2.4-2.4C33.3,15.6,25,15.6,25,15.6s-8.3,0-10.4,0.6c-1.1,0.3-2,1.2-2.4,2.4
                                        c-0.6,2.1-0.6,6.4-0.6,6.4s0,4.4,0.6,6.4c0.3,1.2,1.2,2.1,2.4,2.4c2.1,0.6,10.4,0.6,10.4,0.6s8.3,0,10.4-0.6c1.1-0.3,2-1.2,2.4-2.4
                                        c0.6-2.1,0.6-6.4,0.6-6.4S38.3,20.6,37.8,18.6z M22.3,29V21l7,4L22.3,29z"/>
                              </g>
                              </svg>',
               'twitter' => '<svg version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                              viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
                                   <style type="text/css">
                                   .st0{fill:none;stroke:'. $color .';stroke-width:0.4321;stroke-miterlimit:10;}
                                   .st1{fill:'. $color .';}
                                   </style>
                                   <g>
                                        <g>
                                             <path id="XMLID_8_" class="st0" d="M25,49L25,49C11.7,49,1,38.3,1,25l0,0C1,11.7,11.7,1,25,1l0,0c13.3,0,24,10.7,24,24l0,0
                                                  C49,38.3,38.3,49,25,49z"/>
                                        </g>
                                        <path id="XMLID_7_" class="st1" d="M13.7,33.1c2.1,1.3,4.5,2.1,7.1,2.1c8.6,0,13.5-7.3,13.2-13.8c0.9-0.7,1.7-1.5,2.3-2.4
                                             c-0.8,0.4-1.7,0.6-2.7,0.7c1-0.6,1.7-1.5,2-2.6c-0.9,0.5-1.9,0.9-3,1.1c-0.8-0.9-2.1-1.5-3.4-1.5c-3,0-5.2,2.8-4.5,5.7
                                             c-3.9-0.2-7.3-2-9.6-4.9c-1.2,2.1-0.6,4.8,1.4,6.2c-0.8,0-1.5-0.2-2.1-0.6c-0.1,2.2,1.5,4.2,3.7,4.6c-0.7,0.2-1.4,0.2-2.1,0.1
                                             c0.6,1.8,2.3,3.2,4.3,3.2C18.6,32.7,16.1,33.4,13.7,33.1z"/>
                                   </g>
                              </svg>',
               'insta' => '<svg version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
                              <style type="text/css">' . $iconStyle . '</style>
                              <g>
                                   <g>
                                        <path id="XMLID_17_" class="st0" d="M25,49L25,49C11.7,49,1,38.3,1,25l0,0C1,11.7,11.7,1,25,1l0,0c13.3,0,24,10.7,24,24l0,0
                                             C49,38.3,38.3,49,25,49z"/>
                                   </g>
                                   <g id="XMLID_9_">
                                        <path id="XMLID_14_" class="st1" d="M25,15.4c3.1,0,3.5,0,4.7,0.1c1.1,0.1,1.8,0.2,2.2,0.4c0.5,0.2,0.9,0.5,1.3,0.9
                                             c0.4,0.4,0.7,0.8,0.9,1.3c0.2,0.4,0.3,1,0.4,2.2c0.1,1.2,0.1,1.6,0.1,4.7c0,3.1,0,3.5-0.1,4.7c-0.1,1.1-0.2,1.8-0.4,2.2
                                             c-0.2,0.5-0.5,0.9-0.9,1.3c-0.4,0.4-0.8,0.7-1.3,0.9c-0.4,0.2-1,0.4-2.2,0.4c-1.2,0.1-1.6,0.1-4.7,0.1c-3.1,0-3.5,0-4.7-0.1
                                             c-1.1-0.1-1.8-0.2-2.2-0.4c-0.5-0.2-0.9-0.5-1.3-0.9c-0.4-0.4-0.7-0.8-0.9-1.3c-0.2-0.4-0.3-1-0.4-2.2c-0.1-1.2-0.1-1.6-0.1-4.7
                                             c0-3.1,0-3.5,0.1-4.7c0.1-1.1,0.2-1.8,0.4-2.2c0.2-0.5,0.5-0.9,0.9-1.3c0.4-0.4,0.8-0.7,1.3-0.9c0.4-0.2,1-0.4,2.2-0.4
                                             C21.5,15.4,21.9,15.4,25,15.4 M25,13.3c-3.2,0-3.6,0-4.8,0.1c-1.2,0.1-2.1,0.3-2.8,0.5c-0.8,0.3-1.4,0.7-2.1,1.3
                                             c-0.6,0.6-1,1.3-1.3,2.1c-0.3,0.7-0.5,1.6-0.5,2.8c-0.1,1.2-0.1,1.6-0.1,4.8s0,3.6,0.1,4.8c0.1,1.2,0.3,2.1,0.5,2.8
                                             c0.3,0.8,0.7,1.4,1.3,2.1c0.6,0.6,1.3,1,2.1,1.3c0.7,0.3,1.6,0.5,2.8,0.5c1.2,0.1,1.6,0.1,4.8,0.1c3.2,0,3.6,0,4.8-0.1
                                             c1.2-0.1,2.1-0.3,2.8-0.5c0.8-0.3,1.4-0.7,2.1-1.3c0.6-0.6,1-1.3,1.3-2.1c0.3-0.7,0.5-1.6,0.5-2.8c0.1-1.2,0.1-1.6,0.1-4.8
                                             s0-3.6-0.1-4.8c-0.1-1.2-0.3-2.1-0.5-2.8c-0.3-0.8-0.7-1.4-1.3-2.1c-0.6-0.6-1.3-1-2.1-1.3c-0.7-0.3-1.6-0.5-2.8-0.5
                                             C28.6,13.3,28.2,13.3,25,13.3"/>
                                        <path id="XMLID_11_" class="st1" d="M25,19c-3.3,0-6,2.7-6,6s2.7,6,6,6c3.3,0,6-2.7,6-6S28.3,19,25,19 M25,28.9
                                             c-2.1,0-3.9-1.7-3.9-3.9c0-2.1,1.7-3.9,3.9-3.9c2.1,0,3.9,1.7,3.9,3.9C28.9,27.1,27.1,28.9,25,28.9"/>
                                        <path id="XMLID_10_" class="st1" d="M32.6,18.8c0,0.8-0.6,1.4-1.4,1.4c-0.8,0-1.4-0.6-1.4-1.4c0-0.8,0.6-1.4,1.4-1.4
                                             C32,17.4,32.6,18,32.6,18.8"/>
                                   </g>
                              </g>
                         </svg>',
               'facebook' => '<svg version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
                                   <style type="text/css">' . $iconStyle . '</style>
                              <g>
                                   <path id="XMLID_25_" class="st0" d="M25,49L25,49C11.7,49,1,38.3,1,25l0,0C1,11.7,11.7,1,25,1l0,0c13.3,0,24,10.7,24,24l0,0
                                        C49,38.3,38.3,49,25,49z"/>
                                   <path id="XMLID_24_" class="st1" d="M21.8,37.9h5.2v-13h3.6l0.4-4.3h-4c0,0,0-1.6,0-2.5c0-1,0.2-1.4,1.2-1.4c0.8,0,2.8,0,2.8,0
                                        v-4.5c0,0-3,0-3.6,0c-3.9,0-5.6,1.7-5.6,4.9c0,2.8,0,3.5,0,3.5h-2.7v4.4h2.7V37.9z"/>
                              </g>
                         </svg>',
               'linkedin' => '<svg version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
                              <style type="text/css">' . $iconStyle . '</style>
                                   <g>
                                        <g>
                                             <path id="XMLID_23_" class="st0" d="M25,49L25,49C11.7,49,1,38.3,1,25l0,0C1,11.7,11.7,1,25,1l0,0c13.3,0,24,10.7,24,24l0,0
                                                  C49,38.3,38.3,49,25,49z"/>
                                        </g>
                                        <g id="XMLID_18_">
                                             <g id="XMLID_20_">
                                                  <rect id="XMLID_22_" x="14.8" y="20.2" class="st1" width="4.4" height="14.2"/>
                                                  <path id="XMLID_21_" class="st1" d="M16.9,18.4c1.4,0,2.6-1.2,2.6-2.6s-1.2-2.6-2.6-2.6c-1.4,0-2.6,1.2-2.6,2.6
                                                       S15.5,18.4,16.9,18.4z"/>
                                             </g>
                                             <path id="XMLID_19_" class="st1" d="M26.2,27c0-2,0.9-3.2,2.7-3.2c1.6,0,2.4,1.1,2.4,3.2c0,2,0,7.5,0,7.5h4.4c0,0,0-5.2,0-9
                                                  c0-3.8-2.2-5.7-5.2-5.7c-3,0-4.3,2.4-4.3,2.4v-1.9H22v14.2h4.2C26.2,34.5,26.2,29.2,26.2,27z"/>
                                        </g>
                                   </g>
                              </svg>',
               'whatsapp' =>  '<svg version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                   viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve">
                                   <style type="text/css">' . $iconStyle . '</style>
                                   <path d="M20.4,3.5C18.2,1.2,15.2,0,12,0C5.4,0,0.1,5.3,0.1,11.9c0,2.1,0.5,4.1,1.6,5.9L0,24l6.3-1.7C8,23.3,10,23.8,12,23.8h0
                                        c6.6,0,12-5.3,12-11.9C24,8.7,22.6,5.7,20.4,3.5z M12,21.8c-1.8,0-3.5-0.5-5-1.4l-0.4-0.2l-3.7,1l1-3.6l-0.2-0.4
                                        c-1-1.6-1.5-3.4-1.5-5.3C2.1,6.4,6.5,2,12,2c2.6,0,5.1,1,7,2.9s3,4.4,3,7C22,17.4,17.4,21.8,12,21.8z M17.4,14.4
                                        c-0.3-0.1-1.8-0.9-2-1c-0.3-0.1-0.5-0.1-0.7,0.1c-0.2,0.3-0.8,1-0.9,1.2c-0.2,0.2-0.3,0.2-0.6,0.1c-1.7-0.9-2.9-1.6-4-3.5
                                        c-0.3-0.5,0.3-0.5,0.9-1.6c0.1-0.2,0-0.4,0-0.5C9.9,9,9.3,7.5,9,6.9C8.8,6.3,8.5,6.4,8.3,6.4c-0.2,0-0.4,0-0.6,0
                                        C7.6,6.4,7.3,6.5,7,6.8c-0.3,0.3-1,1-1,2.5s1.1,2.9,1.2,3.1c0.2,0.2,2.1,3.2,5.1,4.5c1.9,0.8,2.6,0.9,3.6,0.7c0.6-0.1,1.8-0.7,2-1.4
                                        c0.2-0.7,0.2-1.3,0.2-1.4C17.9,14.6,17.7,14.5,17.4,14.4z"/>
                              </svg>',
               'share' =>     '<svg version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                              viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve">
                                   <style type="text/css">' . $iconStyle . '</style>     
                                   <path d="M18.9,13.7c-1.6,0-3,0.7-3.9,1.8l-4.9-2.5c0.1-0.3,0.1-0.7,0.1-1.1c0-0.4-0.1-0.8-0.1-1.2l4.8-2.5c0.9,1.2,2.4,1.9,4,1.9
                                        c2.8,0,5.1-2.3,5.1-5.1S21.7,0,18.9,0s-5.1,2.3-5.1,5.1c0,0.3,0,0.6,0.1,0.9L8.9,8.6C8,7.5,6.6,6.9,5.1,6.9C2.3,6.9,0,9.2,0,12
                                        s2.3,5.1,5.1,5.1c1.6,0,2.9-0.7,3.9-1.8l4.9,2.5c-0.1,0.3-0.1,0.7-0.1,1c0,2.8,2.3,5.1,5.1,5.1s5.1-2.3,5.1-5.1S21.7,13.7,18.9,13.7
                                        z M18.9,2.5c1.4,0,2.6,1.2,2.6,2.6s-1.2,2.6-2.6,2.6c-1.4,0-2.6-1.2-2.6-2.6S17.4,2.5,18.9,2.5z M5.1,14.6c-1.4,0-2.6-1.2-2.6-2.6
                                        c0-1.4,1.2-2.6,2.6-2.6c1.4,0,2.6,1.2,2.6,2.6C7.7,13.4,6.5,14.6,5.1,14.6z M18.9,21.5c-1.4,0-2.6-1.2-2.6-2.6s1.2-2.6,2.6-2.6
                                        c1.4,0,2.6,1.2,2.6,2.6S20.3,21.5,18.9,21.5z"/>
                              </svg>',
          ];
     }

     public function cast_icon_row( $iconArray ){
          $iconRow = '<div>';
          foreach( $iconArray as $channel ){
               $iconRow .= $this->cast_icon($channel['link'], $channel['type']);
          }
          $iconRow .= '</div>';
     }

     public function cast_icon( $type, $link ){
          $icon = '';
                    
          if(strlen($link) > 2){         
               $icon .= '<a href="'.$link.'" title="'.$type.'" target="_blank">';
               $icon .= $this->icons[$type];
               $icon .= '</a>';
          }
          return $icon;
     }

     public function shareButton( $sharecontent ){
          $shareButton = '';
          $shareButton .= '<div class="share-button">';
          $shareButton .= $this->icons['share'];
          $shareButton .= '</div>';

          $shareButton .= '<div class="share-fallback" style="display:none;">';
               $shareButton .= '<a href="https://www.facebook.com/sharer.php?u='.$sharecontent['url'].'">';
               $shareButton .= ' fb ';
               $shareButton .= '</a>';
               $shareButton .= '<a href="https://api.whatsapp.com/send?text='.$sharecontent['title'].' '.$sharecontent['url'].'">';
               $shareButton .= ' whatsapp ';
               $shareButton .= '</a>';
               $shareButton .= '<a href="https://twitter.com/share?url='.$sharecontent['url'].'&text='.$sharecontent['title'].'">';
               $shareButton .= ' twitter ';
               $shareButton .= '</a>';
               $shareButton .= '<a target="_blank" href="https://www.linkedin.com/sharing/share-offsite/?url='.$sharecontent['url'].'&title='.$sharecontent['title'].'&submitted-image-url='.$sharecontent['image'].'">';
               $shareButton .= ' linkedin ';
               $shareButton .= '</a>';
          $shareButton .= '</div>';

          $shareButton .= '<script type="text/JavaScript">
                              var metaInfos = '.json_encode($sharecontent).'
                              shareItem(metaInfos);
                         </script>';
          return $shareButton;

     }
}