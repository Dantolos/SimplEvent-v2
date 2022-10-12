<?php

namespace se2\map;

class se2_Map {

    public $mapSVGContent;

    public function __construct( $pageID ){
        
        $mapSVG = get_field('map_svg', $pageID);
        $this->mapSVGContent = file_get_contents($mapSVG);
        
    }

    public function cast_map(){
        $mapOutput = '';

        $mapOutput .= '<div id="mapframe">';

            //ZOOM Buttons
            $mapOutput .= '<div id="map-nav">';
                $mapOutput .= '<button id="zoomout">-</button>';
                $mapOutput .= '<button id="zoomin">+</button>';
            $mapOutput .= '</div>'; 

            $mapOutput .= '<div id="map">';
            $mapOutput .= $this->mapSVGContent;
            $mapOutput .= '</div>';
        $mapOutput .= '</div>';

        return $mapOutput;
    }
}