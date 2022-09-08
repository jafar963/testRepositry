<?php
class subjectModel
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
    function addmaterial($id, $name)
    {
        $id = strip_tags($id);
        $name = strip_tags($name);
        $sql = " INSERT IGNORE INTO subject (id, name) VALUES (NULL, :name) ";
        $query = $this->db->prepare($sql);
        $query->execute(array(':name' => $name));
    }
    //show
    function showmaterial()
    {
        $sql = "SELECT  id,name from subject ";
        $query = $this->db->prepare($sql);
        $query->execute(array());
        return $query->fetchAll();
    }
    //delete
    function deletematerial($subject_id)
    {
        $sql = "DELETE FROM subject WHERE id = :subject_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':subject_id' => $subject_id));
    }

    //edit 
    function editMaterial($id, $name)
    {
        $id = strip_tags($id);
        $name = strip_tags($name);
        $sql = "UPDATE subject
    SET name = :name 
    WHERE subject.id = :id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $id, ':name' => $name));
    }
    //number
    public function getNumberSubject()
    {
        $sql = "SELECT COUNT(*) FROM subject";
        $query = $this->db->prepare($sql);
        $query->execute();
        $count = $query->fetchColumn();
        return $count;
    }
}
