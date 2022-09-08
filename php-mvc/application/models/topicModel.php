<?php
class topicModel
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
    function addtopic($id, $subject_name, $name)
    {
        $id = strip_tags($id);
        $name = strip_tags($name);
        $subject_name = strip_tags($subject_name);
        $subject = "SELECT id from subject WHERE name='$subject_name'";
        $query = $this->db->prepare($subject);
        $query->execute();
        $res_subject_id = $query->fetchAll();
        $subject_id = $res_subject_id[0]->id;
        $subject_id = strip_tags($subject_id);
        $sql = "INSERT  INTO topics (id,name,subject_id) VALUES (NULL,:name,:subject_id)";
        $query = $this->db->prepare($sql);
        $query->execute(array(':name' => $name, ':subject_id' => $subject_id));
    }
    //show
    function showtopics()
    {
        $sql = "SELECT subject.id as subject_id, subject.name as subject_name ,topics.id as topic_id , topics.subject_id as topic_subject_id ,topics.name as topic_name 
      FROM topics JOIN subject on (subject.id= topics.subject_id )";
        $query = $this->db->prepare($sql);
        $query->execute();
        return  $query->fetchAll();
    }
    //delete
    function deletetopic($id)
    {
        $sql = "DELETE FROM question WHERE topics_id = :id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $id));
        $sql = "DELETE FROM topics WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $id));
    }
    //edit 
    function edittopic($id, $name)
    {
        $id = strip_tags($id);
        $name = strip_tags($name);
        $sql = "UPDATE topics 
    SET name = :name 
    WHERE topics.id = :id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $id, ':name' => $name));
    }
    //number
    public function getNumberTopic()
    {
        $sql = "SELECT COUNT(*) FROM topics";
        $query = $this->db->prepare($sql);
        $query->execute();
        $count = $query->fetchColumn();
        return $count;
    }
}
