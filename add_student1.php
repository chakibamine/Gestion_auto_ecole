<?
      
    include('connection.php');
    include('controller/class_student.php');

    // database connection
    $connection = new Connection();
    $connection->selectDatabase('gestion_ae_v1');
    // Retrieve form data
    $gender = $_GET["gender"];
    $cin = $_GET["cin"];
    $firstname = $_GET["firstname"];
    $lastname = $_GET["lastname"];
    $date_birth = $_GET["date_birth"];
    $place_birth = $_GET["place_birth"];
    $address = $_GET["address"];
    $city = $_GET["city"];
    $phone = $_GET["phone"];
    $a_firstname = $_GET["a_firstname"];
    $a_lastname = $_GET["a_lastname"];
    $a_place_birth = $_GET["a_place_birth"];
    $a_address = $_GET["a_address"];

    // Validate CIN field
    if (empty($cin)) {
        $errorMessage = "CIN field must be filled out!";
    } else {
        // Validate and format date

        // Create a new instance of the Student class with input values
        $student = new Student($gender, $cin, $firstname, $lastname, $date_birth, $place_birth, $address, $city, $phone, $a_firstname, $a_lastname, $a_place_birth, $a_address);

        // Call the static updateStudent method and provide $student and other parameters
        Student::updateStudent($student, 'student', $connection->conn, $_GET["cin"]);

        // Display success message
        $successMessage = "Student information updated successfully!";
    }


?>