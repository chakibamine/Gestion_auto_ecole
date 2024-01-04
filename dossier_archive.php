<?php
error_reporting(E_ERROR | E_PARSE);
 include('connection.php');
 include('controller/class_dossier.php');
 include('controller/class_student.php');
 include('controller/class_exam.php');
// database connection
$connection = new Connection();
$connection->selectDatabase('gestion_ae_v1');
$dossier = Dossier::selectAlldossierarchive('dossier',$connection->conn);



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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
  </head>
  <body>
    <!-- top navigation bar -->
    <?php include("model.php"); ?>
    <!-- offcanvas -->
    <main class="mt-5 pt-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <h4>Dashboard</h4>
          </div>
        </div>
        <div class="row">
        <?php
              if (isset($_GET["msg"])) {
                $msg = $_GET["msg"];
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                ' . $msg . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
              }
              ?>
          <div class="col-md-3 mb-3">
            <div class="card bg-primary text-white h-100">
              <div class="card-body py-5">Primary Card</div>
              <div class="card-footer d-flex">
                View Details
                <span class="ms-auto">
                <a href="your_link_here" class="text-white"><i class="bi bi-chevron-right"></i></a>
                </span>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <div class="card bg-warning text-dark h-100">
              <div class="card-body py-5">Warning Card</div>
              <div class="card-footer d-flex">
                View Details
                <span class="ms-auto">
                  <i class="bi bi-chevron-right"></i>
                </span>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <div class="card bg-success text-white h-100">
              <div class="card-body py-5">Success Card</div>
              <div class="card-footer d-flex">
                View Details
                <span class="ms-auto">
                  <i class="bi bi-chevron-right"></i>
                </span>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <div class="card bg-danger text-white h-100">
              <div class="card-body py-5">Danger Card</div>
              <div class="card-footer d-flex">
                View Details
                <span class="ms-auto">
                  <i class="bi bi-chevron-right"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="card">
              <div class="card-header">
                <span><i class="bi bi-table me-2"></i></span> Data Table
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table
                    id="myTable"
                    class="table table-striped data-table"
                    style="width: 100%">
                    <thead>
                      <tr>
                        <th>N'web</th>
                        <th>CIN</th>
                        <th>Nom et prénom</th>
                        <th>phone</th>
                        <th>permit</th>
                        <th>date d'inscription</th>
                        <th>date de cloture</th>
                        <th>action</th>
                      </tr>
                    </thead>
                    <?php
                    
                        foreach($dossier as $row) {
                          $stu = Student::selectStudentById1('student',$connection->conn,$row['student_id']);
                          //$exam_row = Exam::selectExamById('exam',$connection->conn,$row['cin'],$row['ref']);
                          echo " <tr>
                            <td>$row[ref]</td>
                            <td>$stu[cin]</td>
                            <td>$stu[lastname] $stu[firstname]</td>
                            <td>$stu[phone]</td>
                            <td>$row[category]</td>
                            <td>$row[date_inscription]</td>
                            <td>$exam_row[date_insertion]</td>
                            <td>
                            <a class ='btn btn-outline-success btn-sm p-0 border border-0 fa-lg dossinfo_reg' data-cin='". $row["id"] ."'><i class='bi bi-cash-stack'></i></a>
                            <a class ='btn btn-outline-primary btn-sm p-0 border border-0 dossinfo_exam fa-lg' data-cin='". $row["id"] ."'><i class='bi bi-card-checklist'></i></a>
                            </td>
                            </tr>";
                        }
                    ?>        
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="staticBackdrop_reg" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Ajouter un reglement</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  
              </div>
              </div>
          </div>
          </div>
    
    

      <div class="modal fade" id="staticBackdrop_exam" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Ajouter un Examen</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  
              </div>
              
              </div>
          </div>
          </div>
        </main>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="./js/jquery-3.5.1.js"></script>
    <script src="./js/jquery.dataTables.min.js"></script>
    <script src="./js/dataTables.bootstrap5.min.js"></script>
    <script src="./js/script.js"></script>
    
    <script type='text/javascript'>
            $(document).ready(function(){
                $('.dossinfo_reg').click(function(){
                  var dosscin = $(this).data("cin");
                  $.ajax({
                        url: 'reglement_modal.php',
                        type: 'GET',
                        data: {dosscin: dosscin},
                        success: function(response){ 
                            $('.modal-body').html(response); 
                            $('#staticBackdrop_reg').modal('show'); 
                        }
                    });
                });
              });
            $(document).ready(function(){
              $('.dossinfo_exam').click(function(){
                  var dosscin = $(this).data("cin");
                  $.ajax({
                        url: 'examen_modal.php',
                        type: 'GET',
                        data: {dosscin: dosscin},
                        success: function(response){ 
                            $('.modal-body').html(response); 
                            $('#staticBackdrop_exam').modal('show'); 
                        }
                    });
                });
              });
    </script>
    
  </body>
</html>




