<?php

class Tags {
     

     public function tag_cloud( $tags = array() ){
          $tagCloud = '';
          $tagCloud .= '<div class="se2-tag-cloud">';
          foreach($tags as $tag){
               $tagCloud .= $this->tag_element($tag);
          }
          $tagCloud .= '</div>';
          return $tagCloud;
     }

     public function tag_element($tag){
          $tagElement = '';
          if(is_string($tag)){
               $tagElement .= "<div class=\"se2-tag-element\">${tag}</div>";
          } elseif (is_array($tag)) {
               $tagElement .= $tag['link'] ? "<a href=\"${tag['link']}\">" :'';
               $tagElement .= "<div class=\"se2-tag-element\">${tag['value']}</div>";
               $tagElement .= $tag['link'] ? "</a>" :'';
          }
          return $tagElement;
     }
}