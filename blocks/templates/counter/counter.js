const COUNTERELEMENTS = document.getElementsByClassName("counter-number");

for( let COUNTER of COUNTERELEMENTS ){

     const VISIBILITY = new screenVisibility();
     let DURATION = COUNTER.getAttribute("duration");
     
     let NUMB = parseInt(COUNTER.innerHTML);
     let STARTNUMB = Math.ceil(NUMB / 4);
     let STEPS = Math.ceil( NUMB / (DURATION / 10) );
     COUNTER.innerHTML = 0;

     document.addEventListener('wheel', ()=>{
          if(VISIBILITY.visible(COUNTER)) {
               counter = setInterval( ()=> {
                    STARTNUMB = STARTNUMB + STEPS;
                    counting( COUNTER, NUMB, STARTNUMB );
               }, 10 );
          }
     })

     document.addEventListener('scroll', ()=>{
          if(VISIBILITY.visible(COUNTER)) {
               counter = setInterval( ()=> {
                    STARTNUMB = STARTNUMB + STEPS;
                    counting( COUNTER, NUMB, STARTNUMB );
               }, 10 );
          }
     })
   
}

 
function counting( ele, NUMB, STARTNUMB ) {
    if( STARTNUMB >= NUMB ){
        ele.innerHTML = NUMB;
        clearInterval(counter);   
    } else {   
        ele.innerHTML = STARTNUMB;
    }
    return STARTNUMB;
}
