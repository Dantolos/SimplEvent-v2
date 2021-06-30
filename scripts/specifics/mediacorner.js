const DOWNLOADICON = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down-fill" viewBox="0 0 16 16"><path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zm-1 4v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V7.5a.5.5 0 0 1 1 0z"/></svg>'

var FILECONTAINERS = document.querySelectorAll('.file-container')
for (let FILECONTAINER of FILECONTAINERS) {

     var sortTL = gsap.timeline({ defaults: { duration: .5 } })

     FILECONTAINER.addEventListener('mouseover', e => {
          gsap.to(FILECONTAINER.querySelector('.fileicon'), { morphSVG: ".download", duration: .2, delay: .1 });
          let hideElements = FILECONTAINER.querySelectorAll('.fileicon-hide');
          for (var i = 0; i < hideElements.length; i++) {
               gsap.to(hideElements, { transformOrigin: '50% 50%', scale: 0, duration: .2 });
          }
          setTimeout(() => {
               gsap.to(FILECONTAINER.querySelector('.fileicon'), { morphSVG: FILECONTAINER.querySelector('.fileicon'), duration: .2 });
               let hideElements = FILECONTAINER.querySelectorAll('.fileicon-hide');
               for (var i = 0; i < hideElements.length; i++) {
                    gsap.to(hideElements, { scale: 1, duration: .1, delay: .1 });
               }
          }, 3000)
     })
     FILECONTAINER.addEventListener('mouseleave', e => {
          gsap.to(FILECONTAINER.querySelector('.fileicon'), { morphSVG: FILECONTAINER.querySelector('.fileicon'), duration: .3 });
          let hideElements = FILECONTAINER.querySelectorAll('.fileicon-hide');
          for (var i = 0; i < hideElements.length; i++) {
               gsap.to(hideElements, { scale: 1, duration: .3, delay: .1 });
          }
     })

}

const FOLDERS = document.getElementsByClassName('se2-galleries-folder')

if (FOLDERS && FOLDERS.length > 0) {
     const PAGEID = document.querySelector('.se2-galleries-matrix').getAttribute('pageid')
     for (let FOLDER of FOLDERS) {
          FOLDER.addEventListener('click', () => {
               var current = document.getElementsByClassName("aktive-folder");
               if (current.length > 0) {
                    current[0].className = current[0].className.replace(" aktive-folder", "");
               }
               FOLDER.className += " aktive-folder";

               var callData = {
                    pageid: PAGEID,
                    folder: FOLDER.getAttribute('folder'),
                    action: 'photo_folder'
               }
               AJAX.call_Ajax(callData, 'se2-galleries-content', true);
          })
     }
}