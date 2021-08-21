<?php
include 'connect.php';
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $empid = $_POST['empid'];
    $email = $_POST['email'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $phone = $_POST['phone'];
    $FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $Gender = $_POST['gender'];
    $Address = $_POST['address'];
    $Department = $_POST['department'];
    $RegDate = date("Y-m-d");
    $Status = 0;
    $dob = $_POST['dob'];   

    $stmt2 = $conn->prepare('UPDATE tblemployees SET EmpId=?, EmailId=?, FirstName=?, LastName=?, Department=?, Gender=?, Dob=?, Address=?, City=?, Country=?, Phonenumber=? WHERE id=?');
    $stmt2->execute([$empid,$email,$FirstName,$LastName,$Department,$Gender,$dob,$address,$city,$country,$phone,$id]);

    header("Location: manage.php");
}
?>