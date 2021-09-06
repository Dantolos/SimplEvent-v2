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

var firstSlotPosition = 2400;

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

          
          if(window.innerWidth > 1024){
               //DESKTOP CALENDAR
               nSLOTS[i].style.position = 'absolute';
               nSLOTS[i].style.top = (minSections.getBoundingClientRect().top - pageoffset) + 'px';
               if ((minSections.getBoundingClientRect().top - pageoffset) < firstSlotPosition) {
                    firstSlotPosition = (minSections.getBoundingClientRect().top - pageoffset);
               }
               //nSLOTS[i].style.left = '20%';
               nSLOTS[i].style.height = (duration / 5) * minSections.offsetHeight + 'px';
               jQuery(window).scrollTop(firstSlotPosition - 50)
          } else {
               //TABLE
               nSLOTS[i].style.position = 'relative';
               nSLOTS[i].style.top = 'unset';
               nSLOTS[i].style.height = 'fit-content';
          }

     }

     // Scroll timeline to first slot

}

window.addEventListener('resize', ()=>{
     SET_SLOT_POSITION()
     
          SPLIT_WIDTH()
      
     
     console.log('resising')
} )
SET_SLOT_POSITION()


var prevWidth = false;

function SPLIT_WIDTH(){
   
          for (let n = 0; n < nSLOTS.length; n++) {
               if(window.innerWidth > 1024){
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
               } else {
                    nSLOTS[n].style.width = '100%'
                    nSLOTS[n].style.marginLeft = '0'
               }
          }
     
}

console.log('DEVICE: ', DETECT.detectMobile())
var slotToggler = false;
for (let SLOT of SLOTS) {

     if (window.innerWidth > 1024) {
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
     } else {

          SLOT.addEventListener('click', (e) => {

               /* if (!slotToggler || slotToggler != SLOT) {
                    slotToggler = SLOT;
                    SLOT.style.zIndex = 1000;
                    SLOT.style.overflowY = 'visible';
                    gsap.set(SLOT.querySelector('.schedule-slot-info'), { y: 20 })
                    gsap.to(SLOT.querySelector('.schedule-slot-info'), { duration: .1, y: 0, display: 'block' })
               } else {
                    slotToggler = false;
                    SLOT.style.zIndex = 'unset';
                    SLOT.style.overflowY = 'hidden';
                    gsap.to(SLOT.querySelector('.schedule-slot-info'), { duration: .2, y: 20, display: 'none' })
               } */
          });

     }

}


//SPEAKER SLOTS
const SPEAKERSLOTS = document.querySelectorAll('.schedule-speaker')
LB_SPEAKER.CALL_SPEAKER_LIGHTBOX(SPEAKERSLOTS)

const PANELSPEAKERSLOTS = document.querySelectorAll('.schedule-slot-panel-speaker')
LB_SPEAKER.CALL_SPEAKER_LIGHTBOX(PANELSPEAKERSLOTS)

//SESSION SLOTS
const SESSIONSLOTS = document.querySelectorAll('.schedule-session')
LB_SESSION.CALL_SESSION_LIGHTBOX(SESSIONSLOTS)



