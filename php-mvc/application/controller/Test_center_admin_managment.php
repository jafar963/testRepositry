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
class Test_center_admin_managment extends Controller
{
    public function index()
    {
        require_once 'application/views/_templates/header-admin.php';
        require_once 'application/views/Test_center_admin_managment/index.php';
    }
    public function addAdminCenter()
    {
        if (isset($_POST["add-Admin"])) {
            
           
            $name_of_center= validate($_POST['name-of-center']);
            $address= validate($_POST['address']);
            $Moblie= validate($_POST['Moblie']);
            $selected_admin=validate($_POST['selected-admin']);
            if ($name_of_center != "" && $address !="" && $Moblie !="" && $selected_admin!="") {
                $centerModel = $this->loadModel('Test_center_admin_managmentModel');
                $centerModel->addcenter(NULL, $name_of_center, $address,$Moblie,$selected_admin);
                header("location: " . URL . "Test_center_admin_managment/index.php");

            }
            else{
                $error_msg = "Incorrect entry information !!";
                require_once 'application/views/_templates/header-admin.php';
                require_once 'application/views/Test_center_admin_managment/index.php';
                require_once 'application/views/error/index.php';

            }
        }
    }
    public function deleteAdminCenter($id)
    {
        if (isset($id)) {
            $centerModel = $this->loadModel('Test_center_admin_managmentModel');
            $centerModel->deletecenter($id);
        }
        header("location: " . URL . "Test_center_admin_managment/index.php");
    }
    public function editCenterInfo()
    {
        if(isset($_POST['edit'])){
        $editCenterInformation = validate($_POST['editCenterInformation']);
        $id=validate($_POST['id']);
        $selected_admin_edit= validate($_POST['selected-admin-edit']);
        if ($editCenterInformation != "" &&  $selected_admin_edit!="") {
            $centerModel = $this->loadModel('Test_center_admin_managmentModel');
            $centerModel->editcenter($id, $selected_admin_edit, $editCenterInformation);
            header("location: " . URL . "Test_center_admin_managment/index.php");
        } else {
            $error_msg = "Incorrect entry information !!";
            require_once 'application/views/_templates/header-admin.php';
            require_once 'application/views/Test_center_admin_managment/index.php';
            require_once 'application/views/error/index.php';        }
    }
}
}
