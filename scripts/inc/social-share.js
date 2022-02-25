
function shareItem(metaInfos) {

     var SHAREBUTTON = document.querySelector('.share-button');
     var SHAREFALLBACK = document.querySelector('.share-fallback');



     if (!navigator.share) {
          console.log('WEB Share API not included and removed')
          SHAREBUTTON.style.display = 'none'
     }
     console.log()
     //change meta tags
     if (metaInfos) {
          var title = metaInfos.title
          var description = metaInfos.description
          var url = metaInfos.url

          document.querySelector('meta[property="og:title"]').content = metaInfos.title
          document.querySelector('meta[property="og:description"]').content = metaInfos.description
          document.querySelector('meta[property="og:url"]').content = metaInfos.url
          document.querySelector('meta[property="og:image"]').content = metaInfos.image

          document.querySelector('meta[property="twitter:title"]').content = metaInfos.title
          document.querySelector('meta[property="twitter:description"]').content = metaInfos.description
          document.querySelector('meta[property="twitter:image"]').content = metaInfos.image
          /* document.querySelector('meta[property="twitter:card"]').content = metaInfos.image */
          /* document.querySelector('meta[property="twitter:alt"]').content = metaInfos.title */

          console.log(document.querySelector('meta[property="og:title"]').content)

          SHAREBUTTON.addEventListener('click', () => {
               console.log('Sharing...')
               fetch(metaInfos.image)
                    .then(function (response) {
                         console.log(response)
                         return response.blob()
                    })
                    .then(function (blob) {

                         var file = new File([blob], "picture.jpg", { type: 'image/jpeg' });
                         var filesArray = [file];


                         if (navigator.canShare && navigator.canShare({ files: filesArray })) {

                              // Adding title afterwards as navigator.canShare just
                              // takes files as input

                              console.log(filesArray)
                              navigator.share({
                                   title: metaInfos.title,
                                   url: metaInfos.url,
                                   files: filesArray,
                                   text: metaInfos.description,

                              })
                                   .then(() => console.log('Share was successful.'))
                                   .catch((error) => console.log('Sharing failed', error));

                         } else {
                              if (navigator.share) {
                                   navigator
                                        .share({
                                             title: title,
                                             url: url,
                                             text: description,
                                             files: [file]
                                        })
                                        .then(() => {
                                             console.log('THanks for sharing!')
                                        })
                                        .catch(console.error);
                              } else {
                                   console.log('WEB Share API not included')
                              }
                         }

                    })
          })
     }

}