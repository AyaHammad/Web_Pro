<?php
include 'connect.php';
    if(isset($_POST['update'])){
        $leave_id = $_POST['leave_id'];
        $status = $_POST['status'];
        $description = $_POST['description'];
        
        $stmt3 = $conn->prepare("UPDATE tblleaves SET Status=?, Description=? WHERE id=?");
        $stmt3->execute([$status,$description,$leave_id]);
        //$stmt3->rowCount();
        header("Location: leave-details.php?leaveid=$leave_id");
    }
?>