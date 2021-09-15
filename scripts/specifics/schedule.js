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
               jQuery(window).scrollTop(0)
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


if (document.getElementsByClassName('schedule-slot-kalender')) {
     var KalenderSLOTS = document.getElementsByClassName('schedule-slot-kalender');
}

nSLOTScalender = Array.prototype.slice.call(KalenderSLOTS);

nSLOTScalender.sort(function (a, b) {
     return a.getAttribute('start').localeCompare(b.getAttribute('start'));
});


for (var i = 0, len = nSLOTScalender.length; i < len; i++) {
     var parent = nSLOTScalender[i].parentNode;
     var detatchedItem = parent.removeChild(nSLOTScalender[i]);
     parent.appendChild(detatchedItem);
}

console.log(nSLOTScalender)


var GRID = document.getElementsByClassName('schedule-5min');
if (document.querySelector('.schedule-grid')) {
     var pageoffset = document.querySelector('.schedule-grid').getBoundingClientRect().top;
}
var firstSlotPosition = 2400;

function SET_SLOT_POSITION() {
     for (let i = 0; i < nSLOTScalender.length; i++) {
          let start = nSLOTScalender[i].getAttribute('start');
          let duration = nSLOTScalender[i].getAttribute('dur');
          let minSections = document.querySelector('[timestamp="' + start + '"]')

          if (minSections === null) {
               nSLOTS[i].style.display = 'none'
               console.warn('Slot hidden: Time is not defined', nSLOTS[i])
               continue;
          }


          if (window.innerWidth > 1024) {
               //DESKTOP CALENDAR
               nSLOTScalender[i].style.position = 'absolute';
               nSLOTScalender[i].style.top = (minSections.getBoundingClientRect().top - pageoffset) + 'px';
               if ((minSections.getBoundingClientRect().top - pageoffset) < firstSlotPosition) {
                    firstSlotPosition = (minSections.getBoundingClientRect().top - pageoffset);
               }
               //nSLOTScalender[i].style.left = '20%';
               nSLOTScalender[i].style.height = (duration / 5) * minSections.offsetHeight + 'px';
               jQuery(window).scrollTop(firstSlotPosition - 50)
          } else {
               //TABLE
               nSLOTScalender[i].style.position = 'relative';
               nSLOTScalender[i].style.top = 'unset';
               nSLOTScalender[i].style.height = 'fit-content';
          }

     }

     // Scroll timeline to first slot

}

window.addEventListener('resize', () => {
     SET_SLOT_POSITION()

     SPLIT_WIDTH()


     console.log('resising')
})
SET_SLOT_POSITION()


var prevWidth = false;

function SPLIT_WIDTH() {

     for (let n = 0; n < nSLOTScalender.length; n++) {
          if (window.innerWidth > 1024) {
               let start = nSLOTScalender[n].getAttribute('start');
               let end = nSLOTScalender[n].getAttribute('ende');
               let date = nSLOTScalender[n].getAttribute('date');

               if (n > 0) {
                    let m = n - 1;
                    let prevend = nSLOTScalender[m].getAttribute('ende')

                    //for (let m = 0; m < nSLOTS.length; m++) {
                    if (date == nSLOTScalender[m].getAttribute('date')) {
                         if ((start + 1) <= prevend) {
                              prevWidth = (prevWidth) ? false : true;
                              nSLOTScalender[n].style.width = '47.5%'
                              nSLOTScalender[m].style.width = '47.5%'

                              if (prevWidth) {
                                   nSLOTScalender[n].style.marginLeft = '50%'
                              }
                         } else { prevWidth = false }
                    }
               }
          } else {
               nSLOTScalender[n].style.width = '100%'
               nSLOTScalender[n].style.marginLeft = '0'
          }
     }

}

console.log('DEVICE: ', DETECT.detectMobile())
var slotToggler = false;
if (KalenderSLOTS) {
     for (let SLOT of KalenderSLOTS) {

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
}


// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
// >>>>>>>>>>>>>>>>>>>>>>>>  LIST  <<<<<<<<<<<<<<<<<<<<<<<<<<
// <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< 
var ListSLOTS;
if (document.getElementsByClassName('schedule-slot-liste')) {
     ListSLOTS = document.getElementsByClassName('schedule-slot-liste');
}

// SORT LIST
nSLOTSlist = Array.prototype.slice.call(ListSLOTS);

nSLOTSlist.sort(function (a, b) {
     return a.getAttribute('start').localeCompare(b.getAttribute('start'));
});

for (var i = 0, len = nSLOTSlist.length; i < len; i++) {
     var parent = nSLOTSlist[i].parentNode;
     var detatchedItem = parent.removeChild(nSLOTSlist[i]);
     parent.appendChild(detatchedItem);
     console.log('done')
}


for (let SLOT of ListSLOTS) {
     SLOT.addEventListener('mouseover', (e) => {
          SLOT.querySelector('.schedule-container').classList.add("slot-shadow")

     });

     SLOT.addEventListener('mouseleave', () => {
          SLOT.querySelector('.schedule-container').classList.remove("slot-shadow")

     });
}




// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
// >>>>>>>>>>>>>>>>>>>>>>>>  GENR  <<<<<<<<<<<<<<<<<<<<<<<<<<
// <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<

//SPEAKER SLOTS
const SPEAKERSLOTS = document.querySelectorAll('.schedule-speaker')
LB_SPEAKER.CALL_SPEAKER_LIGHTBOX(SPEAKERSLOTS)

const PANELSPEAKERSLOTS = document.querySelectorAll('.schedule-slot-panel-speaker')
LB_SPEAKER.CALL_SPEAKER_LIGHTBOX(PANELSPEAKERSLOTS)

//SESSION SLOTS
const SESSIONSLOTS = document.querySelectorAll('.schedule-session')
LB_SESSION.CALL_SESSION_LIGHTBOX(SESSIONSLOTS)



