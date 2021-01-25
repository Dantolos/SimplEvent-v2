class se2_Ajax
{
    call_Ajax(dataToCall, containerClassName, clearing = false)
    {


        console.log(dataToCall);
        
        this.parentContainer = document.getElementsByClassName(containerClassName);
        if(clearing) {
          this.parentContainer[0].innerHTML = '';
        }
        

        this.loadanimation = document.createElement('DIV');
        this.loadanimation.classList.add('se-loader');
        this.loadanimation.innerHTML = '<div></div>';
        
        this.parentContainer[0].appendChild(this.loadanimation);
        

        jQuery(document).ready(function($){
            
            /* var tl = new TimelineMax({repeat: -1});
            tl.to($('.se-loader'), 0.5, {rotation: 480, borderRadius: '50%', scaleX:2 }); */
            
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