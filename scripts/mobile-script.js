//BURGER MENU

var BURGERMENU = document.getElementById('burger-menu')
var MOBILEMENU = document.getElementById('mobile-menu-wrapper')
var StaggerItems = document.querySelectorAll('.menu-item, #extramenu')


DOMOBILEMENU()
gsap.set(MOBILEMENU, { y: '-100vh', scale:1.2, opacity: 0 })
gsap.set(StaggerItems, { y: '50vh', scale:1.2, opacity: 0 })


var BMcntA = 0;
var BMcntB = 0;

function DOMOBILEMENU() {
     BURGERMENU = document.getElementById('burger-menu')
     MOBILEMENU = document.getElementById('mobile-menu-wrapper')

     BURGERMENU.addEventListener('click', () => {

          BurgerMenuAnimation(BURGERMENU, BMcntA);
          BMcntA++
          if (BMcntA % 2 != 0) {
               
               gsap.to(MOBILEMENU, .3, { y: '0', scale:1, opacity: 1, ease: "Bounce.out" })
               gsap.to(
                    StaggerItems, .2, 
                    {stagger: .05, y: '0', scale:1, opacity: 1, } 
               )

               BURGERMENU.querySelector('#se_burger_menu').classList.add('active-menu')

          } else {
               gsap.to(
                    StaggerItems, .2, 
                    {stagger: .05, y: '50vh', scale:1.2, opacity: 0, } 
               )
               gsap.to(MOBILEMENU, { y: '-100vh', scale:1.2, opacity: 0, ease: Power1.easeOut })
               BURGERMENU.querySelector('#se_burger_menu').classList.remove('active-menu')

          }

     })
}
function BurgerMenuAnimation(e, count) {

     var BMstroke = [];
     let BMcc = 2;


     let BMstrokeRev = BMstroke
     let BMcloser = e.querySelector('.se_BMstroke[lid="3"]');

     console.log(BMcloser)

     gsap.set(BMcloser, ({ y: '-10' }))


     while (BMcc >= 0) {
          BMstroke.push(e.querySelector('.se_BMstroke[lid="' + BMcc + '"]'));
          BMcc--;
     }

     if (count % 2 == 0) {
          gsap.to(BMstroke, 0.6, { y: '20', ease: Power1.easeInOut });
          gsap.to(BMcloser, 0.6, { y: '0', ease: Power1.easeInOut });
     } else {
          gsap.to(BMcloser, 0.6, { y: '-10', ease: Power1.easeOut });
          gsap.to(BMstroke, 0.6, { y: '0', ease: Power1.easeInOut });
     }

}