console.log('schedule')

var SLOTS = document.getElementsByClassName('schedule-slot');

nSLOTS = Array.prototype.slice.call(SLOTS);
nSLOTS.sort(function(a, b){
     return a.getAttribute('start').localeCompare(b.getAttribute('start'));
 });

for(var i = 0, len = nSLOTS.length; i < len; i++) {
     var parent = nSLOTS[i].parentNode;
     var detatchedItem = parent.removeChild(nSLOTS[i]);
     parent.appendChild(detatchedItem);
 }
console.log(nSLOTS)



var GRID = document.getElementsByClassName('schedule-5min');
var pageoffset = document.querySelector('.schedule-grid').getBoundingClientRect().top;

function SET_SLOT_POSITION(){
     for (let i = 0; i < nSLOTS.length; i++) {
          let start = nSLOTS[i].getAttribute('start');
          let duration = nSLOTS[i].getAttribute('dur');
          let minSections = document.querySelector('[timestamp="'+start+'"]')
          nSLOTS[i].style.top = (minSections.getBoundingClientRect().top - pageoffset) + 'px';
          nSLOTS[i].style.left = '20%';
          nSLOTS[i].style.height = (duration / 5) * minSections.offsetHeight  + 'px';
     }
}
SET_SLOT_POSITION()


var prevWidth = false;



for (let n = 0; n < nSLOTS.length; n++) {
     let start = nSLOTS[n].getAttribute('start');
     let end = nSLOTS[n].getAttribute('ende');
     
     if( n > 0 ){
          let m = n-1;
          let prevend = nSLOTS[m].getAttribute('ende')
          //for (let m = 0; m < nSLOTS.length; m++) {

          if( (start+1) <= prevend ){
               prevWidth = (prevWidth) ? false : true;
               nSLOTS[n].style.width = '50%'
               nSLOTS[m].style.width = '50%'

               if( prevWidth ){
                    nSLOTS[n].style.marginLeft = '50%'
               }
          } else { prevWidth = false }
     }
     //}
}

for( let SLOT of SLOTS){
    
     SLOT.addEventListener('mouseover', (e)=> {
          SLOT.style.zIndex = 1000;
          SLOT.style.overflowY = 'visible';
   
          gsap.to(SLOT.querySelector('.schedule-container'), { duration: .1, scale: 1.04  })
          

          
          gsap.to(SLOT.querySelector('.schedule-slot-info'), { duration: .3, scaleY: 1  })

     });
     SLOT.addEventListener( 'mouseleave', () => {
          SLOT.style.zIndex = 'unset';
          SLOT.style.overflowY = 'hidden';

          gsap.to(SLOT.querySelector('.schedule-container'), { duration: .2, scale: 1  })
         
          gsap.to(SLOT.querySelector('.schedule-slot-info'), { duration: .3, scaleY: 0  })
     });
}
