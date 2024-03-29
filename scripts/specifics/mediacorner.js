

//navigation
const NAVCONTAINER = document.querySelector('.mediacorner-nav-container');
const MEDIACORNERPAGEID = NAVCONTAINER.getAttribute('pageid');
const NAVELEMENTS = document.querySelectorAll('.mediacorner-nav-element');

if (NAVCONTAINER.querySelectorAll('.active-nav').length === 0) {
     const queryString = window.location.search;
     const urlParams = new URLSearchParams(queryString);
     if (urlParams.has('m')) {
          const startpage = urlParams.get('m')
          const startnav = document.querySelector('[type="' + startpage + '"]')
          if (startnav) {
               startnav.classList.add('active-nav')
          }
     } else {
          NAVELEMENTS[0].classList.add('active-nav')
     }
}

if (NAVELEMENTS && NAVELEMENTS.length > 0) {
     for (let navEle of NAVELEMENTS) {

          navEle.addEventListener('click', () => {
               for (let index = 0; index < NAVELEMENTS.length; index++) {
                    NAVELEMENTS[index].classList.remove('active-nav');
               }
               navEle.classList.add('active-nav')
               var callData = {
                    id: MEDIACORNERPAGEID,
                    type: navEle.getAttribute('type'),
                    action: 'mediacorner'
               }
               AJAX.call_Ajax(callData, 'mediacorner-content', true);

               if (window.innerWidth < 1024) {
                    OPENMEDIACORNERMOBILEMENU()
               }
          })

     }
}


//QUICKNAV
function init_quicknav(){
     let QUICKNAV = document.querySelectorAll('.mediacorner-quicknav-element')

     QUICKNAV.forEach(navEle => {
          console.log('adfasf')
          navEle.addEventListener('click', ()=> {
               for (let index = 0; index < NAVELEMENTS.length; index++) {
                    let attrtype = NAVELEMENTS[index].getAttribute('type')
                    NAVELEMENTS[index].classList.remove('active-nav');
                    if( attrtype ==navEle.getAttribute('type') ) {
                         NAVELEMENTS[index].classList.add('active-nav')
                    }
               }
          
               var callData = {
                    id: MEDIACORNERPAGEID,
                    type: navEle.getAttribute('type'),
                    action: 'mediacorner'
               }
               AJAX.call_Ajax(callData, 'mediacorner-content', true);
          })
     })
}
init_quicknav()
jQuery(document).ajaxStop(function () {
     init_quicknav()
});

// PRESS REALESES

const DOWNLOADICON = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down-fill" viewBox="0 0 16 16"><path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zm-1 4v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V7.5a.5.5 0 0 1 1 0z"/></svg>'


