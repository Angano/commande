<?php
session_start();
if(!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])){
    header('Location:http://localhost/centrex/md/home');
  
}
require('../app/init.php');
$init = new Router();