
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
class managment_materials extends Controller
{
    public function index()
    {
        require_once 'application/views/_templates/header-admin.php';
        require_once 'application/views/managment_materials/index.php';
    }
    public function addSubject()
    {
        if (isset($_POST["add-material"])) {
            $name_subject = validate($_POST['name-of-materials']);
            if ($name_subject != "") {
                $subjectModel = $this->loadModel('subjectModel');
                $subjectModel->addmaterial(NULL, $name_subject);
                header("location: " . URL . "managment_materials/index.php/");
            } else {
                $error_msg = "Incorrect entry information !!";
                require 'application/views/_templates/header-admin.php';
                require 'application/views/managment_materials/index.php';
                require 'application/views/error/index.php';
            }
        }
    }
    public function deleteSubject($id)
    {
        if (isset($id)) {
            $subjectModel = $this->loadModel('subjectModel');
            $subjectModel->deletematerial($id);
            header("location: " . URL . "managment_materials/index.php/");
        }
    }
    public function editSubject()
    {

        if ( isset($_POST['editmaterial'])) {
            $id=validate($_POST['id']);
            $edit_subject = validate($_POST['editmaterial']);
            if ($edit_subject != "" && $id!="") {
                $subjectModel = $this->loadModel('subjectModel');
                $subjectModel->editMaterial($id, $edit_subject);
                header("location: " . URL . "managment_materials/index.php/");
            } else {
                $error_msg = "Incorrect entry information !!";
                require_once 'application/views/_templates/header-admin.php';
                require_once 'application/views/managment_materials/index.php';
                require_once 'application/views/error/index.php';
            }

        }

    }
}
