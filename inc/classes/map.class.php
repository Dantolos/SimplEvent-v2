<?php

namespace se2\map;

class se2_Map {

    public $mapSVGContent;
    private $pageID;

    public function __construct( $pageID ){
        $this->pageID = $pageID;
        $mapSVG = get_field('map_svg', $pageID);
        $this->mapSVGContent = file_get_contents($mapSVG);
    }

    public function cast_map(){
        $mapOutput = '';

        $mapOutput .= '<div id="mapframe" data-pageid="'.$this->pageID.'" onmousemove="mouseTracking(event)" >';

            //ZOOM Buttons
             $mapOutput .= '<div id="map-nav">';
                $mapOutput .= '<button id="reset" style=""></button>';
                $mapOutput .= '<button id="zoomout"></button>';
                $mapOutput .= '<button id="zoomin"></button>';
                $mapOutput .= '<button id="list" ></button>';
            $mapOutput .= '</div>';  

            $mapOutput .= '<div id="map">';
            $mapOutput .= $this->mapSVGContent;
            $mapOutput .= '</div>';

            $mapOutput .= '<div id="booth-tooltip" class="hide-tooltip">';
            $mapOutput .= '<div class="booth-tooltip-logo"><img src="" /></div>';
            $mapOutput .= '<h5></h5>';
            $mapOutput .= '</div>';

        $mapOutput .= '</div>';

        return $mapOutput;
    }

    
}