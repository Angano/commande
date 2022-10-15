<?php 


// racine de l'appli


define('APPROOT',dirname(dirname(__FILE__)));

// Racine des urls



define('URLROOT',$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/commande');
define('URLREF','commande');




// base de données

define('DB_HOST','angano.fr:53360');
define('DB_PORT','53360');
define('DB_NAME','centrex');
define('DB_USER','es');
define('DB_PASSWORD','es');
