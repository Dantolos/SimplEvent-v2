<?php

class Mediacorner {

     public $dateFormat;
     public $fileSize;
     public $fileDownload;
     public $folderIcon;
     public $lineup;
     public $addIcon;
     public $fullscreenIcon;

     public function __construct(){
          $this->dateFormat = new Date_Format;
          $this->fileSize = new se2_Files;
          
          $this->fileDownload = [
                                   'svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="80%" height="80%" fill="currentColor" class="bi bi-file-pdf" viewBox="0 0 16 16">
                                                  <path class="fileicon-hide" d="M2.7,3.1c1.4,0,2.2,0.9,2.2,2.4v0.3H3.5V5.4c0-0.7-0.3-0.9-0.7-0.9S2,4.7,2,5.4c0,1.9,2.9,2.3,2.9,5c0,1.5-0.7,2.4-2.2,2.4 s-2.2-0.9-2.2-2.4V9.7h1.4v0.7c0,0.7,0.3,0.9,0.8,0.9s0.8-0.2,0.8-0.9c0-1.9-2.9-2.3-2.9-5C0.5,3.9,1.3,3.1,2.7,3.1z"/>
                                                  <path class="fileicon" d="M7.9,10.8l1.1-7.6h1.3L9,12.6H6.8L5.3,3.2h1.5L7.9,10.8z"/>
                                                  <path class="fileicon-hide" d="M13.3,7.3h2.1v3c0,1.5-0.7,2.4-2.2,2.4s-2.2-0.9-2.2-2.4V5.4c0-1.5,0.7-2.4,2.2-2.4s2.2,0.9,2.2,2.4v0.9h-1.4v-1 c0-0.7-0.3-0.9-0.8-0.9c-0.5,0-0.8,0.3-0.8,0.9v5.1c0,0.7,0.3,0.9,0.8,0.9c0.5,0,0.8-0.2,0.8-0.9V8.7h-0.7V7.3z"/>
                                                  <path class="download" style="visibility: hidden;" d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zm-1 4v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V7.5a.5.5 0 0 1 1 0z"/>
                                             </svg>',
                                   'eps' => '<svg xmlns="http://www.w3.org/2000/svg" width="80%" height="80%" fill="currentColor" class="bi bi-file-pdf" viewBox="0 0 16 16">
                                                  <path class="fileicon-hide" d="M2.5,7.1h2v1.3h-2v2.7H5v1.3H1V3.2h4v1.3H2.5V7.1z"/>
                                                  <path class="fileicon" d="M10.2,5.5v1.2C10.2,8.2,9.5,9,8,9H7.3v3.5H5.9V3.2H8C9.5,3.2,10.2,4,10.2,5.5z M7.3,4.5v3.2H8c0.5,0,0.7-0.2,0.7-0.9V5.4 c0-0.7-0.3-0.9-0.7-0.9H7.3z"/>
                                                  <path class="fileicon-hide" d="M12.8,3.1c1.4,0,2.1,0.9,2.1,2.4v0.3h-1.4V5.4c0-0.7-0.3-0.9-0.7-0.9c-0.5,0-0.7,0.3-0.7,0.9c0,1.9,2.9,2.3,2.9,5 c0,1.5-0.7,2.4-2.2,2.4s-2.2-0.9-2.2-2.4V9.7H12v0.7c0,0.7,0.3,0.9,0.8,0.9s0.8-0.2,0.8-0.9c0-1.9-2.9-2.3-2.9-5 C10.7,3.9,11.4,3.1,12.8,3.1z"/>
                                                  <path class="download" style="visibility: hidden;" d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zm-1 4v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V7.5a.5.5 0 0 1 1 0z"/>
                                             </svg>',
                                   'pdf' => '<svg xmlns="http://www.w3.org/2000/svg" width="80%" height="80%" fill="currentColor" class="bi bi-file-pdf" viewBox="0 0 16 16">
                                                  <path class="fileicon-hide" d="M5.2,5.6v1.2c0,1.5-0.7,2.3-2.2,2.3H2.3v3.5H0.9V3.3H3C4.5,3.3,5.2,4.2,5.2,5.6z M2.3,4.7v3.1H3c0.5,0,0.7-0.2,0.7-0.9V5.6 c0-0.7-0.3-0.9-0.7-0.9H2.3z"/>
                                                  <path class="fileicon" d="M5.9,3.3h2.3c1.5,0,2.2,0.8,2.2,2.3v4.7c0,1.5-0.7,2.3-2.2,2.3H5.9V3.3z M7.3,4.7v6.6h0.8c0.5,0,0.7-0.2,0.7-0.9V5.6 c0-0.7-0.3-0.9-0.7-0.9H7.3z"/>
                                                  <path class="fileicon-hide" d="M12.7,7.5h1.9v1.3h-1.9v3.8h-1.5V3.3h3.9v1.3h-2.4V7.5z"/>
                                                  <path class="download" style="visibility: hidden;" d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zm-1 4v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V7.5a.5.5 0 0 1 1 0z"/>
                                             </svg>',
                                   'png' => '<svg xmlns="http://www.w3.org/2000/svg" width="80%" height="80%" fill="currentColor" class="bi bi-file-pdf" viewBox="0 0 16 16">
                                                  <path class="fileicon-hide" d="M4.9,5.6v1.2c0,1.5-0.7,2.3-2.2,2.3H2v3.5H0.5V3.3h2.2C4.2,3.3,4.9,4.2,4.9,5.6z M2,4.7v3.1h0.7c0.5,0,0.7-0.2,0.7-0.9V5.6 c0-0.7-0.3-0.9-0.7-0.9H2z"/>
                                                  <path class="fileicon" d="M6.9,5.9v6.7H5.5V3.3h1.8l1.5,5.6V3.3h1.3v9.3H8.7L6.9,5.9z"/>
                                                  <path class="fileicon-hide" d="M13.4,7.5h2v3c0,1.5-0.7,2.3-2.2,2.3s-2.2-0.9-2.2-2.3V5.6c0-1.5,0.7-2.3,2.2-2.3s2.2,0.9,2.2,2.3v0.9h-1.4v-1 c0-0.7-0.3-0.9-0.8-0.9c-0.5,0-0.8,0.3-0.8,0.9v5c0,0.7,0.3,0.9,0.8,0.9c0.5,0,0.8-0.2,0.8-0.9V8.8h-0.7V7.5z"/>
                                                  <path class="download" style="visibility: hidden;" d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zm-1 4v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V7.5a.5.5 0 0 1 1 0z"/>
                                             </svg>',
                              ];
          $this->folderIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="currentColor" class="bi bi-folder-fill" viewBox="0 0 16 16">
                                   <path d="M9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.825a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3zm-8.322.12C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139z"/>
                              </svg>';
          $this->addIcon =    '<svg version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                   viewBox="0 0 448 512" style="enable-background:new 0 0 448 512;" xml:space="preserve">
                                   <path d="M432,256c0,17.7-14.3,32-32,32H256v144c0,17.7-14.3,32-32,32s-32-14.3-32-32V288H48c-17.7,0-32-14.3-32-32s14.3-32,32-32
                                        h144V80c0-17.7,14.3-32,32-32s32,14.3,32,32v144h144C417.7,224,432,238.3,432,256z"/>
                              </svg>';
          $this->fullscreenIcon = '<svg version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                   viewBox="0 0 448 512" style="enable-background:new 0 0 448 512;" xml:space="preserve">
                                   <path d="M128,32H32C14.3,32,0,46.3,0,64v96c0,17.7,14.3,32,32,32s32-14.3,32-32V96h64c17.7,0,32-14.3,32-32S145.7,32,128,32z
                                             M416,32h-96c-17.7,0-32,14.3-32,32s14.3,32,32,32h64v64c0,17.7,14.3,32,32,32s32-14.3,32-32V64C448,46.3,433.7,32,416,32z M128,416
                                        H64v-64c0-17.7-14.3-32-32-32S0,334.3,0,352v96c0,17.7,14.3,32,32,32h96c17.7,0,32-14.3,32-32S145.7,416,128,416z M416,320
                                        c-17.7,0-32,14.3-32,32v64h-64c-17.7,0-32,14.3-32,32s14.3,32,32,32h96c17.7,0,32-14.3,32-32v-96C448,334.3,433.7,320,416,320z"/>
                              </svg>';
     }

