<?php 
//session_start();
    $uid=$_SESSION["id"];
    $sql1="select * from notification where post_usr='$uid'";
    $re=mysqli_query($con,$sql1);
    $count=mysqli_num_rows($re);
?>
<ul class="nav navbar-nav navbar-right">
  
<li><a href="#"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Notification(<?php echo $count; ?>) </a></li>
 

 <li><a href="logout1.php"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Log Out</a></li>
 </ul>
 <form class="navbar-form navbar-right" action="search.php" method="post">
 <div class="input-group" style="margin-right:200px">
 <input type="text" class="form-control" placeholder="Search..." id="query" name="search" value="">
 <div class="input-group-btn">
 <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-search"></span></button>
 </div>
 </div>
 </form>
 </div>