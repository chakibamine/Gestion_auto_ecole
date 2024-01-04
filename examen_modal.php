<?php 
error_reporting(E_ERROR | E_PARSE);
  $id = $_GET['dosscin'];
  include_once('connection.php');
  include('controller/class_exam.php');
  include('controller/class_student.php');
  include('controller/class_dossier.php');
  // database connection
  $connection = new Connection();
  $connection->selectDatabase('gestion_ae_v1');
  
  function getCurrentDate() {
    return date('Y-m-d');
  }

  $dossier_aff = Dossier::selectdossierById('dossier',$connection->conn,$id);
  $exam_row = Exam::selectExamById('exam',$connection->conn,$id);
  $exam_row_count = Exam::selectcountAllExam('exam',$connection->conn,$id);
  
  $type = "";


  switch ($exam_row_count) {
    case '0':
        $type = "Theorique";
        break;
    case '1':
        if ($exam_row[0]['resultat'] == '2'){
            $type = "Pratique";
        } elseif ( $exam_row[0]['resultat'] == '0' || $exam_row[0]['resultat'] == '1'){
            $type = "Theorique";
        }
        break;
    case '2':
        if ($exam_row[0]['resultat'] == '2' && $exam_row[1]['resultat'] == '0') {
            $type = "Pratique";
        } elseif ($exam_row[0]['resultat'] == '1' && $exam_row[1]['resultat'] == '0') {
            $type = "Theorique";
        } elseif ($exam_row[0]['resultat'] == '1' && $exam_row[1]['resultat'] == '2') {
            $type = "Pratique";
        } elseif ($exam_row[0]['resultat'] == '2' && $exam_row[1]['resultat'] == '1') {
            $type = "Pratique";
        } elseif ($exam_row[0]['resultat'] == '1' && $exam_row[1]['resultat'] == '1') {
            
        } elseif ($exam_row[0]['resultat'] == '2' && $exam_row[1]['resultat'] == '2') {

        }
        break;
    case '3':
        if (is_null($exam_row[2]['resultat'])) {
            $type = "Pratique";
        }
        break;
}
?>



<?php
if (($exam_row_count == '3' && isset($exam_row[2]['resultat'])) || ($exam_row_count == '2' && ($exam_row[0]['resultat'] == '2' && $exam_row[1]['resultat'] == '2') || ($exam_row[0]['resultat'] == '1' && $exam_row[1]['resultat'] == '1'))) {
    echo "";
} else {
    echo " 
  <form method='GET' action='add_exam.php'>
      <div class='container'>
        <div class='row'>
          <div class='col'>
            <div class='mb-3'>
              <label for='recipient-name' class='col-form-label'>C.I.N :</label>
              <input type='text' class='form-control' name='cin' value='$dossier_aff[cin]'>
            </div>
          </div>
          <div class='col'>
            <div class='mb-3'>
              <label for='recipient-name' class='col-form-label'>Examen pour :</label>
              <input type='text' class='form-control' id='copy_lui_m' value='" . $dossier_aff['lastname'] . " " . $dossier_aff['firstname'] . "'>
            </div>
          </div>
          <div class='col'>
            <div class='mb-3'>
              <label for='recipient-name' class='col-form-label'>Dossier :</label>
              <input type='text' class='form-control' id='recipient-name' name='dossref' value='$dossier_aff[ref]'>
            </div>
          </div>
          <div class='row'>
            <div class='col'>
              <div class='mb-3'>
                <label for='recipient-name' class='col-form-label'>Date d'examen :</label>
                <input type='date' class='form-control' id='recipient-name' name='date_exam' require>
              </div>
            </div>
            <div class='col'>
              <div class='mb-3'>
                <label for='recipient-name' class='col-form-label'>type :</label>
                <input type='text' class='form-control' id='recipient-name' name='type' value='$type' require>
              </div>
            </div>
            <div class='col'></div>
          </div>
          ";}
    ?>

        
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Examen</th>
              <th scope="col">Date</th>
              <th scope="col">Resultat</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
          <?php
          $today = getCurrentDate();
          
          foreach ($exam_row as $row) {
              
            echo "<tr style='background-color:";
                if ($row['resultat'] == '1') {echo "#F9EEEE";} 
                elseif ($row['resultat'] == '2') {echo "#EEF9F9";}
            echo";'>
                    <td>$row[type_exam]</td>
                    <td>$row[date_exam]</td>
                    <td>";
                    if ($row['resultat'] == '1') {
                      echo "Inapte";
                  } elseif ($row['resultat'] == '2') {
                      echo "Apte";
                  } else{
                      echo "En cours ...";
                  }
                    
                    echo "</td>
                    <td>";
                      
                      if($row['date_exam']<=$today && $row['resultat'] == '0'){
                        echo "<a class='btn btn-success btn-sm' href='edit_exam.php?id=$row[id]&result=2'>APTE</a>
                        <a class='btn btn-warning btn-sm mx-2' href='edit_exam.php?id=$row[id]&result=1'>INAPTE</a>";
                      
                      }
                      if ($row['resultat'] == '1' || $row['resultat'] == '2') {
                        echo "";
                      }else{
                        echo"<a class='btn btn-danger btn-sm' href='delete_exam.php?id={$row['id']}'>delete</a>";
                      }
                        echo"</td>
                  </tr>";
                      }
                ?>
          </tbody>
        </table>
        <div class="modal-footer">
          <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Annuler</button>
          <?php if(($exam_row_count == '3' && isset($exam_row[2]['resultat'])) || ($exam_row_count == '2' && ($exam_row[0]['resultat'] == '2' && $exam_row[1]['resultat'] == '2') || ($exam_row[0]['resultat'] == '1' && $exam_row[1]['resultat'] == '1'))){echo "";}else{echo" 
            <button type='submit' name='add_exam' class='btn btn-primary'>Ajouter</button>
          ";}?>
        </div>
        
  </form>


<script>

<?php echo !empty($errorMesage) ? "alert('$errorMesage');" : "// No error"; ?>

          var check_lui_m = document.getElementById('check_lui_m');
          var text_lui_m = document.getElementById('text_lui_m');
          var copy_lui_m = document.getElementById('copy_lui_m');
          function verification() {
            if(check_lui_m.checked){
              text_lui_m.value = copy_lui_m.value;
            }else{
              text_lui_m.value = "";
            }
          }
</script>
