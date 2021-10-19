
class seREST
{
    callREST( restAPIURL, Type='none' )
    {
        var ourRequest = new XMLHttpRequest();
        ourRequest.open('GET', restAPIURL);
        ourRequest.onload = function() {
            if ( ourRequest.status >= 200 && ourRequest.status < 400 ) 
            {
                var data = JSON.parse( ourRequest.responseText );
                switch (Type) {
                    case 'team':
                        doTeam(data);
                        break;
                    case 'privacy':
                        doPrivacy( data );
                        break;
                    case 'lightbox':
                        doLightbox( data );
                        break;
                    default:
                        return data;
                        break;
                }
            } else 
            {
                console.log("We connected to the server, but it returned an error.");
            }
        };

        ourRequest.onerror = function() {
            console.log("Connection error");
        };

        ourRequest.send();

        function doTeam(data)
        {
            console.log( data );
            console.log(globalURL.lang)
        }

        function doPrivacy(data)
        {
            var title, text, output; 
            
            if(globalURL.lang){
                switch (globalURL.lang) {
                    case 'de':
                        title = data.acf.ds_title_de;
                        text = data.acf.ds_text_de;
                        break;
                    case 'en':
                        title = data.acf.ds_title_en;
                        text = data.acf.ds_text_en;
                        break;
                    case 'fr':
                        title = data.acf.ds_title_fr;
                        text = data.acf.ds_text_fr;
                        break;
                    default:
                        title = data.acf.ds_title_de;
                        text = data.acf.ds_text_de;
                        break;
                } 
            }

            output = '<div class="se-col-2"></div>';
            output += '<div class="se-col-10">';
            output += '<h1 style="margin-bottom:20px;">' + title + '</h1>';
            output += text;
            output += '</div>';
            jQuery('#api_target').append( output )
            
        }

        function doLightbox( data ){
            console.log(data)
            var title, text, output; 

            if(globalURL.lang){
                switch (globalURL.lang) {
                    case 'de':
                        title = data[0].acf.de.title;
                        text = data[0].acf.de.text;
                        break;
                    case 'en':
                        title = data[0].acf.en.title;
                        text = data[0].acf.en.text;
                        break;
                    case 'fr':
                        title = data[0].acf.fr.ds_title_fr;
                        text = data[0].acf.fr.ds_text_fr;
                        break;
                    default:
                        title = data[0].acf.en.ds_title_de;
                        text = data[0].acf.en.ds_text_de;
                        break;
                } 
            }

            output = '<div class="api-lightbox">';
            output += '<h1 style="margin-bottom:20px;">' + title + '</h1>';
            output += text;
            output += '</div>';
            jQuery('.se-lightbox-container').append( output )
        }
        
    }
    
    
    

}
