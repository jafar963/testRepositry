<?php
if (session_status() !== PHP_SESSION_ACTIVE)
    session_start();
class student_centers extends Controller
{
    public function index()
    {
        $centerModel = $this->loadModel('Test_center_admin_managmentModel');
        $centers = $centerModel->showcenters();
        require_once 'application/views/_templates/header-student.php';
        require_once 'application/views/student_centers/index.php';
    }
    public function showSubjects($id)
    {
        if (isset($id)) {
            header("location: " . URL . "SubjectsCenter/indexed/" . $id);
        }
    }
}