     public function cast_mediacorner_nav( $pageID ){

          $mediacornerNav = '<div class="mediacorner-nav-mobile"><span class="dashicons dashicons-ellipsis"></span></div>';
          $mediacornerNav .= '<div class="mediacorner-nav-container" pageid="'.$pageID.'">';

          $menuItems = get_field('menu', $pageID);
          if(is_array($menuItems) ){
               foreach( $menuItems as $item ){
                    $mediacornerNav .= '<h5 class="mediacorner-nav-element" type="'.$item['value'].'">'.__($item['label'], 'SimplEvent').'</h5>';
               }
          }
          $mediacornerNav .= '</div>';
          return $mediacornerNav;
     }
     

     public function cast_media_info( $pageID ){ 
          $mediaInfo = '<div class="media-info-container">';
          $mediaInfo .= get_field('info_content', $pageID);
          //$mediaInfo .= the_content( $pageID );
          $mediaInfo .= '</div>';
          return $mediaInfo;
     }

     public function cast_press_realese( $pageID ){

          $pressRealese = '<div class="se2-press-realese">';
          $pressRealese .= '<h4>'.__('Medienmitteilungen', 'SimplEvent').'</h4>';
          $realeses = get_field('medienmitteilungen', $pageID);
          $currentYear = false;
          if( is_array($realeses) ){
               if( count($realeses) > 0 ){
                    foreach( $realeses as $realese ){
 
                         date_default_timezone_set("Europe/Zurich");
                         if( date( 'YmdHi', strtotime( str_replace( '/', '-',  $realese['public']) )) > date( 'YmdHi' ) ){
                              continue;
                         }

                         if( !$currentYear || date( 'Y', strtotime( str_replace( '/', '-',  $realese['public']) )) != $currentYear ){
                              $currentYear = date( 'Y', strtotime( str_replace( '/', '-',  $realese['public']) ));
                              $pressRealese .= '<div style="width:100%; border-bottom:1px solid black; margin-top: 30px;">' . $currentYear . '</div>';
                         }
                         $pressRealese .= '<a href="'.$realese['file'].'" target="_blank">';
                         $pressRealese .= '<div class="se2-press-realese file-container">';

                              $pressRealese .=    '<div class="se2-press-realese-icon file-icon">
                                                       <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-file-pdf" viewBox="0 0 16 16">
                                                            
                                                            <path class="fileicon-hide" d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
                                                            <path class="fileicon" d="M4.603 12.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.701 19.701 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.187-.012.395-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.065.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.716 5.716 0 0 1-.911-.95 11.642 11.642 0 0 0-1.997.406 11.311 11.311 0 0 1-1.021 1.51c-.29.35-.608.655-.926.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.27.27 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.647 12.647 0 0 1 1.01-.193 11.666 11.666 0 0 1-.51-.858 20.741 20.741 0 0 1-.5 1.05zm2.446.45c.15.162.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.881 3.881 0 0 0-.612-.053zM8.078 5.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z"/>  
                                                            <path class="download" style="visibility: hidden;" d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zm-1 4v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V7.5a.5.5 0 0 1 1 0z"/>

                                                       </svg>
                                                  </div>';
                              $pressRealese .=    '<div class="se2-press-realese-desc">
                                                       '.$realese['titel'].' <i>('.$this->fileSize->getRemoteFilesize( $realese['file'] ).')</i>
                                                  </div>';

                              $pressRealese .=    '<div class="se2-press-realese-date">'
                                                       
                                                       . $this->dateFormat->formating_Date_Language( $realese['public'], 'date' ).
                                                  '</div>';

                          

                         $pressRealese .= '</div>';
                         $pressRealese .= '</a>';
                    }
               }
          }
          $pressRealese .= '</div>';
          return $pressRealese;
     }

