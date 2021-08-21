
<?php
function check_login($con){
if(isset($_SESSION['username'])){
       $id=$_SESSION['username'];
       $sql ="SELECT * FROM tblemployees WHERE username='$id' limit 1";
       $result=mysqli_query($con,$sql);
       if($result && mysqli_num_rows($result)>0){
           $user_data=mysqli_fetch_assoc($result);
           return $user_data;
       }
   }
//redirect to login
 header("location:index.php");
 die;
}



   ?>