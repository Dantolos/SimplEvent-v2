//BURGER MENU
const BURGERMENU = document.getElementById('burger-menu')

const MOBILEMENU = document.getElementById('mobile-menu-wrapper')
gsap.set(MOBILEMENU, { y: '-100vh'})

let BMcntA = 0;
let BMcntB = 0;
function BurgerMenuAnimation(e, count){
     var BMstroke = [];
     let BMcc = 2;

     let BMstrokeRev = BMstroke.reverse()
     let BMcloser = e.querySelector('.se_BMstroke[LID="3"]');
     TweenMax.set(BMcloser, ({ y: '-10'}))

     while (BMcc >= 0) {
          BMstroke.push(e.querySelector('.se_BMstroke[LID="'+BMcc+'"]'));
          BMcc--;
     }
     if(count%2 == 0) {
          TweenMax.staggerTo(BMstroke.reverse(), 0.6, {y:'20', ease:Power1.easeInOut}, 0.1);
          TweenMax.to(BMcloser, 0.8, ({ y: '0', ease:Power1.easeInOut}));
     } else {
          TweenMax.to(BMcloser, 0.6, ({ y: '-10', ease:Power1.easeOut}));
          TweenMax.staggerTo(BMstroke.reverse(), 0.6, {y:'0', ease:Power1.easeInOut}, 0.1);
     }
}


BURGERMENU.addEventListener('click', ()=>{
     BurgerMenuAnimation( BURGERMENU, BMcntA )
     
     BMcntA++
     if(BMcntA%2 != 0){
          gsap.to(MOBILEMENU, { y: '0'})
          BURGERMENU.querySelector('#se_burger_menu').classList.add('active-menu')
     } else {
          gsap.to(MOBILEMENU, { y: '-100vh'})
          BURGERMENU.querySelector('#se_burger_menu').classList.remove('active-menu')
     }
})
