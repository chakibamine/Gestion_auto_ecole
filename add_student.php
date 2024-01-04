<?php
error_reporting(E_ERROR | E_PARSE);
//include connection file
include('connection.php');
include('controller/class_student.php');
//create in instance of class Connection
$connection = new Connection();
$connection->selectDatabase('gestion_ae_v1');



    $cin = "";
    $firstname = "";
    $lastname = "";
    $date_birth = "";
    $place_birth = "";
    $address = "";
    $city = "";
    $phone = "";
    $a_firstname = "";
    $a_lastname = "";
    $a_place_birth = "";
    $a_address = "";
$errorMesage = "";
$successMesage = "";
if(isset($_POST["add_student"])){

    $gender = $_POST["gender"];
    $cin = strtoupper($_POST["cin"]);
    $firstname = $_POST["fname"];
    $lastname = $_POST["lname"];
    $date_birth = $_POST["date_birth"];
    $place_birth = $_POST["place_birth"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $phone = $_POST["phone"];
    $a_firstname = $_POST["a_fname"];
    $a_lastname = $_POST["a_lname"];
    $a_place_birth = $_POST["a_place_birth"];
    $a_address = $_POST["a_address"];

    if(empty($cin) || empty($firstname) || empty($lastname) || empty($date_birth)){

            $errorMesage = "all fileds must be filed out!";
    }else{
      if (preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $date_birth)) {

        $date_birth = DateTime::createFromFormat('m/d/Y', $date_birth);
        
        if ($date_birth !== false) {
            // Format and print the date
            $date_birth = $date_birth->format('Y-m-d');
        }
    }
    //create new instance of client class with the values of the inputs
  $student = new Student($gender,$cin,$firstname,$lastname,$date_birth,$place_birth,$address,$city,$phone,$a_firstname,$a_lastname,$a_place_birth,$a_address);
//call the insertClient method
  $student->insertStudent('student',$connection->conn);

//give the $successMesage the value of the static $successMsg of the class
$successMesage = Student::$successMsg;

//give the $errorMesage the value of the static $errorMsg of the class
$errorMesage = Student::$errorMsg;

    $cin = "";
    $firstname = "";
    $lastname = "";
    $date_birth = "";
    $place_birth = "";
    $address = "";
    $city = "";
    $phone = "";
    $a_firstname = "";
    $a_lastname = "";
    $a_place_birth = "";
    $a_address = "";  
      
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
                <span><i class="bi bi-table me-2"></i></span> new Candidat
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
              <form method="POST" action="">
              <div class="container">
                <div class="row">
                    <div class="col">
                        <label class="form-check-label mt-4"><input class="form-check-input" type="radio" name="gender" value="masculin"> Masculin</label>
                        <label class="form-check-label mt-4"><input class="form-check-input" type="radio" name="gender" value="feminin"> Féminin</label>
                    </div>
                    <div class="col">
                    
                    </div>
                    <div class="col">
                        <label for="exampleInputEmail1" class="form-label">C.I.N :</label>
                        <input type="text" class="form-control h-50" id="exampleInputEmail1" aria-describedby="emailHelp" name="cin">
                    </div>
                    <div class="col"></div>
                    <div class="col"></div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">Prenom :</label>
                            <input type="text" class="form-control h-50" id="exampleInputEmail1" aria-describedby="emailHelp" name="fname">
                        </div>
                        <div class="col"></div>
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label float-end">: الإسم الشخصي</label>
                            <input type="text" class="form-control h-50" id="exampleInputEmail1" aria-describedby="emailHelp" name="a_fname">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">Nom :</label>
                            <input type="text" class="form-control h-50" id="exampleInputEmail1" aria-describedby="emailHelp" name="lname">
                        </div>
                        <div class="col"></div>
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label float-end">: الإسم العائلي</label>
                            <input type="text" class="form-control h-50" id="exampleInputEmail1" aria-describedby="emailHelp" name="a_lname">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">Date de naissance :</label>
                            <input type="date" class="form-control h-50" id="exampleInputEmail1" aria-describedby="emailHelp" name="date_birth">
                        </div>
                        <div class="col"></div>
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">Lieu de naissance :</label>
                            <input type="text" class="form-control h-50" id="exampleInputEmail1" aria-describedby="emailHelp" name="place_birth">
                        </div>
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label float-end">: مكان الإزدياد</label>
                            <input type="text" class="form-control h-50" id="exampleInputEmail1" aria-describedby="emailHelp" name="a_place_birth">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">Adresse :</label>
                            <input type="text" class="form-control h-50" id="exampleInputEmail1" aria-describedby="emailHelp" name="address">
                        </div>
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label float-end">: العنوان</label>
                            <input type="text" class="form-control h-50" id="exampleInputEmail1" aria-describedby="emailHelp" name="a_address">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <label for="exampleInputEmail1" class="form-label">Ville :</label>
                            <input type="text" class="form-control h-50" id="exampleInputEmail1" aria-describedby="emailHelp" name="city">
                        </div>
                        <div class="col"></div>
                        <div class="col"><label for="exampleInputEmail1" class="form-label">Telephone GSM :</label>
                            <input type="text" class="form-control h-50" id="exampleInputEmail1" aria-describedby="emailHelp" name="phone">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <button type="submit" name="add_student" class="btn btn-primary mt-5">Inserer</button>
                        <a href="dossier_table.php" class="btn btn-outline-primary mt-5 ml-2">Cancel</a>
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
