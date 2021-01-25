const REFERENCES = document.getElementsByClassName('se-reference')

let loopCount = 0;

if(REFERENCES.length > 0 ){
     setInterval(()=>{
          let index = 0;
          for( var REFERENCE of REFERENCES){
               REFERENCE.style.display = 'none'
          }
          while( index < 5 ){  
               outputIndex = loopCount + index
               if( outputIndex >= REFERENCES.length ){
                    outputIndex = Math.ceil( outputIndex%(REFERENCES.length) )
                    if(outputIndex < 0 ){
                         outputIndex = REFERENCES.length
                    }
               }
               REFERENCES[outputIndex].style.display = 'block'
               REFERENCES[outputIndex].style.order = outputIndex
               index++;
          }
          loopCount++;
     }, 2000)
}