function pressrealeses() {
     var FILECONTAINERS = document.querySelectorAll('.file-container')
     if (FILECONTAINERS && FILECONTAINERS.length > 0) {
          for (let FILECONTAINER of FILECONTAINERS) {

               var sortTL = gsap.timeline({ defaults: { duration: .5 } })
               if (FILECONTAINER.getAttribute('listener') !== 'true') {
                    FILECONTAINER.setAttribute("listener", "true");
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

          }
     }
}



function callGalleryFotos(PAGEID, FOLDER) {

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



}

function galleryMatrix() {

     var FOLDERS = document.getElementsByClassName('se2-galleries-folder')

     if (FOLDERS && FOLDERS.length > 0) {
          var PAGEID = document.querySelector('.se2-galleries-matrix').getAttribute('pageid')
          for (let FOLDER of FOLDERS) {
               if (FOLDER.getAttribute('listener') !== 'true') {
                    console.log(FOLDER.getAttribute('listener'))
                    FOLDER.setAttribute("listener", "true");
                    FOLDER.addEventListener('click', () => {

                         callGalleryFotos(PAGEID, FOLDER)
                    })
               }
          }

     }


}

var VIDEOFILTER = {
     tags: []
};

function callVideos(PAGEID, TAG) {
     VIDEOFILTER.tags = []

     var current;

     if (TAG.classList.contains('aktive-tag')) {
          console.log('active')
          TAG.classList.remove('aktive-tag')
          current = document.getElementsByClassName("aktive-tag");
     } else {
          TAG.classList.add('aktive-tag')
          current = document.getElementsByClassName("aktive-tag");
     }

     if (current.length > 0) {
          for (let index = 0; index < current.length; index++) {
               const currenttag = current[index];
               const currenttagID = currenttag.getAttribute('tagid');


               VIDEOFILTER.tags.push(currenttag.getAttribute('tagid'))

          }

     }


     console.log(VIDEOFILTER.tags)

     var callData = {
          pageid: PAGEID,
          filter: VIDEOFILTER.tags,
          action: 'videos'
     }
     AJAX.call_Ajax(callData, 'video-content-wrapper', true);



}


function videoMatrix() {

     var TAGS = document.getElementsByClassName('video-tag-label');

     if (TAGS && TAGS.length > 0) {
          countVideoPerTag(TAGS);
          var PAGEID = document.querySelector('.video-content-wrapper').getAttribute('pageid')
          for (let TAG of TAGS) {
               if (TAG.getAttribute('listener') !== 'true') {
                    console.log(TAG.getAttribute('listener'))
                    TAG.setAttribute("listener", "true");
                    TAG.addEventListener('click', () => {
                         console.log(TAG)
                         callVideos(PAGEID, TAG)
                    })
               }
          }

     }


}

function countVideoPerTag(TAGS) {
     var VideoContainer = document.querySelector('.video-content-wrapper');
     for (let TAG of TAGS) {
          var TAGID = TAG.getAttribute('tagid')
          var videoTags = VideoContainer.querySelectorAll('[tagid="' + TAGID + '"]');
          TAG.querySelector('.video-tag-label-count').innerHTML = videoTags.length;
     }
}

pressrealeses()
galleryMatrix()
videoMatrix()

jQuery(document).ajaxStop(function () {
     pressrealeses()
     galleryMatrix()
     videoMatrix()
})



//Download ZIP Images
var PHOTOS = [];

jQuery(document).ajaxComplete(function () {
     PHOTOS = [];
})


jQuery('.mediacorner-content').on('click', '#photo-select-download', function () {
     generateZIP()
})

gsap.set(jQuery('.se2-gallerie-photo-download'), { y: '100px', opacity: 0 })




jQuery('.mediacorner-content').on('click', '.se2-galleries-photo-add.photo-notadded', function () {
     var currThumb = jQuery(this).closest('.thumb');
     jQuery(this).removeClass('photo-notadded').addClass('photo-added')

     currThumb.removeClass('thumb').addClass('thumbChecked');
     currThumb.find('.se2-galleries-photo-thumbnail').addClass('se2-photo-actibe-thumb');
     currThumb.find('.se2-galleries-photo-selected').css('visibility', 'visible');
     PHOTOS.push(currThumb.attr('imageurl'));
     console.log(PHOTOS);

     if (PHOTOS.length != 0) {
          var photoCount = PHOTOS.length
          jQuery('.se2-gallerie-photo-download').css('visibility', 'visible');
          jQuery('.se2-gallerie-photo-download').find(".photo-download-notice").find('.photo-count').text(photoCount.toString());
          if (PHOTOS.length === 1) {
               gsap.fromTo(jQuery('.se2-gallerie-photo-download'), .2, { y: '100px', opacity: 0 }, { y: 0, opacity: 1 })
          }
     }

});



jQuery('.mediacorner-content').on('click', '.se2-galleries-photo-add.photo-added', function () {
     var currThumb = jQuery(this).closest('.thumbChecked');
     var itemtoRemove = currThumb.attr('src');
     jQuery(this).removeClass('photo-added').addClass('photo-notadded')
     currThumb.removeClass('thumbChecked').addClass('thumb');
     currThumb.find('.se2-galleries-photo-thumbnail').removeClass('se2-photo-actibe-thumb');
     currThumb.find('.se2-galleries-photo-selected').css('visibility', 'hidden');

     PHOTOS.splice(jQuery.inArray(itemtoRemove, PHOTOS), 1);
     console.log(PHOTOS);

     if (PHOTOS.length == 0) {

          jQuery('.se2-gallerie-photo-download').css('visibility', 'hidden');
          gsap.fromTo(jQuery('.se2-gallerie-photo-download'), .2, { y: 0, opacity: 1 }, { y: '100px', opacity: 0 })
     } else {
          var photoCount = PHOTOS.length
          jQuery('.se2-gallerie-photo-download').find(".photo-download-notice").find('.photo-count').text(photoCount.toString());
     }

});



function generateZIP() {
     console.log('TEST');
     var zip = new JSZip();
     var count = 0;
     var today = new Date();
     var dateforname = '-' + today.getFullYear() + (today.getMonth() + 1) + today.getDate() + today.getHours() + today.getMinutes();
     var zipFilename = 'Pictures' + dateforname + '.zip';

     PHOTOS.forEach(function (url, i) {
          var filename = PHOTOS[i];
          filename = filename.split('/').slice(-1).pop()
          filename = filename.replace(/[\/\*\|\:\<\>\?\"\\]/gi, '').replace("httpsi.imgur.com", "");
          // loading a file and add it in a zip file
          JSZipUtils.getBinaryContent(url, function (err, data) {
               if (err) {
                    throw err; // or handle the error
               }
               zip.file(filename, data, { binary: true });
               count++;
               if (count == PHOTOS.length) {
                    zip.generateAsync({ type: 'blob' }).then(function (content) {
                         saveAs(content, zipFilename);
                    });
               }
          });
     });
}


// FULLSCREEN LIGHTBOX

jQuery('.mediacorner-content').on('click', '.se2-galleries-photo-fullscreen', function () {
     var currThumb = jQuery(this).closest('.se2-galleries-photo-thumbnail');
     var currImage = currThumb.attr('imageurl');
     LIGHTBOX.openLightbox('IMG', currImage);
});

//MOBILE NAVIGATION
var menustate = false //false = closed
var MENUBAR = document.querySelector('.mediacorner-nav-mobile');
var MENU = document.querySelector('.mediacorner-nav')
var MENUBARCONTAINER = MENU.querySelector('.mediacorner-nav-container');

MEDIACORNERMOBILE();

window.addEventListener('resize', () => {
     MEDIACORNERMOBILE();
});



function MEDIACORNERMOBILE() {

     MENU = document.querySelector('.mediacorner-nav');
     MENUBAR = document.querySelector('.mediacorner-nav-mobile');
     if (window.innerWidth < 1024) {
          gsap.to(MENU, .2, { width: '50px' })
          gsap.to(MENUBARCONTAINER, .2, { display: 'none', opacity: 0 })
          MENUBAR.addEventListener('click', () => { OPENMEDIACORNERMOBILEMENU() })
          console.log('smaller')
     } else if (window.innerWidth >= 1024) {
          menustate = false
          MENUBAR.removeEventListener('click', () => { OPENMEDIACORNERMOBILEMENU() })
          gsap.to(MENU, .2, { width: '20vw' })
          gsap.to(MENUBARCONTAINER, .2, { display: 'block', opacity: 1 })
          console.log('bigger')
     }
}

function OPENMEDIACORNERMOBILEMENU() {

     if (menustate === false) {
          menustate = true;
          gsap.to(MENU, .2, { width: '80vw' })
          gsap.to(MENUBARCONTAINER, .2, { display: 'block', opacity: 1 })
     } else {
          menustate = false;
          gsap.to(MENU, .2, { width: '50px' })
          gsap.to(MENUBARCONTAINER, .2, { display: 'none', opacity: 0 })
     }
}