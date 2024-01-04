<?php

class Compte{

public $id;
public $firstname;
public $lastname;
public $email;
public $password;
public $role;
public $reg_date; 

public static $errorMsg = "";
public static $successMsg="";


public function __construct($firstname,$lastname,$email,$role,$password){

    //initialize the attributs of the class with the parameters, and hash the password
    $this->firstname = $firstname;
    $this->lastname = $lastname;
    $this->email = $email;
    $this->role = $role;
    $this->password = password_hash($password,PASSWORD_DEFAULT);


}
public function insertCompte($conn){
//insert a compte in the database, and give a message to $successMsg and $errorMsg
$sql = "INSERT INTO compte (firstname, lastname, email,role,password)
VALUES ('$this->firstname', '$this->lastname', '$this->email','user','$this->password')";
if (mysqli_query($conn, $sql)) {
self::$successMsg= "New record created successfully";

} else {
    self::$errorMsg ="Error: " . $sql . "<br>" . mysqli_error($conn);
}
}
static function selectCompteByEmail($conn,$email){
    //select a compte by email and password, and return the row result
    $sql = "SELECT * FROM compte WHERE email='$email' ";
    
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $row = mysqli_fetch_assoc($result);
    
    }else{$row=[];}
    return $row;
}
static function selectCompteById($conn,$id){
    //select a compte by email and password, and return the row result
    $sql = "SELECT * FROM compte WHERE id=$id";
    
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $row = mysqli_fetch_assoc($result);
    
    }else{$row=[];}
    return $row;
}
static function selectComptes($conn){
    $sql = "SELECT * FROM compte order by role";
    
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $data=[];
    while($row = mysqli_fetch_assoc($result)) {
    
        $data[]=$row;
    }
    return $data;
};}
static function updateCompte($compte,$conn,$id){
    //update a client of $id, with the values of $client in parameter
    //and send the user to read.php
    $sql = "UPDATE compte SET lastname='$compte->lastname',firstname='$compte->firstname',email='$compte->email',password='$compte->password' WHERE id='$id'";
        if (mysqli_query($conn, $sql)) {
        self::$successMsg= "New record updated successfully";
header("Location:read.php");
        } else {
            self::$errorMsg= "Error updating record: " . mysqli_error($conn);
        }
}
static function deleteCompte($conn,$id){    
    $sql = "DELETE FROM compte WHERE id='$id'";
if (mysqli_query($conn, $sql)) {
    self::$successMsg= "Record deleted successfully";
    header("Location:admin.php");
} else {
    self::$errorMsg= "Error deleting record: " . mysqli_error($conn);
}
    }
}

?>
