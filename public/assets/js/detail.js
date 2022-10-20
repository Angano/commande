window.addEventListener('DOMContentLoaded', function(){
    document.getElementById('showCommandes').addEventListener('click',function(){

        $('#display_commandes').toggle("slow");
    })
    document.getElementById('showOhersCommandes').addEventListener('click',function(){

        $('#display_other_commandes').toggle("slow");
    })
    
})