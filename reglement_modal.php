<?php 
error_reporting(E_ERROR | E_PARSE);
  $id = $_GET['dosscin'];

  include_once('connection.php');
  include_once('controller/class_reg.php');
  include_once('controller/class_dossier.php');
  include_once('controller/class_student.php');
  // database connection
  $connection = new Connection();
  $connection->selectDatabase('gestion_ae_v1');
  
  $dossier_aff = Dossier::selectdossierById('dossier',$connection->conn,$id);

  $allreg = Reglement::selectAllReglement('reg',$connection->conn,$id);
  $totalAvances = Reglement::selectReglementById('reg',$connection->conn,$id);
  
  $tt = $dossier_aff["price"]-$totalAvances["total_price"];
if($totalAvances["total_price"] < $dossier_aff["price"]){
echo "
  <form method='GET' action='add_reg.php'>
      <div class='container'>
        <div class='row'>
          <div class='col'>
          <div class='mb-3'>
                  <label for='recipient-name' class='col-form-label'>C.I.N :</label>
                  <input type='text' class='form-control'  name='cin' value='$dossier_aff[cin]'>
                </div>
          </div>
          <div class='col'>
            <div class='mb-3'>
                  <label for='recipient-name' class='col-form-label'>Reglement pour :</label>
                  <input type='text' class='form-control' id='copy_lui_m'  value='".$dossier_aff['lastname']. " " . $dossier_aff['firstname']."'>
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
                  <label for='recipient-name' class='col-form-label'>Prix :</label>
                  <input type='text' class='form-control' value='$dossier_aff[price]' disabled>
                </div>
          </div>
          <div class='col'>
            <div class='mb-3'>
                  <label for='recipient-name' class='col-form-label'>Avances :</label>
                  <input type='text' class='form-control' id='copy_lui_m'  value='$totalAvances[total_price]' disabled>
                </div>
            </div>
          <div class='col'>
            <div class='mb-3'>
                <label for='recipient-name' class='col-form-label'>Reste :</label>
                <input type='text' class='form-control' id='recipient-name'  value='$tt' disabled>
            </div>
          </div>
          <div class='row'>
            <div class='col'>
            <div class='mb-3'>
              <label for='recipient-name' class='col-form-label'>Date de reglement :</label>
              <input type='date' class='form-control' id='recipient-name' name = 'date_reg'>
            </div>
            </div>
            <div class='col'>
              <div class='mb-3'>
              <label for='recipient-name' class='col-form-label'>Montant :</label>
              <input type='text' class='form-control' id='recipient-name' name = 'price'>
            </div>
          </div>
          <div class='row'>
            <div class='col'>
              <div class='mb-3'>
                <label for='recipient-name' class='col-form-label'>Motif :</label>
                <select class='form-select' aria-label='Default select example' name = 'motif'>
                  <option selected></option>
                  <option value='Free inscription'>Free inscription</option>
                  <option value='Free dossier'>Free dossier</option>
                  <option value='Free ecole'>Free ecole</option>
                </select>
              </div>
            </div>
              <div class='col'>
                <div class='mb-3'>
                <label for='recipient-name' class='col-form-label'>Nom du payeur :</label>
                  <div class='input-group mb-3'>
                      <div class='input-group-text'>
                          <label for=''>lui meme <input onclick='verification()' class='form-check-input mt-1' id='check_lui_m' type='checkbox' value='' aria-label='Checkbox for following text input'></label>
                      </div>
                      <input id='text_lui_m' type='text' class='form-control' name='nom_de_payeur' aria-label='Text input with checkbox'>
                  </div>
                </div>
              </div>
            </div>
          </div>
        ";}?>
        <table class="table" id="table_reg">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Motif</th>
              <th scope="col">Montant</th>
              <th scope="col">date</th>
              <th scope="col">Nom du payeur</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
          <?php
           if(isset($allreg)){
                    $i = 1;
                    foreach($allreg as $row) {
                      echo " <tr>
                        <td>$i</td>
                        <td>$row[motif]</td>
                        <td>$row[price]</td>
                        <td>$row[date_reg]</td>
                        <td>$row[nom_du_payeur]</td>
                        <td>";
                        if($dossier_aff["status"] == '0'){echo"";}
                        else{echo"<a class ='btn btn-danger btn-sm' href='delete_reg.php?id=$row[id]'>delete</a>";}
                        echo"</td>
                        </tr>";
                        $i++;
                    }
                  }else{
                    echo"";
                  }
                ?>
            
          </tbody>
        </table>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        <?php if($totalAvances["total_price"] < $dossier_aff["price"]){
              echo "
          <button type='submit' name='add_reg' class='btn btn-primary'>Ajouter</button>
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
