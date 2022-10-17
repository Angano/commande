<?php
class Api extends Controller{

    public function getSearchSocieteByNom($datas){
        if($_SERVER['REQUEST_METHOD']==='GET' && isset($_GET['nom'])){
            $model = $this->model('CommandeModel');
            $datas = $model->getSearchSocieteByNom($_GET['nom']);
            header("Content-Type: application/json");
            echo json_encode($datas);
            exit;
        }
      
    }
}