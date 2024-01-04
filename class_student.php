<?php
class Student{

    public $id;
    public $gender;
    public $cin;
    public $firstname;
    public $lastname;
    public $date_birth;
    public $place_birth;
    public $address;
    public $city;
    public $phone;
    public $a_firstname;
    public $a_lastname;
    public $a_place_birth;
    public $a_address;
    public $reg_date; 
    public $insert_user;

    public static $errorMsg = "";

    public static $successMsg="";


    public function __construct($gender,$cin,$firstname,$lastname,$date_birth,$place_birth,$address,$city,$phone,$a_firstname,$a_lastname,$a_place_birth,$a_address){

        //initialize the attributs of the class with the parameters, and hash the password
        $this->gender = $gender; 
        $this->cin = $cin;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->date_birth = $date_birth;
        $this->place_birth = $place_birth;
        $this->address = $address;
        $this->city = $city;
        $this->phone = $phone;
        $this->a_firstname = $a_firstname;
        $this->a_lastname = $a_lastname;
        $this->a_place_birth = $a_place_birth;
        $this->a_address = $a_address;

    }

    public function insertStudent($tableName,$conn){
        $sql = "INSERT INTO $tableName (gender, cin, firstname, lastname, date_birth, place_birth, address, city, phone, a_firstname, a_lastname, a_place_birth, a_address, reg_date, insert_user) 
            VALUES ('$this->gender', '$this->cin', '$this->firstname', '$this->lastname', '$this->date_birth', '$this->place_birth', '$this->address', '$this->city', '$this->phone', '$this->a_firstname'
                    , '$this->a_lastname', '$this->a_place_birth', '$this->a_address', current_timestamp(), '$this->insert_user');";
        if (mysqli_query($conn, $sql)) {
            self::$successMsg= "New record created successfully";
            header("Location:add_dossier.php?cin=$this->cin");
        } else {
            self::$errorMsg ="Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    public static function  selectAllStudents($tableName,$conn){

        //select all the client from database, and inset the rows results in an array $data[]
        $sql = "SELECT * FROM $tableName";
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

    static function selectStudentById($tableName,$conn,$id){
        //select a client by id, and return the row result
        $sql = "SELECT * FROM $tableName  WHERE cin='$id'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $row = mysqli_fetch_assoc($result);
        }
        return $row;
    }
    static function selectStudentById1($tableName,$conn,$id){
        //select a client by id, and return the row result
        $sql = "SELECT *
                FROM student
                INNER JOIN dossier ON dossier.student_id = student.id
                WHERE student.id = '$id';";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $row = mysqli_fetch_assoc($result);
        }
        return $row;
    }

    static function updateStudent($client,$tableName,$conn,$id){
        //update a client of $id, with the values of $client in parameter
        //and send the user to read.php
        $sql = "UPDATE $tableName SET gender='$client->gender',cin='$client->cin',firstname='$client->firstname',lastname='$client->lastname',date_birth='$client->date_birth',
                place_birth='$client->place_birth',address='$client->address',city='$client->city',phone='$client->phone',a_firstname='$client->a_firstname',a_lastname='$client->a_lastname',
                a_place_birth='$client->a_place_birth',a_address='$client->a_address' WHERE id='$id'";
            if (mysqli_query($conn, $sql)) {
            self::$successMsg= "New record updated successfully";
                header("Location:user_DB.php?msg=Client Modified successfully.");
            } else {
                self::$errorMsg= "Error updating record: " . mysqli_error($conn);
            }


    }

    static function deleteStudent($tableName,$conn,$id){
            //delet a client by his id, and send the user to read.php
            $sql = "DELETE FROM $tableName WHERE id='$id'";
        if (mysqli_query($conn, $sql)) {
            self::$successMsg= "Record deleted successfully";
        } else {
            self::$errorMsg= "Error deleting record: " . mysqli_error($conn);
        }

    
    }
}

?>