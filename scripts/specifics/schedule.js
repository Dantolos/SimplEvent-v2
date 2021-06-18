console.log('schedule')

const DAYTABS = document.getElementById('daytabs');
if (DAYTABS) {
     for (let index = 0; index < DAYTABS.childNodes.length; index++) {
          DAYTAB = DAYTABS.childNodes[index]
          DAYTAB.addEventListener('click', (date) => {
               let newPosition = -Math.abs(index * 100) + '%'
               gsap.to(document.getElementsByClassName('schedule-program-day'), {
                    duration: .2, x: newPosition, ease: Power4.easeOut
               })
               for (let DAYBUTTON of DAYTABS.childNodes) {
                    if (DAYBUTTON.getAttribute("day") === DAYTABS.childNodes[index].getAttribute("day")) {
                         DAYBUTTON.classList.add("day-tab-activ");
                    } else {
                         DAYBUTTON.classList.remove("day-tab-activ");
                    }
               }
          })
     }
}
var SLOTS = document.getElementsByClassName('schedule-slot');




nSLOTS = Array.prototype.slice.call(SLOTS);

nSLOTS.sort(function (a, b) {
     return a.getAttribute('start').localeCompare(b.getAttribute('start'));
});


for (var i = 0, len = nSLOTS.length; i < len; i++) {
     var parent = nSLOTS[i].parentNode;
     var detatchedItem = parent.removeChild(nSLOTS[i]);
     parent.appendChild(detatchedItem);
}

console.log(nSLOTS)


var GRID = document.getElementsByClassName('schedule-5min');
var pageoffset = document.querySelector('.schedule-grid').getBoundingClientRect().top;

function SET_SLOT_POSITION() {
     for (let i = 0; i < nSLOTS.length; i++) {
          let start = nSLOTS[i].getAttribute('start');
          let duration = nSLOTS[i].getAttribute('dur');
          let minSections = document.querySelector('[timestamp="' + start + '"]')

          if (minSections === null) {
               nSLOTS[i].style.display = 'none'
               console.warn('Slot hidden: Time is not defined', nSLOTS[i])
               continue;
          }
          nSLOTS[i].style.top = (minSections.getBoundingClientRect().top - pageoffset) + 'px';
          //nSLOTS[i].style.left = '20%';
          nSLOTS[i].style.height = (duration / 5) * minSections.offsetHeight + 'px';
     }
}

SET_SLOT_POSITION()


var prevWidth = false;


for (let n = 0; n < nSLOTS.length; n++) {
     let start = nSLOTS[n].getAttribute('start');
     let end = nSLOTS[n].getAttribute('ende');
     let date = nSLOTS[n].getAttribute('date');

     if (n > 0) {
          let m = n - 1;
          let prevend = nSLOTS[m].getAttribute('ende')

          //for (let m = 0; m < nSLOTS.length; m++) {
          if (date == nSLOTS[m].getAttribute('date')) {
               if ((start + 1) <= prevend) {
                    prevWidth = (prevWidth) ? false : true;
                    nSLOTS[n].style.width = '47.5%'
                    nSLOTS[m].style.width = '47.5%'

                    if (prevWidth) {
                         nSLOTS[n].style.marginLeft = '50%'
                    }
               } else { prevWidth = false }
          }
     }
}


for (let SLOT of SLOTS) {

     SLOT.addEventListener('mouseover', (e) => {
          SLOT.style.zIndex = 1000;
          SLOT.style.overflowY = 'visible';
          gsap.set(SLOT.querySelector('.schedule-slot-info'), { y: 20 })
          gsap.to(SLOT.querySelector('.schedule-container'), { duration: .1, scale: 1.02 })
          gsap.to(SLOT.querySelector('.schedule-slot-info'), { duration: .1, y: 0, display: 'block' })
     });

     SLOT.addEventListener('mouseleave', () => {
          SLOT.style.zIndex = 'unset';
          SLOT.style.overflowY = 'hidden';

          gsap.to(SLOT.querySelector('.schedule-container'), { duration: .2, scale: 1 })
          gsap.to(SLOT.querySelector('.schedule-slot-info'), { duration: .2, y: 20, display: 'none' })
     });

}


//SPEAKER SLOTS
const SPEAKERSLOTS = document.querySelectorAll('.schedule-speaker')
LB_SPEAKER.CALL_SPEAKER_LIGHTBOX(SPEAKERSLOTS)


//SESSION SLOTS
const SESSIONSLOTS = document.querySelectorAll('.schedule-session')
LB_SESSION.CALL_SESSION_LIGHTBOX(SESSIONSLOTS)



