
<?php

class Admin_test_center extends Controller
{
  public function index()
  {
    $subjectModel = $this->loadModel('subjectModel');
    $subjects = $subjectModel->showmaterial();
    require_once 'application/views/_templates/admin_test_center_header.php';
  }
  public function requireTest($id)
  {
    if (isset($_POST['request-exam'])) {

      if (isset($_POST['selected-material'])) {
      } else {
        $_POST['selected-material'] = "";
      }
      if ($_POST['selected-material'] != "") {
        $examModel = $this->loadModel('examModel');
        $examModel->requestexam($id, $_POST['selected-material']);
      } else {
        $error_msg = "You don't have an exam center yet!!";
        require_once 'application/views/_templates/admin_test_center_header.php';
        require_once 'application/views/exam_Mangment_center/index.php';
        require_once 'application/views/error/index.php';
      }
      header("location: " . URL . "exam_Mangment_center/index.php/");
    }
  }
}
