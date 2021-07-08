
let COOKIES = new se2_Cookies();

//---------------------------------
//DARKMODE
//---------------------------------

let DARKMODE = (COOKIES.getCookie("mode") == 'false') ? false : true;
const MODEBUTTON = document.getElementById('modebutton');
const BODY = document.querySelector('body');
//neg image
const ImagesToNegate = document.getElementsByClassName('neg')

if (COOKIES.getCookie('mode') == '') {
     if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
          DARKMODE = true;
     } else {
          DARKMODE = false;
     }
}

const switchMode = () => {
     DARKMODE = !DARKMODE;
     setClassToBody();
     if (ImagesToNegate.length > 0) {
          negateImages(ImagesToNegate);
     }
}

const setClassToBody = () => {
     if (DARKMODE) {
          BODY.classList.remove('light');
          BODY.classList.add('dark');
          MODEBUTTON.innerHTML = 'LIGHT'
     } else {
          BODY.classList.add('light');
          BODY.classList.remove('dark');
          MODEBUTTON.innerHTML = 'DARK'
     }
     COOKIES.setCookie("mode", DARKMODE, 365);
}

MODEBUTTON.addEventListener('click', switchMode);
setClassToBody();



if (ImagesToNegate.length > 0) {
     negateImages(ImagesToNegate);
}

function negateImages(images) {
     for (let Image of images) {

          let imgElement = Image.querySelector('img');
          imgElement.srcset = ''

          let src = imgElement.getAttribute('src').split('/')

          let name = (DARKMODE) ? src.pop().replace(/\.|-neg\./g, '-neg.') : src.pop().replace('-neg', '')

          src[src.push(src.pop()) - 1]
          src.push(name)
          let newsrc = src.join('/');

          imgElement.src = newsrc
     }
}