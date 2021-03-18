var LOADER = new se2_Loader();

class se2_Ajax
{
    call_Ajax(dataToCall, containerClassName, clearing = false)
    {

        this.parentContainer = document.getElementsByClassName(containerClassName);
        if(clearing) {
          this.parentContainer[0].innerHTML = '';
        }
        
        LOADER.cast_Loader(this.parentContainer[0]);

        jQuery(document).ready(function($){

            $.ajax({
                url : globalURL.ajaxurl,
                type : 'post',
                data : dataToCall,
                error : function( response )
                {
                        console.log(response);
                        $('.se-loader').remove();
                },
                success : function( response, textStatus, XMLHttpRequest )
                {              
                         
                  try {
                      response = decodeURI(response);
                  }
                  catch(err) {
                      console.log(err.message);
                  }
                
                  $('.' + containerClassName).append(response);
                  $('.se-loader').remove();

                  if( document.querySelector('.se2-post-lb-gallery') ) {
                      let galery = new se2_Gallery();
                      galery.std_gallery(document.querySelector('.se2-post-lb-gallery'))
                  }
                }
            });
        });
    } 
     
}