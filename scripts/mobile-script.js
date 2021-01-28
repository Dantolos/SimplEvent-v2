//BURGER MENU
const BURGERMENU = document.getElementById('burger-menu')

const MOBILEMENU = document.getElementById('mobile-menu-wrapper')
gsap.set(MOBILEMENU, { y: '-100vh'})

var BMcntA = 0;
var BMcntB = 0;



BURGERMENU.addEventListener('click', ()=>{
     BurgerMenuAnimation( BURGERMENU, BMcntA );
     BMcntA++
     if(BMcntA%2 != 0){
          gsap.to(MOBILEMENU, { y: '0'})
          BURGERMENU.querySelector('#se_burger_menu').classList.add('active-menu')
     } else {
          gsap.to(MOBILEMENU, { y: '-100vh'})
          BURGERMENU.querySelector('#se_burger_menu').classList.remove('active-menu')
     }
})
function BurgerMenuAnimation(e, count){
     var BMstroke = [];
     let BMcc = 2;

     let BMstrokeRev = BMstroke
     let BMcloser = e.querySelector('.se_BMstroke[lid="3"]');
     console.log(BMcloser)
     gsap.set(BMcloser, ({ y: '-10'}))

     while (BMcc >= 0) {
          BMstroke.push(e.querySelector('.se_BMstroke[lid="'+BMcc+'"]'));
          BMcc--;
     }
     if(count%2 == 0) {
          gsap.to(BMstroke, 0.6, {y:'20', ease:Power1.easeInOut});
          gsap.to(BMcloser, 0.8, { y: '0', ease:Power1.easeInOut});
     } else {
          gsap.to(BMcloser, 0.6, { y: '-10', ease:Power1.easeOut});
          gsap.to(BMstroke, 0.6, {y:'0', ease:Power1.easeInOut});
     }
}