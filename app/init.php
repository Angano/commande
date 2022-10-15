<?php 

session_start();

require_once('../app/config/config.php');
require_once('../app/librairies/Controller.php');
$Controller = new Controller();
require('../app/helpers/urlHelper.php');
require('../app/helpers/updateGpsHelper.php');
require('../app/helpers/calculDistance.php');
require('../app/librairies/Router.php');
require('../app/librairies/Database.php');



	