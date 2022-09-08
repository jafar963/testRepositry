
<?php
if (session_status() !== PHP_SESSION_ACTIVE)
    session_start();
class presented_exam extends Controller
{
    public function index()
    {
        require_once 'application/views/_templates/header-student.php';
        require_once 'application/views/presented_exam/index.php';
    }
}
