<?php
class GpsSoc extends Controller{

    public function getSocietes(){
        $model = $this->model('GpsSocModel');
        $societes = $model->getSocietes();

        //////////////////////////////////////////////////////////////////////////////////////////////////////


        foreach($societes as $societe){
    
            $cp = $societe['zip'];
            $town = urlencode($societe['town']);
            // $town= str_replace("-","%2D",$town);
            // $town= str_replace("é","&eacute;",$town);
            // $town= str_replace("â","sfdssdf;",$town);
            // $town= str_replace("ç","&#199;",$town);
       
           
      
            if($societe['id']!==null && isset($town) && !empty($town)){
                $url = 'https://api-adresse.data.gouv.fr/search/?q='.$town.'&type=municipality&limit=1';
          
               $url= str_replace(" ","%20",$url);
               //$url= str_replace("-","%2D",$url);
               
                //$url = 'https://api-adresse.data.gouv.fr/search/?q=chabanais&type=municipality&postcode=16150&limit=1';
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_HEADER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);   
                curl_setopt($ch, CURLOPT_TIMEOUT, 5);         
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($ch, CURLOPT_MAXREDIRS, 2);
                //curl_setopt($ch, CURLOPT_NOBODY, true);
            
                $dat= curl_exec($ch);
                
                if($dat!=='null'){
                
                    $geometries = json_decode($dat,true)['features'][0]['geometry']['coordinates'];
                    $proprieties = json_decode($dat,true)['features'][0]['properties'];
                    
                    $geometrie = array(
                        'longitude'=>$geometries[0],
                        'latitude'=>$geometries[1]
                    );
                    
                    $propriete = array(
                        'city'=>$proprieties['city'],
                        'postCode'=>$proprieties['postcode'],
                        'cityCode'=>$proprieties['citycode']
                        
                    );
                    $myTab = array(
                        'longitude'=>$geometries[0],
                        'latitude'=>$geometries[1],
                        'city'=>$proprieties['city'],
                        'postCode'=>$proprieties['postcode'],
                        'cityCode'=>$proprieties['citycode'],
                        'fk_soc'=>$societe['rowid']

                    );
                    $model->addGpsSoc($myTab);


                }
                curl_close($ch);
                
            
            }
            

        }











      



      ///////////////////////////////////////////////////////////////////////////////////////////////////////////






        $this->view('gpsSociete/societe', [$societes,$propriete]);
    }
}