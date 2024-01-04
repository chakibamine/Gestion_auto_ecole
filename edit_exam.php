<?php
if($_SERVER['REQUEST_METHOD']=='GET'){

    $id=$_GET['id'];
    $result = $_GET['result'];
    include('connection.php');
    include('controller/class_exam.php');
    include('controller/class_student.php');
    include('controller/class_dossier.php');
    $connection = new Connection();
    $connection->selectDatabase('gestion_ae_v1');

    
    $editResult = Exam::updateExam("exam",$connection->conn,$id,$result);
    $exam_row1 = Exam::selectExamById1('exam',$connection->conn,$id);
    $exam_row = Exam::selectExamById('exam',$connection->conn,$exam_row1[0]["dossier_id"]);
    $exam_row_count = Exam::selectcountAllExam('exam',$connection->conn,$exam_row1[0]["dossier_id"]);
    
    
    if ($editResult) {  
        echo "Failed to edit exam. Please try again.";
     } else {
        if($exam_row_count == '2' && ($exam_row[0]['resultat'] == '2' && $exam_row[1]['resultat'] == '2')){
            echo"imad";
            Dossier::statusdossier('dossier',$connection->conn,$exam_row1[0]["dossier_id"], FALSE, TRUE);
        }
        elseif($exam_row_count == '2' && ($exam_row[0]['resultat'] == '1' && $exam_row[1]['resultat'] == '1')){
            Dossier::statusdossier('dossier',$connection->conn,$exam_row1[0]["dossier_id"], FALSE, FALSE);
        } 
        elseif($exam_row_count == '3' && $exam_row[2]['resultat'] == '1'){
            Dossier::statusdossier('dossier',$connection->conn,$exam_row1[0]["dossier_id"], FALSE, FALSE);
        }
        elseif($exam_row_count == '3' && $exam_row[2]['resultat'] == '2'){
            Dossier::statusdossier('dossier',$connection->conn,$exam_row1[0]["dossier_id"], FALSE, TRUE);
        }
        // header("Location:dossier_table.php?msg=exam modified successfully.");
    }
    
}
?>
