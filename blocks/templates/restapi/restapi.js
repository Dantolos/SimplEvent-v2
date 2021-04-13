
if( typeof api !== 'undefined' ){
     var apiURL = JSON.parse(api).URL;
     var apiFunction = JSON.parse(api).Function;
    
     seREST = new seREST();
     seREST.callRestAPI( apiURL, apiFunction );
}

