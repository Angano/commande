window.addEventListener('load',function(){


    function sendData(element){
        var xhr = new XMLHttpRequest();
        var FD = new FormData(element);


        // controle de l'url utiliser; on cherche çà savoir si on active ou desactive le statut
        var action = window.location.pathname.split('/')[3];

        // on switch sur action pour déterminer quel users (activé ou désactiver) on va renvoyer au tableau sur la page html
        var actionForTabHtml = '';
        switch(action){
            case 'usersDesactived':
                actionForTabHtml = 'userDesactived';
                break;
            case 'users':
                actionForTabHtml = 'userActived';
                break;   
            default:
                actionForTabHtml = 'userActived';
        }

   
    
        xhr.open('POST',url+'ApiUpdateActifUser');
        xhr.responseType ='json';
       
        xhr.onreadystatechange = function(){
            if(xhr.status===200 && xhr.readyState===4){
                
                var datas ='';
                var user_job = xhr.response['user_job'];
                xhr.response[actionForTabHtml].forEach(function(value){
                        datas = datas + `
                    <div class=" col">
                        <div class="card ">
                            <div class="card-header">
                                <p class="card-text" style="color:#0d6efd; font-weight:bold">
                                    <b>`+value['lastname']+`</b> `+value['firstname']+`
                                </p>
                            </div>
                            <div class="card-body">
                                <p><b>`;
                                if(value['nom']!=null){
                                    datas= datas + value['nom'];
                                }
                                datas = datas +`</b></p>
                                <p><span style="border-bottom:solid 1px black;margin-right:1rem">Login :</span>`+value['login']+`</p>
                                <p><span style="border-bottom:solid 1px black;margin-right:2rem">Job :</span>`;
                                if(value['code']!=null){
                                    datas = datas + value['code'];
                                };
                                datas= datas + ` </p>
                            </div>


                            <div class="card-footer d-flex justify-content-between pb-0">
                                <p>
                                    <button title="SSOS">
                                    <a style="background-image:url('./assets/img/bouygue.png');background-repeat: no-repeat;
                                        background-size: contain; height: 28px; width: 48px;" 
                                        class="btn btn-sm " 
                                        target="_blank" 
                                        href="https://ucportal.hosted-pbx.bouyguestelecom.com/ssos/index.php">
                                    </a>
                                    </button>
                                </p>`;
                               
                            
                         if(value['statut']=='1' && user_job=='superadmin'){

                                datas = datas + `<p>
                                        <form action="`+ url + `ApiUpdateActifUser" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="rowid" value="` + value['rowid'] + `">
                                            <input type="hidden" name="statut" value="0">
                                            <button type="submit" title="Désactiver le compte"><i class="fa-solid fa-eye-slash"></i></button>
                                        </form></p>`;
                                }

                        if(value['statut']!='1' && user_job=='superadmin'){

                            datas = datas + `
                            <p><form action="`+ url + `ApiUpdateActifUser" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="rowid" value="` + value['rowid'] + `">
                            <input type="hidden" name="statut" value="1">
                            <button title="Activer l'utilisateur" type="submit"><i class="fa-solid fa-eye"></i></button>
                        </form></p>`;
                    
                        }

                        if(user_job=='superadmin' ){
                        datas = datas + `<p><button title="Editer l'utilisateur"><a href="editUser/`+ value['rowid']+`" target="_blank"><i class="fa fa-edit" style="font-size:22px; color:black"></i></a></button></p>`;              }
                    datas = datas + `
                    </div></div>
                    </div>`
                
                })


                $('#tbody').html(datas); 
                $('form').on('submit',function(e){
                    e.preventDefault();
                })
                test();
            }
        }
       
       
       
        xhr.send(FD);
    }

    function test(){
        var forms = document.querySelectorAll('form');
       forms.forEach(element=>{
        element.addEventListener('submit',function(e){
            e.preventDefault();
            sendData(element);
        })
       })
    }



 test()
    })

   
        



    



