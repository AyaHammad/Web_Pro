
<?php
 session_start();
include('connection.php');

$errorMessage = '';	
if(isset($_POST['signin']))
{
$uname=$_POST['username'];
$password=md5($_POST['password']);
$sql ="SELECT EmpId,Password,Status,id FROM tblemployees WHERE EmpId=:uname and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':uname', $uname, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{

  foreach ($results as $result) {
  $status=$result->Status;
  $_SESSION['eid']=$result->id;
}
if($status==2)
{ 
   echo "<script>alert('Your account is Inactive. Please contact admin');</script>";
 
} else{
  
$_SESSION['emplogin']=$_POST['username'];
echo "<script type='text/javascript'> document.location = 'emprofile.php'; </script>";
}} 
else{

  echo "<script>alert('Invalid Details');</script>";

}

  

if(isset($_POST['signin'])){
  $user = $_POST['username'];
  $password = $_POST['password'];
  
  if(isset($_POST['remember'])){
      setcookie("username",$user,time()+(2*24*60*60),"/");
      setcookie("password",$password,time()+(2*24*60*60),"/");

  }
  $_SESSION['username'] = $username;
  header("Location:emprofile.php");
}

}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
</head>


<body class="hold-transition login-page" style=" background-color:lavender;text-align:center;">
<div class="login-box">
  <div class="login-logo" style="text-align: center; color:crimson; font-weight:bold; font-size:30px; margin-top:110px; font-family:Arial, Helvetica, sans-serif">
    <a><b>Leave Managment System</b></a> 
    
  </div>
  
  <?php if ($errorMessage != '') { ?>
				<div id="login-alert" class="alert alert-danger col-sm-12"><?php echo $errorMessage; ?></div>                            
			<?php } ?>
  <form method="POST" style="top:50%; left:50%; transform:translate(-50%,-50%);position:absolute;">
  <fieldset style="width: 400px; background-color:white;border-color:white;">
  <div class="card">
    <div class="card-body login-card-body" style="color:crimson; font-weight:bold;font-family:Arial, Helvetica, sans-serif">
   
    <div class="card-content">
    <p class="login-box-msg" style="text-align: left;">EMPLOYEE LOGIN</p>
  
      <form method="post"class="col s12" name="signin" style="text-align: center; border-color:white;">
        
        <div class="input-group mb-3" >
            <input type="username" name="username" class="form-control"  value="<?php if(isset($_COOKIE["username"])) { echo $_COOKIE["username"]; } ?>" placeholder="Enter Username" style="border:none; border-bottom: 1px solid gray; margin-bottom:20px; outline: none;height:50px;width:400px;border-color:lightgray;padding:10px;padding-bottom:3px;">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>" class="form-control" placeholder="Enter Password" style="border:none; border-bottom: 1px solid gray; margin-bottom:25px; outline: none;height:50px;width:400px;border-color:lightgray;padding:10px;padding-bottom:3px;" >
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="input-group">
				  <div class="checkbox">
					<label style="color:gray; padding-right:250px;font-size:11px;">
					  <input  type="checkbox" id="remember" name="remember" > Remember Login?
					</label>
				  </div>
				</div>
          
          <div class="col-4">
            <button type="submit" name="signin" class="btn btn-primary btn-block"value="signin" style="background-color:green; color:white; width:90px; height:30px;text-align:center;margin-bottom:20px">LOGIN</button>
          </div>
          
        </div>
        </fieldset>
      </form>
</div>
 
</html>
