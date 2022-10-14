<?php

function updateGpsHelper($datas){

    foreach($datas as $commande){
        echo($commande['address'].'-'.$commande['zip'].'-'.$commande['town'].'-'.$commande['longitude'].'-'.$commande['latitude']).'<br>';
    }
}