
function shareItem(metaInfos) {

     //change meta tags
     document.querySelector('meta[property="og:title"]').content = metaInfos.title
     document.querySelector('meta[property="og:description"]').content = metaInfos.description
     document.querySelector('meta[property="og:url"]').content = metaInfos.url
     document.querySelector('meta[property="og:image"]').content = metaInfos.image

     document.querySelector('meta[property="twitter:title"]').content = metaInfos.title
     document.querySelector('meta[property="twitter:description"]').content = metaInfos.description
     document.querySelector('meta[property="twitter:image"]').content = metaInfos.image
     document.querySelector('meta[property="twitter:card"]').content = metaInfos.image
     document.querySelector('meta[property="twitter:alt"]').content = metaInfos.title

     console.log(document.querySelector('meta[property="og:title"]').content)
}