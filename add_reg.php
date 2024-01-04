<?php 
  // $sql = "SELECT * FROM `dossier` WHERE cin='$dosscin';";
  include('connection.php');
  include('controller/class_dossier.php');
  include('controller/class_reg.php');

  // database connection
  $connection = new Connection();
  $connection->selectDatabase('gestion_ae_v1');

    $dossier_exist = Dossier::selectiddossierBycin('dossier',$connection->conn,$_GET['cin']);
    $totalAvances = Reglement::selectReglementById('reg',$connection->conn,$dossier_exist['id']);


    $date_reg_val = $_GET["date_reg"];
    $price_val = $_GET["price"];
    $motif_val = $_GET["motif"];
    $nom_payeur_val = $_GET["nom_de_payeur"];
    $dossier_id = $dossier_exist['id'];
    if (preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $date_reg_val)) {

        $date_reg = DateTime::createFromFormat('m/d/Y', $date_reg_val);
        
        if ($date_reg_val !== false) {
            // Format and print the date
            $date_reg_val = $date_reg->format('Y-m-d');
        }
    }
    
    //create new instance of client class with the values of the inputs
    $student = new Reglement($date_reg_val,$price_val,$motif_val,$nom_payeur_val,$dossier_id);
    $student->insertReglement('reg',$connection->conn);
    $successMesage = Reglement::$successMsg;
    $errorMesage = Reglement::$errorMsg;
    
  

  
  
?>