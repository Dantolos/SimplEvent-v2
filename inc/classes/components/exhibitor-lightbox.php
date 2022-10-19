<?php

namespace se2\components\lightbox;

function exhibitor_lightbox($pageID, $exhibitorBoothID){

    $exhibitorList = get_field( 'exhibitors', $pageID );
    $cleanExhibitorBoothID = intval( str_replace( '_', '', $exhibitorBoothID ) );

    $exhibitorLightbox = '';
    $exhibitorLightbox .= '<div class="exhibitor-lb-container">';

        $contentFound = false;
        for ( $i=0; $i < count($exhibitorList); $i++ ) { 
            if( ($cleanExhibitorBoothID-1) == $i ){
                $exhibitorID = $exhibitorList[$i]['exhibitor'];

                $exhibitorLightbox .= '<div class="exhibitor-lb-container">';
                    $exhibitorLightbox .= '<div class="exhibitor-lb-moodimage" style="background-image:url('.get_field('media',$exhibitorID )['mood_image'].');"></div>';
                    $exhibitorLightbox .= '<div class="exhibitor-lb-content">';

                        $exhibitorLightbox .= '<div class="exhibitor-lb-product">';
                            $exhibitorLightbox .= '<div class="exhibitor-lb-product-image"><img alt="" src="'. get_field('exhibitor_booth',$exhibitorID )['product_image'] . '"/></div>';
                            $exhibitorLightbox .= '<div class="exhibitor-lb-product-description">';
                                $exhibitorLightbox .= '<h4>'.get_field('exhibitor_booth',$exhibitorID )['product_title'].'</h4>';
                                $exhibitorLightbox .= '<p>'.get_field('exhibitor_booth',$exhibitorID )['product_description'].'</p>';
                            $exhibitorLightbox .= '</div>';
                        $exhibitorLightbox .= '</div>';

                        $exhibitorLightbox .= '<div class="exhibitor-lb-company">';
                            $exhibitorLightbox .= '<div class="exhibitor-lb-company-logo"><img alt="" src="'. get_field('media',$exhibitorID )['logo_positiv'] . '"/></div>';
                            $exhibitorLightbox .= '<div class="exhibitor-lb-company-description">';
                                $exhibitorLightbox .= '<h4>'.get_the_title($exhibitorID).'</h4>';
                                $exhibitorLightbox .= '<p>'.get_field('description',$exhibitorID ).'</p>';
                            $exhibitorLightbox .= '</div>';
                            $exhibitorLightbox .= '<div class="exhibitor-lb-keyfacts">';

                                $facts = get_field('Key data',$exhibitorID );

                                //Founder Year
                                if( !$facts['Founding year'] ){
                                    $exhibitorLightbox .= '<div class="exhibitor-lb-keyfact-cell">';
                                    $exhibitorLightbox .= '<h5>'.__('Founder Year', 'SimplEvent').'</h5>';
                                    $exhibitorLightbox .= '<h5>'.$facts['Founding year'].'</h5>';
                                    $exhibitorLightbox .= '</div>';
                                }

                                //Lead
                                if( count($facts['lead']) > 0 ){
                                    $exhibitorLightbox .= '<div class="exhibitor-lb-keyfact-cell">';
                                    $exhibitorLightbox .= '<h5>'.__('Lead', 'SimplEvent').'</h5>';
                                    foreach( $facts['lead'] as $leader ){
                                        $exhibitorLightbox .= '<h5 style="">'.$leader['name'] .'</h5>';
                                        $exhibitorLightbox .= '<h5 style="line-height: .5em !important; margin-bottom:15px; font-weight:200 !important;">'.$leader['position'].'</h5>';
                                    }
                                    $exhibitorLightbox .= '</div>';
                                }

                                //Employee
                                if( !$facts['employee'] ){
                                    $exhibitorLightbox .= '<div class="exhibitor-lb-keyfact-cell">';
                                    $exhibitorLightbox .= '<h5>'.__('Employee', 'SimplEvent').'</h5>';
                                    $exhibitorLightbox .= '<h5>'.$facts['employee'].'</h5>';
                                    $exhibitorLightbox .= '</div>';
                                }

                                //Website
                                if( !$facts['employee'] ){
                                    $exhibitorLightbox .= '<div class="exhibitor-lb-keyfact-cell">';
                                    $exhibitorLightbox .= '<h5>'.__('Mehr', 'SimplEvent').'</h5>';
                                    $exhibitorLightbox .= '<a href="'.$facts['website'].'"><div class="exhibitor-lb-keyfact-button">'.__('Website', 'SimplEvent').'</div></a>';
                                    $exhibitorLightbox .= '</div>';
                                }

                            $exhibitorLightbox .= '</div>';
                        $exhibitorLightbox .= '</div>';
                        
                    $exhibitorLightbox .= '</div>';
                $exhibitorLightbox .= '</div>';
                $contentFound = true;
                break;
            } 
        }

        //Fallback if no content found
        $exhibitorLightbox .= !$contentFound ? '<div class="exhibitor-lb-empty"><h3>'. __('More Information about this Exhibitor will follow soon.', 'SimplEvent') .'</h3></div>' : '';

    $exhibitorLightbox .= '</div>';
    return $exhibitorLightbox;
}