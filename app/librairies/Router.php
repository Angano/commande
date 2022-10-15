<?php


class Router{

   private $url ;

    public function __construct(){
   
        $this->url = getUrl();
       
        // on determine la classe à charger
        if(isset($this->url[0])){
            $controller = ucfirst($this->url[0]);
            $file_class = '../app/Controllers/'.$controller.'Controller.php';
            if(file_exists($file_class)){
                
                require $file_class;
                $this->controller = new $controller();
                
            }else{
               
                echo ' la classe '.ucfirst($this->url[0]).' n\'existe pas';
                header('Location:'.URLROOT.'/commande');

           
             
            }
        }
        else{
            die('oop');
        }
        

        // on détermine la méthode à utiliser
        if(isset($this->url[1])){
            if(method_exists($this->controller, $this->url[1])){
                $this->methode = $this->url[1];
            }else{
                $this->methode = 'index';
            }
            
           
        }else{
            $this->methode = 'index';
        }


        // on exploite l'argument si il est présent

        if(isset($this->url[2])){

            // on recherche dans l'url un composante ?key=value&key2=value2
            if(preg_match('/^\?/',$this->url[2])){
                $toto= explode('&',preg_replace('/\?/','',$this->url[2]));
                $options = [];
                foreach($toto as $key=>$value){
                    $tab = explode('=',$value);
                    $options[$tab[0]] = $tab[1];
                }

            // on revoie un tableau
              $this->argument = $options;
            }else{
                $this->argument = $this->url[2];
            }
            
            
        }else{
          
            $this->argument = null;
        }
        
        return $this->controller->{$this->methode}($this->argument);


    }

    public function model($model){

        $file = '../app/models/'.$model.'.php';
        // charge le model
        if(file_exists($file)){
            require($file);
            return new $model;
        }else{
            echo ' le modèle n\'existe pas';
        }
    }

    public function view($view, $data=[]){
        
        $file = '../app/views/'.$view.'.php';
        
        // charge la vue
        if(file_exists($file)){
            require($file);
        }else{
            echo ' la vue n\'existe pas';
        }
    }

}