<?php

    // Retourne l'url de base au format controlleur/methode/argument
    function getUrl(){

        $url = array();
        $url['request_scheme'] = $_SERVER['REQUEST_SCHEME'];
        $url['http_host'] = $_SERVER['HTTP_HOST'];
        $url['request_uri'] = $_SERVER['REQUEST_URI'];
   
         // Détermination de l'url de base
         $urlArray = explode('/',$url['request_uri']);
   
         // détermination de la position de urlRef dans le tableau
         // Réduction du tableau $urlArray à partir de l'index $index
         
         $index = array_search(URLREF, $urlArray)+1;
        return (array_slice($urlArray,$index)); 

    }
        
