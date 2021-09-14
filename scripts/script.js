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

//---------------------------------
//HEADER
//---------------------------------

//MOBILE MODE BY **mBREAKPOINT** PIXELS
const mBREAKPOINT = 1024;
document.querySelector('body').classList.add('light');
var BURGERRMENU = '<div id="burger-menu"><svg version="1.1" id="se_burger_menu" x="0px" y="0px" viewBox="0 0 17.5 10.5" style="enable-background:new 0 0 17.5 10.5;" xml:space="preserve"><style media="screen">#se_burger_menu {stroke:#d9d9d9;} </style><g><line LID="0" class="se_BMstroke" x1="0" y1="1" x2="17.5" y2="1"/><line LID="1" class="se_BMstroke" x1="0" y1="5.2" x2="17.5" y2="5.2"/><line LID="2" class="se_BMstroke" x1="0" y1="9.5" x2="17.5" y2="9.5"/><line LID="3" class="se_BMstroke" x1="0" y1="5.2" x2="17.5" y2="5.2"/></g></svg></div>';
var mobileLoaded = false;
function LOADMOBILESCRIPTS() {
     if (window.innerWidth < mBREAKPOINT && !mobileLoaded) {
          jQuery('header').append(BURGERRMENU);
          jQuery('.menu-content').wrapAll('<div id="mobile-menu-wrapper" style="opacity:0;"/>');
          
          let myScript = document.createElement("script");
          myScript.setAttribute("src", globalURL.templateUrl + "/scripts/mobile-script.js");
          document.body.appendChild(myScript);

          mobileLoaded = true;
     }
     if (window.innerWidth > mBREAKPOINT && mobileLoaded) {
          jQuery('.menu-content').unwrap('#mobile-menu-wrapper');
          jQuery('#burger-menu').remove();
          var MOBILEMENU = document.getElementById('mobile-menu-wrapper')
          var StaggerItems = document.querySelectorAll('.menu-item, #extramenu')
          gsap.set(MOBILEMENU, { y: '0', scale: 1, opacity: 1 })
          gsap.set(StaggerItems, { y: '0', scale: 1, opacity: 1 })
          mobileLoaded = false;
          
     }

}
window.addEventListener('resize', () => {
     LOADMOBILESCRIPTS();
});
LOADMOBILESCRIPTS();

const LANGUEGEBUTTONCONTAINER = document.getElementById('languagebutton')
if (LANGUEGEBUTTONCONTAINER) {
     var LANGUEGEBUTTONS = document.getElementById('languagebutton').children
     for (let langbutton of LANGUEGEBUTTONS) {
          langbutton.querySelector('button').style.width = langbutton.querySelector('button').offsetHeight + 5 + 'px';
     }
}

var NAVLVL1 = document.querySelectorAll('.se2-lvl-1-item');
function OpenSubMenu(){
     for(let NAV of NAVLVL1){
          console.log('MENU')
          if(NAV.querySelector('.se2-sub-menu')){
               let SUB = NAV.querySelector('.se2-sub-menu');
               gsap.set(SUB, {opacity: 0, y: '-10px' })
               NAV.addEventListener('mouseover', () => {
                    SUB.style.visibility = 'visible';
                    gsap.to(SUB, .1, { opacity: 1, y: 0 })
               })
               NAV.addEventListener('mouseleave', () => {
                    gsap.to(SUB, .3, {opacity: 0, y: '-10px'})
                    SUB.style.visibility = 'hidden';
               })
          }

     }
}
if(window.innerWidth > mBREAKPOINT){
     window.addEventListener('resize', () => {
          OpenSubMenu();
     });
     OpenSubMenu();
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


