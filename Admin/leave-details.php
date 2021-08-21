<?php
 include 'connect.php';
 session_start();
 if(!isset($_SESSION['alogin'])){
  header("Location:Admin.php");
}else{
    $username = $_SESSION['alogin'];
}
 $leave_id = $_GET['leaveid'];
 $stmt = $conn->prepare('SELECT * FROM tblleaves WHERE id=?');
 $stmt->execute([$leave_id]);
 $leave = $stmt->fetch();

 $stmt2 = $conn->prepare('SELECT * FROM tblemployees WHERE id=?');
 $stmt2->execute([$leave['empid']]);
 $emp = $stmt2->fetch();
 
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
        <title>Leave details</title>
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
               <li><a href="logout.php" style="color:black"><i class="material-icons" >exit_to_app</i>Log Out</a></li>
           </ul>
       </div>

<main class="mn-inner">
    <div style="color:black;padding:30px;margin-left:21%;font-size:20px;margin-top:-560px">LEAVE DETAILS</div>
    <div class="page-title" style="background-color:white;height:492px;margin-left:23%;margin-right:3%;margin-top:-20px" >
    <div style="padding:17px;">LEAVE DETAILS</div>
    <br>

     <table style="width:90%;margin-left:4%" class="table">
    <tr>
    <th style="padding-left:2px;width:auto;">
    <b><label style="color: black;padding-left:5px;">Employee Name:</label></b>
          <input style="margin-right:2px;border:none;padding-right:5px;width:190px;color:blue;font-weight:normal" type="text" value="<?php echo $emp['FirstName'] . ' ' . $emp['LastName']; ?>">
    <b><label style="color: black;padding-left:5px">Emp Id:</label></b>
          <input style="margin-right:2px;border:none;padding-right:5px;width:190px;font-weight:normal" type="text" value="<?php echo $emp['EmpId']; ?>">
    <b><label style="color:black;padding-left:70px;">Gender:</label></b>
          <input style="margin-right:2px;border:none; font-weight:normal" type="text" value="<?php echo $emp['Gender']; ?>">
          <br><br>
    </th>
    </tr>

    <tr>
    <th style="padding-left:2px;width:80%;">
    <b><label style="color: black;padding-left:30px;padding-left:2px;">Emp Email Id:</label></b>
          <input style="margin-right:20px;border:none;padding-right:10px;font-weight:normal" type="text" name="email" value="<?php echo $emp['EmailId']; ?>">
    <b><label style="color: black; padding-left:10px;padding-left:15px">Emp Contact No:</label></b>
          <input style="margin-right:15px;border:none;padding-right:10px;font-weight:normal" type="text" value="<?php echo $emp['Phonenumber']; ?>">
    <br><br>
    </th>
    </tr>

    <tr>
    <th style="padding-left:2px;width:80%;">
    <b><label style="color: black;padding-left:30px;padding-left:2px;">Leave Type:</label></b>
          <input style="margin-right:7px;border:none;padding-right:10px;width:190px;font-weight:normal" type="text" value="<?php echo $leave['LeaveType'];?>">
    <b><label style="color: black; padding-left:10px;padding-left:35px">Leave Date:</label></b>
          <input style="margin-right:7px;border:none;padding-right:5px;width:210px;font-weight:normal" type="text" value= "<?php echo "from" . " " . $leave['FromDate'] . " "; echo "to" . " " .$leave['ToDate'];?>">
    <b><label style="color: black;padding-left:20px">Posting Date:</label></b>
          <input style="margin-right:7px;border:none;padding-right:10px;width:150px;font-weight:normal" type="text" value="<?php echo $leave['PostingDate'];?>">
          <br><br>
    </th>
    </tr>

     <tr>
    <th style="padding-left:2px;width:80%;">
    <b><label style="color: black;padding-left:15px;padding-left:2px;">Employee Leave Descrition:</label></b>
          <input style="margin-right:7px;border:none;padding-right:10px;font-weight:normal" type="text" value="<?php echo $leave['Description'];?>">
          <br><br>
    </th>
    </tr>

    <tr>
    <th style="padding-left:2px;width:80%;">
    <b><label style="color: black;padding-left:15px;padding-left:2px;">Leave Stauts:</label></b>
          <label><?php  
      if($leave['Status']==0){
        ?> <span style="color: blue;font-weight:normal">Waiting for Approved</span>
        <?php }
        elseif($leave['Status']==1){ ?>
            <span style="color: green;font-weight:normal">Approved</span>
              <?php }
              elseif($leave['Status']==2){ ?>
            <span style="color: red;font-weight:normal">Not Approved</span>
              <?php }?>
              </label>

    <tr>
    <th>
    <?php 
    if($leave['Status'] != 1 && $leave['Status'] != 2){
      echo '<button style="background-color:green;color:white;width:150px;height:40px;border:none" data-toggle="modal" data-target="#exampleModal">TAKE ACTION</button>';
    }
    ?>
    </th>
    </tr>
  </table>
    

  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  >
  <div class="modal-dialog" role="document">
    <div class="modal-content" >
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="color:green">LEAVE TAKE ACTION</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="update-leave.php" method="post" style="padding-bottom:40px">
        <div class="form-group">
          <select name="status" class="form-control" style="margin:0 10px;width:96%">
          <option value="">Choose your option</option>
          <option value="1">Approved</option>
          <option value="2">Not Approved</option>
          </select>
        </div>
        
        <input hidden name="leave_id" value="<?php echo $leave_id; ?>">
        <div class="form-group">
          <input type="text" name="description"class="form-control" required style="width:96%;margin:0 10px;border:none;height:80px" placeholder="Description">  
        </div>
        <button type="submit" name="update" class="btn btn-success"style=" float:right">SUBMIT</button>
        </form>
      </div>

    </div>
  </div>
</div>