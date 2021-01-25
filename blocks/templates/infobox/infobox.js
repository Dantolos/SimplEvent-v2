const INFOBOXES = document.getElementsByClassName('infobox');

for ( const INFOBOX of INFOBOXES )
{
    INFOBOX.style.height = INFOBOX.offsetWidth + 'px';
    INFOBOX.style.zIndex = "-1"; 
    let INFOBOX_TL = new TimelineMax({ paused: true, defaults: {duration: .1, ease: Power1.easeOut }});
    let INFOBOX_FRONT = INFOBOX.querySelector('.infobox-front');
    let INFOBOX_BACK = INFOBOX.querySelector('.infobox-back');

    INFOBOX_TL.to(INFOBOX_BACK, { opacity: 1, y: '-100%' })
        .to(INFOBOX_FRONT, { y: '-25%', scale:.8 }, 0)
        .to(INFOBOX, { scale: 1.2 }, 0);

    INFOBOX.addEventListener('mouseover', ()=> {
       
        INFOBOX_BACK.style.display = 'block';
        INFOBOX.style.zIndex = "1000"; 
        INFOBOX_TL.play();
        
    });
    INFOBOX.addEventListener( 'mouseleave', () => {
        INFOBOX_TL.reverse();
        INFOBOX.style.zIndex = "0"; 
        
    });
}