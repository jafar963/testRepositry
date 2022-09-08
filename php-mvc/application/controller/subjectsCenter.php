<?php
session_start();
class SubjectsCenter extends Controller
{
    public function index()
    {
        require_once 'application/views/subjectsCenter/index.php';
        require_once 'application/views/_templates/header-student.php';
    }
    public function indexed($id)
    {
        $centerModel = $this->loadModel('Test_center_admin_managmentModel');
        $subjectInCenter = $centerModel->showSubjects($id);
        require_once 'application/views/_templates/header-student.php';
        require_once 'application/views/subjectsCenter/index.php';
    }
}
