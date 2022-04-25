class se2_LB_Speaker {

     // *S* is an array of DOM elements that
     // element needs attribute: speakerid="**Wordpress Post-ID from Speaker**" 
     CALL_SPEAKER_LIGHTBOX(S) {
          try {
               for (let SPEAKER of S) {
                    SPEAKER.addEventListener('click', e => {

                         let speakerID = SPEAKER.dataset.speakerid
                         var callData = {
                              speakerid: speakerID,
                              action: 'speaker_lightbox'
                         }
                         LIGHTBOX.openLightbox('AX', callData);
                         console.log(speakerID)
                    })
               }
          } catch (error) {
               console.warn('LB SPEAKER: ', error)
          }

          jQuery(document).ajaxComplete(function () {
               let speakerLB = document.querySelector('.speaker-lb-container');
               gsap.fromTo(document.querySelector('.speaker-lb-container'), .2, { x: '-100%', ease: Power1.easeOut }, { x: '0' })
               TweenMax.staggerFromTo('.speaker-stagger', .2, { opacity: 0, x: '-100%', delay: 0.1 }, { opacity: 1, x: '0' }, 0.05)

               let reviewVideos = document.querySelector('.review-videos')

               
              
          })
     }


}