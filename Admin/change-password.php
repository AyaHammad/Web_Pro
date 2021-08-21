<?php
session_start();
error_reporting(0);
include('connection.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:admin.php');
}
else{
// Code for change password 
if(isset($_POST['change']))
    {
$password=md5($_POST['password']);
$newpassword=md5($_POST['newpassword']);
$username=$_SESSION['alogin'];
    $sql ="SELECT Password FROM admin WHERE UserName=:username and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':username', $username, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
$con="update admin set Password=:newpassword where UserName=:username";
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
        <!-- Title -->
        <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    

    <!-- Bootstrap CSS -->
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

    <body> 
    <div class="body">
           <h3>Change Password</h3>
                                    <form class="col s12" name="chngpwd" method="post">
                                          <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
                                        <div class="row">
                                            <div class="input-field col s12">
<input id="password" type="password" name="password" class="validate" autocomplete="off" placeholder="Enter Old Password" style="width:95%;padding-top:40px;margin-left:30px;border:none;border-bottom:1px solid gray;padding-bottom:8px;outline:none"  required>
                                            </div>

  <div class="input-field col s12">
 <input id="password" type="password" name="newpassword" class="validate" autocomplete="off" placeholder="Enter New Password" style="width:95%;padding-top:40px;margin-left:30px;border:none;border-bottom:1px solid gray;padding-bottom:8px;margin-top:20px;outline:none" required>
                                            </div>

<div class="input-field col s12">
<input id="password" type="password" name="confirmpassword" class="validate" autocomplete="off" placeholder="Enter Confirm Password" style="width:95%;padding-top:40px;margin-left:30px;border:none;border-bottom:1px solid gray;padding-bottom:8px;margin-top:20px;outline:none" required>
</div><br><br>


<div class="input-field col s12">
<center><button type="submit" name="change" class="waves-effect waves-light btn indigo m-b-xs" style="background-color:green;padding:10px;color:#fff;margin-left:20px;width:100px;border:none;text-transform:uppercase" onclick="return valid();">Change</button></center>

</div>




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
        
        
    </body>
</html>
<?php } ?>