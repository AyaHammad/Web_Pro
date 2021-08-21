<?php
session_start();
error_reporting(0);
include('connection.php');
if(strlen($_SESSION['emplogin'])==0)
    {   
header('location:index.php');
}
else{
if(isset($_POST['apply']))
{
$empid=$_SESSION['eid'];
 $leavetype=$_POST['leavetype'];
$fromdate=$_POST['fromdate'];  
$todate=$_POST['todate'];
$description=$_POST['description'];  
$status=0;
$isread=0;
if($fromdate > $todate){
                $error=" ToDate should be greater than FromDate ";
           }
$sql="INSERT INTO tblleaves(LeaveType,ToDate,FromDate,Description,Status,IsRead,empid) VALUES(:leavetype,:fromdate,:todate,:description,:status,:isread,:empid)";
$query = $dbh->prepare($sql);
$query->bindParam(':leavetype',$leavetype,PDO::PARAM_STR);
$query->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
$query->bindParam(':todate',$todate,PDO::PARAM_STR);
$query->bindParam(':description',$description,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':isread',$isread,PDO::PARAM_STR);
$query->bindParam(':empid',$empid,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Leave applied successfully";
}
else 
{
$error="Something went wrong. Please try again";
}

}

    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>  <link  rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
 
     

     
    <title>Apply Leave</title>
<style> 
 
body{
    background-color: lavender;
   
}
 .dat{
display: flex;
 
justify-content: flex-start;
 }
 

ul{
    margin-top:50px;
    list-style:none;
    padding:5px
}
form{ 
    width: 75%;
  padding-top: 100px;
                background-color:#fff;
                margin:25px;
                margin-left: 300px;
                padding-bottom:70px;
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
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
 
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

<li class="no-padding"><a class="waves-effect waves-grey" style="color:black" href="emprofile.php"><i class="material-icons">account_box</i>My Profiles</a></li>
 
<li><a href="emp_changepassword.php" style="color:black;margin-top:-10px"><i class="material-icons">settings_input_svideo</i>Change Password</a></li>
                  
<div class="dropdown"> <i class="material-icons" style="margin-left: 17px;">apps</i> <button class="dropdown-toggle"  style="background-color:#8ed2fa;border:none;font-size:15px" type="button" data-toggle="dropdown">Leaves  
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li><a href="apply-leave.php">Apply Leave </a></li>
      <li><a href="leave-history.php">Leave History</a></li>
    </ul>
  </div>
                        
              <a class="waves-effect waves-grey" style="color:black;margin-left:2px" href="logout.php"><i class="material-icons">exit_to_app</i>Sign Out</a>
              </div>
</ul>
</div>
<main class="mn-inner">
                <div class="row">
                    <div class="col s12">
                        <div class="page-title" style=" color: green; padding-left: 300px; margin-top:20px;  font-size: 17px;font-weight:bold">APPLY FOR LEAVE</div>
                    </div>
                    <div class="col s12 m12 l8">
                        <div class="card">
                            <div class="card-content">
                                <form id="example-form" method="post" name="addemp">
                                    <div>
                                       
                                        <section>
                                            <div class="wizard-content">
                                                <div class="row">
                                                    <div class="col m12">
                                                        <div class="row">
     <?php if($error){?><div class="errorWrap"><strong>ERROR </strong>:<?php echo htmlentities($error); ?> </div><?php } 
                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>




<div class="dat">
 
<input placeholder="From  Date" style="width:95%; margin-left:30px;border:none;border-bottom:1px solid gray;padding-bottom:8px;margin-top:20px;outline:none"   name="fromdate"   type="text" data-inputmask="'alias': 'date'"  required>
  
 
<input  placeholder="To Date"  style="width:95%;  margin-left:30px;border:none;border-bottom:1px solid gray;padding-bottom:8px;margin-top:20px;outline:none;margin-right:20px"  name="todate"  type="text" data-inputmask="'alias': 'date'"  required>
</div>
 
 
 

<div class="input-field col  s12">
<select style="width:95%;padding-top:40px;margin-left:30px;border:none;border-bottom:1px solid gray;padding-bottom:8px;margin-top:20px;outline:none"   name="leavetype" autocomplete="off">
<option value="">Select leave type...</option>
<?php $sql = "SELECT  LeaveType from tblleavetype";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>                                            
<option value="<?php echo htmlentities($result->LeaveType);?>"><?php echo htmlentities($result->LeaveType);?></option>
<?php }} ?>
</select>
</div>
           
<textarea id="textarea1" name="description" placeholder="Description" class="materialize-textarea" length="500" required style="width:95%; margin-left:30px;border:none;border-bottom:1px solid gray;padding-bottom:8px;margin-top:20px;outline:none"></textarea>
</div>
 
</div> <center><button type="submit"name="apply" style="background-color:green;padding:10px;color:#fff;margin-left:0;width:90px;border:none;margin-top:20px">Apply</button></center>
                                            

                                                </div>
                                            </div>
                                        </section>
                                     
                                    
                                        </section>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div class="left-sidebar-hover"></div>
</body></html>
<?php } ?> 