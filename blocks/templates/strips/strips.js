const VISIBILITY = new screenVisibility();
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
          onEnter: ({progress, direction, isActive}) => { scrollToStrip( element ) },
          onEnterBack: ({progress, direction, isActive}) => { scrollToStrip( element ) } 
     })
});



function scrollToStrip(stripElement){
     gsap.to( window, { delay: .2, duration: .5, scrollTo: stripElement.offsetTop, autoKill: true })

     if( animated ){
          gsap.from( stripElement.querySelectorAll('div > *'), .1, JSON.parse(StripAnimation) )
     }
     
}

