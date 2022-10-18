class se2_LB_Session {

     // *S* is an array of DOM elements that
     // element needs attribute: speakerid="**Wordpress Post-ID from Speaker**" 
     CALL_SESSION_LIGHTBOX(S) {

          try {
               for (let SESSION of S) {
                    SESSION.addEventListener('click', e => {

                         let sessionID = SESSION.getAttribute('sessionid')
                         var callData = {
                              sessionid: sessionID,
                              action: 'session_lightbox'
                         }
                         LIGHTBOX.openLightbox('AX', callData);
                    })
               }
          } catch (error) {
               console.warn('LB SESSION: ', error)
          }

          jQuery(document).ajaxComplete(function () {
               let speakerLB = document.querySelector('.session-lb-container');
               gsap.fromTo(document.querySelector('.session-lb-container'), .2, { x: '-100%', ease: Power1.easeOut }, { x: '0' })
               TweenMax.staggerFromTo('.session-stagger', .2, { opacity: 0, x: '-100%', delay: 0.1 }, { opacity: 1, x: '0' }, 0.05)

               let reviewVideo = document.querySelector('.review-video')

               try {
                    let newHeight = reviewVideo.offsetWidth / 16 * 9
                    reviewVideo.style.height = newHeight + 'px'
               } catch (error) {
                    //console.warn('LB SESSION: ', error)
               }


          })
     }


}