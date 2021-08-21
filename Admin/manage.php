<?php
include 'connect.php';
session_start();
$username = "";
if(!isset($_SESSION['alogin'])){
  header("Location:Admin.php");
}else{
    $username = $_SESSION['alogin'];
}
$i=0;

/*********fetch all emps */
$stmt = $conn->prepare("SELECT * FROM tblemployees");
$stmt->execute();
$employees = $stmt->fetchAll();
/************************ */
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    

    <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>  <link  rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
        <title>Manage Employee</title>
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
                padding:30px;
                color:green;
                text-transform: uppercase;
                font-size:17px;
                padding-bottom:5px;
                font-weight: bold;
            }

            form{
                background-color:#fff;
                margin:25px;
                padding-bottom:70px;
            }
            th{
              color:red
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
           <h3>Manage Employee</h3>
         <form> 
             <h4 style="color:gray;font-weight:normal;padding-top:30px;padding-left:10px;font-size:15px">Show</h4>
             <select name="numbers" id="numbers" style="padding:10px;margin-left:20px">
                 <option value="10">10</option>
                 <option value="9">9</option>
                 <option value="8">8</option>
                 <option value="7">7</option>
                 <option value="6">6</option>
                 <option value="5">5</option>
                 <option value="4">4</option>
                 <option value="3">3</option>
                 <option value="2">2</option>
                 <option value="1">1</option>
             </select>

             <input type="text" name="text" placeholder="Search records" style="border:none;border-bottom:1px solid gray;padding-bottom:10px;width:30%;;margin-left:60%;outline:none"> 

             <table class="table" style="width:95%;margin-left:20px;margin-top:20px" class="table">
          <thead>
        <tr>
      <th scope="col">SI no</th>
      <th scope="col">Emp Id</th>
      <th scope="col">Emp Name</th>
      <th scope="col">Department</th>
      <th scope="col">Status</th>
      <th scope="col">Reg Date</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($employees as $emp) { $i++?>
    <tr>
      <td><?php echo $i?></td>
      <td><?php echo $emp['EmpId']; ?></td>
      <td><?php echo $emp['FirstName'] . ' ' . $emp['LastName']; ?></td>
      <td><?php echo $emp['Department']; ?></td>
      <td><?php  
      if($emp['Status']==0){
        ?> <span style="color: green">Active</span>
        <?php }
        if($emp['Status']==1){ ?>
            <span style="color: red">Not Active</span>
              <?php }?></td>
      <td><?php echo $emp['RegDate']; ?></td>
      <td>
      <a href="edit-emp.php?id=<?php echo $emp['id']; ?>" ><i class="material-icons" style="color:blue">edit</i></a>
      <a href="delete-emp.php?id=<?php echo $emp['id']; ?>" onclick="return confirm('Are you sure?')" <i class="material-icons" style="color:blue;vertical-align:middle">close</i></a>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>
         </form>

         
       </div>
      
    </body>
</html>
