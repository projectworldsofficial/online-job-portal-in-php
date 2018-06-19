<?php 
    include("dbconfig.php");
    session_start();
?>
<?php 
  
	
    if($_SESSION["name"]=="")
    {
        header("location:reg.php");

    }
    


?>
<?php
 if(isset($_POST["uid"]))
 {
   $com=$_POST["comment"];
   $comenterid=$_POST["comme_id"];
   
//postusr==commentuser
   //$u_id=$_POST["uid"];
   $p_id=$_POST["pid"];
   $uid=$_SESSION["id"];
   $sql2=mysqli_query($con,"select usr_id_p from posts where post_id='$p_id'");
   while($row=mysqli_fetch_array($sql2))
   {
      $user=$row["usr_id_p"];
       
   }
   
    $sql= mysqli_query($con,"insert into comments(post_id_c,user_id_c,comment,comment_time) values('$p_id','$uid','$com',now())");
    $sql1= mysqli_query($con,"insert into notification(pos_id,post_usr,comm_user,comment,status,time) 
      values('$p_id','$user','$uid','$com',0,now())");
   //$sql=mysqli_query($con,"insert into comments(post_id_c,user_id_c,comment,comment_time) values('$p_id','$uid','$com',now())");
    if($sql)
    {
      header("location:user.php");

    }
 }   
 

?>