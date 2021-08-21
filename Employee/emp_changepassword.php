<?php
session_start();
error_reporting(0);
include('connection.php');
include('function.php');
//$user_data=check_login($con);
if(isset($_POST['change']))
{
$password=md5($_POST['password']);
$newpassword=md5($_POST['newpassword']);
$username=$_SESSION['emplogin'];
$sql ="SELECT Password FROM tblemployees WHERE EmpId=:username and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':username', $username, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
$con="update tblemployees set Password=:newpassword where EmpId=:username";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':username', $username, PDO::PARAM_STR);
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();
$msg="Your Password succesfully changed";
}
else {
$error="Your old password is wrong";    
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
 
     

     
    <title>Change Password</title>
<style> 
*{
    margin:0;
    padding:0;
    box-sizing:border-box
}

body{
    background-color: lavender;
   
}
 
form{ 
    width: 70%;
    
                background-color:#fff;
                margin:25px;
                margin-left: 300px;
                padding-bottom:70px;
            }
ul{
    margin-top:50px;
    list-style:none;
    padding:5px
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

<li class="no-padding"><a class="waves-effect waves-grey" href="emprofile.php" style="color:black"><i class="material-icons">account_box</i>My Profiles</a></li>
<li><a href="emp_changepassword.php" style="color:black;margin-top:-10px"><i class="material-icons" >settings_input_svideo</i>Change Password</a></li>
                  
      <div class="dropdown"> <i class="material-icons" style="margin-left: 17px;">apps</i> <button class="dropdown-toggle"  style="background-color:#8ed2fa;border:none;font-size:15px" type="button" data-toggle="dropdown">Leaves  
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li><a href="apply-leave.php">Apply Leave </a></li>
      <li><a href="leave-history.php">Leave History</a></li>
    </ul>
  </div>
            
       <a class="waves-effect waves-grey" href="logout.php" style="color:black;margin-left: 2px"><i class="material-icons">exit_to_app</i>Sign Out</a>
              </div>
</ul>
</div>
              <main class="mn-inner">
                <div class="row">
                <br>
                    <div class="col s12">
                    <div class="page-title" style=" color: green; padding-left: 300px;font-weight:bold;font-size: 17px;">CHANGE PASSWORD</div>
                    </div>
                    <div class="col s12 m12 l6">
                        <div class="card">
                            <div class="card-content">
                              
                                <div class="row">
                                    <form class="col s12" name="chngpwd" method="post">
                                          <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
                                        <div class="row">
                                            <div class="input-field col s12">
     
<input type="password" name="password" placeholder="Enter Old Password" style="width:95%;padding-top:40px;margin-left:30px;border:none;border-bottom:1px solid gray;padding-bottom:8px;outline:none"autocomplete="off" required>
                                            </div>

  <div class="input-field col s12">
  <input type="password" name="password" placeholder="Enter New Password" style="width:95%;padding-top:40px;margin-left:30px;border:none;border-bottom:1px solid gray;padding-bottom:8px;margin-top:20px;outline:none">
             <input type="password" name="password" placeholder="Enter Confirm Password" style="width:95%;padding-top:40px;margin-left:30px;border:none;border-bottom:1px solid gray;padding-bottom:8px;margin-top:20px;outline:none"><br><br>
 
                                                
                                            </div>
 






                                        </div>
                                      
<div class="input-field col s12">
<center><button type="submit" name="change" class="waves-effect waves-light btn indigo m-b-xs" style="background-color:green;padding:10px;color:#fff;margin-left:20px;width:100px;border:none;text-transform:uppercase" onclick="return valid();">Change</button></center>

</div>

                                    </form>
                                </div>
                            </div>
                        </div>
                     
             
                   
                    </div>
                
                </div>
            </main>

        </div>
        <div class="left-sidebar-hover"></div>
        
      

 
</body></html>