<?php
include 'connection.php';
session_start();
$username = "";
if(!isset($_SESSION['alogin'])){
  header("Location:Admin.php");
}else{
    $username = $_SESSION['alogin'];
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
    

    <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>  <link  rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
        <title>Dashboard</title>
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
                margin-top:-35px;
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


      <div class="row">      
  <div class="col-sm-6" style="background-color:dimgray;color:white;height:100px;width:300px;margin-left:25%;margin-top:-540px;padding:0.5em 1em;font-family:Arial, Helvetica, sans-serif" >TOTALE REGD EMPLOYEE
                                     
                                     <br><br><br>
     <?php
     $sql = "SELECT id from tblemployees";
     $query = $dbh -> prepare($sql);
     $query->execute();
     $results=$query->fetchAll(PDO::FETCH_OBJ);
     $empcount=$query->rowCount();
     ?>
     <span class="stats-counter"><span class="counter"><?php echo htmlentities($empcount);?></span></span></div>

    <div class="col-s-6" style="background-color:dimgray;color:white;height:100px;width:300px;padding:0.5em 1em;margin-top:-540px;margin-left:48%;font-family:Arial, Helvetica, sans-serif">TOTALE DEPARTEMENTS
    
         <br><br><br>
         <?php
     $sql = "SELECT id from tbldepartments";
     $query = $dbh -> prepare($sql);
     $query->execute();
     $results=$query->fetchAll(PDO::FETCH_OBJ);
     $dptcount=$query->rowCount();
     ?>                           
     <span class="stats-counter"><span class="counter"><?php echo htmlentities($dptcount);?></span></span></div>

<div class="col-sm-9" style="background-color:dimgray;color:white;height:100px;width:300px;margin-top:-540px;margin-left:72%;padding: 0.5em 1em;;font-family:Arial, Helvetica, sans-serif;">TOTALE LEAVE APPLICATION
        <br><br><br>             
   <?php
     $sql = "SELECT id from  tblleavetype";
     $query = $dbh -> prepare($sql);
     $query->execute();
     $results=$query->fetchAll(PDO::FETCH_OBJ);
     $leavtypcount=$query->rowCount();
     ?>   

    <span class="stats-counter"><span class="counter"><?php echo htmlentities($leavtypcount);?></span></span></div>
    <br>

   <div class="body">
          
         <form> 
         <h3>lateset leave applications</h3>
    <table style="width:95%;margin-left:20px;" class="table">
    <thead>
      <tr style="color:red;padding-top:30px">
       <th style="padding-top:30px;">SI NO</th>
       <th>Employee Name</th>
       <th>Leave Type</th>
       <th>Posting Date</th>
       <th>Status</th>
       <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php $sql = "SELECT tblleaves.id as lid,tblemployees.FirstName,tblemployees.LastName,tblemployees.EmpId,tblemployees.id,tblleaves.LeaveType,tblleaves.PostingDate,tblleaves.Status from tblleaves join tblemployees on tblleaves.empid=tblemployees.id order by lid desc limit 6";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$SINO=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{         
      ?>  

      <tr>
      <td> <b><?php echo htmlentities($SINO);?></b></td>
        <td style="color:blue"><?php echo htmlentities($result->FirstName." ".$result->LastName);?>(<?php echo htmlentities($result->EmpId);?>)</td>
        <td><?php echo htmlentities($result->LeaveType);?></td>
        <td><?php echo htmlentities($result->PostingDate);?></td>
        <td><?php $stats=$result->Status;
            if($stats==1){
            ?>
            <span style="color: green">Approved</span>
              <?php } if($stats==2)  { ?>
            <span style="color: red">Not Approved</span>
              <?php } if($stats==0)  { ?>
 <span style="color: blue">waiting for approval</span>
 <?php } ?>


    </td>

          <td>
           <td><a href="leave-details.php?leaveid=<?php echo htmlentities($result->lid);?>" class="waves-effect waves-light btn blue m-b-xs" style="background-color: green;color:white;width:110px;"> View Details</a></td>
                                    </tr>
                                         <?php $SINO++;} }?>
                                    </tbody>
                                </table>
         </form>
   </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        
        </body>
</html>
<?php  ?>