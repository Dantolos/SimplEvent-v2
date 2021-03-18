//---------------------------------
//LINE UP
//---------------------------------

//stadard-ansicht
var args = {
     view : 'grid',
     cat : 'all',
     sort : 'asc'
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

ORDERBUTTON.addEventListener('click', ()=>{
     let startSort = args.sort
     args.sort = (args.sort == 'asc') ? 'dsc' : 'asc';
     gsap.to( '#'+startSort, .2, { morphSVG: '#'+args.sort})

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
          }
     })
}


function CALL_AJAX_LINEUP( a ){
     console.log(a)
  
     console.log(JSON.stringify(a))
     var callData = {
          details : a,
          action : 'lineup'
     }
     AJAX.call_Ajax( callData, 'se2-lineup-container', true );
}



//listelemennts, animations
const GRIDSPEAKER = document.querySelectorAll('.se2-speaker-grid-profile');