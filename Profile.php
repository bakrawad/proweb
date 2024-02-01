<?php
global $pdo;
include 'dbconfig.in.php';
include 'Student.php';
session_start();
$students = [];
$studentId = isset($_GET['id']) ? $_GET['id'] : null;
if ($studentId) {
    $stmt = $pdo->query("SELECT * FROM student WHERE id = $studentId");
    $data = $stmt->fetchAll();


}
?>
<!DOCTYPE html>
<html lang="">
<head>
    <title>Profile</title>
    <?php
    echo '<fieldset style="width: 600px;">';
    echo '<img src="' .'http://localhost/Ass3/'. $students[0]->photo . '" alt="Student img" width="64" height="64"/>';
    echo '<h2> Student ID: ' .$students[0]->id. ' ,'.'Name: '.$students[0]->name.'</h2>';
    echo '<ul>';
    echo '<li><b>Average: </b>'.$students[0]->avg.'</li>';
    echo '<li><b>Department: </b>'.$students[0]->department.'</li>';
    echo '<li><b>Date of birth: </b>'.$students[0]->dob.'</li>';
    echo '</ul>';
    echo '<h3> Contact </h3>';
    echo '<label> <a href="">'.'Send Email to: '.$students[0]->email.'</a></label>';
    echo '<br>';
    echo '<br>';
    echo '<label> <a href="">'.'Tel: '.$students[0]->phone.'</a></label>';
    echo '<br>';
    echo '<br>';
    echo '<label> Address: '.$students[0]->address,','.$students[0]->country.'</label>';
    echo '<br>';
    echo '</fieldset>';
    ?>

</head>
<body id="home">


</body>
</html>