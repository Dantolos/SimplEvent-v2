class se2_LB_Candidate {

     // *C* is an array of DOM elements that
     // element needs attribute: candidate="**Wordpress Post-ID from candidate**" 
     CALL_CANDIDATE_LIGHTBOX(C) {

          try {
               for (let CANDIDATE of C) {
                    CANDIDATE.addEventListener('click', e => {

                         let candidateID = CANDIDATE.getAttribute('candidate')
                         var callData = {
                              candidate: candidateID,
                              action: 'candidate_lightbox'
                         }
                         LIGHTBOX.openLightbox('AX', callData);
                    })
               }
          } catch (error) {
               console.warn('LB CANDIDATE: ', error)
          }

          jQuery(document).ajaxComplete(function () {
               let speakerLB = document.querySelector('.candidate-lb-container');
               gsap.fromTo(document.querySelector('.candidate-lb-container'), .2, { x: '-100%', ease: Power1.easeOut }, { x: '0' })
               TweenMax.staggerFromTo('.candidate-stagger', .2, { opacity: 0, x: '-100%', delay: 0.1 }, { opacity: 1, x: '0' }, 0.05)

               let reviewVideo = document.querySelector('.review-video')

               try {
                    let newHeight = reviewVideo.offsetWidth / 16 * 9
                    reviewVideo.style.height = newHeight + 'px'
               } catch (error) {
                    console.warn('LB CANDIDATE: ', error)
               }


          })
     }


}