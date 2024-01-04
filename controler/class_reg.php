<?php 
 
class Reglement{

    public $date_reg;
    public $price;
    public $motif; 
    public $nom_payeur; 
    public $insert_user; 
    public $dossier_id;
    public static $errorMsg = "";
    
    public static $successMsg="";
    
    
    public function __construct($date_reg,$price,$motif,$nom_payeur,$dossier_id){
    
        //initialize the attributs of the class with the parameters, and hash the password
        $this->date_reg = $date_reg;
        $this->price = $price;
        $this->motif = $motif;
        $this->nom_payeur = $nom_payeur;
        $this->dossier_id = $dossier_id;
    
    }
    
    public function insertReglement($tableName,$conn){
    
        //insert a dossier in the database, and give a message to $successMsg and $errorMsg
        $sql = "INSERT INTO $tableName (date_reg, price, motif,date_insertion, nom_du_payeur,insert_user, dossier_id)
                VALUES ('$this->date_reg', '$this->price', '$this->motif',current_timestamp(),'$this->nom_payeur', '$this->insert_user', '$this->dossier_id');";
        if (mysqli_query($conn, $sql)) {
            self::$successMsg= "Reglement created successfully";
            header("Location:dossier_table.php?msg=Reglement creeted successfully.");
        } else {
            self::$errorMsg ="Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    
    public static function  selectAllReglement($tableName,$conn,$id){
        //select all the dossier from database, and inset the rows results in an array $data[]
        $sql = "SELECT a.id,a.date_reg,a.price,a.motif,a.date_insertion,a.nom_du_payeur,a.insert_user,a.dossier_id
                from reg a
                INNER JOIN dossier b ON a.dossier_id = b.id
                WHERE b.id='$id'";
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
    
    static function selectReglementById($tableName,$conn,$id){
        //select a client by id, and return the row result
        $sql = "
                SELECT SUM(a.price) as total_price
                from reg a
                INNER JOIN dossier b ON a.dossier_id = b.id
                WHERE b.id='$id'
        ";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $row = mysqli_fetch_assoc($result);
        }
        return $row;
    }

    static function deleteReglement($tableName,$conn,$id){
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