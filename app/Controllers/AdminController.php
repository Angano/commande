<?php
class Admin extends Controller{

    public function index(){

        $model = $this->model('AdminModel');

    
        if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['profil'])){

            // On passe à 0 le champ actif de tous les profils authorisé
               $model->resetAuthorizedToManagedDeliveries();

            // On traite les données
            foreach($_POST['profil'] as $profil){
                $profilAuthorized = $model->getProfilAuthorizedToManagedDeliveries($profil);
                if($profilAuthorized===false){
                   
                  $model->addProfilAuthorizedToManagedDeliveries($profil);
                }else{
                    $model->updateProfilAuthorizedToManagedDeliveries($profil);
                }
            }
        }

        
        $profils =$model->getProfilsAuthorizedToManagedDeliveries();
        $datas = [
            'profils'=>$profils
        ];

        $this->view('admin/profils',$datas);
        
    }
}