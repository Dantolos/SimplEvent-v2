var LIGHTBOX = new Lightbox();

window.onload = function () {
     const APP_BUTTONS = document.querySelectorAll('.app-promo-button')

     if (APP_BUTTONS && APP_BUTTONS.length > 0) {
          for (let APP_BUTTON of APP_BUTTONS) {

               APP_BUTTON.addEventListener('click', () => {
                    getData(APP_BUTTON.dataset.resturl).then((e) => {
                         console.log(JSON.parse(e))
                         var callData = {

                              restdata: e,
                              action: 'app_promotion'
                         }
                         LIGHTBOX.openLightbox('AX', callData);
                    })

               })
          }

     }

     async function getData(restURL) {
          return new Promise(function (resolve) {
               let req = new XMLHttpRequest();
               req.open('GET', restURL);
               req.onload = function () {
                    if (req.status == 200) {
                         resolve(req.response);
                    } else {
                         resolve("File not Found");
                    }
               };
               req.send();
          });

     }
}