<?php

include('connection.php');
if(isset($_POST['login']))
{
$uname=$_POST['username'];
$password=md5($_POST['password']);
$sql ="SELECT UserName,Password FROM admin WHERE UserName=:uname and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':uname', $uname, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
session_start();

$_SESSION['alogin']=$_POST['username'];
echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
} else{
  
  echo "<script>alert('Invalid Details');</script>";

}
 

}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin</title>
</head>


<body class="hold-transition login-page" style=" background-color:lavender;text-align:center;">
<div class="login-box">
  <div class="login-logo" style="text-align: center; color:crimson; font-weight:bold; font-size:30px; margin-top:130px; font-family:Arial, Helvetica, sans-serif">
    <a><b>Admin Login</b></a>
  </div>
  
  
  <form method="POST" style="top:50%; left:50%; transform:translate(-50%,-50%);position:absolute;">
  <fieldset style="width: 400px; background-color:white;border-color:white;">
  <div class="card">
    <div class="card-body login-card-body" style="color:crimson; font-weight:bold;font-family:Arial, Helvetica, sans-serif">
      <p class="login-box-msg" style="text-align: left;">ADMIN LOGIN</p>

      <form method="post" style="text-align: center; border-color:white;">
        
        <div class="input-group mb-3" >
            <input type="username" name="username" class="form-control" placeholder="Enter Username" style="border:none; border-bottom: 1px solid gray; margin-bottom:20px; outline: none;height:50px;width:400px;border-color:lightgray;padding:10px;padding-bottom:3px;">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Enter Password" style="border:none; border-bottom: 1px solid gray; margin-bottom:25px; outline: none;height:50px;width:400px;border-color:lightgray;padding:10px;padding-bottom:3px;" >
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
    
          
          <div class="col-4">
            <button type="submit"name="login" value="Log in" class="btn btn-primary btn-block" style="background-color:green; color:white; width:90px; height:30px;text-align:center;margin-bottom:20px">LOGIN</button>
          </div>
          
        </div>
        </fieldset>
      </form>
 
</html>