     public function cast_logo_downlaods( $pageID ){
          $logoDownloads = '<div class="se2-logos">';
          $logoDownloads .= '<h4 style="width:100%;">'.__('Logos', 'SimplEvent').'</h4>';

          $logos = (get_field('logos', $pageID)) ? get_field('logos', $pageID) : null;
          if( isset($logos)){
               foreach( $logos as $logo ){
                    $logo = $logo['logo'];
                    $logoDownloads .= '<div class="se2-logo">';
 
                    $logoDownloads .= '<div class="se2-logo-preview">';
                         
                         //var_dump($logo['preview']['negativ']);
                         $logoNegStyle = ($logo['preview']['negativ']) ? 'se2-logo-preview-logo-neg' : '';
                         $logoDownloads .= '<div class="se2-logo-preview-logo '.$logoNegStyle.'"><img src="'.$logo['preview']['image'].'" alt="'.$logo['preview']['titel'].'" /></div>';            
                    $logoDownloads .= '</div>';

                    $logoDownloads .= '<div class="se2-logo-download">';
                         $logoDownloads .= '<div class="se2-logo-preview-text">';
                              $logoDownloads .= '<h4><b>'.$logo['preview']['titel'].'</b></h4>';
                              $logoDownloads .= '<h6>'.$logo['preview']['description'].'</h6>';
                         $logoDownloads .= '</div>';
                              //RGB
                         if( isset( $logo['files_rgb'] ) ){
                              $logoDownloads .= '<div class="se2-logo-download-rgb">';
                                   $logoDownloads .= '<div><h6><b>Digital</b><i> (rgb)</i></h6></div>';
                              
                                   foreach($logo['files_rgb'] as $key => $fileFormat ){
                                        
                                        if( !$fileFormat ){ continue;  }
                                        $logoDownloads .= '<a href="'.$fileFormat.'" download>';
                                        $logoDownloads .= '<div class="se2-logo-download-rgb-svg se2-logo-download-button file-container">';
                                        $logoDownloads .= $this->fileDownload[$key];
                                        $logoDownloads .= '</div>';
                                        $logoDownloads .= '</a>';
                                   }
                              $logoDownloads .= '</div>';  
                         }
                         //CMYK
                         if( isset( $logo['files_cmyk'] ) ){
                              $logoDownloads .= '<div class="se2-logo-download-cmyk">';
                                   $logoDownloads .= '<div><h6><b>Print</b><i> (cmyk)</i></h6></div>';
                                   
                                   foreach($logo['files_cmyk'] as $key => $fileFormat ){
                                      
                                        if( !$fileFormat ){ continue; }
                                        $logoDownloads .= '<a href="'.$fileFormat.'" download>';
                                        $logoDownloads .= '<div class="se2-logo-download-rgb-svg se2-logo-download-button file-container">';
                                        $logoDownloads .= $this->fileDownload[$key];
                                        $logoDownloads .= '</div>';
                                        $logoDownloads .= '</a>';
                                   }
                              $logoDownloads .= '</div>';  
                         }
                       

                         
                    $logoDownloads .= '</div>';
                    $logoDownloads .= '</div>';
               }
          }
          $logoDownloads .= '</div>';
          return $logoDownloads;
     }

