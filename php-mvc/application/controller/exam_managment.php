<?php
if (session_status() !== PHP_SESSION_ACTIVE)
    session_start();

    function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
class exam_managment extends Controller
{
    public function index()
    {
        require_once 'application/views/_templates/header-admin.php';
         require_once 'application/views/exam_managment/index.php';
    }
    public function addexam()
    {
        if (isset($_POST["add-exam"])) {
            $Exam_Duration=validate($_POST['Exam_Duration']);
            if(isset($_POST['selected-material'])){
            $selected_material=validate( $_POST['selected-material']);
            }
            else{
                $selected_material="";
            }
            if( $Exam_Duration!="" && $selected_material!=""){
                $examModel = $this->loadModel('examModel');
                if( $examModel->checkQuestion($selected_material)){
            // $examModel = $this->loadModel('examModel');
            $examModel->addexam(NULL, $Exam_Duration,$selected_material);
            header("location: " . URL . "exam_managment/index.php/");
                }
                else{

                    $error_msg = "There are not enough questions (at least 5 questions)";
                    require_once 'application/views/error/index.php';
                    // header("location: " . URL . "exam_managment/index.php/");

                    require_once 'application/views/_templates/header-admin.php';
                    require_once 'application/views/exam_managment/index.php';
                }

            }
            else{
                $error_msg = "You must choose a material!!";
                require_once 'application/views/_templates/header-admin.php';
                require_once 'application/views/exam_managment/index.php';
                require_once 'application/views/error/index.php';

            }
        }
    }
    public function deleteexam($id)
    {
        if (isset($id)) {
            $examModel = $this->loadModel('examModel');
            $examModel->deleteexam($id);
        }
        header("location: " . URL . "exam_managment/index.php/");
    }
}
