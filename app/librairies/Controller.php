<?php
class Controller{

    public function model($model,$arg=[]){

        $file = '../app/Models/'.$model.'.php';
        // charge le model
        if(file_exists($file)){
            require($file);
            return new $model;
        }else{
            echo ' le modèle n\'existe pas';
        }
    }

    public function view($view, $datas=[]){
        
        $file = '../app/views/'.$view.'.php';
        $datas = $datas;
        // charge la vue
        if(file_exists($file)){
            require($file);
        }else{
            echo " la vue \"{$view}\" n\'existe pas";
            
        }
    }
}