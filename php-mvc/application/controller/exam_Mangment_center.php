<?php
class exam_Mangment_center extends Controller
{
    public function index()
    {
        $subjectModel = $this->loadModel('subjectModel');
        $subjects = $subjectModel->showmaterial();
        require_once 'application/views/_templates/admin_test_center_header.php';
        require_once 'application/views/exam_Mangment_center/index.php';
    }
    public function deleteexam($id)
    {
        if (isset($id)) {
            $examModel = $this->loadModel('Test_center_admin_managmentModel');
            $examModel->deleteexam($id);
        }
        header("location: " . URL . "exam_Mangment_center/index.php/");
    }
}
