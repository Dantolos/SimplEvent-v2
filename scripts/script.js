
/* bdedect = new Detect(); */

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
//DARKMODE
//---------------------------------

let DARKMODE = (COOKIE.getCookie("mode") == 'false') ? false : true;
const MODEBUTTON = document.getElementById('modebutton');
const BODY = document.querySelector('body');
//neg image
const ImagesToNegate = document.getElementsByClassName('neg')

if(COOKIE.getCookie('mode') == ''){
    if(window.matchMedia('(prefers-color-scheme: dark)').matches ) {
        DARKMODE = true;
    } else {
        DARKMODE = false;
    }
}

const switchMode = () => {
    DARKMODE = !DARKMODE;
    setClassToBody();
    if( ImagesToNegate.length > 0 ){
          negateImages( ImagesToNegate );
     }
}

const setClassToBody = () => {
    if(DARKMODE) {
        BODY.classList.remove('light');
        BODY.classList.add('dark');
        MODEBUTTON.innerHTML = 'LIGHT'
    } else {
        BODY.classList.add('light');
        BODY.classList.remove('dark');
        MODEBUTTON.innerHTML = 'DARK'
    }
    COOKIE.setCookie("mode", DARKMODE, 365);
}

MODEBUTTON.addEventListener('click', switchMode);
setClassToBody();



if( ImagesToNegate.length > 0 ){
     negateImages( ImagesToNegate );
}

function negateImages( images ){
     for(let Image of images ){
         
          let imgElement = Image.querySelector('img');
          imgElement.srcset = ''
          let src = imgElement.getAttribute('src').split('/')
         
          let name = (DARKMODE) ? src.pop().replace(/\.|-neg\./g, '-neg.') : src.pop().replace('-neg', '')
                 
          src[src.push(src.pop())-1]
          src.push(name)
          let newsrc = src.join('/');
          imgElement.src = newsrc
     }
}

//---------------------------------
//HEADER
//---------------------------------
const LANGUEGEBUTTONS = document.getElementById('languagebutton').children;

for(let langbutton of LANGUEGEBUTTONS){
    langbutton.querySelector('button').style.width = langbutton.querySelector('button').offsetHeight + 5 +'px';
}




//---------------------------------
//PEOPLE
//---------------------------------
const PEOPLES = document.getElementsByClassName('se2-people-box');

for(let PERSON of PEOPLES) {

    PERSON.addEventListener('mouseover', (e)=> {
 
        gsap.to(PERSON.querySelector('.se2-people-portrait'), {duration: .1, y: '-10px', x: '10px', scale: 1.1 });
        gsap.to(PERSON.querySelector('.se2-people-content'), {duration: .1, y: '-10px', x: '-10px' });
    });
    PERSON.addEventListener( 'mouseleave', () => {
        gsap.to(PERSON.querySelector('.se2-people-portrait'), {duration: .1, y: 0, x: 0, scale: 1});
        gsap.to(PERSON.querySelector('.se2-people-content'), {duration: .1, y: 0, x: 0});
    });
}


//---------------------------------
//PARTNER
//---------------------------------

const PARTNERS = document.getElementsByClassName('partner-logo-box');

for( let PARTNER of PARTNERS ){
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
            pid : PARTNER.getAttribute('pid'),
            action : 'partner_infos'
        }
        LIGHTBOX.openLightbox( 'AX', callData );
    })
    
}

//---------------------------------
//POSTS
//---------------------------------

var POSTTHUMBS = document.querySelectorAll('[lb]') 

console.log(POSTTHUMBS);


for( let POST of POSTTHUMBS ) {
    POST.addEventListener( 'click', async ()=> {
        console.log(POST.getAttribute('postid'))
        var callData = {
            lbid : POST.getAttribute('postid'),
            action : POST.getAttribute('lb')
        }
        LIGHTBOX.openLightbox( 'AX', callData );

    })
} 

jQuery(document).ajaxComplete( function($){
     
     POSTTHUMBS = document.querySelectorAll('[lb]') 

     console.log(POSTTHUMBS);

     for( let POST of POSTTHUMBS ) {
     POST.addEventListener( 'click', async ()=> {
          console.log(POST.getAttribute('postid'))
          var callData = {
               lbid : POST.getAttribute('postid'),
               action : POST.getAttribute('lb')
          }
          LIGHTBOX.openLightbox( 'AX', callData );

     })
     } 

});

const CATEGORIECONTAINER = document.getElementsByClassName('categorie-container');

if( CATEGORIECONTAINER.length > 0){
     var CATEGORIES = CATEGORIECONTAINER[0].querySelectorAll('span');
     
     for( let CATEGORIE of CATEGORIES ){
          CATEGORIE.addEventListener('click', e => {
               console.log(CATEGORIECONTAINER[0].getAttribute('type'))
               var callData = {
                    year : CATEGORIE.getAttribute('year'),
                    type: CATEGORIECONTAINER[0].getAttribute('type'),
                    action : 'categorie'
               }
               AJAX.call_Ajax( callData, 'se-wall', true );

               CATEGORIES.forEach(el => el.classList.remove('active-year'))
               CATEGORIE.classList.add('active-year')
          })
     }
}
