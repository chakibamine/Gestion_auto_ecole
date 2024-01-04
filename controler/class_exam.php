<?php 
class Exam{



    public $date_exam;
    public $type;
    public $dossier_id; 
    public $insert_user;
    
    public static $errorMsg = "";
    public static $successMsg="";
    
    
    public function __construct($date_exam,$type,$dossier_id){
    
        //initialize the attributs of the class with the parameters, and hash the password
        
        $this->date_exam = $date_exam;
        $this->type = $type; 
        $this->dossier_id = $dossier_id;  
        
    }
    
    public function insertExam($tableName,$conn){
        $sql = "INSERT INTO $tableName (date_exam, type_exam, date_insertion, insert_user, dossier_id)
                VALUES ('$this->date_exam', '$this->type', current_timestamp(), '$this->insert_user', '$this->dossier_id');";
        if (mysqli_query($conn, $sql)) {
            self::$successMsg= "Reglement created successfully";
            header("Location:dossier_table.php?msg=Exam creeted successfully.");
        
        } else {
            self::$errorMsg ="Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    static function updateExam($tableName,$conn,$id,$result){
        $sql = "UPDATE $tableName SET resultat='$result' WHERE id='$id'";
        if (mysqli_query($conn, $sql)) {
            self::$successMsg= "New record updated successfully";
            header("Location:edit_exam.php");
        } else {
            self::$errorMsg= "Error updating record: " . mysqli_error($conn);
        }


    }
    
    public static function selectcountAllExam($tableName, $conn, $id) {
        $sql = "SELECT COUNT(*) AS row_count
                FROM $tableName a
                INNER JOIN dossier d ON a.dossier_id = d.id
                WHERE a.dossier_id = '$id'";
                
        $result = mysqli_query($conn, $sql);
    
        if ($result) {
            $row = mysqli_fetch_assoc($result);
    
            // Check if the row_count key exists in the result
            if (isset($row['row_count'])) {
                return $row['row_count'];
            } else {
                return 0; 
            }
        } else {
            return false; 
        }
    }

    
    static function selectExamById($tableName,$conn,$id){
        //select a client by id, and return the row result
        $sql = "SELECT a.id, a.date_exam, a.type_exam, a.resultat, a.date_insertion, a.insert_user, a.dossier_id
                FROM $tableName a
                INNER JOIN dossier d ON a.dossier_id = d.id
                WHERE a.dossier_id = '$id'
                ORDER BY a.date_exam ASC;";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            $data=[];
            while($row = mysqli_fetch_assoc($result)) {
                $data[]=$row;
            }
            return $data;
        }
    }
    


    static function selectExamById1($tableName,$conn,$id){
        //select a client by id, and return the row result
        $sql = "SELECT *
                FROM $tableName 
                WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            $data=[];
            while($row = mysqli_fetch_assoc($result)) {
                $data[]=$row;
            }
            return $data;
        }
    }
    

    static function deleteExam($tableName,$conn,$id){
        //delet a dossier by his id, and send the user to read.php
        $sql = "DELETE FROM $tableName WHERE id='$id'";
    
        if (mysqli_query($conn, $sql)) {
            self::$successMsg= "Record deleted successfully";
        } else {
            self::$errorMsg= "Error deleting record: " . mysqli_error($conn);
        }
        
        
    }
    

}
?>