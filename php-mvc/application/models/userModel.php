<?php


class userModel
{
    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    public function addUser($id, $firstName, $lastName, $email, $Password, $Mobile, $image, $time_created, $isActive, $role_id)
    {
        $id = strip_tags($id);
        $firstName = strip_tags($firstName);
        $lastName = strip_tags($lastName);
        $Password  = strip_tags($Password);
        $email = strip_tags($email);
        $role_id = strip_tags($role_id);
        $Mobile = strip_tags($Mobile);
        $image = strip_tags($image);
        $isActive = strip_tags($isActive);
        $sql = "INSERT INTO user (id, firstName, lastName,email, Password, Mobile,image,time_created ,isActive, role_id)
        VALUES (NULL, :firstName, :lastName, :email , :Password, :Mobile,:image,:time_created,:isActive,:role_id)";


        $query = $this->db->prepare($sql);
        $query->execute(
            array(
                ':firstName' => $firstName,
                ':lastName' => $lastName,
                ':email' => $email,
                ':Password' => $Password,
                ':Mobile' => $Mobile,
                ':image' => $image,
                ':time_created' => $time_created,
                ':isActive' => $isActive,
                ':role_id' => $role_id
            )

        );


        $sql = "SELECT id FROM user WHERE email = :email";
        $query = $this->db->prepare($sql);
        $query->execute(array(':email' => $email));
    }




    public function findUserByEmail($email)
    {
        $sql = "SELECT  id, 
        firstName,
         lastName,
         email, 
         Password, 
         Mobile,
         image,
        role_id,
        isActive,
        time_created
                from user
                WHERE email = :email";
        $query = $this->db->prepare($sql);
        $query->execute(array(':email' => $email));
        return $query->fetchAll();
    }
    public function findUserById($id)
    {
        $sql = "SELECT  id,
           firstName,
         lastName,
         email, 
         Password, 
         Mobile,
         image,
        role_id,
        isActive,
        time_created
                from user
                WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $id));
        return $query->fetchAll();
    }
    public function findUserByPhone($mobile)
    {
        $sql = "SELECT  id, 
        firstName,
         lastName,
         email, 
         Password, 
         Mobile,
         image,
        role_id
                from user
                WHERE Mobile = :mobile";
        $query = $this->db->prepare($sql);
        $query->execute(array(':mobile' => $mobile));
        return $query->fetchAll();
    }
    public function deleteUser($user_id)
    {
        $sql = "DELETE FROM user WHERE id = :user_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':user_id' => $user_id));
    }
    public function getAllUsers()
    {
        $sql = "SELECT user.id as user_id , user.firstName as firstName ,user.lastName as lastName ,user.email as email , user.Mobile as Mobile ,user.image as image ,user.time_created as time_created,
        user.isActive as isActive , role.name as role_name 
        FROM user JOIN role on (user.role_id = role.id)";
        $query = $this->db->prepare($sql);
        $query->execute(array());
        return $query->fetchAll();
    }
    public function getNumberStudent()
    {
        $sql = "SELECT COUNT(*) FROM user WHERE role_id=3 ";
        $query = $this->db->prepare($sql);
        $query->execute();
        $count = $query->fetchColumn();
        return $count;
    }
    public function getNumberUsers()
    {
        $sql = "SELECT COUNT(*) FROM user";
        $query = $this->db->prepare($sql);
        $query->execute();
        $count = $query->fetchColumn();
        return $count;
    }
    public function getNumberAdmin()
    {
        $sql = "SELECT COUNT(*) FROM user WHERE role_id=1";
        $query = $this->db->prepare($sql);
        $query->execute();
        $count = $query->fetchColumn();
        return $count;
    }
    public function getNumberAdminTestCenter()
    {
        $sql = "SELECT COUNT(*) FROM user WHERE role_id=2 ";
        $query = $this->db->prepare($sql);
        $query->execute();
        $count = $query->fetchColumn();
        return $count;
    }
    public function Active($user_id, $isActive)
    {
        $sql = "UPDATE user SET isActive = '$isActive' WHERE id = '$user_id'";
        $query = $this->db->prepare($sql);
        $query->execute();
    }
    public function desActive($id, $isActive)
    {
        $id = strip_tags($id);
        $sql = "UPDATE user
        SET isActive =:isActive
        WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->execute();
    }
    public function editProfile($id, $firstName, $lastName, $image, $Mobile)
    {
        $id = strip_tags($id);
        $firstName = strip_tags($firstName);
        $lastName = strip_tags($lastName);
        $image = strip_tags($image);
        $Mobile = strip_tags($Mobile);
        
        $sql = "UPDATE user
         SET firstName = :firstName, 
             lastName = :lastName,
             image = :image,
             Mobile = :Mobile
         WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $id, ':firstName' => $firstName, ':lastName' => $lastName, ':image' => $image, ':Mobile' => $Mobile));
    }

    public function getUserTestCenterAvailable(){
$sql = "SELECT * from user WHERE id NOT IN (SELECT user.id FROM user JOIN test_center on (user.id = test_center.user_id)) AND 
 user.role_id = 2 ";
 $query = $this->db->prepare($sql);
 $query->execute(array());
 return $query->fetchAll();
    }
    public function getUserTestCenter(){
       $sql="SELECT user_id from test_center ";
         $query = $this->db->prepare($sql);
         $query->execute(array());
         
        $res_user_id= $query->fetchAll();
for($i=0;$i<count($res_user_id);$i++){
         $user_id[$i] = $res_user_id[$i]->user_id;
}
return $user_id;
            }
}