     public function cast_photo_archive($pageID){
          $galleries = (get_field('galleries', $pageID)) ? get_field('galleries', $pageID) : false;
          if(!$galleries){ exit(); }
          $photoArchive = '<div class="se2-galleries-matrix" pageid="'.$pageID.'">';

          
          $photoArchive .= '<div class="se2-galleries-folder-tree">';
               $folderID = 0; 
               $gallerieID = 0; 

               if(isset($galleries)){
                    foreach($galleries as $galleriefolder){
                         $aktiveFolder = ( $folderID === 0 ) ? 'aktive-folder' : '';
                         $photoArchive .= '<div class="se2-galleries-folder '.$aktiveFolder.'" folder="'.$folderID.'">';
                         $photoArchive .= '<div class="se2-galleries-folder-icon">'.$this->folderIcon.'</div>';
                         $photoArchive .= '<h6>'.$galleriefolder['titel'].'</h6>';
                         $photoArchive .= '</div>';
                         $folderID++;
                         if( isset( $galleriefolder['galleries'] ) && $galleriefolder['galleries'] ){
                              $photoArchive .= '<div class="se2-galleries-folder" folder="'.$folderID.'" style="padding-left:20px;">';
                                   $photoArchive .= '<div class="se2-galleries-folder-icon">'.$this->folderIcon.'</div>';
                                   $photoArchive .= '<h6>'.$galleriefolder['galleries'][0]['titel'].'</h6>';
                              $photoArchive .= '</div>';
                              $folderID++;
                         }
                    }
               }
          $photoArchive .= '</div>';

          $photoArchive .= '<div class="se2-galleries-files">';
               $photoArchive .= '<div class="se2-galleries-content" >';
               $photoArchive .= $this->cast_folder_content($pageID, 0);
               $photoArchive .= '</div>';  
                 
          $photoArchive .= '</div>';

          $photoArchive .= '<div class="se2-gallerie-photo-download">';
               $photoArchive .= '<div class="photo-download-notice"><span class="photo-count"></span> ' .__('selected photos to download in a ZIP-Folder.', 'SimplEvent').'</div>';
               $photoArchive .= '<button id="photo-select-download">'.__('Download Selected', 'SimplEvent').'</button>';
          $photoArchive .= '</div>';  

          $photoArchive .= '</div>';
          return $photoArchive;
     }


