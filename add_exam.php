<?php 
  include('connection.php');
  include('controller/class_exam.php');
  include('controller/class_student.php');
  include('controller/class_dossier.php');
  // database connection
  $connection = new Connection();
  $connection->selectDatabase('gestion_ae_v1');
  $dossier_exist = Dossier::selectiddossierBycin('dossier',$connection->conn,$_GET['cin']);
  

    $date_exam = $_GET["date_exam"];
    $type_val = $_GET["type"];
    $dossier_id = $dossier_exist['id'];
    echo $date_exam;
    echo $type_val;
    echo $dossier_id;
   

  //   if (preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $date_exam)) {
  //     $date_exam = DateTime::createFromFormat('m/d/Y', $date_exam);
  //     if ($date_exam !== false) {
  //         // Format and print the date
  //         $date_exam = $date_exam->format('Y-m-d');
  //     }
  // }

        $exam = new Exam($date_exam,$type_val,$dossier_id);
        
        $exam->insertExam('exam',$connection->conn);
        
        $successMesage = Exam::$successMsg;
        $errorMesage = Exam::$errorMsg;
    
  
  
  
?>