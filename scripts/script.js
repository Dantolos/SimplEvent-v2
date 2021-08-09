gsap.config({
     nullTargetWarn: false,
});

var DETECT = new Detect();

var LOADER = new se2_Loader();
var AJAX = new se2_Ajax();
var LIGHTBOX = new Lightbox();


//---------------------------------
//COOKIES
//---------------------------------
let COOKIE = new se2_Cookies();

//---------------------------------
//ANCHOR LINKS
//---------------------------------

let ANCHOR = new se2_Anchor();
ANCHOR.goTO();


//---------------------------------
//INFOLIGHTBOX
//---------------------------------
let LB_SPEAKER = new se2_LB_Speaker();
let LB_SESSION = new se2_LB_Session();
let LB_CANDIDATE = new se2_LB_Candidate();


//std light mode
document.querySelector('body').classList.add('light');


//---------------------------------
//HEADER
//---------------------------------

const LANGUEGEBUTTONCONTAINER = document.getElementById('languagebutton')
if (LANGUEGEBUTTONCONTAINER) {
     var LANGUEGEBUTTONS = document.getElementById('languagebutton').children
     for (let langbutton of LANGUEGEBUTTONS) {
          langbutton.querySelector('button').style.width = langbutton.querySelector('button').offsetHeight + 5 + 'px';
     }
}



//---------------------------------
//PEOPLE
//---------------------------------
const PEOPLES = document.getElementsByClassName('se2-people-box');

for (let PERSON of PEOPLES) {

     PERSON.addEventListener('mouseover', (e) => {

          gsap.to(PERSON.querySelector('.se2-people-portrait'), { duration: .1, y: '-10px', x: '10px', scale: 1.1 });
          gsap.to(PERSON.querySelector('.se2-people-content'), { duration: .1, y: '-10px', x: '-10px' });
     });
     PERSON.addEventListener('mouseleave', () => {
          gsap.to(PERSON.querySelector('.se2-people-portrait'), { duration: .1, y: 0, x: 0, scale: 1 });
          gsap.to(PERSON.querySelector('.se2-people-content'), { duration: .1, y: 0, x: 0 });
     });
}


//---------------------------------
//PARTNER
//---------------------------------

const PARTNERS = document.getElementsByClassName('partner-logo-box');

for (let PARTNER of PARTNERS) {
     PARTNER.addEventListener('mouseover', e => {
          gsap.to(PARTNER, { duration: .1, scale: 0.95, ease: Power1.easeOut });
          gsap.to(PARTNER.querySelector('img'), { duration: .1, scale: 1.1, ease: Power1.easeOut });
     })
     PARTNER.addEventListener('mouseleave', e => {
          gsap.to(PARTNER, { duration: .2, scale: 1, ease: Power1.easeOut });
          gsap.to(PARTNER.querySelector('img'), { duration: .2, scale: 1, ease: Power1.easeOut });
     })

     //lightbox
     PARTNER.addEventListener('click', e => {
          var callData = {
               pid: PARTNER.getAttribute('pid'),
               action: 'partner_infos'
          }
          LIGHTBOX.openLightbox('AX', callData);
     })
}

//---------------------------------
//POSTS
//---------------------------------

var POSTTHUMBS = document.querySelectorAll('[lb]')

for (let POST of POSTTHUMBS) {
     POST.addEventListener('click', async () => {
          call_post_lightbox(POST)
     })
}

jQuery(document).ajaxComplete(function () {

     POSTTHUMBS = document.querySelectorAll('[lb]')
     for (let POST of POSTTHUMBS) {
          POST.addEventListener('click', async () => {
               call_post_lightbox(POST)
          })
     }

});
 
function call_post_lightbox(POST) {
     POST.addEventListener('click', async () => {
          console.log(POST.getAttribute('postid'))
          var callData = {
               lbid: POST.getAttribute('postid'),
               action: POST.getAttribute('lb')
          }
          LIGHTBOX.openLightbox('AX', callData);

     })
}

const CATEGORIECONTAINER = document.getElementsByClassName('categorie-container');

if (CATEGORIECONTAINER.length > 0) {
     var CATEGORIES = CATEGORIECONTAINER[0].querySelectorAll('span');

     for (let CATEGORIE of CATEGORIES) {
          CATEGORIE.addEventListener('click', e => {
               console.log(CATEGORIECONTAINER[0].getAttribute('type'))
               var callData = {
                    year: CATEGORIE.getAttribute('year'),
                    type: CATEGORIECONTAINER[0].getAttribute('type'),
                    action: 'categorie'
               }
               AJAX.call_Ajax(callData, 'se-wall', true);

               CATEGORIES.forEach(el => el.classList.remove('active-year'))
               CATEGORIE.classList.add('active-year')
          })
     }
}


