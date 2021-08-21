<?php
include 'connect.php';
$username = "";
session_start();
if(!isset($_SESSION['alogin'])){
  header("Location:Admin.php");
}else{
    $username = $_SESSION['alogin'];
}
$id = $_GET['id'];
$stmt1 = $conn->prepare('SELECT * FROM tblemployees WHERE id=?');
$stmt1->execute([$_GET['id']]);
$emp = $stmt1->fetch();

//print_r($emp);

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
        <title>Update Employee</title>
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
                padding:2px
               
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
                height:556px
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
                padding:20px;
                color:#000;
                text-transform: uppercase;
                font-size:17px;
                padding-bottom:10px

            }

            form{
                background-color:#fff;
                margin:20px;
                padding-bottom:65px
            }
            .update{
                color:green;
                padding-top:30px;
                padding-left:15px;
                padding-bottom:50px
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
               <li><a href="change-password.php"style="color:black"><i class="material-icons">settings_input_svideo</i>Change Password</a></li>
               <li><a href="logout.php" style="color:black"><i class="material-icons">exit_to_app</i>Log Out</a></li>
           </ul>
       </div>
       <div class="body">
           <h3>Update Employee</h3>
         <form action="update-emp.php" method="POST"> 
         <h1 class="update">Update Employee Details</h1>
         <input hidden name="id" value="<?php echo $id ?>">
             <input type="text" name="empid" value="<?php echo $emp['EmpId']; ?>" style="border:none;padding:10px;margin-left:25px;outline:none;border-bottom:1px solid gray;width:40%;margin-bottom:15px">
            <select name="gender" id="gender" style="border:none;font-size:15px;background-color:#fff;border-bottom:1px solid gray;padding:12px;margin-left:25px;margin-bottom:15px;width:20%">
                <option value="male" <?php if($emp['Gender'] == 'male') {echo "selected";}?>>Male</option>
                <option value="female" <?php if($emp['Gender'] == 'female') {echo "selected";}?>>Female</option>
            </select>
             <input type="date" name="dob" value="<?php echo $emp['Dob']; ?>" style="border:none;border-bottom:50px;padding:10px;outline:none;border-bottom:1px solid gray;margin-left:20px;width:25%;margin-bottom:15px"><br><br>
             <input type="text" name="FirstName" value="<?php echo $emp['FirstName']; ?>" style="border:none;border-bottom:50%;padding:10px;outline:none;border-bottom:1px solid gray;margin-left:25px;margin-bottom:15px">
             <input type="text" name="LastName" value="<?php echo $emp['LastName']; ?>" style="border:none;outline:none;padding-right:20px;border-bottom:1px solid gray;margin-left:25px;padding:10px;margin-bottom:15px" >
             <select name="department" id="department" style="border:none;font-size:15px;background-color:#fff;border-bottom:1px solid gray;padding:12px;margin-left:25px;margin-bottom:15px;width:20%">
                <option value="Information Technology" <?php if($emp['Department'] == 'Information Technology') {echo "selected";}?>>Information Technology</option>
                <option value="Human Resource" <?php if($emp['Department'] == 'Human Resource') {echo "selected";}?>>Human Resource</option>
                <option value="Operation" <?php if($emp['Department'] == 'Operation') {echo "selected";}?>>Operation</option>
   
             </select>
             <input type="text" name="country" value="<?php echo $emp['Country']; ?>" style="border:none;padding:10px;outline:none;border-bottom:1px solid gray;margin-left:20px;margin-bottom:15px;width:25%">
             <input type="text" name="email" value="<?php echo $emp['EmailId']; ?>" style="border:none;padding:10px;outline:none;border-bottom:1px solid gray;margin-left:25px;margin-top:20px;width:40%;margin-bottom:15px">
             <input type="text" name="city" value="<?php echo $emp['City']; ?>" style="border:none;padding:10px;outline:none;border-bottom:1px solid gray;margin-left:20px;margin-top:20px;margin-bottom:15px;width:20%">
             <input type="text" name="address" value="<?php echo $emp['Address']; ?>" style="border:none;padding:10px;outline:none;border-bottom:1px solid gray;margin-left:20px;margin-top:20px;margin-bottom:15px;width:25%"><br>
             <input type="text" name="phone" value="<?php echo $emp['Phonenumber']; ?>" style="border:none;padding:8px;outline:none;border-bottom:1px solid gray;margin-left:20px;margin-top:20px;margin-bottom:15px;width:46%">
             <button type="submit" name="update" style="background-color:green;padding:10px;color:#fff;margin-left:20px;width:80px;border:none">UPDATE</button>
    </body>
</html> 