     public function cast_folder_content($pageID, $gallerieNR = 0){
          $folderContent = '';
          
          $galleries = [];
          $gallerieQuery = get_field( 'galleries', $pageID );
          if( is_array(get_field( 'galleries', $pageID) ) ){
               for ($i=0; $i < count( $gallerieQuery ); $i++) { 
                    array_push( $galleries, $gallerieQuery[$i] );
                    if( is_array( $gallerieQuery[$i]['galleries'] ) ){
                         for ($index=0; $index < count( $gallerieQuery[$i]['galleries'] ); $index++) { 
                              array_push( $galleries, $gallerieQuery[$i]['galleries'][$index] );
                         }
                    }
               }
          }
          //var_dump($galleries);     
          $gallerie = $galleries[$gallerieNR];
          if(count( $gallerie['photos'] ) > 0){
               foreach( $gallerie['photos'] as $photo ){
                    //$folderContent .= '<a href="'.$photo['url'].'" download>';
                    $folderContent .= '<div class="se2-galleries-photo thumb" imageurl="'.$photo['url'].'">';
                         $folderContent .= '<div class="se2-galleries-photo-thumbnail" imageurl="'.$photo['url'].'">';

                              //HOVER OPTIONS
                              $folderContent .= '<div class="se2-galleries-photo-hoveroptions">';
                                   $folderContent .= '<div class="se2-galleries-photo-fullscreen">'.$this->fullscreenIcon.'</div>';
                                   $folderContent .= '<div class="se2-galleries-photo-add photo-notadded">'.$this->addIcon.'</div>';
                              $folderContent .= '</div>';

                              $folderContent .= '<div class="dashicons dashicons-saved se2-galleries-photo-selected"></div>';

                              $folderContent .= '<img src="'.$photo['sizes']['medium'].'"/>';
                              
                         $folderContent .= '</div>';
                         $folderContent .= '<div class="se2-galleries-photo-desc" >';
                              $folderContent .= '<h6><b>'.$photo['title'].'</b></h6>';
                              $folderContent .= '<h6 class="dimensions"><i>'.$photo['width'].' x '.$photo['height'].'px</i></h6>';
                              $folderContent .= '<h6>'.$this->fileSize->getRemoteFilesize( $photo['url'] ).'</h6>';
                         $folderContent .= '</div>';
                    $folderContent .= '</div>';
                    //$folderContent .= '</a>';
               }
          } else {
               $folderContent = '<div style="text-align:center;color:rgba(0,0,0,.4);display:flex;justify-content:center;align-items:center;"><h4>'.__( 'In diesem Ordner konnten noch keine Fotos gefunden werden.', 'SimplEvent' ).'</h4></div>'; 
          }
          return $folderContent;
     }

