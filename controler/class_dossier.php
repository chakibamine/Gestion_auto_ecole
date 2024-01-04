<?php 
class Dossier{

    public $id;
    public $category;
    public $price;
    public $ref;
    public $student_id;
    public $reg_date; 
    public $insert_user; 

    public static $errorMsg = "";

    public static $successMsg="";


    public function __construct($category,$price,$ref,$student_id){

        //initialize the attributs of the class with the parameters, and hash the password
        $this->category = $category;
        $this->price = $price;
        $this->ref = $ref;
        $this->student_id = $student_id;

    }

    public function insertdossier($tableName,$conn){

        //insert a dossier in the database, and give a message to $successMsg and $errorMsg
        $sql = "INSERT INTO $tableName (category, price, ref, date_inscription, insert_user, student_id)
                VALUES ('$this->category', '$this->price', '$this->ref', CURRENT_TIMESTAMP(), '$this->insert_user', '$this->student_id');";
        if (mysqli_query($conn, $sql)) {
            self::$successMsg= "New record created successfully";
            header("Location:dossier_table.php");

        } else {
            self::$errorMsg ="Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    public static function  selectAlldossier($tableName,$conn){

        //select all the dossier from database, and inset the rows results in an array $data[]
        $sql = "SELECT * FROM $tableName WHERE status = 1";
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


    public static function  selectAlldossierarchive($tableName,$conn){

        //select all the dossier from database, and inset the rows results in an array $data[]
        $sql = "SELECT * FROM $tableName WHERE status = 0";
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

    static function selectdossierById($tableName,$conn,$id){
        //select a dossier by id, and return the row result
        $sql = "SELECT *
                FROM  dossier
                INNER JOIN student ON student.id = dossier.student_id
                WHERE dossier.id=$id";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $row = mysqli_fetch_assoc($result);
        
        }
        return $row;
    }
    static function selectiddossierBycin($tableName,$conn,$id){
        //select a dossier by id, and return the row result
        $sql = "SELECT dossier.id
                FROM  dossier
                INNER JOIN student ON student.id = dossier.student_id
                WHERE student.cin='$id'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $row = mysqli_fetch_assoc($result);
        
        }
        return $row;
    }
    

    static function updatedossier($dossier,$tableName,$conn,$id){
        //update a dossier of $id, with the values of  dossier in parameter
        //and send the user to read.php
        $sql = "UPDATE $tableName SET lastname='$dossier->lastname',firstname='$dossier->firstname',email='$dossier->email' WHERE id='$id'";
            if (mysqli_query($conn, $sql)) {
            self::$successMsg= "New record updated successfully";
            header("Location:read.php");
            } else {
                self::$errorMsg= "Error updating record: " . mysqli_error($conn);
            }


    }

    static function statusdossier($tableName,$conn,$id,$status,$resultat){

        $sql = "UPDATE $tableName SET status='$status', resultat='$resultat' WHERE id='$id'";
            if (mysqli_query($conn, $sql)) {
            self::$successMsg= "New record updated successfully";
            header("Location:dossier_table.php?msg=exam modified successfully.");
            } else {
                self::$errorMsg= "Error updating record: " . mysqli_error($conn);
            }


    }

    static function deletedossier($tableName,$conn,$id){
        //delet a dossier by his id, and send the user to read.php
        $sql = "DELETE FROM $tableName WHERE id='$id'";
        if (mysqli_query($conn, $sql)) {
            self::$successMsg= "Record deleted successfully";
            header("Location:dossier_table.php?msg=Dossier deleted successfully.");
        } else {
            self::$errorMsg= "Error deleting record: " . mysqli_error($conn);
        }
    }
}
?>