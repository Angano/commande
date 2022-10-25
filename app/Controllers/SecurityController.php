<?php
class Security extends Controller{

    public function logout(){
        session_destroy();
        session_unset();

        header('Location:'.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/centrex/home/login');
        die;
    }
}