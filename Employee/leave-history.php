<?php
session_start();
error_reporting(0);
include('connection.php');
if(strlen($_SESSION['emplogin'])==0)
    {   
header('location:index.php');
}
else{

 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>  <link  rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
 
     

     
     <title>Leave History</title>
     <style> 
 
body{
    background-color: lavender;
   
}
 th{
     color: red;
 }
 
 
ul{
    margin-top:50px;
    list-style:none;
    padding:5px
}
.card{
 
               
    background-color:#fff;
  display: flex;
    margin-left: 250px;
  width: 80%;
  height: 190%;
  margin-top:0;
  padding:30px;
  border-radius: 5px;
}

i{
    padding-right:15px;
    color:black;
    vertical-align:middle

}
 

h3{
    padding:20px;
    color:#000;
    text-transform: uppercase;
    font-size:17px;
    padding-bottom:10px
}
</style>
 </head>
 <body>
 
     
<div class="topnav">
<center><h1>Employee Leave Management System</h1></center>
 
</div>
<div class="sidebar">
<div class="sidebar-profile-image">
          <img style=" width: 50px;   
     margin:15px;
    min-width: 1px!important;
    line-height: 1.5;
    border-radius: 100%; height: 50px;" src="images/profile-image.png">  
      </div>
      <div class="sidebar-profile-info">
                    <?php
$eid=$_SESSION['eid'];
$sql = "SELECT FirstName,LastName,EmpId from  tblemployees where id=:eid";
$query = $dbh -> prepare($sql);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>
                                <p style="margin-left:10px;font-weight:bold"><?php echo htmlentities($result->FirstName." ".$result->LastName);?></p>
                                <span style="margin-left:10px"><?php echo htmlentities($result->EmpId)?></span>
                         <?php }} ?>
                        </div>
    <ul class="sidebar-menu collapsible collapsible-accordion" data-collapsible="accordion">

<li class="no-padding"><a class="waves-effect waves-grey" href="emprofile.php" style="color:black"><i class="material-icons">account_box</i>My Profiles</a></li>
 
<li><a href="emp_changepassword.php" style="color:black;margin-top:-10px"><i class="material-icons">settings_input_svideo</i>Change Password</a></li>
                  
<div class="dropdown"> <i class="material-icons" style="margin-left: 17px;">apps</i> <button class="dropdown-toggle"  style="background-color:#8ed2fa;border:none;font-size:15px" type="button" data-toggle="dropdown">Leaves  
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li><a href="apply-leave.php">Apply Leave </a></li>
      <li><a href="leave-history.php">Leave History</a></li>
    </ul>
  </div>
                        
               <a class="waves-effect waves-grey" href="logout.php" style="color:black;margin-left:2px"><i class="material-icons">exit_to_app</i>Sign Out</a>
              </div>
</ul>
</div>
 <main class="mn-inner">
                <div class="row">
                    <br>
                    <div class="col s12">
                    <div class="page-title"style=" color: black; padding-left: 300px; top:40px;  font-size: 17px;">LEAVE HISTORY</div>
                    </div><br>
                   
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                               
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

             <input type="text"id="myInput"  onkeyup="myFunction()" placeholder="Search records" style="border:none;border-bottom:1px solid gray;padding-bottom:10px;width:30%;margin-left:60%;outline:none;"> 

                                <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                                <table id="table" style="width:100%;margin-left:20px;margin-top:20px" class="table">
                                    <thead>
                                        <tr>
                                            <th  width="140">SI NO</th>
                                            <th width="140">Type Of Leave</th>
                                            <th  width="140">From</th>
                                            <th  width="140">To</th>
                                             <th  width="140">Description</th>
                                             <th width="140">Posting Date</th>
                                            <th  width="140">Status</th>
                                        </tr>
                                    </thead>
                                 
                                    <tbody>
<?php 
$eid=$_SESSION['eid'];
$sql = "SELECT LeaveType,ToDate,FromDate,Description,PostingDate,Status from tblleaves where empid=:eid";
$query = $dbh -> prepare($sql);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  
                                        <tr>
                                           
                                            <td> <?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($result->LeaveType);?></td>
                                            <td><?php echo htmlentities($result->FromDate);?></td>
                                            <td><?php echo htmlentities($result->ToDate);?></td>
                                           <td><?php echo htmlentities($result->Description);?></td>
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
          
                                        </tr>
                                         <?php $cnt++;} }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
         
        </div>
        <div class="left-sidebar-hover"></div>
        
    <script>
        function myFunction() {
          // Declare variables
          var input, filter, table, tr, td, i, txtValue;
          input = document.getElementById("myInput");
          filter = input.value.toUpperCase();
          table = document.getElementById("myTable");
          tr = table.getElementsByTagName("tr");
        
          // Loop through all table rows, and hide those who don't match the search query
          for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
              txtValue = td.textContent || td.innerText;
              if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
              } else {
                tr[i].style.display = "none";
              }
            }
          }
        }
        </script>
 </body>
 </html>
 <?php } ?>