
class se2_Loader {
     
     cast_Loader( container ){

          this.loader = document.createElement('DIV');
          this.loader.classList.add('se-loader');
          this.loader.innerHTML = '<div class="se-loader-icon">'+globalURL.icon+'</div>';
          this.loader.innerHTML += '<div id="se-loader-ball-1"></div>';
          this.loader.innerHTML += '<div id="se-loader-ball-2"></div>';
          this.loader.innerHTML += '<div id="se-small-ball-1"></div>';
          this.loader.innerHTML += '<div id="se-small-ball-2"></div>';
          container.appendChild(this.loader);
          
          var loaderAnimation = gsap.timeline({ repeat: -1 });

          gsap.to(document.getElementById('se-small-ball-1'), 3, {rotation: '+=720', repeat: -1, transformOrigin: '150% 300%'});
          gsap.to(document.getElementById('se-small-ball-2'), 3, {rotation: '+=720', repeat: -1, transformOrigin: '-150% -300%'});
     
          loaderAnimation.fromTo(document.getElementById('se-loader-ball-1'), 1, { scale: .2, opacity: -1 }, { scale: 1.5, opacity: 1 })
          .fromTo(document.getElementById('se-loader-ball-1'), 1, { scale: 1.5, opacity: 1 }, { scale: .2, opacity: -1 } )
          .fromTo(document.getElementById('se-loader-ball-2'), 1, { scale: .2, opacity: -1 }, { scale: 1.5, opacity: 1 }, ">-.5")
          .fromTo(document.getElementById('se-loader-ball-2'), 1, { scale: 1.5, opacity: 1 }, { scale: .2, opacity: -1 }, ">-.5")
          
          loaderAnimation.play()

     }


}