     public function cast_audio_archive($pageID){
          $audioCondent = '';

          $audioCondent .= '<div class="audio-content-container">';
          $audioCondent .= '<h4 style="width:100%;">AUDIO</h4>';
          $audiosFiles = get_field('audio_files', $pageID);
         
               if(count( $audiosFiles ) > 0){
                    foreach( $audiosFiles as $audioFile ){
                         
                         $audioCondent .= '<div class="audio-content-file">';

                         $audioCondent .= '<h5>'.$audioFile['titel'].'</h5>';
                         $audioCondent .= '<p>'.$audioFile['desc'].'</p>';
                         $audioCondent .= '<audio controls style="width:100%;">';
                         $audioCondent .= '<source src="'.$audioFile['files']['url'].'" type="audio/ogg">';
                         $audioCondent .= '</audio>';
                         $audioCondent .= '<a href="'.$audioFile['files']['url'].' " download><div class="audio-download">Download</div></a>';
                         $audioCondent .= '</div>';
                    }
               }
          
          $audioCondent .= '</div>';

          return $audioCondent;
     }

     public function cast_video_archive( $pageID, $filter = false ){

          $videoContent = '';

           

          
          $videoContent .= '<div class="video-content-container">';
          $videoContent .= '<h2>VIDEOS</h2>';

          // TAG-CLOUD
          $videoContent .= '<div class="video-tag-cloud">';
          $tags = get_terms( ['taxonomy' => 'tags', 'hide_empty' => false] );
          if( count($tags) > 0 ){
               foreach( $tags as $key => $tag ){
                    $videoContent .= '<div class="video-tag-label" tagid="' . $tag->term_id . '" listener="false">';
                    $videoContent .= '<span>' . $tag->name . '</span><div class="video-tag-label-count">0</div>';
                    $videoContent .= '</div>';
               }
          }
          $videoContent .= '</div>'; 

          //VIDEOS
          $videoContent .= $this->se2_cast_video_matrix( $pageID, $filter );

          $videoContent .= '</div>';

          return $videoContent;
     }


