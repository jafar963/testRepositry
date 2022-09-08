<?php
session_start();
class StartExam extends Controller
{
    public function index()
    {
        require_once 'application/views/startExam/index.php';
    }
    public function start()
    {
        require_once 'application/views/startExam/start.php';
    }
    public function chooseExam()
    {
        if(isset($_POST['selected-material'])){
        $name = $_POST['selected-material'];
        $_SESSION['name'] = $name;
        }
        else{
            $name =""; 
        }
        if($name!=""){
        $examModel = $this->loadModel('examModel');
        $questions_id = $examModel->chooseExam($name);
        header("location: " . URL . "startExam/index");

        }
        else{
            $error_msg = "You don't have any quiz yet!!";
            require_once 'application/views/_templates/header-student.php';
            require_once 'application/views/error/index.php';



        }
    }
    public function getOneQuestion($id)
    {
        $examModel = $this->loadModel('examModel');
        $question = $examModel->getOneQuestion($id);
        header("location: " . URL . "startExam/start.php");
    }
    public function addMark($test_id)
    {
        $date_exam = date('Y-m-d');
        if (isset($_POST['submit-mark'])) {
            $student_has_exam_Model = $this->loadModel('student_has_exam_Model');
            $student_has_exam_Model->addMark(NULL, $test_id, $_SESSION['user']->id, $_POST['mark'], $date_exam);
            header("location: " . URL . "student/index.php");
        }
    }
}
