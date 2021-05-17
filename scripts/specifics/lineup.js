//---------------------------------
//LINE UP
//---------------------------------
var SPEAKERS = document.querySelectorAll('.speaker-profile')

//stadard-ansicht
var args = {
     view : 'grid',
     cat : 'all',
     sort : ''
};


const LINEUPCONTAINER = document.getElementById('lineup-container')
console.log('asdfaslkjdfh')

//categories
const CATFORM = document.getElementById('speechcat')

CATFORM.addEventListener( 'change', (e)=>{
     args.cat = CATFORM.value
     CALL_AJAX_LINEUP(args)
})

//order
const ORDERBUTTON = document.querySelector('.se2-lineup-filter-sort')

var sortTL = gsap.timeline({ defaults: {duration: .5}})
var SORTICON = document.getElementById('dsc');
sortTL.to(SORTICON, {morphSVG:"#asc"} );

ORDERBUTTON.addEventListener('click', ()=>{
     args.sort = (args.sort == 'asc') ? 'dsc' : 'asc';
     sortTL.play()
     if( args.sort == 'dsc' ){
          sortTL.play()
     } else {
          sortTL.reverse()
     }
     
     CALL_AJAX_LINEUP(args)
})

//view
const VIEWBUTTONS = document.querySelectorAll('.viewbutton')

for(let VIEWS of VIEWBUTTONS ){
     VIEWS.addEventListener( 'click', ()=>{
          if( !VIEWS.classList.contains('active-icon') ){
               VIEWBUTTONS.forEach(el => el.classList.remove('active-icon'))
               VIEWS.classList.add('active-icon')
               args.view = VIEWS.getAttribute('view')
               CALL_AJAX_LINEUP(args)
               console.log(args)
          }
     })
} 

function CALL_AJAX_LINEUP( a ){
     console.log(a)
     var callData = {
          details : a,
          action : 'lineup'
     }
     AJAX.call_Ajax( callData, 'se2-lineup-container', true );

     jQuery( document ).ajaxComplete(function(){ 
          CALL_ANIMATION(document.querySelectorAll('.speaker-profile'))
          CALL_SPEAKER_LIGHTBOX(document.querySelectorAll('.speaker-profile'))
     })

}




//listelemennts, animations
CALL_ANIMATION(SPEAKERS)
CALL_SPEAKER_LIGHTBOX(SPEAKERS)

function CALL_ANIMATION(S){
     try {
          if(S.length > 0){
               //grid aniamtions
               if( S[0].classList.contains('se2-speaker-grid-profile') ){
                    for(let SPEAKER of S){
                         SPEAKER.addEventListener('mouseover', e=>{
                              gsap.to( SPEAKER.querySelector('.se2-speaker-grid-image'), .1, { scale: 1.1 }  )
                              gsap.to( SPEAKER.querySelector('.se2-speaker-grid-content'), .1, { opacity: 1, backdropFilter: 'blur(5px)' } )
                         })
                         SPEAKER.addEventListener('mouseleave', e=>{
                              gsap.to( SPEAKER.querySelector('.se2-speaker-grid-content'), .5, { opacity: 1, backdropFilter: 'blur(0px)' } )
                              gsap.to( SPEAKER.querySelector('.se2-speaker-grid-image'), .4, { scale: 1 }  )
                         })
                    }
               }
          }
     } catch (error) {
          console.log(error)
     }
}

function CALL_SPEAKER_LIGHTBOX(S){
     try {
          for(let SPEAKER of S){
               SPEAKER.addEventListener('click', e=>{
                    let speakerID = SPEAKER.getAttribute('speakerid')
                    var callData = {
                         speakerid : speakerID,
                         action : 'speaker_lightbox'
                    }
                    LIGHTBOX.openLightbox( 'AX', callData );
               })
          }
     } catch (error) {
          console.log(error)
     }
     jQuery( document ).ajaxComplete(function(){ 
          let speakerLB = document.querySelector('.speaker-lb-container');
          gsap.fromTo(document.querySelector('.speaker-lb-container'), .2, { x: '-100%', ease:Power1.easeOut }, { x: '0' } )
          TweenMax.staggerFromTo('.speaker-stagger', .2, { opacity:0, x: '-100%', delay: 0.1 }, { opacity:1, x: '0' }, 0.05 )

          let reviewVideo = document.querySelector('.review-video')
          try{
               let newHeight = reviewVideo.offsetWidth / 16 * 9
               reviewVideo.style.height = newHeight + 'px'
          } catch (error) {
               console.log(error)
          }
        
          
     })
}
