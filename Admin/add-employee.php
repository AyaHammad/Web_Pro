<?php
include 'connect.php';
session_start();
if(!isset($_SESSION['alogin'])){
  header("Location:Admin.php");
}
try{
if(isset($_POST['add'])){

    $address = md5($_POST['address']);
    $Password = md5($_POST['password']);
    $city = $_POST["city"];
    $LastName = $_POST["LastName"];
    $FirstName = $_POST["FirstName"];
    $phone = $_POST["phone"];
    $country = $_POST["country"];    
    $email = $_POST["email"];
    $empid = $_POST["empid"];
    $Gender = $_POST['gender'];
    $Department = $_POST['department'];
    $RegDate = date("Y-m-d");
    $Status = 0;
    $dob = $_POST['dob'];

        $sql = "INSERT INTO tblemployees (EmpId, FirstName, LastName, EmailId, Password, Gender, Dob, Department, Address, City, Country, Phonenumber, Status, RegDate) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt= $conn->prepare($sql);
        $stmt->execute([$empid, $FirstName, $LastName, $email, $Password, $Gender, $dob, $Department, $address, $city, $country, $phone, $Status, $RegDate]);
        echo "<script>alert('Employee record added Successfully')</script>";
       // header("Location: add-employee.php");
        
    }

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }





?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>  <link  rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
        <title>Add Employee</title>
        <style>

            *{
                margin:0;
                padding:0;
                box-sizing:border-box
            }

            body{
                background-color: lavender;
               
            }
            .emp{
                background-color:deepskyblue;
                padding:2px;
               
            }
            .h1{
                color:#fff;
                text-align:center;
                font-family:Arial, Helvetica, sans-serif;
                font-size:30px;
                font-weight: bold;
            
            }
             
             .add{
                margin-top:20px;
                margin-left:16px;
                width: 20%;
                background-color:lightblue;
                padding:20px;
                margin:0;
                height:556px;
             }
            img{
                width:50px;
                margin:15px;
                min-width:1px!important;
                line-height:1.5;
                border-radius:100%;
                height:50px;
            }

            h4{
                font-weight: bold;
                margin-left:10px
            }

            ul{
                margin-top:50px;
                list-style:none;
                padding:5px
            }
            li{
                padding-bottom:30px
            }

            i{
                padding-right:15px;
                color:black;
                vertical-align:middle

            }

            a{
                color:black;
            }

            .body{
                margin-left:21%;
                margin-top:-569px;
            }

            h3{
                padding-left:20px;
                color:green;
                text-transform: uppercase;
                font-size:17px;
                font-weight: bold;
            }

            form{
                background-color:#fff;
                padding-top:80px;
                margin:20px;
                padding-bottom:60px
            }
            </style>
    </head>
    <body>
       <div class="emp">
         <h1 class="h1">Employee Leave Managment System</h1>
       </div>

       <div class="add">
           <img src="admin.jpg" alt="admin">
           <h4>Admin</h4>

           <ul>
               <li><a href="dashboard.php" style="color:black"><i class="material-icons">settings_input_svideo</i>Dashboard</a></li>
              <div class="dropdown"> <i class="material-icons">account_box</i>
    <button class="dropdown-toggle"  style="background-color:lightblue;border:none;padding-bottom:30px;font-size:15px" type="button" data-toggle="dropdown">Employees
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li><a href="add-employee.php">Add Employee</a></li>
      <li><a href="manage.php">Manage Employee</a></li>
    </ul>
  </div>
  <div class="dropdown"> <i class="material-icons">computer</i>
    <button class="dropdown-toggle"  style="background-color:lightblue;border:none;padding-bottom:30px;font-size:15px" type="button" data-toggle="dropdown">Leave Managment
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li><a href="leave-history.php">All leaves</a></li>
    </ul>
  </div>
               <li><a href="change-password.php" style="color:black"><i class="material-icons">settings_input_svideo</i>Change Password</a></li>
               <li><a href="logout.php" style="color:black"><i class="material-icons">exit_to_app</i>Log Out</a></li>
           </ul>
       </div>
       <div class="body">
           <h3>Add Employee</h3>
         <form action="add-employee.php" method="POST"> 
             <input type="text" name="empid" placeholder="Employee Code(Must be unique)"style="border:none;padding:10px;margin-left:25px;outline:none;border-bottom:1px solid gray;width:40%;margin-bottom:15px" required>
            <select name="gender" id="gender" style="border:none;font-size:15px;background-color:#fff;border-bottom:1px solid gray;padding:12px;margin-left:25px;margin-bottom:15px;width:20%">
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
             <input type="date" name="dob" placeholder="Birthdate" style="border:none;border-bottom:50px;padding:10px;outline:none;border-bottom:1px solid gray;margin-left:20px;width:25%;margin-bottom:15px" required><br><br>
             <input type="text" name="FirstName" placeholder="First name" style="border:none;border-bottom:50%;padding:10px;outline:none;border-bottom:1px solid gray;margin-left:25px;margin-bottom:15px" required>
             <input type="text" name="LastName" placeholder="Last name" style="border:none;outline:none;padding-right:20px;border-bottom:1px solid gray;margin-left:25px;padding:10px;margin-bottom:15px"required >
             <select name="department" id="department" style="border:none;font-size:15px;background-color:#fff;border-bottom:1px solid gray;padding:12px;margin-left:25px;margin-bottom:15px;width:20%">
                <option value="Information Technology">Information Technology</option>
                <option value="Engineering">Human Resource</option>
                <option value="Operation">Operation</option>
   
             </select>
             <input type="text" name="country" placeholder="Country" style="border:none;padding:10px;outline:none;border-bottom:1px solid gray;margin-left:20px;margin-bottom:15px;width:25%" required>
             <input type="text" name="email" placeholder="Email" style="border:none;padding:10px;outline:none;border-bottom:1px solid gray;margin-left:25px;margin-top:20px;width:40%;margin-bottom:15px" required>
             <input type="text" name="city" placeholder="City/Town" style="border:none;padding:10px;outline:none;border-bottom:1px solid gray;margin-left:20px;margin-top:20px;margin-bottom:15px;width:20%" required>
             <input type="text" name="address" placeholder="Address" style="border:none;padding:10px;outline:none;border-bottom:1px solid gray;margin-left:20px;margin-top:20px;margin-bottom:15px;width:25%" required>
             <input type="password" name="password" placeholder="Password" style="border:none;padding:10px;outline:none;border-bottom:1px solid gray;margin-left:25px;margin-top:20px;width:40%;margin-bottom:15px" required>
             <input type="text" name="phone" placeholder="Mobile number" style="border:none;padding:8px;outline:none;border-bottom:1px solid gray;margin-left:20px;margin-top:20px;margin-bottom:15px;width:40%" required>
             <input type="password" name="password" placeholder="Confirm password" style="border:none;padding:10px;outline:none;border-bottom:1px solid gray;margin-left:25px;margin-top:20px;width:40%" required>
             <button type="submit" name="add" style="background-color:green;padding:10px;color:#fff;margin-left:20px;width:80px;border:none">ADD</button>
    </body>
</html>