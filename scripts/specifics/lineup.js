//---------------------------------
//LINE UP
//---------------------------------
var LIGHTBOX = new Lightbox();
var SPEAKERS = document.querySelectorAll('.speaker-profile')



//stadard-ansicht
var currenYear = document.getElementById('lineup-container').getAttribute('year')
var args = {
     view: 'grid',
     cat: 'all',
     sort: '',
     year: currenYear
};


const LINEUPCONTAINER = document.getElementById('lineup-container')

//jahr
const YEARFORM = document.getElementById('speakeryear')
if(YEARFORM){
     YEARFORM.addEventListener('change', (e) => {
          args.year = YEARFORM.value
          CALL_AJAX_LINEUP(args)
     })
}

//categories
const CATFORM = document.getElementById('speechcat')
if(CATFORM){
     CATFORM.addEventListener('change', (e) => {
          args.cat = CATFORM.value
          CALL_AJAX_LINEUP(args)
     })
}


//order
const ORDERBUTTON = document.querySelector('.se2-lineup-filter-sort')

var sortTL = gsap.timeline({ defaults: { duration: .5 } })
var SORTICON = document.getElementById('dsc');
sortTL.to(SORTICON, { morphSVG: "#asc" });

if(ORDERBUTTON){
ORDERBUTTON.addEventListener('click', () => {

     args.sort = (args.sort == 'asc') ? 'dsc' : 'asc';
     sortTL.play()

     if (args.sort == 'dsc') {
          sortTL.play()
     } else {
          sortTL.reverse()
     }

     CALL_AJAX_LINEUP(args)

})
}


//view
const VIEWBUTTONS = document.querySelectorAll('.viewbutton')

for (let VIEWS of VIEWBUTTONS) {

     VIEWS.addEventListener('click', () => {

          if (!VIEWS.classList.contains('active-icon')) {

               VIEWBUTTONS.forEach(el => el.classList.remove('active-icon'))
               VIEWS.classList.add('active-icon')
               args.view = VIEWS.getAttribute('view')
               CALL_AJAX_LINEUP(args)
               console.log(args)

          }

     })

}



function CALL_AJAX_LINEUP(a) {

     console.log(a)

     var callData = {
          details: a,
          action: 'lineup'
     }

     AJAX.call_Ajax(callData, 'se2-lineup-container', true);

     jQuery(document).ajaxComplete(function () {
          //CALL_ANIMATION(document.querySelectorAll('.speaker-profile'))
          LB_SPEAKER.CALL_SPEAKER_LIGHTBOX(document.querySelectorAll('.speaker-profile'))
     })

}




//listelemennts, animations

CALL_ANIMATION(SPEAKERS)
LB_SPEAKER.CALL_SPEAKER_LIGHTBOX(SPEAKERS)


function CALL_ANIMATION(S) {

     try {

          if (S.length > 0) {

               //grid aniamtions
               if (S[0].classList.contains('se2-speaker-grid-profile')) {

                    for (let SPEAKER of S) {
                         SPEAKER.addEventListener('mouseover', e => {
                              gsap.to(SPEAKER.querySelector('.se2-speaker-grid-image'), .1, { scale: 1.05 })
                              gsap.to(SPEAKER.querySelector('.se2-speaker-grid-content'), .1, { opacity: 1, backdropFilter: 'blur(5px)' })
                         })

                         SPEAKER.addEventListener('mouseleave', e => {
                              gsap.to(SPEAKER.querySelector('.se2-speaker-grid-content'), .5, { opacity: 1, backdropFilter: 'blur(0px)' })
                              gsap.to(SPEAKER.querySelector('.se2-speaker-grid-image'), .4, { scale: 1 })
                         })
                    }
               }
          }

     } catch (error) {
          console.warn(error)
     }

}



//LIGHTBOX

//REVIEW GALLERY 
var REVIEWGALLERY = [];
jQuery(document).ajaxComplete(function () {
    
     REVIEWGALLERY = document.querySelectorAll('.se-review-img');
     if (REVIEWGALLERY) {
         for (let index = 0; index < REVIEWGALLERY.length; index++) {
               REVIEWGALLERY[index].addEventListener('click', (e)=>{
                    console.log(REVIEWGALLERY[index].querySelector('img').getAttribute('src'))
                    REVIEWGALLERY.forEach(function(el) { el.classList.remove('se-review-img-active') })
                    if(REVIEWGALLERY[index].getAttribute('open', '0')){
                         REVIEWGALLERY[index].setAttribute('open', '1')
                         REVIEWGALLERY[index].classList.add('se-review-img-active')
                    }else {
                         REVIEWGALLERY[index].classList.remove('se-review-img-active')
                         REVIEWGALLERY[index].setAttribute('open', '0')
                         
                    }
                    
                  
               })
              
         }

     }

})