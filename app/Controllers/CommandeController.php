<?php
class Commande extends Controller{

    public function index($shorTable){

        // pour la recherche par entreprise on récolte la data du formulaire
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $shorTable['soc']=$_POST['soc'];
        }
        // Vérification du format reçu de $shorTable
        if(!is_array($shorTable)){
            $shorTable = array();
        }
        if(!isset($shorTable['limit']) || preg_match('/^[1-9][0-9]{0,}$/',$shorTable['limit'])===0){

          $shorTable['limit'] = 30 ;
        }
        if(!isset($shorTable['offset']) || preg_match('/^[1-9][0-9]{0,}$/',$shorTable['offset'])===0){

            $shorTable['offset'] = 0;
        }
        if(!isset($shorTable['soc']) || preg_match('/^[1-9][0-9]{0,}$/',$shorTable['soc'])===0){

            $shorTable['soc'] = null;
        }
    
        // fin de vérification

       
      

        $model = $this->model('CommandeModel');
        $commandes = $model->getCommandes($shorTable);
        $count = $model->countCommande($shorTable['soc']);

        $datas = array(
                    'commandes'=>$commandes,
                    'count'=>$count['count'],
                    'shorTable'=>$shorTable
                );

        // datas for search form
        if(isset($shorTable['soc']) && !is_null($shorTable['soc'])){
            
            // on récupère le nom l'adresse du client recherché par le formulaire
            $datas['dataForForm'] = [
                'rowid'=>$commandes[0]['fk_soc'],
                'nom'=> $commandes[0]['nom']
                
                ];
        }else{
            $datas['dataForForm'] = [
                'rowid'=>'',
                'nom'=> ''
                
                ];
        }


        
        $this->view('commande/commandes',$datas);

    }


    public function detail($id){
        $model = $this->model('CommandeModel');

        if($_SERVER['REQUEST_METHOD']==='POST'){
            $validCommandes = $_POST['valid_commande'];
            foreach($validCommandes as $key=>$value){
                
                $dataPost = array(
                    'fk_statut'=>$value,
                    'rowid'=>$key
                );
                $model->updateStatusCommande($dataPost);
            }
            
        }


        $commande = $model->commandeById($id);
        $commandesBySoc = $model->commandeBySoc($commande['fk_soc']);
        $commandes = $model->getCommandes();

        ///////////////////////////////////////////////////////////////
        $limite = 35;
        
        foreach($commandes as $key=>$data){
            if(isset($data['nameCity']) && !empty($data['nameCity'])){
                
                $distanceTest = intval(distance($commande['latitude'],$commande['longitude'],$data['latitude'], $data['longitude']));
                if($distanceTest>$limite || $data['fk_soc']===$commande['fk_soc']){
                    unset($commandes[$key]);
                }else{
                     $commandes[$key]['distance'] = intval(distance($commande['latitude'],$commande['longitude'],$data['latitude'], $data['longitude']));
                }
               
               
              
           
            }
           
        }
        foreach ($commandes as $key => $row)
        {
            if(isset($row['distance']) && !empty($row['distance'])){
                $wek[$key]  = $row['distance'];
            }else{
                $wek[$key] ='';
            }
            
        }    
        
        // Sort the data with wek ascending order, add $mar as the last parameter, to sort by the common key
        array_multisort($wek, SORT_ASC, $commandes);

        //////////////////////////////////////////////////////////////
        $datas = array(
            'commande'=>$commande,
            'commandesBySoc'=>$commandesBySoc,
            'commandes'=>$commandes,
            'limite'=>$limite
        );
        $this->view('commande/detail',$datas);
    }
    
    public function addTodo($id){
        // on récupère la commande sur laquelle on doit rajouter un todo
        $model = $this->model('CommandeModel');
        $commande = $model->commandeById($id);
        
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $datas = array(
                'todo'=>$_POST['todo'],
                'fk_command'=>$_POST['commande_id'],
                'fk_user'=>66,
                'created_at'=> date('Y-m-d H:i:s'),
                'todoId'=>$commande['todoId']
            );
          
            // si présence d'un todo, on fait une mise à jour sinon on créée
            if(isset($commande['todo'])){
                $model->updateTodo($datas);
            }else{
                $model->addTodo($datas);
            }
            $commande = $model->commandeById($id);
        }
        $this->view('commande/addTodo', $commande);
    }
}
