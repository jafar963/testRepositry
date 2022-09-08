<?php


class testCenterModel
{
    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }
    

//add
function getAllTestCenter()
{

    $sql = "SELECT * 
    FROM test_center";
    $query = $this->db->prepare($sql);
    $query->execute();

    return $query->fetchAll();


}

function getAllExams($id)
{

    echo $id;
    $sql = "SELECT *
    FROM test_center where user_id=$id";
    $query = $this->db->prepare($sql);
    $query->execute();
    $center_id=$query->fetchAll();
print_r($center_id);     
    $sql = "SELECT * 
    FROM test_center_has_test";
    $query = $this->db->prepare($sql);
    $query->execute();
 
 


}
public function getNumberExamsCenter($id)
{
    $sql = "SELECT *
    FROM test_center where user_id=$id";
    $query = $this->db->prepare($sql);
    $query->execute();
    $id=$query->fetchAll();
var_dump($id); 
    $sql = "SELECT COUNT(*) FROM test_center_has_test";
    $query = $this->db->prepare($sql);
    $query->execute();
    $count = $query->fetchColumn();
    echo $count;
    return $count;
 
}


}