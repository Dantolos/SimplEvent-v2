
if( typeof api !== 'undefined' ){

     var apiURL = api.URL;
     var apiFunction = api.Function;
    
     seREST = new seREST();
     seREST.callRestAPI( apiURL, apiFunction );
}

