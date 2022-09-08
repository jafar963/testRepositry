<?php
if (session_status() !== PHP_SESSION_ACTIVE)
    session_start();
class student_managment_incenter extends Controller
{
    public function index()
    {
        require_once 'application/views/_templates/admin_test_center_header.php';
        require_once 'application/views/student_managment_incenter/index.php';
    }
}
