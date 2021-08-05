<?php 

class se2_CTA{
    public $cta;

    
    function cast_cta_button(){
        $this->cta = '<div style="position:fixed;right:20px;top:50%;background-color:red;color:white;z-index:9000;">CTA</div>';
        return $this->cta;
    }

   
}