<?php
session_start();
error_reporting(0);
include("connection.php");
$username = "";
session_start();
if(isset($_COOKIE['username'])){
    $_SESSION['username'] = $_COOKIE['username'];
}
if(!isset($_SESSION['username'])){
    header("Location: index.php");
}else{
    $email = $_SESSION['username'];
}


if(isset($_POST['logout'])){
    session_unset();
    session_destroy();
    setcookie("username","",time()-(60*60),"/");
    header("Location: index.php");
}
if(strlen($_SESSION['emplogin'])==0)
    {   
header('location:index.php');
}
else{
$eid=$_SESSION['emplogin'];
if(isset($_POST['update']))
{


$fname=$_POST['firstName'];
$lname=$_POST['lastName'];   
$gender=$_POST['gender']; 
$dob=$_POST['dob']; 
$department=$_POST['department']; 
$address=$_POST['address']; 
$city=$_POST['city']; 
$country=$_POST['country']; 
$mobileno=$_POST['mobileno']; 
$sql="update tblemployees set FirstName=:fname,LastName=:lname,Gender=:gender,Dob=:dob,Department=:department,Address=:address,City=:city,Country=:country,Phonenumber=:mobileno where EmpId=:eid";
$query = $dbh->prepare($sql);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':lname',$lname,PDO::PARAM_STR);
$query->bindParam(':gender',$gender,PDO::PARAM_STR);
$query->bindParam(':dob',$dob,PDO::PARAM_STR);
$query->bindParam(':department',$department,PDO::PARAM_STR);
$query->bindParam(':address',$address,PDO::PARAM_STR);
$query->bindParam(':city',$city,PDO::PARAM_STR);
$query->bindParam(':country',$country,PDO::PARAM_STR);
$query->bindParam(':mobileno',$mobileno,PDO::PARAM_STR);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();
$msg="Employee record updated Successfully";
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
 
     
    <title>Profile</title>
    <style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box
}

body{
    background-color: lavender;
   
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
.card{
    width: 80%;
    height: 80%;
    background: #fff;
 margin-top: 290px;
 margin-left: 800px;
    box-shadow:  -4px 4px 5px 0 rgb(223, 209, 209);
    position: absolute;
    transform: translate(-50%,-50%);
    box-sizing: border-box;
    
    font-size: 15px;
}
a{
    color:black;
}
label{
   color: gray;
   font-size: 15px;
}

  form{
                background-color:#fff;
                padding-top:0;
                margin:0;
                padding-bottom:30px
            }
 
 
</style>
</head>
<body>
<!DOCTYPE html>
<html>
 
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
                                <p style="margin-left:10px;font-weight:bold" ><?php echo htmlentities($result->FirstName." ".$result->LastName);?></p>
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
            
      <a class="waves-effect waves-grey"name="logout" href="logout.php" style="color:black"><i class="material-icons" style="margin-left: 2px" >exit_to_app</i>Sign Out</a>
                  </ul>
              </div>

 
<main class="mn-inner">
                <div class="row">
                    <div class="col s12">
                           <br>
                        <div class="page-title" style=" color: #5cb85c; padding-left: 300px;font-size: 17px;font-weight:bold">UPDATE EMPLOYEE DETAILS</div> 
                    
                    </div>
                
                        <div class="card"> 
                            <div class="card-content">
                            
                                <form id="example-form" method="post" name="updatemp">
                                    <div>
                                    <?php 
$eid=$_SESSION['emplogin'];
$sql = "SELECT * from  tblemployees where EmpId=:eid";
$query = $dbh -> prepare($sql);
$query -> bindParam(':eid',$eid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?> 
 <br>
 <label for="empid" >Employee username</label><br>
             <input type="text" name="empid"  value="<?php echo htmlentities($result->EmpId);?>"placeholder="Employee Code(Must be unique)"style="border:none;padding:10px; outline:none;border-bottom:1px solid gray;width:40%;margin-bottom:15px" required>
             
<select  name="gender" autocomplete="off" style="border:none;font-size:15px;background-color:#fff;border-bottom:1px solid gray;padding:10px;margin-left:25px;margin-bottom:15px;width:25%">
<option value="<?php echo htmlentities($result->Gender);?>"><?php echo htmlentities($result->Gender);?></option>                                          
<option value="Male">Male</option>
<option value="Female">Female</option>
<option value="Other">Other</option>
</select> 

<label for="dob" >Date Of Birth</label><br>
<input  id="birthdate" name="dob" style="border:none;border-bottom:15px; padding: 10px ;margin-bottom:15px;   outline:none;border-bottom:1px solid gray;width:25%; " class="datepicker" value="<?php echo htmlentities($result->Dob);?>" >
    <div style="display:flex; flex-direction:row;">
   
<label for="firstName">First name</label>  
<input id="firstName" name="firstName"  style="border:none;padding: 10px  ; outline:none;border-bottom:1px solid gray;margin-left:0;margin-bottom:15px" value="<?php echo htmlentities($result->FirstName);?>"  type="text" required>

<label for="lastName" style="margin-left:50px; ">Last name </label>
<input id="lastName"style="border:none;outline:none; border-bottom:1px solid gray;margin-left:10px; " name="lastName" value="<?php echo htmlentities($result->LastName);?>" type="text" autocomplete="off" required>
 


</div>
</div>
                                                    
<div style="display:flex;">

<select  name="department" autocomplete="off" style="border:none;font-size:15px;background-color:#fff;border-bottom:1px solid gray;padding:12px; margin-bottom:15px;width:45%">
<option value="<?php echo htmlentities($result->Department);?>"><?php echo htmlentities($result->Department);?></option>
<?php $sql = "SELECT DepartmentName from tbldepartments";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $resultt)
{   ?>                                            
<option value="<?php echo htmlentities($resultt->DepartmentName);?>"><?php echo htmlentities($resultt->DepartmentName);?></option>
<?php }} ?>
</select>



<div class="input-field col m6 s12">
<label for="country">Country</label>
<input id="country" name="country" type="text"style="border:none; outline:none;border-bottom:1px solid gray;margin-left:20px;margin-bottom:15px;width:45%"  value="<?php echo htmlentities($result->Country);?>" autocomplete="off" required>
</div>
</div>

<div  style="display:flex;">
<label for="email">Email</label>
<input  name="email" type="email" style="border:none;outline:none;border-bottom:1px solid gray; margin-top:20px;width:45%;margin-bottom:15px" id="email" value="<?php echo htmlentities($result->EmailId);?>" readonly autocomplete="off" required>
<span id="emailid-availability" style="font-size:12px;"></span> 
 
       
<label for="city">City/Town</label>
<input id="city" name="city" type="text" style="border:none; outline:none;border-bottom:1px solid gray; margin-top:20px;margin-bottom:15px;width:20%" value="<?php echo htmlentities($result->City);?>" autocomplete="off" required>
 </div>
   
<div class="input-field col s12">
<label for="phone">Mobile number</label>
<input id="phone" name="mobileno"style="border:none;padding:8px;outline:none;border-bottom:1px solid gray;margin-left:20px;margin-top:20px;margin-bottom:15px;width:40%"   type="tel" value="<?php echo htmlentities($result->Phonenumber);?>" maxlength="10" autocomplete="off" required>
 </div>                                                   

<?php }}?>
                                                        
<div class="input-field col s12">
<button type="submit" name="update"  id="update"  style="background-color:#2f0877;padding:10px;color:#fff;margin-left:600px;width:80px;border:none">UPDATE</button>

</div>

                                                        </div>
                                                    </div>
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
        

 
 
</body>
</html>
<?php } ?> 