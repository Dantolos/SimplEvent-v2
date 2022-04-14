var LOADER = new se2_Loader();

class se2_Ajax {
    call_Ajax(data, containerClassName, clearing = false) {

        this.parentContainer = document.getElementsByClassName(containerClassName);
        if (clearing) {
            this.parentContainer[0].innerHTML = '';
        }
        var dataToCall = data;
        console.log(dataToCall)
        LOADER.cast_Loader(this.parentContainer[0]);

        jQuery(document).ready(function ($) {

            $.ajax({
                url: globalURL.ajaxurl,
                type: 'post',
                data: dataToCall,
                error: function (response) {
                    console.warn(response);
                    $('.se-loader').remove();
                },
                success: function (response, textStatus, XMLHttpRequest) {
                    console.log(response);
                    try {
                        response = decodeURIComponent(response);

                    }
                    catch (err) {
                        console.warn(err.message);
                    }

                    if (document.querySelector('.se2-post-lb-gallery')) {
                        let galery = new se2_Gallery();
                        galery.std_gallery(document.querySelector('.se2-post-lb-gallery'))
                    }
                }
            }).done((response)=>{
                $('.' + containerClassName).append(response);
                $('.se-loader').remove();
                console.log('%c || AJAX DONE || ', 'background: green')
            });
        });
    }

}