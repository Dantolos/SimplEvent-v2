
var LIGHTBOX = new Lightbox();

const CTABUTTONS = document.querySelectorAll('.cta-button');

if (CTABUTTONS.length > 0) {
     for (let CTABUTTON of CTABUTTONS) {
          let CTATOOLTIPS = CTABUTTON.querySelector('.cta-tooltip')
          let CTATOOLTIPSwidth = CTATOOLTIPS.offsetWidth
          gsap.set(CTABUTTON, { x: CTATOOLTIPSwidth })
          gsap.to(CTATOOLTIPS, { opacity: 0, x: '20px' })
          CTABUTTON.addEventListener('mouseover', e => {

               gsap.to(CTABUTTON, { duration: .1, x: 0 })
               gsap.to(CTATOOLTIPS, { delay: .05, duration: .2, opacity: 1, x: 0 })
          })
          CTABUTTON.addEventListener('mouseleave', e => {
               gsap.to(CTABUTTON, { duration: .1, x: CTATOOLTIPSwidth })
               gsap.to(CTATOOLTIPS, { delay: .05, duration: .2, opacity: 0, x: '20px' })


          })
          CTABUTTON.addEventListener('click', () => {
               let postID = CTABUTTON.dataset.postid
               var callData = {
                    postid: postID,
                    action: 'cta'
               }
               LIGHTBOX.openLightbox('AX', callData);
          })
     }

}