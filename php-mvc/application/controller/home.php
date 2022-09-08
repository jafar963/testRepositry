<?php
session_start();

class Home extends Controller
{
    
    public function index()
    {
        require_once 'application/views/home/index.php';
    }
    public function logout(){
        unset($_SESSION);
        session_destroy();
         header ("location: " . URL . "login/index.php/" );
    }
    public function homePage()
    {
        require_once 'application/views/_templates/header.php';
        require_once 'application/views/home/home-page.php';
        require_once 'application/views/_templates/footer.php';
    }
}
