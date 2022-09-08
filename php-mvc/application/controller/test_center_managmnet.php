<?php
if (session_status() !== PHP_SESSION_ACTIVE)
    session_start();
class test_center_managmant extends Controller
{
    public function index()
    {
        require_once 'application/views/_templates/header-admin.php';
        require_once 'application/views/test_center_managment/index.php';
    }
}
