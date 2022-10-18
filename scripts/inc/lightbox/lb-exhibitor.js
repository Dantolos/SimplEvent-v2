class se2_LB_Exhibitor {

    // *S* is an array of DOM elements that
    // element needs attribute: speakerid="**Wordpress Post-ID from Speaker**" 
    CALL_EXHIBITOR_LIGHTBOX(E) {
         try {
              for (let EXHIBITOR of E) {
                    EXHIBITOR.addEventListener('click', e => {

                        let exhibitorID = EXHIBITOR.dataset.exhibitorid
                        let pageID = EXHIBITOR.dataset.pageid
                        var callData = {
                            pageid: pageID,
                            exhibitorid: exhibitorID,
                            action: 'exhibitor_lightbox'
                        }
                        LIGHTBOX.openLightbox('AX', callData);
                        console.log(exhibitorID)
                   })
              }
         } catch (error) {
              console.warn('LB EXHIBITOR: ', error)
         }

         jQuery(document).ajaxComplete(function () {
              let exhibitorID = document.querySelector('.exhibitor-lb-container');
              gsap.fromTo(document.querySelector('.exhibitor-lb-container'), .2, { x: '-100%', ease: Power1.easeOut }, { x: '0' })
              TweenMax.staggerFromTo('.exhibitor-stagger', .2, { opacity: 0, x: '-100%', delay: 0.1 }, { opacity: 1, x: '0' }, 0.05)

              let reviewVideos = document.querySelector('.review-videos')

              
             
         })
    }
F

}