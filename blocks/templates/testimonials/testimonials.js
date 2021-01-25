const TESTIMONIALS = document.getElementsByClassName('testimonial-container')
var SLIDENR = 0;


if(TESTIMONIALS.length > 0){

    loadNextSlide( SLIDENR, TESTIMONIALS )

    var TESTIMONIALSLIDER = setInterval(()=>{
        for( let TESTIMONIAL of TESTIMONIALS ) {
            gsap.to(TESTIMONIAL, { duration: .2, y: '0', opacity:0  });
            setTimeout(()=>{
                TESTIMONIAL.style.display = 'none';}
            , 300)  
        }
        setTimeout(()=>{
            loadNextSlide( SLIDENR, TESTIMONIALS )
        }
        , 300) 
    }, 6000)
}




function loadNextSlide( eleID, slideArray ) {

    
    if( (eleID+1) == slideArray.length ){
        SLIDENR = 0;
    } else {
        SLIDENR++
    }

    console.log(slideArray.length)
    let nextSlide = document.querySelector('[slide="' + eleID + '"]');

    nextSlide.style.display = 'block';
    gsap.fromTo( nextSlide, { duration: .1, opacity:0, x: '0', ease: Power1.easeOut  }, {  opacity: 1 } )
    gsap.from( nextSlide.querySelector('.testimonial-portrait'), { duration: .2,  ease: Power1.easeOut  })
    gsap.from( nextSlide.querySelector('.testimonial-text'), { duration: .3, ease: Power1.easeOut  })
    

}