     public function se2_cast_video_matrix( $pageID, $filter = false ){
          $videoMatrix = '';
          $video_args = array(
               'numberposts'	=> -1,
               'post_status' => array( 'publish' ),
               'post_type'   => 'video', 
          );

          //FILTERS
          if($filter ){
               $filterArgs = [];
               

               if( isset($filter['jahr']) && !empty($filter['jahr']) ){
                    $video_args['tax_query'] = ['relation' => 'OR', array( 'taxonomy' => 'jahr', 'field' => 'slug', 'terms' => $filter['jahr'], 'operator' => 'IN', )];
               }
               
          }
          
          //$videoMatrix .= var_dump( $video_args );

          $videoRows = get_posts( $video_args );
          $videoMatrix .= '<div class="video-content-wrapper" pageid="'.$pageID.'">';
          if( count( $videoRows ) > 0  ){
               
               foreach ( $videoRows as $key => $video ) {

                    
                    $videoID = $video->ID;
                    

                    //$videoMatrix .= var_dump( get_field('tags', $videoID) );
                    $videoTags = get_field('tags', $videoID );
                    $tagIDs = array_map( function ($tags) { return $tags->term_id; }, $videoTags );
                    
                    if( $filter ){
                         if( isset($filter['tags']) && count($filter['tags']) > 0){
                              $videoSkip = true;
                              $tempSet = true;
                              foreach( $filter['tags'] as $key => $tag ){
                                   if( in_array( $tag, $tagIDs ) && $tempSet ){
                                        $videoSkip = false;
                                   } else {
                                        $tempSet = false; 
                                        $videoSkip = true;
                                   }
                              }

                              if($videoSkip){
                                   continue;
                              }
                         }
                    }

                    $videoMatrix .= '<section class="video-section ">';
                         $videoMatrix .= $this->se2_video( $videoID );
                         $videoMatrix .= '<div class="video-section-info">';
                         $videoMatrix .= '<h4>'.get_the_title( $videoID ).'</h4>';
                         $videoMatrix .= '<h6 style="margin-top:5px;">'. $this->dateFormat->formating_Date_Language( get_the_date( 'Ymd', $videoID ), 'date' ).'</h6>';
                         $videoMatrix .= '<p style="margin-top:10px;">'.get_field( 'beschriftung', $videoID ).'</p>';
                          

                         if( get_field( 'corr-speakers', $videoID ) ){
                              $this->lineup = new LineUp;
                              $speakers = get_field( 'corr-speakers', $videoID );
                              $videoMatrix .= $this->lineup->cast_speaker_tag_cloud( $speakers );
                         }

                         $videoMatrix .= '<div class="video-tag-nodes">';
                         if( count( $videoTags ) > 0 ){
                              foreach( $videoTags as $tag ){
                                   $videoMatrix .= '<div class="video-tag" tagid="' . $tag->term_id . '">';
                                   $videoMatrix .= $tag->name;
                                   $videoMatrix .= '</div>';
                              }
                         }
                         $videoMatrix .= '</div>';

                         $videoMatrix .= '</div>';
                    $videoMatrix .= '</section>';
                   
               }
               
          }

         
          
          $videoMatrix .= '</div>';


          return $videoMatrix;
     }

     public function se2_video( $videoID ){
          $video = '';
          switch (get_field( 'type', $videoID)) {
               case 'youtube':
                    $video .= '<div class="video-wrapper video-section-'.get_field( 'type', $videoID).'">' . $this->se2_v_youtube( get_field( 'link', $videoID) ) . '</div>';
                    break;
               case 'vimeo':
                    $video .= '<div class="video-wrapper">' . $this->se2_v_vimeo( get_field( 'link', $videoID) ) . '</div>';
                    break;
               case 'html':
                    $video .= '<div class="video-wrapper">' . $this->se2_v_html( get_field( 'file', $videoID) ) . '</div>';
                    break;
               case 'simplex':
                    $video .= '<div class="video-wrapper">' . $this->se2_v_simplex( get_field( 'simplexid', $videoID) ) . '</div>';
                    break;
                    
               default:
                    $video .= var_dump($video['type']);
                    break;
          }
          return $video;
     }

     public function se2_v_youtube( $link ){
          $videoYT = '<iframe width="100%" height="100%" src="'.$link.'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
          return $videoYT;
     }

     public function se2_v_vimeo( $link ){
          $vimeoYT = '<iframe title="vimeo-player" width="100%" height="100%"  src="'.$link.'" frameborder="0" allowfullscreen></iframe>';
          return $vimeoYT;
     }

     public function se2_v_html( $file ){
          $htmlYT = '<video width="100%" height="100%" controls>';
          $htmlYT .= '<source src="'.$file['url'].'" type="'.$file['mime_type'].'">';
          $htmlYT .= 'Your browser does not support the video tag.';
          $htmlYT .= '</video>';
          return $htmlYT;
     }
     public function se2_v_simplex( $simplexid ){
          $vimeoYT = '<iframe  width="100%" height="100%" src="https://media10.simplex.tv/content/'. $simplexid .'/index.html?embed=1" frameborder="0" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true" scrolling="no"></iframe>';
          return $vimeoYT;
     }
     
}