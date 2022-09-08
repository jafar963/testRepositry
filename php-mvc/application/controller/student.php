<?php
session_start();
class Student extends Controller
{
    public function index()
    {
        require_once 'application/views/_templates/header-student.php';
    }
}
