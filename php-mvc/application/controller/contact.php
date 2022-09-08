<?php
class Contact extends Controller
{
    public function index()
    {
        require_once 'application/views/_templates/header.php';
        require_once 'application/views/contact/index.php';
        require_once 'application/views/_templates/footer.php';
    }
}
