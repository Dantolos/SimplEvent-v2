class se2_Gallery{
    
    std_gallery( galery ){
       
        galery.innerHTML += '<div class="thumb-nav"></div>';
        galery.innerHTML += '<div class="arrow-nav"></div>';
        galery.innerHTML += '<div id="fullscreen" class="full-screen" active="0"><img src="'+globalURL.templateUrl+'/images/icons/fullscreen.svg" alt="fullscreen" title="fullscreen"/></div>';
        let IMAGES = galery.querySelectorAll('img')

             
        for (let index = 0; index < (IMAGES.length-1); index++) {
            let curr = (index == 0) ? 'thumb-dot-current' : '';
            
            
            galery.querySelector('.thumb-nav').innerHTML += '<div class="thumb-dot '+curr+'" image="'+index+'"></div>';

            if( index != 0 ){
                gsap.set(IMAGES[index], { scale: .8, opacity: 0})
            }
        }

        for( let DOT of galery.querySelectorAll('.thumb-dot') )
        {
            let DotWidth = 'width:' + ((100 / IMAGES.length) - ( 1 * IMAGES.length)) + '%;';
            DOT.setAttribute('style', DotWidth)
            DOT.addEventListener('click', ()=> {
                console.log('dot')
                let currIMG = galery.querySelector('.thumb-dot-current').getAttribute('image')
                let nextIMG = DOT.getAttribute('image')
               
                if( currIMG != nextIMG ){
                    changeImage( currIMG, nextIMG )
                }
            })
            
            
        }

        //navigation throught arrows
        if( IMAGES.length > 1 ){
            galery.querySelector('.arrow-nav').innerHTML += '<div id="gallery-arrow-left" class="gallery-arrow"></div>'
            galery.querySelector('.arrow-nav').innerHTML += '<div id="gallery-arrow-right" class="gallery-arrow"></div>'

            galery.querySelector('#gallery-arrow-left').addEventListener('click', ()=>{
                let currIMG = parseInt(galery.querySelector('.thumb-dot-current').getAttribute('image'))
                let nextIMG = ( (currIMG - 1) < 0 ) ? (IMAGES.length - 1) : currIMG - 1
                changeImage( currIMG, nextIMG )
                console.log('left')
            });
            galery.querySelector('#gallery-arrow-right').addEventListener('click', ()=>{
                let currIMG = parseInt(galery.querySelector('.thumb-dot-current').getAttribute('image'))
                let nextIMG = ( (currIMG + 1) == (IMAGES.length-1) ) ? 0 : currIMG + 1
                changeImage( currIMG, nextIMG )
                console.log('right')
            });
           
        }

        function changeImage( curr, next ) {
            galery.querySelectorAll('.thumb-dot')[curr].classList.remove('thumb-dot-current')
            galery.querySelectorAll('.thumb-dot')[next].classList.add('thumb-dot-current')
            gsap.to(IMAGES[curr], {duration: .2, scale: .8, opacity: 0})
            gsap.to(IMAGES[next], {duration: .2, scale: 1, opacity: 1})
        }

        //FULLSCREEN
        var fullscreenButton = galery.querySelector('#fullscreen')
        fullscreenButton.addEventListener('click', ()=>{
            var active = (fullscreenButton.getAttribute('active') == '0') ? false : true
            if( !active ){
                fullscreenButton.querySelector('img').src = globalURL.templateUrl+'/images/icons/fullscreen-exit.svg'
                fullscreenButton.setAttribute('active', '1') 
                galery.style.position = 'fixed'
                galery.style.width = '100vw'
                galery.style.height = '100vh'
                galery.style.top = '0'
                galery.style.left = '0'
                galery.style.zIndex = '10000'
            } else {
                fullscreenButton.querySelector('img').src = globalURL.templateUrl+'/images/icons/fullscreen.svg'
                fullscreenButton.setAttribute('active', '0')
                galery.style.position = 'relative'
                galery.style.width = '100%'
                galery.style.height = '30vh'
                galery.style.top = 'unset'
                galery.style.left = 'unset'
                galery.style.zIndex = 'unset'
            }
            
        })


    }


}
