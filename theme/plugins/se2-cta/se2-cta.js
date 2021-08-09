
var LIGHTBOX = new Lightbox();

const CTABUTTON = document.getElementById('cta-button');
const CTATOOLTIPS = CTABUTTON.querySelector('.cta-tooltip');
gsap.set(CTATOOLTIPS, { opacity: 0, x: '20px' })

CTABUTTON.addEventListener('mouseover', e => {
    CTATOOLTIPS.style.display = 'block'
    gsap.to(CTATOOLTIPS, { duration: .1, opacity: 1, x: 0})
})
CTABUTTON.addEventListener('mouseleave', e => {
    gsap.to(CTATOOLTIPS, { duration: .2, opacity: 0, x: '20px'})
    CTATOOLTIPS.style.display = 'none'

})


CTABUTTON.addEventListener('click', ()=>{
    LIGHTBOX.openLightbox('api', CTABUTTON.getAttribute('data-api'));  
})
