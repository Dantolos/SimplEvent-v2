
gsap.registerPlugin(ScrollToPlugin);
gsap.registerPlugin(ScrollTrigger);

let animated = ( typeof StripAnimation !== 'undefined' ) ? true : false;

const FOCUSTARGETS = document.getElementsByClassName('focus-target')


FOCUSTARGETS.forEach(element => {


     ScrollTrigger.create({
          markers: false,
          
          trigger: element,
          start: "top center",
          end: "110% 90%",
          onEnter: ({progress, direction, isActive}) => { focusScrollAnimation( element ) },
          onEnterBack: ({progress, direction, isActive}) => { focusScrollAnimation( element ) } 
     })
});
 
function focusScrollAnimation(stripElement){
     gsap.to( window, { delay: .2, duration: .5, scrollTo: stripElement.offsetTop, autoKill: true })

     if( animated ){
       

          

          contentAnimation(stripElement)
     }
     
}

function contentAnimation(elements) {
  
     var animationsSettings = JSON.parse(StripAnimation);
     console.log( animationsSettings )

     animationsSettings['stagger'] /= 10;
     

     gsap.from( 
          elements.querySelectorAll('div > *'), 
          animationsSettings['duration'], 
          {
               opacity: animationsSettings['from']['opacity'],

          }
        
     )
}
