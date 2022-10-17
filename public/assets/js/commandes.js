window.addEventListener('DOMContentLoaded',function(){

    document.getElementById('search').addEventListener('keyup',function(){
        
        if(this.value.length>3){

            var xhr = new XMLHttpRequest();
            xhr.open('get',window.location.origin+'/commande/api/getSearchSocieteByNom/?nom='+ this.value);
            xhr.responseType = 'json';
            xhr.onload = function(){
                var data = '<ul style="list-style:none; text-align:left" >';
                var datas = this.response;
                
                datas.forEach(function(element){
               
                    data = data +'<li class="soc-list" data-nom="'+element.nom+'" data-soc="'+element.rowid+'">'+element.nom+'_'+element.zip+'_'+element.town+'</li>';
                })
                data = data + '</ul>';
                $('#toto').html(data);
                $('#toto').css('background-color','white');
                var lis = document.getElementsByClassName('soc-list');
                for([key,value] of Object.entries(lis)){
                    value.addEventListener('click',function(){
                         $('#search').prop('value',$(value).data('nom'))
                         $('#toto').html('').css('background-color','transparent')
                         $('#societe').prop('value',$(value).data('soc'))
                         console.log($(value))
                         
                    })
                }

            }
            xhr.send();
        }else{
           
            $('#toto').html('').css('background-color','transparent')
            $('#societe').prop('value','')
        }
    })
})