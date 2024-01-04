<?php
include('connection.php');
include('controller/class_student.php');

$connection = new Connection();
$connection->selectDatabase('gestion_ae_v1');

$errorMessage = "";
$successMessage = "";

// Initialize variables
$gender = $cin = $firstname = $lastname = $date_birth = $place_birth = $address = $city = $phone = $a_firstname = $a_lastname = $a_place_birth = $a_address = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Check if 'id' is set in the $_GET array
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Call the static selectStudentById method and store the result in $row
        $row = Student::selectStudentById("student", $connection->conn, $id);

        // Check if a result was found
        if ($row) {
            // Assign values to variables
            $gender = $row["gender"];
            $cin = $row["cin"];
            $firstname = $row["firstname"];
            $lastname = $row["lastname"];
            $date_birth = $row["date_birth"];
            $place_birth = $row["place_birth"];
            $address = $row["address"];
            $city = $row["city"];
            $phone = $row["phone"];
            $a_firstname = $row["a_firstname"];
            $a_lastname = $row["a_lastname"];
            $a_place_birth = $row["a_place_birth"];
            $a_address = $row["a_address"];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"/>
    <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <title>dashboard</title>
  </head>
  <body>
    <!-- top navigation bar -->
    <?php include("model.php"); ?>
    <!-- offcanvas -->
    <main class="mt-5 pt-3">
      <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
        <div>
        </div>
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="card">
              <div class="card-header">
                <span><i class="bi bi-table me-2"></i></span> modifier Candidat
              </div>
              <div class="card-body">
              <?php
              if(!empty($errorMesage)){
              echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
              <strong>$errorMesage</strong>
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
              </button>
              </div>";
              }
              if(!empty($successMesage)){
              echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
              <strong>$successMesage</strong>
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
              </button>
              </div>";
                          }
                ?>
              <form method="GET" action="add_student1.php">
              <div class="container">
                <div class="row">
                    <div class="col">
                        <label class="form-check-label mt-4"><input class="form-check-input" type="radio" name="gender" value="masculin" <?php if($gender == "masculin") { echo 'checked'; }?>> Masculin</label>
                        <label class="form-check-label mt-4"><input class="form-check-input" type="radio" name="gender" value="feminin"  <?php if($gender == "feminin") { echo 'checked'; } ?>> Féminin</label>
                    </div>
                    <div class="col">
                    
                    </div>
                    <div class="col">
                        <label for="exampleInputEmail1" class="form-label">C.I.N :</label>
                        <input type="text" class="form-control h-50" id="exampleInputEmail1" aria-describedby="emailHelp" name="cin" value="<?php echo $cin ?>">
                    </div>
                    <div class="col"></div>
                    <div class="col"></div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">Prenom :</label>
                            <input type="text" class="form-control h-50" id="exampleInputEmail1" aria-describedby="emailHelp" name="firstname" value="<?php echo $firstname ?>">
                        </div>
                        <div class="col"></div>
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label float-end">: الإسم الشخصي</label>
                            <input type="text" class="form-control h-50" id="exampleInputEmail1" aria-describedby="emailHelp" name="a_firstname" value="<?php echo $a_firstname ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">Nom :</label>
                            <input type="text" class="form-control h-50" id="exampleInputEmail1" aria-describedby="emailHelp" name="lastname" value="<?php echo $lastname ?>">
                        </div>
                        <div class="col"></div>
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label float-end">: الإسم العائلي</label>
                            <input type="text" class="form-control h-50" id="exampleInputEmail1" aria-describedby="emailHelp" name="a_lastname" value="<?php echo $a_lastname ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">Date de naissance :</label>
                            <input type="date" class="form-control h-50" id="exampleInputEmail1" aria-describedby="emailHelp" name="date_birth" value="<?php echo $date_birth ?>">
                        </div>
                        <div class="col"></div>
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">Lieu de naissance :</label>
                            <input type="text" class="form-control h-50" id="exampleInputEmail1" aria-describedby="emailHelp" name="place_birth" value="<?php echo $place_birth ?>">
                        </div>
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label float-end">: مكان الإزدياد</label>
                            <input type="text" class="form-control h-50" id="exampleInputEmail1" aria-describedby="emailHelp" name="a_place_birth" value="<?php echo $a_place_birth ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">Adresse :</label>
                            <input type="text" class="form-control h-50" id="exampleInputEmail1" aria-describedby="emailHelp" name="address" value="<?php echo $address ?>">
                        </div>
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label float-end">: العنوان</label>
                            <input type="text" class="form-control h-50" id="exampleInputEmail1" aria-describedby="emailHelp" name="a_address" value="<?php echo $a_address ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <label for="exampleInputEmail1" class="form-label">Ville :</label>
                            <input type="text" class="form-control h-50" id="exampleInputEmail1" aria-describedby="emailHelp" name="city" value="<?php echo $city ?>">
                        </div>
                        <div class="col"></div>
                        <div class="col"><label for="exampleInputEmail1" class="form-label">Telephone GSM :</label>
                            <input type="text" class="form-control h-50" id="exampleInputEmail1" aria-describedby="emailHelp" name="phone" value="<?php echo $phone ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <button type="submit" name="update_student" class="btn btn-primary mt-5">Inserer</button>
                      </div>
                      <div class="col"></div>
                      <div class="col"></div>
                      <div class="col"></div>
                    </div>
                </div>
              </div>
            </form>
            </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="./js/jquery-3.5.1.js"></script>
    <script src="./js/jquery.dataTables.min.js"></script>
    <script src="./js/dataTables.bootstrap5.min.js"></script>
    <script src="./js/script.js"></script>
  </body>
</html>
