<?php 
error_reporting(E_ERROR | E_PARSE);
  //include connection file
  include('connection.php');
  include('controller/class_dossier.php');
  include('controller/class_student.php');
// database connection

$connection = new Connection();
$connection->selectDatabase('gestion_ae_v1');
$student_exist = Student::selectStudentById('student',$connection->conn,$_GET['cin']);

$dossier_exist = Dossier::selectdossierById('dossier',$connection->conn,$_GET['cin']);
  if(!$student_exist){
    $errorMesage = "Dossier is not exist in student table";
  }
    $cin = "";
    $category = "";
    $price = "";
    $ref = "";
$errorMesage = "";
$successMesage = "";
if(isset($_POST["add_dossier"])){
  $student_id = $student_exist['id'];
  $category = $_POST['category'];
  $price = $_POST['price'];
  $ref = $_POST['ref'];
    
    if($dossier_exist){
      $errorMesage = "Dossier is already exist !";
    }elseif(empty($category) || empty($price) || empty($ref)){

            $errorMesage = "all fileds must be filed out!";
    }else{
    //create new instance of client class with the values of the inputs
    $dossier = new Dossier($category,$price,$ref,$student_id);
  //call the insertClient method
    $dossier->insertdossier('dossier',$connection->conn);

  //give the $successMesage the value of the static $successMsg of the class
    $successMesage = Dossier::$successMsg;

  //give the $errorMesage the value of the static $errorMsg of the class
    $errorMesage = Dossier::$errorMsg;
    $category = "";
    $price = "";
    $ref = "";
       
        
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
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
    />
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
                        <label for="exampleInputEmail1" class="form-label">dossier pour :</label>
                        <input type="text" class="form-control h-50" id="exampleInputEmail1" aria-describedby="emailHelp" name="cin" value = "<?php if(isset($_GET['cin'])){echo $_GET['cin'];}else{echo"";} ?>" disabled>
                    </div>
                    <div class="col"></div>
                    <div class="col"></div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">Categorie demandé :</label>
                            <select name="category" class="form-select">
                                <option value=""></option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="EC">EC</option>
                            </select>
                        </div>
                        <div class="col"></div>
                        <div class="col"></div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">Prix :</label>
                            <input type="text" class="form-control h-50" id="exampleInputEmail1" aria-describedby="emailHelp" name="price">
                        </div>
                        <div class="col"></div>
                        <div class="col"></div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">N'inscription :</label>
                            <input type="text" class="form-control h-50" id="exampleInputEmail1" aria-describedby="emailHelp" name="ref">
                        </div>
                        <div class="col"></div>
                        <div class="col"></div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <button type="submit" name="add_dossier" class="btn btn-primary mt-5">Ajouter</button>
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
