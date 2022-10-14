window.addEventListener('DOMContentLoaded',function(){

    getCurrentUser();
    
    // Gestion affichage des messages flash
    var messsages = this.document.getElementsByClassName('message');
    var offset = 0;
    for(let i=0; i<messsages.length; i++){

        setTimeout(function(){
            messsages[i].style.display = 'none';
            if(i==messsages.length-1){
                $('#toto').hide();
            }
        }, 3000+offset)
        offset += 500;
    }
  


    

})

// détermination de l'url de base

var url = window.location.pathname.split('/');
var index = url.indexOf('centrex')+1;
var pathname = '';

for(var i=1; i<=index; i++){
    pathname = pathname+url[i]+'/';
}

// construction de l'url complète
url = window.location.protocol+'//'+window.location.host+'/'+pathname;


function getCurrentUser(id){
    
    var xhr = new XMLHttpRequest();
    xhr.open('get', url+'ApiGetCurrentUser');

    xhr.responseType = 'json';

    xhr.onload = function(){
        
        $('#current-civility').html(this.response.civility);
        $('#current-lastname').html(this.response.lastname);
        $('#current-firstname').html(this.response.firstname);
        $('#current-login').html(this.response.login);
        $('#current-email').html(this.response.email);
        $('#current-address').html(this.response.address);
        $('#current-zip').html(this.response.zip);
        $('#current-town').html(this.response.town);
        $('#current-soc').html(this.response.nom);
        $('#current-job').html(this.response.job);
    }

    xhr.send();
}


