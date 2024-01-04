<?php
if($_SERVER['REQUEST_METHOD']=='GET'){

    $id=$_GET['id'];
    include('connection.php');
    include('controller/class_dossier.php');
    // database connection
    $connection = new Connection();
    $connection->selectDatabase('gestion_ae_v1');

    // Call the static deleteClient method
     $deleteResult = Dossier::deletedossier("dossier",$connection->conn,$id);
    // Check if the deletion was successful
    if ($deleteResult) {  
        echo "Failed to delete client. Please try again.";
     } else {
        header("Location:dossier_table.php?msg=dossier deleted successfully.");
    }
}
?>
